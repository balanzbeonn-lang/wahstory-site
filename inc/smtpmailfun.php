<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function SendMailBySMTP($maildata){

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'server1.wahstory.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@wahstory.com';
    $mail->Password = 'Mail@Wah123#@!';
    $mail->SMTPSecure = 'TLS'; // Use SSL/TLS 
    $mail->Port = 587; // SMTP port for SSL/TLS
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    $mail->setFrom($maildata['sender']['email'], $maildata['sender']['name']);
    
    foreach($maildata['receiver'] as $receiver){
        $mail->addAddress($receiver['email'], $receiver['name']); 
    }
     $mail->isHTML(true);
    $mail->Subject = $maildata['subject'];
    $mail->Body = $maildata['bodymessage'];

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
?>
