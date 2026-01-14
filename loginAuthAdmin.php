<?php
session_start();
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $EmailAddressStr = $_POST['email'] ?? "null";
    $PasswordStr = $_POST['password'] ?? "null";

    $SQLStr = 'SELECT Id, Password, Auth, Role FROM employee WHERE Email = ?';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('s',  $EmailAddressStr);
    try {
        $StmtObj->execute();
        $StmtObj->bind_result($Id, $VPass, $Auth, $Role);
        $StmtObj->fetch();


        $PasswordVerdictBool = password_verify($PasswordStr, $VPass ?? "wrong");

        if (!$PasswordVerdictBool) {
            $ResultArr = [
                'success' => false,
                'message' => "Invalid Email or Password!"
            ];
        } else{


            $ResultArr = [
                'success' => true,
                'message' => "You have been logged in",
                'Auth' => (bool) $Auth

            ];

            $_SESSION['Auth'] = true;
            $_SESSION['Id'] = $Id;
            $_SESSION['Role'] = $Role;
        }



        // echo json_encode($ResultArr);
    } catch (mysqli_sql_exception $e) {

        $ResultArr = [
            'success' => false,
            'duplicate_email' => false,
            'message' => "problem processing request"
        ];

    }
    echo json_encode($ResultArr);
}

?>