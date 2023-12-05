<?php
include("connection.php");

$patientID = isset($_POST['patientID']) ? $_POST['patientID'] : null;
$roomID = isset($_POST['roomID']) ? $_POST['roomID'] : null;
$approval_status = isset($_POST['approval_status']) ? $_POST['approval_status'] : null;

// Check if IDs are set
if ($patientID && $roomID && $approval_status) {

    // Check room availability
    $availability = $mysqli->prepare("SELECT availability_status, room_number FROM rooms WHERE roomID=?");
    $availability->bind_param('i', $roomID);
    $availability->execute();
    $availability->bind_result($availability_status, $room_number);
    $availability->fetch();

    if ($availability_status === 'available') {

        // Close previous statement result
        $availability->close();

        // Insert into emergency admissions
        $setAdmission = $mysqli->prepare("INSERT INTO `emergency-admissions` (patientID, assigned_room_id, admin_approval_status) VALUES (?, ?, ?)");
        $setAdmission->bind_param('iis', $patientID, $roomID, $approval_status);
        $result = $setAdmission->execute();

        if ($result && $approval_status === 'approved') {
            echo ("Admission approved, patient assigned to emergency room");

            // Update room availability
            $updateStatus = $mysqli->prepare("UPDATE rooms SET availability_status= 'unavailable' WHERE roomID = ?");
            $updateStatus->bind_param('i', $roomID);
            $updateStatus->execute();

            // Assign room to patient
            $assign = $mysqli->prepare("UPDATE patients SET roomID=? WHERE patientID = ?");
            $assign->bind_param('ii', $roomID, $patientID);
            $assign->execute();

            echo ("Patient assigned to room {$room_number} successfully!");
        } else {
            echo 'Admission rejected';
        }
    } else {
        echo "Room {$room_number} is not available.";
    }
} else {
    echo "Invalid input data.";
}
