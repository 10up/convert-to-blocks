<?php
/**
 * RESTSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * RESTSupport connects Shortcode Transformer with the REST API. This
 * runs only on the Edit Context used by Gutenberg to fetch post
 * content.
 */
class RESTSupport {

	/**
	 * Parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Flag whether on a REST request
	 *
	 * @var bool
	 */
	public $rest;

	/**
	 * Registers with the WP REST API
	 */
	public function register() {
		add_action(
			'after_setup_theme',
			[ $this, 'register_with_post_types' ]
		);

		add_action(
			'save_post',
			[ $this, 'update_post_editor' ]
		);

		add_action(
			'plugins_loaded',
			[ $this, 'on_plugins_loaded' ]
		);

		add_filter(
			'ep_skip_query_integration',
			[ $this, 'skip_ep_integration_if' ],
			1000,
			2
		);
	}

	/**
	 * TODO: Only register on REST context
	 */
	public function can_register() {
		return true;
	}

	/**
	 * Allows themes to set the registered post types dynamically.
	 */
	public function register_with_post_types() {
		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {
			if ( $this->container->post_type_supports_convert_to_blocks( $post_type ) ) {
				add_action( 'rest_prepare_' . $post_type, [ $this, 'update_response' ], 10, 3 );
			}
		}
	}

	/**
	 * If Edit Context then transforms Shortcodes in post content and
	 * returns in raw content.
	 *
	 * @param WP_Response $response REST Response
	 * @param WP_Post     $post Post to return
	 * @param WP_Request  $request REST Request
	 */
	public function update_response( $response, $post, $request ) {
		$context = $request->get_param( 'context' );

		if ( 'edit' === $context ) {
			$data = $response->get_data();
			$raw  = $data['content']['raw'] ?? '';

			$updated                = apply_filters( 'convert_to_blocks_raw_transform', $raw, $post, $request );
			$data['content']['raw'] = $updated;

			$data = apply_filters( 'convert_to_blocks_data_transform', $data, $post, $request );

			$response->set_data( $data );
		}

		return $response;
	}

	/**
	 * Gets the post types that are allowed to use Gutenberg.
	 *
	 * @return array supported post types.
	 */
	public function get_allowed_post_types() {
		return [ 'post' ];
	}

	/**
	 * Marks a Post as a Block Editor post if post save originated in
	 * Gutenberg.
	 *
	 * @param int $post_id The post to save
	 */
	public function update_post_editor( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		remove_action( 'save_post', [ $this, 'update_post_editor' ] );

		if ( $this->is_rest() ) {
			update_post_meta( $post_id, 'block_editor', true );
		} elseif ( $this->container->is_classic_post_referer() ) {
			delete_post_meta( $post_id, 'block_editor' );
		}
	}

	/**
	 * Enables REST endpoints if a User can edit posts. This allows
	 * Gutenberg blocks that pull data for that post type to work
	 * correctly.
	 *
	 * @param array  $args The post type args
	 * @param string $post_type The post type name
	 * @return array
	 */
	public function update_rest_support( $args, $post_type ) {
		if ( empty( $args['show_in_rest'] ) ) {
			$cap                  = $this->container->get_post_type_capability( $post_type );
			$args['show_in_rest'] = current_user_can( $cap );
		}

		return $args;
	}

	/* helpers */
	/**
	 * Checks if the current request is a WP REST API request.
	 *
	 * @return bool
	 */
	public function is_rest() {
		if ( is_null( $this->rest ) ) {
			$this->rest = defined( 'REST_REQUEST' ) && REST_REQUEST;
		}

		return $this->rest;
	}

	/**
	 * Sets up the rest support after all plugins loaded
	 */
	public function on_plugins_loaded() {
		add_filter(
			'register_post_type_args',
			[ $this, 'update_rest_support' ],
			10,
			2
		);
	}

	/**
	 * Disables EP integration if in the Gutenberg REST search context
	 *
	 * @param bool     $skip Default skip value
	 * @param WP_Query $query The query object
	 * @return bool
	 */
	public function skip_ep_integration_if( $skip, $query ) {
		if ( $this->is_search_context() ) {
			$query->set( 'ep_integrate', false );
			return true;
		}

		return $skip;
	}

	/**
	 * Check if we are in a REST API search context.
	 *
	 * @return bool
	 */
	public function is_search_context() {
		return $this->is_rest() &&
			isset( $_GET['search'] ); // phpcs:disable
	}

}
