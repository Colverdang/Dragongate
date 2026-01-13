<?php
include('background_db_connector.php');
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? 0;

if (!$id) {
    echo json_encode([
        "success" => false,
        "error" => "Invalid employee ID"
    ]);
    exit;
}

$stmt = $DbConnectionObj->prepare("DELETE FROM employee WHERE Id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
}
