<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['username']) || !isset($_SESSION['page'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Optional: Ensure only "admin" can access admin folder
if ($_SESSION['page'] !== "adminpage") {
    header("Location: ../pages/view_students.php"); // Redirect to a safer page
    exit();
}
?>