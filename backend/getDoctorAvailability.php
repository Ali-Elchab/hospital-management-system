<?php
include("connection.php");

$doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : null;

$getAvailability = $mysqli->prepare("SELECT available_date, start_time, end_time FROM doctor_availability WHERE doctorID = ? ");
$getAvailability->bind_param('i', $doctorID);
$getAvailability->execute();
$getAvailability->bind_result($available_date, $start_time, $end_time);

$availabilityData = [];

while ($getAvailability->fetch()) {
    $availabilityData[] = [
        'available_date' => $available_date,
        'start_time' => $start_time,
        'end_time' => $end_time
    ];
}
echo json_encode($availabilityData);
