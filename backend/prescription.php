<?php
include("connection.php");

$patientID = isset($_POST['patientID']) ? $_POST['patientID'] : null;
$doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : null;
$medication_name = isset($_POST['medication_name']) ? $_POST['medication_name'] : null;
$dosage = isset($_POST['dosage']) ? $_POST['dosage'] : null;
$frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null; // Correct variable assignment
$duration = isset($_POST['duration']) ? $_POST['duration'] : null; // Correct variable assignment

if ($patientID && $doctorID && $medication_name && $dosage && $frequency && $duration) {
    // Check room availability
    $setMed = $mysqli->prepare("INSERT INTO `medications` (doctorID, patientID, medication_name, dosage, frequency, duration) VALUES (?, ?, ?, ?, ?, ?)");

    if ($setMed) {
        $setMed->bind_param('iissss', $doctorID, $patientID, $medication_name, $dosage, $frequency, $duration);
        $result = $setMed->execute();

        if ($result) {
            echo "Prescription added successfully!";
        } else {
            echo "Error adding prescription.";
        }
    } else {
        echo "Preparation of the statement failed.";
    }
}
