<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, UPDATE,DELETE,OPINIONS');
$host = "localhost";
$db_user = "root";
$db_pass = null;
$db_name = "hospitalms";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("" . $mysqli->connect_error);
}

