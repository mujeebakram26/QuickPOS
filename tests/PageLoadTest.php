<?php

use PHPUnit\Framework\TestCase;

class PageLoadTest extends TestCase
{
    public function testIndexFileExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/src/index.php');
    }

    public function testCSSFileExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/css/style.css');
    }

    public function testJSFileExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/js/script.js');
    }

    public function testPHPSyntaxIsValid()
    {
        $file = dirname(__DIR__) . '/src/index.php';

        $output = [];
        $return = 0;

        exec("php -l " . escapeshellarg($file), $output, $return);

        $this->assertEquals(0, $return);
    }

    public function testProcessFormFileExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/src/process-form.php');
    }

    public function testThankYouPageExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/src/thank-you.html');
    }

    public function testComposerFileExists()
    {
        $this->assertFileExists(dirname(__DIR__) . '/composer.json');
    }
}