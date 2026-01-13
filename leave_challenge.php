<?php
session_start();
include('background_db_connector.php');

$activeId = $_POST['active_id'];
$userId   = $_SESSION['Id'];

$SQLStr = "
UPDATE activechallenges
SET Status = 'Abandoned'
WHERE Id = ? AND UserId = ?
";

$StmtObj = $DbConnectionObj->prepare($SQLStr);
$StmtObj->bind_param('ii', $activeId, $userId);

try {
    $StmtObj->execute();

    echo json_encode([
        'success' => true
    ]);
} catch (mysqli_sql_exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
