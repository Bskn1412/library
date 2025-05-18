<?php
include(__DIR__ . '/../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
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
        h2,
        h3 {
            margin-bottom: 20px;
            /* font-size: 1.6em; */
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
            top: 0;
            right: 0;
            font-size: 1.2em;
            color: green;
            display: none;
            position: absolute;
        }

        .error-message {
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
        .csv label{
            color: rgb(255, 255, 255);
        } 
    </style>
</head>
<body>
    
<h2>Delete Student</h2>
    <div class="container">

        <!-- Form to delete by Roll Number -->
        <form action="../controller/student_deletion.php" method="POST">
            <h3>Delete by Roll Number</h3>
            <label for="roll">Enter Roll Number:</label>
            <input type="text" id="roll" name="roll" required>
            <button type="submit" name="delete_roll"
                onclick="return confirm('Are you sure you want to delete this student?');">Delete Student</button>
        </form>
        </div>
        <!-- Form to delete all students by Year -->
         <div class="csv"> 
        <form action="../controller/student_deletion.php" method="POST">
            <h3>Delete by Year</h3>
            <label for="year">Select Year:</label>
            <select id="year" name="year" required>
                <option value="" disabled selected>Select Year</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
            <button type="submit" name="delete_year"
                onclick="return confirm('Are you sure you want to delete all students from this year?');">Delete
                All</button>
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

        <a href="students.php">Back to Student List</a>
    </div>
</body>

</html>