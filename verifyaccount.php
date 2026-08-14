<?php
    session_start();
    include('inc/functions.php');
    $postObj = new Story();
     
    if(isset($_POST['SENDCODE'], $_POST["email"])){
        
        $OTP = $postObj->generateOTP();
        
        $sql = "UPDATE `users` SET `otp` = :OTP WHERE `email` = :email";
        
        $stm = $postObj->getOpenConn()->prepare($sql);
        
        $stm->bindParam(":email", $_POST['email']);
        $stm->bindParam(":OTP", $OTP); 
         
        if ($stm->execute()) {
        
            $mailResp = $postObj->SendVerificationOtpMail($_POST["email"], $OTP);
            
            $SucMessage = "Please check your email. A verification code has been sent to your inbox. If you don't see it, kindly check your spam folder.";
            $_SESSION['PENDING_VERIFICATION'] = 1;
            
             $_SESSION['UEmail'] = $_POST['email'];
    		$_SESSION['Mailotp'] = $OTP;
    		$_SESSION['Mailotp_time'] = time();
        }
        
    }
    
    
    if(isset($_POST['VerifyAccount'])){
        
        if($_POST['VCode'] === $_SESSION['Mailotp']){
            
            if (isset($_SESSION['Mailotp_time'])) { 
                $currentTime = time();
                $otpTime = $_SESSION['Mailotp_time'];
                $validityPeriod = 15 * 60; // 15 minutes in seconds
    
                if (($currentTime - $otpTime) <= $validityPeriod) {
                
                       $UserRow = $postObj->GetUserByEmail($_SESSION['UEmail']);
                        
                        $_SESSION["expire"] = time() + (60 * 30);
                        $_SESSION['userid'] = $UserRow['id'];
                        $_SESSION['email'] = $UserRow['email'];
                        
                         $sql = "UPDATE `users` SET `isverified` = 1 WHERE `email` = '".$UserRow['email']."'";
                        $stm = $postObj->getOpenConn()->prepare($sql);
                        $stm->execute();
                        
                        
                        unset($_SESSION['UEmail']);
                        unset($_SESSION['Mailotp']);
                        unset($_SESSION['Mailotp_time']); 
                        unset($_SESSION['PENDING_VERIFICATION']); 
                        
                    header('location: /users/');
                    
                }else{
                    $ErrMessage = "Expired OTP!";
                    $_SESSION['PENDING_VERIFICATION'] = 1;
                }
            }
         }else{//Verify OTP
         
            $ErrMessage = "Invalid OTP!"; 
            $_SESSION['PENDING_VERIFICATION'] = 1;
         
         }
    }

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="WahStory">
  <!-- Favicon Icon -->
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    <meta name="theme-color" content="#181818" />
  <!-- Site Title -->
  <title>Login | WAHStory</title>
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
 </style> 
 <?php include('header.php');?>
 <!-- Start Hero --> 
  
   <!-- End Hero -->
  <div class="cs-height_140 cs-height_lg_140"></div>
  <div class="container">
      <div class="row">
        
        <div class="col-md-3"></div>
        <div class="col-md-6">
            
                <div class="cs-shop-side-spacing">
                  <div class="cs-shop-card">
                      
            <?php if(isset($SucMessage)){ ?>
                <p style="color: #10cd80; font-size: 15px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$SucMessage?></p>
            <?php } ?>
            <?php if(isset($ErrMessage)){ ?>
                <p style="color: #e9204f; font-size: 15px;"><i class="fa fa-times-circle"></i> &nbsp;<?=$ErrMessage?></p>
            <?php } ?>
            <?php if(isset($_GET['sucmessage'])){ ?>
                <p style="color: #10cd80; font-size: 15px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$_GET['sucmessage']?></p>
            <?php } ?>
            <?php if(isset($_GET['errmessage'])){ ?>
                <p style="color: #e9204f; font-size: 15px;"><i class="fa fa-times-circle"></i> &nbsp;<?=$_GET['errmessage']?></p>
            <?php } ?>
                    
            <?php if(!isset($_SESSION['PENDING_VERIFICATION'])){ ?>
              
              <form action="" method="post" id="Submitloading">
                  
                    <h2>Verify Account</h2> 
                    <small class="text-muteds">We will send a verification code on your email to verify your account.</small>
                    <hr>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                  <div class="col-lg-12">
                    <label class="cs-shop-label">Email *</label>
                    <input type="email" class="cs-form_field" name="email" required>
                  </div>
                  
                <div class="row">
                    
                </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <div id="submittingMessage" style="display: none;">Submitting...</div>
                    <button class="cs-btn cs-style1" type="submit" name="SENDCODE">
                      <span>Verify Account</span>
                      <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg>                
                    </button>
                  </div> <!-- Col-12 ends -->
                   
                  
                </form>
            <?php }else{ ?>
                <form action="" method="post">
                        <h2>Verify Account</h2> 
                        <hr>
                    <div class="row">    
                      <div class="col-lg-12">
                            
                        <div class="cs-height_20 cs-height_lg_20"></div>
                        <label class="cs-shop-label">Enter Verification Code *</label>
                        <input type="text" class="cs-form_field" name="VCode" placeholder="Enter a 6 Digits Code" required>
                      </div>
                      
                      <div class="col-lg-12 col-md-12">
                          <button id="resend-btn" onclick="resendOTP()" type="button" style="font-size: 12px; background: none; padding: 2px 5px; border-radius: 5px; text-transform: capitalize;">Resend OTP</button> 
                      </div>
                      
                      
                    </div> 
                    
                    <div class="row">
                        
                      <div class="col-lg-12 col-md-12">
                        <div class="cs-height_20 cs-height_lg_20"></div>
                        <button class="cs-btn cs-style1" type="submit" name="VerifyAccount">
                          <span>Submit</span>
                          <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                          </svg>                
                        </button>
                      </div> <!-- Col-12 ends -->
                      
                    </div>
                    
                </form>
            
            <?php } ?>
                  
                  
                  </div>
                  <div class="cs-height_30 cs-height_lg_30"></div>
                  
                </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function resendOTP() {
            $.ajax({
                type: 'POST',
                url: 'resend_otp.php',
                success: function (response) {
                    if (response.status === 'success') {
                        startResend();
                    } else {
                        alert('Error: ' + response);
                    }
                },
                error: function () {
                    alert('Error: Something Went Wrong!');
                }
            });
        }
        
        function startResend() {
            // Disable the button
            var button = document.getElementById('resend-btn');
            button.disabled = true;
    
            // Start the timer
            var seconds = 30;
            var timer = setInterval(function () {
                document.getElementById('resend-btn').innerHTML = 'Resend OTP in ' + seconds + ' seconds';
                seconds--;
    
                if (seconds < 0) {
                    clearInterval(timer);
                    // Re-enable the button after 15 seconds
                    button.disabled = false;
                    button.innerHTML = 'Resend OTP'; 
                }
            }, 1000);
        }
    </script>
    
  <!-- Start CTA -->
  <?php include('footer.top.php');?>
     
    
  </body>
</html>