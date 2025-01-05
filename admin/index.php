<?php
// Include the database connection file
require 'includes/conn.php';

// Start a new session or resume the existing session
session_start();

// Check if the admin email is set in the session
if(!isset($_SESSION['admin_email'])){
    // If not set, redirect to the admin login page
    echo "<script> location.href='/ecommerce/admin'; </script>";
    exit();
}

// Initialize variables
$mail = '';
if (isset($_SESSION['admin_email'])){
    // If the admin email is set, assign it to the $mail variable
    $mail = $_SESSION["admin_email"];
}
$name= '';

// Query to get all admin records
$query = 'SELECT * FROM admin';
$result = mysqli_query($conn, $query);

// Loop through the results to find the name of the logged-in admin
while($row = mysqli_fetch_array($result)){
    if($row['email'] == $mail){
        // If the email matches, store the admin's name
        $name = $row['name'];
    }
}
?>
<?php require_once "includes/header.php" ?>

<div class="mainContainer">
    <?php require "includes/sidebar.php" ?>

    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-8 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">Welcome to Admin Panel</h1>
                <h4>Hi, <?php echo $name ?> </h4> <!-- Display the admin's name -->
            </div>
        </div>

        <div class="container">
            <table class="table container">
                <thead class="py-4">
                    <tr>
                        <th scope="col">Admin Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php require "includes/conn.php" ?> <!-- Include the database connection again -->
                    <?php
                    // Query to get all admin records
                    $query = 'SELECT * FROM `admin`';
                    $result = mysqli_query($conn, $query);

                    // Loop through the results and display them in a table
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><th>" . $row['id'] . "</th>"; // Display Admin Id
                        echo "<th>" . $row['name'] . "</th>"; // Display Name
                        echo "<td>" . $row['mobile'] . "</td>"; // Display Contact Number
                        echo "<td>" . $row['email']  . "</td>"; // Display Email
                        echo "<td>
                                <a href='scripts/delete_script.php?id={$row['id']}'><button type='button' class='btn btn-danger'>Delete</button></a>
                            </td></tr>"; // Delete button for each admin
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