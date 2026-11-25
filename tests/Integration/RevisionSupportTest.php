<?php
/**
 * Tests that the classic editor round trip keeps the classic parameter.
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks\Tests\Integration;

use ConvertToBlocks\Plugin;
use ConvertToBlocks\RevisionSupport;
use WP_UnitTestCase;

/**
 * Losing `classic=1` after a save or a revision restore sends the user to the
 * block editor, which converts the post as soon as it opens.
 */
class RevisionSupportTest extends WP_UnitTestCase {

	/**
	 * Edit screen URL used as the redirect target.
	 *
	 * @var string
	 */
	private $edit_url;

	/**
	 * Registers the module the way the plugin does on admin requests.
	 */
	public function set_up() {
		parent::set_up();

		$support            = new RevisionSupport();
		$support->container = Plugin::get_instance();
		$support->register();

		$this->edit_url = admin_url( 'post.php?post=1&action=edit' );
	}

	/**
	 * Clears the request state the tests set.
	 */
	public function tear_down() {
		unset( $_SERVER['HTTP_REFERER'], $_GET['classic'] );

		parent::tear_down();
	}

	/**
	 * Saving from the classic editor redirects back to the classic editor.
	 */
	public function test_redirect_from_classic_editor_keeps_classic_param() {
		$_SERVER['HTTP_REFERER'] = admin_url( 'post.php?post=1&action=edit&classic=1' );

		$location = apply_filters( 'wp_redirect', $this->edit_url, 302 );

		$this->assertSame( '1', wp_parse_args( wp_parse_url( $location, PHP_URL_QUERY ) )['classic'] ?? null );
	}

	/**
	 * A redirect made while on the classic editor keeps the classic editor.
	 */
	public function test_redirect_on_classic_request_keeps_classic_param() {
		$_GET['classic'] = '1';

		$location = apply_filters( 'wp_redirect', $this->edit_url, 302 );

		$this->assertSame( '1', wp_parse_args( wp_parse_url( $location, PHP_URL_QUERY ) )['classic'] ?? null );
	}

	/**
	 * Redirects that don't come from the classic editor are left alone.
	 */
	public function test_redirect_from_block_editor_is_unchanged() {
		$_SERVER['HTTP_REFERER'] = $this->edit_url;

		$this->assertSame( $this->edit_url, apply_filters( 'wp_redirect', $this->edit_url, 302 ) );
	}

	/**
	 * Restoring a revision from the classic editor returns to the classic editor.
	 */
	public function test_revision_restore_from_classic_editor_keeps_classic_param() {
		$_SERVER['HTTP_REFERER'] = admin_url( 'revision.php?revision=2&classic=1' );
		$restore_url             = admin_url( 'revision.php?revision=2&action=restore' );

		$data = apply_filters( 'wp_prepare_revision_for_js', [ 'restoreUrl' => $restore_url ], null, null );

		$this->assertSame( '1', wp_parse_args( wp_parse_url( $data['restoreUrl'], PHP_URL_QUERY ) )['classic'] ?? null );
	}
}
