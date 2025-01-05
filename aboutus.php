<?php
require 'conn.php';
require 'is_added_to_cart.php';
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Logout logic
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to home page after logout
    exit();
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Eco Lanka</title>
    <link rel="stylesheet" href="css/aboutus.css">
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
    <div class="about-container">
        <h1>About E-Eco Lanka</h1>
        <p>Welcome to E-Eco Lanka, your dedicated partner in e-waste management and sustainable recycling solutions. We are committed to creating a cleaner and healthier environment for future generations by responsibly managing electronic waste.</p>

        <h2>Our Mission</h2>
        <p>Our mission is to provide an efficient, reliable, and environmentally friendly service for the collection and recycling of electronic waste. We aim to minimize the impact of e-waste on the environment and promote sustainability through education and responsible disposal practices.</p>

        <h2>Our Vision</h2>
        <p>We envision a world where e-waste is no longer a burden on our planet, but a resource for innovation and growth. Through our efforts, we strive to lead the way in sustainable waste management practices in Sri Lanka.</p>

        <h2>Our Values</h2>
        <ul class="values">
            <li><strong>Sustainability:</strong> We prioritize environmentally friendly practices in all our operations.</li>
            <li><strong>Integrity:</strong> We operate with honesty and transparency, ensuring our clients trust our services.</li>
            <li><strong>Community:</strong> We believe in the power of community engagement to promote e-waste awareness and responsible disposal.</li>
            <li><strong>Innovation:</strong> We continuously seek innovative solutions to improve our services and promote sustainability.</li>
        </ul>

        <h2>What We Do</h2>
        <p>At E-Eco Lanka, we offer a range of services to address the growing challenge of e-waste, including:</p>
        <ul>
            <li>Free pickup services for electronic waste</li>
            <li>Partnerships with recycling centers for responsible disposal</li>
            <li>Educational resources and workshops on e-waste management</li>
            <li>A marketplace for refurbished electronics and components</li>
        </ul>

        <h2>Join Us</h2>
        <p>We invite individuals, businesses, and organizations to join us in our mission to promote sustainable practices and protect our environment. Together, we can make a difference!</p>

        <div class="footer">
            <p>&copy; <?php echo date("Y"); ?> E-Eco Lanka. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php

require "header.php";