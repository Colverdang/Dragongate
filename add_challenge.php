<?php
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $points = $_POST['points'] ?? null;

    // Basic validation
    if (!$title || !$description || $points === null) {
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

    // Prepared statement
    $stmt = $DbConnectionObj->prepare(
        "INSERT INTO challenges (Title, Description, Points) VALUES (?, ?, ?)"
    );

    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'error' => $DbConnectionObj->error
        ]);
        exit;
    }

    $points = (int)$points;
    $stmt->bind_param("ssi", $title, $description, $points);

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
