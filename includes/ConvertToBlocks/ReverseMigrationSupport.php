<?php
/**
 * ReverseMigrationSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * Gutenberg stores content inside comment delimiter. As a result, CE
 * can't parse markup generated with Gutenberg.
 *
 * ReverseMigrationSupport displays a warning to editors
 * if a Block Editor post was reopened in classic editor.
 */
class ReverseMigrationSupport {

	/**
	 * Parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers with WordPress Admin
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'admin_notices', [ $this, 'render_reverse_migration_notice_if' ] );
	}

	/**
	 * Only register if in the correct admin context.
	 *
	 * @return bool
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * Displays a warning notice if the current post was originally
	 * created in the block editor.
	 *
	 * @return void
	 */
	public function render_reverse_migration_notice_if() {
		$post_id = $this->container->get_current_post();

		if ( empty( $post_id ) ) {
			return;
		}

		if ( ! $this->container->is_classic_editor_context() ) {
			return;
		}

		if ( ! $this->container->is_block_editor_post( $post_id ) ) {
			return;
		}

		$this->render_reverse_migration_notice();
	}

	/**
	 * Renders the reverse migration notice
	 *
	 * @return void
	 */
	public function render_reverse_migration_notice() {
		$block_editor_url = remove_query_arg( 'classic' );

		$line1 = __(
			'This post was created or updated in the Gutenberg Block Editor.',
			'convert-to-blocks'
		);

		$line2 = sprintf(
			/* translators: Paragraph has link to switch to the Block Editor */
			__(
				'Please <a href="%s">Switch to the Block Editor</a> to avoid errors.',
				'convert-to-blocks'
			),
			$block_editor_url
		);

		?>
		<div class="notice notice-error is-dismissible">
			<p>
				<?php echo esc_html( $line1 ); ?>
				<br>
				<?php echo wp_kses( $line2, [ 'a' => [ 'href' => true ] ] ); ?>
			</p>
		</div>
		<?php
	}

}
