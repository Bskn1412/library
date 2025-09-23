<?php
session_start();

// Adjust path based on where this is included
$loginRedirectPath = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../login.php' : 'login.php';

if (!isset($_SESSION['username'])) {
    header("Location: $loginRedirectPath");
    exit();
}

if ($_SESSION['page'] !== 'adminpage') {
    header("Location: $loginRedirectPath");
    exit();
}
?>
