<?php 
session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        
        header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
    if(isset($_POST['updateSocials'])){
        $_SESSION['responce'] = $postObj->UpdateClubMemberSocials($Userrow['ClubId']);
    }
    
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Updated Successfully!';
                header('location: update.socials.php?msg='.$message);
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
        }
        unset($_SESSION['responce']);
        
    } 
    
    
    $ClubSocialsRow = $postObj->GetClubMemberSocialsById($Userrow['ClubId']);
    
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
     .swal2-timer-progress-bar-container {
         background: #a5dc86;
     }
     .swal2-title {
         color: #2c6a09;
     }
     
     .swal2-timer-progress-bar {
         background: rgba(0, 0, 0, .4);
     }
     
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
 <?php include('../../header.php');?>
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
                <?php $Dmenu = 3;?>
                <?php include('../user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
      </div>
      
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12">  
              <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-2">Update Your Social Media</h4>
                <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
              </div>
              
              <hr class="mb-4">
            </div>
         <form id="updateprofile" action="" method="POST"> 
        
        <div class="row"> 
          
         
    <?php
    $fb = $insta = $Linkedin = $Twitter = '';
    
    foreach ($ClubSocialsRow as $ClubSocial) {
        
        if($ClubSocial['platform'] == "Facebook") {
            $fb = $ClubSocial['link'];
            
        }else if($ClubSocial['platform'] == "Instagram") {
            $insta = $ClubSocial['link'];
            
        }else if($ClubSocial['platform'] == "Linkedin") {
            $Linkedin = $ClubSocial['link'];
            
        }else if($ClubSocial['platform'] == "Twitter") {
            $Twitter = $ClubSocial['link'];
            
        }
        
    }
    
    ?>
         
            <!--$ClubSocialsRow-->
          
          <div class="col-md-12"> 
            <label>Your Facebook Profile Link</label>
            <input type="url" class="cs-form_field" name="fburl" placeholder="Your Facebook Profile Link" value="<?=$fb?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>  
          
          <div class="col-md-12"> 
            <label>Your Instagram Profile Link</label>
            <input type="url" class="cs-form_field" name="instaurl" placeholder="Your Instagram Profile Link" value="<?=$insta?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-md-12"> 
            <label>Your LinkedIn Profile Link</label>
            <input type="url" class="cs-form_field" name="linkedinurl" placeholder="Your LinkedIn Profile Link" value="<?=$Linkedin?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>  
          <div class="col-md-12"> 
            <label>Your Twitter Profile Link</label>
            <input type="url" class="cs-form_field" name="twitterurl" placeholder="Your Twitter Profile Link" value="<?=$Twitter?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>  
            
        </div>
        
          <div class="col-lg-12">  
          
            <div class="cs-height_10 cs-height_lg_10"></div>
            <button class="cs-btn cs-style1" type="submit" name="updateSocials">
              <span>Update Now</span>
                              
            </button>
            <div id="cs-result"></div>
          </div>
        </form> 
        
          </div> <!-- Row Ends-->
          
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
    <?php if(isset($_GET['sucmsg'])){ ?>
    
    function showSuccessAlert() {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?=$_GET['sucmsg'];?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
              popup: 'swal-success-alert'
              
            }
          });
        }
    
    window.onload = showSuccessAlert();
        
    <?php } ?>
        
      </script>
  
  <!-- Start CTA --> 
      <?php include('../../footer.section.php');?>
      <?php include('../footer.commonJS.php');?> 
        
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
    </body>
</html>