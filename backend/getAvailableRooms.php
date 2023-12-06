<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");

$query = $mysqli->prepare("select roomID,room_number from rooms where availability_status= 'available' ");

if (!$query) {
    die("Query preparation failed: " . $mysqli->error);
}

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($roomID, $room_number);

$response = [];
while ($query->fetch()) {
    $row = [
        'roomID' => $roomID,
        'room_number' => $room_number,
    ];
    $response[] = $row;
}

echo json_encode($response);
