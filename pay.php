<?php
header('Content-Type: application/json');
session_start();
require('background_db_connector.php');

if (!isset($_SESSION['Id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = (int)$_SESSION['Id'];


$data = json_decode(file_get_contents("php://input"), true);
$discountApplied = !empty($data['discountApplied']);
$subtotal = (float)$data['price'];


mysqli_begin_transaction($DbConnectionObj);

try {


    $stmt = mysqli_prepare($DbConnectionObj,
        "SELECT EcoPoints FROM user WHERE Id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$user = mysqli_fetch_assoc($result)) {
        throw new Exception("User not found");
    }

    $ecoPoints = (int)$user['EcoPoints'];

    $discountPercent = $discountApplied ? floor($ecoPoints / 500) : 0;
    $pointsUsed = $discountPercent * 500;


    $stmt = mysqli_prepare($DbConnectionObj, "
        SELECT Id 
        FROM cart 
        WHERE userid = ? AND state = '1'
        ORDER BY Id DESC 
        LIMIT 1
    ");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$cart = mysqli_fetch_assoc($result)) {
        throw new Exception("No active cart found. " . $subtotal);
    }

    $cartId = (int)$cart['Id'];


//    $totalResult = mysqli_query($DbConnectionObj, "
//        SELECT SUM(price * quantity) AS total
//        FROM cartitems
//        WHERE cartid = $cartId
//    ");
//
//    $row = mysqli_fetch_assoc($totalResult);
//    $subtotal = (float)$row['total'];
//
//    if ($subtotal <= 0) {
//        throw new Exception("Cart is empty");
//    }

    $finalTotal = $subtotal - ($subtotal * ($discountPercent / 100));

    $stmt = mysqli_prepare($DbConnectionObj, "
        INSERT INTO orders (userid, cartid, total)
        VALUES (?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt, "iid", $userId, $cartId, $finalTotal);
    mysqli_stmt_execute($stmt);


    if ($discountApplied && $pointsUsed > 0) {
        // Deduct used points
        $stmt = mysqli_prepare($DbConnectionObj, "
            UPDATE user
            SET EcoPoints = EcoPoints - ?
            WHERE Id = ?
        ");
        mysqli_stmt_bind_param($stmt, "ii", $pointsUsed, $userId);
        mysqli_stmt_execute($stmt);
    } else {
        // Reward user
        $stmt = mysqli_prepare($DbConnectionObj, "
            UPDATE user
            SET EcoPoints = EcoPoints + 100
            WHERE Id = ?
        ");
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
    }

    $stmt = mysqli_prepare($DbConnectionObj,
        "UPDATE cart SET state = '0' WHERE Id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    mysqli_stmt_execute($stmt);

    mysqli_commit($DbConnectionObj);

    echo json_encode(['success' => true]);

} catch (Exception $e) {

    mysqli_rollback($DbConnectionObj);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
