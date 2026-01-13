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
    <title>Products - DragonStone</title>
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
            --card: #ffffff;
            --hero-gradient: linear-gradient(135deg, var(--primary) 0%, #198754 100%);
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
        .bg-card { background-color: var(--card) !important; }
        .bg-gradient-hero {
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
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        .product-card img {
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
        .category-btn {
            margin: 0.25rem;
            transition: all 0.3s ease;
        }
        .category-btn.active {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        .search-input {
            position: relative;
        }
        .search-input i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            z-index: 10;
        }
        .search-input input {
            padding-left: 40px;
        }
        .product-item {
            display: none;
        }
        .product-item.show {
            display: block;
        }
        .no-products {
            text-align: center;
            padding: 5rem 0;
        }
        .filters-section {
            border-bottom: 1px solid #dee2e6;
            background-color: var(--card);
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
                    <a href="Homepage.php" class="nav-link ">Home</a>
                    <a href="products.php" class="nav-link active">Products</a>
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

    <!-- Page Header -->
    <section class="bg-gradient-hero text-white py-5">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3 animate-fade-in">Our Products</h1>
            <p class="fs-3 opacity-90 animate-fade-in" style="max-width: 32rem;">
                Discover our full range of sustainable home essentials
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-4 filters-section">
        <div class="container">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-center justify-content-between">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn category-btn btn-outline-primary active" data-category="All">All</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Cleaning & Household">Cleaning & Household</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Kitchen & Dining">Kitchen & Dining</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Home Décor & Living">Home Décor & Living</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Bathroom & Personal Care">Bathroom & Personal Care</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Lifestyle & Wellness">Lifestyle & Wellness</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Kids & Pets">Kids & Pets</button>
                    <button class="btn category-btn btn-outline-primary" data-category="Outdoor & Garden">Outdoor & Garden</button>

                </div>
                <div class="search-input w-100 w-md-auto" style="min-width: 200px;">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search products..." />
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <p class="text-muted-foreground mb-0" id="productCount">12 products found</p>
            </div>
            <div class="row g-4" id="productsGrid">
                <!-- Mock Products will be populated by JS -->
            </div>
            <div id="noProducts" class="no-products d-none">
                <p class="fs-4 text-muted-foreground mb-3">No products found</p>
                <button class="btn btn-primary" id="clearFilters">Clear Filters</button>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 DragonStone</p>
        <a href="#">Home</a> • <a href="#">Shop</a> • <a href="#">Community</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cartTotal = 0;
        let selectedCategory = 'All';
        let searchQuery = '';

        // Mock Products Data
        // const products = [
        //     { id: 1, name: 'Bamboo Toothbrush Set', description: 'Eco-friendly bamboo toothbrushes', price: 12.99, category: 'Cleaning & Household', image: 'https://via.placeholder.com/400x250?text=Bamboo+Toothbrush' },
        //     { id: 2, name: 'Reusable Stainless Straws', description: 'Durable stainless steel straws', price: 8.99, category: 'Kitchen & Dining', image: 'https://via.placeholder.com/400x250?text=Reusable+Straws' },
        //     { id: 3, name: 'Organic Cotton Eco Bags', description: 'Reusable shopping bags from organic cotton', price: 15.99, category: 'Home Décor & Living', image: 'https://via.placeholder.com/400x250?text=Eco+Bags' },
        //     { id: 4, name: 'Natural Cleaning Spray', description: 'Plant-based all-purpose cleaner', price: 9.99, category: 'Cleaning & Household', image: 'https://via.placeholder.com/400x250?text=Cleaning+Spray' },
        //     { id: 5, name: 'Bamboo Cutting Board', description: 'Sustainable kitchen cutting board', price: 24.99, category: 'Kitchen & Dining', image: 'https://via.placeholder.com/400x250?text=Cutting+Board' },
        //     { id: 6, name: 'Recycled Glass Vase', description: 'Handmade vase from recycled glass', price: 19.99, category: 'Home Décor & Living', image: 'https://via.placeholder.com/400x250?text=Glass+Vase' },
        //     { id: 7, name: 'Eco Sponge Set', description: 'Biodegradable cleaning sponges', price: 6.99, category: 'Cleaning & Household', image: 'https://via.placeholder.com/400x250?text=Eco+Sponge' },
        //     { id: 8, name: 'Silicone Food Storage Bags', description: 'Reusable silicone bags for food storage', price: 14.99, category: 'Kitchen & Dining', image: 'https://via.placeholder.com/400x250?text=Food+Bags' },
        //     { id: 9, name: 'Wooden Wall Shelf', description: 'Sustainable wooden decor shelf', price: 29.99, category: 'Home Décor & Living', image: 'https://via.placeholder.com/400x250?text=Wall+Shelf' },
        //     { id: 10, name: 'Laundry Detergent Sheets', description: 'Zero-waste laundry sheets', price: 11.99, category: 'Cleaning & Household', image: 'https://via.placeholder.com/400x250?text=Detergent+Sheets' },
        //     { id: 11, name: 'Bamboo Dinnerware Set', description: 'Eco-friendly plates and bowls', price: 34.99, category: 'Kitchen & Dining', image: 'https://via.placeholder.com/400x250?text=Dinnerware' },
        //     { id: 12, name: 'Cotton Throw Blanket', description: 'Organic cotton blanket for home', price: 39.99, category: 'Home Décor & Living', image: 'https://via.placeholder.com/400x250?text=Blanket' }
        // ];

        let products = [];

function loadProducts() {
    fetch('../get_products.php')
        .then(response => response.json())
        .then(data => {
            products = data;
            filterProducts();
        })
        .catch(err => {
            console.error("Failed to load products:", err);
        });
}


        // Update cart badge
function updateCartBadge() {
    const badge = document.getElementById('cartCount');
    if (badge) {
        badge.textContent = cartTotal;
    }
}


        // Render products
        function renderProducts(filteredProducts) {
            const grid = document.getElementById('productsGrid');
            const noProducts = document.getElementById('noProducts');
            const countEl = document.getElementById('productCount');

            grid.innerHTML = '';
            if (filteredProducts.length > 0) {
                noProducts.classList.add('d-none');
                filteredProducts.forEach(product => {
                    const col = document.createElement('div');
                    col.className = 'col-12 col-sm-6 col-lg-4 col-xl-3';
                    col.innerHTML = `
                        <div class="card product-card h-100 animate-fade-in">
                            <img src="${product.image}" class="card-img-top" alt="${product.name}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">${product.name}</h5>
                                <p class="card-text text-muted-foreground flex-grow-1">${product.description}</p>
                                <p class="card-text fw-bold text-primary fs-5 mb-2">$${product.price}</p>
                               <button class="btn btn-primary w-100 mt-auto add-to-cart" data-id="${product.id}" data-name="${product.name}" data-price="${product.price}"> Add to Cart</button>

                            </div>
                        </div>
                    `;
                    grid.appendChild(col);
                });
                countEl.textContent = `${filteredProducts.length} ${filteredProducts.length === 1 ? 'product' : 'products'} found`;
            } else {
                noProducts.classList.remove('d-none');
                countEl.textContent = '0 products found';
            }

            // Re-attach event listeners for new buttons
            attachAddToCartListeners();
        }

        // Filter products
        function filterProducts() {
            let filtered = products.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                                      product.description.toLowerCase().includes(searchQuery.toLowerCase());
                const matchesCategory = selectedCategory === 'All' || product.category === selectedCategory;
                return matchesSearch && matchesCategory;
            });
            renderProducts(filtered);
        }

        // Category filter
        function attachCategoryListeners() {
            const categoryBtns = document.querySelectorAll('.category-btn');
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedCategory = this.getAttribute('data-category');
                    filterProducts();
                });
            });
        }

        // Search functionality
        function attachSearchListener() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                searchQuery = this.value;
                filterProducts();
            });
        }

        // Clear filters
        function attachClearListener() {
            const clearBtn = document.getElementById('clearFilters');
            clearBtn.addEventListener('click', function() {
                searchQuery = '';
                selectedCategory = 'All';
                document.getElementById('searchInput').value = '';
                document.querySelector('.category-btn[data-category="All"]').click();
            });
        }

        // Add to cart
// Add to cart (send to add_cart.php)
function attachAddToCartListeners() {


    const addButtons = document.querySelectorAll('.add-to-cart');
    addButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = this.getAttribute('data-price');

            // Send data to add_cart.php
            fetch("../add_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${productId}&name=${productName}&price=${productPrice}`
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success && !data.Auth) {
                    alert("Please login to add to cart");
                    return
                }

                if (data.success) {
                    cartTotal++;
                    updateCartBadge();
                    this.textContent = 'Added!';
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                    setTimeout(() => {
                        this.textContent = 'Add to Cart';
                        this.classList.remove('btn-success');
                        this.classList.add('btn-primary');
                    }, 2000);
                } else {
                    alert("Failed to add to cart.");
                }
            });
        });
    });
}


        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
            attachCategoryListeners();
            attachSearchListener();
            attachClearListener();
            // Initial render
            loadProducts();

            // Stagger animations for fade-in elements (optional enhancement)
            const fadeElements = document.querySelectorAll('.animate-fade-in');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

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
