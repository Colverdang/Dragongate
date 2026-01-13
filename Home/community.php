<?php
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
            <a href="Homepage.php" class="text-xl fw-bold text-background">
                <i class="bi bi-leaf me-2"></i>DragonStone
            </a>
            <nav class="d-none d-md-flex">
                <a href="Homepage.php" class="nav-link">Home</a>
                <a href="products.php" class="nav-link">Products</a>
                <a href="community.php" class="nav-link active">Community</a>
                <a href="ecopoints.php" class="nav-link ">Eco-Points</a>
                <a href="subscription.php" class="nav-link">Subscription</a>
            </nav>


            <?php

            require('../cartLogin.php');
            ?>


        </div>
    </div>
</header>

<div class="container py-5">

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

    <?php
    $session = $_SESSION['Auth']?? false;
    if ($session): ?>

    <div class="row g-4 mb-5">

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-semibold">Active Challenges</h4>
                <a href="test.php" class="text-decoration-none">View All</a>
            </div>

            <div id="challengesContainer"></div>
        </div>

        <?php
        require('../background_db_connector.php');

        $userId = $_SESSION['Id'];

        // Fetch EcoPoints from database
        $query = "SELECT EcoPoints FROM user WHERE id = $userId";
        $result = mysqli_query($DbConnectionObj, $query);
        $row = mysqli_fetch_assoc($result);
        $ecoPoints = $row['EcoPoints'] ?? 0;
        ?>



        <div class="col-lg-4 ">
            <div class="card p-4 h-100 d-flex flex-column justify-content-center text-center bg-gradient-hero">
                <div class="d-flex justify-content-between align-items-center mb-2">

                </div>
                <h2 class="fw-bold text-white"><?= $ecoPoints ?></h2>
                <h5 class="fw-semibold">✨ Your EcoPoints</h5>
            </div>
        </div>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-sm">

                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" id="postTitle" class="form-control" placeholder="Enter a post title">
                        </div>

                        <div class="mb-3">
                            <label for="postContent" class="form-label">Content</label>
                            <textarea id="postContent" class="form-control" rows="5" placeholder="What's on your mind?"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-success" onclick="savePost()">>
                        Post
                    </button>
                </div>

            </div>
        </div>
    </div>



    <!-- COMMENTS / POSTS ROW -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-semibold mb-3">Recent Posts</h4>
                <button id="postBtn" class="btn btn-success btn-sm">
                    POST SOMETHING
                </button>
            </div>


            <div id="postsContainer"></div>

        </div>
    </div>

    <?php else: ?>
    <div class="card p-5 text-center mt-5">
        <i class="bi bi-lock fs-1 text-muted mb-3"></i>
        <h4 class="fw-semibold">Members Only</h4>
        <p class="text-muted mb-4">
            Sign in to join challenges, earn EcoPoints, and post in the community.
        </p>
        <a href="../Signip_process/DGSignup.php" class="btn btn-success px-4">
            Sign In
        </a>
    </div>
    <?php endif; ?>




</div>
<footer>
    <p>2025 DragonStone</p>
    <a href="#">Home</a> • <a href="#">Shop</a> • <a href="#">Community</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

        document.getElementById('postBtn').addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('postModal'));
        modal.show();
    });



