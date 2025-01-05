<?php 
// Include the database connection file
require 'includes/conn.php';
// Start a new session or resume the existing session
session_start();

// Check if the admin is logged in by verifying the session variable
if(!isset($_SESSION['admin_email'])){
    // If not logged in, redirect to the login page
    echo "<script> location.href='/ecommerce/admin/login.php'; </script>";
    exit(); // Stop further execution
}

// Include the header file for the admin panel
require "includes/header.php";
?>

<div class="mainContainer">
    <?php require "includes/sidebar.php" ?> <!-- Include the sidebar for navigation -->

    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">All Drivers</h1> <!-- Title for the page -->
            </div>
        </div>

        <div class="container">
            <table class="table container"> <!-- Start of the table to display drivers -->
                <thead>
                    <tr>
                        <th scope="col">Driver ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">License</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Action</th> <!-- Column for actions (e.g., delete) -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to select all drivers from the database
                    $query = 'SELECT id, name, license, phone, vehicle FROM `drivers`';
                    $result = mysqli_query($conn, $query); // Execute the query

                    // Loop through each row returned from the query
                    while ($row = mysqli_fetch_array($result)) {
                        // Display each driver's information in a table row
                        echo "<tr><th>" . $row['id'] . "</th>";
                        echo "<th>" . $row['name'] . "</th>";
                        echo "<td>" . $row['license'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['vehicle'] . "</td>";
                        echo "<td>
                            <a href='scripts/delete_script_driver.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                        </td></tr>"; // Button to delete the driver
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript for functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
