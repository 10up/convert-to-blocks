<?php

namespace Gutenbridge;

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

}
