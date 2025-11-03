<?php
$ServerNameStr = "localhost";
$UsernameStr = "root";
$PasswordStr = "";
$DatabaseStr = "DGTEST";

$DbConnectionObj = new mysqli($ServerNameStr, $UsernameStr, $PasswordStr, $DatabaseStr);

if ($DbConnectionObj->connect_error) {
    echo "Database connection failed: " . $DbConnectionObj->connect_error;
    exit();
}
return $DbConnectionObj;
?>