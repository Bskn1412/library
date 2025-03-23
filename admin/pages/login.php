<?php
session_start();
require_once __DIR__ . '/../../config/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
        header("Location: login.php");
        exit();
    }

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT username, password, page FROM logins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Verify user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_username, $db_password, $page);
        $stmt->fetch();

        // Compare passwords (Use password_verify if passwords are hashed)
        if ($password === $db_password) {
            $_SESSION['username'] = $db_username;

            // Redirect based on the 'page' column value
            header("Location: " . $page . ".php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    $stmt->close();
    $conn->close();

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #3d444db3;
            padding: 20px;
            color: rgb(255, 255, 255);
        }
        .container {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type=text],
        input[type=password]
         {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            background-color:rgb(255, 255, 255);
        }
        button[type=submit] {
            background-color: #238636;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        button[type=submit]:hover {
            background-color: #45a049; 
        }
        h2{
            text-align: center; 
            color:rgb(213, 238, 23);
        }
    </style>
    </head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>