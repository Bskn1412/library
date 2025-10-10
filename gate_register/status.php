<?php 
include(__DIR__ . '/../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Statistics</title>
  <link rel="stylesheet" href="main.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="datepick.css" type="text/css" media="screen" />
</head>
<body>
  <div id="menu">
    <ul type="none">
      <li><a href="index.php">Home</a></li>
      <li><a href="studentstatus.php">Student Status</a></li>
      <li><a href="facultystatus.php">Faculty Status</a></li>
      <li><a href="datepick.php">Day Wise Details</a></li>
      <li><a href="bdetails.php">Branch Wise Details</a></li>
      <li><a href="status.php">Staticstics</a></li>
      <li><a href="backup.php">BackUp</a></li>
    </ul>
  </div>

  <div id="head">
    <h1>Automatic Library Visitors Counter</h1>
  </div>

  <div class="container">
    <div class="login">
      <div class="form-container">
        <h1>Staticstics</h1>
        <form method="post" class="yo">
          <div class="part">
            <label>From:</label>
            <input type="date" name="fromdate" value="<?php echo $_POST['fromdate'] ?? ''; ?>" required />
            <label>To:</label>
            <input type="date" name="todate" value="<?php echo $_POST['todate'] ?? ''; ?>" required />
          </div>
          <input class="but" type="submit" name="datesubmit" value="Submit" />
        </form>
      </div>
    </div>
  </div>

  <center>
    <h2 class="count"></h2>
    <div class="progress" >
      <div class="chart-container" style="width: 400px; height: 400px; justify-self: center; display: flex; align-items: center;">
        <canvas id="myChart"></canvas>
      </div>
      <div class="chart-container" style="width: 600px; height: 400px;">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </center>

<?php
if (isset($_POST['datesubmit'])) {
  $fromdate = mysqli_real_escape_string($conn, $_POST['fromdate']);
  $todate = mysqli_real_escape_string($conn, $_POST['todate']);

  if (empty($fromdate) || empty($todate)) {
    echo "<script>alert('Please select From and To dates');</script>";
  } else {
    $query = "SELECT count(branch) as count, branch FROM main WHERE date BETWEEN '$fromdate' AND '$todate' GROUP BY branch";
    $result = $conn->query($query);

    $data = [];
    while ($res = $result->fetch_assoc()) {
      $data[] = [
        'branch' => $res['branch'],
        'count' => (int)$res['count']
      ];
    }

    $js_data = json_encode($data);
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
  const data = <?php echo $js_data; ?>;

  if(data.length > 0){
    document.querySelector('.progress').style.display = 'flex';

    const backgroundColors = [
      'rgba(255, 1, 56, 0.9)',
      'rgba(54, 162, 235, 0.9)',
      'rgba(255, 206, 86, 0.9)',
      'rgba(75, 192, 192, 0.9)',
      'rgba(153, 102, 255, 0.9)',
      'rgba(255, 159, 64, 0.9)',
      'rgba(201, 203, 207, 0.9)',
      'rgba(0, 123, 255, 0.9)',
      'rgba(40, 167, 69, 0.9)',
      'rgba(255, 193, 7, 0.9)',
      'rgba(23, 162, 184, 0.9)',
      'rgba(220, 53, 69, 0.9)',
      'rgba(111, 66, 193, 0.9)',
      'rgba(255, 87, 34, 0.9)',
      'rgba(139, 195, 74, 0.9)',
      'rgba(233, 30, 99, 0.9)'
    ];

    const borderColors = [
      'rgba(255, 99, 132)',
      'rgba(54, 162, 235)',
      'rgba(255, 206, 86)',
      'rgba(75, 192, 192)',
      'rgba(153, 102, 255)',
      'rgba(255, 159, 64)',
      'rgba(201, 203, 207)',
      'rgba(0, 123, 255)',
      'rgba(40, 167, 69)',
      'rgba(255, 193, 7)',
      'rgba(23, 162, 184)',
      'rgba(220, 53, 69)',
      'rgba(111, 66, 193)',
      'rgba(255, 87, 34)',
      'rgba(139, 195, 74)',
      'rgba(233, 30, 99)'
    ];

    const doughnutCtx = document.getElementById('myChart').getContext('2d');
    const barCtx = document.getElementById('barChart').getContext('2d');

    // Total count for percentage calculation
    const totalCount = data.reduce((acc, cur) => acc + cur.count, 0);

  // Doughnut Chart with percentage labels
  new Chart(doughnutCtx, {
  type: 'doughnut',
  data: {
    labels: data.map(item => item.branch),
    datasets: [{
      label: 'Branch Wise Count',
      data: data.map(item => item.count),
      backgroundColor: backgroundColors.slice(0, data.length),
      borderColor: borderColors.slice(0, data.length),
      borderWidth: 3
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true,
        position: 'top',
        labels: {
          color: 'rgba(255,255,255,1)',
          font: { weight: 'bold', size: 16 },
          boxWidth: 20,
          padding: 15
        }
      },
      datalabels: {
        color: '#fff',
        font: { weight: 'bold', size: 14 },
        formatter: (value) => {
          const percentage = ((value / totalCount) * 100).toFixed(1);
          return percentage + '%';
        }
      }
    }
  },
  plugins: [ChartDataLabels]
});

    // Bar Chart with count numbers on top
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: data.map(item => item.branch),
        datasets: [{
          label: 'Total Visitors',
          data: data.map(item => item.count),
          backgroundColor: backgroundColors.slice(0, data.length),
          borderColor: borderColors.slice(0, data.length),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Total Visitors', color: 'white', font: { size: 16, weight: 'bold' } },
            ticks: { color: 'rgba(255, 255, 255, 1)', font: { size: 14, weight: 'bold' } }, // y-axis numbers in white
            border: { display: true, color: 'white', width: 2 }
          },
          x: {
            title: { display: true, text: 'Branch', color: 'white', font: { size: 16, weight: 'bold' } },
            ticks: { color: 'rgba(255, 255, 255, 1)', font: { size: 14, weight: 'bold' } }, // x-axis numbers in white
            border: {
              display: true,
              color: 'white',
              width: 2
            }
          }
        },
        plugins: {
          legend: { display: false },
          datalabels: {
            anchor: 'end',   // position relative to the bar
            align: 'center',  // place label just above the bar
            color: 'white',
            font: {
              weight: 'bold',
              size: 12
            },
            formatter: function(value) {
              return value;  // Show count number on top of bars
            }
          }

        }
      },
      plugins: [ChartDataLabels]
    });

    // Total visitors count display
    document.querySelector('.count').textContent = `Total Visitors: ${totalCount}`;
  }
</script>
<?php
  }
}
?>

</body>
</html>
