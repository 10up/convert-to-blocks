<?php
/**
 * AdminBarMenuSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * AdminBarMenuSupport adds custom Connect to Blocks Menu items items to the
 * WordPress Admin Bar.
 */
class AdminBarMenuSupport {

	/**
	 * Parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers the admin bar support with WordPress.
	 */
	public function register() {
		add_action( 'admin_bar_menu', [ $this, 'add_switch_menu' ], 1000 );
		add_action( 'admin_bar_menu', [ $this, 'update_edit_menu' ], 1000 );
	}

	/**
	 * Only run if user is logged in to WordPress.
	 */
	public function can_register() {
		return is_user_logged_in();
	}

	/**
	 * Adds the Switching Menu Item to the Admin Bar
	 */
	public function add_switch_menu() {
		$post = $this->container->get_current_post();

		if ( ! is_admin() ) {
			return;
		}

		if ( empty( $post ) ) {
			return;
		}

		if ( ! $this->container->post_supports_convert_to_blocks( $post ) ) {
			return;
		}

		global $wp_admin_bar;
		$classic = $this->container->has_classic_param();

		$menu = [
			'id'    => 'switch_editor',
			'title' => $classic ? SWITCH_TO_BLOCK_EDITOR_LABEL : SWITCH_TO_CLASSIC_EDITOR_LABEL,
			'href'  => $classic ? remove_query_arg( 'classic' ) : add_query_arg( [ 'classic' => 1 ] ),
		];

		$wp_admin_bar->add_menu( $menu );
	}

	/**
	 * Adds the Edit in Classic menu item to the Admin Bar
	 *
	 * @return void
	 */
	public function update_edit_menu() {
		if ( is_admin() ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = $this->container->get_current_post();

		if ( empty( $post ) ) {
			return;
		}

		if ( ! $this->container->post_supports_convert_to_blocks( $post ) ) {
			return;
		}

		global $wp_admin_bar;

		$post_type = $post->post_type;
		$post_id   = $post->ID;

		$menu = [
			'id'     => 'edit_classic',
			'title'  => '<span class="ab-item edit-post-in-classic"></span>' . sprintf(
				/* translators: Context is: "Edit ${Post Type Singular Name} (Classic)" */
				__( 'Edit %s (Classic)', 'smartertravel' ),
				get_post_type_labels( get_post_type_object( $post_type ) )->singular_name
			),
			'href'   => add_query_arg( [ 'classic' => 1 ], get_edit_post_link( $post_id ) ),
			'parent' => 'edit',
		];

		$wp_admin_bar->add_menu( $menu );
		echo '<style>#wpadminbar .edit-post-in-classic::before { content: "\f321"; }</style>';
	}

}
