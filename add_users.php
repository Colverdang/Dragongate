<?php
header('Content-Type: application/json');
$conn = require 'background_db_connector.php';

$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$name || !$surname || !$email || !$password) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (Name, Surname, Email, Password, EcoPoints)
     VALUES (?, ?, ?, ?, 0)"
);

$stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    if ($conn->errno === 1062) {
        echo json_encode(['success' => false, 'error' => 'Email already exists']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Insert failed']);
    }
}

$stmt->close();
$conn->close();
