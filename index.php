<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            padding: 15px 25px;
            display: inline-block;
            margin: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }

        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Your Project</h1>
        <p>Please choose an option:</p>
        <!-- Route to Admin (Requires login) -->
        <a href="admin/pages/login.php">Admin</a>

        <!-- Route to Libb (Requires login) -->
        <a href="libb/login.php">Libb</a>

        <!-- Route to View (Does not require login) -->
        <a href="gate_register/today_stats.php">View Statistics</a>
    </div>
</body>

</html>