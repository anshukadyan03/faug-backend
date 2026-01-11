<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


function sendVerificationMail($to, $code){

    $mail = new PHPMailer(true);

    try {
        // ✅ SMTP config
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;

        // ✅ Brevo me username hamesha "apikey" hota hai
        $mail->Username   = '9f993f001@smtp-brevo.com';

        // ✅ Yahan apni Brevo SMTP key paste karo
        $mail->Password   = 'xsmtpsib-2538f7d37f30d89a80ad8aabeebc21affc799e1fa1fc477cbe66498db6bad7c6-u6zyx5Gxhmw9hbAD';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // ✅ Ye email Brevo me verified hona chahiye
        $mail->setFrom('faug_global@yahoo.com', 'FAUG Global');
        $mail->addAddress($to);

        // ✅ Mail content
        $mail->isHTML(true);
        $mail->Subject = 'FAUG Global - Email Verification Code';

       $mail->Body = "
<div style='background:#050505;padding:0;margin:0;font-family:Arial'>

  <div style='max-width:600px;margin:auto;background:#0c0c0c;border-radius:12px;overflow:hidden;
              box-shadow:0 0 25px #00ffcc'>

    <div style='background:#000;padding:20px;text-align:center'>
      <h1 style='color:#00ffcc;margin:0'>FAUG GLOBAL</h1>
      <p style='color:#888;margin:5px 0 0'>Email Verification</p>
    </div>

    <div style='padding:25px;text-align:center;color:white'>
      <h2 style='color:#00ffcc'>Verify your email</h2>
      <p style='color:#ccc;font-size:14px'>
        Use the verification code below to complete your registration.
      </p>

      <div style='margin:25px auto;
                  display:inline-block;
                  background:#000;
                  border:2px dashed #00ffcc;
                  padding:15px 30px;
                  font-size:32px;
                  letter-spacing:6px;
                  color:#00ffcc;
                  border-radius:10px;'>
        $code
      </div>

      <p style='margin-top:20px;color:#888;font-size:13px'>
        Do not share this code with anyone.
      </p>
    </div>

    <div style='background:#000;padding:12px;text-align:center;color:#666;font-size:12px'>
      © ".date("Y")." FAUG Global. All rights reserved.
    </div>

  </div>
</div>
";


        $mail->send();
        return true;

    } catch (Exception $e) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    }
}


