<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'auth.php';

$selected_user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$users_json = @file_get_contents("https://dummyjson.com/users?limit=30");
$users_data = $users_json ? json_decode($users_json, true) : [];
$users = $users_data['users'] ?? [];

$selected_user = null;
$user_cart = null;

if ($selected_user_id > 0) {
    foreach ($users as $user) {
        if ($user['id'] == $selected_user_id) {
            $selected_user = $user;
            break;
        }
    }

    $cart_json = @file_get_contents("https://dummyjson.com/carts/user/" . $selected_user_id);
    $cart_data = $cart_json ? json_decode($cart_json, true) : [];

    if (!empty($cart_data['carts'])) {
        $user_cart = $cart_data['carts'][0];
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
    <?php if ($selected_user): ?>

        <h1>User Cart Details</h1>
        <p class="lead">Showing cart details for the selected user only.</p>

        <div class="cart-box">
            <h2>
                <?php echo htmlspecialchars($selected_user['firstName'] . " " . $selected_user['lastName']); ?>
            </h2>

            <p><b>Email:</b> <?php echo htmlspecialchars($selected_user['email'] ?? 'No email'); ?></p>
            <p><b>Age:</b> <?php echo htmlspecialchars($selected_user['age'] ?? 'N/A'); ?></p>
            <p><b>Phone:</b> <?php echo htmlspecialchars($selected_user['phone'] ?? 'No phone'); ?></p>

            <br>

            <?php if ($user_cart): ?>
                <h3>Cart Information</h3>

                <p><b>Cart ID:</b> <?php echo htmlspecialchars($user_cart['id']); ?></p>
                <p><b>Total Products:</b> <?php echo htmlspecialchars($user_cart['totalProducts']); ?></p>
                <p><b>Total Quantity:</b> <?php echo htmlspecialchars($user_cart['totalQuantity']); ?></p>
                <p><b>Total Amount:</b> $<?php echo htmlspecialchars($user_cart['total']); ?></p>

                <h3>Products:</h3>

                <?php foreach ($user_cart['products'] as $item): ?>
                    <div class="cart-item">
                        <p>
                            <?php echo htmlspecialchars($item['title']); ?> |
                            Qty: <?php echo htmlspecialchars($item['quantity']); ?> |
                            Price: $<?php echo htmlspecialchars($item['price']); ?> |
                            Total: $<?php echo htmlspecialchars($item['total']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p>No cart found for this user.</p>
            <?php endif; ?>

            <a href="users.php" class="btn">Back to Users</a>
        </div>

    <?php else: ?>

        <h1>Users</h1>
        <p class="lead">View users and check their cart details from DummyJSON API.</p>

        <div class="user-grid">
            <?php if (empty($users)): ?>
                <p>No users found.</p>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <div class="user-card">
                        <img src="<?php echo htmlspecialchars($user['image'] ?? ''); ?>" alt="User">

                        <h3>
                            <?php echo htmlspecialchars(($user['firstName'] ?? '') . " " . ($user['lastName'] ?? '')); ?>
                        </h3>

                        <p><b>Email:</b> <?php echo htmlspecialchars($user['email'] ?? 'No email'); ?></p>
                        <p><b>Age:</b> <?php echo htmlspecialchars($user['age'] ?? 'N/A'); ?></p>
                        <p><b>Phone:</b> <?php echo htmlspecialchars($user['phone'] ?? 'No phone'); ?></p>

                        <a href="users.php?user_id=<?php echo htmlspecialchars($user['id']); ?>" class="btn">
                            View Cart
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    <?php endif; ?>
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