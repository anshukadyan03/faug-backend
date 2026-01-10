<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include "config.php";

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

$q = mysqli_query($conn,"INSERT INTO users
(username,email,password,gender,country,coins,verified)
VALUES
('$username','$email','$hash','$gender','$country',0,1)");

if($q){
    echo json_encode(["status"=>"success","message"=>"Registered successfully"]);
}else{
    echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]);
}
