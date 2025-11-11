<?php
include 'background_db_connector.php';
session_start();

if (!isset($_SESSION['Auth']) || !$_SESSION['Auth']) {
    echo json_encode(['success' => false, 'Auth' => false]);
    exit;
}

$userId = $_SESSION['Id'];

// 1. Find active order session
$SQL = "SELECT Id FROM OrderSession WHERE User_Id = ? AND Active = 1 ORDER BY Id DESC LIMIT 1";
$stmt = $DbConnectionObj->prepare($SQL);
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($orderSessionId);
$stmt->fetch();
$stmt->close();

if (!$orderSessionId) {
    // No active cart
    echo json_encode(['success' => true, 'total' => 0]);
    exit;
}

$SQL = "SELECT COUNT(*)
        FROM OrderLineItem
        WHERE Session = ?;";

$stmt = $DbConnectionObj->prepare($SQL);
$stmt->bind_param('i', $orderSessionId);
$stmt->execute();
$stmt->bind_result($num);
$stmt->fetch();
$stmt->close();

$num = $num * 100;


$SQL = "UPDATE User
        SET EcoPoints = EcoPoints + ?
        WHERE Id = ?;";
$stmt = $DbConnectionObj->prepare($SQL);
$stmt->bind_param('ii', $num,$userId );
$stmt->execute();



$SQL = "UPDATE OrderSession
        SET Active = 0
        WHERE Id = ?;";
$stmt = $DbConnectionObj->prepare($SQL);
$stmt->bind_param('i', $orderSessionId );
$stmt->execute();

echo json_encode([
    'success' => true,
]);






