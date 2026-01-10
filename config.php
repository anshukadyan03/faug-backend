<?php

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

// echo "DB Connected Successfully"; // testing ke liye

?>
