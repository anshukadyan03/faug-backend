<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect(
 "sql201.infinityfree.com",   // HOST (panel se)
 "if0_40845924",              // USER
 "tXqvb4X7udjr",               // PASSWORD
 "if0_40845924_faugdb"        // DATABASE
);

if(!$conn){
   die("DB CONNECTION FAILED");
}
?>
