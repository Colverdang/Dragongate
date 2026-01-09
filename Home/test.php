<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Challenges</h2>
        <a href="community.php" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Back to Community
        </a>
    </div>

    <div id="allChallengesContainer"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    async function loadAllChallenges() {
        const res = await fetch('../challenges.php');
        const challenges = await res.json();

        const container = document.getElementById('allChallengesContainer');
        container.innerHTML = '';

        if (!challenges.data || challenges.data.length === 0) {
            container.innerHTML = `
            <div class="card p-5 text-center text-muted">
                <i class="bi bi-inbox fs-1 mb-3"></i>
                <h6>No challenges available</h6>
                <p class="mb-0">New challenges will appear here soon </p>
            </div>
        `;
            return;
        }

        const uniqueChallenges = {};
        challenges.data.forEach(c => {
            uniqueChallenges[c.Id] = c; // overwrite duplicates
        });

        Object.values(uniqueChallenges).forEach(c => {
            let action;

            if (!c.ActiveId || c.Status === 'Abandoned') {
                action = `
            <button class="btn btn-success btn-sm"
                onclick="joinChallenge(${c.Id})">
                Join
            </button>
        `;
            }
            else if (c.Status === 'Active') {
                action = `
            <button class="btn btn-outline-success btn-sm mb-1"
                onclick="finishChallenge(${c.ActiveId})">
                Finish
            </button><br>
            <button class="btn btn-link p-0 small text-muted"
                onclick="leaveChallenge(${c.ActiveId})">
                Leave
            </button>
        `;
            }
            else {
                action = `<span class="badge bg-success">Completed</span>`;
            }

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
                    ${action}
                </div>
            </div>
        </div>
    `;
        });

    }

    /* ===== actions ===== */

    async function joinChallenge(id) {
        await fetch('../join_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `challenge_id=${id}`
        });
        loadAllChallenges();
    }

    async function finishChallenge(id) {
        await fetch('../finish_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `active_id=${id}`
        });
        loadAllChallenges();
    }

    async function leaveChallenge(id) {
        if (!confirm('Leave this challenge?')) return;

        await fetch('../leave_challenge.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `active_id=${id}`
        });
        loadAllChallenges();
    }

    document.addEventListener('DOMContentLoaded', loadAllChallenges);

</script>
</body>
</html>
