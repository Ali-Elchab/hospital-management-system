<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");

$query = $mysqli->prepare('select userID,doctorID,name,specialization,contact from doctors ');

if (!$query) {
    die("Query preparation failed: " . $mysqli->error);
}

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($userID, $doctorID, $name, $specialization, $contact_info);

$response = [];
while ($query->fetch()) {
    $row = [
        'userID' => $userID,
        'doctorID' => $doctorID,
        'name' => $name,
        'specialization' => $specialization,
        'contact_info' => $contact_info
    ];
    $response[] = $row;
}

echo json_encode($response);
