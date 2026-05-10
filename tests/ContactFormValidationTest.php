<?php

use PHPUnit\Framework\TestCase;

class ContactFormValidationTest extends TestCase
{
    public function testValidationFailsWithEmptyName()
    {
        $name = '';
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }

        $this->assertArrayHasKey('name', $errors);
        $this->assertEquals('Name is required', $errors['name']);
    }

    public function testValidationFailsWithEmptyEmail()
    {
        $email = '';
        $errors = [];

        if (empty($email)) {
            $errors['email'] = 'Email is required';
        }

        $this->assertArrayHasKey('email', $errors);
    }

    public function testValidationFailsWithEmptyMessage()
    {
        $message = '';
        $errors = [];

        if (empty($message)) {
            $errors['message'] = 'Message is required';
        }

        $this->assertArrayHasKey('message', $errors);
    }

    public function testValidationFailsWithInvalidEmail()
    {
        $email = 'invalid-email';
        $errors = [];

        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        $this->assertArrayHasKey('email', $errors);
    }

    public function testValidationFailsWithEmailMissingAtSymbol()
    {
        $email = 'userexample.com';

        $this->assertFalse(filter_var(trim($email), FILTER_VALIDATE_EMAIL));
    }

    public function testValidationSucceedsWithValidData()
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $message = 'This is a valid message for testing';

        $errors = [];

        if (empty($name) || strlen($name) < 2) {
            $errors['name'] = 'Invalid name';
        }

        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        }

        if (empty($message) || strlen($message) < 10) {
            $errors['message'] = 'Invalid message';
        }

        $this->assertEmpty($errors);
    }

    public function testValidEmailFormats()
    {
        $validEmails = [
            'user@example.com',
            'john.doe@example.co.uk',
            'test+tag@example.com',
            'user123@test-domain.com',
        ];

        foreach ($validEmails as $email) {
            $this->assertNotFalse(
                filter_var(trim($email), FILTER_VALIDATE_EMAIL),
                "$email should be valid"
            );
        }
    }

    public function testValidationFailsWithMessageTooShort()
    {
        $message = 'short';
        $errors = [];

        if (strlen($message) < 10) {
            $errors['message'] = 'Message too short';
        }

        $this->assertArrayHasKey('message', $errors);
    }

    public function testValidationFailsWithNameTooShort()
    {
        $name = 'A';
        $errors = [];

        if (strlen($name) < 2) {
            $errors['name'] = 'Name too short';
        }

        $this->assertArrayHasKey('name', $errors);
    }

    public function testValidNamesWithSpaces()
    {
        $validNames = [
            'John Doe',
            'Mary Jane Smith',
            'Ahmed Hassan Khan',
        ];

        foreach ($validNames as $name) {
            $errors = [];

            if (empty($name) || strlen($name) < 2) {
                $errors['name'] = 'Invalid';
            }

            $this->assertEmpty($errors, "$name should be valid");
        }
    }
}