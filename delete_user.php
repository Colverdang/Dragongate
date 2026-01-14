<?php
$conn = require 'background_db_connector.php';

$id = $_POST['id'] ?? '';

if (!$id) {
    echo json_encode(['success' => false, 'error' => 'Invalid user ID']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM user WHERE Id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Delete failed']);
}

$stmt->close();
$conn->close();
