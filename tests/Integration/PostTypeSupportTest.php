<?php
/**
 * Tests which post types and posts the plugin supports.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use ConvertToBlocks\Plugin;
use WP_UnitTestCase;

/**
 * Support decides which posts are forced into the block editor and converted.
 */
class PostTypeSupportTest extends WP_UnitTestCase {

	/**
	 * Option holding the post types selected on the settings screen.
	 */
	const OPTION = 'convert-to-blocks_post_types';

	/**
	 * The plugin instance.
	 *
	 * @var Plugin
	 */
	private $plugin;

	/**
	 * Registers a public post type that doesn't declare support.
	 */
	public function set_up() {
		parent::set_up();

		register_post_type( 'ctb_book', [ 'public' => true ] );

		$this->plugin = Plugin::get_instance();
	}

	/**
	 * Until the setting is saved, posts and pages are supported and other
	 * post types aren't.
	 */
	public function test_posts_and_pages_are_supported_by_default() {
		delete_option( self::OPTION );

		$this->assertTrue( $this->plugin->post_type_supports_convert_to_blocks( 'post' ) );
		$this->assertTrue( $this->plugin->post_type_supports_convert_to_blocks( 'page' ) );
		$this->assertFalse( $this->plugin->post_type_supports_convert_to_blocks( 'ctb_book' ) );
	}

	/**
	 * The saved setting decides which post types are supported.
	 */
	public function test_saved_setting_decides_support() {
		update_option( self::OPTION, [ 'page', 'ctb_book' ] );

		$this->assertFalse( $this->plugin->post_type_supports_convert_to_blocks( 'post' ) );
		$this->assertTrue( $this->plugin->post_type_supports_convert_to_blocks( 'page' ) );
		$this->assertTrue( $this->plugin->post_type_supports_convert_to_blocks( 'ctb_book' ) );
	}

	/**
	 * Saving the setting with nothing selected turns support off everywhere.
	 */
	public function test_empty_saved_setting_supports_nothing() {
		update_option( self::OPTION, [] );

		$this->assertFalse( $this->plugin->post_type_supports_convert_to_blocks( 'post' ) );
		$this->assertFalse( $this->plugin->post_type_supports_convert_to_blocks( 'page' ) );
	}

	/**
	 * The post type filter has the last word over the saved setting.
	 */
	public function test_post_type_filter_overrides_the_setting() {
		update_option( self::OPTION, [ 'page' ] );
		add_filter(
			'post_type_supports_convert_to_blocks',
			static function ( $supports, $post_type ) {
				return 'ctb_book' === $post_type;
			},
			10,
			2
		);

		$this->assertTrue( $this->plugin->post_type_supports_convert_to_blocks( 'ctb_book' ) );
		$this->assertFalse( $this->plugin->post_type_supports_convert_to_blocks( 'page' ) );
	}

	/**
	 * The per-post filter can turn support off for one post of a supported
	 * post type.
	 */
	public function test_post_filter_overrides_support_for_one_post() {
		delete_option( self::OPTION );
		$excluded = self::factory()->post->create();
		$included = self::factory()->post->create();

		add_filter(
			'post_supports_convert_to_blocks',
			static function ( $supports, $post_id ) use ( $excluded ) {
				return $excluded === $post_id ? false : $supports;
			},
			10,
			2
		);

		$this->assertFalse( $this->plugin->post_supports_convert_to_blocks( $excluded ) );
		$this->assertTrue( $this->plugin->post_supports_convert_to_blocks( $included ) );
	}
}
