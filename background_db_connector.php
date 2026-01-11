<?php
$ServerNameStr = "ballast.proxy.rlwy.net";
$UsernameStr = "root";
$PasswordStr = "SwaaNQfIHMqdMhjnqBXjcGxKeRviMsrU";
$DatabaseStr = "railway";
$PortStr = "59399";

$DbConnectionObj = new mysqli($ServerNameStr, $UsernameStr, $PasswordStr, $DatabaseStr, $PortStr);

if ($DbConnectionObj->connect_error) {
    echo "Database connection failed: " . $DbConnectionObj->connect_error;
    exit();
}
return $DbConnectionObj;
?>