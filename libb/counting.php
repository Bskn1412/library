<?php
include("../config/dbconn.php"); // Ensure the correct database connection
include("datetime.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollnum_or_number = trim(htmlspecialchars($_POST['rollnum_or_number']));
    $current_time = date("H:i:s");
    $current_date = date("Y-m-d");

    // Check if student or staff
    $student_query = $conn->prepare("SELECT * FROM student WHERE rollnum = ?");
    $student_query->bind_param("s", $rollnum_or_number);
    $student_query->execute();
    $student_result = $student_query->get_result();

    $staff_query = $conn->prepare("SELECT * FROM staff WHERE number = ?");
    $staff_query->bind_param("s", $rollnum_or_number);
    $staff_query->execute();
    $staff_result = $staff_query->get_result();

    if ($student_result->num_rows > 0) {
        $row = $student_result->fetch_assoc();
        $name = $row['name'];
        $branch = $row['branch'];
        $year = $row['year'];
    } elseif ($staff_result->num_rows > 0) {
        $row = $staff_result->fetch_assoc();
        $name = $row['name'];
        $branch = $row['branch'];
        $year = 0; // Staff doesn't have year
    } else {
        echo "<p style='color: red; font-weight: bold;'>ID not found in records.</p>";
        exit;
    }

    // Check if the user has an active entry (i.e., last entry has outtime = '00:00:00')
    $check_last_entry = $conn->prepare("SELECT id FROM main WHERE rollnum = ? AND date = ? AND outtime = '00:00:00' ORDER BY id DESC LIMIT 1");
    $check_last_entry->bind_param("ss", $rollnum_or_number, $current_date);
    $check_last_entry->execute();
    $last_entry_result = $check_last_entry->get_result();

    if ($last_entry_result->num_rows > 0) {
        // Update the outtime for the latest record
        $last_entry_row = $last_entry_result->fetch_assoc();
        $last_entry_id = $last_entry_row['id'];

        $update_outtime = $conn->prepare("UPDATE main SET outtime = ? WHERE id = ?");
        $update_outtime->bind_param("si", $current_time, $last_entry_id);
        if ($update_outtime->execute()) {
            echo "<p style='color: green; font-weight: bold;'>Visit again, $name!</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>Error updating outtime: " . $update_outtime->error . "</p>";
        }
    } else {
        // Insert a new entry with intime and outtime = '00:00:00'
        $insert_query = $conn->prepare("INSERT INTO main (date, name, branch, year, rollnum, intime, outtime) VALUES (?, ?, ?, ?, ?, ?, '00:00:00')");
        $insert_query->bind_param("sssiss", $current_date, $name, $branch, $year, $rollnum_or_number, $current_time);

        if ($insert_query->execute()) {
            echo "<p style='color: blue; font-weight: bold;'>Welcome, $name!</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>Error inserting entry: " . $insert_query->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Attendance System</title>
</head>

<body>
    <h2>Scan ID Card:</h2>
    <form method="POST" action="" id="attendanceForm">
        <input type="text" name="rollnum_or_number" id="rollnum_or_number" required autofocus
            placeholder="Scan barcode or type manually">
        <button type="submit">Submit</button>
    </form>
</body>

</html>