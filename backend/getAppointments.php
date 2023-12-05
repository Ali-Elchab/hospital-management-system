<?php
include("connection.php");
$patientID = $_POST('patientID');

$query = $mysqli->prepare('select appointmentID,reason,appointment_date,appointment_time,doctorID from appointments where patientID=?');
$query->bind_param('i', $patientID);
if (!$query) {
    die("Query preparation failed: " . $mysqli->error);
}

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($appointmentID, $reason, $appointment_date, $appointment_time, $doctorID);

$response = [];

while ($query->fetch()) {
    $row = [
        'appointmentID' => $appointmentID,
        'reason' => $reason,
        'appointment_date' => $appointment_date,
        'appointment_time' => $appointment_time,
        'doctorID' => $doctorID,

    ];
    $response[] = $row;
}

echo json_encode($response);
