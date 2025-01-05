<?php
require 'conn.php';
require 'is_added_to_cart.php';

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Display success message if order was successful
if (isset($_SESSION['order_success'])) {
    echo '<div class="alert alert-success" role="alert">Your order has been placed successfully!</div>';
    unset($_SESSION['order_success']); // Clear the message after displaying
}

$user_id = $_SESSION['user_id'];

// Use prepared statements to prevent SQL injection
$query = "SELECT c.*, p.title as name, p.price, oi.quantity 
          FROM cart c 
          JOIN products p ON c.product_id = p.id 
          LEFT JOIN order_items oi ON c.product_id = oi.product_id 
          WHERE c.user_id = ?";
$stmt = $con->prepare($query);
if ($stmt === false) {
    die("Prepare failed: " . $con->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total = 0;

// Calculate total only if there are items in the cart
if ($result && mysqli_num_rows($result) > 0) {
    while ($item = mysqli_fetch_assoc($result)) {
        $cart_items[] = $item; // Store each item in the array
        $item_total = $item['price'] * ($item['quantity'] ?? 1);
        $total += $item_total;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - E-Eco Lanka</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
require "header.php";
?>

<section class="cart_area padding_top">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($cart_items)):
                            foreach ($cart_items as $item): 
                                $item_total = $item['price'] * ($item['quantity'] ?? 1);
                        ?>
                            <tr>
                                <td>
                                    <div class="media-body">
                                        <p><?php echo htmlspecialchars($item['name']); ?></p>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rs. <?php echo number_format($item['price'], 2); ?></h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <form action="scripts/cart_add.php" method="GET">
                                            <input type="hidden" name="id" value="<?php echo $item['product_id']; ?>">
                                            <input type="number" name="qty" value="<?php echo $item['quantity'] ?? 1; ?>" min="1" class="input-number">
                                            <button type="submit" class="btn">Update</button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rs. <?php echo number_format($item_total, 2); ?></h5>
                                </td>
                                <td>
                                    <a href="scripts/cart_remove.php?id=<?php echo $item['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to remove this item?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endforeach;
                        else: 
                        ?>
                            <tr>
                                <td colspan="5" class="text-center">Your cart is empty</td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if (!empty($cart_items)): ?>
                        <tr class="bottom_button">
                            <td colspan="3">
                                <div class="cupon_text">
                                    <input type="text" placeholder="Coupon Code" name="coupon_code">
                                    <a class="btn" href="#">Apply Coupon</a>
                                </div>
                            </td>
                            <td colspan="2">
                                <h5>Subtotal: Rs. <?php echo number_format($total, 2); ?></h5>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                
                <div class="checkout_btn_inner float-right">
                    <a class="btn" href="marketplace.php">Continue Shopping</a>
                    <?php if ($total > 0): ?>
                    <form action="process_payment.php" method="POST">
                        <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
                        <button type="submit" class="btn">Order</button>
                    </form>
                    <?php else: ?>
                        <p class="text-danger">Your cart is empty. Please add items to proceed.</p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
</body>
</html>

<?php
mysqli_close($con);
?> 