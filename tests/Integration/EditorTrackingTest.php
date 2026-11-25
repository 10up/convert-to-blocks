<?php
/**
 * Tests how the plugin tracks which editor a post was last saved in.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use ConvertToBlocks\Plugin;
use ConvertToBlocks\RESTSupport;
use WP_UnitTestCase;

/**
 * The `block_editor` post meta drives the Editor column and the warning shown
 * when a block editor post is opened in the classic editor.
 */
class EditorTrackingTest extends WP_UnitTestCase {

	/**
	 * Classic editor markup, without block delimiters.
	 */
	const CLASSIC_CONTENT = '<p>Classic paragraph</p>';

	/**
	 * Block editor markup.
	 */
	const BLOCK_CONTENT = '<!-- wp:paragraph --><p>Block paragraph</p><!-- /wp:paragraph -->';

	/**
	 * Clears the request state the tests set.
	 */
	public function tear_down() {
		unset( $_SERVER['HTTP_REFERER'] );

		parent::tear_down();
	}

	/**
	 * Creates a classic post marked as last saved in the block editor.
	 *
	 * Meta is added after the post is created: the save handler runs once per
	 * request, so the next save is the one the test makes.
	 *
	 * @return int The post ID.
	 */
	private function create_block_editor_post() {
		$post_id = self::factory()->post->create( [ 'post_content' => self::CLASSIC_CONTENT ] );
		update_post_meta( $post_id, 'block_editor', '1' );

		$support            = new RESTSupport();
		$support->container = Plugin::get_instance();
		$support->register();

		return $post_id;
	}

	/**
	 * Saving from the classic editor clears the block editor mark.
	 */
	public function test_save_from_classic_editor_clears_block_editor_mark() {
		$post_id                 = $this->create_block_editor_post();
		$_SERVER['HTTP_REFERER'] = admin_url( "post.php?post={$post_id}&action=edit&classic=1" );

		wp_update_post(
			[
				'ID'         => $post_id,
				'post_title' => 'Saved in the classic editor',
			]
		);

		$this->assertSame( '', get_post_meta( $post_id, 'block_editor', true ) );
	}

	/**
	 * Saving from anywhere other than the classic editor keeps the mark.
	 */
	public function test_save_from_other_screens_keeps_block_editor_mark() {
		$post_id                 = $this->create_block_editor_post();
		$_SERVER['HTTP_REFERER'] = admin_url( "post.php?post={$post_id}&action=edit" );

		wp_update_post(
			[
				'ID'         => $post_id,
				'post_title' => 'Saved elsewhere',
			]
		);

		$this->assertSame( '1', get_post_meta( $post_id, 'block_editor', true ) );
	}

	/**
	 * A post counts as a block editor post when it is marked as one or its
	 * content has blocks, and as a classic post otherwise.
	 */
	public function test_block_editor_post_is_detected_by_mark_or_blocks() {
		$plugin = Plugin::get_instance();

		$marked = self::factory()->post->create( [ 'post_content' => self::CLASSIC_CONTENT ] );
		update_post_meta( $marked, 'block_editor', '1' );
		$blocks  = self::factory()->post->create( [ 'post_content' => self::BLOCK_CONTENT ] );
		$classic = self::factory()->post->create( [ 'post_content' => self::CLASSIC_CONTENT ] );

		$this->assertTrue( $plugin->is_block_editor_post( $marked ), 'The mark makes a post a block editor post.' );
		$this->assertTrue( $plugin->is_block_editor_post( $blocks ), 'Block content makes a post a block editor post.' );
		$this->assertFalse( $plugin->is_block_editor_post( $classic ), 'Unmarked classic content is a classic post.' );
	}
}
