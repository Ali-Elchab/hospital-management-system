<?php
include("connection.php");

// Check if the POST request has been made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userID = isset($_POST['userID']) ? $_POST['userID'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $specialization=isset($_POST['specialization']) ? $_POST['specialization'] : null;
    $contact=isset($_POST['contact']) ? $_POST['contact'] : null;
    $username=isset($_POST['username']) ? $_POST['username']:null;
    $password=isset($_POST['password']) ? $_POST['password']:null;


    if ($userID !== null && $name !== null && $specialization !== null && $contact !== null && $username !== null && $password !== null ) {
        $sql = "update users set username = ?,password = ? WHERE userID = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $username, $password, $userID);
        $stmt->execute();
        $stmt->close();

        $sql = "update doctors set name = ?, specialization = ?, `contact` = ? WHERE userID = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $name, $specialization, $contact,$userID);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["status" => "success", "message" => "Doctor updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Missing fields"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}