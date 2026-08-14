<?php 
    session_start(); 
    
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);

    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: ../login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']); 
    
    
    
    if(isset($_POST['SendUpgradeRequest'])){ 
        $UpgResp = $postObj->UpgradeUserAcc($_SESSION['userid'], $Userrow['name']);  
    }
    $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);
    
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
	
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
 <?php include('../header.php');?>
 
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="<?=BASE_URL?>/assets/images/page-title-bg.jpeg">
    <div class="container">
        
        <div class="row" style="align-items: center;">
            <div class="col-md-3"> 
                <div class="p-relative dash-insights-counts">
                    <div class="fade-item">
                        <h3>Total Reach</h3>
                    <p><i class="fa-regular fa-eye"></i> 77,678</p>
                    </div>
                    <div class="fade-item">
                        <h3>Content Intraction</h3>
                    <p><i class="fa-solid fa-chart-line"></i> 66,894</p>
                    </div>
                    <div class="fade-item">
                        <h3>Profile Activity</h3>
                    <p> <i class="fa-regular fa-clock"></i> 30,205</p>
                    </div>
                </div>
             
            </div>
            <div class="col-md-6">
            
            <div class="cs-page_heading_in">
                <h1 class="cs-page_title cs-font_50 cs-white_color"><?=$Userrow['name']?></h1>
                <ol class="breadcrumb text-uppercase">
                  <li class="breadcrumb-item active">
                      
                     <?php 
                    //  var_dump($Storyrow);
            if($Storyrow != NULL){ 
                $catrow = $postObj->getStoryCatById($Storyrow['category']); 
                echo $catrow['name'];
            }
                ?>
                    </li>
                </ol>
        <?php if($CheckUpg == true){ ?>
                <a href="javascript:void(0);" class="text-pink">Requested to Upgrade</a>
        <?php }else{ ?>
            <a href="#UpgradeAccModal" class="cs-btn cs-style1" data-bs-toggle="modal"><i class="fa fa-crown"></i> &nbsp; Upgrade to Premium </a>
        <?php } ?>
            </div>
                
            </div>
            <div class="col-md-3"> 
            
            <div class="dash-profile-image">
            <?php if($Storyrow != NULL){ ?>
                <img src="/images/posts/<?=$Storyrow['img']?>">
            <?php }elseif($Userrow['profile_image'] != ''){ ?>
                <img src="/users/<?=$Userrow['profile_image']?>">
                <?php }else{ ?>
                <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg">
                <?php } ?>
            </div>
            
            </div>
            
            
        </div>
        
      
    </div>
  </div> 
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  <div class="container">
      
      <?php if(isset($UpgResp) && $UpgResp == 'success'){ ?>
        <h5 class="text-center" style="color: #4af186;"> Thank you for requesting to upgrade your account in premium, We'll get back to you soon!</h5>
      <?php }elseif(isset($UpgResp) && $UpgResp == 'error'){ ?>
        <h5 class="text-center text-pink"> Something went wrong, please try again...</h5>
      <?php } ?>
      
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">

          <div class="cs-shop_sidebar_widget">  
            <?php $Dmenu = 1;?>
            <?php include('user.leftmenu.php');?>
          </div>
          
        </div>
      </div>
      <div class="col-lg-9">
        <div class="cs-height_0 cs-height_lg_40"></div>
         
        <div class="row">
           <div class="col-sm-12"> 
              <h4 class="mb-2">My Dashboard</h4>
              <hr class="mb-2">
            </div>
        
        <?php 
        if($Storyrow != NULL){
        $insights = $postObj->getStoryEngages($Storyrow['id']); ?>
        
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Story Likes</p>
                        <strong><?=$insights['likes'];?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                </div>
             </div>
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Story Views</p>
                        <strong><?=$insights['views'];?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
             </div>
             
             <div class="cs-height_10 cs-height_lg_10"></div>
             
          </div>
          <div class="col-lg-4 col-sm-6">
              <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Total Votes</p>
                <?php //$VotesCount = $postObj->getStoryTotalVotes($Storyrow['id']);
                //echo $VotesCount; 
                ?>
                        <strong> +</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-check-to-slot"></i>
                        </div>
                    </div>
                </div>
             </div>
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
        <?php } ?>
         
        <?php $reactedStoriesCount = $postObj->GetstoryreactionCountByUID($_SESSION['userid']); 
            $savedStoriesCount = $postObj->GetstorySaveCountByUID($_SESSION['userid']); 
            
        ?>
        
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                 
                <a href="user.likedstories.php">
                <div class="dash-item-box-inner">
                
                    <div class="dash-item-box-inner-left">
                        <p>Liked Stories</p>
                        <strong><?=$reactedStoriesCount?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    
                </div>
                </a>    
                    
             </div>
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                 
            <a href="user.savedstories.php">
                 
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Saved Stories</p>
                        <strong><?=$savedStoriesCount?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-bookmark"></i>
                        </div>
                    </div>
                </div>
                
                </a>
                
             </div>
             
             <div class="cs-height_10 cs-height_lg_10"></div>
             
          </div>
          <div class="col-lg-4 col-sm-6">
              <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Blog published</p>
                
                        <strong>...</strong> 
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-check-to-slot"></i>
                        </div>
                    </div>
                </div>
             </div>
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
        </div>
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <h5 class="mb-3" style="color: #999696;">My Rank</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="ringchart"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
            
            <div class="col-lg-4 col-sm-12">
                <h5 class="mb-3" style="color: #999696;">World-wide Likes</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="worldwidelikesofstory"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
            
            <div class="col-lg-4 col-sm-12">
                <h5 class="mb-3" style="color: #999696;">Challenges</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="ChallengesChart"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <h5 class="mb-3" style="color: #999696;">Views Growth Trendline</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="baarchart2"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
        </div>
        <div class="cs-height_10 cs-height_lg_10"></div>
        
        
        
        <!--Make Niotification UI Here-->
        
        
        <hr>
       <div class="row mb-5">
          <div class="row gx-5 gy-3">
            <div class="col-md-12">
             <div class="p-3 rounded-4" style="background:#032830; border: 2px solid #087990; color:#087990; font-weight:900;">Instagram Post Pending at 5:50Pm</div>
            </div>
            <div class="col-md-12">
              <div class="p-3 rounded-4" style="background:#032830; border: 2px solid #087990; color:#087990; font-weight:900;">Instagram Post Pending at 5:50Pm</div>
            </div>
            <div class="col-md-12">
             <div class="p-3 rounded-4" style="background:#032830; border: 2px solid #087990; color:#087990; font-weight:900;">Instagram Post Pending at 5:50Pm</div>
            </div>
          </div>
        </div>
    
        
        
        <!--Make Niotification UI Here-->
    <?php 
            $ContentSQL = $postObj->getContentSuggestionByUser($_SESSION['userid']);
            if($ContentSQL != NULL){
    ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h5 class="mb-2" style="color: #999696;">Scheduled Social Posts</h5>
                <hr class="mb-2">
            <?php 
                foreach($ContentSQL as $ContentRows){
                    echo date("d M, Y", strtotime($ContentRows['scheduletime']))." | ";
                }
            ?>
            </div>
        </div>
    <?php 
            }
    ?>
        
        <div class="cs-height_10 cs-height_lg_10"></div>
        <div class="cs-height_10 cs-height_lg_10"></div>
        
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h5 class="mb-2" style="color: #999696;">Connected Socials</h5>
                <hr class="mb-2">
              <div class="row">
                
                <!-- 
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box ">
                    <div class="dash-item-box-inner"  >
                        <div class="dash-item-box-inner-left">
                            <strong>Facebook</strong>
                            <div class="social-insights">
                                <a href="facebook.insights.php"> 
                                    <p>Friends</p>
                                    <strong>2580+</strong>
                                </a>
                                <a href="facebook.insights.php">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                            </div>
                            <br>
                            <a href="facebook.insights.php" class="cs-btn cs-style1" style="font-size: 12px; color: #fff;">View More Insights &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div> -->
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkFacebookModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Facebook</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>2930+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkFacebookModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div> <!--Ends-->
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkInstagramModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Instagram</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>2930+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkInstagramModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinklinkedinModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>LinkedIn</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Connections</p>
                                    <strong>1250+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>65+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinklinkedinModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-linkedin"></i>
                            </div>
                        </div>
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkTwitterModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Twitter</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>1050+</strong>
                                </a>
                                <a href="#">
                                    <p>Tweets</p>
                                    <strong>105+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkTwitterModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkYoutubeModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Youtube</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Subscribers</p>
                                    <strong>26050+</strong>
                                </a>
                                <a href="#">
                                    <p>Videos</p>
                                    <strong>185+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkYoutubeModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-youtube"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-item-box" style="background: #525252;">
                    <div class="dash-item-box-inner hover-mouse-pointer" data-bs-toggle="modal" data-bs-target="#LinkTiktokModal">
                        <div class="dash-item-box-inner-left">
                            <strong style="color: #999696">TikTok</strong>
                            <div class="social-insights">
                                <a href="#LinkTiktokModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                                <a href="#LinkTiktokModal" data-bs-toggle="modal">
                                    <p>&nbsp;
                                        <!--Reals-->
                                    </p> 
                                </a>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover" style="color: #999696; background: #d2d2d2;">
                                <i class="fa-brands fa-tiktok"></i>
                            </div>
                        </div>
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                
              </div>
                 
            </div>
        </div>
        
        
        <?php if($fbconnected != ''){ //Show When User has connected their FB?>
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Social Insights</h5> 
                    <div>
                       
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <span class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Daily</span>
                      </li>
                      <li class="nav-item" role="presentation">
                        <span class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Monthly</span>
                      </li>
                    </ul>
                                              
                    </div>

                </div>
                 
                <hr class="mb-2">
                
                
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              
              <div class="row">
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                          <strong>Total Reach</strong>
                            <p><i class="fa-regular fa-eye"></i> 50+</p>
                      </div>
                    
                    <!--<div class="">-->
                    <!--    <div class="DailyReachAreaChart"></div>-->
                    <!--</div>-->
                    
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Content Intraction</strong>
                <p><i class="fa-solid fa-chart-line"></i> 45+</p>
                
                     </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                   <div class="dash-insights-counts2">
                       <div style="padding: 10px">
                    <strong>Profile Activity</strong>
                <p> <i class="fa-regular fa-clock"></i> 30+ </p>
                      </div>
                      
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
              
              
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  
                  <div class="row">
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Total Reach</strong>
                    <p><i class="fa-regular fa-eye"></i> 1800+</p>
                    
                    </div>
                    
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Content Intraction</strong>
                <p><i class="fa-solid fa-chart-line"></i> 1500+</p>
                     </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                   <div class="dash-insights-counts2">
                       <div style="padding: 10px">
                    <strong>Profile Activity</strong>
                    <p> <i class="fa-regular fa-clock"></i> 1000+</p>
                      </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
                  
                  </div> 
            </div>
                
              
                 
            </div>
        </div>
        <?php } ?>
        
        
        <?php if($fbconnected != ''){ //Show When User has connected their FB?>
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">My Recent Posts</h5>
                    <a href="#"> <span>View More</span> </a>
                </div>
                
                <hr class="mb-2">
              <div class="row">
                 <div class="col-md-12">
                     <div class="cs-slider cs-style2 cs-gap-24">
                     <div class="cs-slider_container" data-autoplay="1" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="2" data-add-slides="3">
                <div class="cs-slider_wrapper social-recent-posts">
                <?php $Blogs = $postObj->getBlogs(5); ?>
                <?php
					if ($Blogs) {
					    $i = 1;
					    $n = 1;
					foreach ($Blogs as $blog) { ?>
                   <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="blog.php?slug=<?=$blog["slug"];?>" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/blogs/<?=$blog["img"] ?>'); background-size: cover;"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-<?php if($n % 3 == 0){ echo "linkedin";}elseif($n % 2 == 0){ echo "facebook";}else{ echo "instagram";}?>"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by"><?php echo $blog["date"] ?></div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="blog.php?slug=<?=$blog["slug"];?>"><?php echo $blog["title"] ?></a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa-regular fa-eye"></i> <?=$i+300+37?>+</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> <?=$i+200+67?>+</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                    
            <?php  $i = $i+8;  $n++; } }?> 
                  
                   
                </div>
              </div>
              
                   </div>
                 </div>
                 
                
              </div>
                 
            </div>
        </div>
        
        <?php } ?>
        
    <?php if($Storyrow != NULL){ ?>
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12"> 
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">My Products</h5>
                    <a href="single.products.php"> <span>View More</span> </a>
                </div>
                <hr class="mb-2">
              <div class="row">
        <?php 
        //Fetch Products 
        foreach ($postObj->getStoryProducts($Storyrow['id']) as $product){
        ?>
                 <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="my-productswrapper">
                    <div class="productimage">
                        <img src="/assets/images/products/<?=$product['img']?>">
                        
                        <div class="visit-product">
                        <?php if($product['link'] !=''){ ?>
                            <a href="<?=$product['link']?>" target="_blank" class="">
                                <span>View More <i class="fa fa-link"></i></span>
                            </a>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="producttitle">
                        <?php if($product['link'] !=''){ ?>
                            <a href="<?=$product['link']?>" target="_blank"><?=$product['producttitle']?> </a>
                        <?php }else{ ?>
                        <?=$product['producttitle']?>
                        <?php } ?>
                    </div>
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
        <?php } ?>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="my-productswrapper" style="height: 390px; min-height: 390px">
                    <div class="productimage" style="align-items: center; height: 100%;">
                        <div style="display: block; text-align: center;">
                            <a href="single.products.php">
                            <img src="https://lirp.cdn-website.com/ce3f6b3102644a139f50399e00757d13/dms3rep/multi/opt/placeholder-580w.png" style="height: auto; width: 160px;">
                            </a>
                            <br>
                            <br>
                            <p><a href="single.products.php"><i class="fa-solid fa-file-circle-plus"></i> Add More</a></p> 
                        </div>
                         
                    </div>
                    <div class="producttitle">
                         
                    </div>
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
                 
            </div>
        </div>
    <?php } //Check If Story Null - Ends ?>
    
    <?php if($Storyrow != NULL) { ?>
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">My Gallery</h5>
                    <a href="single.gallery.php"> <span>View More</span> </a>
                </div> 
                <hr class="mb-2">
              <div class="row">
        
         <?php 
        //Fetch Products 
        foreach ($postObj->getStoryGallery($Storyrow['id']) as $gallery){
        ?>
                 <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="my-gallerywrapper">
                    <div class="galleryimage">
                        <img src="/assets/images/gallery/<?=$gallery['img']?>">
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
        <?php } ?>
                
                 
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="my-productswrapper" style="height: 390px; min-height: 390px">
                    <div class="productimage" style="align-items: center; height: 100%;">
                        <div style="display: block; text-align: center;">
                            <a href="single.gallery.php">
                            <img src="https://lirp.cdn-website.com/ce3f6b3102644a139f50399e00757d13/dms3rep/multi/opt/placeholder-580w.png" style="height: auto; width: 160px;">
                            </a>
                            <br>
                            <br>
                            <p><a href="single.gallery.php"><i class="fa-solid fa-file-circle-plus"></i> Add More</a></p> 
                        </div>
                         
                    </div>
                    <div class="producttitle">
                         
                    </div>
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
                 
            </div>
        </div>
    <?php } ?>
    
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
  
<!--Socials Connect Modals -->

<!-- Modal -->
<div class="modal fade" id="LinkTwitterModal" tabindex="-1" aria-labelledby="LinkTwitterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkTwitterModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-twitter"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Twitter</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="LinkFacebookModal" tabindex="-1" aria-labelledby="LinkFacebookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkFacebookModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-facebook"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Facebook</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
<!--Socials Connect Modals Ends -->
 
 
<!-- Modal -->
<div class="modal fade" id="LinkInstagramModal" tabindex="-1" aria-labelledby="LinkInstagramModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkInstagramModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-instagram"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Instagram</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <button class="btn btn-primary" id="custom-fb-login-button"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
 
 
 
<!-- Modal -->
<div class="modal fade" id="LinklinkedinModal" tabindex="-1" aria-labelledby="LinklinkedinModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinklinkedinModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-linkedin"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Linked In</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
 
 
<!-- Modal -->
<div class="modal fade" id="LinkYoutubeModal" tabindex="-1" aria-labelledby="LinkYoutubeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkYoutubeModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-youtube"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Youtube</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="LinkTiktokModal" tabindex="-1" aria-labelledby="LinkTiktokModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkTiktokModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-tiktok"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Tiktok</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  We take your data seriously.<br>
                  Our <a href="/privacy-policy">Privacy Policy</a>
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
  <!-- Start CTA -->
  
 

<!-- Modal -->
<div class="modal fade" id="UpgradeAccModal" tabindex="-1" aria-labelledby="UpgradeAccModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="UpgradeAccModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-crown"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Request to Upgrade</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <form class="row" action="" method="POST">
            <div class="col-lg-12">
                <button class="cs-btn cs-style1" type="submit" name="SendUpgradeRequest">
                    <span>Send Request</span>
                    <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
                    </svg>                
                </button>
            </div>
            
       </form>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  After raising the request. <br>We will get back to you within 48 hours.
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
  
  
<a href="javascript:void(0);" id="discoverHealthModalBtn" data-bs-target="#discoverHealthModal" data-bs-toggle="modal" style="display: none;">Discover Your Social Health</a>
  
<!-- Modal -->
<div class="modal fade" id="discoverHealthModal" tabindex="-1" aria-labelledby="discoverHealthModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="discoverHealthModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-chart-column"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Discover Your Social Health</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
            <div class="col-lg-12">
                <a href="/social-health-impact/" class="cs-btn cs-style1" target="_blank">
                    <span>Discover Now</span>
                    <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
                    </svg>                
                </a>
            </div>
            
      </div>
      
      
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      // Get all the fade-item elements
      const fadeItems = document.querySelectorAll(".fade-item");
    
      // Set initial state
      let currentItemIndex = 0;
      fadeItems[currentItemIndex].style.opacity = "1";
    
      // Function to handle fading and showing next item
      function fadeNextItem() {
        fadeItems[currentItemIndex].style.opacity = "0";
        currentItemIndex = (currentItemIndex + 1) % fadeItems.length;
        fadeItems[currentItemIndex].style.opacity = "1";
      }
      // Start the automatic fading after a certain interval (e.g., every 3 seconds)
      setInterval(fadeNextItem, 3000);
    });
  </script>

  <script type="text/javascript">
        $(window).on('load', function() {
            $('#discoverHealthModalBtn').click();
        });
    </script> 
    <script src="/assets/js/userdashboard.js"></script>
  <?php include('../footer.php');?>