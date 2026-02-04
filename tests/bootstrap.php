<?php

// Bootstrap file for PHPUnit tests
// This file is loaded before running tests

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define constants for testing
define('TESTING', true);

// Load Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';
