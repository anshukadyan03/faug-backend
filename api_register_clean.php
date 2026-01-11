<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include "config.php";
include "email.php";   // jisme sendVerificationMail() function hai

// Receive data
$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$gender   = $_POST['gender'] ?? '';
$country  = $_POST['country'] ?? '';

// Validate
if ($username=='' || $email=='' || $password=='' || $gender=='' || $country=='') {
    echo json_encode(["status"=>"error","message"=>"All fields required"]);
    exit;
}

// Check duplicate email
$check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if(mysqli_num_rows($check) > 0){
    echo json_encode(["status"=>"error","message"=>"Email already registered"]);
    exit;
}

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Generate verify code
$code = rand(100000,999999);

// Insert user
$sql = "INSERT INTO users (username,email,password,gender,country,coins,verified,verify_code)
        VALUES ('$username','$email','$hash','$gender','$country',0,0,'$code')";

if(mysqli_query($conn,$sql)){

    // Send email
    if(sendVerificationMail($email,$code)){
        echo json_encode([
            "status"=>"success",
            "message"=>"Registered! Verification code sent to email."
        ]);
    } else {
        echo json_encode([
            "status"=>"error",
            "message"=>"Registered but email not sent"
        ]);
    }

}else{
    echo json_encode([
        "status"=>"error",
        "message"=>"DB Error: ".mysqli_error($conn)
    ]);
}
?>
