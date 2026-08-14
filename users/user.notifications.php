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
    
    $postObj->UpdateNotificationStatus($_SESSION['email'], 1);
     
     if(isset($_POST['deleteNotification'])){
         $response = $postObj->DeleteNotificationById();
     }
 
    if(isset($response)){
        if($response == "success"){
            $SMSG = "Deleted successfully!"; 
        }elseif($response == "error"){
            $EMSG = "Error while deleting notification, try again!"; 
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
    
  <title>Notifications | <?=$Userrow['name']?></title>
  
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
  
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     .likedimage img{
         border-radius: 10px;
     }
     .likedimage h4{
        font-size: 18px;
        font-weight: 500;
        text-align: center;
     }
     .likedimage h4:hover{
        color: #e9204f;
     }
     .cs-font_11{
	    font-size: 11px;
	}
	.cs-style2:hover{
	    background: #043b46;
	    color: #1ab5d5;
	}
	.cs-style2{
	    border: 1px solid #02abd1;
	    border-radius: 15px;
        background: #065a6c;
	}
	 .n-close{
	     position: absolute;
        right: 10px;
        display: flex;
        align-items: center;
        top: 0;
        height: 100%;
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
              <?php if(isset($EMSG) && $EMSG != ""){ ?>
                <p style="color: #e9204f;">
                    <?=$EMSG?>
                </p>
            <?php } ?>
            <?php if(isset($SMSG) && $SMSG != ""){ ?>
                <p style="color: #40c985;">
                    <?=$SMSG?>
                </p>
            <?php } ?>
            
            <div class="col-sm-9"> 
                <h4 class="mb-2">Notifications</h4>
            </div>
            
            <div class="col-sm-12"> 
                <hr class="mb-4">
            </div>
            
            <div class="col-sm-12 col-lg-12">
                
                <div class="row">
            
        <?php $notifications = $postObj->GetAllNotificationsById($_SESSION['email'], 1); 
        if($notifications != NULL){ 
            
        ?>
                    
        <?php  
            foreach($notifications as $notification){
                 
        ?>
           <div class="col-sm-12">
               <div class="alert alert-primary alert-dismissible fade show py-2" style="background: #054958;border: 2px solid #087990;color: #1ab5d5;" role="alert"> 
               
               
               
             <?php if($notification['link']) { ?>
                <a href="/users/<?=$notification['link'];?>" style="color: #1ab5d5;">
            <?php } else {?>
                <a href="javascript:void(0);" style="color: #1ab5d5;"> 
            <?php } ?>
            
            <?=$notification['notification']?> 
            <?php if($notification['created_at'] != ''){ ?>
               at 
                <span class="small"><?=date("d M, Y h:i A", strtotime($notification['created_at']));?></span>  
               </a>
            <?php } ?>
               <form action="" method="POST">
                   <input type="hidden" name="notificationID" value="<?=$notification['id']?>" />
                   <button type="submit" name="deleteNotification" class="n-close" style="color: #ff5454; background: none;">
                       <i class="fa fa-trash text-right"></i>
                   </button>
               </form>
                     
                </div>
           </div>
    <?php   } 
            }else{ ?> 
            <div class="col-md-12">  
                <p style="color: #727272;">No notifications at the moment.</p>
            </div>  
        <?php }  ?>
                    
                </div>
                
            </div>
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
</div>
  
   

  
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