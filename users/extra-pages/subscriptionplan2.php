<?php 
    session_start(); 
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: ../login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']); 
    
    
    
    /*if(isset($_POST['SendUpgradeRequest'])){ 
        $UpgResp = $postObj->UpgradeUserAcc($_SESSION['userid'], $Userrow['name']);  
    }*/
    // $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);
    
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
    .planCard {
      background: black;
      border: 2px solid white;
      border-radius: 30px;
      margin-bottom:100px;
      cursor:pointer;
      user-select:none;
      transition: background-color 0.5s ease, transform 0.3s ease, border-color 0.5s ease; 
      will-change: transform, border-color;
      box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
      position: relative;
      overflow: hidden;
      
    }


    .planCard .card-header {
      padding-top: 20px;
      border-bottom: 2px solid white;
    }
    
    .upperhead {
      color: white;
      font-size: 30px;
      padding: 10px 0 20px;
    }
    
    
    
    .lowerhead {
      color: white;
      font-size: 18px;
      padding-bottom: 5px;
    }
    
    .lowerhead span{
        font-size:30px;
    }
    
    #chooseYourPlan {
      margin-bottom: 50px;
      font-size: 36px;
    }
    
    .check {
      padding-right: 5px;
      color: #e9204f;
      transition: color 0.5s ease;
    }
    
    .includes {
      padding: 20px 0;
      font-size: 14px;
      border-bottom: 1px solid gray;
      color: white;
    }
    
    .planCard:hover {
      background: rgb(0,0,0);
    background: linear-gradient(0deg, rgba(0,0,0,1) 14%, rgba(233,32,79,1) 100%);
    transform: scale(1.01); 
      border-color: #e9204f; 
      box-shadow: 0 8px 16px rgba(233, 32, 79, 0.5);
    }
    
    
    .planCard:hover .check {
      color: white;
    }
    
    .planCard .card-body {
      transition: background-color 0.5s ease;
    }
    
    .bestValueBand {
      position: absolute;
      top: 18px;
      right:-32px;
      background-color: #e9204f;
      color: white;
      padding: 5px 40px;
      font-size: 14px;
      transform: rotate(40deg); 
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.3); 
    }
    
    .icon-div{
        
        display:flex;
        justify-content:center;
        background:none; !important
        /*width:-10px; !important*/
         padding:20px; !important
    }
    /*.icon-btn{
        width:-20px; !important
        border-radius:60px; !important
       
       
        
        
    }*/
    
 </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
 <?php //include('../header.php');?>
 
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  <div class="container">
     <!--<div class="cs-height_0 cs-height_lg_40"></div>-->
     <!--<div class="cs-height_30 cs-height_lg_30"></div>-->

