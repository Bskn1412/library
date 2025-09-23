<?php
session_start();
include(__DIR__ . '/../../dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement to safely query user info
    $query = "SELECT * FROM logins WHERE username=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Regenerate session ID for security
        session_regenerate_id(true);
        $_SESSION['username'] = $row['username'];
        $_SESSION['page'] = $row['page'];

        // Redirect based on role
        if ($row['page'] === "adminpage") {
            header("Location: ../pages/index.php");
        } elseif ($row['page'] === "viewpage") {
            header("Location: ../../lib/index.php");
        } else {
            // Unknown page value — safety fallback
            $_SESSION['error'] = "Unauthorized access!";
            header("Location: ../login.php");

        }


       // file_put_contents("debug.log", "Logged in as: " . $row['username']);

        
        exit();
    } else {
        // Invalid credentials
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: ../login.php");
        exit();
    }
}
?>