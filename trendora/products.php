<?php
session_start();
include 'auth.php';

$json = @file_get_contents("https://dummyjson.com/products");
$data = $json ? json_decode($json, true) : [];
$products = $data['products'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products | Trendora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="section">
    <h1>Products</h1>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['thumbnail']; ?>" alt="Product">
                <h3><?php echo $product['title']; ?></h3>
                <p>Category: <?php echo $product['category']; ?></p>
                <p>Price: $<?php echo $product['price']; ?></p>
                <p>Stock: <?php echo $product['stock']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>