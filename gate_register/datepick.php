<?php 
include("include/dbconn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day-Wise Details</title>
    <link rel="stylesheet" href="default.css" type="text/css" media="screen">
    <link rel="stylesheet" href="datepick.css" type="text/css" media="screen">
  </head>
<body>
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
        <div class="form-container">
            <h1>Day Wise Details</h1>
            <form method="post" class="yo">
                <label>From:</label>
                <input type="date" name="fromdate" value="<?php echo $_POST['fromdate'] ?? ''; ?>" required>
                <label>To:</label>
                <input type="date" name="todate" value="<?php echo $_POST['todate'] ?? ''; ?>" required>
                
                <label>Branch:</label>
                <select name="ugbranch">
                    <option value="0">Select</option>
                    <?php
                    $query = $conn->query("SELECT UPPER(ug) AS branch FROM branches UNION SELECT UPPER(pg) FROM branches");
                    while ($res = $query->fetch_assoc()) {
                        if (!empty($res['branch'])) {
                            echo "<option value='" . strtolower($res['branch']) . "'>" . $res['branch'] . "</option>";
                        }
                    }
                    ?>
                </select>
                
                <label>Year:</label>
                <select name="ugyear">
                    <option value="0">Select</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                
                <input class="but" type="submit" name="datesubmit" value="Submit">
            </form>
        </div>
    </div>
    
    <?php
    if (isset($_POST['datesubmit'])) {
        $fromdate = mysqli_real_escape_string($conn, $_POST['fromdate']);
        $todate = mysqli_real_escape_string($conn, $_POST['todate']);
        $branch = mysqli_real_escape_string($conn, $_POST['ugbranch']);
        $year = mysqli_real_escape_string($conn, $_POST['ugyear']);

        if (empty($fromdate) || empty($todate)) {
            echo "<script>alert('Please select From and To dates');</script>";
        } else {
            echo "<center><table border='2' class='myTable'>
                    <tr>
                        <th>Sno</th>
                        <th>Date</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Year</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                    </tr>";
            
            $query = "SELECT * FROM main WHERE date BETWEEN '$fromdate' AND '$todate'";
            if ($branch !== '0') {
                $query .= " AND branch LIKE '$branch%'";
            }
            if ($year !== '0') {
                $query .= " AND year = '$year'";
            }

            $result = $conn->query($query);
            $sno = 1;
            while ($res = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$sno}</td>
                        <td>{$res['date']}</td>
                        <td>{$res['rollnum']}</td>
                        <td>{$res['name']}</td>
                        <td>" . strtoupper($res['branch']) . "</td>
                        <td>{$res['year']}</td>
                        <td>{$res['intime']}</td>
                        <td>" . ($res['outtime'] != "00:00:00" ? $res['outtime'] : "Still in Library") . "</td>
                    </tr>";
                $sno++;
            }
            echo "</table></center>";
        }
    }
    ?>
</body>
</html>