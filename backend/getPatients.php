<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");

$query = $mysqli->prepare('select userID,patientID,name,gender,`Date of birth`,`medical history`,contact from patients ');

if (!$query) {
    die("Query preparation failed: " . $mysqli->error);
}

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($userID, $patientID, $name, $gender, $DOB, $medical_history, $contact);

$response = [];

while ($query->fetch()) {
    $row = [
        'userID' => $userID,
        'patientID' => $patientID,
        'name' => $name,
        'gender' => $gender,
        'DOB' => $DOB,
        'medical_history' => $medical_history,
        'contact' => $contact
    ];
    $response[] = $row;
}

echo json_encode($response);
