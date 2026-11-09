<?php
/**
 * Abilities
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * Exposes the plugin's functionality through the WordPress Abilities API.
 */
class Abilities {

	/**
	 * Always register, the Abilities API hooks only fire when it is available.
	 *
	 * @return bool
	 */
	public function can_register() {
		return true;
	}

	/**
	 * Registers the ability category and abilities.
	 */
	public function register() {
		add_action( 'wp_abilities_api_categories_init', [ $this, 'register_category' ] );
		add_action( 'wp_abilities_api_init', [ $this, 'register_abilities' ] );
	}

	/**
	 * Registers the Convert to Blocks ability category.
	 */
	public function register_category() {
		wp_register_ability_category(
			'convert-to-blocks',
			[
				'label'       => __( 'Convert to Blocks', 'convert-to-blocks' ),
				'description' => __( 'Abilities for converting classic editor posts to blocks.', 'convert-to-blocks' ),
			]
		);
	}

	/**
	 * Registers the Convert to Blocks abilities.
	 */
	public function register_abilities() {
		wp_register_ability(
			'convert-to-blocks/start-migration',
			[
				'label'               => __( 'Start Migration', 'convert-to-blocks' ),
				'description'         => __( 'Starts a bulk migration of classic editor posts to blocks, equivalent to the "wp convert-to-blocks start" command. Returns the URL that must be opened in a browser to run the migration.', 'convert-to-blocks' ),
				'category'            => 'convert-to-blocks',
				'input_schema'        => [
					'type'                 => 'object',
					'properties'           => [
						'post_type' => [
							'type'        => 'string',
							'description' => __( 'Comma delimited list of post types to migrate. Defaults to post,page.', 'convert-to-blocks' ),
						],
						'per_page'  => [
							'type'        => 'integer',
							'description' => __( 'Number of posts to migrate per batch. Defaults to no limit.', 'convert-to-blocks' ),
						],
						'page'      => [
							'type'        => 'integer',
							'minimum'     => 1,
							'description' => __( 'Page number to start migration from. Defaults to 1.', 'convert-to-blocks' ),
						],
						'only'      => [
							'type'        => 'string',
							'description' => __( 'Comma delimited list of post ids to migrate.', 'convert-to-blocks' ),
						],
						'catalog'   => [
							'type'        => 'boolean',
							'description' => __( 'Only migrate classic editor tagged posts. Requires the Block Catalog plugin to be active and indexed.', 'convert-to-blocks' ),
						],
						'reset'     => [
							'type'        => 'boolean',
							'description' => __( 'Stops any currently running migration and resets the migration state.', 'convert-to-blocks' ),
						],
					],
					'additionalProperties' => false,
					'default'              => [],
				],
				'output_schema'       => [
					'type'       => 'object',
					'properties' => [
						'url'   => [
							'type'        => 'string',
							'description' => __( 'The URL to open in a browser to start the migration agent.', 'convert-to-blocks' ),
						],
						'total' => [
							'type'        => 'integer',
							'description' => __( 'The number of posts to migrate.', 'convert-to-blocks' ),
						],
					],
				],
				'execute_callback'    => [ $this, 'start_migration' ],
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
				'meta'                => [
					'show_in_rest' => true,
					'annotations'  => [
						'readonly'    => false,
						'destructive' => false,
						'idempotent'  => false,
					],
				],
			]
		);
	}

	/**
	 * Starts a new migration and returns the URL that kicks it off.
	 *
	 * @param array $input The ability input.
	 * @return array|\WP_Error
	 */
	public function start_migration( $input = [] ) {
		$agent = new MigrationAgent();
		$input = is_array( $input ) ? $input : [];

		if ( ! empty( $input['reset'] ) ) {
			$agent->stop();
		}

		if ( ! empty( $input['catalog'] ) && ! defined( 'BLOCK_CATALOG_PLUGIN_VERSION' ) ) {
			return new \WP_Error( 'convert_to_blocks_catalog_missing', __( 'The Block Catalog plugin must be active and indexed to run in catalog mode.', 'convert-to-blocks' ) );
		}

		if ( $agent->is_running() ) {
			return new \WP_Error( 'convert_to_blocks_running', __( 'Please stop the currently running migration first.', 'convert-to-blocks' ) );
		}

		$url = $agent->start(
			[
				'post_type' => $input['post_type'] ?? '',
				'per_page'  => ! empty( $input['per_page'] ) ? intval( $input['per_page'] ) : -1,
				'page'      => ! empty( $input['page'] ) ? intval( $input['page'] ) : 1,
				'only'      => $input['only'] ?? '',
				'catalog'   => ! empty( $input['catalog'] ),
			]
		);

		if ( empty( $url ) ) {
			return new \WP_Error( 'convert_to_blocks_no_posts', __( 'No posts to migrate.', 'convert-to-blocks' ) );
		}

		$status = $agent->get_status();

		return [
			'url'   => $url,
			'total' => $status['total'],
		];
	}

}
