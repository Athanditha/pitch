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
}) 