<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #0d1117;
            color: #c9d1d9;
            text-align: center;
            margin-top: 100px;
        }
        .container {
            width: 450px;
            margin: auto;
            height: 300px;
            padding: 20px;
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
            font-family: 'Times New Roman', Times, serif;
        }
        input {
            width: 400px;
            padding: 10px;
            margin: 15px 15px 15px;
            background: #0d1117;
            border: 1px solid #30363d;
            color: #c9d1d9;
            border-radius: 5px;
            font-family: 'Times New Roman', Times, serif;
            
        }
        button {
            font-family: 'Times New Roman', Times, serif;
            margin-top: 15px;
            width: 400px;
            padding: 10px;
            background: #238636;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background: #2ea043;
        }
        .error {
            color: #ff7b72;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error) {
            echo "<p class='error'>$error</p>";
        } ?>
        <form action="config/auth.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <script type="text/javascript">
        if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, './');
            window.onpopstate = function() {
                window.history.forward();
            };
       }
     </script>
</body>
</html>