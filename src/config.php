<?php

$db_host = 'localhost';
$db_name = 'medication_reminder';
$db_user = 'root';
$db_pass = ''; // Leave this empty if you don't have a password for MySQL

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Database connection successful!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


