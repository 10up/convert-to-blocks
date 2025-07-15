<?php
/**
 * Settings UI
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * UI for configuring plugin settings.
 */
class Settings {

	/**
	 * User permissions to manage settings.
	 *
	 * @var string
	 */
	private $capability = 'manage_options';

	/**
	 * Settings page slug.
	 *
	 * @var string
	 */
	private $settings_page = 'settings-page';

	/**
	 * Settings section name.
	 *
	 * @var string
	 */
	private $settings_section = 'settings-section';

	/**
	 * Settings group name.
	 *
	 * @var string
	 */
	private $settings_group = 'settings';

	/**
	 * Post types.
	 *
	 * @var array
	 */
	private $post_types = [];

	/**
	 * Register hooks with WordPress
	 */
	public function register() {
		// Configure variables and get post types.
		$this->init();

		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_init', [ $this, 'register_section' ], 10 );
		add_action( 'admin_init', [ $this, 'register_fields' ], 20 );
		add_action( 'admin_notices', [ $this, 'filter_notice' ], 10 );
		add_filter( 'plugin_action_links_' . CONVERT_TO_BLOCKS_PLUGIN_BASENAME, [ $this, 'add_settings_link' ] );
	}

	/**
	 * Only registers on admin context.
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * Configures variables and fetches post types.
	 *
	 * @return void
	 */
	public function init() {
		// Configure variables.
		$this->settings_page    = sprintf( '%s-%s', CONVERT_TO_BLOCKS_SLUG, $this->settings_page );
		$this->settings_section = sprintf( '%s-%s', CONVERT_TO_BLOCKS_SLUG, $this->settings_section );
		$this->settings_group   = sprintf( '%s_%s', CONVERT_TO_BLOCKS_SLUG, $this->settings_group );

		// Get post types.
		$this->post_types = $this->get_post_types();
	}

	/**
	 * Retrieves all public post types.
	 *
	 * @return array
	 */
	public function get_post_types() {
		$post_types = get_post_types(
			[ 'public' => true ]
		);

		if ( ! empty( $post_types['attachment'] ) ) {
			unset( $post_types['attachment'] );
		}

		return $post_types;
	}

	/**
	 * Adds a submenu item for the `Settings` menu.
	 *
	 * @return void
	 */
	public function add_menu() {
		add_options_page(
			esc_html__( 'Convert to Blocks', 'convert-to-blocks' ),
			esc_html__( 'Convert to Blocks', 'convert-to-blocks' ),
			$this->capability,
			CONVERT_TO_BLOCKS_SLUG,
			[ $this, 'settings_page' ]
		);
	}

	/**
	 * Registers the settings page.
	 *
	 * @return void
	 */
	public function settings_page() {
		?>
		<div class="wrap">
			<h1>
				<?php esc_html_e( 'Convert to Blocks', 'convert-to-blocks' ); ?>
			</h1>
			<hr>

			<p>
				<?php esc_html_e( 'Configure plugin by selecting the supported post types.', 'convert-to-blocks' ); ?>
			</p>

			<form method="post" action="options.php">
				<?php
				settings_fields( $this->settings_group );
				do_settings_sections( CONVERT_TO_BLOCKS_SLUG );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Registers section for the settings page.
	 *
	 * @return void
	 */
	public function register_section() {
		add_settings_section(
			$this->settings_section,
			false,
			false,
			CONVERT_TO_BLOCKS_SLUG
		);
	}

	/**
	 * Registers setting fields.
	 *
	 * @return void
	 */
	public function register_fields() {
		// Supported post types.
		add_settings_field(
			sprintf( '%s_post_types', CONVERT_TO_BLOCKS_SLUG ),
			esc_html__( 'Supported Post Types', 'convert-to-blocks' ),
			[ $this, 'field_post_types' ],
			CONVERT_TO_BLOCKS_SLUG,
			$this->settings_section,
			[
				'label_for' => sprintf( '%s_post_types', CONVERT_TO_BLOCKS_SLUG ),
			]
		);

		register_setting(
			$this->settings_group,
			sprintf( '%s_post_types', CONVERT_TO_BLOCKS_SLUG ),
			[
				'sanitize_callback' => [ $this, 'sanitize_post_types' ],
			]
		);
	}

	/**
	 * Renders the `post_types` field.
	 *
	 * @return void
	 */
	public function field_post_types() {
		$post_types  = get_option(
			sprintf( '%s_post_types', CONVERT_TO_BLOCKS_SLUG ),
			Plugin::get_instance()->get_default_post_types()
		);
		$output_html = '';

		foreach ( $this->post_types as $post_type ) {
			$output_html .= sprintf(
				'<label for="%1$s"><input name="%2$s[]" type="checkbox" %3$s id="%1$s" value="%4$s"> %5$s</label> <br>',
				sprintf( '%s_post_types_%s', esc_attr( CONVERT_TO_BLOCKS_SLUG ), esc_attr( $post_type ) ),
				sprintf( '%s_post_types', esc_attr( CONVERT_TO_BLOCKS_SLUG ) ),
				checked( in_array( $post_type, $post_types, true ), 1, false ),
				esc_attr( $post_type ),
				esc_attr( ucfirst( $post_type ) )
			);
		}
		?>
		<fieldset>
			<?php echo $output_html; // phpcs:ignore ?>
		</fieldset>
		<?php
	}

	/**
	 * Sanitizes post_types values.
	 *
	 * @param array $input Array containing checked values.
	 *
	 * @return array Sanitized array.
	 */
	public function sanitize_post_types( $input ) {
		if ( ! is_array( $input ) ) {
			return [];
		}

		return array_map( 'sanitize_text_field', $input );
	}

	/**
	 * Adds an admin notice if a filter is active for `post_type_supports_convert_to_blocks` as
	 * this might overwrite the outcome of the settings stored in DB.
	 */
	public function filter_notice() {
		if ( ! has_filter( 'post_type_supports_convert_to_blocks' ) ) {
			return;
		}

		$show_on_pages = array(
			'settings_page_convert-to-blocks',
			'plugins',
		);

		$screen = get_current_screen();

		if ( is_null( $screen ) ) {
			return;
		}

		if ( ! ( ! empty( $screen->post_type ) || in_array( $screen->id, $show_on_pages, true ) ) ) {
			return;
		}

		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( 'A filter hook (post_type_supports_convert_to_blocks) is already active.', 'convert-to-blocks' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Adds Settings link to the plugin list.
	 *
	 * @param array $links Array of links.
	 * @return mixed
	 */
	public function add_settings_link( $links ): mixed {
		if ( ! is_array( $links ) ) {
			return $links;
		}

		$action_links = [
			'settings' => sprintf(
				'<a href="%s">%s</a>',
				esc_url(
					add_query_arg(
						[
							'page' => CONVERT_TO_BLOCKS_SLUG,
						],
						admin_url( 'options-general.php' )
					)
				),
				esc_html__( 'Settings', 'convert-to-blocks' )
			),
		];

		return array_merge( $action_links, $links );
	}
}
