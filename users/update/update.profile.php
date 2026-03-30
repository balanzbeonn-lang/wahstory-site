<?php 
    session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    include('inc/update_profile.php');
    $UtilityObj = new UserUtility();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        echo '<script>window.location.href="/login.php"</script>';
    }
    
    if(isset($_POST['updateprofile'])){
        $_SESSION['responce'] = $UtilityObj->UpdateUserProfile($_SESSION['userid']);
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
     
     $msg = $_SESSION['responce'];
     
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Updated Successfully!';
                header('location: update.profile.php?msg='.$message);
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
        }
        unset($_SESSION['responce']);
        
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
    
  <title>Update Profile | <?=$Userrow['name']?></title>
  
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
     
     input:disabled {
        background: #383838 !important;
        border-color: #383838;
        cursor: not-allowed;
    }
     
 </style>
 
    
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
                            <h4 class="mb-2">Update Profile </h4>
                            <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
                        </div>
                        
                        <hr class="mb-4" />
                    </div>
                    <form id="updateprofile" action="" enctype="multipart/form-data" method="POST">
                        <div class="row">
            
            <?php
                if($Userrow['ClubId'] != '') { 
                
                $clubrow = $postObj->GetWAHClubUserById($Userrow['ClubId']);
                
                ?>
                        <div class="col-md-2">
                            <label>Title *</label>
                             
                            <select name="honorifics" id="honorifics"  class="cs-form_field" required>
                    <?php if($clubrow['title'] != '') { ?>
                                <option value="<?=$clubrow['title']?>" selected><?=$clubrow['title']?>.</option>
                    <?php } else{ ?>
                            <option value="">Select Title</option>
                    <?php }  ?>
                            
                                <option value="Mr">Mr.</option>
                                <option value="Mrs">Mrs.</option>
                                <option value="Ms">Ms.</option>
                                <option value="Dr">Dr.</option>
                                <option value="Prof">Prof.</option> 
                            </select>
                             
                            <div class="cs-height_10 cs-height_lg_10"></div>
                        </div>
                        
                        <div class="col-md-3">
                            <label>First Name *</label>
                            <input type="text" class="cs-form_field" name="fname" placeholder="Your First Name*" value="<?=$clubrow['firstname']?>" required="" />
                            <div class="cs-height_10 cs-height_lg_10"></div>
                        </div>
                        
                        <div class="col-md-3">
                            <label>Last Name *</label>
                            <input type="text" class="cs-form_field" name="lname" placeholder="Your Last Name*" value="<?=$clubrow['lastname']?>" required="" />
                            <div class="cs-height_10 cs-height_lg_10"></div>
                        </div>
                        
                        <div class="col-md-4">
                        
                <?php } else { ?>
                    
                    <div class="col-md-6">
                        <label>Full Name *</label>
                        <input type="text" class="cs-form_field" name="name" placeholder="Your Full Name*" value="<?=$Userrow['name']?>" required="" />
                        <div class="cs-height_10 cs-height_lg_10"></div>
                    </div>
                    
                    <div class="col-md-6">
            <?php   } ?>
            
            
                            
                                <label>Phone *</label>
                                <input type="text" class="cs-form_field" name="phone" placeholder="Phone Number *" value="<?=$Userrow['phone']?>" required="" />
                                <div class="cs-height_10 cs-height_lg_10"></div>
                            </div>
            
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="cs-form_field" value="<?=$Userrow['email']?>" readonly disabled />
                                <div class="cs-height_10 cs-height_lg_10"></div>
                            </div>
                            <div class="col-md-6">
                                <label>Select Gender </label>
                                <select class="cs-form_field" name="gender">
                                    <?php if($Userrow['gender'] != ''){  ?>
                                    <option value="<?=$Userrow['gender']?>"><?=$Userrow['gender']?></option>
                                    <?php }else{ ?>
                                    <option value="">Select Gender</option>
                                    <?php } ?>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
            
                            <div class="col-md-6">
                                <label>City *</label>
                                <input type="text" class="cs-form_field" name="city" placeholder="Enter Your City*" value="<?=$Userrow['city']?>" required="" />
                                <div class="cs-height_10 cs-height_lg_10"></div>
                            </div>
                            <div class="col-md-6">
                                <label>Select Country </label>
                                <select class="cs-form_field" name="country">
                                    <?php if($Userrow['country'] != ''){  ?>
                                    <option value="<?=$Userrow['country']?>"><?=$Userrow['country']?></option>
                                    <?php }else{ ?>
                                    <option value="">Select Country</option>
                                    <?php } ?>
            
                                    <?php 
                        $CountrySql = $postObj->getAllCountries(); foreach($CountrySql as $CountryRow){ ?>
                                    <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
                                    <?php } ?>
                                </select>
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
                            
                            
            <?php
            
            if($Userrow['profile_image'] != '') {
                echo '<div class="col-md-2"> <img src="/images/users/'. $Userrow['profile_image'] .'" width="100px"> </div> <div class="col-md-10">';
            } else {
                echo '<div class="col-md-12">';
            }
            
            ?>
                
                
                    <label>Update Profile Picture <span class="small">(Max-size: 200 KB)</span>: </label>
                    <input type="file" class="cs-form_field" name="file" id="profileimage" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                </div>
                
               <div class="col-md-12">
    <label>Upload Short Profile Video <span class="small">(Max-size: 3 MB)</span>: </label>
    <input type="file" class="cs-form_field" name="profilevideo" id="profilevideo" accept="video/mp4, video/webm, video/mov">
    <div class="cs-height_20 cs-height_lg_20"></div>
