<?php
require_once __DIR__ . '/../../config/dbconn.php';

function calculate_batch($roll_number)
{
    // Extract batch code from roll number
    $batch_code = intval(substr($roll_number, 2, 5));

    // Determine batch year
    return ($batch_code === 481) ? intval(substr($roll_number, 0, 2)) : intval(substr($roll_number, 0, 2)) - 1;
}

// Custom error handler for SQL exceptions
function handle_sql_exception($error)
{
    return (strpos($error, 'Duplicate entry') !== false)
        ? "Error: A student with this roll number already exists."
        : "Error: " . htmlspecialchars($error);
}

// Ensure POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Manual Form Submission
    if (isset($_POST['submit_manual'])) {
        $roll_number = trim($_POST['roll']);
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
            $message = handle_sql_exception($e->getMessage());
        }

        header("Location: ../pages/insert_students.php?message=" . urlencode($message));
        exit();
    }

    // CSV File Upload
    if (isset($_POST['submit_csv']) && !empty($_FILES['csv_file']['name'])) {
        $file = $_FILES['csv_file']['tmp_name'];
        $error_occurred = false;
        $error_message = '';

        if (($handle = fopen($file, "r")) !== false) {
            // Skip the first row if it contains headers
            //fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $roll_number = trim($data[0]);
                $name = trim($data[1]);
                $year = trim($data[2]);
                $branch = trim($data[3]);
                $batch = calculate_batch($roll_number);

                try {
                    $stmt = $conn->prepare("INSERT INTO student (rollnum, name, year, branch, batch) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $roll_number, $name, $year, $branch, $batch);
                    $stmt->execute();
                } catch (mysqli_sql_exception $e) {
                    $error_occurred = true;
                    $error_message = handle_sql_exception($e->getMessage());
                    break; // Stop on first error
                }
            }
            fclose($handle);
        }

        $message = $error_occurred ? "Error uploading CSV file: " . $error_message : "CSV Data Uploaded Successfully!";
        header("Location: ../pages/insert_students.php?message=" . urlencode($message));
        exit();
    }
}

// Close database connection
$conn->close();
?>