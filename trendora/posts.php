<?php
session_start();
include 'auth.php';

$json = @file_get_contents("https://dummyjson.com/posts");
$data = $json ? json_decode($json, true) : [];
$posts = $data['posts'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts | Trendora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="section">
    <h1>Posts</h1>

    <div class="post-grid">
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <h3><?php echo $post['title']; ?></h3>
                <p><?php echo substr($post['body'], 0, 120); ?>...</p>
                <p><b>Tags:</b> <?php echo implode(", ", $post['tags']); ?></p>

                <?php
                $likes = 0;

                if (is_array($post['reactions'])) {
                    $likes = $post['reactions']['likes'] ?? 0;
                } else {
                    $likes = $post['reactions'];
                }
                ?>

                <p><b>Reactions:</b> <?php echo $likes; ?> likes</p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>