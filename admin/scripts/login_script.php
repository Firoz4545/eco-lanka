<?php
require "../includes/conn.php";
session_start();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, email, password FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['admin_email'] = $user['email'];
    $_SESSION['admin_id'] = $user['id'];
    header('location: ../index.php');
} else {
    $m = "Please enter correct E-mail id and Password";
    header('location: ../login.php?errorl='.$m);
}

$stmt->close();
$conn->close();
