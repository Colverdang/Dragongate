<?php
include 'background_db_connector.php';
session_start();

if (!isset($_SESSION['Auth']) || !$_SESSION['Auth']) {
    echo json_encode(['success' => false, 'Auth' => false]);
    exit;
}

$UserId = $_SESSION['Id']; 
$date = date('Y-m-d');

// Initialize session cart array (still useful for UI)
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ProductId = $_POST['id'];
    $ProductName = $_POST['name'];
    $ProductPrice = $_POST['price'];

    // Add to session cart (optional but good for UI consistency)
    $_SESSION['cart'][] = [
        'id' => $ProductId,
        'name' => $ProductName,
        'price' => $ProductPrice
    ];

    // 1. Check if user already has active order session
    $SQLStr = 'SELECT Id FROM cart WHERE userid = ? AND state = 1 ORDER BY Id DESC LIMIT 1';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('i', $UserId);
    $StmtObj->execute();
    $StmtObj->bind_result($OrderSessionId);
    $StmtObj->fetch();
    $StmtObj->close();

    // 2. If no active session, create one
    if (!$OrderSessionId) {
        $SQLStr = 'INSERT INTO cart (UserId, state) VALUES (?, 1)';
        $StmtObj = $DbConnectionObj->prepare($SQLStr);
        $StmtObj->bind_param('i', $UserId);
        $StmtObj->execute();
        $OrderSessionId = $StmtObj->insert_id;
        $StmtObj->close();
    }

    // 3. Insert product into OrderItems table
    $SQLStr = 'INSERT INTO cartitem (cartid, productid) VALUES (?, ?)';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('ii', $OrderSessionId, $ProductId);
    $StmtObj->execute();
    $StmtObj->close();

    echo json_encode(['success' => true, 'Auth' => true]);
    exit;
}

echo json_encode(['success' => false, 'Auth' => true]);
