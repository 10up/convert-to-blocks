<?php

namespace Gutenbridge;

class AdminBarMenuSupportTest extends \WP_UnitTestCase {

	public $support;

	function setUp() {
		parent::setUp();

		$this->support            = new AdminBarMenuSupport();
		$this->support->container = $this;
	}

	function test_it_has_a_container() {
		$this->assertNotEmpty( $this->support->container );
		$this->assertSame( $this, $this->support->container );
	}

	function test_it_will_not_register_if_not_logged_in() {
		$actual = $this->support->can_register();
		$this->assertFalse( $actual );
	}

	function test_it_will_register_if_logged_in() {
		wp_set_current_user( 1 );
		$actual = $this->support->can_register();
		$this->assertTrue( $actual );
	}

}
