<?php
session_start();
session_unset();  // Remove all session variables
session_destroy(); // Destroy session completely

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login page
header("Location: login.php");
exit();
?>