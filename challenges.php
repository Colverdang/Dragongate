<?php
include('background_db_connector.php');
session_start();

header('Content-Type: application/json');

$userId = $_SESSION['Id'];

$SQLStr = "
SELECT 
    c.Id,
    c.Title,
    c.Description,
    c.Points,
    ac.Id AS ActiveId,
    ac.Status
FROM challenges c
LEFT JOIN activechallenges ac
    ON c.Id = ac.ChallengeId
    AND ac.UserId = ?
";

$StmtObj = $DbConnectionObj->prepare($SQLStr);
$StmtObj->bind_param('i', $userId);

try {
    $StmtObj->execute();

    $ResultObj = $StmtObj->get_result();
    $ResultArr = $ResultObj->fetch_all(MYSQLI_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $ResultArr
    ]);
} catch (mysqli_sql_exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}