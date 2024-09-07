-- Create the database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS medication_reminder;

-- Use the newly created database
USE medication_reminder;

-- Create the `users` table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mfa_code VARCHAR(6) DEFAULT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- Create the `medications` table
CREATE TABLE IF NOT EXISTS medications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    medication_name VARCHAR(100) NOT NULL,
    dosage VARCHAR(50) NOT NULL,
    time TIME NOT NULL,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
