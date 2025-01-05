<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer using Composer's autoloader

// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "e-eco-lanka";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id, username FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        $stmt->close();

        // Generate token and expiration
        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 1800; // Expires in 30 minutes

        // Store reset token and expiration in the database
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $token, $expires);

        if ($stmt->execute()) {
            // Create reset link and prepare email content
            $reset_link = "http://yourdomain.com/reset-password.php?token=$token";
            $email_template_path = 'email_template.html';

            if (!file_exists($email_template_path)) {
                die("Email template not found.");
            }

            $email_template = file_get_contents($email_template_path);
            $email_template = str_replace('{username}', $username, $email_template);
            $email_template = str_replace('{reset_link}', $reset_link, $email_template);

            // Configure PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'e.ecolanka@gmail.com'; // Sender's email address
                $mail->Password = 'your-email-password';  // Replace with the actual password or app-specific password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email settings
                $mail->setFrom('e.ecolanka@gmail.com', 'E-Eco Lanka');
                $mail->addAddress($email); 

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = $email_template;

                $mail->send();
                echo "Password reset link has been sent to your email.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Failed to store reset token.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>
