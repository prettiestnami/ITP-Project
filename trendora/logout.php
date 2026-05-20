<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged out</title>
</head>
<body>
<script>
    window.history.pushState(null, "", "index.php");
    window.location.replace("index.php");
</script>
</body>
</html>