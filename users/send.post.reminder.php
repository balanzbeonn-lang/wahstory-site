<?php 
session_start();
require_once("../inc/functions.php");
$postObj = new Story();

if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
}else{ 
    header('location: ../login.php');
}
$Userrow = $postObj->getUserDetailsById($_SESSION['userid']);

// Function to send email notification
function SendPostReminder() {
    // Email configuration
    $to = "pavankumar@elementshrs.com";
    $subject = "Reminder: Scheduled Social Media Post Coming Up";
    
    // Email content
    $message = "
    Hi [User's Name],
    
    Just a friendly reminder that you have a scheduled social media post coming up in 2 days.
    
    Scheduled Post Details:
    - Date and Time: [Scheduled Date and Time]
    - Platform: [Platform Name]
    - Content: [Brief Description of the Content]
    
    Please ensure that you have everything prepared for the post, including any images, captions, or links. If you have any questions or need assistance, feel free to reach out to us.
    
    Best regards,
    [Your Name]
    [Your Position/Company Name]
    ";

    // Send email
    $headers = "From: info@wahstory.com" . "\r\n" .
               "Reply-To: info@wahstory.com" . "\r\n" .
               "Content-type: text/plain; charset=UTF-8" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($to, $subject, $message, $headers);

    echo "Reminder email sent successfully.";
}

$ContentSql = $postObj->getContentSuggestionByUser($_SESSION['userid']);
    
foreach($ContentSql as $Contentrows){
    
    $scheduletime = $Contentrows['scheduletime'];
    
    
    
    //18 Hour Before*****
    
    // Convert the timestamp to a DateTime object
    $date = new DateTime($scheduletime);
    $date->modify('-18 hour');
    $scheduledDateTime = $date->format('Y-m-d H:i');
    
    $current_time = new DateTime();
    $CurrentDateTime = $current_time->format('Y-m-d H:i');
    
    if($CurrentDateTime == $scheduledDateTime){
        
        SendPostReminder();
        
    }
    
    
    //1 Hour Before*****
    // Convert the timestamp to a DateTime object
    $date2 = new DateTime($scheduletime);
    $date2->modify('-1 hour');
    $scheduledDateTime2 = $date2->format('Y-m-d H:i');
    
    $current_time = new DateTime();
    $CurrentDateTime = $current_time->format('Y-m-d H:i');
    
    if($CurrentDateTime == $scheduledDateTime2){
        SendPostReminder();
    }
    
    
    
}


?>

