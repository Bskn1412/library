<?php
require_once __DIR__ . '/../../config/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_faculty'])) {
        // Delete a faculty member by faculty number
        $faculty_num = $_POST['faculty_num'];
        $query = "DELETE FROM staff WHERE number = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $faculty_num);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_faculty.php?message=Faculty with Number $faculty_num deleted successfully!");
        } else {
            header("Location: ../pages/delete_faculty.php?error=Failed to delete faculty.");
        }
        $stmt->close();
    }
}

$conn->close();
?>