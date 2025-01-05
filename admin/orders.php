<?php 
// Include the database connection file
require 'includes/conn.php';

// Start a session to manage user login state
session_start();

// Check if the admin is logged in; if not, redirect to the login page
if(!isset($_SESSION['admin_email'])){
    echo "<script> location.href='/ecommerce/admin/login.php'; </script>";
    exit();
}

// Include the header file for the admin panel
require "includes/header.php";

?>

<div class="mainContainer">
    <?php require "includes/sidebar.php" ?> <!-- Include the sidebar for navigation -->

    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">All Customer Orders</h1> <!-- Title for the orders page -->
            </div>
        </div>

        <div class="container">
            <table class="table container"> <!-- Start of the table to display orders -->
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to select all orders from the database
                    $query = 'SELECT id, user_id, total_amount, status, created_at FROM `orders`';

                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    
                    // Loop through each order and display it in a table row
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><th>" . $row['id'] . "</th>"; // Display Order ID
                        echo "<td>" . $row['user_id'] . "</td>"; // Display User ID
                        echo "<td>Rs. " . number_format($row['total_amount'], 2) . "</td>"; // Display Total Amount formatted
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Display Status (escaped for safety)
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>"; // Display Date (escaped for safety)
                        echo "<td>
                            <a href='scripts/delete_script_order.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                        </td></tr>"; // Action button to delete the order
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS for styling and functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
