<?php
include(__DIR__ . '/../../dbconn.php');
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['roll'])) {
        $roll = $_POST['roll'];
        if (isset($_POST['promote_roll'])) {
            $query = "UPDATE student SET year = year + 1 WHERE rollnum = ? AND year < 4";
        } elseif (isset($_POST['demote_roll'])) {
            $query = "UPDATE student SET year = year - 1 WHERE rollnum = ? AND year > 1";
        }

        if (!empty($query)) {
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $roll);
            $stmt->execute();
            $message = ($stmt->affected_rows > 0) ?
                "Student with Roll Number $roll updated successfully!" :
                "No changes made. May already be in boundary year.";
            $stmt->close();
        }

    } elseif (!empty($_POST['batch'])) {
        $batch = $_POST['batch'];
        if (isset($_POST['promote_batch'])) {
            $query = "UPDATE student SET year = year + 1 WHERE batch = ? AND year < 4";
        } elseif (isset($_POST['demote_batch'])) {
            $query = "UPDATE student SET year = year - 1 WHERE batch = ? AND year > 1";
        }

        if (!empty($query)) {
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $batch);
            $stmt->execute();
            $message = ($stmt->affected_rows > 0) ?
                "Batch $batch Demoted successfully!" :
                "No changes made. May already be in boundary year.";
            $stmt->close();
        }
    }
}
$conn->close();
?>
