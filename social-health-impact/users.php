<?php 
    include("functions.php");
    $postObj = new submitqueries();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" ">
    <meta name="author" content="WAHStory">
    <title>Social Footprints</title>
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
	.table{
	    text-wrap: nowrap;
	}
	    tbody, td, tfoot, th, thead, tr{
	        border-width: 1px;
	    }
	    
	    .progress-wrap{
		width: 100%;
		height: 30px;
		position: relative;		
		display: flex;
		align-items: center;
		margin-bottom: 10px;
		transition: all .2s;
	
	}
	.progress-inner{
		/*position: absolute;*/
		top: 0;
		left: 0;
		background: #4fc3f7;
		width: 0;
		z-index: 1;
		height: 30px;
		text-align: right;
		transition: width 1.3s ease;
	}
	.progress-value{
		margin-left: 5px;
		font-size: 18px;
	    color: #000;	
	}
	
	.progress-wrap:hover .progress-inner{
	    background: #4ff7e1;
	}
	.progress-graphs p{
	    color: #000;
	    font-size: 12px;
	}
	
	.keyword-usability p{
	    text-align: right;
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
	    <div class="row">
	       <div class="col-xl-12 col-lg-12">
	       
	       </div>
	       <div class="col-xl-12 col-lg-12">
	           <div class="table-responsive">
	               <table class="table">
	            <tr align="center">
	                <th colspan="5">Personal Information</th>
	                <th colspan="2">Social Media Engagement</th>
	                <th colspan="2">Frequency and Content</th>
	                <th>Objectives of Social Media Engagement</th>
	                <th colspan="2">Impact and Perception</th>
	                
	                <th colspan="2">Time Management</th>
	                
	                <th colspan="2">Content Strategy</th>
	                
	                <th colspan="2">Engagement Metrics</th>
	                
	                <th colspan="2">Objectives and Target Audience</th>
	                <th colspan="2">Challenges and Improvement</th>
	                <th colspan="2">Influencer and Advertisements</th>
	                <th>Preferred Social Media Platform</th>
	                <th colspan="2">Self-Perception</th>
	                
	                <th>Overall Impact Assessment</th>
	                <th>Additional Comments</th>
	                
	                <th rowspan="2">Date</th> 
	            </tr>
	            <tr>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Phone</th>
	                <th>Occupation</th>
	                <th>Company</th>
	                
	                <th>Actively engage social</th>
	                <th>Social platforms</th>
	                <th>frequently interaction</th>
	                <th>Sharing content type</th>
	                <th>Primary objectives</th>
	                <th>Perceive the impact</th>
	                <th>Digital presence</th>
	                <th>Spends time on platform</th>
	                <th>Is time well spent</th>
	                <th>Content balance</th>
	                <th>Engage content type</th>
	                
	                <th>Monitor engagement</th>
	                <th>Incorporate engagement</th>
	                
	                <th>Important objective</th>
	                <th>Primary target audience </th>
	                
	                <th>Challenges you face</th>
	                <th>Areas of improvement </th>
	                
	                <th>Influencers follower </th>
	                <th>Purchase from influencer</th>
	                
	                <th>Preferred Platform  </th> 
	                
	                <th>Self-Perception  </th> 
	                <th>Compared activity</th> 
	                
	                <th>Overall digital presence</th> 
	                
	                <th>Additional Comments</th> 
	            </tr>
	       <?php foreach($postObj->getSocialFootprints() as $footprints){?>
	            <tr>
	               <td><?=$footprints['name'];?></td>
	               <td><?=$footprints['email'];?></td>
	               <td><?=$footprints['phone'];?></td>
	               <td><?=$footprints['occupation'];?></td>
	               <td><?=$footprints['company'];?></td>
	               
	               <td><?=$footprints['professionalpurposes'];?></td>
	               <td><?=$footprints['social_platforms'];?></td>
	               <td><?=$footprints['interactwithplatform'];?></td>
	               <td><?=$footprints['content_type'];?></td>
	               <td><?=$footprints['primary_objectives'];?></td>
	               <td><?=$footprints['impactsocial_social_engagement'];?></td>
	               <td><?=$footprints['digital_presence'];?></td>
	               <td><?=$footprints['average_spend_time'];?></td>
	               <td><?=$footprints['is_time_well_spent'];?></td>
	               <td><?=$footprints['personal_professional_balance'];?></td>
	               <td><?=$footprints['content_type_engage'];?></td>
	               <td><?=$footprints['monitor_engagement_metrics'];?></td>
	               <td><?=$footprints['incorporate_engagement_metrics'];?></td>
	               <td><?=$footprints['important_social_objective'];?></td>
	               <td><?=$footprints['primary_target_audience'];?></td>
	               <td><?=$footprints['social_impact_challenges'];?></td>
	               <td><?=$footprints['areas_of_improvement'];?></td>
	               <td><?=$footprints['social_media_influencers'];?></td>
	               <td><?=$footprints['service_recommendation'];?></td>
	               <td><?=$footprints['prefered_social'];?></td>
	               <td><?=$footprints['self_esteem'];?></td>
	               <td><?=$footprints['compared_social_activity'];?></td>
	               <td><?=$footprints['overall_digital_presence'];?></td>
	               <td><?=$footprints['additional_comments'];?></td>
	               <td><?=$footprints['date'];?></td>
	               
	            </tr>
	       <?php } ?>
	        </table>
	           </div>
	        
	        <br>
	        <br>
	        
	        <div class="table-responsive">
	               <table class="table">
	            <tr align="center">
	                <th colspan="5">Personal Information</th>
	                <th colspan="2">Social Media Engagement - 11</th>
	                <th colspan="2">Frequency and Content - 10</th>
	                <th>Objectives of Social Media Engagement - 22</th>
	                <th colspan="2">Impact and Perception - 8</th>
	                
	                <th colspan="2">Time Management - 9</th>
	                
	                <th colspan="2">Content Strategy</th>
	                
	                <th colspan="2">Engagement Metrics - 28</th>
	                
	                <th colspan="2">Objectives and Target Audience - 8</th>
	                <th colspan="2">Challenges and Improvement - 31</th>
	                <th colspan="2">Influencer and Advertisements</th>
	                <th>Preferred Social Media Platform</th>
	                <th colspan="2">Preferred Social Media Platform</th>
	                
	                <th>Overall Impact Assessment</th>
	                <th>Additional Comments</th>
	                
	                <th rowspan="2">Date</th> 
	            </tr>
	            <tr>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Phone</th>
	                <th>Occupation</th>
	                <th>Company</th>
	                <th>Actively engage social - 5</th>
	                <th>Social platforms - 6</th>
	                <th>frequently interaction - 5</th>
	                <th>Sharing content type - 5</th>
	                <th>Primary objectives - 22</th>
	                <th>Perceive the impact - 4</th>
	                <th>Digital presence - 4</th>
	                <th>Spends time on platform - 5</th>
	                <th>Is time well spent - 4</th>
	                <th>Content balance - 4</th>
	                <th>Engage content type</th>
	                
	                <th>Monitor engagement - 24</th>
	                <th>Incorporate engagement - 4</th>
	                
	                <th>Important objective - 4</th>
	                <th>Primary target audience - 4</th>
	                
	                <th>Challenges you face - 15</th>
	                <th>Areas of improvement - 16</th>
	                
	                <th>Influencers follower </th>
	                <th>Purchase from influencer</th>
	                
	                <th>Prefered Platform  </th> 
	                
	                <th>Self-esteem  </th> 
	                <th>Compared activity</th> 
	                
	                <th>Overall digital presence</th> 
	                
	                <th>Additional Comments</th> 
	            </tr>
	       <?php 
	       $i = 0;
	       
	       $NewsandCurrentEventsCount = $EntertainmentCount = $PersonalUpdatesCount = $InspirationalCount = $EducationalCount = $ProductCount = $OthersCount = 0;
	       
	       
	       foreach($postObj->getSocialFootprints() as $footprints){?>
	            <tr>
	               <td><?=$footprints['name'];?></td>
	               <td><?=$footprints['email'];?></td>
	               <td><?=$footprints['phone'];?></td>
	               <td><?=$footprints['occupation'];?></td>
	               <td><?=$footprints['company'];?></td>
	       <?php 
	   //0
	        switch($footprints['professionalpurposes']){
	            case '1-2':
	            $professionalpurposes = 1;
	            break;
	            case '3-4':
	            $professionalpurposes = 3;
	            break;
	            case '5 or more':
	            $professionalpurposes = 5;
	            break;
	       }
	    
	    //1  
        $social_platforms_array = explode(",", $footprints['social_platforms']);
        $social_platforms_score = $social_platforms_others = 0;
        foreach ($social_platforms_array as $social_platforms) {
            if (in_array($social_platforms, ['Instagram', 'Facebook', 'LinkedIn', 'YouTube', 'Twitter'])) {
                $social_platforms_score += 1;
            } else {
                $social_platforms_others = 1;
            }
        }
        $social_platforms_score = $social_platforms_score + $social_platforms_others;
        
        //2
        switch($footprints['interactwithplatform']){
	            case 'Multiple times a day':
	            $interactwithplatform = 5;
	            break;
	            case 'Once a day':
	            $interactwithplatform = 4;
	            break;
	            case 'A few times a week':
	            $interactwithplatform = 3;
	            break;
	            case 'Rarely':
	            $interactwithplatform = 2;
	            break;
	       }
	       
	    //3   
        $content_types_array = explode(",", $footprints['content_type']);
        $content_types_score = $content_types_others = 0;
        foreach ($content_types_array as $content_types) {
            if (in_array($content_types, ['Images', 'Articles', 'Videos', 'Opinions'])) {
                $content_types_score += 1;
            } else {
                $content_types_others = 1;
            }
        }
        $content_types_score = $content_types_score + $content_types_others;
        
        //4
        $primary_objectives_array = explode(",", $footprints['primary_objectives']);
        $primary_objective_score = $primary_objective_others = 0;
            foreach ($primary_objectives_array as $primary_objective) {
                if (in_array($primary_objective, ['Personal branding', 'Networking', 'Thought leadership', 'Entertainment'])) {
                    $primary_objective_score += 4;
                } elseif ($primary_objective == 'Showcasing products/services') {
                    $primary_objective_score += 3;
                } elseif (!in_array($primary_objective, ['Personal branding', 'Networking', 'Thought leadership', 'Entertainment', 'Showcasing products/services'])) {
                    $primary_objective_others = 3;
                }
        }
        $primary_objective_score = $primary_objective_score + $primary_objective_others;
        
        //5
        $perception_options = [
            'Minimal' => 1,
            'Moderate' => 2,
            'Strong' => 3,
            'Very strong' => 4
        ];
        
        $impactsocial_engagement = $perception_options[$footprints['impactsocial_social_engagement']];
        
        //6
        $digital_presence = $perception_options[$footprints['digital_presence']];
        //7
        $time_options = [
            'Less than 30 minutes' => 2,
            '30 minutes - 1 hour' => 3,
            '1-2 hours' => 4,
            'More than 2 hours' => 5
        ];
        $average_spend_time = $time_options[$footprints['average_spend_time']];
        
        //8
        $bhoolean_options = [
            'Yes' => 4,
            'No' => 2
            ];
        $is_time_well_spent = $bhoolean_options[$footprints['is_time_well_spent']];
        
        //9
        $balance_options = [
            'Mostly personal' => 2,
            'Balanced mix' => 3,
            'Mostly professional' => 4
            ];
        $personal_professional_balance = $balance_options[$footprints['personal_professional_balance']];
    
        //10
        $monitor_engagement_metrics_array = explode(",", $footprints['monitor_engagement_metrics']);
        $monitor_engagement_metrics_score = $monitor_engagement_metrics_others = 0;
        foreach ($monitor_engagement_metrics_array as $monitor_engagement_metrics) {
            if (in_array($monitor_engagement_metrics, ['Likes', 'Comments', 'Shares', 'Clicks', 'Impressions', 'Conversion'])) {
                $monitor_engagement_metrics_score += 4;
            } else {
                $monitor_engagement_metrics_others = 3;
            }
        }
        $monitor_engagement_metrics_score = $monitor_engagement_metrics_score + $monitor_engagement_metrics_others;
    
        //11
        $feedback_options = [
            'Regularly adjust content' => 4,
            'Occasionally adjust content' => 3,
            'Rarely adjust content' => 2
            ];
        $incorporate_engagement_metrics_score = $feedback_options[$footprints['incorporate_engagement_metrics']];
        
        //12
        $sl_obj_options = [
                'Building a personal brand' => 4,
                'Connecting with friends and colleagues' => 3,
                'Promoting products or services' => 4,
                'Sharing insights' => 3,
                'Providing entertainment' => 3
            ];
        $important_social_objective_score = $sl_obj_options[$footprints['important_social_objective']];
        
        //13
        $pr_obj_options = [
                'General public' => 3,
                'Professionals in your industry' => 4,
                'Potential customers' => 4,
                'Friends and family' => 2,
            ];
        $primary_target_audience_values = $footprints['primary_target_audience'];
        if (isset($pr_obj_options[$primary_target_audience_values])) {
            $primary_target_audience_score = $pr_obj_options[$primary_target_audience_values];
        } 
        
        //14
        $social_impact_challenges_array = explode(",", $footprints['social_impact_challenges']);
        $social_impact_challenges_score = $social_impact_challenges_others = 0;
        foreach ($social_impact_challenges_array as $social_impact_challenges) {
            if (in_array($social_impact_challenges, ['Content creation', 'Consistency', 'Audience engagement', 'Time management'])) {
                $social_impact_challenges_score += 3;
            } else {
                $social_impact_challenges_others = 3;
            }
        }
        $social_impact_challenges_score = $social_impact_challenges_score + $social_impact_challenges_others;
        
     
        //15
        $areas_of_improvement_array = explode(",", $footprints['areas_of_improvement']);
        $areas_of_improvement_score = $areas_of_improvement_others = 0;
        foreach ($areas_of_improvement_array as $areas_of_improvement) {
            if (in_array($areas_of_improvement, ['Audience engagement', 'Metrics tracking', 'Time management'])) {
                $areas_of_improvement_score += 3;
            }elseif (in_array($areas_of_improvement, ['Content strategy'])) {
                $areas_of_improvement_score += 4;
            } else {
                $areas_of_improvement_others = 3;
            }
        }
        $areas_of_improvement_score = $areas_of_improvement_score + $areas_of_improvement_others;
	       
	       ?>
	               
	               <td><?=$professionalpurposes;?></td>
	               <td><?=$social_platforms_score;?></td>
	               <td><?=$interactwithplatform;?></td>
	               <td><?=$content_types_score?></td>
	               <td><?=$primary_objective_score;?></td>
	               <td><?=$impactsocial_engagement;?></td>
	               <td><?=$digital_presence;?></td>
	               <td><?=$average_spend_time;?></td>
	               <td><?=$is_time_well_spent;?></td>
	               <td><?=$personal_professional_balance;?></td>
	               <td><?=$footprints['content_type_engage'];?></td>
	               <td><?=$monitor_engagement_metrics_score;?></td>
	               <td><?=$incorporate_engagement_metrics_score;?></td>
	               <td><?=$important_social_objective_score;?></td>
	               <td><?=$primary_target_audience_score;?></td>
	               <td><?=$social_impact_challenges_score;?></td>
	               <td><?=$areas_of_improvement_score;?></td>
	               
	               <td><?=$footprints['social_media_influencers'];?></td>
	               <td><?=$footprints['service_recommendation'];?></td>
	               <td><?=$footprints['prefered_social'];?></td>
	               <td><?=$footprints['self_esteem'];?></td>
	               <td><?=$footprints['compared_social_activity'];?></td>
	               <td><?=$footprints['overall_digital_presence'];?></td>
	               <td><?=$footprints['additional_comments'];?></td>
	               <td><?=$footprints['date'];?></td>
	               
	            </tr>
	    <?php
	   // Initialize a variable to count math students
	   
	   $content_type_engage_array = explode(",", $footprints['content_type_engage']);
	   
        foreach ($content_type_engage_array as $content_type_engage) {
	   
        if (in_array($content_type_engage, ['News and Current Events'])) {
                $NewsandCurrentEventsCount += 1;
            }
        if (in_array($content_type_engage, ['Entertainment'])) {
                $EntertainmentCount += 1;
            }
        if (in_array($content_type_engage, ['Personal Updates from Friends and Family'])) {
                $PersonalUpdatesCount += 1;
            }
        if (in_array($content_type_engage, ['Inspirational or Motivational Posts'])) {
                $InspirationalCount += 1;
            }
        if (in_array($content_type_engage, ['Educational/Informative Content'])) {
                $EducationalCount += 1;
            }
        if (in_array($content_type_engage, ['Product/Service Recommendations'])) {
                $ProductCount += 1;
            }
        if (!in_array($content_type_engage, ['News and Current Events', 'Entertainment', 'Personal Updates from Friends and Family', 'Inspirational or Motivational Posts', 'Educational/Informative Content', 'Product/Service Recommendations']) && $content_type_engage !='') {
                $OthersCount += 1;
                
            }
            
        }
	   
	       $i++; } ?>
	        </table>
	           </div>
	        
	       </div>
	         
	    </div>
	    <!-- /row-->
	</div>
	<!-- /container-fluid --> 

<div class="container progress-graphs">
    <div class="row">
        <div class="col-md-6 keyword-usability"> 
        
        <h3 class="text-center mt-4">Engage content type	</h3>
        <hr class="mb-4 mt-2">
        <div class="row">
            <div class="col-md-6">
                <p>News and Current Events</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($NewsandCurrentEventsCount/$i*100);?>%</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <p>Entertainment (e.g., memes, videos)</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($EntertainmentCount/$i*100)?>%</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>Personal Updates from Friends and Family</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($PersonalUpdatesCount/$i*100)?>%</div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>Inspirational or Motivational Posts</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($InspirationalCount/$i*100)?>%</div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <p>Educational/Informative Content</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($EducationalCount/$i*100)?>%</div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <p>Product/Service Recommendations</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($ProductCount/$i*100)?>%</div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <p>Others</p>
            </div>
            <div class="col-md-6">
                <div class="progress-wrap">
                	<div class="progress-inner">	
                	</div>
                	<div class="progress-value"><?=round($OthersCount/$i*100)?>%</div>
                </div>
            </div>
            
        </div>
        
        </div>
    </div>
    
    
</div>
	
<style>
    .News-width {
		width: <?=round($NewsandCurrentEventsCount/$i*100);?>%; 
	}
	.Entertainment-width {
		width: <?=round($EntertainmentCount/$i*100);?>%; 
	}
	.PersonalUpdates-width {
		width: <?=round($PersonalUpdatesCount/$i*100);?>%; 
	}
	.Inspirational-width {
		width: <?=round($InspirationalCount/$i*100);?>%; 
	}
	.Educational-width {
		width: <?=round($EducationalCount/$i*100);?>%; 
	}
	.Product-width {
		width: <?=round($ProductCount/$i*100);?>%; 
	}
	.Others-width {
		width: <?=round($OthersCount/$i*100);?>%; 
	}
</style>
	
	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/common_functions.js"></script>
	<script src="js/file-validator.js"></script>

	<!-- Wizard script-->
	<script src="js/func_1.js"></script>
   
    
    <script>
    	document.addEventListener("DOMContentLoaded", function() {
            var progressInners = document.querySelectorAll(".progress-inner");
            var classNames = ["News-width", "Entertainment-width", "PersonalUpdates-width", "Inspirational-width", "Educational-width", "Product-width", "Others-width"];
            progressInners.forEach(function(progressInner, index) {
                if (index < classNames.length) {
                    progressInner.classList.add(classNames[index]);
                }
            });
        });
    </script>

</body>
</html>