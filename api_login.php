<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "config.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($email=="" || $password==""){
    echo json_encode(["status"=>"error","message"=>"Missing email or password"]);
    exit;
}

$q = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' LIMIT 1");

if(!$q){
    echo json_encode(["status"=>"error","message"=>"DB query failed"]);
    exit;
}

if(mysqli_num_rows($q)==1){
    $row = mysqli_fetch_assoc($q);

    if($row['verified'] != 1){
        echo json_encode(["status"=>"error","message"=>"Email not verified"]);
        exit;
    }

    if(password_verify($password, $row['password'])){
        echo json_encode([
            "status"=>"success",
            "uid"=>$row['id'],
            "username"=>$row['username'],
            "email"=>$row['email'],
            "coins"=>$row['coins']
        ]);
    }else{
        echo json_encode(["status"=>"error","message"=>"Wrong password"]);
    }
}else{
    echo json_encode(["status"=>"error","message"=>"Email not found"]);
}

