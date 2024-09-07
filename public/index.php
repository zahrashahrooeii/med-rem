<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Medication Reminder App</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../images/background.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        a.button {
            display: block;
            background-color: #b42fbd;
            color: white;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #9e28a7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Medication Reminder App</h1>
        <a href="register.php" class="button">Register</a>
        <a href="login.php" class="button">Login</a>
    </div>
</body>
</html>

