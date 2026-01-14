<?php
session_start();
require("background_db_connector.php");

// Session user ID
$userId = $_SESSION['Id'] ?? null;
$code   = $_POST['code'] ?? null;

if (!$userId || !$code) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);
    exit;
}

// Ensure 3-digit numeric code
if (!preg_match('/^[0-9]{3}$/', $code)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid code format."
    ]);
    exit;
}

// Check if code matches for this user
$query = "
    SELECT Id 
    FROM employee 
    WHERE Id = ? AND Code = ?
    LIMIT 1
";

$stmt = mysqli_prepare($DbConnectionObj, $query);
mysqli_stmt_bind_param($stmt, "ii", $userId, $code);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) !== 1) {
    echo json_encode([
        "success" => false,
        "message" => "Incorrect code."
    ]);
    exit;
}

// Code correct → update Auth
$update = "
    UPDATE employee
    SET Auth = 1
    WHERE Id = ?
";

$updateStmt = mysqli_prepare($DbConnectionObj, $update);
mysqli_stmt_bind_param($updateStmt, "i", $userId);
mysqli_stmt_execute($updateStmt);

echo json_encode([
    "success" => true,
    "message" => "Authentication successful."
]);
