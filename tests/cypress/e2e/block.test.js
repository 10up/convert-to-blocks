describe("Convert test content to blocks", () => {
	beforeEach(() => {
		cy.login();
	});

	// Ignore Invalid JSON errors.
	Cypress.on('uncaught:exception', (err, runnable) => {
		if (
		  err.message.includes(
			"The response is not a valid JSON response"
		  )
		) {
		  return false;
		}
	});

	it('Check blocks have been converted', () => {
		cy.visit('wp-admin/edit.php');
		cy.get('#the-list .row-title');
		cy.contains( '#the-list .row-title', 'Classic Post' ).click();

		cy.getBlockEditor().find( 'h2[data-type="core/heading"]' ).should('exist');
		cy.getBlockEditor().find( 'h3[data-type="core/heading"]' ).should('exist');
		cy.getBlockEditor().find( 'h4[data-type="core/heading"]' ).should('exist');
		cy.getBlockEditor().find( 'h5[data-type="core/heading"]' ).should('exist');
		cy.getBlockEditor().find( 'h6[data-type="core/heading"]' ).should('exist');
		cy.getBlockEditor().find( 'p[data-type="core/paragraph"]' ).should('exist');
		cy.getBlockEditor().find( '.wp-block-post-content p[data-type="core/paragraph"] a' ).should('exist');
		cy.getBlockEditor().find( 'ul[data-type="core/list"]' ).should('exist');
		cy.getBlockEditor().find( 'ol[data-type="core/list"]' ).should('exist');
		cy.getBlockEditor().find( 'figure[data-type="core/image"]' ).should('exist');
		cy.getBlockEditor().find( 'blockquote[data-type="core/quote"]' ).should('exist');
	});
});
