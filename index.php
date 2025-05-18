<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Home</title>
   <style>
    body {
        margin: 0;
        padding: 0;
        background-image: url('library.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        color: white;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px 40px;
        border-radius: 10px;
        text-align: center;
        background: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
        backdrop-filter: blur(1px); /* Initial blur */
        box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.2);
        gap: 20px;
        color: rgb(0, 0, 0);
        transition: 0.5s ease;
    }

    .container:hover {
        backdrop-filter: blur(8px); /* Increase blur on hover */
        transform: translate(-50%, -50%) scale(1.03); /* Subtle zoom */
    }

    .container h1 {
        margin: 0;
    }

    .container a {
        display: block;
        width: 200px;
        padding: 10px;
        background:rgb(17, 179, 49);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .container a:hover {
         background:rgb(49, 210, 79);
    }
    .container h1:hover{
        color: white;
    }
    .container p:hover{
        color: white;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>WELCOME TO LIBRARY</h1>
        <p>Please choose an option:</p>
        <!-- Route to Admin (Requires login) -->
        <a href="admin/login.php">Admin</a>

        <!-- Route to View (Does not require login) -->
        <a href="gate_register/index.php">Gate Register</a>

        <!-- Route to Scanner page (No need of Login) -->
        <a href="scanner_page/index.php">Scanner </a>
    </div>
</body>
</html>