<?php
// Include the database connection file
require 'includes/conn.php';

// Start a session to manage user login state
session_start();

// Check if the admin is logged in by verifying the session variable
if(!isset($_SESSION['admin_email'])){
    // If not logged in, redirect to the login page
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
                <h1 class="display-4">Contact Messages</h1> <!-- Title for the contact messages section -->
            </div>
        </div>

        <div class="container">
            <table class="table container">
                <thead>
                    <tr>
                        <th scope="col">Message ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to select all contact messages from the database
                    $query = 'SELECT id, name, email, subject, message, created_at FROM contact_messages';

                    // Execute the query
                    $result = mysqli_query($conn, $query);
                    
                    // Loop through each row returned by the query
                    while ($row = mysqli_fetch_array($result)) {
                        // Display each message in a table row
                        echo "<tr><th>" . $row['id'] . "</th>";
                        echo "<th>" . htmlspecialchars($row['name']) . "</th>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "<td>
                            <a href='scripts/delete_script_contact.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                        </td></tr>"; // Button to delete the message
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
