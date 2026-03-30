<?php 
session_start(); 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

echo '<script>window.location.href="/createaccount/";</script>';
        exit();

    include('inc/functions.php');
    $postObj = new Story(); 
    $response = 0;
    if(isset($_POST["SUBMITCONTACT"])){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $_SESSION['response'] = $postObj->PostWahclubPreForm();
            
            if($_SESSION['response'] === 'Success'){
                header('location: /wahclub/build-my-presence/'.$_SESSION['club_userid']);
            }
        }else{
            $_SESSION['response'] = "InvalidreCAPTCHA";
        }
    }
    
    
    
?> 
<!DOCTYPE html>
<html class="no-js" lang="en">
<head> 
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
    <meta name="description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders."/>
    
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#E9204F" />
    <meta name="abstract" content="Engage with talented writers and embark on a journey to share your own creative stories on our storytelling platform. Explore a diverse collection of narratives that captivate and inspire.">
    <meta name="topic" content="storytelling, Founders, Diversity and Inclusion, HR, Powerful Lessons, Author, Life Mantra, Mentor, Setbacks to Success"> 
    <meta name="Classification" content="Sucess Stories">
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory">
    <meta name="url" content="https://www.wahstory.com/getmeinwahclub">
    <meta name="identifier-URL" content="https://www.wahstory.com/getmeinwahclub">
    <meta name="directory" content="Get Me in WAHClub">
    <meta name="category" content="Her Story, Game Changer, Pride Story, Living Well, Passion Story">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/getmeinwahclub" />
    <!-- Site Title -->
    <title>WAHStory | WAHClub</title>
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="WAHStory | Get Me in WAHClub">
    <meta name="og:description" content="Get Me in WAHClub on WAHStory.com">
    <meta property="og:url" content="https://www.wahstory.com/getmeinwahclub" />
    <meta property="og:site_name" content="WahStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/logos/logo-light.png" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
    <meta property="og:image:type" content="image/png" />
    
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     #message-wrapper{
         display: none;
         align-items: center;
        justify-content: center;
        height: 100%;
     }
     #successMessage{
         color: #fff;
         font-size: 20px;
         text-align: center;
         line-height: 45px;
         position: relative;
     }
     #successMessage .icon{
        animation: bounceAnimation 2s ease-in-out;
         
     }
     
     @keyframes bounceAnimation {
    0%, 100% {
        top: 0;
        transform: translateY(0);
    }
    50% {
        top: calc(100% - 40px);
        transform: translateY(-100%);
    }
}

