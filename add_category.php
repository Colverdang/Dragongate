<?php
include('background_db_connector.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null; // FIXED

    if (!$name || !$description) {
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }

    // Use prepared statement
    $stmt = $DbConnectionObj->prepare("INSERT INTO Category (name, description) VALUES (?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => $DbConnectionObj->error]);
        exit;
    }

    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    exit;
}
?>
