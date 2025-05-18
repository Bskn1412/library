<?php
include(__DIR__ . '/../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Faculty</title>
    <style>
      body {
            font-family: 'Times New Roman', Times, serif;
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
            top: 0;
            right: 0;
            font-size: 1.2em;
            color: green;
            position: absolute;
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

            <label for="title">Title:</label>
            <select name="title" required><br><br>
                <option value="Sir">Sir</option>
                <option value="Madam">Madam</option>
            </select><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" required><br><br>

            <button type="submit" name="submit_manual">Insert Faculty</button>
        </form>
        </div>
 
        <div class="csv">
        <form action="../controller/faculty_insertion.php" method="POST" enctype="multipart/form-data">
        <h3>Upload CSV File</h3>    
        <!-- <label for="csv_file">Select CSV File:</label> -->
            <input type="file" id="csv_file" name="csv_file" required><br><br>
            <button type="submit" name="submit_csv">Upload</button>
        </form>

     <!-- Message displayed after form submission -->
        <div class="message" id="message">
            <?php
            if (isset($_GET['message'])) {
                echo htmlspecialchars($_GET['message']);
            }
            if (isset($_GET['error'])) {
                echo "<span class='error-message'>" . htmlspecialchars($_GET['error']) . "</span>";
            }
            ?>
        </div>
    </div>
    <script>
        // Show message on page load
        const messageDiv = document.getElementById('message');
if (messageDiv.innerHTML.trim() !== '') {
    messageDiv.style.display = 'block';
    
    // Assuming `message` is a variable that contains the message you want to alert
    const message = messageDiv.innerHTML.trim();  // Get the content of the div
    alert(`${message}`);  // Alert the content of the div
    
    // Fade out after 5 seconds
    setTimeout(function () {
        messageDiv.style.transition = 'opacity 1s';
        messageDiv.style.opacity = '0';
        
        setTimeout(function () {
            messageDiv.style.display = 'none'; // Wait for the transition to complete and hide the element
        }, 1000); // Wait for the transition to complete
    }, 5000); // Wait for 5 seconds before starting fade out
}
    </script>
</body>
</html>
