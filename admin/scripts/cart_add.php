<?php
session_start();
require '../conn.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_GET['id']) && isset($_GET['qty'])) {
    $product_id = mysqli_real_escape_string($con, $_GET['id']);
    $qty = mysqli_real_escape_string($con, $_GET['qty']);
    $user_id = $_SESSION['user_id'];
    
    // Check if product already in cart
    $check_query = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
    $check_result = mysqli_query($con, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        // Update quantity if already in cart
        $update_query = "UPDATE cart SET quantity=quantity+$qty WHERE product_id='$product_id' AND user_id='$user_id'";
        mysqli_query($con, $update_query);
    } else {
        // Add new item to cart
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$qty')";
        mysqli_query($con, $insert_query);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
