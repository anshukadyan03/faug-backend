<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include "config.php";
include "email.php";   // ✅ mail file include

$username = $_POST['username'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$gender   = $_POST['gender'] ?? '';
$country  = $_POST['country'] ?? '';

if($username=="" || $email=="" || $password==""){
    echo json_encode(["status"=>"error","message"=>"Missing fields"]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$code = rand(100000,999999); // ✅ verification code

$sql = mysqli_query($conn,"INSERT INTO users 
(username,email,password,gender,country,coins,verified,verify_code)
VALUES
('$username','$email','$hash','$gender','$country',0,0,'$code')");

if($sql){

    // ✅ YAHAN MAIL JAAYEGI
    $send = sendVerificationMail($email, $code);

    if($send === true){
        echo json_encode(["status"=>"success","message"=>"Registered, verification code sent"]);
    }else{
        echo json_encode(["status"=>"error","message"=>$send]);
    }

}else{
    echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]);
}
