<?php 
session_start();
ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: /login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    if(isset($_POST['AddGallery'])){
        $_SESSION['responce'] = $postObj->AddGallery($Storyrow['id']);
    }
    
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Gallery Added Successfully!';
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
        }
        unset($_SESSION['responce']);
        
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
    
  <title>My Gallery | <?=$Userrow['name']?></title>
  
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
                <?php $Dmenu = 6;?>
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12"> 
              <h4 class="mb-2">Add Gallery</h4>
              <hr class="mb-4">
            </div>
         <form id="addgallery" action="" method="POST" enctype="multipart/form-data"> 

          <div class="col-sm-12"> 
          
            <input type="text" class="cs-form_field" name="imagetitle" placeholder="Image Title">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div> 
          <div class="col-sm-12"> 
            <input type="file" class="cs-form_field" name="file" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-lg-12">   
            <button class="cs-btn cs-style1" type="submit" name="AddGallery">
              <span>Add to Gallery</span>
                              
            </button>
            <div id="addgallery-result"></div>
          </div>
        </form> 
        
        
          </div> <!-- Row Ends-->
          
          <div class="cs-height_60 cs-height_lg_50"></div>
          
          <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h4 class="mb-2" style="color: #999696;">My Gallery</h4>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
          </div>
          
          <div class="row">
         <?php foreach($postObj->getStoryGallery($Storyrow['id']) as $galleryrow){ ?>
                <div class="col-md-4 col-sm-6">
                    <div class="gallery-item">
                        <img src="assets/images/gallery/<?=$galleryrow['img']?>">
                    </div>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                </div>
        <?php } ?>
                
                
          </div>
        
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
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
    
  </body>
</html>