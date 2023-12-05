<?php
include("connection.php");

// Assuming $_POST['doctorID'], $_POST['patientID'], $_POST['appointment_date'], $_POST['appointment_time'] contain respective values

$doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : null;
$patientID = isset($_POST['patientID']) ? $_POST['patientID'] : null;
$appointment_date = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : null;
$appointment_time = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : null;

if ($doctorID && $patientID && $appointment_date && $appointment_time) {
    // Check if the selected slot is available for booking
    $checkAvailability = $mysqli->prepare("SELECT COUNT(*) FROM appointments WHERE doctorID = ? AND appointment_date = ? AND appointment_time = ?");
    $checkAvailability->bind_param('iss', $doctorID, $appointment_date, $appointment_time);
    $checkAvailability->execute();
    $checkAvailability->bind_result($count);
    $checkAvailability->fetch();

    if ($count == 0) {
        // Slot is available, proceed with booking the appointment
        $checkAvailability->close();
        $bookAppointment = $mysqli->prepare("INSERT INTO appointments (doctorID, patientID, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
        $bookAppointment->bind_param('iiss', $doctorID, $patientID, $appointment_date, $appointment_time);
        $result = $bookAppointment->execute();

        if ($result) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error booking appointment.";
        }
    } else {
        echo "Selected slot is already booked.";
    }
}
