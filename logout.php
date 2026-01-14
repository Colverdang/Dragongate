<?php
session_start();
$Auth = $_SESSION['Auth'] ?? false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    $_SESSION['Auth'] = false;

    $ResultArr = [
        'success' => true,
        'status' => $Auth
    ];

    echo json_encode($ResultArr);
}
?>