<?php 
session_start();
require_once("inc/functions.php");
$postObj = new Story();

$pagetitle = "Oops! Page Not Found | Wahstory.com";?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    <meta name="theme-color" content="#E9204F" />
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/contact" />
    <!-- Site Title -->
    <title>WAHStory | Page Not Found</title>
    
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
     #message-wrapper{
         display: none;
         align-items: center;
        justify-content: center;
        height: 100%;
     }
     #successMessage{
         color: #fff;
         font-size: 20px;
         text-align: center;
         line-height: 45px;
         position: relative;
     }
     #successMessage .icon{
        animation: bounceAnimation 2s ease-in-out;
         
     }
     
     @keyframes bounceAnimation {
    0%, 100% {
        top: 0;
        transform: translateY(0);
    }
    50% {
        top: calc(100% - 40px);
        transform: translateY(-100%);
    }
}
 
     
 </style> 


<?php
include_once('header.php');
 ?>
<!--<div class="gap-30"></div>
getRandomPosts

-->


    <div class="cs-height_40 cs-height_lg_40"></div>
    
	<section class="block-wrapper mt-5 mb-0 pt-5 pb-0">
		<div class="container">
			<div class="row">
				
				<div class="error-page text-center col">
					<div class="error-code">
						<h2>404</h2>
					</div>
					<div class="error-message">
						<h3>Oops... Page Not Found!</h3>
					</div>
					<div class="error-body">
					
						<a href="https://www.wahstory.com/" class="cs-btn cs-style1 mt-2">Back to Home Page</a>
					</div>
				</div>
			</div><!-- Row end -->
		</div><!-- Container end -->
	</section><!-- First block end -->
	
	
    <div class="cs-height_50 cs-height_lg_40"></div>
    
	<!-- Start Blog Section -->
    <section class="cs-shape_wrap_4 cs-parallax">  
      <div class="container-fluid">
        <div class="cs-slider cs-style2 cs-gap-24">
         
         <div class="container">   
          <div class="cs-slider_heading cs-style1">
              
                <div class="cs-section_heading cs-style1">
                  <h3 class="cs-section_subtitle wow fadeInLeft mb-2" data-wow-duration="0.8s" data-wow-delay="0.2s"> You would like to read our </h3>
                  <h2 class="cs-section_title">Trending Stories </h2>
                </div>
            
                <div class="cs-slider_arrows cs-style1 cs-primary_color">
                  <div class="cs-left_arrow cs-center">
                    <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.469791 5.96967C0.176899 6.26256 0.176899 6.73744 0.469791 7.03033L5.24276 11.8033C5.53566 12.0962 6.01053 12.0962 6.30342 11.8033C6.59632 11.5104 6.59632 11.0355 6.30342 10.7426L2.06078 6.5L6.30342 2.25736C6.59632 1.96447 6.59632 1.48959 6.30342 1.1967C6.01053 0.903806 5.53566 0.903806 5.24276 1.1967L0.469791 5.96967ZM26.0001 5.75L1.00012 5.75V7.25L26.0001 7.25V5.75Z" fill="currentColor" />
                    </svg>
                  </div>
                  <div class="cs-right_arrow cs-center">
                    <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M25.5305 7.03033C25.8233 6.73744 25.8233 6.26256 25.5305 5.96967L20.7575 1.1967C20.4646 0.903806 19.9897 0.903806 19.6968 1.1967C19.4039 1.48959 19.4039 1.96447 19.6968 2.25736L23.9395 6.5L19.6968 10.7426C19.4039 11.0355 19.4039 11.5104 19.6968 11.8033C19.9897 12.0962 20.4646 12.0962 20.7575 11.8033L25.5305 7.03033ZM0.00012207 7.25H25.0001V5.75H0.00012207V7.25Z" fill="currentColor" />
                    </svg>
                  </div>
                </div>
                
            </div>
          </div>
        
        
        <div class="cs-slider cs-gap-24">
          <div class="cs-height_20 cs-height_lg_10"></div>
              
          <div class="cs-slider_container" data-autoplay="1" data-autoplaySpeed="200" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
            <div class="cs-slider_wrapper featured-stories">
        
         <?php
    		foreach ($postObj->getTrendingStories(10, "trending") as $story) {
    		    
    	?>
                <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                  <a href="/story/<?=$story['slug']?>" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/posts/<?=$story['img']?>'); background-size: cover;">
                     
                    <div class="cs-post_overlay"></div>
                  </a>
                  <div class="cs-post_info">
                    <!--<div class="cs-posted_by">07 Mar 2022</div>-->
                    <h2 class="cs-post_title">
                      <a href="/story/<?=$story['slug']?>"><?=$story['title']?></a>
                    </h2>
                  </div>
                </div>
              </div>
              <!-- .cs-slide -->
      <?php } ?>       
              
            </div>
          </div>
          <!-- .cs-slider_container -->
          <div class="cs-pagination cs-style1 cs-hidden_desktop"></div>
               
        </div>
        <!-- .cs-slider -->
      </div> 
    </section>
    <!-- End Blog Section -->
    
    
    <div class="cs-height_90 cs-height_lg_70"></div>
	
	<?php include('footer.top.php');?>
     
    
  </body>
</html>