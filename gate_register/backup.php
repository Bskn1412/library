<?php
include(__DIR__ . '/../dbconn.php');

// ✅ EXPORT LOGIC
if (isset($_POST['export'])) {
    $export_type = $_POST['export_type'];

    // Determine query and file name
    if ($export_type === 'range') {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        if (empty($from_date) || empty($to_date)) {
            echo "<script>alert('⚠️ Please select both From and To dates.'); window.location='backup.php';</script>";
            exit;
        }

        $filename = "backup_" . $from_date . "_to_" . $to_date . ".csv";

        // Prepare the query for date range
        $query = $conn->prepare("SELECT date, name, branch, year, rollnum, intime, outtime 
                                 FROM main 
                                 WHERE date BETWEEN ? AND ? 
                                 ORDER BY date DESC");
        $query->bind_param("ss", $from_date, $to_date);
        $query->execute();
        $result = $query->get_result();
    } else {
        // Full export
        $filename = "backup_full_" . date('Y-m-d_H-i-s') . ".csv";
        $result = $conn->query("SELECT date, name, branch, year, rollnum, intime, outtime FROM main ORDER BY date DESC");
    }

    // Output headers
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen('php://output', 'w');

    // Header row
    fputcsv($output, ['Date', 'Name', 'Branch', 'Year', 'Roll Number', 'In Time', 'Out Time']);

    // Write data rows
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}


// ✅ IMPORT LOGIC
if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0) {
        $file = fopen($fileName, 'r');
        fgetcsv($file); // skip header
        $added = 0;
        $skipped = 0;

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            $date = mysqli_real_escape_string($conn, $data[0]);
            $name = mysqli_real_escape_string($conn, $data[1]);
            $branch = mysqli_real_escape_string($conn, $data[2]);
            $year = (int)$data[3];
            $rollnum = mysqli_real_escape_string($conn, $data[4]);
            $intime = mysqli_real_escape_string($conn, $data[5]);
            $outtime = mysqli_real_escape_string($conn, $data[6]);

            // Check duplicates (date + rollnum + intime)
            $check = $conn->query("SELECT * FROM main WHERE date='$date' AND rollnum='$rollnum' AND intime='$intime'");
            if ($check->num_rows > 0) {
                $skipped++;
                continue;
            }

            $insert = "INSERT INTO main (date, name, branch, year, rollnum, intime, outtime)
                       VALUES ('$date', '$name', '$branch', '$year', '$rollnum', '$intime', '$outtime')";
            if ($conn->query($insert)) {
                $added++;
            }
        }

        fclose($file);
        echo "<script>alert('✅ Import completed! Added: $added | Skipped: $skipped'); window.location='backup.php';</script>";
        exit;
    } else {
        echo "<script>alert('Please upload a valid CSV file.'); window.location='backup.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Backup & Restore</title>
<link href="main.css" rel="stylesheet" type="text/css" media="screen" />
<style>
  .container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 40px;
    padding: 10px;
    width: 90%;
  }

  .container h1 {
    width: 100%;
    text-align: center;
    color: #39cccc;
    margin-bottom: 20px;
  }

  form {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 15px;
    padding: 30px 40px;
    width: 300px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
    transition: 0.3s;
  }

  form:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 20px rgba(230, 227, 231, 0.5);
  }

  .export input, p{
    margin: 20px 0;
  }
  .import p{
    margin: 40px 0;
  }
  h2 {
    color: #ffdc00;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  input[type="file"] {
    color: #fff;
    background: transparent;
    border: 1px dashed #aaa;
    padding: 8px;
    width: 100%;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
  }

  button {
    width: 100%;
    background: #f0edf0ff;
    border: none;
    color: #000;
    font-weight: bold;
    padding: 10px 0;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background: #63286dff;
  }

  .back {
    position: absolute;
    bottom: 0;
    color: #f5f5f5ff;
    text-decoration: none;
    border: 1px solid #555;
    padding: 10px 20px;
    border-radius: 8px;
    transition: 0.3s;
    width: fit-content;
  }

  .back:hover {
    background: #864a95ff;
    color: #000;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
      align-items: center;
    }
    form {
      width: 80%;
    }
  }
</style>
</head>
<body>
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

<div id="head">
        <h1>Automatic Library Visitors Counter</h1>
</div>

  <div class="container">
  <h1>📦 Data Backup & Restore</h1>
  
<!-- Export Section -->
    <form class="export" method="POST">
    <h2>⬇️ Export Data</h2>
    <p>Select Option :</p>

    <label style="color:#fff;">
        <input type="radio" name="export_type" value="full" checked> Export All Data
    </label><br>
    <label style="color:#fff;">
        <input type="radio" name="export_type" value="range"> Export by Date Range
    </label>

    <div id="date-range-fields" style="margin-top:15px; display:none;">
        <label for="from_date" style="color:#fff;">From:</label>
        <input type="date" name="from_date" style="width:100%; padding:8px; margin-bottom:10px; border-radius:5px;">

        <label for="to_date" style="color:#fff;">To:</label>
        <input type="date" name="to_date" style="width:100%; padding:8px; margin-bottom:20px; border-radius:5px;">
    </div>

    <button type="submit" name="export">Export CSV</button>
    </form>



    <!-- Import Section / We skip same if roll, date, intime -->
    <form class="import" method="POST" enctype="multipart/form-data">
      <h2>⬆️ Import Data</h2>
      <p>Upload a previously exported CSV file.</p>
      <input type="file" name="file" accept=".csv" required>
      <button type="submit" name="import">Import CSV</button>
    </form>

  </div>

  <a href="index.php" class="back">← Back to Home</a>

<script>
    const exportRadios = document.querySelectorAll('input[name="export_type"]');
    const dateRangeFields = document.getElementById('date-range-fields');

    exportRadios.forEach(radio => {
        radio.addEventListener('change', () => {
        dateRangeFields.style.display = (radio.value === 'range') ? 'block' : 'none';
        });
    });
</script>

</body>
</html>
