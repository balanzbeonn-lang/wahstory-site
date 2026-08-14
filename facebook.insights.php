<?php 
    session_start(); 
    /*
    ini_set('display_errors', 1);
    error_reporting(E_ALL);*/

    include('inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']); 
    
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
    
  <title>Dashboard | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
  
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css">
  
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
    
    
 <?php include('header.php');?>
 
 
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="assets/images/page-title-bg.jpeg">
    <div class="container">
        
        <div class="row" style="align-items: center;">
            <div class="col-md-3"> 
            <div class="p-relative dash-insights-counts">
                <div class="fade-item">
                    <a href="https://www.facebook.com/friends/requests" target="_blank"> 
                        <h3>FB Friend requests</h3>
                        <p> 252 </p>
                    </a>
                </div>
                
            </div>
             
            </div>
            <div class="col-md-6">
            
            <div class="cs-page_heading_in">
                <h1 class="cs-page_title cs-font_50 cs-white_color"><?=$Userrow['name']?></h1> 
                
                <span>
                    Age range - 35-44
                </span> | 
                <span> 
                    <?php if($Userrow['gender'] != '' ){ echo "Gender: ".$Userrow['gender']; }?>
                </span>
                <p>Location: Delhi, India</p>
                
                <button type="button" data-value="https://www.facebook.com/amit.kapoor.1485" class="cs-btn cs-style1 py-1" id="sharefbpUrl">Share Facebook Profile</button>
               
            </div>
                
            </div>
            <div class="col-md-3"> 
            
            <div class="dash-profile-image">
            <?php if($storyrow != NULL){ ?>
                <img src="/images/posts/<?=$storyrow['img']?>">
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
           <div class="col-sm-8"> 
              <h4 class="mb-2">Facebook Insights</h4>
            </div>
           <div class="col-sm-4"> 
              <a href="#ViewMoreModal2" class="cs-btn cs-style1 mb-2" data-bs-toggle="modal"> <i class="fa fa-upload"></i> &nbsp; Add Post on Facebook</a>
            </div>
            
            <div class="col-sm-12">
                <hr class="mb-2">
            </div> 
        
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Total Posts</p>
                        <strong>100+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa-regular fa-heart"></i>
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
                        <p>Total Photos</p>
                        <strong>70+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-photo-film"></i>
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
                        <p>Total Videos</p>
                
                        <strong>30+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-video"></i>
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
                        <p>Total Friends</p>
                
                        <strong>2500+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-users"></i>
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
                        <p>Friend Growth Over Time</p>
                
                        <strong>10+ / Day</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-user-plus"></i>
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
                        <p>Friends Demographics</p>
                
                        <strong>5+ Countries</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-globe"></i>
                        </div>
                    </div>
                </div>
             </div>
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
        </div>
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        
        <div class="row">
            <div class="col-lg-6 col-sm-12 text-center">
                <h5 class="mb-3" style="color: #999696;">Age Range of Friends</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="AgeRangeofFriends"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
            <div class="col-lg-6 col-sm-12 text-center">
                <h5 class="mb-3" style="color: #999696;">Gender Diversity of Friends</h5>
                <hr>
                <div class="cs-height_10 cs-height_lg_10"></div>
                <div class="genderdiversity"></div>
                <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
        </div>
        
        <div class="cs-height_10 cs-height_lg_10"></div>
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Facebook Posts You have Recenly Liked </h5>
                    <!--<a href="#ViewMoreModal" data-bs-toggle="modal"> <span>View More</span> </a>-->
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
                      <a href="https://www.facebook.com/" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/blogs/<?=$blog["img"] ?>'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by"><?php echo $blog["date"] ?></div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/" target="_blank"><?php echo $blog["title"] ?></a>
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
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Facebook Pages You have Recenly Liked </h5>
                    <!--<a href="#ViewMoreModal" data-bs-toggle="modal"> <span>View More</span> </a>-->
                </div>
                
                <hr class="mb-2">
              <div class="row">
                 <div class="col-md-12">
                     <div class="cs-slider cs-style2 cs-gap-24">
                     <div class="cs-slider_container" data-autoplay="1" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="2" data-add-slides="3">
                <div class="cs-slider_wrapper social-recent-posts">
                
                   <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/profile.php?id=100063776120434" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/pimg1.png'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">Broadcasting & media production company</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/profile.php?id=100063776120434" target="_blank">WAHStory</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa fa-users"></i> 774+</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> 790+</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/story911fashion" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/pimg2.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">Shopping & retail</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/story911fashion" target="_blank">Story </a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa fa-users"></i> 134K+</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> 141K+</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/Digitalmarketing299" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/pimg3.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">Product/Service</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/Digitalmarketing299" target="_blank">Digital Marketing</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa fa-users"></i> 540+</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> 541+</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/thesparklestory.in" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/pimg4.png'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">E-commerce website</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/thesparklestory.in" target="_blank">The Sparkle Story</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa fa-users"></i> 1k+</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> 912+</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                    
                   
                </div>
              </div>
              
                   </div>
                 </div>
                 
                
              </div>
                 
            </div>
        </div>
        
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Your Photos You have Recenly Posted on Facebook </h5>
                    <!--<a href="#ViewMoreModal" data-bs-toggle="modal"> <span>View More</span> </a>-->
                </div>
                
                <hr class="mb-2">
                
            <div class="row">
                <div class="col-md-3">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        04 Oct, 2023
                    </p>
                    <img src="/images/amitkapoor/fb/img2.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        "Midweek vibes! ðŸŒŸ Getting ready to conquer Wednesday and feeling the workday hustle.
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 12</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span>2 <i class="fa-regular fa-message"></i></span> 
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-3">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        23 Sep, 2023
                    </p>
                    <img src="/images/amitkapoor/fb/img3.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        Make today so great that yesterday gets jealous "Life is a series of moments...
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 22</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span>2 <i class="fa-regular fa-message"></i></span> 
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-3">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        22 Sep, 2023
                    </p>
                    <img src="/images/amitkapoor/fb/img4.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        "Life is an open book of adventures, and on every page, there's a story waiting...
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 38</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span>6 <i class="fa-regular fa-message"></i></span> 
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-3">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        19 Sep, 2023
                    </p>
                    <img src="/images/amitkapoor/fb/img5.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        "Hustle mode: ON. Making the workweek count! ðŸ’ªðŸ’¼ #OfficeLife"
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 25</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span>0 <i class="fa-regular fa-message"></i></span> 
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
            </div>
            
            </div>
        </div>
              <div class="cs-height_50 cs-height_lg_50"></div>  
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Videos You have Recenly Posted on Facebook </h5>
                    <!--<a href="#ViewMoreModal" data-bs-toggle="modal"> <span>View More</span> </a>-->
                </div>
                
                <hr class="mb-2">
                
            <div class="row">
                
                <div class="col-md-4">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        31 Jul, 2020
                    </p>
                    <img src="/images/amitkapoor/fb/vimg2.jpg" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        We All Have a Story - Fitness at 40
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 96</span> &nbsp; &nbsp;
                    <span>33 <i class="fa-regular fa-message"></i></span> &nbsp; &nbsp;
                    <span>2.3K <i class="fa-regular fa-eye"></i></span>
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-4">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        10 Jun, 2020
                    </p>
                    <img src="/images/amitkapoor/fb/vimg3.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        Let's Talk - Benefits & Myths of Yoga
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 75</span> &nbsp; &nbsp;
                    <span>14 <i class="fa-regular fa-message"></i></span> &nbsp; &nbsp;
                    <span>1.5K <i class="fa-regular fa-eye"></i></span>
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-4">
                    <div class="cs-height_10 cs-height_lg_10"></div>
                    <p style="font-size: 14px; text-align: right">
                        05 Jun, 2020
                    </p>
                    <img src="/images/amitkapoor/fb/vimg4.jpg" alt="Amit Kapoor" style="border-radius: 10px;">
                    <div class="cs-height_5 cs-height_lg_5"></div>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                        Letâ€™s Talk - 9th Live Session with Vaniâ€¦
                    </p>
                    <p style="font-size: 13px; text-align: left; line-height: 18px">
                    <span><i class="fa-regular fa-thumbs-up"></i> 70</span> &nbsp; &nbsp;
                    <span>8 <i class="fa-regular fa-message"></i></span> &nbsp; &nbsp;
                    <span>1.9K <i class="fa-regular fa-eye"></i></span>
                    </p>
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
            </div>
            
            </div>
        </div>
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Your Recent Posts on Facebook </h5>
                    <!--<a href="#ViewMoreModal" data-bs-toggle="modal"> <span>View More</span> </a>-->
                </div>
                <hr class="mb-2">
              <div class="cs-height_10 cs-height_lg_10"></div>  
              <div class="row">
                 <div class="col-md-12">
                     <div class="cs-slider cs-style2 cs-gap-24">
                     <div class="cs-slider_container" data-autoplay="1" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="2" data-add-slides="3">
                <div class="cs-slider_wrapper social-recent-posts">
                
                   <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/photo/?fbid=10229922963433790&set=a.1455812590883" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/img2.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">04 Oct, 2023</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/photo/?fbid=10229922963433790&set=a.1455812590883" target="_blank">"Midweek vibes! ðŸŒŸ Getting ready to conquer Wednesday and feeling the workday hustle. Here's a glimpse of the pre-office prep</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa-regular fa-thumbs-up"></i> 12</span>
                            <span><i class="fa-regular fa-message"></i> 2</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/photo/?fbid=10229823578509229&set=a.1455812590883" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/img3.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">23 Sep, 2023</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/photo/?fbid=10229823578509229&set=a.1455812590883" target="_blank">Make today so great that yesterday gets jealous. "Life is a series of moments, and each day is a chance to craft a masterpiece. </a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa-regular fa-thumbs-up"></i> 22</span>
                            <span><i class="fa-regular fa-message"></i> 2</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/photo/?fbid=10229818253776114&set=a.1455812590883" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/img4.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">22 Sep, 2023</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/photo/?fbid=10229818253776114&set=a.1455812590883" target="_blank">"Life is an open book of adventures, and on every page, there's a story waiting to be written. As I stand on the brink of the unknown</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa-regular fa-thumbs-up"></i> 38</span>
                            <span><i class="fa-regular fa-message"></i> 6</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  <!--.cs-slide -->
                  <div class="cs-slide">
                    <div class="cs-post cs-style1 ">
                      <a href="https://www.facebook.com/photo/?fbid=10229797205849929&set=a.1455812590883" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/amitkapoor/fb/img5.jpg'); background-size: cover;" target="_blank"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-facebook"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by">19 Sep, 2023</div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="https://www.facebook.com/photo/?fbid=10229797205849929&set=a.1455812590883" target="_blank">"Hustle mode: ON. Making the workweek count! 💪💼 #OfficeLife"</a>
                        </h2>
                        
                        <p class="mt-2">
                            <span><i class="fa-regular fa-thumbs-up"></i> 25</span>
                            <span><i class="fa-regular fa-message"></i> 0</span>
                        </p>
                        
                      </div>
                    </div>
                  </div>
                  
                   
                </div>
              </div>
              
                   </div>
                 </div>
                 
                
              </div>
                 
            </div>
        </div>
        
        
        
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
  
<!-- Modal -->
<div class="modal fade" id="ViewMoreModal3" tabindex="-1" aria-labelledby="ViewMoreModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <h5 class="text-dark"> Will be open soon!...</h5>
       
      </div>
      
      
    </div>
  </div>
</div>
  


<!-- Modal -->
<div class="modal fade" id="ViewMoreModal2" tabindex="-1" aria-labelledby="ViewMoreModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header py-2">
          
          
       <h5 class="text-dark"> Create Facebook Post</h5>
          
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
            
            <textarea class="fbposttextarea form-control" name="fbposttextarea" placeholder="What's on your mind?" required></textarea>
        <br>
            <button type="submit" name="PostOnFB" class="cs-btn cs-style1">Add Post &nbsp; <i class="fa-solid fa-arrow-right"></i></button>
       
        </form>
      </div>
      
      
    </div>
  </div>
</div>
<!--Socials Connect Modals -->

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
       
       <button class="btn btn-primary"><i class="fa-regular fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa-regular fa-lock"></i> &nbsp; &nbsp;
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
 
 
           <!-- Place the first <script> tag in your HTML's <head> -->


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<!--<script src="https://cdn.tiny.cloud/1/jfmysfnx68ftyj7wr75pq0qzhoq8lmjca0mjihu51btdtdok/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>-->
<script>
  /*tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });*/
</script>
 
 
<script>
    // Wait for the page to load
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
  
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        // Wait for the document to be ready
        $(document).ready(function () {
            
            var button = document.getElementById("sharefbpUrl");

        // Add a click event listener to the button
        button.addEventListener("click", function() {
            // Get the data-value attribute's value
            var dataValue = button.getAttribute("data-value");

            // Create a temporary input element to copy the value to the clipboard
            var input = document.createElement("input");
            document.body.appendChild(input);
            input.value = dataValue;
            input.select();
            document.execCommand("copy");
            document.body.removeChild(input);
            button.innerHTML = "Copied";
        });
            
        });
    </script>
  
  <!-- Start CTA -->
  <?php include('footer.php');?>