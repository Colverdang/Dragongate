<?php
session_start();
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $product_id = $_GET['id'];
    $Active=0;

    $STMP = "UPDATE cartitem SET Active = ? WHERE Id = '$product_id'";
    $stmt = $DbConnectionObj->prepare($STMP);
    $stmt->bind_param("i", $Active);
    $stmt->execute();
    $stmt->close();

}
?>