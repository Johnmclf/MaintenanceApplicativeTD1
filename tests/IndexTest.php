<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    /**
     * Test that the index page loads successfully
     */
    public function testIndexPageLoads(): void
    {
        // Start output buffering to capture the page output
        ob_start();

        // Set up server and GET variables to simulate a normal page load
        $_SERVER["REQUEST_METHOD"] = "GET";
        $_GET = [];
        $_POST = [];

        // Include the index page
        include __DIR__ . "/../src/index.php";

        // Get the output
        $output = ob_get_clean();

        // Assert that output was generated
        $this->assertNotEmpty($output, "Index page should generate output");

        // Assert that the page contains expected elements
        $this->assertStringContainsString("<form", $output, "Page should contain a form");
        $this->assertStringContainsString("champ1", $output, "Page should contain input field champ1");
    }
}
