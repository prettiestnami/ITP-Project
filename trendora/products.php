<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'auth.php';

$json = @file_get_contents("https://dummyjson.com/products");
$data = $json ? json_decode($json, true) : [];
$products = $data['products'] ?? [];

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$selected_product = null;

if ($product_id > 0) {
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $selected_product = $product;
            break;
        }
    }
}
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

<?php if ($selected_product): ?>

    <!-- BIG PRODUCT VIEW -->

    <h1>Product Details</h1>

    <div class="cart-box">

        <img
            src="<?php echo htmlspecialchars($selected_product['thumbnail']); ?>"
            alt="Product"
            style="
                width:100%;
                max-width:400px;
                display:block;
                margin:auto;
                padding:20px;
                border-radius:20px;
                background:linear-gradient(135deg,#1e3a8a,#2563eb);
                margin-bottom:25px;
            "
        >

        <h2>
            <?php echo htmlspecialchars($selected_product['title']); ?>
        </h2>

        <p>
            <?php echo htmlspecialchars($selected_product['description']); ?>
        </p>

        <br>

        <p>
            <b>Brand:</b>
            <?php echo htmlspecialchars($selected_product['brand'] ?? 'N/A'); ?>
        </p>

        <p>
            <b>Category:</b>
            <?php echo htmlspecialchars($selected_product['category']); ?>
        </p>

        <p>
            <b>Price:</b>
            $<?php echo htmlspecialchars($selected_product['price']); ?>
        </p>

        <p>
            <b>Stock:</b>
            <?php echo htmlspecialchars($selected_product['stock']); ?>
        </p>

        <p>
            <b>Rating:</b>
            <?php echo htmlspecialchars($selected_product['rating']); ?>
        </p>

        <br>

        <a href="products.php" class="btn">
            Back to Products
        </a>

    </div>

<?php else: ?>

    <!-- PRODUCT LIST -->

    <h1>Products</h1>

    <p class="lead">
        Browse products fetched directly from DummyJSON API.
    </p>

    <div class="product-grid">

        <?php foreach ($products as $product): ?>

            <a
                href="products.php?id=<?php echo $product['id']; ?>"
                class="product-card"
                style="text-decoration:none;"
            >

                <img
                    src="<?php echo htmlspecialchars($product['thumbnail']); ?>"
                    alt="Product"
                >

                <h3>
                    <?php echo htmlspecialchars($product['title']); ?>
                </h3>

                <p>
                    Category:
                    <?php echo htmlspecialchars($product['category']); ?>
                </p>

                <p>
                    Price:
                    $<?php echo htmlspecialchars($product['price']); ?>
                </p>

                <p>
                    Stock:
                    <?php echo htmlspecialchars($product['stock']); ?>
                </p>

            </a>

        <?php endforeach; ?>

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