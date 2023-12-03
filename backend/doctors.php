<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$query=$mysqli->prepare('select name,specialization,contact from doctors ');

if (!$query) {
    die("Query preparation failed: " . $mysqli->error);
}

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($name, $specialization, $contact_info);

$response = []; // Initialize an array to store all rows

while ($query->fetch()) {
    $row = [
        'name' => $name,
        'specialization' => $specialization,
        'contact_info' => $contact_info
    ];
    $response[] = $row; // Add each row to the response array
}

echo json_encode($response);
