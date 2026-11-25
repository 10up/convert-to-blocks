<?php
/**
 * Bootstraps the PHPUnit integration tests.
 *
 * @package convert-to-blocks
 */

define( 'TESTS_REPO_ROOT_DIR', dirname( __DIR__ ) );

// The main plugin file loads config.test.php only when this is defined.
define( 'PHPUNIT_RUNNER', true );

// Composer autoload also loads the PHPUnit Polyfills the WP test library requires.
if ( file_exists( TESTS_REPO_ROOT_DIR . '/vendor/autoload.php' ) ) {
	require_once TESTS_REPO_ROOT_DIR . '/vendor/autoload.php';
}

// Find the WordPress test library. wp-env sets WP_TESTS_DIR; wp-phpunit sets WP_PHPUNIT__DIR.
if ( false !== getenv( 'WP_TESTS_DIR' ) ) {
	$_test_root = getenv( 'WP_TESTS_DIR' );
} elseif ( false !== getenv( 'WP_DEVELOP_DIR' ) ) {
	$_test_root = getenv( 'WP_DEVELOP_DIR' ) . '/tests/phpunit';
} elseif ( false !== getenv( 'WP_PHPUNIT__DIR' ) ) {
	$_test_root = getenv( 'WP_PHPUNIT__DIR' );
} else {
	$_test_root = '/tmp/wordpress-tests-lib';
}

// Gives access to tests_add_filter().
require_once $_test_root . '/includes/functions.php';

// Load the plugin as a must-use plugin so it is active for every test.
tests_add_filter(
	'muplugins_loaded',
	static function (): void {
		require TESTS_REPO_ROOT_DIR . '/convert-to-blocks.php';
	}
);

// Start up the WP testing environment.
require $_test_root . '/includes/bootstrap.php';
