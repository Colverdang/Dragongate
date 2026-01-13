<?php
include('background_db_connector.php');
$name    = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email   = $_POST['email'] ?? '';
$role    = $_POST['role'] ?? 0;
$code    = $_POST['code'] ?? null;

if (!$name || !$surname || !$email || !$role || !$code) {
    echo json_encode([
        "success" => false,
        "error" => "Missing required fields"
    ]);
    exit;
}

$stmt = $DbConnectionObj->prepare(
    "INSERT INTO employee (Name, Surname, Email, Role, Code)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssii", $name, $surname, $email, $role, $code);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
}
