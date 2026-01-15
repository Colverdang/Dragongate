<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EcoPoints Rewards | DragonStone</title>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap"
    rel="stylesheet"
  />

  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..."
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <style>
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
           footer {
               background:#222;
               color:#fff;
               text-align:center;
               padding:20px;
               margin-top:60px;
           }
           footer a { color:#bbb; text-decoration:none; }
           footer a:hover { color:#fff; }
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

<!-- Navbar -->
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
                    <li class="nav-item"><a href="ecopoints.php" class="nav-link active">Eco-Points</a></li>
                    <li class="nav-item"><a href="subscription.php" class="nav-link">Subscription</a></li>
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

<!-- Header -->
<div class="container text-center mt-5">
  <i class="fa-solid fa-leaf text-success" style="font-size: 40px;"></i>
  <h1 class="section-title">EcoPoints Rewards Program</h1>
  <p class="mt-3">Every sustainable choice you make earns you EcoPoints. Redeem them for discounts or donate to environmental causes.</p>
</div>

<!-- Balance Box -->
<div class="points-box mt-5 text-center">

<?php 
if (isset($_SESSION['Id'] ) && $_SESSION['Auth']) {

    require('../background_db_connector.php');

    $userId = $_SESSION['Id'];

    // Fetch EcoPoints from database
    $query = "SELECT EcoPoints FROM user WHERE id = $userId";
    $result = mysqli_query($DbConnectionObj, $query);
    $row = mysqli_fetch_assoc($result);
    $ecoPoints = $row['EcoPoints'] ?? 0;
?>
    <p class="text-muted mb-1">Your Current Balance</p>
    <h2 class="display-4">
        <i class="fa-solid fa-leaf text-success"></i> 
        <span id="currentBalance"><?= $ecoPoints ?></span>
    </h2>
    <p class="mt-2 text-muted">EcoPoints</p>

<?php 
} else { 
?>
    <strong><i>Sign in to view eco points</i></strong>
<?php 
}
?>
</div>

<!-- Ways to Earn -->
<div class="container mt-5">
  <h2 class="text-center fw-bold">Ways to Earn EcoPoints</h2>

  <div class="row mt-4 g-4 align-items-center justify-content-center" >
    <div class="col-md-3">
      <div class="earn-card">
        <i class="fa-solid fa-bag-shopping text-success fs-2"></i>
        <span class="badge bg-success-subtle text-success border border-success rounded-pill ms-2">100 points</span>
        <h5 class="mt-3 fw-semibold">Make Purchases</h5>
        <p>Earn 10 EcoPoints for every product you add to your cart</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="earn-card">
        <i class="fa-solid fa-star text-warning fs-2"></i>
        <span class="badge bg-warning-subtle text-warning border border-warning rounded-pill ms-2">50 points</span>
        <h5 class="mt-3 fw-semibold">Write Reviews</h5>
        <p>Share your experience and help others make informed choices</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="earn-card">
        <i class="fa-solid fa-people-group text-primary fs-2"></i>
        <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill ms-2">25-100 points</span>
        <h5 class="mt-3 fw-semibold">Community Contributions</h5>
        <p>Post DIY sustainability ideas or participate in challenges</p>
      </div>
    </div>

  </div>
</div>

<div class="container text-center mt-5">
  <h2 class="fw-bold">Redeem Your Points</h2>

    <div class="redeem-box">
        <h5><i class="fa-solid fa-gift text-secondary me-2"></i> 1% off for every 500 points</h5>
        <p class="text-muted mb-1">Redeem in increments of 500 points</p>
    </div>

</div>
<footer>
    <p>© 2025 DragonStone</p>
    <a href="#">Home</a> • <a href="#">Shop</a> • <a href="#">Community</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>

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
