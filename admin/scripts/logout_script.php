<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Clear any other cookies if needed
// setcookie('remember_me', '', time()-3600, '/');  // Example for remember me cookie

// Redirect to login page with a success message
header('Location: ../login.php?logout=success');
exit();
?>