<div class="row">
  <div class="col-lg-12">
    <h4 class="text-center" id="chooseYourPlan">Choose Your Plan</h4>
    <div class="row">
      <!-- Basic Plan -->
      <div class="col-lg-4">
        <div class="card planCard">
          <div class="card-header">
            <div class="text-center upperhead">Basic</div>
            <div class="text-center lowerhead">FREE</div>
          </div>
          <div class="card-body">
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Social Media Campaigns: We will promote your posts across our social media channels, reaching a wider audience and driving more traffic to your content. (1 Campaign/month) Social Media Promotion </span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Dedicated Social Media Shout-outs: We will feature your brand on our social media platforms, highlighting your stories and engaging with followers.(1 Shout-out / month) Social Media Promotion</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Guide to create and maintain a compelling LinkedIn profile that highlights your skills, experience, and accomplishments. LinkedIn Optimization</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Regularly share industry insights, engage in discussions, and connect with relevant professionals. LinkedIn Optimization</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Share your unique insights and opinions on industry trends and topics. Suggesting trending topics that you can write on.   Thought Leadership  / Industry Insights</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Create an email newsletter where you share exclusive insights and updates with your subscribers.  Email Newsletter</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Auto application for Wahstory awards and recognitions to build credibility. Online Awards and Recognitions</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Share relevant article/blogs/content to stay updated with industry trends and continue to enhance your skills and knowledge. Continual Learning</span></div>
           
          </div>
           <div class="icon-div">
               <span class="cs-btn cs-style1 mb-2"><i class="fa fa-arrow-right"></i></span>
           </div>
         

        </div>
      </div>
      
      <!-- Standard Plan -->
      <div class="col-lg-4">
        <div class="card planCard">
            
          <div class="card-header">
            
            <div class="text-center upperhead">Standard</div>
            <div class="text-center lowerhead"><span>$12</span><sub>/Month</sub></div>
          </div>
          <div class="card-body">
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Share your knowledge and expertise by creating and sharing valuable content.  Content Creation</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Assist in writing articles, blog or posts related to your field.    Content / Creation 1 article </span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Professional Editing Assistance: Our team of experienced editors will provide editorial support to refine and enhance your content, ensuring they resonate with readers. Content Creation</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Engage with peers and industry leaders on social media platforms like LinkedIn, Twitter, youtube or industry-specific forums.Professional Networking</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Exclusive Event Invitations: You will receive invitations to industry-related events, conferences, and webinars, allowing you to network, share insights, and gain exposure for your brand. Professional Networking</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Contribute guest posts to well-respected industry blogs.          Guest Blogging and Speaking Engagements</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Recommendation opportunities to speak at conferences or webinars.Guest Blogging and Speaking Engagements</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Set up Google Alerts to monitor mentions of your name and respond to any mentions.Google Alerts and Reputation Management</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Get a personalized dashboard that allows you to track and analyse the collective impact of your activities on various social media platforms, providing valuable insights into your digital performance.  Analytics and Measurement Basic</span></div>
            
          </div>
          <div class="bestValueBand">Best Value</div>
          <div class="icon-div">
               <span class="cs-btn cs-style1 mb-2"><i class="fa fa-arrow-right"></i></span>
           </div>
        </div>
      </div>
      
      <!-- Premium Plan -->
      <div class="col-lg-4">
        <div class="card planCard">
          <div class="card-header">
            <div class="text-center upperhead">Premium</div>
            <div class="text-center lowerhead"><span>$20</span><sub>/Month</sub></div>
          </div>
          <div class="card-body">
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Craft a personal brand statement that communicates who you are and what you stand for. Personal Brand Development</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Dedicated Brand Showcase: Your profile will receive a prominent position on our website, showcasing your brand and story. (up to: 5 days/month) Personal Brand Development</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Featured Story Placement: Your story will be featured on our homepage and across various sections, gaining greater visibility among our audience. ( upto: 5 days/month)                   Personal Brand Development</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Brand Logo Display: Your brand logo will be displayed alongside your stories, creating a strong visual association.Personal Brand Development</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Create an online portfolio or personal landing webpage showcasing your work, projects, and achievements.Online Portfolio</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span
                > Customizable Templates: Gain access to exclusive templates designed to help you create visually appealing and engaging posts, saving you time and effort. Online Portfolio</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span
                >Invite you for a Podcast where you discuss relevant industry issues and topics. Podcast</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Optimize your online presence to ensure your name ranks well in search engine results. Personal SEO</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span> Social Proof and Recommendations:Personal SEO</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Encourage colleagues and clients to provide recommendations and endorsements on platforms like LinkedIn. Personal SEO</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Get a personalized dashboard that allows you to track and analyse the collective impact of your activities on various social media platforms, providing valuable insights into your digital performance.  Analytics and Measurement Deeper</span></div>
            <div class="includes"><i class="fa fa-check-circle check"></i><span>Collaborative Projects: We will connect you with like-minded brands and individuals for collaborative projects, allowing you to tap into new audiences and create compelling content together. Collaboration</span></div>
          </div>
          <div class="icon-div">
               <span class="cs-btn cs-style1 mb-2"><i class="fa fa-arrow-right"></i></span>
           </div>
        </div>
      </div>
    </div>
  </div> <!-- Col Ends -->
</div> <!-- Row Ends -->

    
  </div> 
   
   <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
        
        </body>
    </html>