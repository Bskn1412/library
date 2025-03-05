<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Faculty</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 1.6em;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type=text],
        input[type=file] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button[type=submit] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button[type=submit]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            font-size: 1.2em;
            color: green;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="nav-buttons">
            <!-- Navigation Buttons -->
            <a href="insert_students.php">Student Insertion</a>
            <a href="insert_faculty.php">Faculty Insertion</a>
            <a href="batch_update.php">Batch Update</a>
            <a href="delete_student.php">Student Deletion</a>
            <a href="delete_faculty.php">Faculty Deletion</a>
            <a href="view_students.php">View Students</a>
        </div>

        <h2>Insert Faculty Manually</h2>
        <form action="../controller/faculty_insertion.php" method="POST">
            <label for="number">Faculty Number:</label>
            <input type="text" id="number" name="number" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" required>

            <button type="submit" name="submit_manual">Insert Faculty</button>
        </form>

        <hr>

        <h2>Upload Faculty Data (CSV)</h2>
        <form action="../controller/faculty_insertion.php" method="POST" enctype="multipart/form-data">
            <label for="csv_file">Select CSV File:</label>
            <input type="file" id="csv_file" name="csv_file" required>

            <button type="submit" name="submit_csv">Upload CSV</button>
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