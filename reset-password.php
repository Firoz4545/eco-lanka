<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - E-Eco Lanka</title>
    <link rel="stylesheet" href="reset-password.css">
</head>
<body>
    <div class="reset-password-container">
        <div class="reset-password-box">
            <img src="images/logo.png" alt="E-Eco Lanka Logo" class="logo">
            <h2>Reset Password</h2>
            <?php
            // Check if the token is set in the URL
            if (isset($_GET['token'])) {
                $token = $_GET['token']; // Retrieve the token from the URL
                // Prepare a statement to verify the token
                $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
                $stmt->bind_param("s", $token); // Bind the token parameter
                $stmt->execute(); // Execute the statement
                $stmt->store_result(); // Store the result for checking

                // Check if any rows were returned (token is valid)
                if ($stmt->num_rows > 0) {
                    // Check if the form was submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Hash the new password
                        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt->bind_result($email); // Bind the result to get the email
                        $stmt->fetch(); // Fetch the email associated with the token

                        // Update the password in the database
                        $stmt->close(); // Close the previous statement
                        $stmt = $conn->prepare("UPDATE register SET password = ? WHERE email = ?");
                        $stmt->bind_param("ss", $new_password, $email); // Bind the new password and email
                        if ($stmt->execute()) {
                            // Delete token
                            // ... code to delete the token from the database ...
                        }
                    }
                }
            }