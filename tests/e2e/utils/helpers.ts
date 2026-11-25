/**
 * Shared E2E helpers.
 *
 * The bulk migration queue lives in options that no REST route exposes, so
 * the specs that need it run WP-CLI in the test environment. Each call takes
 * about a second: keep them in beforeAll / afterAll hooks.
 */

/**
 * External dependencies
 */
import { execFileSync } from 'child_process';
import { readFileSync } from 'fs';
import path from 'path';

/** Classic editor markup (no block delimiters) for a post to convert. */
export const CLASSIC_CONTENT = readFileSync(
	path.join( __dirname, '../fixtures/classic-post.html' ),
	'utf8'
);

/** The block names CLASSIC_CONTENT converts to, in order. */
export const CONVERTED_BLOCK_NAMES = [
	'core/heading',
	'core/heading',
	'core/heading',
	'core/heading',
	'core/heading',
	'core/paragraph',
	'core/paragraph',
	'core/list',
	'core/list',
	'core/image',
	'core/quote',
];

/**
 * Runs a WP-CLI command in the test environment and returns its output.
 *
 * @param args WP-CLI arguments, without the leading `wp`.
 * @return Trimmed stdout of the command.
 */
export function wpCli( args: string[] ): string {
	return execFileSync(
		'npm',
		[ 'run', '--silent', 'wp-env:test', '--', 'run', 'cli', 'wp', ...args ],
		{ encoding: 'utf8', stdio: [ 'ignore', 'pipe', 'ignore' ] }
	).trim();
}

/**
 * Runs PHP in the test environment through `wp eval` and returns its output.
 *
 * @param php PHP code, without the opening tag.
 * @return Trimmed output of the code.
 */
export function wpEval( php: string ): string {
	return wpCli( [ 'eval', php ] );
}

/**
 * Deletes the bulk migration options so the next migration starts clean.
 */
export function resetMigration() {
	wpEval(
		'delete_option( "ctb_running" ); delete_option( "ctb_posts_to_update" ); delete_option( "ctb_cursor" );'
	);
}
