<?php 
session_start();
if(!isset($_SESSION['email']) and $_SESSION['email']==''){
        
        header('location: /login.php');
    }
    include("../functions.php");
    
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    
    $postObj = new SocialHealth();
    $DataRow = $postObj->getDataEmail($_SESSION['email']);
    
    
    if($DataRow == NULL || $DataRow == "ERROR"){
        header('location: /social-health-impact/socialfootprints.php');
    }
    
    
    $Memberscount = $postObj->getNoOfMembersCount();
    
     
    include('numericscore.php'); 
     
	$FinalScore = round(($UserTotalMarks / $MaxScore) * 100);
	$Remark = '';
	//Tag Define:
	if($FinalScore <= 50){
	        $Remark = 'Novice Engagers';
	}elseif($FinalScore > 50 && $FinalScore <=75){
	        $Remark = 'Balance Engagers';
	}elseif($FinalScore > 75 && $FinalScore <=90){
	        $Remark = 'Stratagic Engagers';
	}elseif($FinalScore > 90){
	        $Remark = 'Expert Engagers';
	}
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	
    <link rel="shortcut icon" href="https://www.wahstory.com/images/wah_fav.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<!-- PAGE TITLE HERE -->
	<title>Personal Dashboard</title>		
	<!-- Style css -->	
    <link href="css/style.css" rel="stylesheet">
    <link href="css/rangeslider.css" rel="stylesheet">
	
	<style>
		#AgeGrouppieChart .apexcharts-legend-text{
			color: #fff !important;
		}
		.color-tag .application svg{
		  margin-right: 2px;  
		}
		.donut-chart-sale small, .donut-chart-sale .small{
		    color: #ff5e83;
		}
		
		.scorelabel{
		    font-size: 14px;
		    color: #d3d3d3;
		}
		
		.remarkcover{
		    border-radius: 20px;
            border: 2px solid #da557c;
            text-align: center;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            justify-content: center;
		}
		.remarkcover h3{
		    margin-bottom: 0px;
            color: #da557c;
            font-weight: 700;
            line-height: 22px; 
		}
		.remarkcover p{
		    margin-bottom: 0px;
            font-size: 16px;
            line-height: 20px;
            color: #da557c;
		}
		
	</style>
		
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
        <div class="inner">
            <span>Loading </span>
            <div class="loading">  
            </div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
		<div class="animation">
			<span class="circle one"></span>
			<span class="circle two"></span>
			<span class="circle three"></span>
			<span class="circle four"></span>
			<span class="line-1 ">
				<svg width="1920" height="450" viewBox="0 0 1920 450" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.3" d="M0 155L95.4613 293.923C106.459 309.928 131.116 305.943 136.512 287.289L209.86 33.7127C215.892 12.8576 244.803 11.2033 253.175 31.2341L344.838 250.546C352.224 268.217 376.708 269.648 386.102 252.958L519.839 15.3693C529.061 -1.01332 552.975 -0.0134089 560.797 17.0818L716.503 357.389C724.454 374.766 748.899 375.43 757.782 358.51L902.518 82.8223C911.524 65.6685 936.406 66.653 944.028 84.4648L1093.06 432.731C1101.14 451.601 1128.01 451.247 1135.58 432.172L1291.33 39.9854C1298.27 22.5135 1322.1 20.2931 1332.14 36.1824L1473.74 260.126C1482.47 273.922 1502.38 274.494 1511.88 261.221L1667.88 43.3025C1678.17 28.9257 1700.16 31.0533 1707.5 47.1365L1844.91 348.06C1853.69 367.287 1881.58 365.486 1887.81 345.29L1970 79" stroke="url(#paint0_linear_332_3757)" stroke-opacity="0.4" stroke-width="6" stroke-linecap="round"/>
					<defs>
					<linearGradient id="paint0_linear_332_3757" x1="1946.24" y1="352.062" x2="-1.52124" y2="345.607" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#6E4AFF"/>
					<stop offset="0.479167" stop-color="#E43BFF"/>
					<stop offset="1" stop-color="#6E4AFF"/>
					</linearGradient>
					</defs>
				</svg>
			</span>
			<span class="line-2">
				<svg width="1920" height="459" viewBox="0 0 1920 459" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 89L103.191 296.201C112.034 313.958 137.703 312.941 145.114 294.54L224.847 96.5574C232.264 78.141 257.962 77.1423 266.786 94.9275L352.649 267.995C360.863 284.553 384.264 285.148 393.31 269.03L516.226 50.0159C525.164 34.0902 548.205 34.4325 556.666 50.6167L713.497 350.608C721.71 366.318 743.86 367.222 753.326 352.234L901.462 117.684C911.188 102.286 934.102 103.763 941.771 120.282L1091.14 442.062C1099.38 459.816 1124.62 459.817 1132.86 442.064L1303.17 75.2544C1310.64 59.1685 1332.73 57.2308 1342.89 71.7713L1469.94 253.703C1479.15 266.893 1498.71 266.794 1507.78 253.511L1671.82 13.4627C1681.74 -1.05968 1703.63 0.478486 1711.42 16.2459L1844.42 285.267C1853.64 303.905 1880.89 301.723 1887.02 281.857L1970 13" stroke="url(#paint0_linear_332_3758)" stroke-opacity="0.4" stroke-width="6" stroke-linecap="round"/>
					<defs>
					<linearGradient id="paint0_linear_332_3758" x1="1946.24" y1="286.062" x2="-1.52105" y2="279.607" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#6E4AFF"/>
					<stop offset="0.479167" stop-color="#E43BFF"/>
					<stop offset="1" stop-color="#6E4AFF"/>
					</linearGradient>
					</defs>
				</svg>	
			</span>
			
		</div>

        
        <div class="topheader">
            <div class="container-fluid">
                <div class="row align-items-center">
    		        <div class="col-lg-4 col-md-6"> 
    		            <!--<h3 class="mainheading">Social Digital Health Insights</h3>-->
    		            <a class="cs-site_branding" href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" width="150px">
                        </a>
    		        </div>
    		        
    		        <div class="col-lg-5 col-md-6">
    		        <div class="row">
    		            <div class="col-lg-6 col-md-6  py-2"> 
        		            <div class="remarkcover">
        		                <h3 class="mainheading"><?=$Remark?></h3>
        		            </div>
            		        
            		    </div>
    		            <div class="col-lg-6 col-md-12">
        		            <div class="anim-btnouter anim-btn ScoreBTN">
                                <button>Total Score: 
                                <strong id="TotalScore"><?=$FinalScore?></strong></button>
                                <span></span>
                                <span></span>
                             </div> 
        		             
        		        </div>
    		        </div>    
    		        </div>
    		        
    		        
    		        <div class="col-lg-3 col-md-12">
    		        
    		        <?php
    		        
    		            if($DataRow['username']) {
    		            
    		        ?>
    		                <div class="dropdown header-profile2 ">
							
							<a class="nav-link user-profile" href="javascript:void(0);"  role="button" data-bs-toggle="dropdown">
								<div class="header-info2 d-flex align-items-center">
								    <?php if($DataRow['image']){ ?>
								        <img src="/images/users/<?=$DataRow['image']?>">
								    <?php } else {?>
									    <img src="images/placeholder.png" alt="">
								    <?php } ?>
									<div class="d-flex align-items-center sidebar-info">
										<div class="user-info">
											<span class="font-w500 d-block  fs-5 text-white"><?=$DataRow['username']?></span>
											
										</div>
										<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.8334 1.08331L7.00002 6.91665L1.16669 1.08331" stroke="#FFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
											
									</div>
									
								</div>
							</a>
							<div class="dropdown-menu profile dropdown-menu-end">
								<a href="/users/" class="dropdown-item ai-icon" target="_blank">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
									<span class="ms-2">Dashboard </span>
								</a>
								<a href="/users/user.profile.php" class="dropdown-item ai-icon " target="_blank">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
									<span class="ms-2">Profile </span>
								</a>
								
								<a href="/logout?LogoutUser" class="dropdown-item ai-icon">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
									<span class="ms-2">Logout </span>
								</a>
							</div>
						</div>
						
					<?php
					
    		            }
					?>
						
    		        </div>
    		    </div>
                
            </div>
        </div>


		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
				<div class="col-xl-12 py-2">
         
				    <span class="application py-1 ps-0">
						<h4> Your Score <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="0.000488281" width="24" height="24" rx="3" fill="#ff5e83"/>
						</svg> &nbsp; &nbsp; &nbsp;
						 Global Score <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="0.000488281" width="24" height="24" rx="3" fill="#607180"/>
						</svg></h4>
					</span>
		        </div>
				    
				<div class="col-xl-9">
				 <div class="row">
					<div class="col-xl-4 ">
				
				<div class="row">
					
					<div class="col-xl-12 ">
					    
					    
					    
						<div class="card  pia-chart">
							<div class="card-header border-0 pb-0 pt-3 justify-content-center">
								<h4 class="mb-0 fs-18 font-w600.">Gender Breakdown</h4><br>
								
							</div>
							<div class="card-body py-3 px-3 d-flex align-items-center flex-wrap">
								<div id="GenderspieChart"></div>
								<div class="d-flex justify-content-center flex-wrap color-tag w-100">
									<span class="application pt-0 ps-0">
										<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.000488281" width="14" height="14" rx="3" fill="<?php if($DataRow['gender'] == 'Male'){ echo '#ff5e83'; }else{ echo '#607180';}?>"/>
										</svg>	
										Male
										<span class="ps-0">60%</span>
									</span>
									<span class="application pt-0 ps-2">
										<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.000488281" width="14" height="14" rx="3" fill="<?php if($DataRow['gender'] == 'Female'){ echo '#ff5e83'; }else{ echo '#607180';}?>"/>
										</svg>												
										Female	
										<span class="ps-0">20%</span>
									</span>
									<span class="application pt-0 ps-2">
										<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.000488281" width="14" height="14" rx="3" fill="<?php if($DataRow['gender'] == 'Other'){ echo '#ff5e83'; }else{ echo '#607180';}?>"/>
										</svg>												
										Other	
										<span class="ps-1">20%</span>
									</span>
									
								</div>
							</div>
														
						</div>
						
					</div>
					<div class="col-xl-12 ">
						
						<div class="card Expense overflow-hiddens">
							<div class="card-body p-3">	
								<div class="students1 two d-flex align-items-center justify-content-between ">
									<div class="content">
										<h4 class="mb-0 fs-18 font-w600."><?=$DataRow['average_spend_time']?></h4>
										<span class="mb-2 fs-14">Average Time Spent on Social Per Day/Platform </span>
									</div>
									<div>
										<div class="d-inline-block position-relative donut-chart-sale mb-3">
											<svg width="60" height="58" viewBox="0 0 60 58" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M39.0469 2.3125C38.3437 3.76563 38.9648 5.52344 40.418 6.22657C44.4609 8.17188 47.8828 11.1953 50.3203 14.9805C52.8164 18.8594 54.1406 23.3594 54.1406 28C54.1406 41.3125 43.3125 52.1406 30 52.1406C16.6875 52.1406 5.85937 41.3125 5.85937 28C5.85937 23.3594 7.18359 18.8594 9.66797 14.9688C12.0937 11.1836 15.5273 8.16016 19.5703 6.21485C21.0234 5.51173 21.6445 3.76563 20.9414 2.30079C20.2383 0.847664 18.4922 0.226569 17.0273 0.929694C12 3.34376 7.74609 7.09375 4.73437 11.8047C1.64062 16.6328 -1.56336e-06 22.2344 -1.31134e-06 28C-9.60967e-07 36.0156 3.11719 43.5508 8.78906 49.2109C14.4492 54.8828 21.9844 58 30 58C38.0156 58 45.5508 54.8828 51.2109 49.2109C56.8828 43.5391 60 36.0156 60 28C60 22.2344 58.3594 16.6328 55.2539 11.8047C52.2305 7.10547 47.9766 3.34375 42.9609 0.929693C41.4961 0.238287 39.75 0.84766 39.0469 2.3125V2.3125Z" fill="#ff5e83"/>
												<path d="M41.4025 26.4414C41.9767 25.8671 42.258 25.1171 42.258 24.3671C42.258 23.6171 41.9767 22.8671 41.4025 22.2929L34.0314 14.9218C32.9533 13.8437 31.5236 13.2578 30.0119 13.2578C28.5002 13.2578 27.0587 13.8554 25.9923 14.9218L18.6212 22.2929C17.4728 23.4414 17.4728 25.2929 18.6212 26.4414C19.7697 27.5898 21.6212 27.5898 22.7697 26.4414L27.0939 22.1171L27.0939 38.7695C27.0939 40.3867 28.4064 41.6992 30.0236 41.6992C31.6408 41.6992 32.9533 40.3867 32.9533 38.7695L32.9533 22.1054L37.2775 26.4296C38.4025 27.5781 40.2541 27.5781 41.4025 26.4414Z" fill="#ff5e83"/>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
										
					</div>
					<!--/column 3-->	
					
					<div class="col-xl-4 ">
						<div class="card pia-chart">
							<div class="card-header border-0 pb-0 pt-3 justify-content-center">
								<h4 class="mb-0 fs-18 font-w600.">Age Demographics</h4>
							</div>
							<div class="card-body py-3 px-0 d-flex align-items-center flex-wrap">
								<div id="AgeGrouppieChart"></div>
								
							</div>
														
						</div>	
					</div>
					<!--/column 3-->
					
					<div class="col-xl-4 ">
						
					 <div class="row">
					 <div class="col-xl-12">
						<div class="card pia-chart">
							<div class="card-header border-0 pb-0 pt-3 justify-content-center">
								<h4 class="mb-0 fs-18 font-w600.">Occupation Categories</h4>
							</div>
							<div class="card-body py-0 px-0 d-flex align-items-center flex-wrap">
								<div id="OccupationChart"></div>								
							</div>
														
						</div>
					 </div>
					 
					</div>
							
					</div>
					<!--/column 3-->
				 </div>
				</div>
				
				<div class="col-md-3">
					<div class="card balance-data">
						<div class="card-header border-0 pb-0 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Platform Preferences</h4>
						</div>
						<div id="preferredSocialChart"></div>
					</div>
				</div>
								
				</div>
				
				<div class="row">
				<div class="col-lg-9">
				  <div class="row">
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="card">
							<div class="card-body px-3 py-0">	
								<div class="students1 two d-flex align-items-center row">
									<div class="content col-md-8 py-0 pe-2">
										<h4 class="fs-18 font-w600">Time Spent</h4>
										
										<span class="mb-2 fs-14"> Is Time Well Spent on Social Media </span>
									</div>
									
									<div class="col-md-4 py-0 pe-0 ps-0">
										<div id="SocialTimeEffectiveChart" class="SocialTimeEffectiveChart"></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="card">
							<div class="card-body px-3 py-0">	
								<div class="students1 two d-flex align-items-center row">
									<div class="content col-md-8 py-0 pe-2">
										<h4 class="fs-18 font-w600">Follow Trends</h4>
										<span class="mb-2 fs-14"> Do you follow social media influencers </span>
									</div>
									
									<div class="col-md-4 py-0 px-0">
										<div id="DoUFollowsocialinfluencersChart"></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="card">
							<div class="card-body px-3 py-0">	
								<div class="students1 two d-flex align-items-center row">
									<div class="content col-md-8 py-0 pe-2">
										<h4 class="fs-18 font-w600">Impact</h4>
										<span class="mb-2 fs-14"> Purchased from social media influencer</span>
									</div>
									
									<div class="col-md-4 py-0 px-0">
										<div id="DoUPurchaseFrominfluencersChart"></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-4 col-md-6">
					
						<div class="card balance-data">
						<div class="card-header border-0 pb-0 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Active Platforms</h4>
							
						</div>
						<div id="ActivelySocialEngageChart"></div>				
					  </div>
					  
					</div>
					
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="card balance-data">
						<div class="card-header border-0 pb-3 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Challenges</h4>
						</div>
						<div id="ChallangesyoufaceChart"></div>			
					  </div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="card balance-data">
						<div class="card-header border-0 pb-3 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Target Audience </h4>
						</div>
						<div id="PrimaryTargetAudienceChart"></div>			
					  </div>
					</div>
					
				  </div> <!-- ROW-->
				  
				 </div> <!-- Col- 9-->
				
				 <div class="col-lg-3">
					<div class="row">
					   <div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Engagement Metrics</h4>
	<?php 
	$LikesCount = $postObj->getCountEngagementMatrics('Likes');
	$CommentsCount = $postObj->getCountEngagementMatrics('Comments');
	$SharesCount = $postObj->getCountEngagementMatrics('Shares');
	$ClicksCount = $postObj->getCountEngagementMatrics('Clicks');
	$ImpressionsCount = $postObj->getCountEngagementMatrics('Impressions');
	$ConversionCount = $postObj->getCountEngagementMatrics('Conversion');
	?>
				
	<?php $engagement_metricsArray = explode(',', $DataRow['monitor_engagement_metrics']); ?>		
				
								<div class="row">
									<div class="col-12">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($LikesCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Likes/Reactions</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Likes", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
									<div class="col-12 mt-4">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($CommentsCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Comments</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Comments", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
									<div class="col-12 mt-4">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($SharesCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Shares/Retweets</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Shares", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
									<div class="col-12 mt-4">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($ClicksCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Clicks/Link Clicks</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Clicks", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
									<div class="col-12 mt-4">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($ImpressionsCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Impressions/Reach</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Impressions", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
									<div class="col-12 mt-4">
										<div class="d-flex justify-content-between">
											<h6><?php echo round(($ConversionCount['count']/ $Memberscount['count']) * 100);?>%</h6>
											<span>Conversion (if applicable)</span>
										</div>
										<div class="progress">
	<div class="progress-bar <?php echo (in_array("Conversion", $engagement_metricsArray)) ? 'bg-pink' : 'bg-gray'; ?> " style="width: 80%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					   </div>
					</div>
					
				  </div>
				
				</div>
				
				<div class="row">	
					
					<div class="col-md-4">
					  <div class="card balance-data">
						<div class="card-header border-0 pb-3 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Engaged Content Format</h4>
						</div>
						<div id="SharingContentTypeChart"></div>			
					  </div>
					</div>				
					
					<div class="col-md-4">
					  <div class="card balance-data">
						<div class="card-header border-0 pb-3 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Primary Objectives</h4>
						</div>
						<div id="SocialMediaGoalsChart"></div>
					</div>
					</div>	
					
					<div class="col-md-4">
				     <div class="card balance-data">
						<div class="card-header border-0 pb-3 pt-3 justify-content-center">
							<h4 class="mb-0 fs-18 font-w600.">Primary Content</h4>
						</div>
						<div id="SocialContentEngagementChart"></div>			
					  </div>
					
				 </div>
					
				</div>
				
				
				
				
		
	<?php  
           
	
	$EngagementGrade = $professionalpurposes + $social_platforms_score + $interactwithplatform;
	
	if($EngagementGrade <= 8){ //Low to Moderate
	    
	    $ENGBaarWidth = round($EngagementGrade/2.8*10);
	    $EngagementLabel = "Users with a low to moderate level of engagement on social media platforms tend to have limited posting frequency and interaction with content compared to more experienced users. They are still in the process of finding their rhythm in terms of how often they engage with their audience.";
	}
	if($EngagementGrade > 8 && $EngagementGrade <= 10 ){ //Moderate to High
	
	    $ENGBaarWidth = round($EngagementGrade/1.65*10);
	    $EngagementLabel = "Individuals who engage with social media platforms moderately neither post excessively nor minimally. Their frequency of posting and interaction with content is maintained at a moderate level, reflecting a careful allocation of time for engagement.";
	}
	if($EngagementGrade > 10 && $EngagementGrade <= 14 ){ //High to Very High
	    
	    $ENGBaarWidth = round($EngagementGrade/1.6*10);
	    
	    $EngagementLabel = "Individuals who exhibit moderate to high engagement levels on social media platforms demonstrate their commitment to staying active within their chosen networks through frequent interactions and contributions.";
	}
	if($EngagementGrade > 14 ){ //Very High
	    $ENGBaarWidth = round($EngagementGrade/1.64*10);
	    $EngagementLabel = "Individuals who maintain high levels of engagement on social media platforms showcase their dedication to actively engage with their audience through frequent interactions and contributions.";
	}
	
	
	$impactGrade = $impactsocial_engagement + $digital_presence;
	
	    if($impactGrade < 4){ //Minimal to Moderate
	        
	        $ImpactBaarWidth = round($impactGrade/1*10);
            $ImpactLabel = "The impact of individuals with limited social media engagement ranges from minimal to moderate. This suggests that their presence and influence on social media are gradually developing. While they may not have a substantial reach or audience engagement at this stage, they are making initial strides in establishing their digital footprint.";
	        
	    }elseif($impactGrade == 4){  // Moderate
            $ImpactBaarWidth = round($impactGrade/1.3*10);
            $ImpactLabel = "The impact of such individuals is also moderate. While they may not have an overwhelming reach, their engagement efforts generate a noticeable impact on their audience. Their content resonates effectively and garners moderate attention.";
                    
        }elseif($impactGrade > 4 && $impactGrade <= 6){ //Moderate to Strong
        
            $ImpactBaarWidth = round($impactGrade/0.92*10);  
            $ImpactLabel = "The impact of such individuals ranges from moderate to very strong. Their presence and influence are felt prominently within their niche community, reflecting their strategic efforts to establish themselves as industry thought leaders.";
        }elseif($impactGrade > 6){ //Strong
        
            $ImpactBaarWidth = round($impactGrade/0.82*10); 
            $ImpactLabel = "The impact of such individuals ranges from strong to very strong. Their digital presence is highly influential, leaving a lasting impression on their audience and contributing significantly to their personal branding efforts.";
        }
	
	
	$timemanagementGrade = $average_spend_time + $is_time_well_spent;
	
	if($timemanagementGrade <= 5){ //Efficient
	
	    $TMBaarWidth = round($timemanagementGrade/1.99*10);
    	$TimeManagementLabel = "Individuals with efficient to balanced time management tend to allocate a reasonable amount of time to social media engagement without it becoming overwhelming. This balanced approach indicates that they are finding a comfortable middle ground between their engagement efforts and other commitments.";
    	
    }elseif($timemanagementGrade == 6){ //Balanced
        
	    $TMBaarWidth = round($timemanagementGrade/1.9*10);
        $TimeManagementLabel = "Individuals with effective time management dedicate a balanced amount of time to social media engagement. They successfully juggle their engagement efforts with other responsibilities, resulting in a harmonious equilibrium.";
        
    }elseif($timemanagementGrade > 6 && $timemanagementGrade <= 8 ){  // Balanced to Substantial
        
	    $TMBaarWidth = round($timemanagementGrade/1.22*10);
        $TimeManagementLabel = "Individuals who allocate a substantial amount of time to social media engagement do so in alignment with their goals of maintaining an authoritative digital presence within their chosen field. Their investments in engagement efforts reflect their commitment to strategic influence.";
        
    }elseif($timemanagementGrade > 8){ // Extensive
        
        $TMBaarWidth = round($timemanagementGrade/0.92*10);
        $TimeManagementLabel = "Individuals who dedicate an extensive amount of time to social media engagement do so as a reflection of their commitment to nurturing their personal brand and connecting with their audience.";
        
    }
    
    
    
       
        if($DataRow['personal_professional_balance'] == 'Mostly personal'){
		    $contentstrategyLabel = "Individuals adopt a personalized content strategy that aligns with their personal brand identity. Their content reflects their unique perspectives and values, resonating strongly with their audience.";
		}elseif($DataRow['personal_professional_balance'] == 'Balanced mix'){
		    $contentstrategyLabel = "Individuals who adopt a well-rounded content strategy include a mix of different types of content. This approach allows them to cater to the preferences of a diverse audience, showcasing their adaptability and awareness of audience interests.";
		}elseif($DataRow['personal_professional_balance'] == 'Mostly professional'){
		    $contentstrategyLabel = "Individuals adopt a business-focused content strategy centered around showcasing their industry insights and expertise. Their content reflects their thought leadership and serves as a valuable resource for their audience.";
		}
	
	$contentstrategyGrade = $personal_professional_balance;
	
	
	$challengesarray = explode(',', $DataRow['social_impact_challenges']);
	
	if (count(array_intersect(['Content creation', 'Consistency'], $challengesarray)) == 2) {
		    $ChellangesLabel = "Common challenges in content creation and maintaining consistency arise, especially for those who are still learning the ropes. Generating consistent content that appeals to their target audience can be a hurdle. However, these challenges are normal for those in the early stages of their social media journey.";
		    
		}elseif(count(array_intersect(['Audience engagement', 'Time management'], $challengesarray)) == 2){
		    
		    $ChellangesLabel = "Individuals who face challenges in audience engagement and time management. Striking a balance between engagement and other commitments can at times pose difficulties. Additionally, ensuring consistent and meaningful interactions with their audience may require some refinement.";
		    
		}elseif(in_array("Consistency", $challengesarray)){
		    
		    $ChellangesLabel = "Individuals may encounter challenges in effectively tracking engagement metrics to gauge the impact of their content. The complexity of their content strategy might necessitate a more sophisticated approach to metrics analysis.";
		    
		}elseif(count(array_intersect(['Content creation', 'Audience engagement'], $challengesarray)) == 2){
		    
		    $ChellangesLabel = "Individuals may encounter challenges in consistently creating content that aligns with their personal brand identity. Striking a balance between authenticity and relevance can require careful content planning";
		    
		}else{
		    $ChellangesLabel = "Common challenges in content creation and maintaining consistency arise, especially for those who are still learning the ropes. Generating consistent content that appeals to their target audience can be a hurdle. However, these challenges are normal for those in the early stages of their social media journey.";
		}
		
		
		$ImprovementAreasarray = explode(',', $DataRow['areas_of_improvement']);
		$primary_objectivessarray = explode(',', $DataRow['primary_objectives']);
	
	if (count(array_intersect(['Content strategy', 'Consistency'], $ImprovementAreasarray)) == 2) {
	    
		    $ImpAreasLabel = "Key areas of improvement include refining one's content strategy and establishing consistency in engagement efforts. By experimenting with different content types and gradually finding a rhythm for posting, individuals can enhance their engagement and eventually progress to higher levels of impact.";
		    
		}elseif(count(array_intersect(['Audience engagement', 'Metrics tracking'], $ImprovementAreasarray)) == 2){
		    
		    $ImpAreasLabel = "The key areas for improvement for these  individuals include enhancing audience engagement and monitoring engagement metrics. By actively responding to audience feedback and measuring engagement effectiveness, they can elevate their impact and expand their reach";
		    
		}elseif(in_array("Metrics tracking", $ImprovementAreasarray) && in_array("Thought leadership", $primary_objectivessarray)){
		    
		    $ImpAreasLabel = "The key improvement areas for individuals include refining metrics tracking to measure engagement effectiveness accurately. Additionally, emphasizing thought leadership by consistently sharing valuable industry insights can further enhance their impact.";
		    
		}elseif(in_array("Content strategy", $ImprovementAreasarray) && in_array("Personal branding", $primary_objectivessarray)){
		    
		    $ImpAreasLabel = "The primary areas for improvement may include  refining content creation to consistently align with their personal brand identity. Additionally, maintaining high levels of audience engagement through strategic interactions can further enhance their personal brand's impact.";
		    
		}else{
		    $ImpAreasLabel = "Key areas of improvement include refining one's content strategy and establishing consistency in engagement efforts. By experimenting with different content types and gradually finding a rhythm for posting, individuals can enhance their engagement and eventually progress to higher levels of impact.";
		}
	?>
	
	<div class="row">
				
				<div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap">
							<h4 class="fs-18 font-w600">Engagement 
							</h4>
						</div>
						<div class="card-body py-3 custome-tooltip">
						    
        		<div class="slider-container">
            		<input type="text" class="slider" style="display: none;">
            		<div class="rs-container">
            			<div class="rs-bg"></div>
            			<div class="rs-selected" style="width: 25%; left: 25%;"></div>
            			<div class="rs-scale">
            				<span style="width: 31.5%;">
            					<ins style="margin-right: -3.5px;">Low</ins>
            				</span>
            				<span style="width: 31.5%;">
            					<ins style="margin-right: -3.5px;">Moderate</ins>
            				</span>
            				<span style="width: 37%;">
            					<ins style="margin-right: -3.5px;">High</ins>
            				</span>
            				<span style="width: 0%;">
            					<ins style="margin-left: -60px;">Very High</ins>
            				</span>
            				
            			</div>
            			<div class="rs-pointer" data-dir="left" style="left: <?=$ENGBaarWidth?>%;">
            				<div class="rs-tooltip">You are here!</div>
            			</div>
            		</div>
            	</div>
            	
            	<p align="justify" class="mt-4 scorelabel">
                    <?=$EngagementLabel;?>
            	</p>
            	
							
						</div>
					</div>
					
				 </div> <!-- Col Ends -->
				    
				<div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap">
							<h4 class="fs-18 font-w600">Impact</h4>
						</div>
						<div class="card-body py-3 custome-tooltip">
						    <div class="slider-container">
                        		<input type="text" class="slider" style="display: none;">
                        		<div class="rs-container">
                        			<div class="rs-bg"></div>
                        			<div class="rs-selected" style="width: 25%; left: 25%;"></div>
                        			<div class="rs-scale">
                        				<span style="width: 33%;">
                        					<ins style="margin-right: -3.5px;">Minimal</ins>
                        				</span>
                        				<span style="width: 33.5%;">
                        					<ins style="margin-right: -3.5px;">Moderate</ins>
                        				</span>
                        				<span style="width: 33.5%;">
                        					<ins style="margin-right: -3.5px;">Strong</ins>
                        				</span>
                        				<span style="width: 0%;">
                        					<ins style="margin-left: -60px;">Very Strong</ins>
                        				</span>
                        				
                        			</div>
                        			<div class="rs-pointer" data-dir="left" style="left: <?=$ImpactBaarWidth;?>%;">
                        				<div class="rs-tooltip">You are here!</div>
                        			</div>
                        		</div>
                        	</div>
                        	
                <p align="justify" class="mt-4 scorelabel">
                    <?=$ImpactLabel;?>
            	</p>
                        	
						</div>
					</div>
				 </div> <!-- Col Ends -->
				 <div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap">
							<h4 class="fs-18 font-w600">Time Management</h4>
						</div>
						<div class="card-body py-3 custome-tooltip">
						    <div class="slider-container">
                        		<input type="text" class="slider" style="display: none;">
                        		<div class="rs-container">
                        			<div class="rs-bg"></div>
                        			<div class="rs-selected" style="width: 25%; left: 25%;"></div>
                        			<div class="rs-scale">
                        				<span style="width: 33%;">
                        					<ins style="margin-right: -3.5px;">Efficient</ins>
                        				</span>
                        				<span style="width: 33%;">
                        					<ins style="margin-right: -3.5px;">Balanced</ins>
                        				</span>
                        				<span style="width: 34%;">
                        					<ins style="margin-right: -6.5px;">Substantial</ins>
                        				</span>
                        				<span style="width: 0%;">
                        					<ins style="margin-left: -60px;">Extensive</ins>
                        				</span>
                        				
                        			</div>
                        			<div class="rs-pointer" data-dir="left" style="left: <?=$TMBaarWidth;?>%;">
                        				<div class="rs-tooltip">You are here!</div>
                        			</div>
                        		</div>
                        	</div>
                        	
                <p align="justify" class="mt-4 scorelabel">
                    <?=$TimeManagementLabel;?>
            	</p>
                        	
						</div>
					</div>
				 </div> <!-- Col Ends -->
				 
				 
				 <div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap">
							<h4 class="fs-18 font-w600">Content Strategy</h4>
							
							
						</div>
						<div class="card-body py-3 custome-tooltip">
						    <div class="slider-container">
                        		<input type="text" class="slider" style="display: none;">
                        		<div class="rs-container">
                        			<div class="rs-bg"></div>
                        			<div class="rs-selected" style="width: 33%; left: 33%;"></div>
                        			<div class="rs-scale">
                        				<span style="width: 50%;">
                        					<ins style="margin-right: -3.5px;">Personalized</ins>
                        				</span>
                        				<span style="width: 50%;">
                        					<ins style="margin-right: -3.5px;">Well-rounded</ins>
                        				</span>
                        				<span style="width: 0%;">
                        					<ins style="margin-left: -90px;">Business-focused</ins>
                        				</span>
                        				
                        			</div>
                        			
                        <?php
							if($DataRow['personal_professional_balance'] == 'Mostly personal'){
							    $C_S_Width = '0%';
							}elseif($DataRow['personal_professional_balance'] == 'Balanced mix'){
							    $C_S_Width = '50%';
							}elseif($DataRow['personal_professional_balance'] == 'Mostly professional'){
							    $C_S_Width = '99%';
							}
							?>
                        			
                        			<div class="rs-pointer" data-dir="left" style="left: <?=$C_S_Width;?>;">
                        				<div class="rs-tooltip">You are here!</div>
                        			</div>
                        		</div>
                        	</div>
                        	
                    <p align="justify" class="mt-4 scorelabel">
                        <?=$contentstrategyLabel;?>
                	</p>
                        	
						</div>
					</div>
				 </div> <!-- Col Ends -->
				 
				 <div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap pb-0">
							<h4 class="fs-18 font-w600">Challenges <img src="https://cdn.pixabay.com/photo/2016/05/25/13/18/target-1414775_960_720.png" width="30px"> </h4>
							
							
						</div>
						<div class="card-body pb-3 pt-1 custome-tooltip">
                        	
                            <p align="justify" class="mt-0 scorelabel">
                                <?=$ChellangesLabel;?>
                        	</p>
                        	
						</div>
					</div>
				 </div> <!-- Col Ends -->
				 <div class="col-md-6">
					<div class="card balance-data">
						<div class="card-header border-0 flex-wrap pb-0">
							<h4 class="fs-18 font-w600">Improvement <img src="https://www.pinclipart.com/picdir/big/71-713825_clip-art-arrow-bar-chart-diagram-graph-growth.png" height="30px"></h4>
							
							
						</div>
						<div class="card-body pb-3 pt-1 custome-tooltip">
                        	
                            <p align="justify" class="mt-0 scorelabel">
                                <?=$ImpAreasLabel;?>
                        	</p>
                        	
						</div>
					</div>
				 </div> <!-- Col Ends -->
				    
				    
				</div>
	
	
	
	
				
				<!--**********************************
				Footer start
			***********************************-->
				<div class="footer">
					<div class="copyright">
						<p>2023 © <a href="https://www.wahstory.com" target="_blank">www.wahstory.com</a>. All rights reserved.</p>
					</div>
				</div>
			<!--**********************************
				Footer end
			***********************************-->

        	</div>
			
		</div>		
        <!--**********************************
            Content body end
        ***********************************-->
		

</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    
    
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
	<!-- Chart piety plugin files -->
    <script src="vendor/peity/jquery.peity.min.js"></script> 
	<!-- Chartist -->
   <script src="vendor/chartist/js/chartist.min.js"></script> 
	<!-- Dashboard 1 -->
	<?php include('graphsjscode.php');?>
	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>	
	
</body>
</html>
