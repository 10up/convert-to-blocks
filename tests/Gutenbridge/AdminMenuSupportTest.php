<?php

namespace Gutenbridge;

class AdminMenuSupportTest extends \WP_UnitTestCase {

	public $support;

	function setUp() {
		parent::setUp();

		$this->support            = new AdminMenuSupport();
		$this->support->container = $this;
	}

	function test_it_has_a_container() {
		$this->assertSame( $this, $this->support->container );
	}

	function test_it_will_be_registered_on_admin_pages() {
		$GLOBALS['current_screen'] =
			$mock = $this->getMockBuilder( stdObject::class )
								->setMethods( ['in_admin'] )
								->getMock();

		$mock->expects( $this->once() )
			 ->method( 'in_admin' )
			 ->will( $this->returnValue( true ) );

		$actual = $this->support->can_register();
		$this->assertTrue( $actual );

		$GLOBALS['current_screen'] = null;
	}

	function test_it_will_be_registered_if_logged_in() {
		wp_set_current_user( 1 );
		$actual = $this->support->can_register();
		$this->assertTrue( $actual );
	}

	function test_it_will_not_be_registered_by_default() {
		$actual = $this->support->can_register();
		$this->assertFalse( $actual );
	}

	function test_it_can_sort_classic_menu_item() {
		$menu_items = [
			[ 'Add New' ],
			[ 'Categories' ],
			[ 'Tags' ],
			[ 'Add New (Classic)' ],
		];

		$this->support->sort_post_type_menu( $menu_items );

		$this->assertEquals( 'Add New', $menu_items[0][0] );
		$this->assertEquals( 'Add New (Classic)', $menu_items[1][0] );
	}

}
