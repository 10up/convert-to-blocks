<?php
/**
 * RevisionSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * RevisionSupport ensures that User navigation across the WordPress Revision
 * Screens.
 */
class RevisionSupport {

	/**
	 * Parent plugin object
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers the revision support with WordPress.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'wp_redirect', [ $this, 'update_redirect' ], 10, 2 );
		add_filter( 'wp_prepare_revision_for_js', [ $this, 'update_revision_js' ], 10, 3 );
	}

	/**
	 * Only register in admin context.
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * If referer was from classic editor or on CE forward back to classic editor.
	 *
	 * @param string $location The redirect location
	 * @param string $status The redirect status code
	 * @return string
	 */
	public function update_redirect( $location, $status ) {
		if ( $this->container->is_classic_referer() || $this->container->has_classic_param() ) {
			$location = add_query_arg( [ 'classic' => 1 ], $location );
		}

		return $location;
	}

	/**
	 * Ensures that restoring revision from Classic Editor takes user back to CE.
	 *
	 * @param array   $revision_data The revision data array
	 * @param array   $revision The revision meta
	 * @param WP_Post $post The revision post object
	 */
	public function update_revision_js( $revision_data, $revision, $post ) {
		if ( $this->container->is_classic_referer() || $this->container->has_classic_param() ) {
			$revision_data['restoreUrl'] = add_query_arg( [ 'classic' => 1 ], $revision_data['restoreUrl'] );
		}

		return $revision_data;
	}

}
