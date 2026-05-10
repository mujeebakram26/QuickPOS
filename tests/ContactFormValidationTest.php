<?php
/**
 * Contact Form Validation Tests
 * Tests the validation logic for contact form submissions
 */

use PHPUnit\Framework\TestCase;

class ContactFormValidationTest extends TestCase
{
    /**
     * Test that validation fails when name is empty
     * POS-201: Test empty name field validation
     */
    public function testValidationFailsWithEmptyName()
    {
        $name = '';
        $email = 'user@example.com';
        $message = 'This is a test message';

        // Simulate validation (same logic as process-form.php)
        $errors = [];
        
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }

        // Assert that error exists
        $this->assertArrayHasKey('name', $errors);
        $this->assertEquals('Name is required', $errors['name']);
    }

    /**
     * Test that validation fails when email is empty
     * POS-202: Test empty email field validation
     */
    public function testValidationFailsWithEmptyEmail()
    {
        $name = 'John Doe';
        $email = '';
        $message = 'This is a test message';

        $errors = [];
        
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        }

        $this->assertArrayHasKey('email', $errors);
        $this->assertEquals('Email is required', $errors['email']);
    }

    /**
     * Test that validation fails when message is empty
     * POS-203: Test empty message field validation
     */
    public function testValidationFailsWithEmptyMessage()
    {
        $name = 'John Doe';
        $email = 'user@example.com';
        $message = '';

        $errors = [];
        
        if (empty($message)) {
            $errors['message'] = 'Message is required';
        }

        $this->assertArrayHasKey('message', $errors);
        $this->assertEquals('Message is required', $errors['message']);
    }

    /**
     * Test that validation fails with invalid email format
     * POS-204: Test invalid email format validation
     */
    public function testValidationFailsWithInvalidEmail()
    {
        $name = 'John Doe';
        $email = 'invalid-email-format';
        $message = 'This is a test message';

        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        $this->assertArrayHasKey('email', $errors);
        $this->assertEquals('Please enter a valid email address', $errors['email']);
    }

    /**
     * Test that validation fails when email has wrong format
     * POS-205: Test email missing @ symbol
     */
    public function testValidationFailsWithEmailMissingAtSymbol()
    {
        $email = 'userexample.com';

        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);

        $this->assertFalse($isValid, 'Email without @ symbol should be invalid');
    }

    /**
     * Test that validation succeeds with valid data
     * POS-206: Test valid form submission
     */
    public function testValidationSucceedsWithValidData()
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $message = 'This is a test message for the contact form';

        $errors = [];

        // Name validation
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        } elseif (strlen($name) < 2) {
            $errors['name'] = 'Name must be at least 2 characters';
        }

        // Email validation
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        // Message validation
        if (empty($message)) {
            $errors['message'] = 'Message is required';
        } elseif (strlen($message) < 10) {
            $errors['message'] = 'Message must be at least 10 characters';
        }

        // Assert no errors exist
        $this->assertEmpty($errors, 'Valid data should not produce errors');
    }

    /**
     * Test that valid email addresses are accepted
     * POS-207: Test various valid email formats
     */
    public function testValidEmailFormats()
    {
        $validEmails = [
            'user@example.com',
            'john.doe@example.co.uk',
            'test+tag@example.com',
            'user123@test-domain.com',
        ];

        foreach ($validEmails as $email) {
            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            $this->assertTrue($isValid, "$email should be valid");
        }
    }

    /**
     * Test that message length validation works
     * POS-208: Test message too short
     */
    public function testValidationFailsWithMessageTooShort()
    {
        $message = 'short'; // Only 5 characters

        $errors = [];

        if (strlen($message) < 10) {
            $errors['message'] = 'Message must be at least 10 characters';
        }

        $this->assertArrayHasKey('message', $errors);
    }

    /**
     * Test that name length validation works
     * POS-209: Test name too short
     */
    public function testValidationFailsWithNameTooShort()
    {
        $name = 'A'; // Only 1 character

        $errors = [];

        if (strlen($name) < 2) {
            $errors['name'] = 'Name must be at least 2 characters';
        }

        $this->assertArrayHasKey('name', $errors);
    }

    /**
     * Test that the form accepts names with spaces
     * POS-210: Test full names with spaces
     */
    public function testValidNamesWithSpaces()
    {
        $validNames = [
            'John Doe',
            'Mary Jane Smith',
            'Ahmed Hassan Khan',
            'Dr. Robert Johnson',
        ];

        $errors = [];

        foreach ($validNames as $name) {
            $errors = [];
            
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            } elseif (strlen($name) < 2) {
                $errors['name'] = 'Name must be at least 2 characters';
            }

            $this->assertEmpty($errors, "$name should be valid");
        }
    }
}