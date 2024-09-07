<?php
session_start();

// Ensure the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Placeholder for adding medications and displaying them
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_medication'])) {
    
    echo "Medication added!";
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: welcome.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication Dashboard</title>
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

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        input[type="text"], input[type="number"], input[type="submit"] {
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
            background-color: #9a26a3;
        }

        .medications-list {
            margin-top: 20px;
            text-align: left;
        }

        .medication-item {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .medication-item h3 {
            margin: 0;
            color: #333;
        }

        .medication-item p {
            margin: 5px 0 0;
            color: #777;
        }

        .back-to-welcome, .logout-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #b42fbd;
        }

        .back-to-welcome:hover, .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Medication Dashboard</h2>
        <form action="dashboard.php" method="POST">
            <label for="medication_name">Medication Name</label>
            <input type="text" name="medication_name" required>

            <label for="dosage">Dosage</label>
            <input type="text" name="dosage" required>

            <input type="submit" name="add_medication" value="Add Medication">
        </form>

        <div class="medications-list">
            <h3>Your Medications</h3>
            <!-- This is where you will loop through and display medications from the database -->
            <div class="medication-item">
                <h3>Example Medication</h3>
                <p>Dosage: 100mg</p>
            </div>
        </div>

        <a href="dashboard.php?logout=true" class="logout-link">Logout</a>
        <a href="welcome.php" class="back-to-welcome">Back to Welcome Page</a>
    </div>
</body>
</html>
