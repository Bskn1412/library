<?php
include(__DIR__ . '/../dbconn.php');

if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

$today = date('Y-m-d');
$query = "SELECT COUNT(*) AS total_visitors FROM main WHERE `date` = '$today'";
$result = $conn->query($query);

$totalVisitors = 0;
if ($result && $row = $result->fetch_assoc()) {
  $totalVisitors = (int)$row['total_visitors'];
}

echo $totalVisitors;
?>