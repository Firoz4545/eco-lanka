<?php
// Include database connection and cart functionality
require 'conn.php';
require 'is_added_to_cart.php';

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logout logic: if 'logout' is set in the URL, clear the session and redirect to the home page
if (isset($_GET['logout'])) {
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to home page after logout
    exit(); // Stop further script execution
}

// Include CSS files for styling the page
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

// Include the header of the page
require "header.php";

// Query to select all products from the database
$query = 'SELECT * FROM `products`';
$result = mysqli_query($con, $query); // Execute the query

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($con)); // Display error message if the query fails
}

// Initialize a counter for the number of products
$sum = 0;

// Loop through the result set to count the number of products
while ($row = mysqli_fetch_array($result)) {
    $sum++; // Increment the product count
}

// Reset the result pointer to fetch the data again for display
mysqli_data_seek($result, 0); // Reset the result set pointer

?>

<!-- Breadcrumb section for navigation -->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>All Products</h2>
                        <p>Home <span>-</span> Buy Products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main product display section -->
<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <!-- Categories filter -->
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <li>
                                    <a href="#">Consumer Electronics</a>
                                    <span>(3)</span>
                                </li>
                                <li>
                                    <a href="#">Home Appliances</a>
                                    <span>(2)</span>
                                </li>
                                <li>
                                    <a href="#">Office Equipment</a>
                                    <span>(2)</span>
                                </li>
                                <li>
                                    <a href="#">Industrial Electronics</a>
                                    <span>(3)</span>
                                </li>
                                <li>
                                    <a href="#">Batteries & Power Supplies</a>
                                    <span>(2)</span>
                                </li>
                                <li>
                                    <a href="#">Miscellaneous Electronics</a>
                                    <span>(6)</span>
                                </li>
                                <li>
                                    <a href="#">E-Waste Recycling Services</a>
                                    <span>(6)</span>
                                </li>
                                <li>
                                    <a href="#">Educational Resources</a>
                                    <span>(3)</span>
                                </li>
                                <li>
                                    <a href="#">Renewable Energy Devices</a>
                                    <span>(2)</span>
                                </li>
                                <li>
                                    <a href="#">Electronics Repair Services</a>
                                    <span>(3)</span>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <!-- Price filter -->
                    <aside class="left_widgets p_filter_widgets price_rangs_aside">
                        <div class="l_w_title">
                            <h3>Price Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <div class="range_item">
                                <input type="text" class="js-range-slider" value="" />
                                <div class="d-flex">
                                    <div class="price_text">
                                        <p>Price :</p>
                                    </div>
                                    <div class="price_value d-flex justify-content-center">
                                        <input type="text" class="js-input-from" id="amount" readonly />
                                        <span>to</span>
                                        <input type="text" class="js-input-to" id="amount" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu">
                                <p><span><?php echo $sum ?> </span> Product Found</p> <!-- Display the number of products found -->
                            </div>
                            <div class="single_product_menu d-flex">
                                <h5>sort by :</h5>
                                <select>
                                    <option data-display="Select">name</option>
                                    <option value="1">price</option>
                                    <option value="2">product</option>
                                </select>
                            </div>
                            <div class="single_product_menu d-flex">
                                <h5>show :</h5>
                                <div class="top_pageniation">
                                    <ul>
                                        <li>1</li>
                                        <li>2</li>
                                        <li>3</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single_product_menu d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="search" aria-describedby="inputGroupPrepend" />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center latest_product_inner">

                <?php
                    // Loop through the products and display them
                    while ($row = mysqli_fetch_array($result)) {
                        $productTitle = !empty($row['title']) ? $row['title'] : 'Unnamed Product'; // Default name if title is missing
                        echo '<div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <img width="200px" src="img/product/'.$row['image'].'" alt="'.htmlspecialchars($productTitle).'" />
                                    <div class="single_product_text">
                                        <h4 style="color: white;">'. htmlspecialchars($productTitle) .'</h4>
                                        <h3 style="color: white;">Rs. '. htmlspecialchars($row['price']) .'</h3>';
                                        // Check if the user is logged in and if the product is already in the cart
                                        if(!isset($_SESSION['user_id'])) {
                                            echo '<a href="login.php" class="add_cart btn_3">Login to Add to Cart<i class="ti-shopping-cart"></i></a>';
                                        } else if(!check_if_added_to_cart($row['id'])) {
                                            echo '<form action="scripts/cart_add.php" method="GET">
                                                    <input type="hidden" name="id" value="'.$row['id'].'">
                                                    <input type="number" name="qty" value="1" min="1" style="width: 50px; display: inline-block;">  
                                                    <button type="submit" class="add_cart btn_3">Add to Cart<i class="ti-shopping-cart"></i></button>
                                                  </form>';
                                        } else {
                                            echo '<a href="cart.php" class="add_cart btn_3 added" style="color: white;">View Cart<i class="ti-shopping-cart"></i></a>';
                                        }
                                        
                                  echo '</div>
                                </div>
                            </div>';
                    }
                ?>
                
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include the footer of the page -->
<?php require 'footer.php' ?>

<!-- Include JavaScript files for functionality -->
<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/masonry.pkgd.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/stellar.js"></script>
<script src="js/price_rangs.js"></script>
<script src="js/custom.js"></script>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7721ac04f8bd3390","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>
</body>

</html>