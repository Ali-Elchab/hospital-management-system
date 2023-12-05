<?php
include("connection.php");

$doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : null;
$available_date = isset($_POST['available_date']) ? $_POST['available_date'] : null;
$start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
$end_time = isset($_POST['end_time']) ? $_POST['end_time'] : null;
if ($doctorID && $available_date && $start_time && $end_time) {
    $deleteAvailability = $mysqli->prepare("delete from doctor_availability where doctorID = ? AND available_date = ?  AND start_time = ? AND end_time = ?");
    $deleteAvailability->bind_param('isss', $doctorID, $available_date, $start_time, $end_time);
    $result = $deleteAvailability->execute();

    if ($result) {
        echo "Availability deleted successfully!";
    } else {
        echo "Error deleting availability.";
    }
}
