<?php
session_start();
include('background_db_connector.php');

header('Content-Type: application/json');

if (!isset($_SESSION['Id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$title = trim($data['title'] ?? '');
$content = trim($data['content'] ?? '');

if ($title === '' || $content === '') {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}

$userId = $_SESSION['Id'];


$stmt = $DbConnectionObj->prepare("
    INSERT INTO post (UserId, Title, Content)
    VALUES (?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed']);
    exit;
}

$stmt->bind_param("iss", $userId, $title, $content);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute failed']);
}

$stmt->close();

$stmt2 = $DbConnectionObj->prepare("
    UPDATE User SET EcoPoints = EcoPoints + 50 WHERE Id = ?
");
$stmt2->bind_param('i', $userId);
$stmt2->execute();
$stmt2->close();
