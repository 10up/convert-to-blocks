<?php
/**
 * Tests which post types the plugin adds to the REST API.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use WP_UnitTestCase;

/**
 * Post types registered without REST support are added to REST only for users
 * who can edit them.
 */
class RESTSupportTest extends WP_UnitTestCase {

	/**
	 * Registers a public post type and returns whether it ended up in REST.
	 *
	 * @param bool $show_in_rest The show_in_rest value the post type asks for.
	 * @return bool
	 */
	private function register_and_get_show_in_rest( $show_in_rest ) {
		register_post_type(
			'ctb_hidden',
			[
				'public'       => true,
				'show_in_rest' => $show_in_rest,
			]
		);

		return get_post_type_object( 'ctb_hidden' )->show_in_rest;
	}

	/**
	 * A logged-out visitor doesn't get a hidden post type added to REST.
	 */
	public function test_hidden_post_type_stays_out_of_rest_for_logged_out_visitors() {
		wp_set_current_user( 0 );

		$this->assertFalse( $this->register_and_get_show_in_rest( false ) );
	}

	/**
	 * A user who can't edit posts doesn't get a hidden post type added to REST.
	 */
	public function test_hidden_post_type_stays_out_of_rest_for_subscribers() {
		wp_set_current_user( self::factory()->user->create( [ 'role' => 'subscriber' ] ) );

		$this->assertFalse( $this->register_and_get_show_in_rest( false ) );
	}

	/**
	 * A post type that already asks for REST keeps it for everyone.
	 */
	public function test_post_type_in_rest_stays_in_rest() {
		wp_set_current_user( 0 );

		$this->assertTrue( $this->register_and_get_show_in_rest( true ) );
	}
}
