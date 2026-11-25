<?php
/**
 * Tests the supported post types setting.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use ConvertToBlocks\Settings;
use WP_UnitTestCase;

/**
 * The setting is read with in_array(), so it must always be saved as an array.
 */
class SettingsTest extends WP_UnitTestCase {

	/**
	 * Option holding the post types selected on the settings screen.
	 */
	const OPTION = 'convert-to-blocks_post_types';

	/**
	 * Registers the setting the way the settings screen does.
	 */
	public function set_up() {
		parent::set_up();

		require_once ABSPATH . 'wp-admin/includes/template.php';

		$settings = new Settings();
		$settings->init();
		$settings->register_fields();
	}

	/**
	 * A value that isn't a list of post types is saved as an empty list.
	 */
	public function test_non_array_value_is_saved_as_an_empty_list() {
		update_option( self::OPTION, 'post' );

		$this->assertSame( [], get_option( self::OPTION ) );
	}

	/**
	 * Each selected post type is saved as plain text.
	 */
	public function test_selected_post_types_are_saved_as_plain_text() {
		update_option( self::OPTION, [ 'page', '<b>post</b>' ] );

		$this->assertSame( [ 'page', 'post' ], get_option( self::OPTION ) );
	}
}
