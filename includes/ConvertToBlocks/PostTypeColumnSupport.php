<?php
/**
 * PostTypeColumnSupport
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * PostTypeColumnSupport adds the custom Editor column to Post List
 * Screen in the WP-Admin. The column displays an icon to indicate
 * whether a post was edited or updated in the Block Editor or the
 * Classic Editor.
 */
class PostTypeColumnSupport {

	/**
	 * The parent plugin
	 *
	 * @var Plugin
	 */
	public $container;

	/**
	 * Registers with WordPress to manage the custom Posts Column
	 *
	 * @return void
	 */
	public function register() {
		foreach ( get_post_types() as $post_type ) {
			if ( ! $this->container->post_type_supports_convert_to_blocks( $post_type ) ) {
				continue;
			}
			add_filter( "manage_{$post_type}_posts_columns", [ $this, 'update_post_columns' ], 10000 );
			add_action( "manage_{$post_type}_pages_custom_column", [ $this, 'update_post_column_value' ], 10, 2 );
			add_action( "manage_{$post_type}_posts_custom_column", [ $this, 'update_post_column_value' ], 10, 2 );
		}
	}

	/**
	 * Only register if in an admin context.
	 */
	public function can_register() {
		return is_admin();
	}

	/**
	 * Adds Editor column and updates display order
	 *
	 * @param array $columns List of post columns
	 * @return array
	 */
	public function update_post_columns( $columns ) {
		$column_label = $this->get_editor_column_label();

		$columns['editor'] = $column_label;

		$ranks = [
			'cb'        => 1,
			'title'     => 2,
			'editor'    => 3,
			'coauthors' => 4,
		];

		$sorter = function( $a, $b ) use ( $ranks ) {
			$a_rank = ! empty( $ranks[ $a ] ) ? $ranks[ $a ] : 1000;
			$b_rank = ! empty( $ranks[ $b ] ) ? $ranks[ $b ] : 1000;

			if ( $a_rank < $b_rank ) {
				return -1;
			} elseif ( $a_rank > $b_rank ) {
				return 1;
			} else {
				return 0;
			}
		};

		uksort( $columns, $sorter );

		$columns = apply_filters( 'convert_to_blocks_post_list_columns', $columns );

		return $columns;
	}

	/**
	 * Outputs Post Column based on whether the specified post was created
	 * or updated in CE or block editor.
	 *
	 * @param string $column The column name
	 * @param int    $post_id The current post id
	 * @return void
	 */
	public function update_post_column_value( $column, $post_id ) {
		if ( 'editor' !== $column ) {
			return;
		}

		$column_label = $this->get_editor_column_label();

		// phpcs:disable
		if ( $this->is_block_editor_post( $post_id ) ) {
			$icon  = $this->get_block_editor_column_icon();
			$title = __( BLOCK_EDITOR_LABEL, 'convert-to-blocks' );
		} else {
			$icon  = $this->get_classic_editor_column_icon();
			$title = __( CLASSIC_EDITOR_LABEL, 'convert-to-blocks' );
		}
		// phpcs:enable

		?>
			<span
				class="dashicons <?php echo esc_attr( $icon ); ?>"
				title="<?php echo esc_attr( $title ); ?>"
				>
			</span>
		<?php
		if ( apply_filters( 'convert_to_blocks_show_admin_column_title', true ) ) {
			printf( '<span class="txt">%s</span>', esc_attr( $title ) );
		}
		?>
		<?php
	}

	/**
	 * Returns the label for the custom column
	 *
	 * @return string
	 */
	public function get_editor_column_label() {
		return __( 'Editor', 'convert-to-blocks' );
	}

	/**
	 * Returns the icon to indicate that a post was created in the block
	 * editor.
	 *
	 * @return string
	 */
	public function get_block_editor_column_icon() {
		return apply_filters( 'convert_to_blocks_block_editor_column_icon', 'dashicons-columns' );
	}

	/**
	 * Retruns the icon to indicate that a post was created in the classic
	 * editor.
	 *
	 * @return string
	 */
	public function get_classic_editor_column_icon() {
		return apply_filters( 'convert_to_blocks_classic_editor_column_icon', 'dashicons-media-document' );
	}

	/**
	 * Checks if the specified post is a block editor post.
	 *
	 * @param int $post_id The post id.
	 * @return bool
	 */
	public function is_block_editor_post( $post_id ) {
		return $this->container->is_block_editor_post( $post_id );
	}

}
