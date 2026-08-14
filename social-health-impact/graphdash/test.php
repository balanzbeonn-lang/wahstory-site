<?php
$to = "pavankumar@elementshrs.com";
$subject = "My Subject";
$message = "Hello, this is a test email! pavankumar@elementshrs.com & ehrs.official@gmail.com";
$headers = "From: contact@wahstory.com\r\n";
$headers .= "Reply-To: contact@wahstory.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.".error_get_last()['message'];
} else {
    echo "Email sending failed.".error_get_last()['message'];
}
?>
