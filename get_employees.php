<?php
include('background_db_connector.php');

$result = $DbConnectionObj->query("SELECT * FROM employee ORDER BY Id DESC");

$employees = [];

while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode($employees);
