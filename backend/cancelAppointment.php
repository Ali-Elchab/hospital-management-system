<?php
include("connection.php");

$appointmentID = isset($_POST['appointmentID']) ? $_POST['appointmentID'] : null;

if ($appointmentID) {
    // Check if the appointment exists
    $checkAppointment = $mysqli->prepare("SELECT * FROM appointments WHERE appointmentID = ?");
    $checkAppointment->bind_param('i', $appointmentID);
    $checkAppointment->execute();
    $result = $checkAppointment->get_result();

    if ($result->num_rows === 1) {
        // Appointment exists, proceed with cancellation
        $cancelAppointment = $mysqli->prepare("DELETE FROM appointments WHERE appointmentID = ?");
        $cancelAppointment->bind_param('i', $appointmentID);
        $cancelResult = $cancelAppointment->execute();

        if ($cancelResult) {
            echo "Appointment canceled successfully!";
        } else {
            echo "Error canceling appointment.";
        }
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Invalid appointment ID.";
}
