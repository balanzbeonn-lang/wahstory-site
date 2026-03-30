<?php 
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        header('location: /login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    if(isset($_POST['ChangePassword'])){
      if(isset($_SESSION['userid']) && $_SESSION['userid'] != ''){
        $_SESSION['responce'] = $postObj->ChangePassword($_POST['password'], $_SESSION['userid']);
      }
      
      
    } 
    switch($_SESSION['responce']){
        case 'SUCCESS':
            $message = 'Password changed successfully, login with your new password!';
            header('location: /login.php?sucmessage='.$message);
            break;
        case 'ERROR':
            $errmessage = 'Something went wrong, try again...';
            default :
            $errmessage = 'Something went wrong, try again...';   
    }
    unset($_SESSION['responce']); 
    
?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>My Profile | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     form#updateprofile label{
         font-size: 12px;
         margin-bottom: 5px;
     }
     form#updateprofile .cs-form_field{
         padding: 8px 20px;
     }
     
      #togglePassword{
        margin-left: -30px;
        position: absolute;
        cursor: pointer;
        margin-top: 15px;
        top: 0;
        right: 10px;
    }
    
    #togglePassword2{
        margin-left: -30px;
        position: absolute;
        cursor: pointer;
        margin-top: 15px;
        top: 0;
        right: 10px;
    }
    .input{
        position: relative;
    }

 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 <!-- Start Hero -->
   
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
           
        <div class="dashboard-left-menu">
            <div class="cs-shop_sidebar">
                <div class="cursor-pointer openleftmenu">
                   <i class="fa-solid fa-bars"></i>
                </div>
              <div class="cs-shop_sidebar_widget">
                <?php $Dmenu = 9;?>
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12"> 
              <h4 class="mb-2">Change Password</h4>
              <hr class="mb-4">
            </div>
         <form id="updateprofile" action="" method="POST"> 
        
        <div class="row"> 
          <div class="col-md-6"> 
            <label>New Password *</label>
            <div class="input">
                <input type="password" class="cs-form_field" name="password"  id="password" placeholder="Enter New Password" required="">
                <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
            </div>
            <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
          
          <div class="col-md-6"> 
            <label>Confirm Password *</label>
            <div class="input">
                <input type="password" class="cs-form_field" placeholder="Confirm your password" id="confirmPassword" required="">
                <i class="fa fa-eye" id="togglePassword2" style="margin-left: -30px; cursor: pointer;"></i>
            </div>
            <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
           
          
        </div>
        
          <div class="col-lg-12">  
          
            <div class="cs-height_10 cs-height_lg_10"></div>
            <button class="cs-btn cs-style1" type="submit" name="ChangePassword" id="changePasswordBtn">
              <span id="buttonText">Change</span>
              <span id="buttonSpinner" style="display:none;">
                <i class="fa fa-spinner fa-spin"></i>
              </span>
            </button>
            <input type="hidden" name="ChangePassword" value="1">
            <div id="cs-result"></div>
          </div>
        </form> 
        
          </div> <!-- Row Ends-->
          
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
 <script type="text/javascript">

var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirmPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

</script>

 <script>
        var togglePassword = document.querySelector('#togglePassword');
        var togglePassword2 = document.querySelector('#togglePassword2');
      var password = document.querySelector('#password');
      var conpassword = document.querySelector('#confirmPassword');
     
      togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    
    togglePassword2.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = conpassword.getAttribute('type') === 'password' ? 'text' : 'password';
        conpassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    
   </script>
  
   
   <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
     
    
    <script>
        $(document).ready(function () {
            // Open Left Menu Of User Dashboard
            const openMenuBtn = document.querySelector('.openleftmenu');
            const openMenuBtnicon = document.querySelector('.openleftmenu i');
            const sidebar = document.querySelector('.dashboard-left-menu');
             
            openMenuBtn.addEventListener('click', function () {
                sidebar.classList.toggle('open'); 
                openMenuBtnicon.classList.toggle('fa-times'); 
            });
        });
    </script>
    
    <script>
      // Form submit handler to show loading spinner
      document.getElementById('updateprofile').addEventListener('submit', function() {
        // Get button elements
        const buttonText = document.getElementById('buttonText');
        const buttonSpinner = document.getElementById('buttonSpinner');
        
        // Show spinner, hide text
        buttonText.style.display = 'none';
        buttonSpinner.style.display = 'inline-block';
        
        // Allow form submission to continue
        return true;
      });
    </script>
        
        </body>
    </html>