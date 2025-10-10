<?php
include(__DIR__ . '/../dbconn.php'); // adjust if your dbconn.php path differs

if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];

    if ($_FILES['file']['size'] > 0) {
        $file = fopen($fileName, 'r');
        $rowCount = 0;
        $skipped = 0;

        // Skip header row
        fgetcsv($file);

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            // CSV Columns: date, name, branch, year, rollnum, intime, outtime
            $date = mysqli_real_escape_string($conn, $data[0]);
            $name = mysqli_real_escape_string($conn, $data[1]);
            $branch = mysqli_real_escape_string($conn, $data[2]);
            $year = (int)$data[3];
            $rollnum = mysqli_real_escape_string($conn, $data[4]);
            $intime = mysqli_real_escape_string($conn, $data[5]);
            $outtime = mysqli_real_escape_string($conn, $data[6]);

            // Prevent duplicate: same date + rollnum + intime
            $check = $conn->query("SELECT * FROM main WHERE date='$date' AND rollnum='$rollnum' AND intime='$intime'");
            if ($check->num_rows > 0) {
                $skipped++;
                continue;
            }

            $insert = "INSERT INTO main (date, name, branch, year, rollnum, intime, outtime)
                       VALUES ('$date', '$name', '$branch', '$year', '$rollnum', '$intime', '$outtime')";
            if ($conn->query($insert)) {
                $rowCount++;
            }
        }

        fclose($file);

        echo "<script>
                alert('✅ Import completed! Added: $rowCount | Skipped (duplicates): $skipped');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>alert('Please upload a valid CSV file!'); window.history.back();</script>";
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Import Data</title>
  <style>
    body {
      background-color: #000;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 60px;
    }
    form {
      background: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 10px;
      display: inline-block;
      box-shadow: 0 0 15px rgba(255,255,255,0.2);
    }
    input[type="file"] {
      margin-bottom: 15px;
    }
    input[type="submit"] {
      padding: 10px 20px;
      border: none;
      background: #39cccc;
      color: black;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    input[type="submit"]:hover {
      background: #00aced;
    }
  </style>
</head>
<body>
  <h2>📤 Import Backup Data (CSV)</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv" required><br>
    <input type="submit" name="import" value="Import CSV">
  </form>
</body>
</html>
<?php } ?>
