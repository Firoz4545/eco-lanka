<?php
// Enable detailed error reporting
ini_set('display_errors', 1); // Display errors on the screen
ini_set('display_startup_errors', 1); // Display startup errors
error_reporting(E_ALL); // Report all types of errors

session_start(); // Start a new session or resume the existing session

// Database connection parameters
$servername = "localhost"; // Database server name
$db_username = "root"; // Database username
$db_password = ""; // Database password
$dbname = "e-eco-lanka"; // Database name

// Create a new mysqli connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate script if connection fails
}

// Initialize error and success messages
$error = '';
$success = '';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $username = trim($_POST['username']); // Trim whitespace from username
    $email = trim($_POST['email']); // Trim whitespace from email
    $password = $_POST['password']; // Get password
    $confirm_password = $_POST['confirm_password']; // Get confirmed password

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match."; // Set error message if passwords do not match
    } else {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the database
        $stmt = $conn->prepare("INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error); // Terminate script if preparation fails
        }

        // Bind parameters to the SQL query
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            $success = "Registration successful. You can now <a href='login.php'>login</a>."; // Set success message
        } else {
            $error = "Error: " . $stmt->error; // Set error message if execution fails
        }

        $stmt->close(); // Close the prepared statement
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <title>Register</title> <!-- Page title -->
    <link rel="stylesheet" href="css/register.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif; // Set font family
            background: url("images/background.jpg") no-repeat center center fixed; // Set background image
            background-size: cover; // Cover the entire background
            margin: 0; // Remove default margin
            padding: 0; // Remove default padding
            color: #333; // Set text color
        }
    </style>
</head>
<body>
    <div class="login-container"> <!-- Container for the registration form -->
        <h2>Register</h2> <!-- Registration heading -->
        <?php if ($error): ?> <!-- Check if there is an error message -->
            <p style="color: red;"><?= $error ?></p> <!-- Display error message in red -->
        <?php endif; ?>
        <?php if ($success): ?> <!-- Check if there is a success message -->
            <p style="color: green;"><?= $success ?></p> <!-- Display success message in green -->
        <?php endif; ?>
        <form action="register.php" method="post"> <!-- Form for user registration -->
            <div class="form-group">
                <label for="username">Username:</label> <!-- Username label -->
                <input type="text" id="username" name="username" required> <!-- Username input field -->
            </div>
            <div class="form-group">
                <label for="email">Email:</label> <!-- Email label -->
                <input type="email" id="email" name="email" required> <!-- Email input field -->
            </div>
            <div class="form-group">
                <label for="password">Password:</label> <!-- Password label -->
                <input type="password" id="password" name="password" required> <!-- Password input field -->
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label> <!-- Confirm password label -->
                <input type="password" id="confirm-password" name="confirm_password" required> <!-- Confirm password input field -->
            </div>
            <div class="form-group">
                <button type="submit">Register</button> <!-- Submit button -->
            </div>
            <div class="bottom-text">
                <a href="login.php">Back to Login</a> <!-- Link to login page -->
            </div>
        </form>
    </div>
</body>
</html>
