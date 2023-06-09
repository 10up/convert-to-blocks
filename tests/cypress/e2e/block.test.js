describe("Convert test content to blocks", () => {
    before(() => {
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

    it("Create classic post", () => {
        cy.fixture('example.html').then((contentFixture) => {
            cy.wpCli("post create --post_title='Classic Post' --post_content='" + contentFixture + "'");
        })
    });

    it('Convert Classic editor to Blocks and Check blocks have been converted', () => {
		// Visit the post in the admin.
		cy.visit('wp-admin/edit.php');
        cy.get('#the-list .row-title');
        cy.contains( '#the-list .row-title', 'Classic Post' ).click();

		// Verify blocks have been converted.
		cy.closeWelcomeGuide();
		cy.get( 'h2[data-type="core/heading"]' ).should('exist');
        cy.get( 'h3[data-type="core/heading"]' ).should('exist');
        cy.get( 'h4[data-type="core/heading"]' ).should('exist');
        cy.get( 'h5[data-type="core/heading"]' ).should('exist');
        cy.get( 'h6[data-type="core/heading"]' ).should('exist');
        cy.get( 'p[data-type="core/paragraph"]' ).should('exist');
        cy.get( '.wp-block-post-content p[data-type="core/paragraph"] a' ).should('exist');
        cy.get( 'ul[data-type="core/list"]' ).should('exist');
        cy.get( 'ol[data-type="core/list"]' ).should('exist');
        cy.get( 'figure[data-type="core/image"]' ).should('exist');
        cy.get( 'blockquote[data-type="core/quote"]' ).should('exist');
    });
});

