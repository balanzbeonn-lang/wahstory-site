<?php 
    include("functions.php");
    $postObj = new SocialHealth();
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
    body{
        font-family: 'Inter', sans-serif;
        background: #fff;
    }
    .dashboard-title{
        color: #fff;
        text-align: center;
        font-size: 30px;
        font-weight: 500;
        padding: 5px 10px;
        font-family: 'Inter', sans-serif;
    }
        .genders-section, .age-section{
            font-size: 18px; 
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }
        .genders-section span{
            font-size: 18px;
            font-weight: 500;
            margin-left: 20px;
            font-family: 'Inter', sans-serif;
        }
        .gen-1{
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .age-section .gen-1{
            justify-content: space-between;
        } 
        h4{
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-family: 'Inter', sans-serif;
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
	}
	
	.keyword-usability p{
	    text-align: right;
	    
	    font-size: 12px;
	}
	.card{
	    min-height: 220px;
	}
	
	.card.custom-card {
        border-radius: .5rem;
        border: 0;
        background-color: #fff;
        box-shadow: 0 0.125rem 0 rgba(10,10,10,.04);
        position: relative;
        -webkit-margin-after: 1.5rem;
        margin-block-end: 1.5rem;
        width: 100%;
    }
    
    
.bg-light-success{
    background-color:#bbe7d3!important;
    border: 3px solid #006f3d !important;
}
.text-light-success{color: #006f3d !important;}

.bg-light-indigo{
    background-color: #e7d4ff!important;
    border: 3px solid #35155d !important;
}
.text-light-indigo{color: #35155d !important;}

.bg-light-danger{
    background-color: #f9d9d9!important;
    border: 3px solid #b31312 !important;
}
.text-light-danger{
    color: #b31312 !important;
}
.bg-light-purple{
    background-color: #f8d3f9!important;
    border: 3px solid #610c63 !important;
}
.text-light-purple{
    color: #610c63 !important;
}

    </style>
    
</head>

<?php 
 //Getting Totals of All Fields
 $Total_Activelyengagesocial = 0;
 
  $significantlyactivityCount = $OccasionallyactivityCount = $RarelyactivityCount = $NoNeveractivityCount = $significantlyPerceptionCount = $SomewhatPerceptionCount = $SlightlyPerceptionCount = $NotatallPerceptionCount = $LinkedInpreferedCount = $InstagrampreferedCount = $TwitterpreferedCount = $YouTubepreferedCount = $TikTokpreferedCount = $PurchaseinfluencersnoCount = $PurchaseinfluencersyesCount = $influencersyesCount = $influencersnoCount = $NewsandCurrentEventsCount = $EntertainmentCount = $PersonalUpdatesCount = $InspirationalCount = $EducationalCount = $ProductCount = $OthersCount = 0;
 $i = 0;
 foreach($postObj->getSocialFootprints() as $footprints){
     $i++;
    //1
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
        $Total_Activelyengagesocial += $professionalpurposes;
 
    //2
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
        $Total_social_platforms += $social_platforms_score;
    
    //3
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
       $Total_frequentlyinteraction += $interactwithplatform;
       
        
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
       
       if ($footprints['social_media_influencers'] === 'Yes') {
            $influencersyesCount++;
        } elseif ($footprints['social_media_influencers'] === 'No') {
            $influencersnoCount++;
        }
       if ($footprints['service_recommendation'] === 'Yes') {
            $PurchaseinfluencersyesCount++;
        } elseif ($footprints['service_recommendation'] === 'No') {
            $PurchaseinfluencersnoCount++;
        }
        
        $socialMediaCounts = [
            'LinkedIn' => &$LinkedInpreferedCount,
            'Instagram' => &$InstagrampreferedCount,
            'Twitter' => &$TwitterpreferedCount,
            'YouTube' => &$YouTubepreferedCount,
            'TikTok' => &$TikTokpreferedCount,
        ];
        
        if (isset($socialMediaCounts[$footprints['prefered_social']])) {
            $socialMediaCounts[$footprints['prefered_social']]++;
        }
        
        
        $self_PerceptionCounts = [
            'Yes significantly' => &$significantlyPerceptionCount,
            'Somewhat' => &$SomewhatPerceptionCount,
            'Slightly' => &$SlightlyPerceptionCount,
            'Not at all' => &$NotatallPerceptionCount,
        ];
        
        if (isset($self_PerceptionCounts[$footprints['self_esteem']])) {
            $self_PerceptionCounts[$footprints['self_esteem']]++;
        }
        
        $compared_activityCounts = [
            'Yes significantly' => &$significantlyactivityCount,
            'Occasionally' => &$OccasionallyactivityCount,
            'Rarely' => &$RarelyactivityCount,
            'No Never' => &$NoNeveractivityCount,
        ];
        
        if (isset($compared_activityCounts[$footprints['compared_social_activity']])) {
            $compared_activityCounts[$footprints['compared_social_activity']]++;
        }

       
       
 } //Main Foreach Ends
 
 $TotalRowCount = mysqli_num_rows($postObj->getSocialFootprints());
 
 //1
 $Total_ActivelyengagesocialValue = round($Total_Activelyengagesocial/(5*$TotalRowCount)*100);
 //2
 $Total_social_platformsValue = round($Total_social_platforms/(6*$TotalRowCount)*100);
 //3
 $Total_frequentlyinteractionValue = round($Total_frequentlyinteraction/(5*$TotalRowCount)*100);

 //4
 $influencersYesPer = ($influencersyesCount / $TotalRowCount) * 100;
 $influencersNoPer = ($influencersnoCount / $TotalRowCount) * 100;
 
 //5
 $PurchaseinfluencersYesPer = ($PurchaseinfluencersyesCount / $TotalRowCount) * 100;
 $PurchaseinfluencersNoPer = ($PurchaseinfluencersnoCount / $TotalRowCount) * 100;
 
 //6
 $LinkedInpreferedPer = round(($LinkedInpreferedCount / $TotalRowCount) * 100);
 $InstagrampreferedPer = round(($InstagrampreferedCount / $TotalRowCount) * 100);
 $TwitterpreferedPer = round(($TwitterpreferedCount / $TotalRowCount) * 100);
 $YouTubepreferedPer = round(($YouTubepreferedCount / $TotalRowCount) * 100);
 $TikTokpreferedPer = round(($TikTokpreferedCount / $TotalRowCount) * 100);

 //7
 $significantlyPerceptionPer = round(($significantlyPerceptionCount / $TotalRowCount) * 100);
 $SomewhatPerceptionPer = round(($SomewhatPerceptionCount / $TotalRowCount) * 100);
 $SlightlyPerceptionPer = round(($SlightlyPerceptionCount / $TotalRowCount) * 100);
 $NotatallPerceptionPer = round(($NotatallPerceptionCount / $TotalRowCount) * 100);

 //7
 $significantlyactivityPer = round(($significantlyactivityCount / $TotalRowCount) * 100);
 $OccasionallyactivityPer = round(($OccasionallyactivityCount / $TotalRowCount) * 100);
 $RarelyactivityPer = round(($RarelyactivityCount / $TotalRowCount) * 100);
 $NoNeveractivityPer = round(($NoNeveractivityCount / $TotalRowCount) * 100);

// echo $Total_frequentlyinteraction;
 ?>  
<body>
    
    <div class="container-fluid">
	    <div class="row"  style="background: #35155d;">
	       <div class="col-md-12 dashboard-title">
	         Score Dashboard  
	        </div>
	   </div>
	</div>
    
    <div class="container mt-4">
	    <div class="row">
	       <div class="col-md-3 col-lg-3 genders-section">
	         <div class="card custom-card bg-light-success text-light-success">
	           <div class="card-body">
	            <h4>
	                Sample Size
	            </h4>
	                <div class="gen-1">
    	                       <img src="https://alternawork.com/wp-content/uploads/2018/11/members-icon.png" width="30">
    	                        <span>10</span>
    	                   </div>
	                
	           </div>
	         </div>
	       </div>
	       <div class="col-md-3 col-lg-3 genders-section">
	         <div class="card custom-card  bg-light-indigo text-light-indigo">
	           <div class="card-body">
	               <h4>Gender</h4>
    	           <div class="row my-2">
    	               <div class="col-md-12 ">
    	                   <div class="gen-1">
    	                       <img src="img/female.png" width="20px"> 
    	                        <span>21%</span>
    	                   </div>
    	                   
    	               </div> 
    	           </div>
    	           <div class="row">
    	               <div class="col-md-12">
    	                   <div class="gen-1">
    	                       <img src="img/male.png" width="20px"> 
    	                        <span>79%</span>
    	                   </div>
    	               </div>
    	           </div>
	           </div>
	         </div>
	       </div>
	       <div class="col-md-3 col-lg-3 age-section">
	         <div class="card custom-card  bg-light-danger text-light-danger">
	         <div class="card-body">
	            <h4>Age Group</h4>
	           
	           <div class="row my-2">
	               <div class="col-md-12 ">
	                   <div class="gen-1">
	                       18 to 24 
	                        <span>24%</span>
	                   </div>
	                   <div class="gen-1">
	                       25 to 33 
	                        <span>40%</span>
	                   </div>
	                   <div class="gen-1">
	                       35 to 44 
	                        <span>26%</span>
	                   </div>
	                   <div class="gen-1">
	                       45+ 
	                        <span>10%</span>
	                   </div>
	                   
	               </div> 
	           </div>
	           
	         </div>
	        </div>
	           
	           
	       </div>
	       
	       <div class="col-md-3 col-lg-3 age-section ">
	            
	         <div class="card custom-card  bg-light-purple text-light-purple">
	           <div class="card-body">
	            
	            <h4>Occupation</h4>
	           
	           <div class="row my-2">
	               <div class="col-md-12 ">
	                   <div class="gen-1">
	                       Self Employed
	                        <span>10%</span>
	                   </div>
	                   <div class="gen-1">
	                       Professional 
	                        <span>12%</span>
	                   </div>
	                   <div class="gen-1">
	                       Salaried
	                        <span>18%</span>
	                   </div>
	                   <div class="gen-1">
	                       Business
	                        <span>18%</span>
	                   </div>
	                   <!--<div class="gen-1">
	                       Student
	                        <span>12%</span>
	                   </div>
	                   <div class="gen-1">
	                       Home Maker
	                        <span>13%</span>
	                   </div>
	                   <div class="gen-1">
	                       Others
	                        <span>17%</span>
	                   </div>-->
	                   
	               </div> 
	           </div>
            </div> 
           </div>
	           
	       </div>
	       
	   </div>
	   
	   
	   <div class="row mt-4">
	       <div class="col-md-3 text-center">
	           <h4 class="text-light-success">Actively engage social</h4>
	           <div id="SocialMediaEngagement"></div>
	       </div>
	       <div class="col-md-3 text-center">
	           <h4 class="text-light-indigo">Social platforms</h4>
	           <div id="FrequencyandContent"></div>
	       </div>
	       <div class="col-md-3 text-center">
	           <h4 class="text-light-danger">Frequently interaction</h4>
	           <div id="ObjectivesofSocialMediaEngagement"></div>
	       </div>
	       <div class="col-md-3 text-center">
	           <h4 class="text-light-purple">Sharing content type</h4>
	           <div id="ImpactandPerception"></div>
	       </div>
	   </div>
	   
	   <div class="row mt-2">
        <div class="col-md-4 keyword-usability"> 
        
        <h4 class="text-center mt-4 mb-2">Engage content type</h4>
        <hr class="mb-4 mt-0">
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
        
        <div class="col-md-4 keyword-usability">
            
        <h4 class="text-center mt-4 mb-2">Influencers follower</h4>
        <hr class="mb-4 mt-0">
        
            <div class="row">
                <div class="col-md-6">
                    <p>Yes</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=round($influencersYesPer);?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>No</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=round($influencersNoPer);?>%</div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 keyword-usability">
            
        <h5 class="text-center mt-4 mb-2">Purchase from influencer</h5>
        <hr class="mb-4 mt-0">
        
            <div class="row">
                <div class="col-md-6">
                    <p>Yes</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=round($PurchaseinfluencersYesPer);?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>No</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=round($PurchaseinfluencersNoPer);?>%</div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="col-md-4 keyword-usability">
            
        <h5 class="text-center mt-4 mb-2">Preferred Platform</h5>
        <hr class="mb-4 mt-0">
        
            <div class="row">
                <div class="col-md-6">
                    <p>LinkedIn</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$LinkedInpreferedPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Instagram</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$InstagrampreferedPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Twitter</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$TwitterpreferedPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>YouTube</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$YouTubepreferedPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>TikTok</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$TikTokpreferedPer;?>%</div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
        <div class="col-md-4 keyword-usability">
            
        <h5 class="text-center mt-4 mb-2">Self-Perception</h5>
        <hr class="mb-4 mt-0">
        
            <div class="row">
                <div class="col-md-6">
                    <p>Yes, significantly</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$significantlyPerceptionPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Somewhat</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$SomewhatPerceptionPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Slightly</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$SlightlyPerceptionPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Not at all</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$NotatallPerceptionPer;?>%</div>
                    </div>
                </div>
            </div> 
            
        </div>
        
        <div class="col-md-4 keyword-usability">
            
        <h5 class="text-center mt-4 mb-2">Compared Social Activity</h5>
        <hr class="mb-4 mt-0">
        
            <div class="row">
                <div class="col-md-6">
                    <p>Yes, significantly</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$significantlyactivityPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Occasionally</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$OccasionallyactivityPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Rarely</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$RarelyactivityPer;?>%</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>No, Never</p>
                </div>
                <div class="col-md-6">
                    <div class="progress-wrap">
                    	<div class="progress-inner">	
                    	</div>
                    	<div class="progress-value"><?=$NoNeveractivityPer;?>%</div>
                    </div>
                </div>
            </div> 
            
        </div>
        
        
    </div>
	   <div class="row">
	       <div class="col-md-3">
	           <!--<div class="IndividualTop3Skills"></div>-->
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
	
	.influenceYes-width {
		width: <?=round($influencersyesCount/$TotalRowCount*100);?>%; 
	}
	.influenceNo-width {
		width: <?=round($influencersnoCount/$TotalRowCount*100);?>%; 
	}
	.PurchaseinfluenceYes-width {
		width: <?=round($PurchaseinfluencersyesCount/$TotalRowCount*100);?>%; 
	}
	.PurchaseinfluenceNo-width {
		width: <?=round($PurchaseinfluencersnoCount/$TotalRowCount*100);?>%; 
	}
	.LinkedInprefered-width {
		width: <?=$LinkedInpreferedPer?>%; 
	}
	.Instagramprefered-width {
		width: <?=$InstagrampreferedPer?>%; 
	}
	.Twitterprefered-width {
		width: <?=$TwitterpreferedPer?>%; 
	}
	.YouTubeprefered-width {
		width: <?=$YouTubepreferedPer?>%; 
	}
	.TikTokprefered-width {
		width: <?=$TikTokpreferedPer?>%; 
	}
	
	
	.significantlyPerception-width {
		width: <?=$significantlyPerceptionPer?>%; 
	}
	.SomewhatPerception-width {
		width: <?=$SomewhatPerceptionPer?>%; 
	}
	.SlightlyPerception-width {
		width: <?=$SlightlyPerceptionPer?>%; 
	}
	.NotatallPerception-width {
		width: <?=$NotatallPerceptionPer?>%; 
	}
	
	.significantlyactivityPer-width {
		width: <?=$significantlyactivityPer?>%; 
	}
	.OccasionallyactivityPer-width {
		width: <?=$OccasionallyactivityPer?>%; 
	}
	.RarelyactivityPer-width {
		width: <?=$RarelyactivityPer?>%; 
	}
	.NoNeveractivityPer-width {
		width: <?=$NoNeveractivityPer?>%; 
	}
</style>
 
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>



<script>
    	document.addEventListener("DOMContentLoaded", function() {
            var progressInners = document.querySelectorAll(".progress-inner");
            var classNames = ["News-width", "Entertainment-width", "PersonalUpdates-width", "Inspirational-width", "Educational-width", "Product-width", "Others-width", "influenceYes-width", "influenceNo-width", "PurchaseinfluenceYes-width", "PurchaseinfluenceNo-width", "LinkedInprefered-width", "Instagramprefered-width", "Twitterprefered-width", "YouTubeprefered-width", "TikTokprefered-width", "significantlyPerception-width", "SomewhatPerception-width", "SlightlyPerception-width", "NotatallPerception-width", "significantlyactivityPer-width", "OccasionallyactivityPer-width", "RarelyactivityPer-width", "NoNeveractivityPer-width"];
            progressInners.forEach(function(progressInner, index) {
                if (index < classNames.length) {
                    progressInner.classList.add(classNames[index]);
                }
            });
        });
    </script>



<script src="css/c3/apexcharts.min.js"></script>

<script>
    $(function () {
  "use strict";

    var visitors = {
    series: [<?=$Total_ActivelyengagesocialValue?>, <?=100-$Total_ActivelyengagesocialValue?>],
    chart: {
      type: "donut",
      height: 200,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "47",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 8,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "25px",
              color: "#006f3d",
              label: <?=$Total_ActivelyengagesocialValue?>,
            },
          },
        },
      },
    },
    colors: ["#006f3d", "#bbe7d3"],
    tooltip: {
      show: false,
      enabled: false,
    },
    legend: {
      show: false,
    },
    labels: ["<?=$Total_ActivelyengagesocialValue?>", "<?=100-$Total_ActivelyengagesocialValue?>"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector("#SocialMediaEngagement"),
    visitors
  );
  chart_pie_donut.render();

//2
var visitors = {
    series: [<?=$Total_social_platformsValue?>, <?=100-$Total_social_platformsValue?>],
    chart: {
      type: "donut",
      height: 200,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "47",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 8,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "25px",
              color: "#35155D",
              label: <?=$Total_social_platformsValue?>,
            },
          },
        },
      },
    },
    colors: ["#35155D", "#e7d4ff"],
    tooltip: {
      show: false,
      enabled: false,
    },
    legend: {
      show: false,
    },
    labels: ["<?=$Total_social_platformsValue?>", "<?=100-$Total_social_platformsValue?>"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector("#FrequencyandContent"),
    visitors
  );
  chart_pie_donut.render();
  
  //ObjectivesofSocialMediaEngagement
    var visitors = {
    series: [<?=$Total_frequentlyinteractionValue?>, <?=100-$Total_frequentlyinteractionValue?>],
    chart: {
      type: "donut",
      height: 200,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "47",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 8,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "25px",
              color: "#B31312",
              label: <?=$Total_frequentlyinteractionValue?>,
            },
          },
        },
      },
    },
    colors: ["#B31312", "#f9d9d9"],
    tooltip: {
      show: false,
      enabled: false,
    },
    legend: {
      show: false,
    },
    labels: ["<?=$Total_frequentlyinteractionValue?>", "<?=100-$Total_frequentlyinteractionValue?>"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector("#ObjectivesofSocialMediaEngagement"),
    visitors
  );
  chart_pie_donut.render();
  
  
  //ImpactandPerception
    var visitors = {
    series: [55, 45],
    chart: {
      type: "donut",
      height: 200,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "47",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 8,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "25px",
              color: "#610C63",
              label: 55,
            },
          },
        },
      },
    },
    colors: ["#610C63", "#f8d3f9"],
    tooltip: {
      show: false,
      enabled: false,
    },
    legend: {
      show: false,
    },
    labels: ["55", "45"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector("#ImpactandPerception"),
    visitors
  );
  chart_pie_donut.render();
  
  // -----------------------------------------------------------------------
  // Graph 8 (Pie Ring - Circle)
  // -----------------------------------------------------------------------
  var visitors = {
    series: [55, 45],
    labels: ["Individuals", "Global"],
    chart: {
      type: "radialBar",
      height: 230,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "67",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 8,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "13px",
              color: "#a1aab2",
              label: 46,
            },
          },
        },
      },
    },
    colors: ["#006f3d", "#1aa968"],
    tooltip: {
      show: false,
      enabled: false,
    },
    legend: {
      show: true,
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector(".IndividualTop3Skills"),
    visitors
  );
  chart_pie_donut.render();
  
    });
</script>

    
</body>
</html>
	
	
	