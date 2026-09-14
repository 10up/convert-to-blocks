<?php

namespace ConvertToBlocks;

class MigrationAgentTest extends \WP_UnitTestCase {

	public $agent;

	function setUp(): void {
		parent::setUp();
		$this->agent = new MigrationAgent();
	}

	function test_get_posts_to_update_returns_only_specified_ids() {
		$post_id  = self::factory()->post->create( [ 'post_status' => 'publish' ] );
		$page_id  = self::factory()->post->create( [ 'post_type' => 'page', 'post_status' => 'publish' ] );
		$extra_id = self::factory()->post->create( [ 'post_status' => 'publish' ] );

		$posts = $this->agent->get_posts_to_update( [ 'only' => "$post_id,$page_id" ] );

		$this->assertContains( $post_id, $posts );
		$this->assertContains( $page_id, $posts );
		$this->assertNotContains( $extra_id, $posts );
	}

	function test_get_posts_to_update_includes_custom_post_types_when_using_only() {
		register_post_type( 'ctb_test_cpt', [ 'public' => true ] );

		$post_id = self::factory()->post->create( [ 'post_status' => 'publish' ] );
		$cpt_id  = self::factory()->post->create( [ 'post_type' => 'ctb_test_cpt', 'post_status' => 'publish' ] );

		$posts = $this->agent->get_posts_to_update( [ 'only' => "$post_id,$cpt_id" ] );

		$this->assertContains( $post_id, $posts );
		$this->assertContains( $cpt_id, $posts, '--only should include custom post type IDs' );

		unregister_post_type( 'ctb_test_cpt' );
	}

	function test_get_posts_to_update_without_only_excludes_custom_post_types_by_default() {
		register_post_type( 'ctb_test_cpt', [ 'public' => true ] );

		$post_id = self::factory()->post->create( [ 'post_status' => 'publish' ] );
		$cpt_id  = self::factory()->post->create( [ 'post_type' => 'ctb_test_cpt', 'post_status' => 'publish' ] );

		$posts = $this->agent->get_posts_to_update( [] );

		$this->assertContains( $post_id, $posts );
		$this->assertNotContains( $cpt_id, $posts, 'default query should not include custom post types' );

		unregister_post_type( 'ctb_test_cpt' );
	}


}
