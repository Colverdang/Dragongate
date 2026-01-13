<?php
include('background_db_connector.php');
session_start();

$challengeId = $_POST['challenge_id'];
$userId = $_SESSION['Id'];

$SQLStr = "
INSERT INTO activechallenges (ChallengeId, UserId, Status)
VALUES (?, ?, 'Active')
";

$StmtObj = $DbConnectionObj->prepare($SQLStr);
$StmtObj->bind_param('ii', $challengeId, $userId);

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
