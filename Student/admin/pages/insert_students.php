<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #3d444db3;
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
            margin-top: 20px;
            font-size: 1.2em;
            color: green;
            display: none;
        }

        .error-message {
            color: red;
        }

        /* Navigation Bar Styles */
        .nav-buttons {
            margin-bottom: 30px;
            text-align: center;
        }

        .nav-buttons a {
            text-decoration: none;
            margin: 0 15px;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            display: inline-block;
        }

        .nav-buttons a:hover {
            background-color: #0056b3;
        }

        hr {
            margin: 40px 0;
        }

        h2{
            text-align: center; 
            color:rgb(213, 238, 23);
        }
        .csv{
            align-items: center;
            justify-content: center;
            display: flex;
            font-weight: bold;
            color: rgb(213, 238, 23);
        }

    </style>
</head>

<body>
        <!-- <h2>Student Information Form</h2> -->
        <h2>Manual Student Entry</h2>
        
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

        <hr>
        <div class="csv">
        <form action="../controller/student_insert.php" method="post" enctype="multipart/form-data">
            <h3>Upload CSV File</h3>
            <input type="file" name="csv_file" accept=".csv" required><br>
            <button type="submit" name="submit_csv">Upload CSV</button>
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
            // Fade out after 5 seconds
            setTimeout(function () {
                messageDiv.style.transition = 'opacity 1s';
                messageDiv.style.opacity = '0';
                setTimeout(function () {
                    messageDiv.style.display = 'none';
                }, 1000); // Wait for the transition to complete
            }, 5000);
        }
    </script>
</body>

</html>