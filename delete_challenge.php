<?php
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid or missing challenge ID'
    ]);
    exit;
}

$sql = "DELETE FROM challenges WHERE Id = ?";
$stmt = $DbConnectionObj->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'error' => $DbConnectionObj->error
    ]);
    exit;
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => $stmt->error
    ]);
}

$stmt->close();
exit;
?>
