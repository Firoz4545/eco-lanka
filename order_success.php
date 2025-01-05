<?php
session_start();
require 'includes/conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch order details from the session or database
$order_id = $_SESSION['order_id'] ?? null;

if ($order_id) {
    // Fetch order details from the database
    $query = "SELECT * FROM orders WHERE id = '$order_id'";
    $result = mysqli_query($conn, $query);
    
    // Check if the query was successful and if any order was found
    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
    } else {
        // Improved error handling
        echo "<div class='alert alert-danger'>No order found with ID: " . htmlspecialchars($order_id) . ".</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>No order ID found in the session.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - E-Eco Lanka</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/order_success.css">
</head>
<body>
    <div class="container">
        <h1>Order Successful!</h1>
        <p>Thank you for your order. Your order ID is: <strong><?php echo htmlspecialchars($order['id']); ?></strong></p>
        <p>Total Amount: <strong>Rs. <?php echo number_format($order['total_amount'], 2); ?></strong></p>
        <a href="marketplace.php" class="btn btn-primary" onclick="endShopping()">End Shopping</a>
    </div>

    <script>
        function endShopping() {
            <?php
            // Clear the order ID from the session
            unset($_SESSION['order_id']);
            ?>
            window.location.href = 'marketplace.php';
        }
    </script>
</body>
</html>
