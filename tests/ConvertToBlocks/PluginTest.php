<?php

namespace ConvertToBlocks;

class PluginTest extends \WP_UnitTestCase {

	public $plugin;

	function setUp(): void {
		$this->plugin = Plugin::get_instance();
	}

	function test_it_is_a_singleton() {
		$a = Plugin::get_instance();
		$b = Plugin::get_instance();

		$this->assertSame( $a, $b );
	}

}
