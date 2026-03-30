<?php 
session_start();

ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include("functions.php");
    $postObj = new SocialHealth();
    
    if(isset($_POST['process'])){
        $submitted = $postObj->PostSocialFootprintForm();
        
        if(isset($submitted) && $submitted === 'SUCCESS'){
            header('location: thankyou.php?message=Success');
        }
    }
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!==''){
        
        $UserRow = $postObj->getUserDataBYID($_SESSION['userid']);
        
        $ScoreROw = $postObj->getDataEmail($_SESSION['email']);
        
        if($ScoreROw != "ERROR"){
            // header('location: /social-health-impact/graphdash/');
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" ">
    <meta name="author" content="WAHStory">
    <title>Social Health Or Impact Assessment</title>

    <!-- Favicons-->
     <link rel="shortcut icon" href="/images/wah_fav.ico">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>
	
	<style>
	    
@media only screen and (max-width: 768px) {
    
    figure{
        display: none;
    }
    .content-left-wrapper{
        padding-top: 80px;
        padding-bottom: 0px;
    }
    #social {
        right: 20px;
    }
}
	</style>

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<div class="container-fluid">
	    <div class="row row-height">
	        <div class="col-xl-4 col-lg-4 content-left">
	            <div class="content-left-wrapper">
	                <a href="index.php" id="logo"><img src="/images/logos/logo-white.png" alt="" width="145" height=""></a>
	                <div id="social">
	                    <span>Follow Us</span>
	                    <ul>
	                        <li><a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank"><i class="icon-facebook"></i></a></li>
	                        <li><a href="https://www.instagram.com/wahstory/"  target="_blank"><i class="icon-instagram"></i></a></li>
	                        <li><a href="https://www.linkedin.com/company/wahstory/" target="_blank"><i class="icon-linkedin"></i></a></li>
	                    </ul>
	                </div>
	                <!-- /social -->
	                <div>
	                    <figure><img src="img/info_graphic_1.svg" alt="" class="img-fluid" width="270" height="270"></figure>
	                    <h2>Evaluate Your Social Footprint</h2>
	                    <p>Our Social Impact Assessment helps you understand your Digital Social Impact, offering insights into your strengths and opportunities for growth.</p>
	                    <br>
	                </div>
	                <div class="copy">© 2023 WAHStory</div>
	            </div>
	            <!-- /content-left-wrapper -->
	        </div>
	        <!-- /content-left -->
	        <div class="col-xl-8 col-lg-8 content-right" id="start">
	            
	            <div id="wizard_container">
	                <div id="top-wizard">
	           <?php if(isset($submitted) && $submitted === 'SUCCESS'){?>
	               <h3 style="background: #1a74042b; color: #065c01; padding: 8px 20px; border-radius: 5px;">Submitted Successfully!</h3>
	           <?php }elseif($submitted === 'ERROR'){  ?>
	            <h3 style="background: #7404042b; font-size: 14px; color: #e30d0d; padding: 8px 20px; border-radius: 5px;">Something went wrong, please try again.</h3>
	           <?php } ?>
	                    <span id="location">0 of 15 completed</span>
	                    <div id="progressbar"></div>
	                </div>
	                <!-- /top-wizard -->
	                <form id="wrapped" method="post" enctype="multipart/form-data">
	                    <input id="website" name="website" type="text" value="">
	                    <!-- Leave for security protection, read docs for details -->
	                    <div id="middle-wizard">
	                        <div class="step">
	                            <h2 class="section_title">Personal Information: </h2>
								
					<?php if(!isset($_SESSION['userid']) and $_SESSION['email']==''){?>
	                            <div class="form-group add_top_30">
	                                <label for="name">Full Name *</label>
	                                <input type="text" name="name" id="name" class="form-control required" onchange="getVals(this, 'name_field');">
	                            </div>
	                            
	                            <div class="form-group">
	                                <label for="email">Email Address *</label>
	                                <input type="email" name="email" id="email" class="form-control required" onchange="getVals(this, 'email_field');">
	                            </div>
	               <?php }else{ ?>
	                <input type="hidden" name="name" value="<?=$UserRow['firstname'].' '.$UserRow['lastname']?>">
	                <input type="hidden" name="email" value="<?=$UserRow['email']?>">
	               <?php }
	                    
	                    if(isset($_SESSION['userid']) && $UserRow['phone'] != ''){
	               ?>
	                    <input type="hidden" name="phone" id="phone" value="<?=$UserRow['phone']?>" class="form-control required">
	                    
	               <?php } else { ?>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="tel" name="phone" id="phone" class="form-control required">
                            </div>
	               <?php }  ?>
	                            
                                <div class="form-group">
	                               <div class="styled-select clearfix">
	                        <select class="form-control required" name="gender" id="backend_experience_1">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Prefer not to say</option>
	                        </select>
                                    </div>
                                </div>
	                                
	                            <div class="form-group">
	                                <label for="age">Age</label>
	                                <input type="number" name="age" id="age" class="form-control">
	                            </div>
	                            <div class="form-group">
	                                
	                                <div class="styled-select clearfix">
	                       <select class="form-control required" name="occupation">
                                        <option value="">Select Occupation</option>
                                        <option value="self_employed">Self employed</option>
                                        <option value="professional">Professional</option>
                                        <option value="salaried">Salaried</option>
                                        <option value="business">Business</option>
                                        <option value="student">Student</option>
                                        <option value="home_maker">Home-Maker</option>
                                        <option value="others">Others</option>
                                    </select>
	                             </div>
	                            
	                            </div>
	                            
	                            
	                            
	                            <div class="form-group">
	                                <label for="company">Company (if applicable):</label>
	                                <input type="text" name="company" id="company" class="form-control">
	                            </div>
	                            
	                            <!--<div class="text-center">
                                    <div class="form-group terms">
                                        <label class="container_check">Kindly acknowledge acceptance of our <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a> before proceeding with the form.
                                            <input type="checkbox" name="terms" value="1" class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>-->
								
	                        </div>
	                        <!-- /step-->

	                        <!-- /Start Branch ============================== -->
	                        <div class="step">
								<h2 class="section_title">Social Media Engagement</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								<div class="form-group add_top_20">
									<p>How many social media platforms do you actively engage with for personal and/or professional purposes?</p>
									<label class="container_radio version_2">1-2
										<input type="radio" name="professionalpurposes" value="1-2" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">3-4
										<input type="radio" name="professionalpurposes" value="3-4" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">5 or more
										<input type="radio" name="professionalpurposes" value="5 or more" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								
								<p class="add_top_30">Select the social media platforms you use for personal and/or professional engagement:</p>
								
								<div class="form-group">
								    <label class="container_check version_2">Facebook
								        <input type="checkbox" name="social_platforms[]" value="Facebook" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Instagram
								        <input type="checkbox" name="social_platforms[]" value="Instagram" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">LinkedIn
								        <input type="checkbox" name="social_platforms[]" value="LinkedIn" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">YouTube
								        <input type="checkbox" name="social_platforms[]" value="YouTube" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Twitter
								        <input type="checkbox" name="social_platforms[]" value="Twitter" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="social_platforms[]" class="form-control">
								</div>							
								
							</div>
							
							<!-- /Start Step 3 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Frequency and Content</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								<div class="form-group add_top_20">
									<p>How frequently do you post or interact with content on each platform?</p>
									<label class="container_radio version_2">Multiple times a day
										<input type="radio" name="interactwithplatform" value="Multiple times a day" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Once a day
										<input type="radio" name="interactwithplatform" value="Once a day" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">A few times a week
										<input type="radio" name="interactwithplatform" value="A few times a week" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Rarely
										<input type="radio" name="interactwithplatform" value="Rarely" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								
								<p class="add_top_30">Briefly describe the type of content you typically share or engage with on each platform:</p>
								
								<div class="form-group">
								    <label class="container_check version_2">Images
								        <input type="checkbox" name="content_type[]" value="Images" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Articles
								        <input type="checkbox" name="content_type[]" value="Articles" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Videos
								        <input type="checkbox" name="content_type[]" value="Videos" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Opinions
								        <input type="checkbox" name="content_type[]" value="Opinions" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="content_type[]" class="form-control">
								</div>							
								
							</div>
							
							<!-- /Start Step 4 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Objectives of Social Media Engagement</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								
								<p class="add_top_20">For each platform, what are your primary objectives of engaging with it? (Select multiple)</p>
								
								<div class="form-group">
								    <label class="container_check version_2">Personal branding
								        <input type="checkbox" name="primary_objectives[]" value="Personal branding" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Networking
								        <input type="checkbox" name="primary_objectives[]" value="Networking" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Showcasing products/services
								        <input type="checkbox" name="primary_objectives[]" value="Showcasing products/services" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Thought leadership
								        <input type="checkbox" name="primary_objectives[]" value="Thought leadership" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<div class="form-group">
								    <label class="container_check version_2">Entertainment
								        <input type="checkbox" name="primary_objectives[]" value="Entertainment" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="primary_objectives[]" class="form-control">
								</div>							
								
							</div>
							

							<!-- /Start Step 5 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Impact and Perception</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								<div class="form-group add_top_20">
									<p>How do you assess the impact of your social media engagement on your personal or professional objectives for each platform?</p>
									<label class="container_radio version_2">Minimal
										<input type="radio" name="impactsocial_social_engagement" value="Minimal" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Moderate
										<input type="radio" name="impactsocial_social_engagement" value="Moderate" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Strong
										<input type="radio" name="impactsocial_social_engagement" value="Strong" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Very strong
										<input type="radio" name="impactsocial_social_engagement" value="Very strong" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								
								<div class="form-group">
									<p class="add_top_30">How do you view your digital presence or influence on each platform?</p>
									<label class="container_radio version_2">Minimal
										<input type="radio" name="digital_presence" value="Minimal" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Moderate
										<input type="radio" name="digital_presence" value="Moderate" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Strong
										<input type="radio" name="digital_presence" value="Strong" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Very strong
										<input type="radio" name="digital_presence" value="Very strong" class="required">
										<span class="checkmark"></span>
									</label>
								</div>							
								
							</div>

							<!-- /Start Step 6 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Time Management</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								<div class="form-group add_top_20">
									<p>Estimate the average amount of time you spend on each platform per day (in minutes)</p>
									<label class="container_radio version_2">Less than 30 minutes
										<input type="radio" name="average_spend_time" value="Less than 30 minutes" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">30 minutes - 1 hour
										<input type="radio" name="average_spend_time" value="30 minutes - 1 hour" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">1-2 hours
										<input type="radio" name="average_spend_time" value="1-2 hours" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">More than 2 hours
										<input type="radio" name="average_spend_time" value="More than 2 hours" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								
								<div class="form-group">
									<p class="add_top_30">Do you find that your social media engagement is time well spent in achieving your objectives?</p>
									<label class="container_radio version_2">Yes
										<input type="radio" name="is_time_well_spent" value="Yes" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">No
										<input type="radio" name="is_time_well_spent" value="No" class="required">
										<span class="checkmark"></span>	
									</label> 
								</div>							
								
							</div>

							<!-- /Start Step 7 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Content Strategy</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> -->
								<div class="form-group add_top_20">
									<p>How would you describe the balance between personal and professional content in your social media posts on each platform?</p>
									<label class="container_radio version_2">Mostly personal
										<input type="radio" name="personal_professional_balance" value="Mostly personal" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Balanced mix
										<input type="radio" name="personal_professional_balance" value="Balanced mix" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Mostly professional
										<input type="radio" name="personal_professional_balance" value="Mostly professional" class="required">
										<span class="checkmark"></span>
									</label> 
								</div>
								
								<p class="add_top_20">What type of content do you primarily engage with on social media? (Select all that apply)</p>
								
								<div class="form-group">
								    <label class="container_check version_2">News and Current Events
								        <input type="checkbox" name="content_type_engage[]" value="News and Current Events" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Entertainment (e.g., memes, videos)
								        <input type="checkbox" name="content_type_engage[]" value="Entertainment" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Personal Updates from Friends and Family
								        <input type="checkbox" name="content_type_engage[]" value="Personal Updates from Friends and Family" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Inspirational or Motivational Posts
								        <input type="checkbox" name="content_type_engage[]" value="Inspirational or Motivational Posts" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<div class="form-group">
								    <label class="container_check version_2">Educational/Informative Content
								        <input type="checkbox" name="content_type_engage[]" value="Educational/Informative Content" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<div class="form-group">
								    <label class="container_check version_2">Product/Service Recommendations
								        <input type="checkbox" name="content_type_engage[]" value="Product/Service Recommendations" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div> 
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="content_type_engage[]" class="form-control">
								</div>							
								
							</div>

							<!-- /Start Step 8 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Engagement Metrics</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 
									<p class="add_top_30">How do you monitor engagement metrics for your posts on each platform?</p>
									 
								<div class="form-group">
								    <label class="container_check version_2">Likes/Reactions
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Likes" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Comments
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Comments" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Shares/Retweets
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Shares" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Clicks/Link Clicks
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Clicks" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Impressions/Reach
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Impressions" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Conversion (if applicable)
								        <input type="checkbox" name="monitor_engagement_metrics[]" value="Conversion" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								
								<div class="form-group">
									<p class="add_top_30">How do you incorporate engagement metrics and audience feedback into your content strategy?</p>
									<label class="container_radio version_2">Regularly adjust content
										<input type="radio" name="incorporate_engagement_metrics" value="Regularly adjust content" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Occasionally adjust content
										<input type="radio" name="incorporate_engagement_metrics" value="Occasionally adjust content" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Rarely adjust content
										<input type="radio" name="incorporate_engagement_metrics" value="Rarely adjust content" class="required">
										<span class="checkmark"></span>
									</label> 
								</div>
								
							</div>
							
							<!-- /Start Step 9 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Objective and Target Audience</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 
								
								
								<div class="form-group add_top_20">
									<p>For your social media engagement, which objective is the most important to you?</p>
									<label class="container_radio version_2">Building a personal brand
										<input type="radio" name="important_social_objective" value="Building a personal brand" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Connecting with friends and colleagues
										<input type="radio" name="important_social_objective" value="Connecting with friends and colleagues" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Promoting products or services
										<input type="radio" name="important_social_objective" value="Promoting products or services" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Sharing insights
										<input type="radio" name="important_social_objective" value="Sharing insights" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Providing entertainment
										<input type="radio" name="important_social_objective" value="Providing entertainment" class="required">
										<span class="checkmark"></span>
									</label> 
								</div>
								<div class="form-group">
									<p class="add_top_30">Who is your primary target audience for your social media engagement?</p>
									<label class="container_radio version_2">General public
										<input type="radio" name="primary_target_audience" value="General public" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Professionals in your industry
										<input type="radio" name="primary_target_audience" value="Professionals in your industry" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Potential customers
										<input type="radio" name="primary_target_audience" value="Potential customers" class="required">
										<span class="checkmark"></span>
									</label>
									<label class="container_radio version_2">Friends and family
										<input type="radio" name="primary_target_audience" value="Friends and family" class="required">
										<span class="checkmark"></span>
									</label>
									 
								</div>
								
							</div>


							<!-- /Start Step 10 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Challenges and Improvement</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 
									<p class="add_top_20">What challenges or obstacles do you face in maximizing the impact of your social media engagement?</p>
									 
								<div class="form-group">
								    <label class="container_check version_2">Content creation
								        <input type="checkbox" name="social_impact_challenges[]" value="Content creation" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Consistency
								        <input type="checkbox" name="social_impact_challenges[]" value="Consistency" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Audience engagement
								        <input type="checkbox" name="social_impact_challenges[]" value="Audience engagement" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Time management
								        <input type="checkbox" name="social_impact_challenges[]" value="Time management" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="social_impact_challenges[]" class="form-control" class="required">
								</div>	
								
								<p class="add_top_30">Are there specific areas of improvement you would like to focus on to enhance your digital presence and impact?</p>
								<div class="form-group">
								    <label class="container_check version_2">Content strategy
								        <input type="checkbox" name="areas_of_improvement[]" value="Content strategy" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Audience engagement
								        <input type="checkbox" name="areas_of_improvement[]" value="Audience engagement" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Metrics tracking
								        <input type="checkbox" name="areas_of_improvement[]" value="Metrics tracking" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<div class="form-group">
								    <label class="container_check version_2">Time management
								        <input type="checkbox" name="areas_of_improvement[]" value="Time management" class="required">
								        <span class="checkmark"></span>
								    </label>
								</div>
								<label>If Other <small>(Separated by comas)</small></label>
								<div class="form-group">
									<input type="text" name="areas_of_improvement[]" class="form-control" class="required">
								</div>								
																
							</div>
							
							

							
							
							
							<!-- /Start Step 10 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Influencer and Advertisements</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 
									
									<div class="form-group add_top_30">
										<p>Do you follow social media influencers (individuals who have a significant following and promote products/services)?</p>
										<label class="container_radio version_2">Yes
											<input type="radio" name="social_media_influencers" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">No
											<input type="radio" name="social_media_influencers" value="No" class="required">
											<span class="checkmark"></span>
										</label>
										 
									</div>

									<div class="form-group add_top_30">
										<p>Have you ever made a purchase based on a product/service recommendation from a social media influencer?</p>
										<label class="container_radio version_2">Yes
											<input type="radio" name="service_recommendation" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">No
											<input type="radio" name="service_recommendation" value="No" class="required">
											<span class="checkmark"></span>
										</label>
										 
									</div>									
							</div>

							<!-- /Start Step 10 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Preferred Social Media Platform</h2>
									<div class="form-group add_top_30">
										<p>Which social media platform do you prefer using the most for personal or professional purposes? (Select one)</p>
										
										<label class="container_radio version_2">Facebook
											<input type="radio" name="prefered_social" value="Facebook" class="required">
											<span class="checkmark"></span>
										</label>
										
										<label class="container_radio version_2">LinkedIn
											<input type="radio" name="prefered_social" value="LinkedIn" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">Instagram
											<input type="radio" name="prefered_social" value="Instagram" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">Twitter
											<input type="radio" name="prefered_social" value="Twitter" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">YouTube
											<input type="radio" name="prefered_social" value="YouTube" class="required">
											<span class="checkmark"></span>
										</label>
										<label class="container_radio version_2">TikTok
											<input type="radio" name="prefered_social" value="TikTok" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>

								<!-- /Start Step 10 ============================== -->
								<div class="step">
									<h2 class="section_title">Self-Perception</h2>
									<!-- <h3 class="main_question">Are you available for work?</h3> --> 
										
										<div class="form-group add_top_30">
											<p>Do you find that feedback and reactions you receive on social media influence you?</p>
											<label class="container_radio version_2">Yes, significantly
												<input type="radio" name="self_esteem" value="Yes significantly" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Somewhat
												<input type="radio" name="self_esteem" value="Somewhat" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Slightly
												<input type="radio" name="self_esteem" value="Slightly" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Not at all
												<input type="radio" name="self_esteem" value="Not at all" class="required">
												<span class="checkmark"></span>
											</label>
											
										</div>

										<div class="form-group add_top_30">
											<p>Have you ever compared your social media activity to that of others?</p>
											<label class="container_radio version_2">Yes, significantly
												<input type="radio" name="compared_social_activity" value="Yes significantly" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Occasionally
												<input type="radio" name="compared_social_activity" value="Occasionally" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Rarely
												<input type="radio" name="compared_social_activity" value="Rarely" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">No, Never
												<input type="radio" name="compared_social_activity" value="No Never" class="required">
												<span class="checkmark"></span>
											</label>
											
										</div>
								
							</div>
                            
                            <!-- /Start Step 11 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Overall Impact Assessment</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 
									<p class="add_top_20">On a scale of 1 to 10, how would you rate your overall digital presence and impact across all platforms?</p>
									 
								<div class="range">
								    <input type="range" id="range-scaler" name="overall_digital_presence" min="0" max="10" value="5" oninput="Scaler()">
                                    <div id="range-value">0</div>
								</div>
								
														
							</div>
							<!-- /Start Step 12 ============================== -->
	                        <div class="step">
								<h2 class="section_title">Additional Comments</h2>
								<!-- <h3 class="main_question">Are you available for work?</h3> --> 									 
								<div class="form-group">
								    <p class="add_top_20">Do you have any additional comments, thoughts, or insights regarding your social media engagement and its impact?</p>
								        <textarea name="additional_comments" class="form-control required" placeholder="Additional Comments"></textarea>								    
								</div>														
							</div>

	                        <div class="submit step" id="end">
	                            <div class="summary">
	                                <div class="wrapper">
	                                    <h3>Thank you, for your time<br><span id="name_field"></span>!</h3>
	                                    <p>Our assessment isn't just about scores – it's about cultivating a healthy digital ecosystem.</p>
	                                </div>
	                                
	                            </div>
	                        </div>
	                        <!-- /step last-->

	                    </div>
	                    <!-- /middle-wizard -->
	                    <div id="bottom-wizard">
	                        <button type="button" name="backward" class="backward">Prev</button>
	                        <button type="button" name="forward" class="forward">Next</button>
	                        <button type="submit" name="process" class="submit">Submit</button>
	                    </div>
	                    <!-- /bottom-wizard -->
	                </form>
	            </div>
	            <!-- /Wizard container -->
	        </div>
	        <!-- /content-right-->
	    </div>
	    <!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	
	
	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/common_functions.js"></script>
	<script src="js/file-validator.js"></script>

	<!-- Wizard script-->
	<script src="js/func_1.js"></script>

    <script>
    	const rangeScaler = document.getElementById("range-scaler");
    	const rangeValue = document.getElementById("range-value");
    
    	function Scaler(){
    		valPercent = (rangeScaler.value / rangeScaler.max)*100;
    		rangeScaler.style.background = `linear-gradient(to right, #e9204f ${valPercent}%, #d5d5d5 ${valPercent}%)`;
    		rangeValue.textContent = rangeScaler.value;
    	}
    	Scaler();
    </script>
</body>

</html>