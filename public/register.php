<?php
require '../src/config.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use OTPHP\TOTP;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Generate a one-time password (OTP)
    $totp = TOTP::create();
    $otpSecret = $totp->getSecret(); // Secret key to store in the database
    $otp = $totp->now(); // This will generate the OTP for the current time

    // Save user data and OTP secret to the database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, otp_secret) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $email, $otpSecret]);

        // Send OTP to user's email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = 'zahra.shahrooeii@gmail.com'; // SMTP username
            $mail->Password   = 'ihvp ggzs xivs xvnz';    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('zahra.shahrooeii@gmail.com', 'med-rem');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "Your OTP code is: <strong>$otp</strong>";

            $mail->send();
            echo "OTP has been sent to your email! Please enter it below to complete your registration.";

            // Show OTP input form
            echo '<div class="otp-form-container">';
            echo '<form class="otp-form" action="register.php" method="POST">';
            echo '<input type="hidden" name="username" value="'.$username.'">';
            echo '<input type="hidden" name="password" value="'.$password.'">';
            echo '<input type="hidden" name="email" value="'.$email.'">';
            echo '<label for="otp">Enter OTP:</label>';
            echo '<input type="text" name="otp" required><br>';
            echo '<input type="submit" name="verify_otp" value="Verify OTP">';
            echo '</form>';
            echo '</div>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Handle OTP verification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_otp'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $enteredOtp = $_POST['otp'];

    // Fetch the user's OTP secret from the database
    try {
        $stmt = $pdo->prepare("SELECT otp_secret FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $totp = TOTP::create($user['otp_secret']);
            $isValid = $totp->verify($enteredOtp); 

            if ($isValid) {
                echo '<div class="success-message-container">';
                echo "Registration successful!<br><a href='login.php' class='back-to-login'>Back to Login</a>";
                echo '</div>';
            } else {
                echo '<div class="error-message-container">';
                echo "Invalid OTP, please try again.";
                echo '</div>';
            }
        } else {
            echo "User not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }

        input[type="text"], input[type="password"], input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #b42fbd;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #9e28a7;
        }

        .otp-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .otp-form {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
            margin: auto;
        }

        .otp-form input[type="text"],
        .otp-form input[type="submit"] {
            display: block;
            width: 90%;
            padding: 8px;
            margin: 10px auto;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .otp-form input[type="submit"] {
            background-color: #b42fbd;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .otp-form input[type="submit"]:hover {
            background-color: #9a26a3;
        }

        a.back-to-welcome, a.back-to-login {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #b42fbd;
        }

        a.back-to-welcome:hover, a.back-to-login:hover {
            text-decoration: underline;
        }

        .success-message-container, .error-message-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .success-message-container a.back-to-login, .error-message-container a.back-to-login {
            color: #b42fbd;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
        }

        .success-message-container a.back-to-login:hover, .error-message-container a.back-to-login:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <input type="submit" name="register" value="Register">
        </form>
        <a href="index.php" class="back-to-welcome">Back to Welcome Page</a>
    </div>
</body>
</html>
