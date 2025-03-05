<?php 
include("include/dbconn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Status</title>
    <link href="default.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="student.css">
</head>
<body>

<?php
$student_data = $visit_data = [];
$count = 0;

if(isset($_POST['statussubmit'])) {
    $roll = mysqli_real_escape_string($conn, $_POST['roll']);

    // Fetch student details
    $stmt1 = $conn->prepare("SELECT * FROM `student` WHERE `rollnum` = ?");
    $stmt1->bind_param("s", $roll);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $student_data = $result1->fetch_assoc();
    $stmt1->close();

    // Fetch student visit details
    $stmt2 = $conn->prepare("SELECT * FROM `main` WHERE `rollnum` = ? ORDER BY `date` DESC");
    $stmt2->bind_param("s", $roll);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $count = $result2->num_rows;
    $visit_data = $result2->fetch_all(MYSQLI_ASSOC);
    $stmt2->close();
}
?>

<div id="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="studentstatus.php">Student Status</a></li>
        <li><a href="facultystatus.php">Faculty Status</a></li>
        <li><a href="datepick.php">Day Wise Details</a></li>
        <li><a href="bdetails.php">Branch Wise Details</a></li>
    </ul>
</div>

<div id="header">
    <div id="logo">
        <h1>Automatic Library Visitors Counter</h1>
    </div>
</div>

<div class="container">
    <div class="login">
        <h1>Student Status</h1>
        <form method="post" action="">
            <p><input type="text" name="roll" placeholder="Student Roll No" required></p>    
            <p class="submit"><input type="submit" name="statussubmit" value="Submit"></p>

            <?php if (!empty($student_data)): ?>
                <p>Name:</p><div id="sam"><?= htmlspecialchars($student_data['name'] ?? 'N/A') ?></div>
                <p>Year:</p><div id="sam"><?= htmlspecialchars($student_data['year'] ?? 'N/A') ?></div>
                <p>Branch:</p><div id="sam"><?= strtoupper(htmlspecialchars($student_data['branch'] ?? 'N/A')) ?></div>
                <p>Total Visits:</p><div id="sam"><?= $count ?></div>
            <?php endif; ?>

            <?php if (empty($student_data)) :?>
              <p>Not Found</p>
            <?php endif; ?>

        </form>
    </div>
</div>

<?php if (!empty($visit_data)): ?>
    <center>
        <table border="2" class="myTable">
            <tr>
                <th>Sno</th>
                <th>Roll No</th>
                <th>Date</th>
                <th>In Time</th>
                <th>Out Time</th>
            </tr>
            <?php foreach ($visit_data as $index => $visit): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($visit['rollnum']) ?></td>
                    <td><?= htmlspecialchars($visit['date']) ?></td>
                    <td><?= htmlspecialchars($visit['intime']) ?></td>
                    <td><?= ($visit['outtime'] != "00:00:00") ? htmlspecialchars($visit['outtime']) : "Still in Library" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </center>
<?php endif; ?>

</body>
</html>
