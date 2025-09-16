<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include(__DIR__ . '/../dbconn.php');
date_default_timezone_set('Asia/Kolkata'); // adjust if needed

$today = date('Y-m-d');
$closingTime = date('H:i:s'); // or fixed '19:00:00' if always 7pm

// Replace "Still in Library" with current/closing time
$sql = "UPDATE `main` 
        SET `outtime` = ? 
        WHERE `date` = ? 
          AND (`outtime` = 'Still in Library' OR `outtime` = 'still in library')";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status'=>'error','error'=>$conn->error]);
    exit;
}

$stmt->bind_param('ss', $closingTime, $today);
$ok = $stmt->execute();

if ($ok) {
    echo json_encode([
        'status' => 'success',
        'affected' => $stmt->affected_rows,
        'closing_time' => $closingTime
    ]);
} else {
    http_response_code(500);
    echo json_encode(['status'=>'error','error'=>$stmt->error]);
}

$stmt->close();
$conn->close();
