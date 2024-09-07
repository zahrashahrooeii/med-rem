<?php
require '../src/config.php';
require '../vendor/autoload.php';

use OTPHP\TOTP;

session_start();

// Ensure the user is logged in and has an MFA secret
if (!isset($_SESSION['user_id'])) {
    die('Access denied.');
}

// Fetch the MFA secret for the logged-in user from the database
$stmt = $pdo->prepare("SELECT otp_secret FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user || !$user['otp_secret']) {
    die('MFA is not set up for your account.');
}

$totp = TOTP::create($user['otp_secret']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {
    $enteredOtp = $_POST['otp'];
    $isValid = $totp->verify($enteredOtp);

    if ($isValid) {
        echo "MFA verified successfully!";
        
    } else {
        echo "Invalid OTP, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA Verification</title>
</head>
<body>
    <h2>MFA Verification</h2>
    <form action="mfa.php" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required><br>
        <input type="submit" value="Verify">
    </form>
</body>
</html>
