<?php
$conn = require 'background_db_connector.php';

$sql = "SELECT Id, Name, Surname, Email, EcoPoints FROM user ORDER BY Id DESC";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$conn->close();
