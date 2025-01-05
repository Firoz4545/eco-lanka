<?php
session_start();
require '../conn.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_GET['id']) && isset($_GET['qty'])) {
    $product_id = mysqli_real_escape_string($con, $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Check if product already in cart
    $check_query = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
    $result = mysqli_query($con, $check_query);
    
    if(mysqli_num_rows($result) > 0) {
        // If product already in cart, just update the timestamp
        $update_query = "UPDATE cart SET created_at = CURRENT_TIMESTAMP 
                        WHERE product_id='$product_id' AND user_id='$user_id'";
        mysqli_query($con, $update_query);
    } else {
        // Add new item to cart
        $insert_query = "INSERT INTO cart (user_id, product_id) 
                        VALUES ('$user_id', '$product_id')";
        mysqli_query($con, $insert_query);
    }
}

// Redirect back to marketplace
header('Location: ../marketplace.php');
exit();
?>