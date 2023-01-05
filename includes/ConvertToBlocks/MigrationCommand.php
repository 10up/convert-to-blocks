<?php
/**
 * MigrationCommand
 *
 * @package convert-to-blocks
 */

namespace ConvertToBlocks;

/**
 * Bulk migrates classic editor posts to Gutenberg blocks.
 */
class MigrationCommand extends \WP_CLI_Command {

	/**
	 * Starts a new Migration. The command prints the URL that must be opened in a browser to connect it to the WP CLI.
	 *
	 * ## OPTIONS
	 *
	 * [--post_type=<post_type>]
	 * : Optional comma delimited list of post types to migrate. Defaults to post,page
	 *
	 * [--only=<only>]
	 * : Optional comma delimited list of post ids to migrate.
	 *
	 * @param array $args The command args
	 * @param array $opts The command opts
	 */
	public function start( $args = [], $opts = [] ) {
		$agent = new MigrationAgent();
		$delay = 5; // 5 second delay between each tick

		if ( $agent->is_running() ) {
			\WP_CLI::error( 'Please stop the currently running migration first.' );
		}

		$result = $agent->start( $opts );

		if ( empty( $result ) ) {
			\WP_CLI::error( 'No posts to migrate.' );
		}

		$status = $agent->get_status( $opts );

		if ( ! $status['running'] ) {
			\WP_CLI::error( 'Failed to start migration.' );
		}

		\WP_CLI::log( 'Migration started...' );
		\WP_CLI::log( 'Please open the following URL in a browser to start the migration agent.' );
		\WP_CLI::line( '' );
		\WP_CLI::log( $result );
		\WP_CLI::line( '' );

		$total = $status['total'];

		$message      = "Converting $total Posts ...";
		$progress_bar = \WP_CLI\Utils\make_progress_bar( $message, $total );
		$progress_bar->tick();

		$prev_progress = 0;
		$ticks         = 0;

		while ( true ) {
			$status = $agent->get_status();

			if ( ! $status['running'] ) {
				break;
			}

			$progress = $status['progress'];

			// since the WP CLI progress bar can't tick upto a progress % we need to
			// tick in steps upto the progress % of total
			if ( $progress !== $prev_progress ) {
				$required_ticks = floor( $progress / 100 * $total );

				while ( $ticks < $required_ticks ) {
					$progress_bar->tick();
					$ticks++;
				}

				$prev_progress = $progress;
			}

			if ( $ticks < $total ) {
				// sleeping helps reduce load on server
				sleep( $delay );
			} else {
				// don't need the full sleep delay on last tick
				sleep( 1 );
			}

			// required as we need to reload options that the browser client is updating
			wp_cache_delete( 'alloptions', 'options' );
		}

		$progress_bar->finish();

		\WP_CLI::success( 'Migration finished successfully.' );

		// cleanup the options used during migration
		$agent->stop();
	}

	/**
	 * Stops the currently running migration if active.
	 *
	 * @param array $args The command args
	 * @param array $opts The command opts
	 */
	public function stop( $args = [], $opts = [] ) {
		$agent = new MigrationAgent();

		if ( ! $agent->is_running() ) {
			\WP_CLI::warning( 'No migrations are currently running' );
			return;
		}

		$agent->stop( $opts );

		\WP_CLI::success( 'Migration stopped successfully' );
	}

	/**
	 * Prints the status of the currently running migration.
	 *
	 * @param array $args The command args
	 * @param array $opts The command opts
	 */
	public function status( $args = [], $opts = [] ) {
		$agent  = new MigrationAgent();
		$status = $agent->get_status( $opts );

		if ( ! $status['running'] ) {
			\WP_CLI::log( 'No migrations are currently running.' );
			return;
		}

		\WP_CLI::log( 'Migration is currently running ...' );
		\WP_CLI::log( $status['progress'] . ' [' . ( $status['cursor'] + 1 ) . '/' . $status['total'] . ']' );
		\WP_CLI::log( 'Active: ' . $status['active'] );
	}

}
