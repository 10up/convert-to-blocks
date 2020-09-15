<?php
/**
 * AdminMenuSupport
 *
 * @package Gutenbridge
 */

namespace Gutenbridge;

/**
 * AdminMenuSupport adds custom Gutenbridge menu items to the WordPress
 * Admin area.
 */
class AdminMenuSupport {

	/**
	 * Parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers with the WordPress Admin hooks.
	 */
	public function register() {
		add_action( 'admin_head', [ $this, 'render_add_new_classic_button' ] );
		add_action( 'custom_menu_order', [ $this, 'update_menu_order' ] );

		$this->register_classic_menu();
	}

	/**
	 * Adds the Add New (Classic) menu item for all post types that
	 * support Gutenbridge.
	 *
	 * @return void
	 */
	public function register_classic_menu() {
		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {
			if ( $this->container->post_type_supports_gutenbridge( $post_type ) ) {
				$this->add_classic_menu( $post_type );
			}
		}
	}

	/**
	 * Updates the menu order for all post type custom menus
	 *
	 * @param array $menu_order The menu order
	 * @return array
	 */
	public function update_menu_order( $menu_order ) {
		global $submenu;

		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {
			$supports = $this->container->post_type_supports_gutenbridge( $post_type );

			if ( $supports ) {
				$submenu_key = 'post' === $post_type ? 'edit.php' : "edit.php?post_type=$post_type";

				if ( ! isset( $submenu[ $submenu_key ] ) ) {
					return $menu_order;
				}

				$post_type_submenu = $submenu[ $submenu_key ];

				$this->sort_post_type_menu( $post_type_submenu );

				// phpcs:disable
				$submenu[ $submenu_key ] = $post_type_submenu;
				// phpcs:enable;
			}
		}

		return $menu_order;
	}

	/**
	 * Adds a Classic Edit Menu item to the specified post type
	 *
	 * @param string $post_type The post type name
	 * @return false|string
	 */
	public function add_classic_menu( $post_type ) {
		$edit_page = 'post' === $post_type ?
			'edit.php' : 'edit.php?post_type=' . $post_type;

		$post_new_page     = 'post' === $post_type ? 'post-new.php' : "post-new.php?post_type=$post_type";
		$classic_edit_page = add_query_arg( [ 'classic' => 1 ], $post_new_page );

		$label = $this->get_new_classic_post_label();

		return add_submenu_page(
			$edit_page,
			$label,
			$label,
			$this->container->get_post_type_capability( $post_type ),
			$classic_edit_page
		);
	}

	/**
	 * Sorts the Post Type Menu items in a preferred sorting order.
	 *
	 * @param $array $menu_items The list of menu items to sort
	 * @return void
	 */
	public function sort_post_type_menu( &$menu_items ) {
		if ( ! $menu_items ) {
			return;
		}

		$ranks = [
			ADD_NEW_BLOCK_EDITOR_LABEL   => 10,
			ADD_NEW_CLASSIC_EDITOR_LABEL => 20,
		];

		$sorter = function( $a, $b ) use ( $ranks ) {
			$a_label = $a[0];
			$b_label = $b[0];

			if ( strpos( $a_label, 'All ' ) === 0 ) {
				$a_rank = -1;
			} else {
				$a_rank = ! empty( $ranks[ $a_label ] ) ? $ranks[ $a_label ] : 1000;
			}

			if ( strpos( $b_label, 'All ' ) === 0 ) {
				$b_rank = -1;
			} else {
				$b_rank = ! empty( $ranks[ $b_label ] ) ? $ranks[ $b_label ] : 1000;
			}

			if ( $a_rank < $b_rank ) {
				return -1;
			} elseif ( $a_rank > $b_rank ) {
				return 1;
			} else {
				return 0;
			}
		};

		usort( $menu_items, $sorter );
	}

	/**
	 * Checks if MenuSupport should be activated
	 *
	 * @return bool
	 */
	public function can_register() {
		return is_admin() || is_user_logged_in();
	}

	/**
	 * Adds "Add New(Classic)" button on posts list page. JS based as Core
	 * doesn't have a hook to do this in better way.
	 */
	public function render_add_new_classic_button() {
		if ( ! $this->container->is_post_list_context() ) {
			return;
		}

		$screen            = $this->container->get_current_screen();
		$current_post_type = $screen->post_type;

		$query_params = [ 'classic' => 1 ];

		if ( 'post' !== $current_post_type ) {
			$query_params['post_type'] = $current_post_type;
		}

		$href  = add_query_arg( $query_params, admin_url( 'post-new.php' ) );
		$title = $this->get_new_classic_post_label();

		?>
<script type="text/javascript">

( function ($) {

	function addNewClassicButton() {
		var button = $( '.wrap .page-title-action' );
		var newButton = $(
			'<a href="<?php echo esc_url( $href ); ?>" class="page-title-action page-title-action-classic">' +
				'<?php echo esc_html( $title ); ?>' +
			'</a>'
		);

		if ( button.length ) {
			button.after( newButton );
		}
	}

	$( document ).ready( addNewClassicButton );

} )( window.jQuery );

</script>
		<?php
	}

	/**
	 * Returns the label text for the Add New button for CE.
	 *
	 * @returns string
	 */
	public function get_new_classic_post_label() {
		return __( 'Add New (Classic)', 'gutenbridge' );
	}
}
