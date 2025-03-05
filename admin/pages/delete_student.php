<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
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

        h2,
        h3 {
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
        select {
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
        }

        .error {
            color: red;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

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

        <h2>Delete Student</h2>

        <!-- Display messages -->
        <?php
        if (isset($_GET['message'])) {
            echo "<p class='success'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <!-- Form to delete by Roll Number -->
        <form action="../controller/student_deletion.php" method="POST">
            <h3>Delete by Roll Number</h3>
            <label for="roll">Enter Roll Number:</label>
            <input type="text" id="roll" name="roll" required>
            <button type="submit" name="delete_roll"
                onclick="return confirm('Are you sure you want to delete this student?');">Delete Student</button>
        </form>

        <hr>

        <!-- Form to delete all students by Year -->
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

        <a href="students.php">Back to Student List</a>
    </div>
</body>

</html>