#otpfield, #verifyemail, #verifyotp, #verifyemailsucmsg, #verifyiedemail, #validotp, #otherfields {
    display: none;
}
 
 
  .tj-header-area {
      padding: 20px 0 0px;
    }

   .iti__country-list{
      background: #2d2a2a !important;

    }
     .iti {
      display: block;
      width: 100%;
    }
     
 </style> 
 
 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="assets/images/page-title-bg.jpeg">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color"> REGISTER FOR WAHCLUB</h1> 
        <ol class="breadcrumb text-uppercase">
            <li class="breadcrumb-item">
              <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">Register Now </li>
          </ol>
      </div>
    </div>
  </div>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  
  <div class="container">
    <div class="row">
       
      <div class="col-lg-12">
          
          <div id="message-wrapper" <?php if($_SESSION['response'] === 'Success'){ ?>style="display: flex;"<?php } ?>>
                <div id="successMessage">
                  <div class="icon">
                    <svg width="50" height="50" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="10" cy="10" r="9" stroke="#e9204f" stroke-width="2" fill="none" />
                      <path d="M6 10.5L8.5 13L14 7.5" stroke="#e9204f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> 
                  </div>
                  <p style="font-size: 20px;">Thank you for showing your interest in joining WAHClub! We will share the next steps soon.</p>
              </div>
          </div> 
          
      </div> 
      
      <div class="col-lg-2"></div> 
      <div class="col-lg-8">
          
          
          
        <form id="contact-form" action="" method="POST" class="row" <?php if($_SESSION['response'] === 'Success'){ ?>style="display: none;"<?php } ?>>
          <div class="col-sm-12">
             <?php if(isset($_SESSION['response']) && $_SESSION['response'] === "InvalidreCAPTCHA"){?>
                <p style="color: #e9204f;"> <i class="fa fa-times-circle"></i> Please select Google reCAPTCHA, and try again... </p>
             <?php }elseif($_SESSION['response'] === "Error"){?>
              <p style="color: #e9204f;"> <i class="fa fa-times-circle"></i> Something went wrong, please try again...</p>
              <?php } ?> 
              
              <!--<h3 class="cs-section_title mb-2">REGISTRATION FORM</h3>-->
              <!--<hr class="mt-1 mb-4">-->
          </div>
          
           
                      
          <div class="col-sm-6">
            <label class="cs-primary_color">First Name*</label>
            <input type="text" class="cs-form_field" id="fname" name="fname" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-sm-6">
            <label class="cs-primary_color">Last Name*</label>
            <input type="text" class="cs-form_field" id="lname" name="lname" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-sm-6">
            <label class="cs-primary_color">Phone *</label><br>
            <input type="tel" class="cs-form_field" name="phone" id="phone" minlength="10" maxlength="15" pattern="^\+?[0-9\s\-]{10,15}$" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-6">
            <label class="cs-primary_color">Email*</label>
            <input type="hidden" id="dialCode" name="dialCode"> 
            <input type="email" id="email" class="cs-form_field" name="email" required>
            <a href="javascript:void(0);" style="font-size: 11px; padding: 2px 6px;border-radius: 5px;" class="cs-btn cs-style1" id="verifyemail">Verify Email</a> 
            <span class="text-success" style="font-size: 13px;" id="verifyemailsucmsg">A verification code has been sent to your email. <br> Check your spam or junk folder if it's not in your inbox.</span>
            <span class="text-success" style="font-size: 11px; font-weight: 700;" id="verifyiedemail">Verified <i class="fa fa-check"></i></span>
            
            <span class="text-danger" style="font-size: 11px;" id="result"></span>
            
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-12" id="otpfield">
            <label class="cs-primary_color">Otp *</label>
            <input type="text" class="cs-form_field" name="otp" id="otpinput" placeholder="Enter 6 digit OTP"> 
            <a href="javascript:void(0);" style="font-size: 11px; padding: 2px 6px;border-radius: 5px;" class="cs-btn cs-style1" id="verifyotp">Verify Otp</a>
            
            <span class="text-success" style="font-size: 11px; font-weight: 700;" id="validotp">Done <i class="fa fa-check"></i></span>
            
            <span class="text-danger" style="font-size: 11px;" id="otpresult"></span>
            
            
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          
            <div class="col-sm-12 text-center">
              
              <button class="cs-btn cs-style1" id="disabledButton" type="button" style="opacity: .3;
    cursor: not-allowed;" disabled>
                  <span>Submit</span>
                  <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg>                
                </button>
              
            </div>
          <div class="col-sm-12" id="otherfields">
            <label class="cs-primary_color">Link of any one social media handle *</label>
            <input type="url" class="cs-form_field" name="socialid" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
            
            <input type="checkbox" id="agree" name="agree" value="1" class="form-checkbox required form-check-input" required="required">
            <label class="form-check-label" for="agree">
                I agree to <a href="/termsandconditions">WAHClub's Terms and Conditions</a> and acknowledge that I have read the <a href="/privacy.policy">Privacy Policy</a>.
            </label>
            
          
			    <div class="g-recaptcha" data-sitekey="6LfD06weAAAAAOjL1EFxao0cMF8c-caJNaKAY9PD"></div>    
		 
            <button class="cs-btn cs-style1" type="submit" id="SUBMITCONTACT" name="SUBMITCONTACT">
              <span>Submit</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
              </svg>                
            </button>
            <div id="cs-result"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
