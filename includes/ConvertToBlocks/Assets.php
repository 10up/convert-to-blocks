<?php
/**
 * JS & CSS Assets
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * Assets is the central location to manage script & style dependencies
 * of the plugin.
 */
class Assets {

	/**
	 * Flag stores whether the assets have been registered with WordPress
	 *
	 * @var bool
	 */
	public $registered = false;

	/**
	 * Registers the scripts and styles of the Plugin.
	 */
	public function register() {
		wp_register_script(
			'convert_to_blocks_editor',
			plugins_url( 'build/editor.js', CONVERT_TO_BLOCKS_PLUGIN ),
			[
				'wp-blocks',
				'wp-element',
				'wp-data',
				'lodash',
			],
			CONVERT_TO_BLOCKS_VERSION,
			true
		);

		$localised_data = array(
			/**
			 * Use this filter to change the post save delay in milliseconds when
			 * running the `wp convert-to-blocks start` command.
			 *
			 * The delay is helpful when gallery blocks don't convert properly.
			 */
			'post_save_delay' => apply_filters( 'convert_to_blocks_post_save_delay', 1000 ),
		);

		wp_add_inline_script( 'convert_to_blocks_editor', 'const convertToBlocks = ' . wp_json_encode( $localised_data ) . ';' );

		add_action(
			'enqueue_block_editor_assets',
			[ $this, 'do_assets' ],
			1000
		);
	}

	/**
	 * Enqueues the Scripts & Styles for the Smarter Travel Gutenberg
	 * Migration Plugin.
	 */
	public function do_assets() {
		wp_enqueue_script( 'convert_to_blocks_editor' );
	}

	/**
	 * Checks if the current request needs Gutenberg Migration Assets.
	 * Only checks for Admin here because the Screen hasn't initialized
	 * yet.
	 *
	 * @return bool
	 */
	public function can_register() {
		return is_admin();
	}

	/* helpers */

	/**
	 * Checks if current screen is for the Block Editor. Duck typed for
	 * unit testing.
	 *
	 * Props: wp-includes/script-loader.php
	 */
	public function is_block_editor() {
		global $current_screen;

		return ! empty( $current_screen ) &&
			is_object( $current_screen ) &&
			method_exists( $current_screen, 'is_block_editor' ) &&
			$current_screen->is_block_editor();
	}

}
