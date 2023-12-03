<?php
include("connection.php");

// Check if the POST request has been made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the patient ID from the request
    $patientID = isset($_POST['patientID']) ? $_POST['patientID'] : null;

    // Retrieve the patient data from the request
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $DOB = isset($_POST['DOB']) ? $_POST['DOB'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $medical_history=isset($_POST['medical_history']) ? $_POST['medical_history'] : null;

    if ($patientID !== null && $name !== null && $gender !== null && $DOB !== null && $contact !== null && $medical_history !== null) {

        $sql = "update patients set name = ?, gender = ?, `Date of birth` = ?, `medical history` = ? , contact=? WHERE patientID = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $name, $gender, $DOB, $medical_history, $contact , $patientID);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["status" => "success", "message" => "Patient updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Missing fields"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}