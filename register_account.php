<?php
include('background_db_connector.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FirstNameStr = $_POST['name'] ?? "null";
    $SurnameStr = $_POST['surname'] ?? "null";
    $EmailAddressStr = $_POST['email'] ?? "null";
    $PasswordStr = $_POST['password'] ?? "null";
    $ConfirmPasswordStr = $_POST['cpassword'] ?? "nulll";

    $EmailPatternStr = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    $PasswordPatternStr = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+={}[\]|:;,.<>?\/]).{8,}$/i';
    $PasswordMatchBool = $PasswordStr === $ConfirmPasswordStr;

    if (!preg_match($PasswordPatternStr, $PasswordStr) || !preg_match($EmailPatternStr, $EmailAddressStr) || !$PasswordMatchBool) {
        $ResultArr = [
            'success' => false,
            'duplicate_email' => false,
            'message' => "Error processing your request",
        ];
        echo json_encode($ResultArr);
        exit();
    }

    $HashedPassword = password_hash($PasswordStr, PASSWORD_DEFAULT);

    $SQLStr = 'INSERT INTO User (FirstName, Lastname, Email, Password) VALUES (?,?,?,?)';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('ssss', $FirstNameStr, $SurnameStr, $EmailAddressStr, $HashedPassword);
    try {
        $StmtObj->execute();

            $ResultArr = [
                'success' => true,
                'message' => "account has been created"
            ];
        echo json_encode($ResultArr);
    } catch (mysqli_sql_exception $e) {
        switch ($e->getCode()) {
            case 1062:
                $ResultArr = [
                    'success' => false,
                    'duplicate_email' => true,
                    'message' => "Email address already exists"
                ];
                break;
            default:
                $ResultArr = [
                    'success' => false,
                    'duplicate_email' => false,
                    'message' => $e->getMessage()
                ];
                break;
        }
        echo json_encode($ResultArr);
    }
    }
?>