/**
 * Bulk migration: the browser client converts and saves every queued post,
 * then the migration ends.
 *
 * The queue is started the way `wp convert-to-blocks start` starts it, and the
 * logged-in admin opens the client URL that command prints.
 */

/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

/**
 * Internal dependencies
 */
import { CLASSIC_CONTENT, resetMigration, wpEval } from '../../utils/helpers';

test.describe( 'Bulk migration', () => {
	let postIds: number[] = [];
	let clientUrl = '';

	test.beforeAll( async ( { requestUtils } ) => {
		resetMigration();

		for ( const title of [ 'First classic post', 'Second classic post' ] ) {
			const post = await requestUtils.createPost( {
				title,
				content: CLASSIC_CONTENT,
				status: 'publish',
			} );
			postIds.push( post.id );
		}

		// Under WP-CLI, start() also prints a pagination line before the URL.
		const output = wpEval(
			`echo ( new \\ConvertToBlocks\\MigrationAgent() )->start( [ 'only' => '${ postIds.join(
				','
			) }' ] );`
		);
		clientUrl = output.match( /http\S+ctb_client=\d+/ )?.[ 0 ] ?? '';
	} );

	test.afterAll( async ( { requestUtils } ) => {
		resetMigration();
		await requestUtils.deleteAllPosts();
		postIds = [];
	} );

	test( 'converts and saves each queued post, then ends the migration', async ( {
		page,
		requestUtils,
	} ) => {
		expect( clientUrl ).toContain( `ctb_client=${ postIds[ 0 ] }` );

		await page.goto( clientUrl );

		// The client saves the first post, then moves on to the second.
		await expect( page ).toHaveURL(
			new RegExp( `ctb_client=${ postIds[ 1 ] }` )
		);

		for ( const id of postIds ) {
			await expect
				.poll(
					async () => {
						const post = await requestUtils.rest< {
							content: { raw: string };
						} >( {
							path: `/wp/v2/posts/${ id }`,
							params: { context: 'edit' },
						} );
						return post.content.raw;
					},
					{ message: `post ${ id } is saved as blocks` }
				)
				.toContain( '<!-- wp:heading -->' );
		}

		expect(
			wpEval(
				`echo (int) get_option( "ctb_running" ); foreach ( [ ${ postIds.join(
					','
				) } ] as $id ) { echo ",", get_post_meta( $id, "block_editor", true ); }`
			)
		).toBe( '0,1,1' );
	} );
} );
