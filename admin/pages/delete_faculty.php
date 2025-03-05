<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Faculty</title>
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

        input[type=text] {
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

        .success {
            color: green;
            font-size: 1.2em;
        }

        .error {
            color: red;
            font-size: 1.2em;
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
        <h2>Delete Faculty</h2>

        <!-- Navigation Bar -->
        <div class="nav-buttons">
            <a href="insert_students.php">Student Insertion</a>
            <a href="insert_faculty.php">Faculty Insertion</a>
            <a href="batch_update.php">Batch Update</a>
            <a href="delete_student.php">Student Deletion</a>
            <a href="delete_faculty.php">Faculty Deletion</a>
            <a href="view_students.php">View Students</a>
        </div>

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

        <hr>

        <a href="faculty_deletion.php">Back to Faculty List</a>
    </div>
</body>

</html>