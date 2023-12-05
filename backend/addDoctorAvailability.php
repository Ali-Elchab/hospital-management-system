<?php
include("connection.php");

$doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : null;
$available_date = isset($_POST['available_date']) ? $_POST['available_date'] : null;
$start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
$end_time = isset($_POST['end_time']) ? $_POST['end_time'] : null;

if ($doctorID && $available_date && $start_time && $end_time) {
    $addAvailability = $mysqli->prepare("INSERT INTO doctor_availability (doctorID, available_date, start_time, end_time) VALUES (?, ?, ?, ?)");

    if ($addAvailability) {
        $addAvailability->bind_param('isss', $doctorID, $available_date, $start_time, $end_time);
        $result = $addAvailability->execute();

        if ($result) {
            echo "Availability added successfully!";
        } else {
            echo "Error adding availability.";
        }
    } else {
        echo "Failed to prepare the statement.";
    }
} else {
    echo "Incomplete data received.";
}
