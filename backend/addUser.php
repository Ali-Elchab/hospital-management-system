<?php
include("connection.php");

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$queryAddUser = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$queryAddUser->bind_param('sss', $username, $hashed_password, $role);

try {
    $queryAddUser->execute();
    if ($queryAddUser->affected_rows > 0) {
        $queryGetUserID = $mysqli->prepare("SELECT userID FROM users WHERE username = ?");
        $queryGetUserID->bind_param('s', $username);
        $queryGetUserID->execute();
        $queryGetUserID->store_result();

        if ($queryGetUserID->num_rows > 0) {
            $queryGetUserID->bind_result($userID);
            $queryGetUserID->fetch(); 

       
            if ($role === 'doctor') {
                $name = $_POST['name'];
                $specialization = $_POST['specialization'];
                $contact = $_POST['contact'];

                $queryAddDoctor = $mysqli->prepare("INSERT INTO doctors (userID, name, specialization, contact) VALUES (?, ?, ?, ?)");
                $queryAddDoctor->bind_param('isss', $userID, $name, $specialization, $contact);
                $queryAddDoctor->execute();

                if ($queryAddDoctor->affected_rows > 0) {
                    echo "User added as a doctor successfully!";
                } else {
                    echo "Failed to add user as a doctor!";
                }
            }else if($role==='patient'){
                
                    $name = $_POST['name'];
                    $gender = $_POST['gender'];
                    $DOB = $_POST['DOB'];
                    $medical_history = $_POST['medical_history'];
                    $contact = $_POST['contact'];

                    $queryAddDoctor = $mysqli->prepare("INSERT INTO patients (userID, name, gender, `Date of birth`, `medical history`, contact) VALUES (?, ?, ?, ?, ?, ?)");
                    $queryAddDoctor->bind_param('isssss', $userID, $name, $gender, $DOB, $medical_history, $contact);
                    $queryAddDoctor->execute();
                    
    
                    if ($queryAddDoctor->affected_rows > 0) {
                        echo "User added as a patient successfully!";
                    } else {
                        echo "Failed to add user as a patient!";
                    }
              
            } 
        } else {
            echo "Failed to retrieve user ID!";
        }

        $queryGetUserID->close(); 
    } else {
        echo "Failed to add user!";
    }
} catch (mysqli_sql_exception $e) {
    echo "Username already exists. Please choose a different username.";
}

