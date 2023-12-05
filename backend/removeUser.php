<?php
include("connection.php");

$userID = $_POST['userID'];

$queryDeleteUser = $mysqli->prepare("DELETE FROM `users` WHERE userID = ?");
$queryDeleteUser->bind_param('s', $userID);
$queryDeleteUser->execute();
if ($queryDeleteUser->affected_rows > 0) {
    echo "User successfully removed";
} else {
    echo "User not found or already deleted";
}
