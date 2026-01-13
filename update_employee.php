<?php
include('background_db_connector.php');
$id      = $_POST['id'] ?? 0;
$name    = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email   = $_POST['email'] ?? '';
$role    = $_POST['role'] ?? 0;
$code    = $_POST['code'] ?? null;

if (!$id) {
    echo json_encode([
        "success" => false,
        "error" => "Invalid employee ID"
    ]);
    exit;
}

$stmt = $DbConnectionObj->prepare(
    "UPDATE employee
     SET Name = ?, Surname = ?, Email = ?, Role = ?, Code = ?
     WHERE Id = ?"
);
$stmt->bind_param("sssiii", $name, $surname, $email, $role, $code, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
}
