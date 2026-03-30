<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include('inc/functions.php');

    $postObj = new Story();
     
     
   
   if(isset($_GET['sendotp'])){
       
       $email = $_POST['email']; 
       
       //Check if already Registered with same email
    $userCheck = $postObj->GetWahclubPreUser($email);
      
        if($userCheck == false){ 
             
           if($email !== ''){
                
               $OTP = $postObj->generateOTP();
               
               // Assign values to the nested session array
                $_SESSION['wahclub']['Email'] = $_POST['email'];
                $_SESSION['wahclub']['Mailotp'] = $OTP;
        		$_SESSION['wahclub']['Mailotp_time'] = time();
                
                $postObj->SendWAHClubVerificationOtpMail($email, $OTP); 
                
                $response = array(
                                'status' => "Success",
                                'message' => "OTP Sent"
                            );
                header('Content-Type: application/json');
                echo json_encode($response);
                
           }else{
                $response = array(
                                'status' => "Error",
                                'message' => "Error while sending otp"
                            );
                header('Content-Type: application/json');
                echo json_encode($response);
           }
           
       }else{ //User Not Registered with same email
        
            $response = array(
                                'status' => "Error",
                                // 'message' => "You have already registered with WAHClub! <br> Kingly <a href='/login' class='fw-bold text-primary'>Login Now</a>"
                                'message' => "You have already registered with WAHClub!"
                            );
                header('Content-Type: application/json');
                echo json_encode($response);
       }
       
       
   }
   
   //Verifying Otp
   if(isset($_GET['submitotp'])){
       
       if($_POST['otpnum'] !== '' &&  $_POST['email'] !==''){
           
            $otpnum = $_POST['otpnum']; 
            $email = $_POST['email']; 
            
            if($otpnum === $_SESSION['wahclub']['Mailotp']){
                
                unset($_SESSION['wahclub']);
                
                $response = array(
                            'status' => "Verified",
                            'message' => "Email Verified"
                        );
                header('Content-Type: application/json');
                echo json_encode($response);
                
            }else{
                
                
                $response = array(
                                'status' => "Error",
                                'message' => "Invalid Or Expired OTP! Please enter correct OTP."
                            );
                header('Content-Type: application/json');
                echo json_encode($response);
                
                
            }
            
       
       }else{
            $response = array(
                            'status' => "Error",
                            'message' => "Error while verifying email"
                        );
            header('Content-Type: application/json');
            echo json_encode($response);
       }
       
   }
   
    
    
    ?>