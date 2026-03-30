<?php 
session_start();

    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){ 
        echo '<script>window.location.href="/users/";</script>';
        exit();
    }

    include('inc/functions.php');
    $postObj = new Story(); 
    
    if(isset($_POST['VerifyAccount'])){
        $response = $postObj->VerifyAccountWithOTP($_POST['VCode'], $_SESSION['UEmail']);
        
        switch($response){
                case 'SUCCESS':
                $sucmessage = "Thankyou, Your account has been verified successfully. Login Now.";
                //Unset All Sessions
                unset($_SESSION['UEmail']);
                unset($_SESSION['UName']);
                unset($_SESSION['Mailotp']);
                unset($_SESSION['Mailotp_time']);
                unset($_SESSION['PENDING_VERIFICATION']);
                // header("Location: login.php?sucmessage=".$sucmessage);
                echo '<script>window.location.href="login.php?sucmessage='.$sucmessage.'";</script>';
                break;
                case 'ERROR':
                $ErrorMessage = "Invalid Or Expired Otp";
                $_SESSION['PENDING_VERIFICATION'] = 1;
                break;
                case 'ERROR1':
                $ErrorMessage = "Invalid Or Expired Otp";
                $_SESSION['PENDING_VERIFICATION'] = 1;
                break;
            }
        
    }
    if(isset($_POST['RegisterUser'])){
        
      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            
        $AlreadyRegister = $postObj->ChkIfAlreadyRegistered($_POST['email']);
        if($AlreadyRegister === FALSE){
            $UserRegistered = $postObj->RegisterUser();
            
            switch($UserRegistered){
                case 'Success':
                $RegisterMessage = "Congratulations, you've done it! A verification code has been sent to your email. Please check your inbox, and if you don’t see it, kindly check your spam folder.";
                $_SESSION['PENDING_VERIFICATION'] = 1;
                break;
                case 'Error':
                $ErrorMessage = "Something Went Wrong! Please try again.";
                break;
            }
        }else{
            $AlreadyRegistered = "You already have an account with the same email. Try to login once.";
        }
        
        
      } else{
            $ErrorMessage = "Please select Google reCAPTCHA, and try again...";
      }
        
        
    }
    
