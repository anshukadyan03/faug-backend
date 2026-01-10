<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQL_DATABASE");
$port = getenv("MYSQLPORT");

$conn = mysqli_connect($host, $user, $pass, null, (int)$port);

if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

mysqli_select_db($conn, $db);
?>
