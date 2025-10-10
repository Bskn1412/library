<?php 
include(__DIR__ . '/../dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch-Wise Details</title>
    <link rel="stylesheet" href="main.css" type="text/css" />
    <link rel="stylesheet" href="bdetails.css">
    </head>
<body>

<!-- Navigation Menu -->
<div id="menu">
    <ul type="none">
        <li><a href="index.php">Home</a></li>
        <li><a href="studentstatus.php">Student Status</a></li>
        <li><a href="facultystatus.php">Faculty Status</a></li>
        <li><a href="datepick.php">Day Wise Details</a></li>
        <li><a href="bdetails.php">Branch Wise Details</a></li>
        <li><a href="status.php">Statistics</a></li>
        <li><a href="backup.php">BackUp</a></li>
    </ul>
</div>

<!-- Header -->
<div id="head">
        <h1>Automatic Library Visitors Counter</h1>
</div>

<center>

<!-- Form -->
<div class="container">
<div class="login">
<form name="branchwisedetails" method="post" action="bdetails.php">
    <h1>Branch Wise Details</h1>

    <div id="mainselection">
        <strong>Branch </strong>
        <select name="ugdrop" id="ugdrop">
            <option value="0">Select</option>
            <?php
            $query = $conn->query("SELECT UPPER(`ug`) FROM `branches`");
            while ($res = $query->fetch_assoc()) {
               if (!empty($res['UPPER(`ug`)']) && $res['UPPER(`pg`)'] != "--") {
                echo '<option value="' . strtolower($res['UPPER(`ug`)']) . '">' . $res['UPPER(`ug`)'] . '</option>';
               }
            }

            $query = $conn->query("SELECT UPPER(`pg`) FROM `branches`");
            while ($res = $query->fetch_assoc()) {
                if (!empty($res['UPPER(`pg`)'] && $res['UPPER(`pg`)'] != "--")) {
                    echo '<option value="' . strtolower($res['UPPER(`pg`)']) . '">' . $res['UPPER(`pg`)'] . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <br>

    <div id="mainselection">
        <strong>Year</strong>
        <select name="yeardrop" id="yeardrop">
            <option value="0">Select</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
    </div>

    <br>

    <input type="submit" name="ug" id="ug" class="but" value="Submit">
</form>
</div>
</div>

<br>

<?php
if (isset($_POST['ug'])) {
    $branch = mysqli_real_escape_string($conn, $_POST['ugdrop']);
    $year = mysqli_real_escape_string($conn, $_POST['yeardrop']);

    if ($branch == "0" && $year == "0") {
        echo '<script>alert("Please Select Year or Branch");</script>';
    } else {
        $query = "";
        if ($year == "0") {
            $query = "SELECT * FROM `main` WHERE `branch` LIKE '$branch%' ORDER BY `date` DESC";
        } elseif ($branch == "0") {
            $query = "SELECT * FROM `main` WHERE `year` LIKE '$year' ORDER BY `date` DESC";
        } else {
            $query = "SELECT * FROM `main` WHERE `branch` LIKE '$branch%' AND `year` LIKE '$year' ORDER BY `date` DESC";
        }

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
?>
            <table class="contain-table">
                <thead>
                <tr>
                    <th>Sno</th>
                    <th>Date</th>
                    <th>Roll no</th>
                    <th>Name</th>
                    <th width="50">Branch</th>
                    <th width="50">Year</th>
                    <th>InTime</th>
                    <th>OutTime</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while ($res = $result->fetch_assoc()) {
                    if ($res['year'] != 0) {
                ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $res['date']; ?></td>
                            <td><?php echo $res['rollnum']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo strtoupper($res['branch']); ?></td>
                            <td><?php echo $res['year']; ?></td>
                            <td><?php echo $res['intime']; ?></td>
                            <td><?php echo ($res['outtime'] != "00:00:00") ? $res['outtime'] : "Still in Library"; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
             </tbody>
            </table>
<?php
        } else {
            echo "<p>No records found.</p>";
        }
    }
}
?>
</center>
</body>
</html>
