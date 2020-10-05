<?php
/**
 * Plugin Name:       Convert to Blocks
 * Plugin URI:        https://github.com/10up/convert-to-blocks
 * Description:       Convert classic editor posts to blocks on the fly.
 * Version:           1.0.0
 * Requires at least: 5.4
 * Requires PHP:      7.0
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

/**
 * Loads the Convert to Blocks PHP autoloader if possible.
 *
 * @return bool True or false if autoloading was successfull.
 */
function convert_to_blocks_autoload() {
	if ( convert_to_blocks_can_autoload() ) {
		require_once convert_to_blocks_autoloader();

		return true;
	} else {
		return false;
	}
}

/**
 * In server mode we can autoload if autoloader file exists. For
 * test environments we prevent autoloading of the plugin to prevent
 * global pollution and for better performance.
 */
function convert_to_blocks_can_autoload() {
	if ( file_exists( convert_to_blocks_autoloader() ) ) {
		return true;
	} else {
		// phpcs:disable
		error_log(
			"Fatal Error: Composer not setup in " . CONVERT_TO_BLOCKS_DIR // only used for local debugging
		);
		// phpcs:enable
		return false;
	}
}

/**
 * Default is Composer's autoloader
 */
function convert_to_blocks_autoloader() {
	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		return CONVERT_TO_BLOCKS_DIR . '/vendor/autoload.php';
	} else {
		return CONVERT_TO_BLOCKS_DIR . '/autoload.php';
	}
}

/**
 * Plugin code entry point. Singleton instance is used to maintain a common single
 * instance of the plugin throughout the current request's lifecycle.
 *
 * If autoloading failed an admin notice is shown and logged to
 * the PHP error_log.
 */
function convert_to_blocks_autorun() {
	if ( convert_to_blocks_autoload() ) {
		$plugin = \ConvertToBlocks\Plugin::get_instance();
		$plugin->enable();
	} else {
		add_action( 'admin_notices', 'convert_to_blocks_autoload_notice' );
	}
}

/**
 * Displays an admin notice if composer install was not run
 */
function convert_to_blocks_autoload_notice() {
	$class   = 'notice notice-error';
	$message = 'Error: Please run $ composer install in the Convert to Blocks plugin directory.';

	printf( '<div class="%1$s"><p>%2$s</p></div>', sanitize_html_class( $class ), esc_html( $message ) );
	// phpcs:disable
	error_log( $message ); // only used for local debugging
	// phpcs:enable
}

convert_to_blocks_autorun();
