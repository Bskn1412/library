<?php
include(__DIR__ . '/../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            color: rgb(255, 255, 255);
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
        .file-input {
        width: 400px;  
        font-size: 16px; 
        font-family: 'Times New Roman', Times, serif;
    }
        .container{
            margin: auto;
            width: 50%;
            padding: 10px;
        }

    </style>
</head>

<body>
        <!-- <h2>Student Information Form</h2> -->
        <h2>Manual Student Entry</h2>
        <div class="container">  
        <form action="../controller/student_insert.php" method="post">
            <label for="roll">Roll Number :</label>
            <input type="text" name="roll" required><br><br>

            <label for="name">Name :</label>
            <input type="text" name="name" required><br><br>

            <label for="year">Year :</label>
            <select name="year" required>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select><br><br>

            <label for="branch">Branch :</label>
            <select name="branch" required>
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="ECE">ECE</option>
                <option value="CIVIL">CIVIL</option>
                <option value="MECH">MECH</option>
                <option value="IT">IT</option>
                <option value="IOT">IOT</option>
                <option value="AIDS">AIDS</option>
                <option value="AIML">AIML</option>
            </select><br>
            <button type="submit" name="submit_manual">Submit Manually</button>
        </form>
        </div>
       
        <div class="csv">
        <form action="../controller/student_insert.php" method="post" enctype="multipart/form-data">
            <h3>Upload CSV File</h3>
            <input type="file" name="csv_file" accept=".csv" class="file-input" required><br>
            <button type="submit" name="submit_csv">Upload</button>
        </form>
        </div>
        
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