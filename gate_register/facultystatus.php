<?php 
include(__DIR__ . '/../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Status</title>
    <link href="main.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="facul.css">
</head>
<body>

<?php
if (isset($_POST['statussubmit'])) {
    $roll = mysqli_real_escape_string($conn, $_POST['facno']);
    
    $query1 = $conn->query("SELECT * FROM `staff` WHERE `rollnum` = '$roll'");
    $query  = $conn->query("SELECT * FROM `main` WHERE `rollnum` = '$roll' ORDER BY `date` DESC");
    
    $count  = $query->num_rows;
    $res1   = $query1->fetch_assoc();
}
?>

<div id="menu">
    <ul type="none">
        <li><a href="index.php">Home</a></li>
        <li><a href="studentstatus.php">Student Status</a></li>
        <li><a href="facultystatus.php">Faculty Status</a></li>
        <li><a href="datepick.php">Day Wise Details</a></li>
        <li><a href="bdetails.php">Branch Wise Details</a></li>

        <li><a href="status.php">Stats</a></li>

        <li><a href="status.php">Statistics</a></li>

        <li><a href="status.php">Statistics</a></li>

    </ul>
</div>

<div id="head">
        <h1>Automatic Library Visitors Counter</h1>
</div>

<div class="container">
    <div class="login">
        <h1>Faculty Status</h1>
        <form method="post" action="">
            <input type="text" name="facno" placeholder="Faculty No" required>
            <input type="submit" class="but" name="statussubmit" value="Submit">
        </form>
        
        <div class="details">
        <?php if (isset($_POST['statussubmit'])): ?>
            <p><strong>Name:</strong> <p id="sam"><?php echo htmlspecialchars($res1['name'] ?? 'N/A'); ?></p></p>
            <p><strong>Branch:</strong><p id="sam"> <?php echo strtoupper(htmlspecialchars($res1['branch'] ?? 'N/A')); ?></p></p>
            <p><strong>Total Visits:</strong> <p id="sam"><?php echo $count; ?></p></p>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php if (isset($_POST['statussubmit']) && $count > 0): ?>
    <center>
        <table class="contain-table">
            <thead>
            <tr>
                <th>Sno</th>
                <th>Date</th>
                <th>InTime</th>
                <th>OutTime</th>
            </tr>
            </thead>
            <tbody>            
            <?php $i = 1; while ($res = $query->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($res['date']); ?></td>
                    <td><?php echo htmlspecialchars($res['intime']); ?></td>
                    <td><?php echo $res['outtime'] !== "00:00:00" ? htmlspecialchars($res['outtime']) : "Still in Library"; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </center>
<?php endif; ?>

</body>
</html>
