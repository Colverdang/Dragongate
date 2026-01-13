<?php
session_start();
include('background_db_connector.php');

$activeId = $_POST['active_id'];
$points = $_POST['points'];
$userId   = $_SESSION['Id'];

$SQLStr = "
UPDATE activechallenges
SET Status = 'Completed'
WHERE Id = ? AND UserId = ?
";

$StmtObj = $DbConnectionObj->prepare($SQLStr);
$StmtObj->bind_param('ii', $activeId, $userId);

try {
    $StmtObj->execute();

    $stmt2 = $DbConnectionObj->prepare("
    UPDATE user SET EcoPoints = EcoPoints + ? WHERE Id = ?
");
    $stmt2->bind_param('ii', $points,$userId);
    try {
        $stmt2->execute();
    } catch(Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit();
    }
    $stmt2->close();

    echo json_encode([
        'success' => true,
        'id' => $activeId,
        'points' => $points,
    ]);
} catch (mysqli_sql_exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
