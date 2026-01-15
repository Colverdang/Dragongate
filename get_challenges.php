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
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = [
        'Id'          => (int)$row['Id'],
        'Title'       => e($row['Title']),
        'Description' => e($row['Description']),
        'Points'      => (int)$row['Points'],
        'Status'      => $row['Status'],      // safe enum
        'ActiveId'    => $row['ActiveId'] ?? null
    ];
}

echo json_encode($categories);


// Close the statement
$stmt->close();
?>

