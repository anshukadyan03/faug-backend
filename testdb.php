<?php
include "email.php";

$result = sendVerificationMail("bgmi10ac@gmail.com", "123456");

if($result === true){
    echo "MAIL SENT";
}else{
    echo "MAIL FAILED: " . $result;
}
