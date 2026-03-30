<?php 
session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        
        header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
    if(isset($_POST['UpdateStats'])){
        $_SESSION['responce'] = $postObj->UpdateClubMemberProfileStats($Userrow['ClubId']);
    }
    
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Updated Successfully!';
                header('location: update.pagestats.php?msg='.$message);
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
        }
        unset($_SESSION['responce']);
        
    } 
    
    if($Userrow['ClubId'] != ''){
        $MyCLubUserRow = $postObj->GetWAHClubUserById($Userrow['ClubId']);
        
        $totalExp = $MyCLubUserRow['totalexperience'];
        $totalProjs = $MyCLubUserRow['totalproject'];
        $totalClients = $MyCLubUserRow['totalclients'];
        $totalAwards = $MyCLubUserRow['totalawards'];
        
    } else {
        $totalExp = $totalProjs = $totalClients = $totalAwards = '';
    }
    
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
                <h4 class="mb-2">Update Your WAHClub Page Stats</h4>
                <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
              </div>
              
              <hr class="mb-4">
            </div>
         <form id="updateprofile" action="" method="POST"> 
        
        <div class="row"> 
          
          <div class="col-md-12"> 
            <label>Years of Experience</label> 
            <input type="number" class="cs-form_field" name="totalexperience" placeholder="Years of Experience" min="1" max="100" value="<?=$totalExp?>" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div> 
          
          <div class="col-md-12"> 
            <label>Total No. of Project Completed</label> 
            <input type="number" class="cs-form_field" name="totalproject" placeholder="Total No. of Project Completed" min="1" max="1000" value="<?=$totalProjs?>" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>  
          
          <div class="col-md-12"> 
            <label>Total No. of Happy Clients</label>
            <select id="totalclients" class="cs-form_field" name="totalclients">
                <?php 
                
                if($totalClients != '') {
                
                    echo '<option value="'. $totalClients .'" selected>'. $totalClients .'</option>';
                }
                
                ?>
                
                <option value="0-50">0-50</option>
                <option value="51-100">51-100</option>
                <option value="101-200">101-200</option>
                <option value="201-500">201-500</option>
                <option value="500">500+</option>
            </select>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-md-12"> 
            <label>Total No. of Awards & Recognition</label> 
            <input type="number" class="cs-form_field" name="totalawards" placeholder="Total No. of Awards & Recognition" min="1" max="100" value="<?=$totalAwards?>" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>  
          
            
        </div>
        
          <div class="col-lg-12">  
          
            <div class="cs-height_10 cs-height_lg_10"></div>
            <button class="cs-btn cs-style1" type="submit" name="UpdateStats">
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