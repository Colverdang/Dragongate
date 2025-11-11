<?php
include('background_db_connector.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $EmailAddressStr = $_POST['email'] ?? "null";
    $PasswordStr = $_POST['password'] ?? "null";

    $SQLStr = 'SELECT Id, Password FROM User WHERE Email = ?';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('s',  $EmailAddressStr);
    try {
        $StmtObj->execute();
            $StmtObj->bind_result($Id, $VPass);
            $StmtObj->fetch();


            $PasswordVerdictBool = password_verify($PasswordStr, $VPass ?? "wrong");

            if (!$PasswordVerdictBool) {
                $ResultArr = [
                    'success' => false,
                    'message' => "wrong pass " . $PasswordStr . "ddd " . ($VPass ?? "halo")
                ];
            } else{
                $ResultArr = [
                    'success' => true,
                    'message' => "You have been logged in"
                ];

                $_SESSION['Auth'] = true;
                $_SESSION['Id'] = $Id;
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