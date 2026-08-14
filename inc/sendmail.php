<?php
include(__dir__.'/smtpmailfun-test.php');

$maildata = array();

$maildata["sender"] = array(
                "email" => "info@wahstory.com",
                "name" => "WAHStory"
                );
                
$maildata["receiver"] = array(
                array(
                    "email" => "elementsofficial003@gmail.com",
                    "name" => "EHRS" 
                    ),
                array(
                    "email" => "elements.officialpavan@gmail.com",
                    "name" => "Pavan Dev" 
                    )
                );
                
    $maildata["subject"] = "Testing Mail SMTP WAHStory";
    $maildata['bodymessage'] = "Testing Mail SMTP WAHStory 'Body Message 56'... ";
    
    //  SendMailBySMTP($maildata);
     
     // Check if the mail was sent successfully
echo SendMailBySMTP($maildata); 
?>