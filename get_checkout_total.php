<?php
include 'background_db_connector.php';
session_start();

if (!isset($_SESSION['Auth']) || !$_SESSION['Auth']) {
    echo json_encode(['success' => false, 'Auth' => false]);
    exit;
}

$userId = $_SESSION['Id'];

// 1. Find active order session
$SQL = "SELECT Id FROM cart WHERE UserId = ? AND state = 1 ORDER BY Id DESC LIMIT 1";
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

// 2. Sum prices by joining OrderLineItem → Product
$SQL = "
    SELECT SUM(p.Price) AS Total
    FROM cartitem oli
    JOIN products p ON oli.productid = p.Id
    WHERE oli.cartid = ?
";
$stmt = $DbConnectionObj->prepare($SQL);
$stmt->bind_param('i', $orderSessionId);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();
$stmt->close();

if (!$total) $total = 0;

echo json_encode([
    'success' => true,
    'total' => number_format($total, 2, '.', '')
]);