</div>

            
            <?php
            
        if($Userrow['ClubId'] != '') {
            
            $ClubSocialsRow = $postObj->GetClubMemberSocialsById($Userrow['ClubId']);
            
            
            $Facebook = $Instagram = $Linkedin = $Twitter = '';
    
            foreach ($ClubSocialsRow as $ClubSocial) {
                
                if($ClubSocial['platform'] == "Facebook") {
                    $Facebook = $ClubSocial['link'];
                    
                }else if($ClubSocial['platform'] == "Instagram") {
                    $Instagram = $ClubSocial['link'];
                    
                }else if($ClubSocial['platform'] == "Linkedin") {
                    $Linkedin = $ClubSocial['link'];
                    
                }else if($ClubSocial['platform'] == "Twitter") {
                    $Twitter = $ClubSocial['link'];
                    
                }
                
            }
            
        } else {
            
            $Facebook = $Userrow['fbid'];
            $Instagram = $Userrow['inatagramid'];
            $Linkedin = $Userrow['linkedin'];
            $Twitter = $Userrow['twitterid'];
            
        }
            ?>
                            <div class="col-md-12">
                                <label>Your Facebook Profile Link</label>
                                <input type="url" class="cs-form_field" name="fburl" placeholder="Your Facebook Profile Link" value="<?=$Facebook?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
            
                            <div class="col-md-12">
                                <label>Your Instagram Profile Link</label>
                                <input type="url" class="cs-form_field" name="instaurl" placeholder="Your Instagram Profile Link" value="<?=$Instagram?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
                            
                            <div class="col-md-12">
                                <label>Your LinkedIn Profile Link</label>
                                <input type="url" class="cs-form_field" name="linkedinurl" placeholder="Your LinkedIn Profile Link" value="<?=$Linkedin?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
            
                            <div class="col-md-12">
                                <label>Your Twitter Profile Link</label>
                                <input type="url" class="cs-form_field" name="twitterurl" placeholder="Your Twitter Profile Link" value="<?=$Twitter?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
            
                            <div class="col-md-12">
                                <label>Your Youtube Channel Link</label>
                                <input type="url" class="cs-form_field" name="youtubechannel" placeholder="Your Youtube Channel Link" value="<?=$Userrow['youtubechannel']?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
            
                            <div class="col-md-12">
                                <label>Your Tik Tok Link</label>
                                <input type="url" class="cs-form_field" name="tiktokurl" placeholder="Your Tik Tok Profile Link" value="<?=$Userrow['tiktokurl']?>" />
                                <div class="cs-height_20 cs-height_lg_20"></div>
                            </div>
                            
                            
                        </div>
            
                        <div class="col-lg-12">
                            <div class="cs-height_10 cs-height_lg_10"></div>
                            <button class="cs-btn cs-style1" type="submit" name="updateprofile">
                                <span>Update Now</span>
                            </button>
                            <div id="cs-result"></div>
                        </div>
                    </form>
                </div>
                <!-- Row Ends-->
            </div>
             
        </div>
        
     
    </div>
  
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  <script src="/assets/js/plugins/jquery-3.6.0.min.js"></script>
    
    <script>
        function maximagesize() {
            
            const fileInput = document.getElementById('profileimage');
             
                fileInput.addEventListener('change', function () {
                    
                    const file = this.files[0];
                    const maxFileSize = 200 * 1024; // 200 KB
            
                    if (file.size > maxFileSize) {
                        alert("Image Size Exceed! Maximum Size Allowed: 200 KB");
                        this.value = ''; // Clear the selected file
                        return;
                    }
            
                }); 
    
        }
     
         
         
        $(document).ready(function() {
            maximagesize();
        }); 
        
    </script>
    
    
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
            
        <?php if(isset($_GET['errmsg'])){ ?>
            function showErrorAlert() {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 3000,
                    color: "#716add",
                    timerProgressBar: true,
                    customClass: {
                      popup: 'swal-danger-alert'
                      
                    }
                  });
                }
            window.onload = showErrorAlert();
        <?php } ?>
        
    </script>
    
    
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
            
            
           function validateVideo() {
    const videoInput = document.getElementById('profilevideo');
    
    videoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        
        const maxFileSize = 3 * 1024 * 1024; // 3 MB
        
        if (file.size > maxFileSize) {
            alert("Video Size Exceed! Maximum Size Allowed: 3 MB");
            this.value = ''; 
            return;
        }
    });
}

$(document).ready(function() {
    maximagesize();
    validateVideo();
});
        </script>
    </body>
</html>