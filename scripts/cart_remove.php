<?php
session_start();
require '../conn.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_GET['id'])) {
    $cart_id = mysqli_real_escape_string($con, $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Delete item from cart
    $delete_query = "DELETE FROM cart WHERE id='$cart_id' AND user_id='$user_id'";
    mysqli_query($con, $delete_query);
}

// Redirect back to cart
header('Location: ../cart.php');
exit();
?>
