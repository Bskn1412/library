<?php
require_once __DIR__ . '/../../config/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_roll'])) {
        // Delete a student by roll number
        $roll = $_POST['roll'];
        $query = "DELETE FROM student WHERE rollnum = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_student.php?message=Student with Roll Number $roll deleted successfully!");
        } else {
            header("Location: ../pages/delete_student.php?error=Failed to delete student.");
        }
        $stmt->close();
    } elseif (isset($_POST['delete_year'])) {
        // Delete all students of a specific year
        $year = $_POST['year'];
        $query = "DELETE FROM student WHERE year = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $year);

        if ($stmt->execute()) {
            header("Location: ../pages/delete_student.php?message=All students from Year $year deleted successfully!");
        } else {
            header("Location: ../pages/delete_student.php?error=Failed to delete students.");
        }
        $stmt->close();
    }
}

$conn->close();
?>