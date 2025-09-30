<?php
$host = "localhost"; //"127.0.0.1:3307";
$user = "root";
$pass = "";
$dbname = "lib_db";

// Create a connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// Uncomment for debugging
// echo "✅ Database Connected Successfully!";
?>