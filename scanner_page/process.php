<?php
header("Content-Type: application/json"); // JSON Response
include("../config/dbconn.php"); // Database Connection
include("datetime.php");

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $number = isset($_POST['number']) ? trim(htmlspecialchars($_POST['number'])) : null;
    $current_time = date("H:i:s");
    $current_date = date("Y-m-d");

    // Check if student exists
    $student_query = $conn->prepare("SELECT * FROM student WHERE rollnum = ?");
    $student_query->bind_param("s", $number);
    $student_query->execute();
    $student_result = $student_query->get_result();

    // Check if staff exists
    $staff_query = $conn->prepare("SELECT * FROM staff WHERE rollnum = ?");
    $staff_query->bind_param("s", $number);
    $staff_query->execute();
    $staff_result = $staff_query->get_result();

    if ($student_result->num_rows > 0) {
        $row = $student_result->fetch_assoc();
        $name = $row['name'];
        $branch = $row['branch'];
        $year = $row['year'];
        $table = "main";

        // Check for active entry
        $check_last_entry = $conn->prepare("SELECT id FROM $table WHERE rollnum = ? AND date = ? AND outtime = '00:00:00' ORDER BY id DESC LIMIT 1");
        $check_last_entry->bind_param("ss", $number, $current_date);
        $check_last_entry->execute();
        $last_entry_result = $check_last_entry->get_result();

        if ($last_entry_result->num_rows > 0) {
            $last_entry_row = $last_entry_result->fetch_assoc();
            $last_entry_id = $last_entry_row['id'];

            $update_outtime = $conn->prepare("UPDATE $table SET outtime = ? WHERE id = ?");
            $update_outtime->bind_param("si", $current_time, $last_entry_id);
            if ($update_outtime->execute()) {
                $response["status"] = "success";
                $response["message"] = "Visit again, $name!";
            } else {
                $response["status"] = "error";
                $response["message"] = "Error updating outtime." . $update_outtime->error;
            }
        } else {
            $insert_query = $conn->prepare("INSERT INTO $table (date, name, branch, year, rollnum, intime, outtime) VALUES (?, ?, ?, ?, ?, ?, '00:00:00')");
            $insert_query->bind_param("sssiss", $current_date, $name, $branch, $year, $number, $current_time);

            if ($insert_query->execute()) {
                $response["status"] = "success";
                $response["message"] = "Welcome, $name!";
            } else {
                echo "Error inserting new entry.<br>";
                $response["status"] = "error";
                $response["message"] = "Error inserting entry." . $insert_query->error;
            }
        }
    } elseif ($staff_result->num_rows > 0) {
        $row = $staff_result->fetch_assoc();
        $name = $row['name'];
        $branch = $row['branch'];
        $title = $row['title'];
        $table = "staff_logs";

        // Check for active entry
        $check_last_entry = $conn->prepare("SELECT id FROM $table WHERE rollnum = ? AND date = ? AND outtime = '00:00:00' ORDER BY id DESC LIMIT 1");
        $check_last_entry->bind_param("ss", $number, $current_date);
        $check_last_entry->execute();
        $last_entry_result = $check_last_entry->get_result();

        if ($last_entry_result->num_rows > 0) {
            $last_entry_row = $last_entry_result->fetch_assoc();
            $last_entry_id = $last_entry_row['id'];

            $update_outtime = $conn->prepare("UPDATE $table SET outtime = ? WHERE id = ?");
            $update_outtime->bind_param("si", $current_time, $last_entry_id);
            if ($update_outtime->execute()) {
                $response["status"] = "success";
                $response["message"] = "Visit again, $name $title!";
            } else {
                $response["status"] = "error";
                $response["message"] = "Error updating outtime." . $update_outtime->error;
            }
        } else {
            $insert_query = $conn->prepare("INSERT INTO $table (date, name, branch, rollnum, intime, outtime) VALUES (?, ?, ?, ?, ?, '00:00:00')");
            $insert_query->bind_param("sssss", $current_date, $name, $branch, $number, $current_time);

            if ($insert_query->execute()) {
                $response["status"] = "success";
                $response["message"] = "Welcome, $name $title!";
            } else {
                $response["status"] = "error";
                $response["message"] = "Error inserting entry." . $insert_query->error;
            }
        }
    } else {
        $response["status"] = "error";
        $response["message"] = "ID not found in records.";
    }
}

echo json_encode($response);
?>