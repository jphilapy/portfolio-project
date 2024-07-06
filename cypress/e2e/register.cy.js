describe('Can Register', () => {
    // Test to check that the login page is visible and contains the required elements
    it('should display the registration page with an h2 and a form', () => {
        cy.visit('/register');
        cy.get('h2').should('contain.text', 'Register');
        cy.get('form').should('exist');
    });
    it('should require a confirmation password', () => {
        cy.visit('/register');

        cy.get('input[name="username"]').type('dev@altahost.com');
        cy.get('input[name="password"]').type('12345678');

        cy.get('form').submit();

        cy.get('li').should('contain.text', 'Confirmation password is required.');
    });

    it('should register with valid credentials', () => {
        cy.visit('/register');

        // Fill in the username/email and password fields
        cy.get('input[name="username"]').type('dev@altahost.com');
        cy.get('input[name="password"]').type('12345678');
        cy.get('input[name="confirm_password"]').type('12345678');

        // Submit the login form
        cy.get('form').submit();

        // Verify that the registration was successful
        cy.get('p').should('contain.text', 'Registration was successful!');
    });

});
