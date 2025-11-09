<?php
$ServerNameStr = "sql8.freesqldatabase.com";
$UsernameStr = "sql8806150";
$PasswordStr = "yNX6bzjpx1";
$DatabaseStr = "sql8806150";

$DbConnectionObj = new mysqli($ServerNameStr, $UsernameStr, $PasswordStr, $DatabaseStr);

if ($DbConnectionObj->connect_error) {
    echo "Database connection failed: " . $DbConnectionObj->connect_error;
    exit();
}
return $DbConnectionObj;
?>