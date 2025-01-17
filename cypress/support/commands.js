// Custom commands for Cypress tests

// Register command
Cypress.Commands.add('register', (user) => {
  cy.visit('/register')
  cy.get('input[name="name"]').type(user.name)
  cy.get('input[name="username"]').type(user.username)
  cy.get('input[name="email"]').type(user.email)
  cy.get('input[name="contact_no"]').type(user.contact_no)
  cy.get('input[name="password"]').type(user.password)
  cy.get('input[name="password_confirmation"]').type(user.password)
  cy.get('button[type="submit"]').click()
})

// Navigate to chat with first user
Cypress.Commands.add('startChatWithFirstUser', () => {
  cy.get('table').should('be.visible')
    .find('tbody tr:first-child td:last-child a')
    .first()
    .click()
  cy.url().should('include', '/message')
})

// Send chat message
Cypress.Commands.add('sendMessage', (message) => {
  cy.get('#message').type(message)
  cy.get('.bg-gray-100 form button[type="submit"]').click()
  cy.contains(message).should('be.visible')
})

// Verify dashboard elements
Cypress.Commands.add('verifyDashboardElements', () => {
  cy.url().should('include', '/dashboard')
  cy.contains('Users Directory').should('be.visible')
  cy.get('table').should('be.visible')
  
  // Verify table headers
  cy.contains('th', 'Profile').should('be.visible')
  cy.contains('th', 'Contact Info').should('be.visible')
  cy.contains('th', 'Rating').should('be.visible')
  cy.contains('th', 'Actions').should('be.visible')
}) 