<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {

        $message = "All fields are required.";

    } else {

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $login, $login);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: dashboard.php");
                exit();

            } else {

                $message = "Incorrect password.";
            }

        } else {

            $message = "Account not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Trendora Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="login-page">

    <div class="login-background"></div>

    <div class="form-container">

        <!-- ANIMATED LOGO -->

        <h1 class="trendora-animated">
            Trendora
        </h1>

        <h2 class="login-animated">
            Login
        </h2>

        <!-- MESSAGE -->

        <?php if($message): ?>

            <div class="message">
                <?php echo $message; ?>
            </div>

        <?php endif; ?>

        <!-- FORM -->

        <form method="POST">

            <input
                type="text"
                name="login"
                placeholder="Username or Email"
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
            >

            <button type="submit">
                Login
            </button>

        </form>

        <p>
            No account yet?
            <a href="register.php">
                Register
            </a>
        </p>

    </div>

</div>

</body>
</html>