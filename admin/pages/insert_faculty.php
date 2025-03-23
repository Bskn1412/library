<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Faculty</title>
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
        h2{
            text-align: center; 
            color:rgb(213, 238, 23);
        }
        .csv{
            margin: auto;
            width: 50%;
            padding: 10px;
            font-weight: bold;
            color: rgb(213, 238, 23);
        }
        .csv h3{
            text-align: center;
        }
        hr {
            margin: 40px 0;
        }
    </style>
</head>

<body>
<h2>Insert Faculty Manually</h2>
    <div class="container">
       
        <form action="../controller/faculty_insertion.php" method="POST">
            <label for="number">Faculty Number:</label>
            <input type="text" id="number" name="number" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" required><br><br>

            <button type="submit" name="submit_manual">Insert Faculty</button>
        </form>
        </div>
        <hr>

        
        <div class="csv">
        <form action="../controller/faculty_insertion.php" method="POST" enctype="multipart/form-data">
        <h3>Upload CSV File</h3>    
        <!-- <label for="csv_file">Select CSV File:</label> -->
            <input type="file" id="csv_file" name="csv_file" required>

            <button type="submit" name="submit_csv">Upload</button>
        </form>

        <div class="message">
            <?php
            if (isset($_GET['message'])) {
                echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
            }
            ?>
        </div>
       
    </div>
</body>

</html>