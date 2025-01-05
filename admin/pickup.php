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
                <h1 class="display-4">All Pickup Requests</h1> <!-- Title for the page -->
            </div>
        </div>

        <div class="container">
            <table class="table container"> <!-- Start of the table to display pickup requests -->
                <thead>
                    <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Action</th> <!-- Column for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to select all pickup requests from the database
                    $query = 'SELECT id, name, email, phone, address, date, time FROM `pickups`';

                    // Execute the query
                    $result = mysqli_query($conn, $query);
    
                    // Loop through each row returned from the query
                    while ($row = mysqli_fetch_array($result)) {
                        // Display each pickup request in a table row
                        echo "<tr><th>" . $row['id'] . "</th>";
                        echo "<th>" . $row['name'] . "</th>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>
                            <a href='scripts/delete_script_pickup.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                        </td></tr>"; // Button to delete the pickup request
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript for styling and functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>