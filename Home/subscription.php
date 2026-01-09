<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sustainable Subscription Boxes | DragonStone</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


<style>
:root {
  --primary: #28a745;
  --text: #333;
  --bg: #f8f9fa;
}

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  background: var(--bg);
  color: var(--text);
}

.hero {
  background: url('https://via.placeholder.com/1200x450?text=Sustainable+Living') center/cover no-repeat;
  padding: 120px 20px;
  color: #fff;
  text-align: center;
  position: relative;
}
.hero::before {
  content:"";
  position:absolute;
  inset:0;
  background:rgba(0,0,0,.45);
}
.hero > * {
  position:relative;
  z-index:1;
}
.hero a {
  display:inline-block;
  margin-top:15px;
  padding:12px 28px;
  background:var(--primary);
  color:#fff;
  border-radius:6px;
  text-decoration:none;
}

.section-box {
  background:#fff;
  padding:25px;
  border-radius:10px;
  max-width:800px;
  margin:40px auto;
  text-align:center;
  box-shadow:0 4px 8px rgba(0,0,0,.08);
}

.section-box ul {
  list-style:none;
  padding:0;
}

button.btn {
  background: var(--primary);
  border:none;
  padding:14px 28px;
  color:#fff;
  border-radius:6px;
  cursor:pointer;
  margin-top:15px;
}
button.btn:hover { opacity:.85; }

#signup {
  display:none;
  text-align:left;
}
#signup input, #signup button {
  width:100%;
  margin-top:10px;
  padding:10px;
  border-radius:6px;
  border:1px solid #ccc;
}

footer {
  background:#222;
  color:#fff;
  text-align:center;
  padding:20px;
  margin-top:60px;
}
footer a { color:#bbb; text-decoration:none; }
footer a:hover { color:#fff; }

           :root {
            --primary: #28a745; /* Green for sustainable theme */
            --background: #f8f9fa;
            --foreground: #212529;
            --muted: #6c757d;
            --accent: #20c997;
            --hero-gradient: linear-gradient(to right, rgba(33, 37, 41, 0.8), rgba(33, 37, 41, 0.4));
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--foreground);
            background-color: var(--background);
        }
        .bg-background { background-color: var(--background) !important; }
        .text-background { color: var(--background) !important; }
        .bg-foreground { background-color: var(--foreground) !important; }
        .text-foreground { color: var(--foreground) !important; }
        .bg-muted { background-color: #e9ecef !important; }
        .text-muted-foreground { color: var(--muted) !important; }
        .text-accent { color: var(--accent) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .text-primary { color: var(--primary) !important; }
        .bg-gradient-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #198754 100%);
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--hero-gradient);
        }
        .inline {
            display: flex;
            gap: 10px;
            justify-content: center;

        }
        .btn-hero {
            background-color: var(--background);
            color: var(--foreground);
            border: none;
            padding: 12px 24px;
            font-size: 1.125rem;
            font-weight: 500;
        }
        .btn-hero:hover {
            background-color: #e9ecef;
            color: var(--foreground);
        }
        .btn-outline-custom {
            background-color: rgba(248, 249, 250, 0.1);
            border: 1px solid var(--background);
            color: var(--background);
        }
        .btn-outline-custom:hover {
            background-color: var(--background);
            color: var(--foreground);
        }
        .icon-circle {
            width: 64px;
            height: 64px;
            background-color: rgba(40, 167, 69, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .icon-circle i {
            font-size: 2rem;
            color: var(--primary);
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .hero-img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }
        .category-card, .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .category-card:hover, .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        .category-card img, .product-card img {
            height: 250px;
            object-fit: cover;
        }
        .header-cart {
            position: relative;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        footer a {
            color: rgba(248, 249, 250, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: var(--background);
        }
        .hero-section {
            height: 600px;
            position: relative;
            overflow: hidden;
        }
        .nav-link {
            color: var(--background) !important;
            text-decoration: none;
            margin: 0 0.75rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--accent) !important;
        }
        .nav-link.active {
            color: var(--accent) !important;
            font-weight: 500;
        }

        .user-nav {
    display: flex;
    align-items: center;
    gap: 16px; 
}

.cart-link {
    position: relative; 
    display: inline-flex;
    align-items: center;
}

.cart-badge {
    position: absolute;
    top: -6px;
    right: -10px;
}
</style>
</head>
<body>

    <header class="bg-foreground text-background py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="text-xl fw-bold text-background">
                    <i class="bi bi-leaf me-2"></i>DragonStone
                </a>
                <nav class="d-none d-md-flex">
                    <a href="Homepage.php" class="nav-link">Home</a>
                    <a href="products.php" class="nav-link">Products</a>
                    <a href="community.php" class="nav-link">Community</a>
                    <a href="ecopoints.php" class="nav-link ">Eco-Points</a>
                    <a href="subscription.php" class="nav-link active">Subscription</a>
                </nav>
                <!-- <div class="header-cart"> -->
                    <!-- <a href="/cart" class="text-background">
                        <i class="bi bi-cart fs-4"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </a> -->
                    <!-- <span class="inline">
                    <a class="nav-link" href="..\login_process\DGLogin.php">Login</a>
                    <a class="nav-link" href="..\Signip_process\DGSignup.php">Sign Up</a>
                    </span> -->

                <?php 
                
                require('../cartLogin.php');
                ?>

                <!-- </div> -->
            </div>
        </div>
    </header>


<section class="hero">
  <h1>Sustainable Living Delivered Monthly</h1>
  <p>Earn EcoPoints, reduce waste, and enjoy eco-conscious essentials.</p>
  <a href="#offers">See What's Inside</a>
</section>

<div class="section-box" id="offers">
  <h2>Eco Essentials Subscription – $29.99/Month</h2>
  <ul>
    <li>Compostable cleaning pods</li>
    <li>Refillable spray bottles</li>
    <li>Plant-based detergent sheets</li>
    <li>Wool dryer balls</li>
    <li>Biodegradable trash bags</li>
    <li>Charcoal air purifiers</li>
  </ul>
    <?php if ($_SESSION['Auth']): ?>
        <button class="btn" onclick="showForm()">Subscribe Now</button>
    <?php else: ?>
        <button class="btn" onclick="redirectLogin()">Sign in to Subscribe</button>
    <?php endif; ?>

</div>

<form id="signup" class="section-box">
  <h2>Subscribe</h2>
  <input type="text" placeholder="Name" required>
  <input type="email" placeholder="Email" required>
  <input type="text" placeholder="Address" required>
  <input type="text" placeholder="Card Number" required>
  <input type="text" placeholder="Expiry (MM/YY)" required>
  <input type="text" placeholder="CVV" required>
  <label><input type="checkbox"> Join EcoPoints program</label>
  <button class="btn" type="Submit">Complete Subscription</button>
</form>

<footer>
  <p>© 2025 DragonStone</p>
  <a href="#">Home</a> • <a href="#">Shop</a> • <a href="#">Community</a>
</footer>

<script>
function showForm(){
  document.getElementById("signup").style.display="block";
  document.getElementById("signup").scrollIntoView({behavior:'smooth'});
}
document.getElementById("signup").onsubmit = function(e){
  e.preventDefault();
  alert("Subscription successful (mock).");
}

function Logout() {
    fetch('../logout.php',{
        method: 'POST',

    })
        .then((response) => response.json())
        .then((result) => {
            if(result.success){
                console.log("worked nigga");
                console.log(result.status);
                window.location.reload();

            }

        })
        .catch((error) => {

            console.log("error: " + error)
        })
}
</script>

</body>
</html>
