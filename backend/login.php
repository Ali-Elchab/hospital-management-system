<?php

header('Content-Type: application/json');

include("connection.php");
require_once 'vendor/autoload.php'; // Include the JWT library

use Firebase\JWT\JWT;

// Set your JWT secret key (this should be kept secure)
$jwt_secret = '123';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $input_password = $_POST['password'];

    $query = $mysqli->prepare('SELECT userID, username, password, role FROM users WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $query->store_result();
    $num_rows = $query->num_rows;
    $query->bind_result($id, $username, $password, $role);
    $query->fetch();
   
    if ($num_rows == 1 && ($input_password== $password)) {
        // Create JWT payload
        $payload = [
            'user_id' => $id,
            'username' => $username,
            'role' => $role,
            'exp' => (60 * 60) // Token expiration time (1 hour)
        ];
        // Generate JWT
        $jwt = JWT::encode($payload, $jwt_secret, 'HS256');

        // Prepare success response with JWT
        $response = [
            'status' => 'success',
            'token' => $jwt
        ];

        echo json_encode($response);
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Authentication failed';
        echo json_encode($response);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Missing parameters';
    echo json_encode($response);
}
?>
