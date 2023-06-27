describe("Admin can login and open dashboard", () => {
  before(() => {
    cy.login();
  });

  it("Open dashboard", () => {
    cy.visit(`/wp-admin`);
    cy.get("h1").should("contain", "Dashboard");
  });

  it("Activate Convert to Blocks and deactivate it back", () => {
    cy.deactivatePlugin("convert-to-blocks");
    cy.activatePlugin("convert-to-blocks");
  });
});
