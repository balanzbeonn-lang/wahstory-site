<?php 
session_start();

if(!isset($_GET['token']) && $_GET['token'] == ''){
        header('location: login.php');
    }
    
 //If Your Session Token Match with URLs Token
if($_GET['token'] === $_SESSION['resetPass_token']){

    include('inc/functions.php');
    $postObj = new Story();
    
      
    if(isset($_POST['ChangePassword'])){
        
        $_SESSION['response'] = $postObj->ChangePassword($_POST["password"]);
        
        switch($_SESSION['response']){ 
            case 'success':
                $SucMessage = 'Great, Your Password has changed successfully! Login now';
                header('location: login.php?sucmessage='.$SucMessage);
                break;
            case 'error':
                $ErrMessage = 'Something went wrong, try again...';
                default :
                $ErrMessage = 'Something went wrong, try again...'; 
          }
          
          unset($_SESSION['response']);
    }
    
?><!DOCTYPE html>
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
  <title>Reset Password | WAHStory</title>
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
            <form action="" method="post">
                <div class="cs-shop-side-spacing">
                  <div class="cs-shop-card">
                      
            
            <?php if(isset($ErrMessage)){ ?>
                <p style="color: #e9204f; font-size: 15px;"><i class="fa fa-times-circle"></i> &nbsp;<?=$ErrMessage?></p>
            <?php } ?>
            
            <?php if(isset($SucMessage)){ ?>
                <p style="color: #10cd80; font-size: 15px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$SucMessage?></p>
            <?php }else{ ?>     
                    <h2>Create a new password</h2> 
                    <hr>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    
                  <div class="col-lg-12">
                    <label class="cs-shop-label">New Password *</label>
                    <input type="password" class="cs-form_field" name="password" required>
                  </div>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                  <div class="col-lg-12">
                    <label class="cs-shop-label">Confirm Password *</label>
                    <input type="password" class="cs-form_field" name="password2" required>
                  </div>
                  
                <div class="row">
                    
                </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <button class="cs-btn cs-style1" type="submit" name="ChangePassword">
                      <span>Create Password</span>
                      <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg>                
                    </button>
                  </div> <!-- Col-12 ends -->
                  
                  <div class="col-lg-12 col-md-12">
                      <p style="font-size: 13px;margin-bottom: 0px;margin-top: 5px;">Don't want to reset password? <a href="login.php">Login</a></p>
                  </div>
            <?php } ?>      
                  </div>
                  <div class="cs-height_30 cs-height_lg_30"></div>
                  
                </div> 
            </form>
             
            
            
            
        </div>
        
        
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
  
  
  <!-- Start CTA -->
  
  <?php include('footer.top.php');?>
     
    
  </body>
</html>
  
  <?php }else{ header('location: forgotpass.php?errmessage=Invalid Token, kindly request again...'); } ?>
  