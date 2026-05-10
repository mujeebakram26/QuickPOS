<?php
/**
 * Page Load Availability Tests
 * Tests that pages load and are accessible
 */

use PHPUnit\Framework\TestCase;

class PageLoadTest extends TestCase
{
    /**
     * Test that index.php exists
     * POS-211: Test main index.php file exists
     */
    public function testIndexFileExists()
    {
        $indexPath = dirname(__DIR__) . '/src/index.php';
        $this->assertFileExists($indexPath, 'index.php file should exist');
    }

    /**
     * Test that CSS file exists
     * POS-212: Test CSS stylesheet exists
     */
    public function testCSSFileExists()
    {
        $cssPath = dirname(__DIR__) . '/css/style.css';
        $this->assertFileExists($cssPath, 'CSS file should exist');
    }

    /**
     * Test that JavaScript file exists
     * POS-213: Test JavaScript file exists
     */
    public function testJSFileExists()
    {
        $jsPath = dirname(__DIR__) . '/js/script.js';
        $this->assertFileExists($jsPath, 'JavaScript file should exist');
    }

    /**
     * Test that PHP files have no syntax errors
     * POS-214: Test PHP syntax validation
     */
    public function testPHPSyntaxIsValid()
    {
        // Use PHP's linting to check syntax
        $indexPath = dirname(__DIR__) . '/src/index.php';
        
        $output = [];
        $return = 0;
        exec("php -l " . escapeshellarg($indexPath), $output, $return);

        $this->assertEquals(0, $return, 'PHP files should have valid syntax');
    }

    /**
     * Test that process-form.php exists
     * POS-215: Test form processor file exists
     */
    public function testProcessFormFileExists()
    {
        $processPath = dirname(__DIR__) . '/src/process-form.php';
        $this->assertFileExists($processPath, 'Form processor PHP file should exist');
    }

    /**
     * Test that thank-you page exists
     * POS-216: Test thank you page exists
     */
    public function testThankYouPageExists()
    {
        $thankYouPath = dirname(__DIR__) . '/src/thank-you.html';
        $this->assertFileExists($thankYouPath, 'Thank you page should exist');
    }

    /**
     * Test that composer.json exists
     * POS-217: Test composer dependencies file
     */
    public function testComposerFileExists()
    {
        $composerPath = dirname(__DIR__) . '/composer.json';
        $this->assertFileExists($composerPath, 'composer.json should exist');
    }
}