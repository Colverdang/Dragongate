<?php
session_start();
include('background_db_connector.php');

$data = json_decode(file_get_contents("php://input"), true);
$postId = $data['postId'];
$userId = $_SESSION['Id'];


$sql = "SELECT * FROM postlike WHERE PostId=? AND UserId=?";
$stmt = $DbConnectionObj->prepare($sql);
$stmt->bind_param("ii", $postId, $userId);
$stmt->execute();

$result = $stmt->get_result();
$like = $result->fetch_assoc();

if ($like) {
    $newState = $like['Active'] ? 0 : 1;

    $update = $DbConnectionObj->prepare("UPDATE postlike SET Active=? WHERE UserId=? AND PostId=?");
    $update->bind_param("iii", $newState, $like['UserId'],$like['PostId']);
    $update->execute();
} else {
    $insert = $DbConnectionObj->prepare(
        "INSERT INTO postlike (PostId, UserId, Active) VALUES (?, ?, 1)"
    );
    $insert->bind_param("ii", $postId, $userId);
    $insert->execute();
}

echo json_encode(['success' => true]);
