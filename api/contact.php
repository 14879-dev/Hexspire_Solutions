<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$name    = trim($input['name']    ?? '');
$email   = trim($input['email']   ?? '');
$subject = trim($input['subject'] ?? '');
$message = trim($input['message'] ?? '');

// Validation
$errors = [];
if (empty($name))                            $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if (empty($subject))                         $errors[] = 'Subject is required.';
if (empty($message))                         $errors[] = 'Message is required.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$db   = getDB();
$stmt = $db->prepare("INSERT INTO hs_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $email, $subject, $message]);

echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully!']);
