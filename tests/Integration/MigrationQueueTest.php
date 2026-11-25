<?php
/**
 * Tests the bulk migration queue.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use ConvertToBlocks\MigrationAgent;
use WP_UnitTestCase;

/**
 * The queue `wp convert-to-blocks start` builds and the browser client walks.
 */
class MigrationQueueTest extends WP_UnitTestCase {

	/**
	 * The agent under test.
	 *
	 * @var MigrationAgent
	 */
	private $agent;

	/**
	 * Creates the agent.
	 */
	public function set_up() {
		parent::set_up();

		$this->agent = new MigrationAgent();
	}

	/**
	 * Only published posts of the requested type are queued, and the first
	 * client link opens the first of them.
	 */
	public function test_start_queues_only_published_posts_of_the_requested_type() {
		$published = self::factory()->post->create( [ 'post_status' => 'publish' ] );
		self::factory()->post->create( [ 'post_status' => 'draft' ] );
		self::factory()->post->create( [ 'post_status' => 'private' ] );
		self::factory()->post->create(
			[
				'post_type'   => 'page',
				'post_status' => 'publish',
			]
		);

		$link = $this->agent->start( [ 'post_type' => 'post' ] );

		$this->assertSame( [ $published ], get_option( 'ctb_posts_to_update' ), 'Only the published post is queued.' );
		$this->assertTrue( $this->agent->is_running() );
		$this->assertSame(
			add_query_arg(
				[
					'post'       => $published,
					'action'     => 'edit',
					'ctb_client' => $published,
				],
				admin_url( 'post.php' )
			),
			$link
		);
	}

	/**
	 * Each step hands out the next post's link, and stepping past the last
	 * post ends the migration.
	 */
	public function test_next_walks_the_queue_then_ends_the_migration() {
		self::factory()->post->create_many( 2, [ 'post_status' => 'publish' ] );

		$this->agent->start( [ 'post_type' => 'post' ] );
		$queue = get_option( 'ctb_posts_to_update' );

		$this->assertStringContainsString( 'ctb_client=' . $queue[1], $this->agent->next() );
		$this->assertTrue( $this->agent->is_running(), 'The migration runs until the last post is reached.' );

		$this->assertFalse( $this->agent->next() );
		$this->assertFalse( $this->agent->is_running(), 'Reaching the end of the queue ends the migration.' );
	}

	/**
	 * Stopping clears the queue so the next start begins from scratch.
	 */
	public function test_stop_clears_the_queue() {
		self::factory()->post->create( [ 'post_status' => 'publish' ] );
		$this->agent->start( [ 'post_type' => 'post' ] );

		$this->agent->stop();

		$this->assertFalse( $this->agent->is_running() );
		$this->assertSame( [], get_option( 'ctb_posts_to_update' ) );
		$this->assertSame( -1, get_option( 'ctb_cursor' ) );
	}

	/**
	 * With nothing to migrate, start reports failure and doesn't mark a
	 * migration as running.
	 */
	public function test_start_with_nothing_to_migrate_does_not_run() {
		self::factory()->post->create( [ 'post_status' => 'draft' ] );

		$this->assertFalse( $this->agent->start( [ 'post_type' => 'post' ] ) );
		$this->assertFalse( $this->agent->is_running() );
	}
}
