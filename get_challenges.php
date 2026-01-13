<?php
include('background_db_connector.php');

// Prepare the SQL statement
$stmt = $DbConnectionObj->prepare("SELECT * FROM challenges");
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

echo json_encode($categories);

// Close the statement
$stmt->close();
?>

