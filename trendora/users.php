<?php
session_start();
include 'auth.php';

$users_json = @file_get_contents("https://dummyjson.com/users");
$users_data = $users_json ? json_decode($users_json, true) : [];
$users = $users_data['users'] ?? [];

$carts_json = @file_get_contents("https://dummyjson.com/carts");
$carts_data = $carts_json ? json_decode($carts_json, true) : [];
$carts = $carts_data['carts'] ?? [];

$selected_user_id = $_GET['user_id'] ?? null;
$selected_user = null;
$user_cart = null;

if ($selected_user_id) {
    foreach ($users as $user) {
        if ($user['id'] == $selected_user_id) {
            $selected_user = $user;
            break;
        }
    }

    foreach ($carts as $cart) {
        if ($cart['userId'] == $selected_user_id) {
            $user_cart = $cart;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users | Trendora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="section">
    <h1>Users</h1>

    <div class="user-grid">
        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <img src="<?php echo $user['image']; ?>" alt="User">
                <h3><?php echo $user['firstName'] . " " . $user['lastName']; ?></h3>
                <p>Email: <?php echo $user['email']; ?></p>
                <p>Age: <?php echo $user['age']; ?></p>
                <p>Phone: <?php echo $user['phone']; ?></p>
                <a href="users.php?user_id=<?php echo $user['id']; ?>" class="btn">View Cart</a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($selected_user): ?>
        <div class="cart-box">
            <h2>Cart of <?php echo $selected_user['firstName'] . " " . $selected_user['lastName']; ?></h2>

            <?php if ($user_cart): ?>
                <p>Cart ID: <?php echo $user_cart['id']; ?></p>
                <p>Total Products: <?php echo $user_cart['totalProducts']; ?></p>
                <p>Total Amount: $<?php echo $user_cart['total']; ?></p>

                <h3>Products:</h3>

                <?php foreach ($user_cart['products'] as $item): ?>
                    <div class="cart-item">
                        <p>
                            <?php echo $item['title']; ?> |
                            Qty: <?php echo $item['quantity']; ?> |
                            Price: $<?php echo $item['price']; ?> |
                            Total: $<?php echo $item['total']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No cart found for this user.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>