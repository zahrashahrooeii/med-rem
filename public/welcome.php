<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        a {
            display: block;
            background-color: #b42fbd;
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            background-color: #9a26a3;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Welcome to the Medication Reminder App</h2>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</body>
</html>
