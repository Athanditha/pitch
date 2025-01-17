// Cypress E2E Test
describe('Chat Application', () => {
  const testUser = {
    name: 'Test User',
    username: 'testuser',
    email: 'test@example.com',
    contact_no: '1234567890',
    password: 'password123'
  }

  beforeEach(() => {
    // Reset the database before each test
    cy.exec('php artisan migrate:fresh --seed')
  })

  it('allows user to register, find a user, and send a message', () => {
    cy.register(testUser)
    cy.verifyDashboardElements()
    cy.startChatWithFirstUser()
    cy.sendMessage('Hello! This is a test message!')
  })

  it('validates registration form fields', () => {
    cy.visit('/register')

    // Try submitting empty form
    cy.get('button[type="submit"]').click()

    // Check for validation messages
    const requiredFields = ['name', 'email', 'password']
    requiredFields.forEach(field => {
      cy.contains(`The ${field} field is required`).should('be.visible')
    })

    // Try with invalid data
    const invalidUser = {
      name: 'Test User',
      username: 'testuser',
      email: 'invalid-email',
      contact_no: '1234567890',
      password: 'pass'
    }

    cy.get('input[name="name"]').type(invalidUser.name)
    cy.get('input[name="username"]').type(invalidUser.username)
    cy.get('input[name="email"]').type(invalidUser.email)
    cy.get('input[name="contact_no"]').type(invalidUser.contact_no)
    cy.get('input[name="password"]').type(invalidUser.password)
    cy.get('input[name="password_confirmation"]').type('different')
    cy.get('button[type="submit"]').click()

    // Check for validation messages
    const validationMessages = [
      'The email must be a valid email address',
      'The password must be at least 8 characters',
      'The password confirmation does not match'
    ]
    validationMessages.forEach(message => {
      cy.contains(message).should('be.visible')
    })
  })

  it('allows user to view user directory and verify user info', () => {
    cy.register(testUser)
    cy.verifyDashboardElements()

    // Verify user info is displayed
    cy.get('table tbody tr').first().within(() => {
      cy.get('img').should('be.visible') // Profile photo
      cy.get('.text-gray-900').should('be.visible') // Name
      cy.get('.text-gray-500').should('be.visible') // Username
      cy.contains('★').should('be.visible') // Rating star
    })
  })

  it('tests chat functionality with multiple messages', () => {
    cy.register(testUser)
    cy.startChatWithFirstUser()

    // Send multiple messages
    const messages = [
      'Hello there!',
      'How are you doing?',
      'Testing multiple messages',
      '👋 with emojis 😊'
    ]

    messages.forEach(message => {
      cy.sendMessage(message)
    })

    // Verify message input is cleared after sending
    cy.get('#message').should('have.value', '')

    // Verify all messages are visible
    messages.forEach(message => {
      cy.contains(message).should('be.visible')
    })
  })

  it('tests navigation and logout functionality', () => {
    cy.register(testUser)

    // Verify navigation elements
    const navItems = ['Dashboard', 'Chats']
    navItems.forEach(item => {
      cy.contains(item).should('be.visible')
    })

    // Test navigation
    cy.contains('Chats').click()
    cy.url().should('include', '/message')
    cy.contains('Dashboard').click()
    cy.url().should('include', '/dashboard')

    // Test logout
    cy.contains('Logout').click()
    cy.url().should('not.include', '/dashboard')
    
    // Verify can't access protected routes after logout
    cy.visit('/dashboard')
    cy.url().should('include', '/login')
  })
}) 