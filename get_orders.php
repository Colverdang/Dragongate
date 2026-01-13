<?php
include('background_db_connector.php');

// Prepare SQL with JOIN
$sql = "
    SELECT 
        o.Id AS id,
        CONCAT(u.Name, ' ', u.Surname) AS user,
        o.total AS amount
    FROM orders o
    INNER JOIN user u ON o.userid = u.Id
";

$stmt = $DbConnectionObj->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

// Close statement
$stmt->close();
?>
