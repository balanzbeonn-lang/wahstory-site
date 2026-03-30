<?php 
    session_start(); 
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    include('update/inc/class.customuse.php');
    $csObj = new CustomUtility();
    
    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    } 
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']); 

    $error_msg = '';
    
    if(isset($_POST['ApplyCoupon']) && $_POST['couponcode'] != '') {
        $response = $csObj->MakePaymentWithDiscCode($Userrow['ClubId'], $_POST['couponcode'], $amount);
        
        if($response == 'success') {
            echo '<script>window.location.href="/users/";</script>';
            
        }elseif($response == 'error') {
            $error_msg = '<p class="text-danger">Invalid Or Expired Code!.</p>';
        } else {
            $error_msg = '<p class="text-danger">Invalid Or Expired Code!</p>';
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
    
  <title>My Dashboard | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
  
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 

 
 <style>
 
     .single-post-content p b{
         color: #d1d1d1;
     } 
     .social-recent-posts .cs-post .cs-post_thumb{
        height: 300px;
        width: 350px;
     }
     
     .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #e9204f;
    }
    .nav-link{
        color: #999696;
        padding: 5px 15px;
    }
    .nav-link:focus, .nav-link:hover{
        color: #e9204f;
    }
    
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{ 
    	background: none;
        border-bottom: 2px solid #e9204f;
        border-radius: 0px;
        color: #e9204f;
        font-weight: 700;
	}
	.cs-post.cs-style1 .cs-post_info{
	    padding: 35px 25px 0px 25px;
	}
	.cs-post.cs-style1 .cs-post_info p span{
	    font-size: 14px;
	    padding-right: 20px;
	}
    .planCard {
      background: black;
      border: 2px solid white;
      border-radius: 30px;
      margin-bottom: 20px;
      cursor:pointer;
      user-select:none;
      transition: background-color 0.5s ease, transform 0.3s ease, border-color 0.5s ease; 
      will-change: transform, border-color;
      box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
      position: relative;
      overflow: hidden;
      
    }


    .planCard .card-header {
      padding-top: 20px;
      border-bottom: 2px solid white;
    }
    
    .upperhead {
      color: white;
      font-size: 30px;
      padding: 10px 0 20px;
    }
    
    
    
    .lowerhead {
      color: white;
      font-size: 18px;
      padding-bottom: 5px;
    }
    
    .lowerhead span{
        font-size:30px;
    }
    
    #chooseYourPlan {
      margin-bottom: 20px;
      font-size: 36px;
    }
    
    .check {
      padding-right: 5px;
      color: #e9204f;
      transition: color 0.5s ease;
    }
    
    .includes {
      padding: 15px 0;
      font-size: 16px;
      border-bottom: 1px solid gray;
      color: white;
    }
    
    .planCard:hover {
      background: rgb(0,0,0);
    background: linear-gradient(0deg, rgba(0,0,0,1) 14%, rgba(233,32,79,1) 100%);
    transform: scale(1.01); 
      border-color: #e9204f; 
      box-shadow: 0 8px 16px rgba(233, 32, 79, 0.5);
    }
    
    
    .planCard:hover .check {
      color: white;
    }
    
    .planCard .card-body {
      transition: background-color 0.5s ease;
    }
    
    .bestValueBand {
      position: absolute;
      top: 18px;
      right:-32px;
      background-color: #e9204f;
      color: white;
      padding: 5px 40px;
      font-size: 14px;
      transform: rotate(40deg); 
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.3); 
    }
    
    .icon-div{
        
        display:flex;
        justify-content:center;
        background:none; !important
        /*width:-10px; !important*/
         padding:20px; !important
    }
    /*.icon-btn{
        width:-20px; !important
        border-radius:60px; !important
       
       
        
        
    }*/
    
    .cs-site_branding img {
        max-height: 40px;
    }
    
 </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    </head>
    <body>
 
   <!-- End Hero -->
  <div class="cs-height_10 cs-height_lg_10"></div>
  <div class="container">
     <!--<div class="cs-height_0 cs-height_lg_40"></div>-->
     <!--<div class="cs-height_30 cs-height_lg_30"></div>-->

<div class="row">
    <div class="col-lg-12  text-center">
            <a class="cs-site_branding text-center" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
              </a>
        
            <div class="cs-height_10 cs-height_lg_10"></div>
      </div>
      
  <div class="col-lg-12">
    <h4 class="text-center" id="chooseYourPlan">Unlock Premium Features</h4>
    <div class="row">
      <!-- Basic Plan -->
        <div class="col-lg-2">
          <a href="/users/" class="small"><i class="fa fa-arrow-left"></i> Dashboard</a>
        </div>
   
      <!-- Standard Plan -->
      <div class="col-lg-4 offset-lg-2">
          
        
        
        <!--<div class="p-2">
            <form method="POST" action="">
                
                <?php if(isset($error_msg)) { echo $error_msg;  }?>
                
                <a href="javascript:void(0);" id="couponcodelabel" align="center" style=" font-size: 22px; font-weight: 700; ">Have a coupon code? Enter.</a>
                <br>
                <br>
                <div class="row" id="couponcodefield" style="display: none">
                    <div class="col-md-8 mb-2">
                        <div class="form-group">
                            <input type="text" class="cs-form_field py-1" name="couponcode" placeholder="Enter Code" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="submit" name="ApplyCoupon" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </form>
        </div>-->
           
          
        <div class="card planCard" id="plancard">
            
          <div class="card-header">
            
            <div class="text-center upperhead">Subscription Fee</div>
            <div class="text-center lowerhead"><span style="text-decoration: line-through;color: #c7c5c5;font-size: 22px;">$499</span> <span>$299</span><sub>/Month</sub></div>
            
          </div>
          <div class="card-body">
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Setup Calendar & Availability:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>View Booking/Meeting Details:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Book Meetings with Other Members:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Live Chat (One-to-One & Group Chat):</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Connection Feature (Follow):</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Build Network (Followers):</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>10-Second Intro Video on Portfolio:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Full Access to “Let's Work Together” Enquiries:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Send “Let's Work Together” Enquiries:</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>NFC Card Linked to Portfolio:</span></div>
            
          </div>
          <div class="bestValueBand">Best Value</div>
          <div class="icon-div" onclick='window.location.href="subplan.checkout.php?checkout=premium_plan"'>
                <span class="cs-btn cs-style1 mb-2 w-100 mx-2">
                    UPGRADE  &nbsp; 
                   <i class="fa fa-arrow-right"></i>
                </span>
           </div>
        </div>
        
        
        
        
      </div>
       
    </div>
  </div> <!-- Col Ends -->
</div> <!-- Row Ends -->

<?php 
    if(isset($_GET['clubid'])) {
?>
    <input type="hidden" id="clubuserid" value="<?=$_GET['clubid'];?>">
    <input type="hidden" id="rurl" value="<?=$_GET['rurl'];?>">
<?php } ?>
    
  </div> 
   
   <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
    
    <script>
        $(document).ready(function(){
            //  plancard 
            /*$('#plancard').click(function(){
                var clubuserid = $('#clubuserid').val();
                var rurl = $('#rurl').val();
                window.location.href="subscriptionplan.php?rurl=" + rurl + '&&user=' + clubuserid;
            });
            */
            $('#couponcodelabel').click(function(){
                $('#couponcodefield').toggle();
            })
            
            
        });
    </script>
        
        </body>
    </html>