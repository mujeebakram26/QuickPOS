<?php

use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    /**
     * Test various invalid email formats
     * POS-218
     */
    public function testInvalidEmailFormats()
    {
        $invalidEmails = [
            'plainaddress',
            '@no-local.com',
            'user@',
            'user name@example.com',
            'user@domain',
            'user@domain..com',
            'user..name@example.com',
        ];

        foreach ($invalidEmails as $email) {
            $isValid = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

            $this->assertFalse(
                $isValid,
                "$email should be invalid"
            );
        }
    }

    /**
     * Test email case handling
     * POS-219
     */
    public function testEmailCaseInsensitivity()
    {
        $emails = [
            'User@Example.Com',
            'USER@EXAMPLE.COM',
            'user@example.com',
        ];

        foreach ($emails as $email) {
            $isValid = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

            $this->assertNotFalse(
                $isValid,
                "$email should be valid"
            );
        }
    }

    /**
     * Test emails with numbers and special characters
     * POS-220
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
            $isValid = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

            $this->assertNotFalse(
                $isValid,
                "$email should be valid"
            );
        }
    }
}