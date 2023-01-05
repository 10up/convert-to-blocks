<?php
/**
 * Plugin Name:       Convert to Blocks
 * Plugin URI:        https://github.com/10up/convert-to-blocks
 * Description:       Convert classic editor posts to blocks on the fly.
 * Version:           1.1.1
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * Author:            10up
 * Author URI:        https://10up.com
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
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
