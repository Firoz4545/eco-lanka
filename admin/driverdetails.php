<?php

// Include the database connection file
require 'includes/conn.php';

// Start a session to manage user login state
session_start();

// Check if the admin is logged in; if not, redirect to the admin login page
if (!isset($_SESSION['admin_email'])) {
    echo "<script> location.href='/ecommerce/admin'; </script>";
    exit();
}

// Include the header file for the admin panel
require "includes/header.php";

// Handle form submission when the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data from POST request
    $name = $_POST['name'];
    $license = $_POST['license'];
    $phone = $_POST['phone'];
    $vehicle = $_POST['vehicle'];

    // Validate that all fields are filled
    if (!empty($name) && !empty($license) && !empty($phone) && !empty($vehicle)) {
        // Prepare an SQL statement to insert the new driver into the database
        $stmt = $conn->prepare("INSERT INTO drivers (name, license, phone, vehicle) VALUES (?, ?, ?, ?)");
        // Bind the parameters to the SQL query
        $stmt->bind_param("ssss", $name, $license, $phone, $vehicle);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Display a success message if the driver was added successfully
            echo "<div class='alert alert-success'>New driver added successfully</div>";
        } else {
            // Display an error message if there was an issue with the execution
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Display an error message if any fields are empty
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    }
}

?>

<div class="mainContainer">
    <!-- Include the sidebar for navigation -->
    <?php require "includes/sidebar.php" ?>

    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">Add Driver</h1> <!-- Title for the page -->
            </div>
        </div>

        <div class="container col-md-6 my-4">
            <!-- Form for adding a new driver -->
            <form class="row g-3" action="" method="POST">
                <div class="col-md-6">
                    <label for="name" class="form-label">Driver Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="col-md-6">
                    <label for="license" class="form-label">License Number</label>
                    <input type="text" name="license" class="form-control" id="license" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="col-md-6">
                    <label for="vehicle" class="form-label">Vehicle Type</label>
                    <input type="text" name="vehicle" class="form-control" id="vehicle" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Driver</button> <!-- Submit button -->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS for styling and functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
