/**
 * Block editor: classic content is converted to blocks when a post is opened.
 */

/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

/**
 * Internal dependencies
 */
import { CLASSIC_CONTENT, CONVERTED_BLOCK_NAMES } from '../../utils/helpers';

test.describe( 'Convert on open', () => {
	test.afterEach( async ( { requestUtils } ) => {
		await requestUtils.deleteAllPosts();
	} );

	test( 'converts classic content to blocks when the post is opened', async ( {
		admin,
		editor,
		requestUtils,
	} ) => {
		const post = await requestUtils.createPost( {
			title: 'Classic post',
			content: CLASSIC_CONTENT,
			status: 'publish',
		} );

		await admin.visitAdminPage(
			'post.php',
			`post=${ post.id }&action=edit`
		);

		// The plugin converts the classic block shortly after the editor loads.
		await expect
			.poll( async () =>
				( await editor.getBlocks() ).map( ( block ) => block.name )
			)
			.toEqual( CONVERTED_BLOCK_NAMES );

		const headingLevels = ( await editor.getBlocks() )
			.filter( ( block ) => block.name === 'core/heading' )
			.map( ( block ) => block.attributes.level );
		expect( headingLevels ).toEqual( [ 2, 3, 4, 5, 6 ] );
	} );
} );
