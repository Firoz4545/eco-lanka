<?php
require 'includes/conn.php'; // Ensure this line is present to include the database connection
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['total_amount'])) {
    header('Location: cart.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$order_amount = $_POST['total_amount'];

// Process the payment here (e.g., call to payment gateway)

// Example: Log the order amount for debugging
error_log("Processing payment for user $user_id: Amount = $order_amount");

// After processing, insert the order into the database
$query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("id", $user_id, $order_amount);

if ($stmt->execute()) {
    // Get the last inserted order ID
    $order_id = $stmt->insert_id;
    // Set the order ID in the session
    $_SESSION['order_id'] = $order_id;

    // Clear the cart after successful order
    $clear_cart_query = "DELETE FROM cart WHERE user_id = ?";
    $clear_stmt = $conn->prepare($clear_cart_query);
    $clear_stmt->bind_param("i", $user_id);
    $clear_stmt->execute();

    // Redirect to success page
    header('Location: order_success.php');
    exit();
} else {
    // Handle error
    echo "Error processing order: " . $stmt->error;
    exit();
}
?>