<?php
/**
 * Convert to Blocks configuration
 *
 * @package convert-to-blocks
 */

$plugin_version = '1.3.3';

if ( file_exists( __DIR__ . '/.commit' ) ) {
	// phpcs:disable
	$plugin_version .= '-' . file_get_contents( __DIR__ . '/.commit' );
	// phpcs:enable
}

convert_to_blocks_define( 'CONVERT_TO_BLOCKS_PLUGIN', __DIR__ . '/plugin.php' );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_VERSION', $plugin_version );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_URL', plugin_dir_url( __FILE__ ) );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_SLUG', 'convert-to-blocks' );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_DEFAULT_POST_TYPES', [ 'post', 'page' ] );
convert_to_blocks_define( 'CONVERT_TO_BLOCKS_PLUGIN_BASENAME', plugin_basename( __DIR__ . '/convert-to-blocks.php' ) );
