<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set content type
header('Content-Type: text/html; charset=UTF-8');

// Initialize response
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data and trim whitespace
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // ============================================
    // VALIDATION RULES
    // ============================================

    // 1. CHECK IF NAME IS EMPTY
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    } elseif (strlen($name) < 2) {
        $response['errors']['name'] = 'Name must be at least 2 characters';
    } elseif (strlen($name) > 100) {
        $response['errors']['name'] = 'Name must not exceed 100 characters';
    }

    // 2. CHECK IF EMAIL IS EMPTY
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // PHP's built-in email validation
        $response['errors']['email'] = 'Please enter a valid email address';
    }

    // 3. CHECK IF MESSAGE IS EMPTY
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $response['errors']['message'] = 'Message must be at least 10 characters';
    } elseif (strlen($message) > 5000) {
        $response['errors']['message'] = 'Message must not exceed 5000 characters';
    }

    // ============================================
    // IF NO ERRORS, PROCESS FORM
    // ============================================

    if (empty($response['errors'])) {
        // Here you could save to database, send email, etc.
        // For now, we'll just mark it as successful
        
        $response['success'] = true;
        $response['message'] = 'Thank you! Your message has been sent successfully. We will contact you soon.';

        // OPTIONAL: Save form data to a file (for demonstration)
        // $formData = "Name: $name | Email: $email | Message: $message | Time: " . date('Y-m-d H:i:s') . "\n";
        // file_put_contents('form_submissions.txt', $formData, FILE_APPEND);

        // OPTIONAL: Send email notification
        // $to = 'admin@quickpos.com';
        // $subject = 'New Contact Form Submission from ' . htmlspecialchars($name);
        // $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        // mail($to, $subject, $body);
    }
} else {
    // Not a POST request
    $response['message'] = 'Invalid request method';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;