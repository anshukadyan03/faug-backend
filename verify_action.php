<?php
session_start();
include "config.php";

header("Content-Type: application/json");

if(!isset($_SESSION['verify_email'])){
    echo json_encode(["status"=>"error","message"=>"Session expired. Register again."]);
    exit;
}

if(!isset($_POST['code'])){
    echo json_encode(["status"=>"error","message"=>"Code required"]);
    exit;
}

$email = mysqli_real_escape_string($conn, $_SESSION['verify_email']);
$code  = mysqli_real_escape_string($conn, $_POST['code']);

$q = mysqli_query($conn,"SELECT id FROM users WHERE email='$email' AND verify_code='$code' AND verified=0 LIMIT 1");

if(mysqli_num_rows($q)==1){

    mysqli_query($conn,"UPDATE users SET verified=1, verify_code='' WHERE email='$email'");

    unset($_SESSION['verify_email']);

    echo json_encode(["status"=>"success","message"=>"Email verified successfully"]);

}else{
    echo json_encode(["status"=>"error","message"=>"Invalid or expired code"]);
}
