<?php
// Enable detailed error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start a new session or resume the existing session
session_start();

// Database connection parameters
$servername = "localhost"; // Database server name
$db_username = "root"; // Database username
$db_password = ""; // Database password
$dbname = "e-eco-lanka"; // Database name

// Create a new mysqli connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate script if connection fails
}

$error = ''; // Initialize an error variable

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $username = trim($_POST['username']); // Trim whitespace from username
    $password = $_POST['password']; // Get the password

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM register WHERE username = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); // Terminate script if preparation fails
    }

    // Bind the username parameter to the SQL statement
    $stmt->bind_param("s", $username);
    $stmt->execute(); // Execute the prepared statement
    $stmt->bind_result($user_id, $hashed_password); // Bind the result variables
    $stmt->fetch(); // Fetch the result
    $stmt->close(); // Close the statement

    // Verify the provided password against the hashed password from the database
    if ($hashed_password && password_verify($password, $hashed_password)) {
        // If password is correct, store user information in session variables
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id; // Store user ID in session
        header("Location: index.php"); // Redirect to the index page
        exit(); // Terminate the script
    } else {
        $error = "Invalid username or password."; // Set error message for invalid login
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css"> <!-- Include your CSS for styling -->
    <title>Login - E-Eco Lanka</title>
    <style>
        body {
            font-family: Arial, sans-serif; // Set font for the body
            background: url("images/background.jpg") no-repeat center center fixed; // Set background image
            background-size: cover; // Cover the entire background
            margin: 0; // Remove default margin
            padding: 0; // Remove default padding
            color: #333; // Set text color
        }
    </style>
</head>
<body>
    <div class="login-container"> <!-- Container for the login form -->
        <img src="images/logo.png" alt="E-Eco Lanka Logo" class="logo"> <!-- Logo image -->
        <h2>Login</h2> <!-- Login heading -->

        <?php if ($error): ?> <!-- Check if there is an error message -->
            <div class="error"><?php echo $error; ?></div> <!-- Display error message -->
        <?php endif; ?>

        <form action="login.php" method="post"> <!-- Form for user login -->
            <div class="input-group"> <!-- Input group for username -->
                <label for="username">Username</label> <!-- Label for username -->
                <input type="text" id="username" name="username" required> <!-- Input field for username -->
            </div>
            <div class="input-group"> <!-- Input group for password -->
                <label for="password">Password</label> <!-- Label for password -->
                <input type="password" id="password" name="password" required> <!-- Input field for password -->
            </div>
            <button type="submit" class="btn">Login</button> <!-- Submit button -->
        </form>

        <div class="bottom-text"> <!-- Container for additional text -->
            <p>Don't have an account? <a href="register.php">Register</a></p> <!-- Link to registration page -->
            <p><a href="forgot-password.php">Forgot Password?</a></p> <!-- Link to forgot password page -->
        </div>
    </div>
</body>
</html>
