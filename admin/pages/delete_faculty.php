<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Faculty</title>
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

        h2,
        h3 {
            margin-bottom: 20px;
            
            color:rgb(228, 219, 51);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type=text],
        select {
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
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            
        }

        button[type=submit]:hover {
            background-color: #45a049;
          
        }

        .message {
            margin-top: 20px;
            font-size: 1.2em;
            color: green;
            display: none;
        }

        .error-message {
            color: red;
        }
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color:rgb(37, 193, 210);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 40px 0;
        }

        h2{
            text-align: center; 
            color:rgb(213, 238, 23);
        }
       
     
    </style>
</head>

<body>
<h2>Delete Faculty</h2>
    <div class="container">
        <!-- Display messages -->
        <?php
        if (isset($_GET['message'])) {
            echo "<p class='success'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <!-- Form to delete faculty by Number -->
        <form action="../controller/faculty_deletion.php" method="POST">
            <h3>Delete by Faculty Number</h3>
            <label for="faculty_num">Enter Faculty Number:</label>
            <input type="text" id="faculty_num" name="faculty_num" required>
            <button type="submit" name="delete_faculty"
                onclick="return confirm('Are you sure you want to delete this faculty member?');">
                Delete Faculty
            </button>
        </form>
        </div>
        <hr>

        <a href="faculty_deletion.php">Back to Faculty List</a>
</body>

</html>