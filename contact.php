<?php 
session_start();
    include('inc/functions.php');
    $postObj = new Story(); 
    $response = 0;
    if(isset($_POST["SUBMITCONTACT"])){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $_SESSION['response'] = $postObj->PostContactForm();
        }else{
            $_SESSION['response'] = "InvalidreCAPTCHA";
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
    
    <meta name="description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders."/>
    
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#E9204F" />
    <meta name="abstract" content="Engage with talented writers and embark on a journey to share your own creative stories on our storytelling platform. Explore a diverse collection of narratives that captivate and inspire.">
    <meta name="topic" content="storytelling, Founders, Diversity and Inclusion, HR, Powerful Lessons, Author, Life Mantra, Mentor, Setbacks to Success"> 
    <meta name="Classification" content="Sucess Stories">
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory">
    <meta name="url" content="https://www.wahstory.com/contact">
    <meta name="identifier-URL" content="https://www.wahstory.com/contact">
    <meta name="directory" content="Contact Us">
    <meta name="category" content="Her Story, Game Changer, Pride Story, Living Well, Passion Story">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/contact" />
    <!-- Site Title -->
    <title>WAHStory | Contact Us</title>
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="WAHStory | Contact Us">
    <meta name="og:description" content="Contact on WAHStory.com">
    <meta property="og:url" content="https://www.wahstory.com/contact" />
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
 
 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="assets/images/page-title-bg.jpeg">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">Contact Us</h1> 
        <ol class="breadcrumb text-uppercase">
            <li class="breadcrumb-item">
              <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">Contact Us </li>
          </ol>
      </div>
    </div>
  </div>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="cs-section_heading cs-style1">
          <h2 class="cs-section_title">Do you have a project <br>in your mind?</h2>
        </div>
        <div class="cs-height_55 cs-height_lg_30"></div>
        <ul class="cs-contact_info cs-style1 cs-mp0">
          
          <li>
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 6.98V16C20 17.1 19.1 18 18 18H2C0.9 18 0 17.1 0 16V4C0 2.9 0.9 2 2 2H12.1C12.04 2.32 12 2.66 12 3C12 4.48 12.65 5.79 13.67 6.71L10 9L2 4V6L10 11L15.3 7.68C15.84 7.88 16.4 8 17 8C18.13 8 19.16 7.61 20 6.98ZM14 3C14 4.66 15.34 6 17 6C18.66 6 20 4.66 20 3C20 1.34 18.66 0 17 0C15.34 0 14 1.34 14 3Z" fill="#e9204f"></path>
            </svg>              
            <span>info@wahstory.com</span>
          </li>
          
          <li>
            <a href="tel:+91 98911 36660">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#e9204f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

     
                <span>+91 98911 36660</span>
            </a>
          </li>
          
        </ul>
        <div class="cs-height_20 cs-height_lg_20"></div>
        <ul class="ts-social-list">
			<li class="ts-social">
				<a href="https://www.facebook.com/WAHStory-110196560391369/">
					<i class="tsicon fa-brands fa-facebook"></i>
					<div class="count">
						<b>19.8 k </b>
						<span>Likes</span>
					</div>
				</a>
			</li>

			<li class="ts-social">
				<a href="https://www.instagram.com/wahstory/">
					<i class="tsicon fa-brands fa-instagram"></i>
					<div class="count">
						<b>13.6 k </b>
						<span>Follwers</span>
					</div>
				</a>
			</li>

			<li class="ts-social">
				<a href="https://twitter.com/WahStory">
					<i class="tsicon fa-brands fa-twitter"></i>
					<div class="count">
						<b>12.5 k </b>
						<span>Follwers</span>
					</div>
				</a>
			</li>

			<li class="ts-social">
				<a href="https://www.linkedin.com/company/wahstory/">
					<i class="tsicon fa-brands fa-linkedin"></i>
					<div class="count">
						<b>15 k </b>
						<span>Followers</span>
					</div>
				</a>
			</li>
		</ul>
        <div class="cs-height_0 cs-height_lg_50"></div>
      </div>
      <div class="col-lg-6">
          <div id="message-wrapper" <?php if($_SESSION['response'] === 'Success'){ ?>style="display: flex;"<?php } ?>>
                <div id="successMessage">
                  <div class="icon">
                    <svg width="50" height="50" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="10" cy="10" r="9" stroke="#e9204f" stroke-width="2" fill="none" />
                      <path d="M6 10.5L8.5 13L14 7.5" stroke="#e9204f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> 
                  </div>
                  <p>Submitted Successfully.</p>
              </div>
          </div>
          
          
        <form id="contact-form" action="" method="POST" class="row" <?php if($_SESSION['response'] === 'Success'){ ?>style="display: none;"<?php } ?>>
          <div class="col-sm-12">
             <?php if(isset($_SESSION['response']) && $_SESSION['response'] === "InvalidreCAPTCHA"){?>
                <p style="color: #e9204f;"> <i class="fa fa-times-circle"></i> Please select Google reCAPTCHA, and try again... </p>
             <?php }elseif($_SESSION['response'] === "Error"){?>
              <p style="color: #e9204f;"> <i class="fa fa-times-circle"></i> Something went wrong, please try again...</p>
              <?php } ?> 
              
              <h3 class="cs-section_title mb-2">Get In Touch</h3>
              <hr class="mt-1 mb-4">
          </div>
          <div class="col-sm-6">
            <label class="cs-primary_color">Full Name*</label>
            <input type="text" class="cs-form_field" name="fullname" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-sm-6">
            <label class="cs-primary_color">Phone*</label>
            <input type="tel" class="cs-form_field" name="phone" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-12">
            <label class="cs-primary_color">Email*</label>
            <input type="email" class="cs-form_field" name="email" required>
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-lg-12">
            <label class="cs-primary_color">Message*</label>
            <textarea cols="30" rows="7" class="cs-form_field" name="message" required></textarea>
            <div class="cs-height_25 cs-height_lg_25"></div>
          </div>
          <div class="col-lg-12">
			    <div class="g-recaptcha" data-sitekey="6LfD06weAAAAAOjL1EFxao0cMF8c-caJNaKAY9PD"></div>    
			</div>
          <div class="col-lg-12">
            <button class="cs-btn cs-style1" type="submit" id="SUBMITCONTACT" name="SUBMITCONTACT">
              <span>Send Message</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
              </svg>                
            </button>
            <div id="cs-result"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
<?php if(isset($_SESSION['response'])){ unset($_SESSION['response']);} ?>
  
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  
  
  <?php include('footer.top.php');?>
     
    
  </body>
</html>