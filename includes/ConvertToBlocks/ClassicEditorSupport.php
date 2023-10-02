<?php
/**
 * Classic Editor Support
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * ClassicEditorSupport Manages context switching between Classic &
 * Block editors. This is a just-in-time check and allows Convert to Blocks to
 * be selectively disabled on a single post or post type.
 *
 * Props: https://github.com/WordPress/classic-editor/blob/master/classic-editor.php
 */
class ClassicEditorSupport {

	/**
	 * Parent plugin object
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Register CE hooks with WordPress
	 */
	public function register() {
		add_action( 'use_block_editor_for_post', [ $this, 'enable_block_editor' ], 10, 2 );
	}

	/**
	 * Only registers on admin context.
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * Disables the block editor if classic parameter is specified
	 *
	 * @param bool    $enabled The enabled state
	 * @param WP_Post $post The current post
	 * @return bool
	 */
	public function enable_block_editor( $enabled, $post ) {
		if ( $this->container->has_classic_param() ) {
			return false;
		}

		if ( $this->container->post_supports_convert_to_blocks( $post ) ) {
			return true;
		}

		return $enabled;
	}

}
