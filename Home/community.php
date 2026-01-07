<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Community Hub</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
        :root {
            --primary: #28a745;
            --background: #f8f9fa;
            --foreground: #212529;
            --muted: #6c757d;
            --accent: #20c997;
            --card: #ffffff;
            --hero-gradient: linear-gradient(135deg, var(--primary) 0%, #198754 100%);
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: var(--background);
            color: var(--foreground);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(40, 167, 69, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
        }

        .stat-icon i { color: var(--primary); font-size: 1.5rem; }

        .card { border: none; border-radius: 12px; }

        .progress { height: 8px; }

        .badge-soft {
            background: rgba(40,167,69,0.15);
            color: var(--primary);
        }

        .post-card { transition: box-shadow 0.3s ease; }
        .post-card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
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
                <a href="community.php" class="nav-link active">Community</a>
                <a href="ecopoints.php" class="nav-link ">Eco-Points</a>
                <a href="subscription.php" class="nav-link">Subscription</a>
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

<div class="container py-5">

    <!-- HERO -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Community Hub</h1>
        <p class="text-muted">Share tips, complete challenges, and earn EcoPoints while making a real impact.</p>

        <div class="row mt-4">
            <div class="col-6 col-md-3">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <h5 class="fw-bold">12.8K</h5>
                <small class="text-muted">Members</small>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-icon"><i class="bi bi-leaf"></i></div>
                <h5 class="fw-bold">2.4M</h5>
                <small class="text-muted">EcoPoints</small>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-icon"><i class="bi bi-trophy"></i></div>
                <h5 class="fw-bold">8.9K</h5>
                <small class="text-muted">Challenges</small>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-icon"><i class="bi bi-graph-up"></i></div>
                <h5 class="fw-bold">156t</h5>
                <small class="text-muted">CO₂ Saved</small>
            </div>
        </div>
    </div>

    <!-- ACTIVITIES + ECOPOINTS ROW -->
    <div class="row g-4 mb-5">

        <!-- ACTIVE CHALLENGES (8 COL) -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-semibold">Active Challenges</h4>
                <a href="#" class="text-decoration-none">View All</a>
            </div>

            <div class="card p-4 mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-semibold">Zero Waste Week</h5>
                        <div class="mb-2">
                            <span class="badge bg-warning text-dark">Medium</span>
                            <span class="badge bg-success">Joined</span>
                        </div>
                        <p class="text-muted mb-2">Produce no landfill waste for 7 days</p>
                        <div class="d-flex gap-3 small text-muted mb-2">
                            <span><i class="bi bi-star"></i> 500 pts</span>
                            <span><i class="bi bi-people"></i> 1243</span>
                            <span><i class="bi bi-clock"></i> 5d left</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width:45%"></div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-outline-success btn-sm mb-2">Log</button><br />
                        <a href="#" class="small text-muted">Leave</a>
                    </div>
                </div>
            </div>

            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-semibold">Plant-Based January</h5>
                        <span class="badge bg-danger">Hard</span>
                        <p class="text-muted mb-0">Embrace plant-based meals for the month</p>
                    </div>
                    <button class="btn btn-success btn-sm">Join</button>
                </div>
            </div>
        </div>

        <!-- ECOPOINTS (4 COL) -->
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-semibold">✨ Your EcoPoints</h5>
                    <span class="text-danger small"><i class="bi bi-fire"></i> 12 days</span>
                </div>
                <h2 class="fw-bold text-success">2,450</h2>
                <p class="text-muted">Earth Guardian</p>

                <div class="mb-2 small d-flex justify-content-between">
                    <span>Next level</span>
                    <span>82%</span>
                </div>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" style="width:82%"></div>
                </div>

                <button class="btn btn-success w-100">
                    <i class="bi bi-gift"></i> Redeem Rewards
                </button>
            </div>
        </div>
    </div>

    <!-- COMMENTS / POSTS ROW -->
    <div class="row">
        <div class="col-12">
            <h4 class="fw-semibold mb-3">Recent Posts</h4>

            <div class="card p-4 mb-3 post-card">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" style="width:36px;height:36px;">SC</div>
                    <strong>Sarah Chen</strong><span class="ms-2 text-muted small">2h</span>
                    <span class="badge bg-success ms-auto">DIY</span>
                </div>
                <h6 class="fw-semibold">Made my own beeswax wraps</h6>
                <p class="text-muted">Finally tried making beeswax wraps at home and they turned out amazing!</p>
                <div class="d-flex gap-4 text-muted small">
                    <span><i class="bi bi-heart-fill text-danger"></i> 234</span>
                    <span><i class="bi bi-chat"></i> 45</span>
                    <span class="ms-auto"><i class="bi bi-bookmark"></i></span>
                </div>
            </div>

            <div class="card p-4 mb-3 post-card">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width:36px;height:36px;">MR</div>
                    <strong>Marcus Rivera</strong><span class="ms-2 text-muted small">5h</span>
                    <span class="badge bg-warning text-dark ms-auto">Tips</span>
                </div>
                <h6 class="fw-semibold">5 swaps that reduced my bathroom plastic by 90%</h6>
                <p class="text-muted">Small changes can make a huge impact!</p>
                <div class="d-flex gap-4 text-muted small">
                    <span><i class="bi bi-heart"></i> 189</span>
                    <span><i class="bi bi-chat"></i> 32</span>
                    <span class="ms-auto"><i class="bi bi-bookmark"></i></span>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
