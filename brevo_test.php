<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // 🔴 full debug
  $mail->isSMTP();
$mail->Host = 'smtp-relay.brevo.com';
$mail->SMTPAuth = true;

$mail->Username = '9f993f001@smtp-brevo.com';
$mail->Password = 'xsmtpsib-2538f7d37f30d89a80ad8aabeebc21affc799e1fa1fc477cbe66498db6bad7c6-OZ5VLb1tbLmvG3l9';

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('faug_global@yahoo.com', 'FAUG Global');
$mail->addAddress('anshukadyan03@gmail.com');

$mail->isHTML(true);
$mail->Subject = 'Brevo SMTP Test';
$mail->Body = 'Hello bhai, Brevo test mail';

$mail->send();

    echo "MAIL SENT SUCCESS ✅";

} catch (Exception $e) {
    echo "MAIL ERROR ❌<br>";
    echo nl2br($mail->ErrorInfo);
}
