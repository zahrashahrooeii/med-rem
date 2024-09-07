<?php
require '../src/config.php';
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $entered_otp = $_POST['otp'];

    // Retrieve the user's OTP and secret from the database
    $stmt = $pdo->prepare("SELECT mfa_code, otp_secret FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['mfa_code'] == $entered_otp) {
            // OTP is correct
            echo "OTP verified successfully!";
            echo '<br><a href="login.php">Back to Login</a>'; 
            
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "Error: User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>
    <form action="verify_otp.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="otp">OTP:</label>
        <input type="text" name="otp" required><br>

        <input type="submit" value="Verify OTP">
    </form>
</body>
</html>
