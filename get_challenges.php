<?php
include('background_db_connector.php');

$stmt = $DbConnectionObj->prepare("SELECT Id, Title, Description, Points FROM challenges");
$stmt->execute();
$result = $stmt->get_result();

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = [
        'Id'          => (int)$row['Id'],
        'Title'       => e($row['Title']),
        'Description' => e($row['Description']),
        'Points'      => (int)$row['Points']
    ];
}

echo json_encode($categories);

$stmt->close();
