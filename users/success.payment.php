<?php 
    session_start(); 
    
    if(!isset($_GET['coupon'])){
       echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
       exit();
    } 
    
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
    
    .cs-site_branding img {
        max-height: 40px;
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
      font-size: 25px;
    padding: 10px 10px 10px 10px;
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
      padding: 20px 0;
      font-size: 14px;
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
    
    
 </style>
 
 
    <!-- Script -->
    <script src="/assets/js/plugins/jquery-3.6.0.min.js"></script>
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    </head>
    <body>
        
   <!-- End Hero -->
  <div class="cs-height_10 cs-height_lg_10"></div>
  <div class="container">
          
    <div class="row">
      <div class="col-lg-12  text-center">
            <a class="cs-site_branding text-center" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
              </a>
        
            <div class="cs-height_10 cs-height_lg_10"></div>
      </div>
      <div class="col-lg-12">
         <div class="row">
          <!-- Basic Plan -->
            <div class="col-lg-2">
              <a href="/users/" class="small"><i class="fa fa-arrow-left"></i> Dashboard</a>
            </div>
       
          <!-- Standard Plan -->
          <div class="col-lg-4 offset-lg-2">
           
          
            <div class="card bg-black">
                <div class="card-header">
                    <div class="text-center upperhead h3"><i class="fa fa-check-circle text-success"></i> Payment Success</div>
                    <hr>
                </div>
                <div class="card-body">
                    <p style="font-size: 13px;">
                        Thank you! 
                        <br> 
                        You have successfully subscribed to the WAHClub Premium Plan. Since you applied a coupon code and received a 100% discount, your subscription will be <strong>valid for 3 months</strong>.
                       
                    </p> 
                    
                    <div class="price-summary mt-4">
                        <table class="price-details">
                            
                            <tr>
                                <td>Discount Got: </td>
                                <td align="end"><span id="discountValue">100%</span></td>
                            </tr>
                            <tr>
                                <td>Amount Paid:</td>
                                <td align="end">$<span id="currentprice">0.00</span></td>
                            </tr>
                             
                            
                        </table>
                         
                        
                    </div>
                    <div class="" id="PayNowButton">
                        <?php
                        // if(isset($_GET['rurl'])) {
                        //     $url = $_GET['rurl'];
                        // } else {
                        //     $url = '/users/';
                        // }
                        ?>
                        <a href="/users/" class="cs-btn cs-style1 mb-2 py-2 d-block w-100 text-center" > Go to Dashboard
                        </a>
                    </div>
                     
                    
                     
                    
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
        
    
    
     <!-- Modal for Confirming -->
    <div class="modal fade" id="PayNowModal" tabindex="-1" aria-labelledby="PayNowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
            <form method="post" action="">
                
                <input type="hidden" id="conf_requestid" name="conf_requestid" value="">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="PayNowModalLabel">The payment window will be activated soon.</h5>
                </div>
                <div class="modal-body">
                    <p>If you have a coupon code, you can apply it at checkout.</p>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                
            </form>
            
            </div>
        </div>
    </div>
        
        
        </body>
    </html>