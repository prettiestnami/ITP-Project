<?php
session_start();
include 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | Trendora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="section">
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>

    <div class="cards">
        <a href="products.php" class="card">
            <h2>30</h2>
            <p>Total Products</p>
        </a>

        <a href="users.php" class="card">
            <h2>30</h2>
            <p>Total Users</p>
        </a>

        <a href="users.php" class="card">
            <h2>30</h2>
            <p>Total Carts</p>
        </a>

        <a href="posts.php" class="card">
            <h2>30</h2>
            <p>Total Posts</p>
        </a>
    </div>
</div>

</body>
</html>