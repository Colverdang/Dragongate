<?php
session_start();

require('background_db_connector.php'); // must create $DbConnectionObj as mysqli

if (!isset($_SESSION['Id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
    exit;
}

$userId = $_SESSION['Id'];

try {
    // Check existing subscription
    $checkSql = "SELECT Id, Active FROM subscription WHERE UserId = ?";
    $stmt = $DbConnectionObj->prepare($checkSql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing = $result->fetch_assoc();
    $stmt->close();

    if ($existing) {
        if ((int)$existing['Active'] === 1) {
            echo json_encode([
                'success' => false,
                'message' => 'Subscription already active'
            ]);
            exit;
        } else {
            // Reactivate subscription
            $updateSql = "UPDATE subscription SET Active = 1 WHERE UserId = ?";
            $stmt = $DbConnectionObj->prepare($updateSql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();

            echo json_encode([
                'success' => true,
                'message' => 'Subscription reactivated'
            ]);
            exit;
        }
    }

    // Create new subscription
    $insertSql = "INSERT INTO subscription (UserId, Active) VALUES (?, 1)";
    $stmt = $DbConnectionObj->prepare($insertSql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Subscription created'
    ]);

} catch (Throwable $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Server error'
    ]);
}
