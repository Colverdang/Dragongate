<?php
session_start();
require('background_db_connector.php');

$stmt = $DbConnectionObj->prepare(
    "UPDATE subscription SET Active = 0 WHERE UserId = ?"
);
$stmt->bind_param("i", $_SESSION['Id']);
$stmt->execute();

echo json_encode([
    'success' => true,
    'message' => 'You have successfully unsubscribed.'
]);