?><!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="WAHStory">
  <!-- Favicon Icon -->
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    <meta name="theme-color" content="#181818" />
  <!-- Site Title -->
  <title>Create Account | WAHStory</title>
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     
	.iti__country-list{
	    background: #2d2a2a !important;
	}
	.title-border {
        position: relative;
        z-index: 1;
    }
    .separator {
        text-align: center;
    }
    .separator span {
        background-color: #000;
        font-size: 18px;
        color: #989898;
        font-weight: 500;
        display: inline-block;
        text-align: center;
        margin: 35px 0;
        padding: 0 20px;
    }
    
    .title-border:after {
        content: "";
        height: 1px;
        width: 100%;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        border: 1px solid #282828;
        z-index: -1;
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
            <?php if(isset($AlreadyRegistered)){ ?>
                <p style="color: #e9204f; font-size: 14px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$AlreadyRegistered?></p>
            <?php } ?>
            <?php if(isset($ErrorMessage)){ ?>
                <p style="color: #e9204f; font-size: 14px;"><i class="fa fa-times-circle"></i> &nbsp;<?=$ErrorMessage?></p>
            <?php } ?>
            <?php if(isset($RegisterMessage)){ ?>
                <p style="color: #10cd80; font-size: 15px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$RegisterMessage?></p>
                
            <?php  if(isset($_GET['rurl']) && $_GET['rurl'] != ''){ ?>
                <a href="<?=$_GET['rurl'];?>"><i class="fa fa-arrow-left"></i> Back to Story</a>
                
            <?php } } ?>
            
            <?php if(!isset($_SESSION['PENDING_VERIFICATION'])){  ?>
            <form action="" method="post" id="createaccount">
                    <h2>Create Account</h2> 
                    <hr>
                 <div class="row">  
                    <div class="col-lg-6">
                        
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    
                    <label class="cs-shop-label">Full Name *</label>
                    <input type="text" class="cs-form_field" name="name" required>
                  </div>
                  
                  <div class="col-lg-6">
                        
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <label class="cs-shop-label">Phone *</label>
                    <input type="tel" class="cs-form_field" name="phone" id="phonefield">
                    <input type="hidden" class="cs-form_field" name="phoneCode" id="phoneCodefield">
                    <span id="phoneError" style="color:red; font-size: 12px;"></span> 
                  </div>
                  
                </div>
                
                <div class="row">    
                  <div class="col-lg-12">
                        
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <label class="cs-shop-label">Email *</label>
                    <input type="email" class="cs-form_field" name="email" required>
                  </div>
                </div> 
                
                <div class="row">  
                  <div class="col-lg-12">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    
                    <label class="cs-shop-label">Password *</label>
                    <div class="form-group p-relative">
                        <input type="password" class="cs-form_field" name="password" id="password" minlength="8" maxlength="20" required>
                        <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; position: absolute; right: 15px; top: 15px;"></i>
                    </div>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-lg-12">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <label class="cs-shop-label">LinkedIn OR Instagram OR Website Link - Any One</label>
                    <input type="url" class="cs-form_field" name="linkedin">
                    <span style="color: #989898; font-size: 12px;"><strong>Note:</strong> Please Enter Complete URL Like https://www.example.com/profile</span>
                  </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-lg-12">
        			    <div class="g-recaptcha" data-sitekey="6LfD06weAAAAAOjL1EFxao0cMF8c-caJNaKAY9PD"></div>    
        			</div>
                    
                  <div class="col-lg-12 col-md-12">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <button class="cs-btn cs-style1" type="submit" name="RegisterUser">
                      <span>Create Account</span>
                      <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg>                
                    </button>
                  </div> <!-- Col-12 ends -->
                  
                  <div class="col-lg-12 col-md-12">
                      <p style="font-size: 13px;margin-bottom: 0px;margin-top: 5px;">Already have an account? <a href="login<?php if(isset($_GET['rurl']) && $_GET['rurl'] != ''){ echo '?rurl='.$_GET['rurl'];}?>">Login</a></p>
                  </div>
                  
                  <div class=" col-lg-12 col-md-12">
                      <div class="separator title-border">
                        <span>Or</span>
                      </div>
                  </div>
                  
                   <div class=" col-lg-12 col-md-12 my-2 text-center">
                    <a href="https://www.wahstory.com/linkedin-auth.php" class="btn btn-primary">
                      <i class="fab fa-linkedin"></i>  Sign up with LinkedIn
                    </a>
                      
                  </div>
                  
                  
                   
                </div>
                
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
                </div> 
                
                <div class="row">
                
                  <div class="col-lg-12 col-md-12">
                      <button id="resend-btn" onclick="resendOTP()" type="button" style="font-size: 12px; background: none; padding: 2px 5px; border-radius: 5px; text-transform: capitalize;">Resend OTP</button> 
                  </div>
                  
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
  
     $(document).ready(function() {
        function validatePhoneNumber(phone) {
            var phoneRegex = /^(?:\+?(\d{1,3}))?[-.●]?((?:\d{1,4}[-.●]?){1,3})(\d{4})(?:[-.●]?(\d{1,4}))?$/;
            return phoneRegex.test(phone);
        }
    
        $('#phonefield').on('blur', function() {
            var phone = $(this).val();
            var phoneError = $('#phoneError');
    
            // Clear any previous error message
            phoneError.text('');
    
            // Validate phone number format
            if (!validatePhoneNumber(phone)) {
                phoneError.text('Invalid phone number.');
            }
        }); 
    
        $('#createaccount').on('submit', function(event) {
            var phone = $('#phonefield').val();
            var phoneError = $('#phoneError');
    
            // Clear any previous error message
            phoneError.text(''); 
    
            // Validate phone number format
            if (!validatePhoneNumber(phone)) {
                phoneError.text('Invalid phone number.');
                $('#phonefield').focus();
                event.preventDefault(); // Prevent form submission
            }
        });
        
    
        
        var togglePassword = document.querySelector('#togglePassword');
        var password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        
        
        
    });

  
  </script>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
        
     <script>
        var input = document.querySelector("#phonefield");
        const phoneInput = window.intlTelInput(input, {
            geoIpLookup: function(success, failure) {
                fetch('https://ipinfo.io/json', { headers: { 'Accept': 'application/json' }})
                    .then(function(response) {
                        if (response.ok) return response.json();
                        throw new Error('Failed to fetch IP info');
                    })
                    .then(function(ipinfo) {
                        var countryCode = (ipinfo && ipinfo.country) ? ipinfo.country : 'us';
                        success(countryCode);
                    })
                    .catch(function() {
                        success('us');
                    });
            },
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js" // for formatting/validation etc.
        });
        
         function printSelectedCountryCode() {
            const selectedCountryData = phoneInput.getSelectedCountryData();
            // selectedCountryData.dialCode;
            var phoneCodeINP = document.getElementById("phoneCodefield");
            
            phoneCodeINP.value = selectedCountryData.dialCode;
        }
        
         const inputElement = document.getElementById('phonefield');
            inputElement.addEventListener('countrychange', printSelectedCountryCode);
            
            


    </script>
    
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
  
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  <!-- Start CTA -->
 <?php include('footer.top.php');?>
     
    
  </body>
</html>