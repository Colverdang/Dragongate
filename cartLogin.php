<?php 
//session_start();

$Auth = $_SESSION['Auth'] ?? false;

if($Auth ==! true){
    $html = '                    <span class="inline">
                    <a class="nav-link" href="..\login_process\DGLogin.php">Login</a>
                    <a class="nav-link" href="..\Signip_process\DGSignup.php">Sign Up</a>
                    </span>';
} else {
    $html = '                    <a href="/cart" class="text-background">
                        <i class="bi bi-cart fs-4"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </a>';
}

echo $html;
?>