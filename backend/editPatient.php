<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userID =$_POST['userID'] ;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $DOB = isset($_POST['DOB']) ? $_POST['DOB'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $medical_history=isset($_POST['medical_history']) ? $_POST['medical_history'] : null;
    $username=isset($_POST['username']) ? $_POST['username']:null;
    $password=isset($_POST['password']) ? $_POST['password']:null;
    

    if ($userID !== null && $name !== null && $gender !== null && $DOB !== null && $contact !== null && $medical_history !== null && $username !== null && $password !== null) {

        $sql = "update users set username = ?,password = ? WHERE userID = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $username, $password, $userID);
        $stmt->execute();
        $stmt->close();

        $sql = "update patients set name = ?, gender = ?, `Date of birth` = ?, `medical history` = ? , contact=? WHERE userID = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $name, $gender, $DOB, $medical_history, $contact , $userID);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["status" => "success", "message" => "Patient updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Missing fields"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}