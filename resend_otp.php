<?php
session_start();
include('inc/functions.php');
$obj = new Story();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        unset($_SESSION['Mailotp'], $_SESSION['Mailotp_time']);
            		
    	$OTP = $obj->generateOTP();
        
    	$_SESSION['Mailotp'] = $OTP;
    	$_SESSION['Mailotp_time'] = time();
    	
    	$sql = "UPDATE `users` SET `otp` = :OTP WHERE `email` = :email";
        
        $stm = $obj->getOpenConn()->prepare($sql);
        
        $stm->bindParam(":email", $_SESSION['UEmail']);
        $stm->bindParam(":OTP", $OTP); 
         
        if ($stm->execute()) {
            
            $mailResp = $obj->SendVerificationOtpMail($_SESSION['UEmail'], $OTP);
            header('Content-Type: application/json');
            $response = array('status' => 'success', 'email' => $_SESSION['UEmail']);
            echo json_encode($response);
        }
        
    } else {
        header('Content-Type: application/json');
        $response = array('status' => 'error');
        echo json_encode($response);
    }
?>
