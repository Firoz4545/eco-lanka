<?php
require "../includes/conn.php";
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $message_id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../contact_us.php"); // Redirect back to the contact messages page
    exit();
} else {
    // Handle the case where the ID is not set or not numeric
    echo "Invalid ID.";
}
?> 