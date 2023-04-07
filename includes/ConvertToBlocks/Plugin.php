<?php
/**
 * Convert to Blocks Plugin
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * The Convert to Blocks Plugin's main class. All subclasses/modules
 * are managed from within this class. This class is used as a singleton
 * and should not be instantiated directly.
 *
 * Usage:
 *
 * ```php
 *
 * $plugin = Plugin::get_instance();
 * $plugin
 *
 * ```
 */
class Plugin {

	/**
	 * Singleton instance of the Plugin.
	 *
	 * @var Plugin Singleton Plugin instance
	 */
	public static $instance = null;

	/**
	 * Conditionally creates the singleton instance if absent, else
	 * returns the previously saved instance.
	 *
	 * @return Plugin The singleton instance
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new Plugin();
		}

		return self::$instance;
	}

	/**
	 * Plugin Assets
	 *
	 * @var Assets
	 */
	public $assets;

	/**
	 * REST API Support
	 *
	 * @var RESTSupport
	 */
	public $rest_support;

	/**
	 * Admin Menu Support
	 *
	 * @var MenuSupport
	 */
	public $menu_support;

	/**
	 * Classic Editor Support
	 *
	 * @var ClassicEditorSupport
	 */
	public $classic_editor_support;

	/**
	 * Starts the plugin by subscribing to the WordPress lifecycle
	 * hooks. Sets up the WP CLI commands if running in CLI mode.
	 */
	public function enable() {
		add_action( 'init', [ $this, 'init' ], 11 );

		add_action( 'admin_init', [ $this, 'init_admin' ] );

		/* Early registration since REST Support needs to alter registered post types */
		$this->rest_support = new RESTSupport();
		$this->register( $this->rest_support );

		if ( $this->is_wp_cli() ) {
			$this->init_commands();
		}
	}

	/* WordPress Lifecyle Hooks */

	/**
	 * Initializes the Plugin modules
	 */
	public function init() {
		$this->init_locale();

		$this->register_objects(
			[
				new RESTSupport(),
				new Settings(),
			]
		);
	}

	/**
	 * Initializes the Plugin admin modules
	 */
	public function init_admin() {
		$this->register_objects(
			[
				new PostTypeColumnSupport(),
				new ReverseMigrationSupport(),
				new RevisionSupport(),
				new ClassicEditorSupport(),
				new Assets(),
				new MigrationAgent(),
			]
		);
	}

	/**
	 * Initializes the Plugin WP CLI commands
	 */
	public function init_commands() {
		\WP_CLI::add_command( 'convert-to-blocks', '\ConvertToBlocks\MigrationCommand' );
	}

	/* Helpers */

	/**
	 * Helper method to register array of objects
	 *
	 * @param array $objects Plugin module objects
	 */
	public function register_objects( $objects ) {
		foreach ( $objects as $object ) {
			$this->register( $object );
		}
	}

	/**
	 * Helper method to register single object
	 *
	 * @param mixed $object Plugin module object
	 */
	public function register( $object ) {
		if ( $object->can_register() ) {

			if ( property_exists( $object, 'container' ) ) {
				$object->container = $this;
			}

			$object->register();
		}
	}

	/**
	 * Checks if running in WP CLI mode.
	 *
	 * @return bool True if in CLI mode else false.
	 */
	public function is_wp_cli() {
		return defined( 'WP_CLI' ) && WP_CLI;
	}

