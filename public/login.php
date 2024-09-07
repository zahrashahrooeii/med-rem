<?php
require '../src/config.php';
require '../vendor/autoload.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Email and password are correct, set session and redirect to the main page
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $email;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<p style='color: red;'>Invalid email or password.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .content {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            display: block;
            width: 90%;
            padding: 8px;
            margin: 10px auto;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #b42fbd;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #9a26a3;
        }

        a {
            color: #b42fbd;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Login</h2>
        <form name="loginForm" action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" name="login" value="Login">
        </form>
        <a href="welcome.php">Back to Welcome Page</a>
    </div>
</body>
</html>
