<?php
/**
 * Test Bootstrap File
 * This file is included before running tests
 */

// Define root directory
define('ROOT_DIR', dirname(__DIR__));

// Enable error reporting for tests
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Autoload classes if needed
function autoloadClass($class) {
    $file = ROOT_DIR . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoloadClass');