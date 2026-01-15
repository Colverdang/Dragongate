<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'background_db_connector.php';

$Auth = $_SESSION['Auth'] ?? false;

if($Auth !== true){
    $html = ' <div class="header-cart">                   
    <span class="inline">
                    <a class="nav-link" href="..\Signip_process\DGSignup.php">Sign in/up</a>
                    </span>
                    </div>'
                    ;
} else {

    $UserId = $_SESSION['Id'];
    $SQLStr = 'SELECT Id FROM cart WHERE userid = ? AND state = 1 ORDER BY Id DESC LIMIT 1';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('i', $UserId);
    $StmtObj->execute();
    $StmtObj->bind_result($OrderSessionId);
    $StmtObj->fetch();
    $StmtObj->close();

    $SQLStr = 'SELECT COUNT(*) FROM cartitem WHERE cartid = ? AND active = 1 ';
    $StmtObj = $DbConnectionObj->prepare($SQLStr);
    $StmtObj->bind_param('i', $OrderSessionId);
    $StmtObj->execute();
    $StmtObj->bind_result($numberOfItems);
    $StmtObj->fetch();
    $StmtObj->close();

    $html = '
    <div class="d-flex align-items-center gap-3">
        <a href="../cart_page.php" class="text-background position-relative">
            <i class="bi bi-cart fs-4"></i>
            <span class="cart-badge" id="cartCount">'.$numberOfItems.'</span>
        </a>
        <a class="nav-link" href="#" onclick="Logout()">Sign out</a>
    </div>';
                    
}

echo $html . "\n";
// echo $Auth . "\n";
// echo true;
?>

