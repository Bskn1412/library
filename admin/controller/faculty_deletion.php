<?php
include(__DIR__ . '/../../dbconn.php');

// Handle fatal errors with styled output
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && $error['type'] === E_ERROR) {
        echo "<div style='color: white; background-color: red; padding: 15px; font-weight: bold;'>
                Fatal Error: {$error['message']}<br>
                In {$error['file']} on line {$error['line']}
              </div>";
    }
});

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_faculty'])) {
        $faculty_num = $_POST['faculty_num'];

        // Check if $conn exists and is valid
        if (!isset($conn) || !$conn) {
            die("<div style='color: white; background-color: darkred; padding: 10px;'>Database connection is not set.</div>");
        }

        // Check if the faculty member exists
        $checkQuery = "SELECT rollnum FROM staff WHERE rollnum = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $faculty_num);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            // Faculty does not exist
            header("Location: ../pages/delete_faculty.php?error=Faculty with Roll Number $faculty_num not found.");
            $checkStmt->close();
            exit; // 🔥 This is critical
        }

        $checkStmt->close();

        // Proceed to delete
        $query = "DELETE FROM staff WHERE rollnum = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("<div style='color: white; background-color: darkred; padding: 10px;'>Failed to prepare statement: " . htmlspecialchars($conn->error) . "</div>");
        }

        $stmt->bind_param("s", $faculty_num);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_faculty.php?message=Faculty with Roll Number $faculty_num deleted successfully!");
        } else {
            header("Location: ../pages/delete_faculty.php?error=Failed to delete faculty.");
        }

        $stmt->close();
        exit; // Prevents further processing
    }
}

// Close DB connection
if (isset($conn) && $conn) {
    $conn->close();
}
?>
