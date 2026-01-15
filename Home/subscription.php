<?php
session_start();


require('../background_db_connector.php');

$isSubscribed = false;

if (isset($_SESSION['Id']) && $_SESSION['Auth']) {
    $stmt = $DbConnectionObj->prepare(
        "SELECT Id FROM subscription WHERE UserId = ? AND Active = 1 LIMIT 1"
    );
    $stmt->bind_param("i", $_SESSION['Id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $isSubscribed = true;
    }

    $stmt->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sustainable Subscription Boxes | DragonStone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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

<header class="bg-foreground text-background">
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">

            <!-- Brand -->
            <a href="Homepage.php" class="navbar-brand fw-bold">
                <i class="bi bi-leaf me-2"></i>DragonStone
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Nav -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item"><a href="Homepage.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
                    <li class="nav-item"><a href="community.php" class="nav-link ">Community</a></li>
                    <li class="nav-item"><a href="ecopoints.php" class="nav-link">Eco-Points</a></li>
                    <li class="nav-item"><a href="subscription.php" class="nav-link active">Subscription</a></li>
                </ul>
            </div>

            <!-- User / Cart (ALWAYS RIGHT) -->
            <div class="user-nav d-none d-md-flex">
                <?php require('../cartLogin.php'); ?>
            </div>

            <!-- Mobile Cart / Auth -->
            <div class="d-md-none text-center mt-3">
                <?php require('../cartLogin.php'); ?>
            </div>


        </div>
    </nav>
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

        <?php if (!isset($_SESSION['Auth']) || !$_SESSION['Auth']): ?>

            <button class="btn" onclick="redirectLogin()">Sign in to Subscribe</button>

        <?php elseif ($isSubscribed): ?>

            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <strong>You are currently subscribed!</strong><br>
                Your monthly eco-box will be delivered automatically
            </div>

            <button class="btn btn-danger" onclick="unsubscribe()">
                Unsubscribe
            </button>

        <?php else: ?>

            <button class="btn" onclick="showForm()">Subscribe Now</button>

        <?php endif; ?>
    </div>


<form id="signup" class="section-box" novalidate>
    <h2>Subscribe</h2>

    <input type="text" placeholder="Name" required minlength="2">

    <input type="email" placeholder="Email" required>

    <input type="text" placeholder="Address" required minlength="5">

    <input type="text" id="card" placeholder="Card Number"
           inputmode="numeric" maxlength="16" required>

    <input type="text" id="expiry" placeholder="Expiry (MM/YY)"
           inputmode="numeric" name="expiry" maxlength="5" required>

    <input type="text" id="cvv" placeholder="CVV"
           inputmode="numeric" maxlength="3" required>

    <button class="btn" type="submit">Complete Subscription</button>
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
  alert("Subscription successful");
}

function redirectLogin(){
    window.location.href = "../Signip_process/DGSignup.php"
}



document.getElementById("card").addEventListener("input", e => {
    e.target.value = e.target.value.replace(/\D/g, "").slice(0, 16);
});

// CVV: digits only, max 3
document.getElementById("cvv").addEventListener("input", e => {
    e.target.value = e.target.value.replace(/\D/g, "").slice(0, 3);
});

// Expiry: auto-add slash, max MM/YY
document.getElementById("expiry").addEventListener("input", e => {
    let value = e.target.value.replace(/\D/g, "").slice(0, 4);

    if (value.length >= 3) {
        value = value.slice(0, 2) + "/" + value.slice(2);
    }

    e.target.value = value;
});


    document.getElementById("signup").onsubmit = function(e){
    e.preventDefault();

        const form = e.target;

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const expiry = form.querySelector('[name="expiry"]').value;
        const [mm, yy] = expiry.split("/");
        const expiryDate = new Date(`20${yy}`, mm - 1);
        const now = new Date();

        if (expiryDate <= now) {
            alert("Card expiry date must be in the future.");
            return;
        }

    fetch('../subscribe.php', {
    method: 'POST'
})
    .then(res => res.json())
    .then(data => {
    if (data.success) {
    alert(data.message);
    location.reload();
} else {
    alert(data.message);
}
})
    .catch(err => {
    console.error(err);
    alert("Something went wrong");
});
};

function unsubscribe() {
    if (!confirm("Are you sure you want to unsubscribe?")) return;

    fetch('../unsubscribe.php', {
        method: 'POST'
    })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        })
        .catch(() => alert("Something went wrong"));
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
