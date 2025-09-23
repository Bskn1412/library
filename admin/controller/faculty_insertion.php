<?php
ob_start(); // Start output buffering
include(__DIR__ . '/../../dbconn.php');

// Custom error handler for SQL exceptions
function handle_sql_exception($error)
{
    return (strpos($error, 'Duplicate entry') !== false)
        ? "Error: A faculty member with this number already exists."
        : "Error: " . htmlspecialchars($error);
}

// Ensure POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Manual Form Submission
    if (isset($_POST['submit_manual'])) {
        $faculty_number = trim($_POST['number']);
        $name = trim($_POST['name']);
        $branch = trim($_POST['branch']);
        $title = trim($_POST['title']);

        try {
            $stmt = $conn->prepare("INSERT INTO staff (rollnum, name,title, branch) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $faculty_number, $name, $title, $branch);
            $stmt->execute();
            $message = "Faculty member inserted successfully!";
        } catch (mysqli_sql_exception $e) {
            $message = handle_sql_exception($e->getMessage());
        }

        header("Location: ../pages/insert_faculty.php?message=" . urlencode($message));
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
                $faculty_number = trim($data[0]);
                $name = trim($data[1]);
                $title = trim($data[2]);
                $branch = trim($data[3]);

                try {
                    $stmt = $conn->prepare("INSERT INTO staff (rollnum, name,title, branch) VALUES (?, ?,?, ?)");
                    $stmt->bind_param("ssss", $faculty_number, $name, $title, $branch);
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
        header("Location: ../pages/insert_faculty.php?message=" . urlencode($message));
        exit();
    }
}

// Close database connection
$conn->close();
?>