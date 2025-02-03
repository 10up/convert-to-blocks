<?php
/**
 * Convert to Blocks configuration
 *
 * @package convert-to-blocks
 */

$plugin_version = '1.3.2';

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

/* Labels */

/* Block Editor text label */
convert_to_blocks_define( 'SWITCH_TO_BLOCK_EDITOR_LABEL', __( 'Switch to Block Editor', 'convert-to-blocks' ) );

/* Classic Editor text label */
convert_to_blocks_define( 'SWITCH_TO_CLASSIC_EDITOR_LABEL', __( 'Switch to Classic Editor', 'convert-to-blocks' ) );

/* Add/Edit Labels */
convert_to_blocks_define( 'EDIT_IN_CLASSIC_EDITOR_LABEL', __( 'Edit (Classic)', 'convert-to-blocks' ) );
convert_to_blocks_define( 'ADD_NEW_CLASSIC_EDITOR_LABEL', __( 'Add New (Classic)', 'convert-to-blocks' ) );
convert_to_blocks_define( 'ADD_NEW_BLOCK_EDITOR_LABEL', __( 'Add New', 'convert-to-blocks' ) );

/* Block & Classic Editor Labels */
convert_to_blocks_define( 'BLOCK_EDITOR_LABEL', __( 'Block Editor', 'convert-to-blocks' ) );
convert_to_blocks_define( 'CLASSIC_EDITOR_LABEL', __( 'Classic Editor', 'convert-to-blocks' ) );
convert_to_blocks_define( 'EDITOR_COLUMN_LABEL', __( 'Editor', 'convert-to-blocks' ) );
