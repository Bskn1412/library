<?php
date_default_timezone_set("Asia/Kolkata"); // Set timezone to IST (India)

function getCurrentDate()
{
    return date("Y-m-d"); // Returns current date in YYYY-MM-DD format
}

function getCurrentTime()
{
    return date("H:i:s"); // Returns current time in HH:MM:SS format
}

// Example usage
$current_date = getCurrentDate();
$current_time = getCurrentTime();
?>