<?php

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db   = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed",
        "debug" => mysqli_connect_error()
    ]));
}
?>
