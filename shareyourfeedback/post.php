<?php
include('config/config.inc.php');
include('config/functions.inc.php'); 



if(isset($_REQUEST['SUBMIT'])){
    
    extract($_POST);
    $date = date("Y-m-d");
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	
	$firstname = mysqli_real_escape_string( $conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string( $conn, $_POST['lastname']);
	$designation = mysqli_real_escape_string( $conn, $_POST['designation']);
	$rating = mysqli_real_escape_string( $conn, $_POST['rating1']);
	$ratingnum = mysqli_real_escape_string( $conn, $_POST['ratingnum']);
	$description = mysqli_real_escape_string( $conn, $_POST['description']);
	$whatmade = mysqli_real_escape_string( $conn, $_POST['whatmade']);
	
	$target_pathphoto="testimonialimgs/";
	$img= $_FILES['file']['name'];
	$extn = explode(".",$img);
	$extnname= $extn[1];
	$img_encpted = date("dmYHis").".".$extnname;
	$target_pathupload = $target_pathphoto . $img_encpted;
	move_uploaded_file($_FILES['file']['tmp_name'],$target_pathupload);
	if(empty($img)){
	    $profileimage='';
	}else{
		$profileimage=$img_encpted;
	}
	
	
    $query=executeQuery("INSERT INTO `recievedtestimonials`(`firstname`,`lastname`, `email`, `designation`, `rating1`, `ratingnum`, `description`, `whatmade`, `photo`, `date`) VALUES ('$firstname', '$lastname', '$email', '$designation', '$rating1', '$ratingnum', '$description', '$whatmade', '$profileimage', '$date')");
	
	
    $to      = 'akshaybhatia@elementshrs.com';
    $subject = 'Elements HRS Testimonials';
    
    $photourl = "http://www.wahstory.com/shareyourfeedback/testimonialimgs/".$profileimage;
    
    $message = 'Name: ' . $firstname.' '.$lastname. "\r\n";
    $message .= 'Email: ' . $email . "\r\n";
    $message .= 'Photo: ' . $photourl . "\r\n";
    $message .= 'Designation: ' . $designation . "\r\n";
    $message .= 'Star: ' . $rating1 . "Star\r\n";
    $message .= 'Scale from 1-10: ' . $ratingnum . "\r\n";
    $message .= 'Description: ' . $description . "\r\n";
    $message .= 'What you made: ' . $whatmade . "\r\n";
    
    
    $headers = 'From: akshaybhatia@elementshrs.com  ' . "\r\n" .
        'Reply-To: akshaybhatia@elementshrs.com  ' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $message, $headers)) {
                        
        echo'<script language="javascript">
	window.location.href="index.php?sucmsg=Thank You for your feedback";
	</script>';
                        
    } else {
                        
        echo'<script language="javascript">
	window.location.href="index.php?errmsg=Error While Sending Feedback, Please try again!";
	</script>';
	
    }
    
    
	 } else {
                        
        echo'<script language="javascript">
	window.location.href="index.php?errmsg=Error Incorrect ReCaptcha, please try again!";
	</script>';
	
    }
	
}

?>