<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DragonStone - Sustainable Living</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
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

        .hero-section {
            position: relative;
        }

        .hero-img {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .hero-overlay {
            z-index: 2;
        }

        .hero-section .container {
            z-index: 3;
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
    <!-- Header -->
    <header class="bg-foreground text-background py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="Homepage.php" class="text-xl fw-bold text-background">
                    <i class="bi bi-leaf me-2"></i>DragonStone
                </a>
                <nav class="d-none d-md-flex">
                    <a href="Homepage.php" class="nav-link active">Home</a>
                    <a href="products.php" class="nav-link">Products</a>
                    <a href="community.php" class="nav-link">Community</a>
                    <a href="ecopoints.php" class="nav-link">Eco-Points</a>
                    <a href="subscription.php" class="nav-link">Subscription</a>
                </nav>

                <?php 
                
                require('../cartLogin.php');
                ?>

            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <img src="/Home/213160697_l.jpg" alt="Sustainable living" class="hero-img">
        <div class="hero-overlay"></div>
        <div class="container h-100 d-flex align-items-center position-relative">
            <div class="row w-100">
                <div class="col-lg-8 animate-fade-in">
                    <h1 class="display-3 fw-bold mb-4 text-background lh-1">
                        Sustainable Living,
                        <span class="d-block text-accent">Beautifully Simple</span>
                    </h1>
                    <p class="fs-4 mb-4 text-background opacity-90">
                        Discover eco-friendly products that are stylish, affordable, and kind to our planet.
                        Every purchase makes a difference.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="products.php">
                            <button class="btn btn-hero btn-lg px-4">Shop Now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="py-5 bg-gradient-hero text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8 animate-fade-in">
                    <h2 class="display-4 fw-bold mb-3">Join the Sustainable Movement</h2>
                    <p class="fs-4 opacity-90 mb-4">
                        Together, we can make a difference. Start your eco-friendly journey today.
                    </p>
                    <a href="/products">
                        <button class="btn btn-outline-light btn-lg px-4">Start Shopping</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

<!--    <footer>-->
<!--        <p>© 2025 DragonStone</p>-->
<!--        <a href="#">Home</a> • <a href="#">Shop</a> • <a href="#">Community</a>-->
<!--    </footer>-->

    <?php
    require('../footer.php');
    ?>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript for Cart -->
    <script>
        let cartTotal = 0;

        // Update cart badge
        function updateCartBadge() {
            document.getElementById('cartCount').textContent = cartTotal;
        }

        // Add to cart functionality
                document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('.add-to-cart');
            addButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productName = this.getAttribute('data-product');
                    // Simulate adding to cart
                    cartTotal++;
                    updateCartBadge();
                    // Optional: Show alert or toast
                    alert(`${productName} added to cart!`);
                    // Update button state
                    this.textContent = 'Added!';
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                    // Optional: Reset button after 2 seconds
                    setTimeout(() => {
                        this.textContent = 'Add to Cart';
                        this.classList.remove('btn-success');
                        this.classList.add('btn-primary');
                    }, 2000);
                });
            });
            // Stagger animations for fade-in elements (optional enhancement)
            const fadeElements = document.querySelectorAll('.animate-fade-in');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.2}s`;
            });
        });

        function Logout() {
                        fetch('../logout.php',{
                method: 'POST',
        
            })
                .then((response) => response.json())
                .then((result) => {
                        if(result.success){
                            console.log(result.status);
                            window.location.reload();
                            
                        }
                        
                })
                .catch((error) => {

                    console.log("error: " + error)
                })
        }
    </script>