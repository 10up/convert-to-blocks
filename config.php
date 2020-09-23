<?php
/**
 * Gutenbridge configuration
 *
 * @package Gutenbridge
 */

$plugin_version = '0.1.0';

if ( file_exists( __DIR__ . '/.commit' ) ) {
	// phpcs:disable
	$plugin_version .= '-' . file_get_contents( __DIR__ . '/.commit' );
	// phpcs:enable
}

gutenbridge_define( 'GUTENBRIDGE_PLUGIN', __DIR__ . '/gutenbridge.php' );
gutenbridge_define( 'GUTENBRIDGE_VERSION', $plugin_version );
gutenbridge_define( 'GUTENBRIDGE_DIR', plugin_dir_path( __FILE__ ) );
gutenbridge_define( 'GUTENBRIDGE_URL', plugin_dir_url( __FILE__ ) );

/* Labels */

/* Block Editor text label */
gutenbridge_define( 'SWITCH_TO_BLOCK_EDITOR_LABEL', __( 'Switch to Block Editor', 'gutenbridge' ) );

/* Classic Editor text label */
gutenbridge_define( 'SWITCH_TO_CLASSIC_EDITOR_LABEL', __( 'Switch to Classic Editor', 'gutenbridge' ) );

/* Add/Edit Labels */
gutenbridge_define( 'EDIT_IN_CLASSIC_EDITOR_LABEL', __( 'Edit (Classic)', 'gutenbridge' ) );
gutenbridge_define( 'ADD_NEW_CLASSIC_EDITOR_LABEL', __( 'Add New (Classic)', 'gutenbridge' ) );
gutenbridge_define( 'ADD_NEW_BLOCK_EDITOR_LABEL', __( 'Add New', 'gutenbridge' ) );

/* Block & Classic Editor Labels */
gutenbridge_define( 'BLOCK_EDITOR_LABEL', __( 'Block Editor', 'gutenbridge' ) );
gutenbridge_define( 'CLASSIC_EDITOR_LABEL', __( 'Classic Editor', 'gutenbridge' ) );
gutenbridge_define( 'EDITOR_COLUMN_LABEL', __( 'Editor', 'gutenbridge' ) );
