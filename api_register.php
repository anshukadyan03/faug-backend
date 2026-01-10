<?php
session_start();
include "config.php";
include "email.php";

header("Content-Type: application/json");

// ✅ Basic validation
if(
    !isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['gender'], $_POST['country'], $_FILES['avatar'])
){
    echo json_encode(["status"=>"error","message"=>"All fields required"]);
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$gender   = mysqli_real_escape_string($conn, $_POST['gender']);
$country  = mysqli_real_escape_string($conn, $_POST['country']);

// ✅ Email format check
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo json_encode(["status"=>"error","message"=>"Invalid email"]);
    exit;
}

// ✅ Check email already exists
$check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");
if(mysqli_num_rows($check) > 0){
    echo json_encode(["status"=>"error","message"=>"Email already exists"]);
    exit;
}

// ✅ Upload avatar
$folder="uploads/";
if(!is_dir($folder)) mkdir($folder,0755,true);

$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
$allowed = ["jpg","jpeg","png","webp"];

if(!in_array(strtolower($ext), $allowed)){
    echo json_encode(["status"=>"error","message"=>"Only jpg, png, webp allowed"]);
    exit;
}

$name = time()."_".rand(1000,9999).".".$ext;
$path = $folder.$name;

if(!move_uploaded_file($_FILES['avatar']['tmp_name'],$path)){
    echo json_encode(["status"=>"error","message"=>"Avatar upload failed"]);
    exit;
}

// ✅ Generate verification code
$code = rand(100000,999999);

// ✅ Insert user
$q = mysqli_query($conn,"INSERT INTO users
(username,email,password,gender,country,avatar,coins,verified,verify_code)
VALUES
('$username','$email','$password','$gender','$country','$path',0,0,'$code')");

if($q){

    $send = sendVerificationMail($email,$code);

    if($send === true){
        $_SESSION['verify_email'] = $email;
        echo json_encode(["status"=>"success","message"=>"Verification code sent"]);
    }else{
        echo json_encode(["status"=>"error","message"=>$send]);
    }

}else{
    echo json_encode(["status"=>"error","message"=>"Database error"]);
}

