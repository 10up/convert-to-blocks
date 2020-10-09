<?php
/**
 * PostTypeRowActionSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * PostTypeRowActionSupport add support for a custom row actions to the
 * Post Edit screen. The Edit in Classic Editor link takes the user to
 * the Classic Editor.
 */
class PostTypeRowActionSupport {

	/**
	 * The parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers the row action support with WordPress
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'post_row_actions', [ $this, 'register_post_row_menu' ], 1000, 2 );
		add_action( 'page_row_actions', [ $this, 'register_post_row_menu' ], 1000, 2 );
	}

	/**
	 * Only register if on the post list screen.
	 *
	 * @return bool
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * Registers the Post Type Post Row Menu items
	 *
	 * @param array   $actions The row actions
	 * @param WP_Post $post The post object
	 * @return array
	 */
	public function register_post_row_menu( $actions, $post ) {
		$post_id = $post->post_id;
		error_log( 'register_post_row_menu: ' . $post_id );

		if ( ! $this->container->post_supports_convert_to_blocks( $post_id ) ) {
			return $actions;
		}

		$post_type         = $post->post_type;
		$edit_link         = get_edit_post_link( $post );
		$edit_classic_link = add_query_arg( [ 'classic' => 1 ], $edit_link );
		$edit_position     = array_search( 'edit', $actions, true );

		// phpcs:disable
		$classic_menu_item = [
			'edit_classic' => '<a href="' . esc_url( $edit_classic_link ) . '">' .
				__( EDIT_IN_CLASSIC_EDITOR_LABEL, 'convert-to-blocks' ) . '</a>',
		];
		// phpcs:enable

		array_splice( $actions, $edit_position + 1, 0, $classic_menu_item );

		return $actions;
	}

}
