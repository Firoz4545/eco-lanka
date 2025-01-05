<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer using Composer's autoloader
require 'vendor/autoload.php'; 

// Database connection details
$servername = "localhost"; // Database server name
$db_username = "root"; // Database username
$db_password = ""; // Database password
$dbname = "e-eco-lanka"; // Database name

// Create connection to the database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate if connection fails
}

$message = ""; // Initialize message variable to store feedback for the user

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Get the email from the form submission

    // Prepare a statement to check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, username FROM register WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute(); // Execute the statement
    $stmt->store_result(); // Store the result for checking the number of rows
    $stmt->bind_result($user_id, $username); // Bind the result variables

    // Check if any rows were returned (i.e., if the email exists)
    if ($stmt->num_rows > 0) {
        $stmt->fetch(); // Fetch the result
        $stmt->close(); // Close the statement

        // Generate a unique token and set expiration time
        $token = bin2hex(random_bytes(50)); // Generate a random token
        $expires = date("U") + 1800; // Set expiration time to 30 minutes from now

        // Prepare a statement to insert the reset token into the database
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $token, $expires); // Bind parameters

        // Execute the statement to store the reset token
        if ($stmt->execute()) {
            // Create the reset link and prepare the email content
            $reset_link = "http://yourdomain.com/reset-password.php?token=$token"; // Reset link with token
            $email_template_path = 'email_template.html'; // Path to the email template

            // Check if the email template file exists
            if (!file_exists($email_template_path)) {
                die("Email template not found."); // Terminate if the template is missing
            }

            // Load the email template and replace placeholders with actual values
            $email_template = file_get_contents($email_template_path);
            $email_template = str_replace('{username}', $username, $email_template);
            $email_template = str_replace('{reset_link}', $reset_link, $email_template);

            // Configure PHPMailer for sending the email
            $mail = new PHPMailer(true);
            try {
                // SMTP configuration
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'e.ecolanka@gmail.com'; // Your Gmail address
                $mail->Password = 'tljg fktk wfbl aeqp'; // Your App Password (if using 2FA)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                // Set email recipients
                $mail->setFrom('e.ecolanka@gmail.com', 'E-Eco Lanka'); // Sender's email and name
                $mail->addAddress($email); // Add recipient's email

                // Set email content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Password Reset Request'; // Email subject
                $mail->Body = $email_template; // Email body content

                // Send the email
                $mail->send();
                $message = "Password reset link has been sent to your email."; // Success message
            } catch (Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Error message
            }
        } else {
            $message = "Failed to store reset token."; // Error if token storage fails
        }
    } else {
        $message = "No account found with that email."; // Error if email not found
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - E-Eco Lanka</title>
    <link rel="stylesheet" href="css/forgot-password.css"> <!-- Link to CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif; // Set font for the body
            background: url("images/background.jpg") no-repeat center center fixed; // Background image
            background-size: cover; // Cover the entire background
            margin: 0; // Remove default margin
            padding: 0; // Remove default padding
            color: #333; // Set text color
        }
    </style>
</head>
<body>
    <div class="login-container"> <!-- Container for the login form -->
        <div class="login-box"> <!-- Box for the login form -->
            <img src="images/logo.png" alt="E-Eco Lanka Logo" class="logo"> <!-- Logo image -->
            <h2>Forgot Password</h2> <!-- Heading -->
            <?php if (!empty($message)) : ?> <!-- Check if there is a message -->
                <div class="message-container"> <!-- Container for messages -->
                    <p class="success"><?php echo $message; ?></p> <!-- Display message -->
                </div>
            <?php endif; ?>
            <form action="forgot-password.php" method="post"> <!-- Form for email input -->
                <div class="input-group"> <!-- Input group for email -->
                    <label for="email">Email Address</label> <!-- Label for email input -->
                    <input type="email" id="email" name="email" required> <!-- Email input field -->
                </div>
                <button type="submit" class="forgot-btn">Send Reset Link</button> <!-- Submit button -->
                <div class="bottom-text"> <!-- Link to go back to login -->
                    <a href="login.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>