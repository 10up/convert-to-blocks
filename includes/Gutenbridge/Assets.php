<?php
/**
 * Gutenbridge JS & CSS Assets
 *
 * @package Gutenbridge
 */

namespace Gutenbridge;

/**
 * Assets is the central location to manage script & style dependencies
 * of the Gutenbridge Plugin.
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
			'gutenbridge_editor',
			plugins_url( 'dist/js/editor.js', GUTENBRIDGE_PLUGIN ),
			[
				'wp-blocks',
				'wp-element',
				'wp-data',
				'lodash',
			],
			GUTENBRIDGE_VERSION,
			true
		);

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
		wp_enqueue_script( 'gutenbridge_editor' );
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
