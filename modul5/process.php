<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo json_encode(["success" => false]);
    exit();
}
require 'db.php';

$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';
$timestamp = date("Y-m-d H:i:s");

if (!empty($email) && !empty($message)) {
    $stmt = $conn->prepare("INSERT INTO guestbook (email, message, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $message, $timestamp);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "entry" => [
            "email" => htmlspecialchars($email),
            "message" => htmlspecialchars($message),
            "timestamp" => $timestamp
        ]
    ]);
} else {
    echo json_encode(["success" => false]);
}
?>
