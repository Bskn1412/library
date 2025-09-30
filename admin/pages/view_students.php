<?php
include(__DIR__ . '/../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');

$students = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $id = 1;

    // Fetch students based on the selected year
    $query = "SELECT rollnum, name, year, branch, batch FROM student WHERE year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $message = "No students found for the selected year.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students by Year</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            color: rgb(0, 0, 0);
        }

        .container{
            margin: auto;
            width: 50%;
            padding: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.6em;
            color:rgb(213, 238, 23);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(255, 255, 255);
        }

        select,
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button[type=submit] {
            background-color: #238636;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 1.2em;
            margin-top: 10px;
        }
        .error-message {
            color: red;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: solid 2px orange;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
           background-color: rgb(255, 165, 0,0.7);
           color: white;
        }

        table td {
            background-color: #f9f9f9;
        }
        hr {
            margin: 40px 0;
        }
        .container a{
            color:rgb(37, 193, 210);
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>View Students by Year</h2>
        <!-- Form to select year -->
        <form action="" method="POST">
            <label for="year">Select Year:</label>
            <select name="year" id="year" required>
                <option value="">--Select Year--</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
            <button type="submit">View Students</button>
        </form>

        <?php if (!empty($message)): ?>
            <p class="error"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Display student list -->
        <?php if (!empty($students)): ?>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Branch</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($id++); ?></td>
                            <td><?php echo htmlspecialchars($student['rollnum']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['year']); ?></td>
                            <td><?php echo htmlspecialchars($student['branch']); ?></td>
                            <td><?php echo htmlspecialchars($student['batch']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
       
    </div>
</body>
</html>






