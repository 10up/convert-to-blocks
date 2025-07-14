<?php
/**
 * Plugin Name:       Convert to Blocks
 * Plugin URI:        https://github.com/10up/convert-to-blocks
 * Description:       Convert classic editor posts to blocks on the fly.
 * Version:           1.3.3
 * Requires at least: 6.6
 * Requires PHP:      8.0
 * Author:            10up
 * Author URI:        https://10up.com
 * License:           GPL-2.0-or-later
 * License URI:       https://spdx.org/licenses/GPL-2.0-or-later.html
 * Text Domain:       convert-to-blocks
 *
 * @package           convert-to-blocks
 */

/**
 * Small wrapper around PHP's define function. The defined constant is
 * ignored if it has already been defined. This allows the
 * config.local|test.php to override any constant in config.php.
 *
 * @param string $name The constant name
 * @param mixed  $value The constant value
 * @return void
 */
function convert_to_blocks_define( $name, $value ) {
	if ( ! defined( $name ) ) {
		define( $name, $value );
	}
}

/**
 * Gets the defined value from the config.php.
 * filters the result based on blog_id, allowing per-site over-riding of a given constant.
 *
 * @param string $name The constant name
 * @return mixed the value of the constant.
 */
function convert_to_blocks_get_setting( $name ) {
	if ( ! defined( $name ) ) {
		return false;
	}

	return apply_filters( 'convert_to_blocks_setting_' . $name, constant( $name ), \get_current_blog_id() );
}

/**
 * Get the minimum version of PHP required by this plugin.
 *
 * @since 1.2.1
 *
 * @return string Minimum version required.
 */
function convert_to_blocks_minimum_php_requirement() {
	return '8.0';
}

/**
 * Whether PHP installation meets the minimum requirements
 *
 * @since 1.2.1
 *
 * @return bool True if meets minimum requirements, false otherwise.
 */
function convert_to_blocks_site_meets_php_requirements() {
	return version_compare( phpversion(), convert_to_blocks_minimum_php_requirement(), '>=' );
}

if ( ! convert_to_blocks_site_meets_php_requirements() ) {
	add_action(
		'admin_notices',
		function() {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					echo wp_kses_post(
						sprintf(
							/* translators: %s: Minimum required PHP version */
							__( 'Convert to Blocks requires PHP version %s or later. Please upgrade PHP or disable the plugin.', 'convert-to-blocks' ),
							esc_html( convert_to_blocks_minimum_php_requirement() )
						)
					);
					?>
				</p>
			</div>
			<?php
		}
	);
	return;
}

if ( file_exists( __DIR__ . '/config.test.php' ) && defined( 'PHPUNIT_RUNNER' ) ) {
	require_once __DIR__ . '/config.test.php';
}

if ( file_exists( __DIR__ . '/config.local.php' ) ) {
	require_once __DIR__ . '/config.local.php';
}

require_once __DIR__ . '/config.php';

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	/**
	 * PSR-4-ish autoloading
	 */
	spl_autoload_register(
		function( $class ) {
				// project-specific namespace prefix.
				$prefix = 'ConvertToBlocks\\';

				// base directory for the namespace prefix.
				$base_dir = __DIR__ . '/includes/ConvertToBlocks/';

				// does the class use the namespace prefix?
				$len = strlen( $prefix );

			if ( strncmp( $prefix, $class, $len ) !== 0 ) {
				return;
			}

				$relative_class = substr( $class, $len );

				$file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

				// if the file exists, require it.
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	);
}

$plugin = \ConvertToBlocks\Plugin::get_instance();
$plugin->enable();