	/**
	 * Initializes Plugin Local
	 */
	public function init_locale() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'convert-to-blocks' );
		load_textdomain( 'convert-to-blocks', WP_LANG_DIR . '/convert-to-blocks/convert-to-blocks-' . $locale . '.mo' );
		load_plugin_textdomain( 'convert-to-blocks', false, plugin_basename( CONVERT_TO_BLOCKS_PLUGIN ) . '/languages/' );
	}

	/* Editor Context Helpers */

	/**
	 * Checks if the specified post type supports Convert to Blocks.
	 *
	 * @param string $post_type The post type name.
	 * @return bool
	 */
	public function post_type_supports_convert_to_blocks( $post_type ) {
		$supports                 = post_type_supports( $post_type, 'convert-to-blocks' );
		$use_defaults             = apply_filters( 'convert_to_blocks_defaults', true );
		$default_post_types       = $this->get_default_post_types();
		$user_selected_post_types = get_option( sprintf( '%s_post_types', CONVERT_TO_BLOCKS_SLUG ), $default_post_types );

		if ( ! $supports && $use_defaults && in_array( $post_type, $default_post_types, true ) ) {
			$supports = true;
		}

		// For user-selected option via the Settings UI.
		if ( false !== $user_selected_post_types ) {
			$supports = false;

			// If no post_type is selected.
			if ( empty( $user_selected_post_types ) ) {
				$supports = false;
			}

			// Check if post_type is selected by the user.
			if ( in_array( $post_type, $user_selected_post_types, true ) ) {
				$supports = true;
			}
		}

		$supports = apply_filters( 'post_type_supports_convert_to_blocks', $supports, $post_type );

		return $supports;
	}

	/**
	 * Checks if the specified post supports Convert to Blocks.
	 *
	 * @param int|WP_Post $post The post object or id.
	 * @return bool
	 */
	public function post_supports_convert_to_blocks( $post ) {
		if ( $post instanceof \WP_Post ) {
			$post_id = $post->post_id;
		} else {
			$post_id = $post;
		}

		$post_type = get_post_type( $post_id );
		$supports  = $this->post_type_supports_convert_to_blocks( $post_type );
		$supports  = apply_filters( 'post_supports_convert_to_blocks', $supports, $post_id );

		return $supports;
	}

	/**
	 * Checks if the specified post was created or updated in Gutenberg.
	 *
	 * @param int $post_id The post id.
	 * @return bool
	 */
	public function is_block_editor_post( $post_id ) {
		if ( ! $this->post_supports_convert_to_blocks( $post_id ) ) {
			return false;
		}

		$block_editor = get_post_meta( $post_id, 'block_editor', true );

		if ( ! $block_editor ) {
			$block_editor = has_blocks( $post_id );
		}

		$block_editor = filter_var( $block_editor, FILTER_VALIDATE_BOOLEAN );
		$block_editor = apply_filters( 'convert_to_blocks_is_block_editor_post', $block_editor, $post_id );

		return $block_editor;
	}

	/**
	 * Checks if the specified post was created or updated in the Classic
	 * Editor. CE is assumed if not created or updated in Block Editor.
	 *
	 * @param int $post_id The post id.
	 * @return bool
	 */
	public function is_classic_editor_post( $post_id ) {
		return ! $this->is_block_editor_post( $post_id );
	}

	/**
	 * Convert to Blocks is enabled on the following post types by default.
	 *
	 * @return array
	 */
	public function get_default_post_types() {
		return apply_filters( 'convert_to_blocks_default_post_types', CONVERT_TO_BLOCKS_DEFAULT_POST_TYPES );
	}

	/**
	 * Checks if the user is on the classic editor context.
	 *
	 * @return bool
	 */
	public function is_classic_editor_context() {
		$screen = $this->get_current_screen();

		if ( empty( $screen ) ) {
			return false;
		}

		if ( empty( $screen->post_type ) ) {
			return false;
		}

		$screen_post_type = $screen->post_type;

		if ( ! $this->post_type_supports_convert_to_blocks( $screen_post_type ) ) {
			return false;
		}

		if ( ! $this->has_classic_param() ) {
			return false;
		}

		return true;
	}

	/**
	 * Checks if the user is on the post list screen.
	 *
	 * @return bool
	 */
	public function is_post_list_context() {
		$screen = $this->get_current_screen();

		if ( empty( $screen ) ) {
			return false;
		}

		if ( empty( $screen->post_type ) ) {
			return false;
		}

		$screen_post_type = $screen->post_type;

		if ( ! $this->post_type_supports_convert_to_blocks( $screen_post_type ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns a boolean based on whether the current url has the classic
	 * editor parameter
	 *
	 * @return bool
	 */
	public function has_classic_param() {
		// phpcs:disable
		$classic = sanitize_text_field( isset( $_GET['classic'] ) ? $_GET['classic'] : '' ) ;
		// phpcs:enable
		$classic = filter_var( $classic, FILTER_VALIDATE_BOOLEAN );

		return $classic;
	}

	/**
	 * Returns the current screen object or false if too early to check.
	 *
	 * @return bool
	 */
	public function get_current_screen() {
		if ( function_exists( 'get_current_screen' ) ) {
			return get_current_screen();
		}

		return false;
	}

	/**
	 * Returns the post id of the current admin post
	 *
	 * @return int
	 */
	public function get_current_post() {
		if ( is_admin() ) {
			// phpcs:disable
			return intval( isset( $_GET['post'] ) ? $_GET['post'] : '' );
			// phpcs:enable
		} elseif ( is_singular() ) {
			return get_queried_object();
		} else {
			return false;
		}
	}

	/**
	 * Checks if the current page referer was a classic editor page
	 *
	 * @return bool
	 */
	public function is_classic_referer() {
		$referer        = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';
		$referer_params = wp_parse_args( wp_parse_url( $referer, PHP_URL_QUERY ) );
		$classic        = ! empty( $referer_params['classic'] ) ? $referer_params['classic'] : '';
		$classic        = filter_var( $classic, FILTER_VALIDATE_BOOLEAN );

		return $classic;
	}

	/**
	 * Checks if the current page referer was a classic editor page
	 *
	 * @return bool
	 */
	public function is_classic_post_referer() {
		if ( ! isset( $_SERVER['HTTP_REFERER'] ) ) {
			return false;
		}

		$referer        = $_SERVER['HTTP_REFERER'];
		$referer_params = wp_parse_args( wp_parse_url( $referer, PHP_URL_QUERY ) );
		$classic        = ! empty( $referer_params['classic'] ) ? $referer_params['classic'] : '';
		$classic        = filter_var( $classic, FILTER_VALIDATE_BOOLEAN );

		if ( $classic && ! empty( $referer_params['post'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Returns the required capability to be able to edit specified post
	 * type.
	 *
	 * @param string $post_type The post type name.
	 * @return string
	 */
	public function get_post_type_capability( $post_type ) {
		$object = get_post_type_object( $post_type );

		if ( empty( $object->cap->edit_posts ) ) {
			return 'unknown_capability';
		}

		$cap = $object->cap->edit_posts;
		$cap = apply_filters( 'convert_to_blocks_post_type_capability', $cap, $post_type );

		return $cap;
	}

}
