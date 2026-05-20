<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'auth.php';

$json = @file_get_contents("https://dummyjson.com/posts?limit=30");
$data = $json ? json_decode($json, true) : [];
$posts = $data['posts'] ?? [];

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$selected_post = null;

if ($post_id > 0) {

    foreach ($posts as $post) {

        if ($post['id'] == $post_id) {

            $selected_post = $post;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts | Trendora</title>
    <link rel="stylesheet" href="style.css?v=20">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="section">

<?php if ($selected_post): ?>

    <h1>Post Details</h1>

    <div class="detail-box">

        <h2>
            <?php echo htmlspecialchars($selected_post['title'] ?? 'No title'); ?>
        </h2>

        <p style="margin-top:20px; line-height:2;">
            <?php echo htmlspecialchars($selected_post['body'] ?? 'No content'); ?>
        </p>

        <p>
            <b>Tags:</b>

            <?php
            echo isset($selected_post['tags']) && is_array($selected_post['tags'])
            ? htmlspecialchars(implode(", ", $selected_post['tags']))
            : "No tags";
            ?>
        </p>

        <?php
        $likes = 0;

        if (isset($selected_post['reactions']) && is_array($selected_post['reactions'])) {

            $likes = $selected_post['reactions']['likes']
            ?? array_sum($selected_post['reactions']);

        } else {

            $likes = $selected_post['reactions'] ?? 0;
        }
        ?>

        <p>
            <b>Reactions:</b>
            <?php echo htmlspecialchars($likes); ?> likes
        </p>

        <a href="posts.php" class="btn">
            Back to Posts
        </a>

    </div>

<?php else: ?>

    <h1>Posts</h1>

    <p class="lead">
        Read posts, tags, and reactions from DummyJSON API.
    </p>

    <div class="post-grid">

        <?php if (empty($posts)): ?>

            <p>No posts found.</p>

        <?php else: ?>

            <?php foreach ($posts as $post): ?>

                <a href="posts.php?id=<?php echo htmlspecialchars($post['id']); ?>" class="post-card">

                    <h3>
                        <?php echo htmlspecialchars($post['title'] ?? 'No title'); ?>
                    </h3>

                    <p>
                        <?php echo htmlspecialchars(substr($post['body'] ?? 'No content', 0, 120)); ?>...
                    </p>

                    <p>
                        <b>Tags:</b>

                        <?php
                        echo isset($post['tags']) && is_array($post['tags'])
                        ? htmlspecialchars(implode(", ", $post['tags']))
                        : "No tags";
                        ?>
                    </p>

                </a>

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