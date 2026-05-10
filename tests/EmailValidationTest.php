<?php
/**
 * Email Validation Specific Tests
 * Tests email validation logic in detail
 */

use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    /**
     * Test various invalid email formats
     * POS-218: Test invalid email formats
     */
    public function testInvalidEmailFormats()
    {
        $invalidEmails = [
            'plainaddress',           // No @ symbol
            '@no-local.com',          // No local part
            'user@',                  // No domain
            'user name@example.com',  // Space in local part
            'user@domain',            // No TLD
            'user@domain..com',       // Double dots
            'user..name@example.com', // Consecutive dots
        ];

        foreach ($invalidEmails as $email) {
            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            $this->assertFalse($isValid, "$email should be invalid");
        }
    }

    /**
     * Test that email validation is case-insensitive
     * POS-219: Test email case handling
     */
    public function testEmailCaseInsensitivity()
    {
        $emails = [
            'User@Example.Com',
            'USER@EXAMPLE.COM',
            'user@example.com',
        ];

        foreach ($emails as $email) {
            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            $this->assertTrue($isValid, "$email should be valid");
        }
    }

    /**
     * Test that email can have numbers and special characters
     * POS-220: Test emails with numbers and special chars
     */
    public function testEmailWithNumbersAndSpecialChars()
    {
        $validEmails = [
            'user123@example.com',
            'john+tag@example.com',
            'test_user@example.com',
            'user-name@example.com',
        ];

        foreach ($validEmails as $email) {
            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            $this->assertTrue($isValid, "$email should be valid");
        }
    }
}