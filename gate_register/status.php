<?php 
include(__DIR__ . '/../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day-Wise Details</title>
    <link rel="stylesheet" href="main.css" type="text/css" media="screen">
    <link rel="stylesheet" href="datepick.css" type="text/css" media="screen">
  </head>
<body>
    <div id="menu">
        <ul type="none">
            <li><a href="index.php">Home</a></li>
            <li><a href="studentstatus.php">Student Status</a></li>
            <li><a href="facultystatus.php">Faculty Status</a></li>
            <li><a href="datepick.php">Day Wise Details</a></li>
            <li><a href="bdetails.php">Branch Wise Details</a></li>
            <li><a href="status.php">Stats</a></li>
        </ul>
    </div>
    
    <div id="head">
            <h1>Automatic Library Visitors Counter</h1>
    </div>

    
    <div class="container">
        <div class="login">
            <div class="form-container">
                <h1>Stats.</h1>
                <form method="post" class="yo">
                    <div class="part">
                        <label>From:</label>
                        <input type="date" name="fromdate" value="<?php echo $_POST['fromdate'] ?? ''; ?>" required>
                        <label>To:</label>
                        <input type="date" name="todate" value="<?php echo $_POST['todate'] ?? ''; ?>" required>
                    </div>
                    <input class="but" type="submit" name="datesubmit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <center>
    
    <div class="progress">
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
        <h2 class="count"></h2>
    </div>
    </center>

    
    <?php
    if (isset($_POST['datesubmit'])) {
        $fromdate = mysqli_real_escape_string($conn, $_POST['fromdate']);
        $todate = mysqli_real_escape_string($conn, $_POST['todate']);;

        $data = array();

        if (empty($fromdate) || empty($todate)) {
            echo "<script>alert('Please select From and To dates');</script>";
        } else {
            
            $query = "SELECT count(branch) as count,branch FROM main WHERE date BETWEEN '$fromdate' AND '$todate' group by branch";

            $result = $conn->query($query);
            while ($res = $result->fetch_assoc()) {
                $data[] = array(
                    'branch' => $res['branch'],
                    'count' => $res['count']
                );
            }

            $js_dict = json_encode($data);
            // file_put_contents('data.json', $jsonData);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Use the PHP data in JavaScript
        let data = <?php echo $js_dict; ?>;

        if(data.length > 0){

            const progress = document.querySelector('.progress')
            progress.style.display = 'flex';
    
            const chartData = {
                labels : ['python','java'],
                data : [30,20]
            }
    
            const myChar = document.getElementById('myChart');
    
            new Chart(myChar,{
                type:'doughnut',
                data: {
                  labels: data.map(item => item.branch),
                // labels: chartData.labels,
                  datasets: [{
                    label: 'Branch Wise Count',
                    data: data.map(item => item.count),
                    // data : chartData.data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132)',
                        'rgba(54,162,235)',
                        'rgba(255,206,86)',
                        'rgba(75,192,192)',
                        'rgba(153,102,255)',
                        'rgba(255,159,64)'
                    ],
                    borderWidth: 1
                  }]
                },
                options:{
                    borderRadius:2,
                    hoverBorderWidth:3,
                    plugins:{
                        legend:{
                            display:true
                        }
    
                    }
                }
            })
        }

        let tot=0;

        data.forEach(element => {
            tot += Number(element.count)
        });

        document.querySelector('.count').innerHTML = "Total Vistis : " + tot
    </script>
    <?php
        }
    }
    ?>
</body>
</html>