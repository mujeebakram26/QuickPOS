<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=UTF-8');

$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // ============================================
    // NAME VALIDATION
    // ============================================
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    } elseif (strlen($name) < 2) {
        $response['errors']['name'] = 'Name must be at least 2 characters';
    } elseif (strlen($name) > 100) {
        $response['errors']['name'] = 'Name must not exceed 100 characters';
    }

    // ============================================
    // EMAIL VALIDATION
    // ============================================
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Please enter a valid email address';
    }

    // ============================================
    // MESSAGE VALIDATION
    // ============================================
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $response['errors']['message'] = 'Message must be at least 10 characters';
    } elseif (strlen($message) > 5000) {
        $response['errors']['message'] = 'Message must not exceed 5000 characters';
    }

    // ============================================
    // ADVANCED VALIDATION (NEW ADDED RULES)
    // ============================================

    // 4. NAME CHARACTER VALIDATION
    if (!empty($name) && !preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
        $response['errors']['name'] = 'Name can only contain letters, spaces, hyphens, and apostrophes';
    }

    // 5. SPAM DETECTION
    if (!empty($message)) {
        $spamKeywords = ['viagra', 'casino', 'lottery', 'click here'];
        $messageLower = strtolower($message);

        foreach ($spamKeywords as $keyword) {
            if (strpos($messageLower, $keyword) !== false) {
                $response['errors']['message'] = 'Your message contains prohibited content';
                break;
            }
        }
    }

    // ============================================
    // SUCCESS RESPONSE
    // ============================================
    if (empty($response['errors'])) {
        $response['success'] = true;
        $response['message'] = 'Thank you! Your message has been sent successfully. We will contact you soon.';
    }

} else {
    $response['message'] = 'Invalid request method';
}

header('Content-Type: application/json');
echo json_encode($response);
exit;