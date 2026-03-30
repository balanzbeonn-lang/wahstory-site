<?php 
session_start(); 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

    include('inc/functions.php');
    $postObj = new Story(); 
    $response = 0;
    if(isset($_POST["SUBMITDETAILS"])){
        
        $_SESSION['response'] = $postObj->PostWahstoryContestMoment();
            
            
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
    
    <meta name="description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders."/>
    
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#E9204F" />
    <meta name="abstract" content="Engage with talented writers and embark on a journey to share your own creative stories on our storytelling platform. Explore a diverse collection of narratives that captivate and inspire.">
    <meta name="topic" content="storytelling, Founders, Diversity and Inclusion, HR, Powerful Lessons, Author, Life Mantra, Mentor, Setbacks to Success"> 
    <meta name="Classification" content="Sucess Stories">
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory">
    <meta name="url" content="https://www.wahstory.com/getmeinwahclub">
    <meta name="identifier-URL" content="https://www.wahstory.com/getmeinwahclub">
    <meta name="directory" content="Share Moment of the day on WAHStory">
    <meta name="category" content="Her Story, Game Changer, Pride Story, Living Well, Passion Story">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/getmeinwahclub" />
    <!-- Site Title -->
    <title>WAHStory Contest | WAHStory</title>
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="WAHStory Contest | WAHStory">
    <meta name="og:description" content="Share your Moment Of The Day on WAHStory.com">
    <meta property="og:url" content="https://www.wahstory.com/getmeinwahclub" />
    <meta property="og:site_name" content="WahStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/logos/logo-light.png" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
    <meta property="og:image:type" content="image/png" />
    
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/slick.css">
  <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="assets/css/style.css"> 
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style> 
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
  
  
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg pt-2" data-src="assets/images/page-title-bg.jpeg">
    <div class="container">
        <div class="row">
                <div class="col-12 text-center">

                    <div class="logo-box pb-4">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" style=" width: 150px; ">
                        </a>
                    </div>
                </div>
            </div>
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color"> WAHstory Contest - Moment Of The Day</h1> 
        <ol class="breadcrumb text-uppercase">
            <li class="breadcrumb-item">
              <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">Moment Of The Day </li>
          </ol>
      </div>
    </div>
  </div>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  
  <div class="container">
    <div class="row"> 
       
      <div class="col-lg-12">
          
          <div id="message-wrapper" <?php if($_SESSION['response'] === 'success'){ ?>style="display: flex;"<?php } ?>>
                <div id="successMessage">
                  <div class="icon">
                    <svg width="50" height="50" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="10" cy="10" r="9" stroke="#e9204f" stroke-width="2" fill="none" />
                      <path d="M6 10.5L8.5 13L14 7.5" stroke="#e9204f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> 
                  </div>
                  <p style="font-size: 20px;">Thanks for sharing your Moment of the Day! Your entry is in—stay tuned for updates. Good luck!</p>
              </div>
          </div> 
          
        <?php if($_SESSION['response'] === 'error'){ ?> 
            <p style="font-size: 20px; color: #e9204f;">Something went wrong, please try again! </p>
        <?php } ?>
          
      </div> 
      
      <div class="col-lg-2"></div> 
      <div class="col-lg-8">
          
          <?php if($_SESSION['response'] === 'success'){  }else{ ?>
          
        <form id="contact-form" action="" method="POST" class="row" enctype="multipart/form-data">
          
          <div class="col-sm-6">
            <label class="cs-primary_color">Full Name*</label>
            <input type="text" class="cs-form_field" id="fullname" name="fullname" placeholder="Enter Full Name" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
           
          
          <div class="col-sm-6">
            <label class="cs-primary_color">Phone *</label><br>
            <input type="tel" class="cs-form_field" name="phone" id="phone" minlength="10" maxlength="15" placeholder="Enter Phone Number" pattern="^\+?[0-9\s\-]{10,15}$" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-12">
            <label class="cs-primary_color">Email*</label> 
            <input type="email" id="email" placeholder="Enter Email Address" class="cs-form_field" name="email" required> 
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
           
          
           <div class="col-sm-12">
                <div class="form_group">
                  <label>Upload Image * (Max Size: 1 MB)</label>
                  <input type="file" id="file-upload" class="cs-form_field" name="file" accept="image/*" required />
                </div>
              </div>
           
          <div class="col-sm-12 my-4">
             
            <button class="cs-btn cs-style1" type="submit" name="SUBMITDETAILS">
              <span>Submit</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
              </svg>                
            </button>
            <div id="cs-result"></div>
          </div>
        </form>
        
        <?php } ?>
      </div>
    </div>
  </div>
  
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
<?php if(isset($_SESSION['response'])){ unset($_SESSION['response']);} ?>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
   
     <script>
        const imageUpload = document.getElementById('file-upload'); 

        imageUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileSizeInMB = file.size / (1024 * 1024); // Convert bytes to MB
                if (fileSizeInMB > 1) {
                    alert('File size exceeds.');
                    imageUpload.value = ''; // Clear the input
                } else {
                    
                }
            }
        });
    </script>
   
  <?php include('footer.top.php');?>
     
    
  </body>
</html>