<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$Auth = $_SESSION['Auth'] ?? false;

if($Auth !== true){
    $html = '<h3>Sign up to see the community page</h3>'
    ;
} else {
    $html = `<div class="row g-4 mb-5">

    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-semibold">Active Challenges</h4>
            <a href="test.php" class="text-decoration-none">View All</a>
        </div>

        <div id="challengesContainer"></div>
    </div>



    <div class="col-lg-4 ">
        <div class="card p-4 h-100 d-flex flex-column justify-content-center text-center bg-gradient-hero">
            <div class="d-flex justify-content-between align-items-center mb-2">

            </div>
            <h2 class="fw-bold text-white">2,450</h2>
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
    </div>`;

}

echo $html . "\n";
// echo $Auth . "\n";
// echo true;
?>
