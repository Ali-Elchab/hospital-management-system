<?php
header('Access-Control-Allow-Origin: *');
include("connection.php");
$userID = $_POST['userID'];

$query = $mysqli->prepare('select username, password, role from users where userID=?');
$query->bind_param('i', $userID);

if (!$query->execute()) {
    die("Query execution failed: " . $query->error);
}

$query->store_result();
$query->bind_result($username, $password, $role);
$query->fetch();
$query->close();

$response = [];

if ($role === 'patient') {
    $query = $mysqli->prepare('select name, gender, `Date of birth`, `medical history`, contact, roomID from patients where userID=?');
    $query->bind_param('i', $userID);

    if (!$query->execute()) {
        die("Query execution failed: " . $query->error);
    }

    $query->store_result();
    $query->bind_result($name, $gender, $DOB, $medical_history, $contact, $roomID);
    $query->fetch();
    $query->close();

    $response = [
        'username' => $username,
        // 'password' => $password,
        'name' => $name,
        'gender' => $gender,
        'DOB' => $DOB,
        'medical_history' => $medical_history,
        'contact' => $contact,
        'roomID' => $roomID
    ];

    echo json_encode($response);
} elseif ($role === 'doctor') {
    $query = $mysqli->prepare('select name, specialization, contact from doctors where userID=?');
    $query->bind_param('i', $userID);

    if (!$query->execute()) {
        die("Query execution failed: " . $query->error);
    }

    $query->store_result();
    $query->bind_result($name, $specialization, $contact);
    $query->fetch();
    $query->close();

    $response = [
        'username' => $username,
        // 'password' => $password,
        'name' => $name,
        'specialization' => $specialization,
        'contact' => $contact
    ];

    echo json_encode($response);
} elseif ($role === 'admin') {
    $response = [
        'username' => $username,
        // 'password' => $password,
        'role' => $role
    ];

    echo json_encode($response);
}
