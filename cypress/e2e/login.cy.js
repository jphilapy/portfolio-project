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
    cy.get('input[name="username"]').type('dev@altahost.com');
    cy.get('input[name="password"]').type('12345678');

    // Submit the login form
    cy.get('form').submit();

    // Verify that the login was successful
    // Replace `#logout-button` with an appropriate selector for an element visible only to logged-in users
    cy.get('#logout-button').should('exist');
    });

  it('should log out successfully', () => {
    // Log in before logging out
    cy.request({
      method: 'POST',
      url: '/login',
      form: true,
      body: {
        username: 'dev@altahost.com',
        password: '12345678'
      }
    });

    cy.visit('/dashboard');
    cy.url().get('#logout-button').click();
    cy.url().should('include', '/login');
    cy.get('form').should('exist');
  });

  it('should display error if invalid username', () => {
    // Visit the login page
    cy.visit('/login');

    // Submit the login form with incorrect credentials
    cy.get('input[name="username"]').type('bogus@domain.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('form').submit();

    // Assert that the error message is displayed
    cy.get('li').should('contain.text', 'Either username or password is incorrect.');
  });

  it('should display error if username is not a valid email', () => {
    cy.visit('/login');
    cy.get('input[name="username"]').type('invalidusername');
    cy.get('input[name="password"]').type(12345678);
    cy.get('form').submit();
    cy.get('li').should('contain.text', 'Invalid email format.');
  });

  it('should display error if invalid password', () => {
    // Visit the login page
    cy.visit('/login');

    // Submit the login form with incorrect credentials
    cy.get('input[name="username"]').type('dev@altahost.com');
    cy.get('input[name="password"]').type('000000000');
    cy.get('form').submit();

    // Assert that the error message is displayed
    cy.get('li').should('contain.text', 'Either username or password is incorrect.');
  });

  it('should display error if missing username', () => {
    // Visit the login page
    cy.visit('/login');

    // Submit the login form with incorrect credentials
    cy.get('input[name="username"]').clear();
    cy.get('input[name="password"]').type('000000000');
    cy.get('form').submit();

    // Assert that the error message is displayed
    cy.get('li').should('contain.text', 'Username is required.');
  });

  it('should display error if missing password', () => {
    // Visit the login page
    cy.visit('/login');

    // Submit the login form with incorrect credentials
    cy.get('input[name="username"]').type('dev@altahost.com');
    cy.get('input[name="password"]').clear();
    cy.get('form').submit();

    // Assert that the error message is displayed
    cy.get('li').should('contain.text', 'Password is required.');
  });
  it('should display error if missing username and password', () => {
    // Visit the login page
    cy.visit('/login');

    // Submit the login form with incorrect credentials
    cy.get('input[name="username"]').clear();
    cy.get('input[name="password"]').clear();
    cy.get('form').submit();

    // Assert that the error message is displayed
    cy.get('li').should('contain.text', 'Password is required.');
    cy.get('li').should('contain.text', 'Username is required.');
  });

});
