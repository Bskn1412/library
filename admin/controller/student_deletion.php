<?php
include(__DIR__ . '/../../dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_roll'])) {
        $roll = $_POST['roll'];

        // Check if student with this roll number exists
        $checkQuery = "SELECT rollnum FROM student WHERE rollnum = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $roll);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            // Student doesn't exist
            header("Location: ../pages/delete_student.php?error=Student with Roll Number $roll not found.");
            $checkStmt->close();
            exit;
        }
        $checkStmt->close();

        // Proceed to delete
        $query = "DELETE FROM student WHERE rollnum = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_student.php?message=Student with Roll Number $roll deleted successfully!");
        } else {
            header("Location: ../pages/delete_student.php?error=Failed to delete student.");
        }
        $stmt->close();
        exit;

    } elseif (isset($_POST['delete_year'])) {
        $year = $_POST['year'];

        // Check if there are any students from that year
        $checkQuery = "SELECT COUNT(*) FROM student WHERE year = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("i", $year);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();

        if ($count === 0) {
            // No students found for that year
            header("Location: ../pages/delete_student.php?error=No students found for Year $year.");
            $checkStmt->close();
            exit;
        }
        $checkStmt->close();

        // Proceed to delete
        $query = "DELETE FROM student WHERE year = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $year);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_student.php?message=All students from Year $year deleted successfully!");
        } else {
            header("Location: ../pages/delete_student.php?error=Failed to delete students.");
        }
        $stmt->close();
        exit;
    }
}

$conn->close();
?>
