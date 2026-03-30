<?php 
session_start();

    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){ 
        echo '<script>window.location.href="/users/";</script>';
        exit();
    }
    
    include('inc/functions.php');
    $postObj = new Story();
    
    
      
    if(isset($_POST['LOGINUser'], $_POST["loginemail"], $_POST["loginpass"])){
        
        $response = $postObj->Userlogin($_POST["loginemail"], $_POST["loginpass"]);
    }
     
    if (isset($response)){
        if($response['login_status'] === 'Success') {
            
            if(isset($_GET['rurl']) && $_GET['rurl'] != ''){
                header("Location: ".$_GET['rurl']);  
            }else{
              header("Location: /users/");  
            }
            
            exit();
        } elseif ($response['login_status'] === 'Error') {
            
            $errorMessage = $response['errmsg'];
        }
        
    }
    
    
    if (isset($_GET['login_status'])) {
        if ($_GET['login_status'] === 'Success') {
            if (isset($_GET['rurl']) && $_GET['rurl'] != '') {
                header("Location: " . $_GET['rurl']);
            } else {
                header("Location: /users/");
            }
            exit();
        } elseif ($_GET['login_status'] === 'Error') {
            $errorMessage = $_GET['errmsg'];
        }
    }
    
    
    
    if (!isset($response)){
        
            // Handle AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
        
            if (isset($data['email']) && !empty($data['email'])) {
                // Attempt to log in the user
                $resp = $postObj->UserloginWithSocial($data['email']);
        
                // Log response from UserloginWithGoogle for debugging
                // error_log('UserloginWithGoogle response: ' . $resp);
        
                if ($resp['login_status'] == "Success") {
                    // Send back success response
                    echo json_encode(['status' => 'success']);
                } else {
                   $errorMessage = $response['errmsg'];
                }
            } else {
                echo json_encode(['status' => 'failure', 'message' => 'Account Not Found']);
            }
            exit();
        }
    
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
  <title>Login | WAHStory</title>
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 
 <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        function handleCredentialResponse(response) {
            const responsePayload = decodeJwtResponse(response.credential);
            
            // Send user data to PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle response from the server
                    const serverResponse = JSON.parse(xhr.responseText);
                    //   console.log(serverResponse);
                    if (serverResponse.status === 'success') {
                        // Redirect to user page
                        window.location.href = '/users/';
                    } else {
                        // console.log('Redirecting to login page with error message');
                        window.location.href = '/login.php?login_status=Error&errmsg=' + encodeURIComponent('Account Not Found');

                    }
                }
            };
            xhr.send(JSON.stringify(responsePayload));
        }

        function decodeJwtResponse(token) {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));

            return JSON.parse(jsonPayload);
        }
    </script>
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
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
    
    .g_id_signin{
        display: flex;
        align-items: center;
        justify-content: center;
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
                      
                <?php if(isset($errorMessage)){ ?>
                    <p style="color: #e9204f; font-size: 15px;"><i class="fa fa-times-circle"></i> &nbsp;<?=$errorMessage?></p>
                <?php } ?>
                <?php if(isset($_GET['sucmessage'])){ ?>
                    <p style="color: #10cd80; font-size: 15px;"><i class="fa fa-check-circle"></i> &nbsp;<?=$_GET['sucmessage']?></p>
                <?php } ?>
                      
                    <h2>Login</h2> 
                    <hr>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                  <div class="col-lg-12">
                    <label class="cs-shop-label">Email *</label>
                    <input type="email" class="cs-form_field" name="loginemail" required>
                  </div>
                  
                  <div class="cs-height_20 cs-height_lg_20"></div>
                  
                  <div class="col-lg-12">
                    <label class="cs-shop-label">Password *</label>
                    
                    <div class="form-group p-relative">
                        <input type="password" class="cs-form_field" name="loginpass" id="password" required>
                        <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; position: absolute; right: 15px; top: 15px;"></i>
                    </div>
                        
                    <div style="text-align: right;">
                        <a href="forgotpass.php" style="font-size: 13px;">Forgot Password</a>
                    </div>
                    
                  </div>
                
                
                  <div class="col-lg-12 col-md-12">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <button class="cs-btn cs-style1" type="submit" name="LOGINUser">
                      <span>Login</span>
                      <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg>                
                    </button>
                  </div> <!-- Col-12 ends -->
                  
                  <div class="col-lg-12 col-md-12">
                      <p style="font-size: 13px;margin-bottom: 0px;margin-top: 5px;">Don't have an account? <a href="createaccount<?php if(isset($_GET['rurl']) && $_GET['rurl'] != ''){ echo '?rurl='.$_GET['rurl'];}?>">Create One</a></p>
                  </div>
                  
                  <div class=" col-lg-12 col-md-12">
                      <div class="separator title-border">
                        <span>Or</span>
                      </div>
                  </div>
                  
        <div class="row">
                  <div class=" col-lg-12 col-md-12 my-2">
                      <div id="g_id_onload"
        data-client_id="678125914070-9vkfumkdq8r1jue9imnhlra72mo10fi7.apps.googleusercontent.com"
        data-callback="handleCredentialResponse">
    </div>
    <div class="g_id_signin" data-type="standard"></div>
                       
                  </div>
                  
                  <div class=" col-lg-12 col-md-12 my-2 text-center">
                    <a href="https://www.wahstory.com/linkedin-auth.php" class="btn btn-primary">
                      <i class="fab fa-linkedin"></i>  Sign in with LinkedIn
                    </a>
                      
                  </div>
        
        </div>
                  
                   
                  
                  </div>
                  <div class="cs-height_30 cs-height_lg_30"></div>
                  
                </div> 
            </form>
             
            
            
            
        </div>
        
        
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
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
  <!-- Start CTA -->
  
  <?php include('footer.top.php');?>
     
    
  </body>
</html>