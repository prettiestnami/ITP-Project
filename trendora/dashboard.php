<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'auth.php';

$username = $_SESSION['username'] ?? "User";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | Trendora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="dashboard-container">

    <h1 class="welcome-text">
        Welcome, <span><?php echo htmlspecialchars($username); ?>!</span>
    </h1>

    <div class="dashboard-grid">

        <!-- PRODUCTS -->

        <a href="products.php" class="dashboard-card">

            <div class="dashboard-emoji">🛍️</div>

            <h2>Products</h2>

            <p>
                Explore products from DummyJSON API.
            </p>

        </a>

        <!-- USERS -->

        <a href="users.php" class="dashboard-card">

            <div class="dashboard-emoji">👤</div>

            <h2>Users</h2>

            <p>
                View users and check their cart details.
            </p>

        </a>

        <!-- POSTS -->

        <a href="posts.php" class="dashboard-card">

            <div class="dashboard-emoji">💬</div>

            <h2>Posts</h2>

            <p>
                Read posts, tags, and reactions from the API.
            </p>

        </a>

    </div>

</div>

<script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>

</body>
</html>