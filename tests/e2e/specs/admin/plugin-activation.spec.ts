/**
 * Admin: the dashboard loads with the plugin active, and the plugin can be
 * deactivated and activated again from the Plugins screen.
 */

/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

test.describe( 'Admin', () => {
	// Leave the plugin active for later specs even if a step fails.
	test.afterAll( async ( { requestUtils } ) => {
		await requestUtils.activatePlugin( 'convert-to-blocks' );
	} );

	test( 'opens the dashboard', async ( { admin, page } ) => {
		await admin.visitAdminPage( '/' );

		await expect(
			page.getByRole( 'heading', { level: 1, name: 'Dashboard' } )
		).toBeVisible();
	} );

	test( 'deactivates and activates the plugin', async ( { admin, page } ) => {
		const row = page.locator( 'tr[data-slug="convert-to-blocks"]' );

		await admin.visitAdminPage( 'plugins.php' );
		await row
			.getByRole( 'link', { name: 'Deactivate Convert to Blocks' } )
			.click();
		await expect( page.getByText( 'Plugin deactivated.' ) ).toBeVisible();

		await row
			.getByRole( 'link', { name: 'Activate Convert to Blocks' } )
			.click();
		await expect( page.getByText( 'Plugin activated.' ) ).toBeVisible();
		await expect(
			row.getByRole( 'link', { name: 'Deactivate Convert to Blocks' } )
		).toBeVisible();
	} );
} );
