<?php

namespace ConvertToBlocks;

class AssetsTest extends \WP_UnitTestCase {

	public $assets;

	function setUp() {
		parent::setUp();

		$this->assets = new Assets();
	}

	function test_it_knows_if_not_on_block_editor() {
		$actual = $this->assets->is_block_editor();
		$this->assertFalse( $actual );
	}

	function test_it_knows_if_on_block_editor_screen() {
		$GLOBALS['current_screen'] =
			$mock = $this->getMockBuilder( stdObject::class )
								->setMethods( ['is_block_editor'] )
								->getMock();

		$mock->expects( $this->once() )
			 ->method( 'is_block_editor' )
			 ->will( $this->returnValue( true ) );

		$actual = $this->assets->is_block_editor();
		$this->assertTrue( $actual );

		$GLOBALS['current_screen'] = null;
	}

	function test_it_will_not_be_registered_on_frontend() {
		$actual = $this->assets->can_register();
		$this->assertFalse( $actual );
	}

	function test_it_will_be_registered_on_admin_screens() {
		$GLOBALS['current_screen'] =
			$mock = $this->getMockBuilder( stdObject::class )
								->setMethods( ['in_admin'] )
								->getMock();

		$mock->expects( $this->once() )
			 ->method( 'in_admin' )
			 ->will( $this->returnValue( true ) );

		$actual = $this->assets->can_register();
		$this->assertTrue( $actual );

		$GLOBALS['current_screen'] = null;
	}

	function test_it_registers_gutenbridge_script_on_registration() {
		$this->assets->register();
		$actual = wp_script_is( 'convert_to_blocks_editor', 'registered' );
		$this->assertTrue( $actual );
	}

	function test_it_enqueues_script_on_assets_hook() {
		$this->assets->register();
		$actual = wp_script_is( 'convert_to_blocks_editor', 'queue' );

		$this->assertFalse( $actual );

		$this->assets->do_assets();

		$actual = wp_script_is( 'convert_to_blocks_editor', 'queue' );

		$this->assertTrue( $actual );
	}

}
