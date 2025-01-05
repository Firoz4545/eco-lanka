<?php
require 'conn.php';
require 'is_added_to_cart.php';
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Add these CSS links before including header.php if they're not already in header.php
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/themify-icons.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/style.css">
<?php

require "header.php";
// Logout logic
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Logout logic
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to home page after logout
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-eco-lanka";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$error = '';
$success = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($date) || empty($time)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO pickups (user_id, name, email, phone, address, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $user_id = $_SESSION['user_id']; // Ensure user_id is taken from the session
        $stmt->bind_param("issssss", $user_id, $name, $email, $phone, $address, $date, $time);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            $success = "Pickup booked successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close(); // Close the statement
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book E-Waste Pickup - E-Eco Lanka</title>
    <link rel="stylesheet" href="css/book-pickup.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book E-Waste Pickup</h1>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="book-pickup.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Pickup Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div id="map" class="google-maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58638747445!2d79.77380309228506!3d6.922001981219109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1730129845784!5m2!1sen!2slk" width="100" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="form-group">
                <label for="date">Pickup Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Pickup Time</label>
                <input type="time" id="time" name="time" required>
            </div>
            <button type="submit" class="book-btn">Book Pickup</button>
        </form>
    </div>
</body>
</html>
