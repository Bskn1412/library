<?php
include(__DIR__ . '/../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['promote_roll'])) {
        // Promote a student by Roll Number
        $roll = $_POST['roll'];
        $query = "UPDATE student SET year = year + 1 WHERE rollnum = ? AND year < 4"; // Prevents exceeding 4th year
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "Student with Roll Number $roll promoted successfully!";
        } else {
            $message = "Failed to promote. Student may already be in the final year.";
        }
        $stmt->close();
    } elseif (isset($_POST['demote_roll'])) {
        // Demote a student by Roll Number
        $roll = $_POST['roll'];
        $query = "UPDATE student SET year = year - 1 WHERE rollnum = ? AND year > 1"; // Prevents going below 1st year
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "Student with Roll Number $roll demoted successfully!";
        } else {
            $message = "Failed to demote. Student may already be in the 1st year.";
        }
        $stmt->close();
    } elseif (isset($_POST['promote_batch'])) {
        // Promote all students in a batch
        $batch = $_POST['batch'];
        $query = "UPDATE student SET year = year + 1 WHERE batch = ? AND year < 4";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $batch);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "All students from Batch $batch promoted successfully!";
        } else {
            $message = "Failed to promote. Students may already be in the final year.";
        }
        $stmt->close();
    } elseif (isset($_POST['demote_batch'])) {
        // Demote all students in a batch
        $batch = $_POST['batch'];
        $query = "UPDATE student SET year = year - 1 WHERE batch = ? AND year > 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $batch);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "All students from Batch $batch demoted successfully!";
        } else {
            $message = "Failed to demote. Students may already be in the 1st year.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promote/Demote Students</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            color: rgb(255, 255, 255);
        }

        .container {
            max-width: 800px;
            padding: 30px;
            border-radius: 10px;
            margin: auto;
            width: 50%;
            padding: 10px;
        }

       
        h2{
            margin-bottom: 20px;
            color:rgb(213, 238, 23);
            text-align: center;
        }
        h1,h3{
            margin-bottom: 20px;
            color:rgb(213, 238, 23);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(255, 255, 255);
        }

        input[type=text],
        input[type=number] {
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
            margin-right: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }
        .status {
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
    </style>
</head>

<body>
    <div class="container">
        <h2>Promote / Demote Students</h2>
        <?php if (!empty($message)): ?>
            <p class="status"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Promote / Demote by Roll Number -->
        <form action="" method="POST">
            <h3>By Roll Number</h3>
            <label for="roll">Enter Roll Number:</label>
            <input type="text" name="roll" id="roll" required>
            <button type="submit" name="promote_roll">Promote</button>
            <button type="submit" name="demote_roll">Demote</button>
        </form>
        
        <!-- Promote / Demote by Batch -->
        <form action="" method="POST">
            <h3>By Batch</h3>
            <label for="batch">Enter Batch Number:</label>
            <input type="number" name="batch" id="batch" required>
            <button type="submit" name="promote_batch">Promote</button>
            <button type="submit" name="demote_batch">Demote</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>