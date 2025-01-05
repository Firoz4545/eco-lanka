<?php
session_start();
require "../includes/conn.php";

// Validate and sanitize inputs
$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
$mobile = trim(filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$password = $_POST['password'];

// Validate inputs
if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
    header('location: ../register.php?error=All fields are required');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location: ../register.php?error=Invalid email format');
    exit();
}

// Check if email already exists
$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header('location: ../register.php?error=Email already exists');
    exit();
}

// Hash password using modern method
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new admin
$stmt = $conn->prepare("INSERT INTO admin (name, mobile, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $mobile, $email, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['admin_email'] = $email;
    $_SESSION['admin_id'] = $stmt->insert_id;
    header('location: ../index.php');
} else {
    header('location: ../register.php?error=Registration failed');
}

$stmt->close();
$conn->close();
?>