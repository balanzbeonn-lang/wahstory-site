<?php 
session_start(); 
    include('../inc/functions.php');
    $postObj = new Story();
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{
            header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']);
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    if(isset($_POST['Updatepicture'])){ 
        
        $ResponsePic = $postObj->UpdateProfilePhoto($_SESSION['userid']);
        
    }
    if(isset($_POST['UpdateProfilePic'])){
        
        $ResponsePic = $postObj->UpdateProfilePic($_SESSION['userid']);
        
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
     .profile-picture{
         height: 120px !important;
         width: 120px  !important;
         border-radius: 50% !important;
     }
     
     .club-info label{
         font-size: 14px;
     }
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 
 <?php include('breadcrump.php');?>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
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
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row">
            <div class="col-sm-9"> 
                <h4 class="mb-2">My Profile</h4>
            </div>
             
            <div class="col-sm-3" style="text-align: right;">
                <a href="javascript:void(0);"><i class="fa fa-edit"></i> Update Profile</a>
            </div>
            
            <div class="col-sm-12"> 
                <hr class="mb-4">
            </div> 
            
        </div> 
        
    <?php 
    $WAHCLUBUSER = $postObj->GetWAHClubUserByEmail($Userrow['email']);
    if($WAHCLUBUSER !== FALSE){  
    ?>
        <div class="row">   
            
            <div class="col-sm-12 col-md-6 col-lg-4 text-center">
    <?php   if($WAHCLUBUSER['photo'] != NULL) { ?>
                <img src="/wahclub/public/img/photos/<?=$WAHCLUBUSER['photo']?>" style="border-radius: 20px;">
    <?php } ?>
                <a href="#ProfilePicModal" data-bs-toggle="modal" class="btn text-white mt-2" style="border-color: #333;"><i class="fa fa-image"></i> Change Picture</a>
                
                <hr class="d-block d-md-none my-4">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-8">
            
             <div class="card" style="background: #040404; min-height: 285px;">
               <div class="card-body">
                   
                <h5 class="mb-2"><?=$WAHCLUBUSER['firstname']. ' ' . $WAHCLUBUSER['lastname']?></h5>
                <p><strong>Phone:</strong> <?=$WAHCLUBUSER['phone']?></p>
                <p><strong>Email:</strong> <?=$WAHCLUBUSER['email']?></p>
                <p><strong>Total Experience:</strong> <?=$WAHCLUBUSER['totalexperience']?>+</p>
    <?php
    
        $Clientrange = $WAHCLUBUSER['totalclients']; 
    if($Clientrange) {  
                 
        if (strpos($Clientrange, '-') !== false) {
        
            list($min, $max) = array_map('trim', explode('-', $Clientrange));
            
        } else {
        
            $min = $max = trim($Clientrange);
        }
    }else {
        $max = '';
    }
    ?>
                <p><strong>Total Clients:</strong> <?=$max?>+</p>
                <p class="mb-1"><strong>Total Projects:</strong> <?=$WAHCLUBUSER['totalproject']?>+</p>
                <p class="mb-1"><strong>Total Awards:</strong> <?=$WAHCLUBUSER['totalawards']?>+</p> 
                
               </div> 
             </div> 
            
            </div> 
        
        </div>
        
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        <h5 class="mb-2" style="color: #999696; display: flex; justify-content: space-between;">
            <span class="h5 fw-bold">Career Profile</span>
            <a href="javascript:void(0);" class="text-right fw-normal"><i class="fa fa-edit"></i> Update</a>
        </h5>
        
        
        <hr class="mb-2">
                
        <div class="row club-info">
            
            <div class="col-lg-12 col-sm-12">
        <?php $industry = $postObj->getIndustrybyuserId($WAHCLUBUSER['id']);
            if($industry !== FALSE) {
        ?>
                <label>
                   Industry: <strong><?=$industry['industry'];?></strong>
                </label>
        <?php } ?>
            </div>
            
            <div class="col-lg-12 col-sm-12">
                <?php $Skills = $postObj->GetWAHClubUserSkillById($WAHCLUBUSER['id']);
            if($Skills !== FALSE) {
                ?>
                <label>
                   Skills: <strong><?php foreach($Skills as $Skill) { echo $Skill['skill']. ', '; }?></strong>
                </label>
        <?php } ?>
            </div>
            
            <div class="col-lg-12 col-sm-12">
                <?php $Tools = $postObj->getToolsbyuserId($WAHCLUBUSER['id']);
            if($Tools !== FALSE) {
            ?>
                <label>
                   Tools: <strong><?php foreach($Tools as $Tool) { echo $Tool['tool']. ', '; }?></strong>
                </label>
            <?php } ?>
            </div>
            
            <div class="col-lg-12 col-sm-12">
                <?php $Traits = $postObj->getAttributesbyuserId($WAHCLUBUSER['id']); 
            if($Traits !== FALSE) {
            ?>
                <label>
                   Personal Traits:: <strong><?php foreach($Traits as $Trait) { echo $Trait['attribute']. ', '; }?></strong>
                </label>
            <?php } ?>
            </div>
              
            <div class="col-lg-12 col-sm-12 mt-4">
    <?php $Experiences = $postObj->getAllExperiencesbyuserId($WAHCLUBUSER['id']); 
    
        if($Experiences !== FALSE) {
    ?>
                <label>
                   Experiences: 
                </label>
                
                <div class="row">
            <?php foreach($Experiences as $Experience) { ?>
                    <div class="col-lg-4">
                        <label> <strong><?=$Experience['company_name'];?></strong> <br>
                        (<?=$Experience['role'];?>) <br>
                        <?=$Experience['durationfrom'];?> - <?php if($Experience['present'] != NULL){ echo $Experience['present'];} else{ echo $Experience['durationto'];} ?> <br> </label>
                        
                    </div>
            <?php } ?>
                </div>
        <?php } ?>
            </div>
            
            
            <div class="col-lg-12 col-sm-12 mt-4">
    <?php $Educations = $postObj->getAlleducationbyuserId($WAHCLUBUSER['id']); 
        if($Educations !== FALSE) {
    ?>
                <label>
                   Education: 
                </label>
                
                <div class="row">
            <?php foreach($Educations as $Education) { ?>
                    <div class="col-lg-4">
                      <label>  <strong><?=$Education['institution_name'];?></strong> <br>
                        (<?=$Education['degree'];?>) <br>
                        <?=$Education['yearfrom'];?> - <?php if($Education['present'] != NULL){ echo $Education['present'];} else{ echo $Education['yearto'];} ?> <br></label>
                        
                    </div>
            <?php } ?>
                </div>
                
        <?php   }  ?>
                
            </div>
            
        </div>
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        <h5 class="mb-2" style="color: #999696; display: flex; justify-content: space-between;">
            <span class="h5 fw-bold">Work</span>
            <a href="javascript:void(0);" class="text-right fw-normal"><i class="fa fa-edit"></i> Update</a>
        </h5>
        <hr class="mb-2">
                
        <div class="row">
            
            <div class="col-lg-12 col-sm-12"> </div>
            
            <div class="col-lg-12 col-sm-12 mt-4">
    <?php $projects = $postObj->getAllprojectsbyuserId($WAHCLUBUSER['id']); 
    
        if($projects !== FALSE) {
    ?>
                <label>
                   Projects: 
                </label>
                
                <div class="row">
            <?php foreach($projects as $project) { ?>
                    <div class="col-lg-4">
                      <label>  <a href="<?=$project['project_link'];?>" target="_blank"><strong><?=$project['project_name'];?></strong></a>  
                        </label>
                        
                    </div>
            <?php } ?>
                </div>
        <?php   }   ?>
                
            </div>
            
            <div class="col-lg-12 col-sm-12 mt-4">
    <?php $awards = $postObj->getAllawardsbyuserId($WAHCLUBUSER['id']);
    
        if($awards !== FALSE) {
    ?>
                <label>
                   Awards: 
                </label>
                
                <div class="row">
            <?php foreach($awards as $award) { ?>
                    <div class="col-lg-4">
                      <label>  <strong><?=$award['award_title'];?></strong> <br>
                      
                      (<?=$award['awarding_body'];?>)
                        </label>
                        
                    </div>
            <?php } ?>
                </div>
                
        <?php } ?>
                
            </div>
            
            
        </div>
        
        <div class="cs-height_30 cs-height_lg_30"></div> 
        
        <h5 class="mb-2" style="color: #999696; display: flex; justify-content: space-between;">
            <span class="h5 fw-bold">Blog & Testimonials</span>
            <a href="javascript:void(0);" class="text-right fw-normal"><i class="fa fa-edit"></i> Update</a>
        </h5>
        
        <hr class="mb-2">
                
        <div class="row">
            
            <div class="col-lg-12 col-sm-12  mt-4"> </div>
            
        </div>
        
        <div class="cs-height_30 cs-height_lg_30  mt-4"></div>
        
        <h5 class="mb-2" style="color: #999696; display: flex; justify-content: space-between;">
            <span class="h5 fw-bold">Story</span>
            <a href="javascript:void(0);" class="text-right fw-normal"><i class="fa fa-edit"></i> Update</a>
        </h5>
        
        <hr class="mb-2">
                
        <div class="row">
            
            <div class="col-lg-12 col-sm-12 mb-5"> </div>
            
        </div>
        
        
        
        
        
        
        
    <?php   }else{   ?>
    
    
            
            <div class="row">
                
                <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                    <img src="/images/users/<?=$Userrow['profile_image']?>" style="border-radius: 20px;">
                    <a href="#ProfilePicUpdateModal" data-bs-toggle="modal" class="btn text-white mt-2"  style="border: 1px solid #333;"><i class="fa fa-image"></i> Change Picture</a>
                    
                    <hr class="d-block d-md-none my-4">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-8">
                    
                 <div class="card" style="background: #040404; min-height: 285px;">
                  <div class="card-body">
                    
                    <h5 class="mb-2"><?=$Userrow['name'];?></h5>
                    <p><strong>Phone:</strong> <?=$Userrow['phone'];?></p>
                    <p><strong>Email:</strong> <?=$Userrow['email'];?></p>
                    
                   </div> 
                  </div> 
                  
                </div> 
                
            </div>
            
    
    
    <?php   }   ?>
        
        
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
<!-- Modal -->
<div class="modal fade" id="ProfilePicUpdateModal" tabindex="-1" aria-labelledby="ProfilePicModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form class="row" action="" method="POST" enctype="multipart/form-data">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="ProfilePicModalLabel1">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-image"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Update Profile Picture</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       
            <div class="col-lg-12">
                <div class="form-group">
                <label for="profilePicFile1" class="text-dark">Select Image</label><br>
                 <input type="file" name="file" id="profilePicFile1"  accept=".jpg, .png, .webp, .jpeg" class="text-dark form-control" required>
                </div>
            </div>
             
       
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
        <button type="submit" name="UpdateProfilePic" class="cs-btn cs-style1 spotbtns text-right">UPDATE</button>
      </div>
      
    </form>
    
    </div>
  </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="ProfilePicModal" tabindex="-1" aria-labelledby="ProfilePicModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form class="row" action="" method="POST" enctype="multipart/form-data">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="ProfilePicModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-image"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Update Profile Picture</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       
            <div class="col-lg-12">
                <div class="form-group">
                <label for="profilePicFile" class="text-dark">Select Image</label><br>
                 <input type="file" name="file" id="profilePicFile"  accept=".jpg, .png, .webp, .jpeg" class="text-dark form-control" required>
                </div>
            </div>
             
       
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
        <button type="submit" name="Updatepicture" class="cs-btn cs-style1 spotbtns text-right">UPDATE</button>
      </div>
      
    </form>
    
    </div>
  </div>
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