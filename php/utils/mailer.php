<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("vendor/autoload.php");

function mailer($to, $subject, $body)
{
    $mail = new PHPMailer();

    try {
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 0; 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = "tls"; 
        $mail->Host = "smtp-mail.outlook.com"; 
        $mail->Port = 587; 
        $mail->Username = "fatima.aguel@imie-paris.fr"; 
        $mail->Password = "********";
        $mail->SetFrom("fatima.aguel@imie-paris.fr", "fatima aguel"); 
        $mail->AddAddress($to); 

       
        $mail->send();
    } catch (Exception $e) { 
        echo "error: $e"; 
    }
}
