<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$Auth = $_SESSION['Auth'] ?? false;

if($Auth !== true){
    $html = ' <div class="header-cart">                   
    <span class="inline">
                    <a class="nav-link" href="..\login_process\DGLogin.php">Login</a>
                    <a class="nav-link" href="..\Signip_process\DGSignup.php">Sign Up</a>
                    </span>
                    </div>'
                    ;
} else {
    $html = '           <div class="header-cart">
             <a href="/cart" class="text-background">
                        <i class="bi bi-cart fs-4"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </a>
                    </div>
                    <a class="nav-link" href="#" onclick="Logout()" >Sign out</a>';
                    
}

echo $html . "\n";
// echo $Auth . "\n";
// echo true;
?>

