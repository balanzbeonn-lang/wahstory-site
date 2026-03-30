<?php 
session_start();
    include('inc/functions.php');
    $postObj = new Story();
    
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form data
    
    $email = $_POST['SubscriberEmail']; 
    
    if($email != ''){
        
        $SubscribeNow = $postObj->SubscribeWahstory($email);
        
        // Send a JSON response back to the JavaScript
        $response = array(
            'message' => 'Subscribed successfully',
            'email' => $email,
        );
    
    
     require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/smtpmailfun.php');

    $maildata = array();
    
    $maildata["sender"] = array(
                    "email" => "contact@wahstory.com",
                    "name" => "WAHStory"
                    );
                    
    $maildata["receiver"] = array(
                    array(
                        "email" => $email,
                        "name" => " " 
                        )
                    );
                    
        $maildata["subject"] = 'Thank You for Subscribing to WAHStory';
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    Thank you for Subscribe | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 22px;"> Hi, </p>
                    		<p style="font-size: 18px;">
                    		Welcome to WAHStory ! Thank you for subscribing and becoming a part of our growing community of storytellers and enthusiasts.
                    		</p>
                    		<p style="font-size: 18px;"> Here is what you can look forward to: </p>
                    <ul>		
                    	<li style="font-size: 18px;"> Dive into a world of captivating stories. <a href="https://www.wahstory.com/stories" target="_blank"> Stories </a> </li>
                    	<li style="font-size: 18px;"> Share your own stories and connect with fellow storytellers. <a href="https://www.wahstory.com/shareyourstory/" target="_blank"> Share Your Story </a></li>
                    	<li style="font-size: 18px;"> Enjoy personalized story recommendations. <a href="https://www.wahstory.com/createaccount" target="_blank"> Share Your Story </a></li>
                    </ul>
                    
                    <p style="font-size: 18px;"> Thank you for joining our storytelling community. We can not wait to see the stories you will discover and create. </p>
                    
                    <p style="font-size: 18px;"> Happy storytelling! </p>
                    <p style="font-size: 18px;"> Best regards, </p>
                    <p style="font-size: 18px;"> Team WAHStory </p>
                    
                    </body>
                    </html>';
        
    SendMailBySMTP($maildata);
    
    
        header('Content-Type: application/json');
    echo json_encode($response);
    }else{
        http_response_code(403); // Forbidden
    }
    
} else {
    // Handle non-POST requests or direct access to this script
    http_response_code(403); // Forbidden
}


?>