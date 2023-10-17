<?php

namespace ConvertToBlocks;

class ClassicEditorSupportTest extends \WP_UnitTestCase {

	public $support;
	public $post_supports;
	public $classic_param;

	function setUp(): void {
		parent::setUp();

		$this->support            = new ClassicEditorSupport();
		$this->support->container = $this;
	}

	function test_it_has_a_container() {
		$this->assertSame( $this, $this->support->container );
	}

	function test_it_will_not_be_registered_by_default() {
		$actual = $this->support->can_register();
		$this->assertFalse( $actual );
	}

	function test_it_can_be_registered_on_admin_pages() {
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

	function test_it_will_enable_block_editor_if_post_supports_gutenbridge() {
		$this->post_supports = true;
		$supports_editor = $this->support->enable_block_editor( true, 1 );
		$not_supports_editor = $this->support->enable_block_editor( false, 1 );

		$this->assertTrue( $supports_editor && $not_supports_editor );
	}

	function test_wont_alter_editor_support_if_post_does_not_support_gutenbridge() {
		$this->post_supports = false;
		$supports_editor = $this->support->enable_block_editor( true, 1 );
		$not_supports_editor = $this->support->enable_block_editor( false, 1 );

		$this->assertTrue( $supports_editor && ! $not_supports_editor );
	}

	function test_it_will_disable_block_editor_if_classic_query_param_is_present() {
		$this->post_supports = true;
		$this->classic_param = true;

		$actual = $this->support->enable_block_editor( true, 1 );

		$this->assertFalse( $actual );
	}

	/* helpers */

	function post_supports_convert_to_blocks() {
		return $this->post_supports;
	}

	function has_classic_param() {
		return $this->classic_param;
	}

}
