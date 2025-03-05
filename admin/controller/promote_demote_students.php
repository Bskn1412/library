<?php
require_once __DIR__ . '/../../config/dbconn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['promote_roll'])) {
        // Promote a student by Roll Number
        $roll = $_POST['roll'];
        $query = "UPDATE student SET year = year + 1 WHERE rollnum = ? AND year < 4"; // Prevents exceeding 4th year
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "Student with Roll Number $roll promoted successfully!";
        } else {
            $message = "Failed to promote. Student may already be in the final year.";
        }
        $stmt->close();
    } elseif (isset($_POST['demote_roll'])) {
        // Demote a student by Roll Number
        $roll = $_POST['roll'];
        $query = "UPDATE student SET year = year - 1 WHERE rollnum = ? AND year > 1"; // Prevents going below 1st year
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "Student with Roll Number $roll demoted successfully!";
        } else {
            $message = "Failed to demote. Student may already be in the 1st year.";
        }
        $stmt->close();
    } elseif (isset($_POST['promote_batch'])) {
        // Promote all students in a batch
        $batch = $_POST['batch'];
        $query = "UPDATE student SET year = year + 1 WHERE batch = ? AND year < 4";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $batch);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "All students from Batch $batch promoted successfully!";
        } else {
            $message = "Failed to promote. Students may already be in the final year.";
        }
        $stmt->close();
    } elseif (isset($_POST['demote_batch'])) {
        // Demote all students in a batch
        $batch = $_POST['batch'];
        $query = "UPDATE student SET year = year - 1 WHERE batch = ? AND year > 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $batch);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "All students from Batch $batch demoted successfully!";
        } else {
            $message = "Failed to demote. Students may already be in the 1st year.";
        }
        $stmt->close();
    }
}

$conn->close();
?>