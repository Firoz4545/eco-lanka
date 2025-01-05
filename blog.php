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
    <title>E-Eco Lanka Blog</title>
    <link rel="stylesheet" href="css/blog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="script.js">
</head>
<body>
    
    <main>
        <div class="content-wrapper">
            <section class="featured-posts">
                <h2>Featured Posts</h2>
                <div class="post">
                    <img src="images/recycle.jpg" alt="Recycling">
                    <h3>How to Recycle E-Waste Properly</h3>
                    <p>Learn the best practices for recycling electronic waste...</p>
                    <a href="#">Read more</a>
                </div>
                <div class="post">
                    <img src="images/upcycling.jpg" alt="Upcycling">
                    <h3>Creative Upcycling Ideas</h3>
                    <p>Discover unique and creative ways to upcycle your old electronics...</p>
                    <a href="#">Read more</a>
                </div>
            </section>

            <section class="recent-posts">
                <h2>Recent Posts</h2>
                <div class="post">
                    <img src="images/ewaste.jpg" alt="E-Waste">
                    <h3>Understanding E-Waste</h3>
                    <p>A deep dive into what e-waste is and its impact on the environment...</p>
                    <a href="#">Read more</a>
                </div>
                <div class="post">
                    <img src="images/benefits.jpg" alt="Benefits of Recycling">
                    <h3>Benefits of Recycling</h3>
                    <p>Explore the environmental and economic benefits of recycling e-waste...</p>
                    <a href="#">Read more</a>
                </div>
                <div class="pagination">
                    <a href="#">&laquo; Previous</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">Next &raquo;</a>
                </div>
            </section>
        </div>

        <aside>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search...">
                <button onclick="searchPosts()">Search</button>
            </div>
            <div class="categories">
                <h2>Categories</h2>
                <ul>
                    <li><a href="#">Recycling Tips</a></li>
                    <li><a href="#">Upcycling Ideas</a></li>
                    <li><a href="#">E-Waste News</a></li>
                    <li><a href="#">Community Stories</a></li>
                    <li><a href="#">Sustainable Living</a></li>
                </ul>
            </div>
            <div class="subscription-box">
                <h2>Subscribe</h2>
                <input type="email" placeholder="Your email address">
                <button>Subscribe</button>
            </div>
        </aside>
    </main>

    <section class="footer">
      <div class="footer-col">
        <h3>Quick links</h3>
        <li>blog</li>
        <li>market place</li>
        <li>contact us</li>
        <li>about us</li>
      </div>
      <div class="footer-col">
        <h3>Get in touch</h3>
        <li>10/A Colombo , Sri Lanka</li>
       
      </div>

      <div class="footer-col">
        <h3>Subcribe</h3>
        <p>Work with us </p>
        <div class="subcribe">
          <input type="text" placeholder="Your Email Address">
          <a href="#" class="red">Subcribe</a>
        </div>
      </div>
      <div class="copyright">
        <p>© 2024 E-Eco Lanka. All rights reserved.</p>
        <div class="pro-links">
          <i class="fa-brands fa-square-facebook"></i>
          <i class="fab fa-instagram"></i>
          <i class="fa-brands fa-linkedin"></i>
          
        </div>

      </div>
    

      </div>
    </section>

    <script src="scripts.js"></script>
</body>
</html>

<?php

require "header.php";