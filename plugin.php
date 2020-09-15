<?php
/**
 * Plugin Name: Gutenbridge
 * Description: Gutenberg Migration Support
 * Version:     1.0
 * Author:      Darshan Sawardekar, Taylor Lovett, 10up
 * Author URI:  https://10up.com
 * Text Domain: gutenbridge
 * Domain Path: /languages
 *
 * @package Gutenbridge
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
function gutenbridge_define( $name, $value ) {
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
function gutenbridge_get_setting( $name ) {
	if ( ! defined( $name ) ) {
		return false;
	}

	return apply_filters( 'gutenbridge_setting_' . $name, constant( $name ), \get_current_blog_id() );
}

if ( file_exists( __DIR__ . '/config.test.php' ) && defined( 'PHPUNIT_RUNNER' ) ) {
	require_once __DIR__ . '/config.test.php';
}

if ( file_exists( __DIR__ . '/config.local.php' ) ) {
	require_once __DIR__ . '/config.local.php';
}

require_once __DIR__ . '/config.php';

/**
 * Loads the Gutenbridge PHP autoloader if possible.
 *
 * @return bool True or false if autoloading was successfull.
 */
function gutenbridge_autoload() {
	if ( gutenbridge_can_autoload() ) {
		require_once gutenbridge_autoloader();

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
function gutenbridge_can_autoload() {
	if ( file_exists( gutenbridge_autoloader() ) ) {
		return true;
	} else {
		// phpcs:disable
		error_log(
			"Fatal Error: Composer not setup in " . GUTENBRIDGE_DIR // only used for local debugging
		);
		// phpcs:enable
		return false;
	}
}

/**
 * Default is Composer's autoloader
 */
function gutenbridge_autoloader() {
	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		return GUTENBRIDGE_DIR . '/vendor/autoload.php';
	} else {
		return GUTENBRIDGE_DIR . '/autoload.php';
	}
}

/**
 * Plugin code entry point. Singleton instance is used to maintain a common single
 * instance of the plugin throughout the current request's lifecycle.
 *
 * If autoloading failed an admin notice is shown and logged to
 * the PHP error_log.
 */
function gutenbridge_autorun() {
	if ( gutenbridge_autoload() ) {
		$plugin = \Gutenbridge\Plugin::get_instance();
		$plugin->enable();
	} else {
		add_action( 'admin_notices', 'gutenbridge_autoload_notice' );
	}
}

/**
 * Displays an admin notice if composer install was not run
 */
function gutenbridge_autoload_notice() {
	$class   = 'notice notice-error';
	$message = 'Error: Please run $ composer install in the Gutenbridge plugin directory.';

	printf( '<div class="%1$s"><p>%2$s</p></div>', sanitize_html_class( $class ), esc_html( $message ) );
	// phpcs:disable
	error_log( $message ); // only used for local debugging
	// phpcs:enable
}

gutenbridge_autorun();

