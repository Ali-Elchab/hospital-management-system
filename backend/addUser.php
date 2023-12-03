<?php
include("connection.php");

// Assuming you have received user data from a form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ... other user-related data

// Add user to users table
$queryAddUser = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$queryAddUser->bind_param('sss', $username, $hashed_password, $role);

try {
    $queryAddUser->execute();
    if ($queryAddUser->affected_rows > 0) {
        // Retrieve the user ID of the recently added user
        $queryGetUserID = $mysqli->prepare("SELECT userID FROM users WHERE username = ?");
        $queryGetUserID->bind_param('s', $username);
        $queryGetUserID->execute();
        $queryGetUserID->store_result(); // Store the result set

        if ($queryGetUserID->num_rows > 0) {
            $queryGetUserID->bind_result($userID);
            $queryGetUserID->fetch(); // Fetch the result

            // Check if the user is a doctor and add to doctors table
            if ($role === 'doctor') {
                // Assuming you have doctor-related data received from a form
                $name = $_POST['name'];
                $specialization = $_POST['specialization'];
                $contact = $_POST['contact'];
                // ... other doctor-related data

                // Add doctor to doctors table
                $queryAddDoctor = $mysqli->prepare("INSERT INTO doctors (userID, name, specialization, contact) VALUES (?, ?, ?, ?)");
                $queryAddDoctor->bind_param('isss', $userID, $name, $specialization, $contact);
                $queryAddDoctor->execute();

                if ($queryAddDoctor->affected_rows > 0) {
                    echo "User added as a doctor successfully!";
                } else {
                    echo "Failed to add user as a doctor!";
                }
            }else if($role==='patient'){
                
                    // Assuming you have doctor-related data received from a form
                    $name = $_POST['name'];
                    $gender = $_POST['gender'];
                    $DOB = $_POST['DOB'];
                    $medical_history = $_POST['medical_history'];
                    $contact = $_POST['contact'];
                    // ... other doctor-related data
    
                    // Add doctor to doctors table
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

        $queryGetUserID->close(); // Close the first query result set
    } else {
        echo "Failed to add user!";
    }
} catch (mysqli_sql_exception $e) {
    echo "Username already exists. Please choose a different username.";
}