async function loadChallenges() {
        const res = await fetch('../challenges.php');
        const challenges = await res.json();

        const container = document.getElementById('challengesContainer');
        container.innerHTML = '';

        if (!challenges?.data) {
            showEmpty();
            return;
        }

        // 🔥 ONLY ACTIVE CHALLENGES
        const activeChallenges = challenges.data.filter(
            c => c.ActiveId && c.Status === 'Active'
        );

        if (activeChallenges.length === 0) {
            showEmpty();
            return;
        }

        activeChallenges.forEach(c => {
            container.innerHTML += `
            <div class="card p-4 mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-semibold">${c.Title}</h5>
                        <p class="text-muted mb-2">${c.Description}</p>
                        <small class="text-muted">
                            <i class="bi bi-star"></i> ${c.Points} pts
                        </small>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-outline-success btn-sm mb-1"
                            onclick="finishChallenge(${c.ActiveId}, ${c.Points})">
                            Finish
                        </button><br>
                        <button class="btn btn-link p-0 small text-muted"
                            onclick="leaveChallenge(${c.ActiveId})">
                            Leave
                        </button>
                    </div>
                </div>
            </div>
        `;
        });
    }

    function showEmpty() {
        document.getElementById('challengesContainer').innerHTML = `
        <div class="card p-4 text-center text-muted">
            <i class="bi bi-emoji-neutral mb-2 fs-3"></i>
            <p class="mb-0 fw-semibold">No active challenges</p>
            <small>You haven’t joined any challenges yet</small>
        </div>
    `;
    }



    async function joinChallenge(id) {
        await fetch('../join_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `challenge_id=${id}`
        });
        loadChallenges();
    }

    async function finishChallenge(id,points) {
        await fetch('../finish_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `active_id=${id}&points=${points}`
        });
        loadChallenges();
    }

    async function leaveChallenge(id) {
        if (!confirm('Leave this challenge?')) return;

        await fetch('../leave_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `active_id=${id}`
        });
        loadChallenges();
    }

    document.addEventListener('DOMContentLoaded', loadChallenges);

    /* -----LOAD POSTS---- */

    const postsContainer = document.getElementById('postsContainer');


        function loadPosts() {
            fetch('../getPosts.php')
                .then(res => res.json())
                .then(posts => {
                    postsContainer.innerHTML = '';

                    posts.forEach(post => {
                        const liked = post.likedByUser == 1;
                        const heartClass = liked ? 'bi-heart-fill text-danger' : 'bi-heart';

                        // Card
                        const card = document.createElement('div');
                        card.className = 'card p-4 mb-3 post-card';
                        card.dataset.post = post.Id;

                        // Header
                        const header = document.createElement('div');
                        header.className = 'd-flex align-items-center mb-2';

                        const avatar = document.createElement('div');
                        avatar.className =
                            'rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2';
                        avatar.style.width = '36px';
                        avatar.style.height = '36px';
                        avatar.textContent = post.Initials;

                        const name = document.createElement('strong');
                        name.textContent = post.Name;

                        const time = document.createElement('span');
                        time.className = 'ms-2 text-muted small';
                        time.textContent = timeAgo(post.Date);

                        header.append(avatar, name, time);

                        // Title
                        const title = document.createElement('h6');
                        title.className = 'fw-semibold';
                        title.textContent = post.Title;

                        // Content
                        const content = document.createElement('p');
                        content.className = 'text-muted';
                        content.textContent = post.Content;

                        // Like section
                        const actions = document.createElement('div');
                        actions.className = 'd-flex gap-4 text-muted small';

                        const likeBtn = document.createElement('span');
                        likeBtn.className = 'like-btn d-flex align-items-center gap-1';
                        likeBtn.dataset.liked = liked;
                        likeBtn.dataset.id = post.Id;
                        likeBtn.style.cursor = 'pointer';

                        const icon = document.createElement('i');
                        icon.className = `bi ${heartClass}`;

                        const count = document.createElement('span');
                        count.className = 'like-count';
                        count.textContent = post.likeCount;

                        likeBtn.append(icon, count);
                        actions.append(likeBtn);

                        card.append(header, title, content, actions);
                        postsContainer.appendChild(card);
                    });
                })
                .catch(err => console.error('Failed to load posts:', err));
        }


        //// LIKE / UNLIKE
    postsContainer.addEventListener('click', e => {
        const btn = e.target.closest('.like-btn');
        if (!btn) return;

        const postId = btn.dataset.id;
        const icon = btn.querySelector('i');
        const countEl = btn.querySelector('.like-count');

        let liked = btn.dataset.liked === 'true';
        let count = parseInt(countEl.textContent);

        // optimistic UI update
        btn.dataset.liked = (!liked).toString();
        countEl.textContent = liked ? count - 1 : count + 1;

        icon.classList.toggle('bi-heart-fill');
        icon.classList.toggle('bi-heart');
        icon.classList.toggle('text-danger');

        fetch('../likepost.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ postId })
        })
            .catch(() => {
                // rollback if request fails
                btn.dataset.liked = liked.toString();
                countEl.textContent = count;
                icon.classList.toggle('bi-heart-fill');
                icon.classList.toggle('bi-heart');
                icon.classList.toggle('text-danger');
            });
    });

    function savePost() {
        const title = document.getElementById('postTitle').value.trim();
        const content = document.getElementById('postContent').value.trim();

        if (!title || !content) {
            alert('Title and content are required.');
            return;
        }

        fetch('../createPost.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                title: title,
                content: content
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modalEl = document.getElementById('postModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();

                    // Clear fields
                    document.getElementById('postTitle').value = '';
                    document.getElementById('postContent').value = '';

                    // Reload posts
                    loadPosts();
                } else {
                    alert(data.message || 'Failed to create post.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Something went wrong.');
            });

    }


    function timeAgo(date) {
        const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        if (seconds < 60) return 'just now';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm';
        if (seconds < 86400) return Math.floor(seconds / 3600) + 'h';
        return Math.floor(seconds / 86400) + 'd';
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
    loadPosts();

</script>
</body>
</html>