<?php if(isset($_SESSION['response'])){ unset($_SESSION['response']);} ?>
  
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  
  <script>
    document.getElementById("contact-form").onsubmit = function() {
        document.getElementById("SUBMITCONTACT").style.display = "none";
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
    
    
    $('#email').on('input', function() {
        var email = $(this).val().trim();
        
        // Basic email validation
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (emailPattern.test(email)) {
            // Display the element with id="btnhide" if email is valid
            $('#verifyemail').css('display', 'inline-block');
        } else {
            // Hide the element with id="btnhide" if email is not valid
            $('#verifyemail').css('display', 'none');
        }
    });
    
    
    $('#verifyemail').on('click', function() {
        // Manually collect form data and sanitize inputs
        var fname = $('#fname').val().trim();
        var lname = $('#lname').val().trim();
        var email = $('#email').val().trim();

        // Simple client-side validation to check for empty fields
        if (!fname || !lname || !email) {
            alert("All fields are required.");
            return;
        }

        // Basic email validation
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        var formdata = { 
            email: $('<div>').text(email).html() // Escaping potentially unsafe characters
        };

        $.ajax({
            type: 'POST',
            url: 'postactions.php?sendotp', // Replace with your server endpoint
            data: formdata, // Pass the form data
            dataType: 'json', // Expect JSON response for better security
            success: function(response) {
                // Handle server response securely
                if (response) {
                    
                    if(response.status === "Success") {
                            // alert(response.message);
                            
                            // Verify button display none:
                            $('#verifyemail').css('display', 'none');
                            $('#verifyemailsucmsg').css('display', 'block');
                            $('#otpfield').css('display', 'block');
                              
                    }else {
                        $('#result').html("Error: " + response.message);
                    }
                    
                } else {
                    $('#result').html("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#result').html('An error occurred. Please try again.');
            }
        });
    });
    
    
    
    
    //Enter OTP:
    
    $('#otpinput').on('input', function() {
        var otp = $(this).val().trim();
         
        if (otp) {
            // Display the element with id="btnhide" if email is valid
            $('#verifyotp').css('display', 'inline-block');
        } else {
            // Hide the element with id="btnhide" if email is not valid
            $('#verifyotp').css('display', 'none');
        }
    });
    
    
    
     $('#verifyotp').on('click', function() {
         
         var otpnum = $('#otpinput').val().trim();
         var email = $('#email').val().trim();
         
         var formdata2 = { 
            otpnum: otpnum,
            email: email
        };
         
         $.ajax({
            type: 'POST',
            url: 'postactions.php?submitotp', // Replace with your server endpoint
            data: formdata2, // Pass the form data
            dataType: 'json', // Expect JSON response for better security
            success: function(response) {
                // Handle server response securely
                if (response) {
                    
                    if(response.status === "Verified") {
                            // alert(response.message);
                            
                            //On Otp Verify
                        $('#disabledButton').css('display', 'none');
                        $('#verifyotp').css('display', 'none');
                        $('#verifyemailsucmsg').css('display', 'none');
                        $('#verifyiedemail').css('display', 'inline-block');
                        $('#otpresult').css('display', 'none');
                        $('#validotp').css('display', 'inline-block');
                        $('#otherfields').css('display', 'block');
                        
                    }else {
                        $('#otpresult').html("Error: " + response.message);
                    }
                    
                } else {
                    $('#otpresult').html("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#otpresult').html('An error occurred. Please try again.');
            }
        });
         
    });

});
</script>


  
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
 <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {            
            separateDialCode: true,
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
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js" // for formatting/validation etc.
        });

        input.addEventListener("countrychange", function() {
            var dialCode = iti.getSelectedCountryData().dialCode; 
            document.getElementById("dialCode").value = dialCode;  
        });
    </script>
  
  <?php include('footer.top.php');?>
     
    
  </body>
</html>