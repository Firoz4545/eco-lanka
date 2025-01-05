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
    header("Location: index.php"); // Redirect to home page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Eco Lanka</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script>
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault(); // Prevent the default action of the link
            }
        }
    </script>
</head>
<body>
    <!-- Home -->
    <section id="home">
        <h2>Welcome to E-Eco Lanka</h2>
        <p>
            E-waste poses a significant environmental threat due to harmful
            chemicals and heavy metals. Our company specializes in responsibly
            recycling electronic waste, ensuring valuable materials are recovered
            and hazardous components are safely managed, promoting sustainability
            and protecting the environment.
        </p>
     
    </section>

    <!-- Features -->
    <section id="feature">
        <h1>Features</h1>
        <p>Discover the innovative features of E-Eco Lanka! We offer convenient e-waste collection services, advanced recycling and upcycling processes, a marketplace for repurposed products, and educational resources to promote sustainability. Join us to make a positive impact on the environment!</p>
        <div class="fea-base">
            <div class="fea-box">
                <i class="fa-solid fa-truck-pickup"></i>
                <h3>E-Waste Collection Service</h3>
                <p>Our comprehensive e-waste collection service ensures the convenient and environmentally responsible disposal of your electronic waste.</p>
            </div>
            <div class="fea-box">
                <i class="fa-solid fa-recycle"></i>
                <h3>Recycling and Upcycling Processes</h3>
                <p>We offer robust recycling and upcycling processes to transform e-waste into valuable resources.</p>
            </div>
            <div class="fea-box">
                <i class="fa-solid fa-store"></i>
                <h3>Online Marketplace</h3>
                <p>Our online marketplace features a variety of products created from upcycled e-waste.</p>
            </div>
        </div>
    </section>

    <!-- Registration -->
    <section id="registration">
        <div class="reminder">
            <h1>Register Now!</h1>
            <p>Join E-Eco Lanka and be part of the solution for a greener future! Register now to schedule e-waste pickups, access our upcycled product marketplace, and stay informed with the latest in e-waste management. Let's make a sustainable impact together!</p>
        </div>
        <div class="form">
            <a class="gren" href="register.php">Register</a>
        </div>
    </section>

    <!-- About Us -->
    <section id="aboutus">
        <h1>About Us</h1>
        <p>
            At E-Eco Lanka, we are dedicated to creating sustainable solutions for electronic waste management. Our mission is to reduce environmental impact by promoting responsible e-waste disposal, recycling, and upcycling. We provide convenient e-waste collection services, educate the community on sustainable practices, and offer a marketplace for unique, repurposed products. Join us in our commitment to preserving the environment and building a greener future for all.
        </p>
    </section>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>
</body>
</html>
