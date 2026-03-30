<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/smtpmailfun.php');

$maildata = array();

$maildata["sender"] = array(
                "email" => "info@wahstory.com",
                "name" => "WAHStory" 
                );
                
$maildata["receiver"] = array(
                array(
                    "email" => "pavankumar@elementshrs.com",
                    "name" => "Pavan Kumar" 
                    )
                );
                
    $maildata["subject"] = "Welcome to WAHClub! We're excited to have you join our community, and we're ready to help you elevate your brand.";
    
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    Welcome to WAHClub! | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 15px;"> Below are your login details to access your WAHClub dashboard: </p>
            		<p style="font-size: 15px;"> <strong>Username:</strong> </p>
            		<p style="font-size: 15px;"> <strong>Password:</strong> </p>
            		
            		<p style="font-size: 15px;"> To get started, you can log in here: </p>
            		<p style="font-size: 15px; margin-bottom: 10px;"> <a href="https://www.wahstory.com/users/" style="background: #df2853;display: inline;padding: 10px;font-weight: 700;border-radius: 5px; color: #fff !important; text-decoration: none;" target="_blank"> Go to Your Dashboard </a> </p> 
            		<p style="font-size: 15px;"> If you have any questions or need assistance, feel free to reach out at <a href="mailto:info@wahstory.com">info@wahstory.com</a> </p> 
            		<p style="font-size: 15px;"> We’re here to support you! </p> 
            		  
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> WAHClub Team</p>
            		
                    
                    </body>
                    </html>';
    
    //  SendMailBySMTP($maildata);
     
     // Check if the mail was sent successfully
echo SendMailBySMTP($maildata); 
?>