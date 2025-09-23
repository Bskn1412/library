<?php
include(__DIR__ . '/../../dbconn.php');

function calculate_batch($roll_number)
{
    $batch_code = intval(substr($roll_number, 2, 3));
    return ($batch_code === 481) ? intval(substr($roll_number, 0, 2)) : intval(substr($roll_number, 0, 2)) - 1;
}

function handle_sql_exception($error, $roll)
{
    if (strpos($error, 'Duplicate entry') !== false) {
        return "Error: Student with roll number $roll already exists.";
    }
    return "Error: " . htmlspecialchars($error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 🔹 Manual Form Submission
    if (isset($_POST['submit_manual'])) {
        $roll_number = strtoupper(trim($_POST['roll']));
        $name = trim($_POST['name']);
        $year = trim($_POST['year']);
        $branch = trim($_POST['branch']);
        $batch = calculate_batch($roll_number);

        try {
            $stmt = $conn->prepare("INSERT INTO student (rollnum, name, year, branch, batch) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $roll_number, $name, $year, $branch, $batch);
            $stmt->execute();
            $message = "Student inserted successfully!";
        } catch (mysqli_sql_exception $e) {
            $message = handle_sql_exception($e->getMessage(), $roll_number);
        }

        header("Location: ../pages/insert_students.php?message=" . urlencode($message));
        exit();
    }

    // 🔹 CSV File Upload
    if (isset($_POST['submit_csv']) && !empty($_FILES['csv_file']['tmp_name'])) {
        $file = $_FILES['csv_file']['tmp_name'];
        $error_occurred = false;
        $error_message = '';

        if (($handle = fopen($file, "r")) !== false) {
            $line_num = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $line_num++;
                if ($line_num === 1) continue; // skip header

                // Validate and sanitize
                $roll_number = isset($data[0]) ? strtoupper(trim($data[0])) : '';
                $name = isset($data[1]) ? trim($data[1]) : '';
                $year = isset($data[2]) ? trim($data[2]) : '';
                $branch = isset($data[3]) ? trim($data[3]) : '';

                if (!$roll_number || !$name || !$year || !$branch) continue; // skip incomplete

                $batch = calculate_batch($roll_number);

                try {
                    $stmt = $conn->prepare("INSERT INTO student (rollnum, name, year, branch, batch) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $roll_number, $name, $year, $branch, $batch);
                    $stmt->execute();
                } catch (mysqli_sql_exception $e) {
                    $error_occurred = true;
                    $error_message = handle_sql_exception($e->getMessage(), $roll_number);
                    break;
                }
            }

            fclose($handle);
        }

        $message = $error_occurred ? "Error uploading CSV: $error_message" : "CSV data uploaded successfully!";
        header("Location: ../pages/insert_students.php?message=" . urlencode($message));
        exit();
    }
}

$conn->close();
?>
