<?php
include("connection.php");

$username = $_POST['username'];

$queryDeleteUser = $mysqli->prepare("DELETE FROM `users` WHERE username = ?");
$queryDeleteUser->bind_param('s', $username);
$queryDeleteUser->execute();
if ($queryDeleteUser->affected_rows > 0) {
    echo "User successfully removed";
} else {
    echo "User not found or already deleted";
}
