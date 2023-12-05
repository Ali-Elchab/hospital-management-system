<?php
include("connection.php");

$patientID = isset($_POST['patientID']) ? $_POST['patientID'] : null;
$roomID = isset($_POST['roomID']) ? $_POST['roomID'] : null;


$getPatientsPerRoom = $mysqli->prepare("select * from patients where roomID=?");
$getPatientsPerRoom->bind_param('i', $roomID);
$getPatientsPerRoom->execute();
$getPatientsPerRoom->store_result();

$availablity = $mysqli->prepare("select availability_status,room_number from rooms where roomID=?");
$availablity->bind_param('i', $roomID);
$availablity->execute();
$availablity->bind_result($availablity_status, $room_number);
$availablity->fetch();


echo 'hello', $availablity_status;
if ($availablity_status === 'available') {
    if ($getPatientsPerRoom->num_rows >= 2) {
        $getPatientsPerRoom->close();
        $availablity->close();

        echo ("Room already have 2 patients! Cannot add more");
        $updateStatus = $mysqli->prepare("update rooms set availability_status= 'unavailable' WHERE roomID = ?");
        $updateStatus->bind_param('i', $roomID);
        $updateStatus->execute();
    } else {
        $availablity->close();
        $assign = $mysqli->prepare("update patients set roomID=? WHERE patientID = ?");
        $assign->bind_param('ii', $roomID, $patientID);
        $assign->execute();
        echo ("Patient assigned to room {$room_number} succesfully!");
    }
} else {
    echo ("Room not available! choose another room");
}
