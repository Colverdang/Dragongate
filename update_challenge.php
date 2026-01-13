<?php
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $points = $_POST['points'] ?? null;

    if (!$id || !$title || !$description || $points === null) {
        echo json_encode([
            'success' => false,
            'error' => 'Missing fields'
        ]);
        exit;
    }

    if (!is_numeric($points) || $points < 0) {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid points value'
        ]);
        exit;
    }

    $stmt = $DbConnectionObj->prepare(
        "UPDATE challenges
         SET Title = ?, Description = ?, Points = ?
         WHERE Id = ?"
    );

    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'error' => $DbConnectionObj->error
        ]);
        exit;
    }

    $points = (int)$points;
    $id = (int)$id;

    $stmt->bind_param("ssii", $title, $description, $points, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $stmt->error
        ]);
    }

    $stmt->close();
    exit;
}
?>
