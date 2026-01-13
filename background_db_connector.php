<?php
//$ServerNameStr = "localhost";
//$UsernameStr = "root";
//$PasswordStr = "";
//$DatabaseStr = "dgtest";
//
//$DbConnectionObj = new mysqli($ServerNameStr, $UsernameStr, $PasswordStr, $DatabaseStr);
//
//if ($DbConnectionObj->connect_error) {
//    echo "Database connection failed: " . $DbConnectionObj->connect_error;
//    exit();
//}
//return $DbConnectionObj;
//?>


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
