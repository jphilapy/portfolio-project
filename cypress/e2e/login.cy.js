describe('Can Login', () => {
  // Test to check that the login page is visible and contains the required elements
  it('should display the login page with an h2 and a form', () => {
    cy.visit('/login');
    cy.get('h2').should('contain.text', 'Log In');
    cy.get('form').should('exist');
  });

  // Test to perform the login action
  it('should login with valid credentials', () => {
    cy.visit('/login');

    // Fill in the username/email and password fields
    cy.get('input[name="username"]').type(process.env.CYPRESS_USER_NAME);
    cy.get('input[name="password"]').type(process.env.CYPRESS_USER_PASSWORD);

    // Submit the login form
    cy.get('form').submit();

    // Verify that the login was successful
    // Replace `#logout-button` with an appropriate selector for an element visible only to logged-in users
    cy.get('#logout-button').should('exist');
  });
});
