<?php 
session_start(); 
    include('../inc/functions.php');
    $postObj = new Story();
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{
            header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']);
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    
    function addbutton($page){
        echo '<a href="'.$page.'" target="_blank" class="edit-button"><i class="fa fa-plus"></i> Add</a>';
    }
    function editbutton($page){
        echo '<a href="'.$page.'" target="_blank" class="edit-button"><i class="fa fa-edit"></i> Edit</a>';
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
    
  <title>My Profile | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 
    <style>
        /* Original styles */
        .tj-header-area .header-menu {
            margin-left: inherit;
        }
        .tj-header-area .header-button {
            margin-left: inherit;
        }
        .hero-section::before {
            content: none;
        }
        .view-more-btn:hover {
            background-color: #f12b59;
            color: #fff; 
        }
        .view-more-btn {
            color: #f12b59; 
            text-decoration: none;
            border: 1px solid #f12b59;
            padding: 5px 14px;
            border-radius: 15px;
            font-size: 13px;
            transition: background .25s ease, color .25s ease;
        }
        .section-header .section-title {
            background-color: #fff;
        }

        /* Enhanced profile styles */
       
       
        
        .profile-section {
            display: flex;
            /*gap: 10px;*/
            padding: 15px;
            margin-top: 10px;
            background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        
        
        .card {
            
            background: none;
            color: white; 
            padding: 10px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        

        .card-cover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .profile-card, .info-card {
            /*flex: 1;*/
            padding: 15px;
            position: relative; 
        }
        
        .profile-card img {
            width: 120px;
            height: 120px;
            border: 4px solid #f12b59;
            padding: 3px;
            transition: transform 0.3s ease;
            border-radius: 50%;
        }

        .profile-card img:hover {
            transform: scale(1.05);
        }
        
        .skill-tag {
            background: linear-gradient(135deg, #f12b59 0%, #f65d82 100%);
            color: white;
            border: none;
            padding: 1px 8px;
            margin: 4px 2px;
            border-radius: 5px;
            /*font-size: 0.86em;*/
            font-size: 13px;
            transition: transform 0.2s ease;
            display: inline-block;
        }

        .skill-tag:hover {
            transform: scale(1.2);
        }

        /* Education timeline */
        .education-timeline {
            display: flex;
            overflow-x: auto;
            padding: 15px 0;
            gap: 15px;
        }
        
        .education-item {
            border-top: 2px solid #f12b59;
            padding: 15px;
            margin: 0;
            min-width: 250px;
            flex: 0 0 auto;
            position: relative;
        }
        
        .education-item::before {
            content: '';
            width: 10px;
            height: 10px;
            background: #f12b59;
            border-radius: 50%;
            position: absolute;
            left: 20px;
            top: -6px;
        }

        /* Timeline styles */
        .timeline {
            display: flex;
            overflow-x: auto;
            padding: 15px 0;
            gap: 15px;
        }

        .timeline-item {
            border-top: 2px solid #f12b59;
            padding: 15px;
            margin: 0;
            min-width: 250px;
            flex: 0 0 auto;
            position: relative;
            transition: transform 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateY(-5px);
        }

        .timeline-item::before {
            content: '';
            width: 10px;
            height: 10px;
            background: #f12b59;
            border-radius: 50%;
            position: absolute;
            left: 20px;
            top: -6px;
        }

        /* Projects area */
        .project-card {
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px;
        }

        /* Grid container */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            padding: 10px;
        }

        /* Reduced spacing */
        .single-profile h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .single-profile h5 {
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }
        
        .single-profile p {
            margin-bottom: 0.3rem;
        } 
        
        .card-body {
            padding: 10px;
        }

        /* Edit button styles */
        .edit-button {
            background: transparent;
            border: 1px solid #f12b59;
            color: #f12b59;
            padding: 0px 10px;
            line-height: 17px;
            border-radius: 15px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .edit-button:hover {
            background: #f12b59;
            color: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
            }
            
        }
        
        .card-cover{
            background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .accordion-item {
            border: none;
            background: #333;
            border-radius: 8px !important;
        }
        .accordion-flush .accordion-item .accordion-button {
            border-radius: 0;
            padding: 5px 20px;
            margin-bottom: 5px;
            background: #2e2d2d;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            line-height: 40px;
        }
        
        .accordion-button:not(.collapsed) {
            box-shadow: none;
        }
        .accordion-flush .accordion-collapse {
            margin-bottom: 10px;
        }
        .accordion-body {
            color: #ffffff;
        }
        
        .editbtn {
            font-size: 11px;
            padding: 2px 15px;
            border: 1px solid #f12b59;
            border-radius: 15px;
            margin-left: 18px;
            color: #f12b59;
            transition: all 0.3s ease; 
        }
        
        .editbtn:hover {
            background: #f12b59;
            color: #fff;
        }
        
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 
 <?php include('breadcrump.php');?>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">
          
          <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 3;?>
            <?php include('user.leftmenu.php');?>
          </div>
           
        </div>
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
       <div class="row">
        <div class="col-sm-12"> 
                
                
                <!-- Profile Section -->
            <div class="profile-section row">
                <div class="col-md-12 col-lg-12 col-xl-6 card-cover mb-2">
                    <div class="profile-card card">
                        <a href="update/update.profile.php" target="_blank" class="edit-button"><i class="fa fa-edit"></i> Edit</a> 
                        
                        
                        
                        <div class=" row">
                            <div class="col-md-12 col-lg-12 col-xl-5">
                                <img src="/images/users/<?=$Userrow['profile_image']?>">
                                <h4 class="mt-3"><?=$Userrow['name'];?></h4>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-6 mt-4">
                                
        <div class="cs-social_btns cs-style1">
    <?php 
        $ClubSocialsRow = $postObj->GetClubMemberSocialsById($Userrow['ClubId']);
        
    if($ClubSocialsRow != '') {
       
        $fb = $insta = $Linkedin = $Twitter = '';
        
        foreach ($ClubSocialsRow as $ClubSocial) {
            
            if($ClubSocial['platform'] == "Facebook") {
                $fb = $ClubSocial['link'];
                
            }else if($ClubSocial['platform'] == "Instagram") {
                $insta = $ClubSocial['link'];
                
            }else if($ClubSocial['platform'] == "Linkedin") {
                $Linkedin = $ClubSocial['link'];
                
            }else if($ClubSocial['platform'] == "Twitter") {
                $Twitter = $ClubSocial['link'];
                
            }
            
        }
        if($fb != '') {
    ?>
            <a href="<?=$fb?>" class="cs-center" target="_blank">
                <i class="fa-brands fa-facebook text-white"></i>
            </a>
    <?php }  
    
        if($insta != '') {
    ?>
            <a href="<?=$insta?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-instagram text-white"></i>
            </a>
    <?php }  
    
        if($Linkedin != '') {
    ?>
            <a href="<?=$Linkedin?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-linkedin text-white"></i>
            </a>
    <?php }  
    
        if($Twitter != '') {
    ?>
            <a href="<?=$Twitter?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-twitter text-white"></i>
            </a>
    <?php }  
    
    } else {  
    
    
    
        if($Userrow['fbid'] != '') {
    
    ?>
            <a href="<?=$Userrow['fbid']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-facebook text-white"></i>
            </a>
    
        <?php  }
        
        if($Userrow['inatagramid'] != '') {
        ?>
            <a href="<?=$Userrow['inatagramid']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-instagram text-white"></i>
            </a>
    
        <?php  }
        
        if($Userrow['linkedin'] != '') {
        ?>
            <a href="<?=$Userrow['linkedin']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-linkedin text-white"></i>
            </a>
    
        <?php  }
        
        if($Userrow['twitterid'] != '') {
        ?>
            <a href="<?=$Userrow['twitterid']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-twitter text-white"></i>
            </a>
    
        <?php  }   ?>
    
    <?php  }   ?>
    
    <?php if($Userrow['youtubechannel'] != '') { ?>
            <a href="<?=$Userrow['youtubechannel']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-youtube text-white"></i>
            </a>
    
    <?php  }   ?>
    
    <?php if($Userrow['tiktokurl'] != '') { ?>
            <a href="<?=$Userrow['tiktokurl']?>" target="_blank" class="cs-center">
                <i class="fa-brands fa-tiktok text-white"></i>
            </a>
    
    <?php  }   ?>
            
    
        </div>
                
                            </div>
                        </div>
                        
                        
            <div class="row">
                <div class="col-md-12">
                    <p>My Current Position</p>
                    <!--<p><strong><i class="fa fa-envelope"></i></strong> <?=$Userrow['email'];?></p>-->
                    <p><strong>Email:</strong> <?=$Userrow['email'];?></p>
                </div>
            </div>     
            
            <div class="row">
                <div class="col-md-12">
                
                    <p><strong>Phone:</strong> <?=$Userrow['phone'];?></p>
                    <p><strong>Gender:</strong> <?=$Userrow['gender'];?></p>
                    <p><strong>Location:</strong> <?=$Userrow['city'];?>, <?=$Userrow['country'];?></p>
                    
                </div>
                
                
            </div>
            
            
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 col-xl-6  card-cover  mb-2">
                
                    <div class="profile-card card">
            <?php 
                $WAHStory = $postObj->GetUserStoryById($Userrow['id']);
                if($WAHStory != NULL) {
                     
            ?>
                        <div>
                            <h5>Your WAHStory</h5>
                            <div class="story-title-area p-3 mt-3" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <h5>Story Title</h5>
                                <p class="text-white-50">
                                    <a href="/story/<?=$WAHStory['slug']?>" target="_blank"> 
                                        <?=$WAHStory['title']?> 
                                    </a>
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a href="/story/<?=$WAHStory['slug']?>" target="_blank" class="view-more-btn">Read Full Story</a>
                                <a href="mailto:info@wahstory.com" class="view-more-btn">Request For Changes</a>
                            </div>
                        </div>
        <?php
                }
                
        if($Userrow['ClubId'] != '') { 
            $ClubStory = $postObj->GetUserClubStoryById($Userrow['ClubId']);
            if($ClubStory != FALSE) { 
                
                $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
                
        ?>
                        <div class="mt-4">
                            <h5>Club Story <a href="update/update.story.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a> </h5>
                            <div class="story-title-area p-3 mt-3" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <h5>Story Title</h5>
                                <p class="text-white-50">
                                    <a href="/wahclub/<?=$clubuser['slug_username'];?>" target="_blank"> <?=$ClubStory['title']?> </a></p>
                            </div>
                            <div class="text-center my-2">
                                <a href="/wahclub/<?=$clubuser['slug_username'];?>" class="view-more-btn" target="_blank">Read Full Story</a>
                            </div>
                        </div>
                        
        <?php if($WAHStory == NULL) { ?>
        
        <?php $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);  ?>
            
            <?php 
            $clients = 0;
            if($clubuser['totalclients'] != '') { 
                    $clients = explode("-", $clubuser['totalclients']);
                    if($clients['1'] != '') {
                        $clients = $clients['1'];
                    } else {
                        $clients = $clients['0'];
                    }
                } 
            ?>
            
            <h5 class="mt-4">Career Highlights <a href="update/update.stats.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a></h5>
                        
            <div class="d-flex justify-content-between py-2">
                <a href="" title="Total Experience" class="view-more-btn"><i class="fa-sharp fa-solid fa-briefcase"></i> : <?=$clubuser['totalexperience'];?>yrs+</a>
                <a href="" title="Total Clients" class="view-more-btn"><i class="fa-sharp fa-solid fa-users"></i> : <?=$clients;?>+</a>
                <a href="" title="Total Projects" class="view-more-btn"><i class="fa-sharp fa-solid fa-list-check"></i> : <?=$clubuser['totalproject'];?>+</a>
                <a href="" title="Total Awards" class="view-more-btn"><i class="fa-sharp fa-solid fa-trophy"></i> : <?=$clubuser['totalawards'];?>+</a>
                
            </div>
                    
    <?php } ?>
                        
                        
        <?php   } }  ?>
        
        
            
                        
                        
                    </div>    
                    
                </div>
                
            </div>
    <?php if($Userrow['ClubId'] != '') {  ?>
        
    <?php if($WAHStory != NULL) { ?>
        
        <?php $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);  ?>
            
            <div class="row mt-4">
                <div class="col-md-12 col-lg-12 col-xl-12  card-cover">
                    <div class="info-card card">
                        
            <h5>Career Highlights <a href="update/update.stats.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a></h5>
            
            <?php 
            $clients = 0;
            if($clubuser['totalclients'] != '') { 
                    $clients = explode("-", $clubuser['totalclients']);
                    if($clients['1'] != '') {
                        $clients = $clients['1'];
                    } else {
                        $clients = $clients['0'];
                    }
                } 
            ?>
                        
            <div class="d-flex justify-content-between py-2">
                <a href="" title="Total Experience" class="view-more-btn"><i class="fa-sharp fa-solid fa-briefcase"></i> : <?=$clubuser['totalexperience'];?>yrs+</a>
                <a href="" title="Total Clients" class="view-more-btn"><i class="fa-sharp fa-solid fa-users"></i> : <?=$clients;?>+</a>
                <a href="" title="Total Projects" class="view-more-btn"><i class="fa-sharp fa-solid fa-list-check"></i> : <?=$clubuser['totalproject'];?>+</a>
                <a href="" title="Total Awards" class="view-more-btn"><i class="fa-sharp fa-solid fa-trophy"></i> : <?=$clubuser['totalawards'];?>+</a>
                
            </div>
                        
                    </div>
                </div>
            </div>
    <?php } ?>
    
            <div class="row mt-4">
                <div class="col-md-12 col-lg-12 col-xl-12  card-cover">
                    <div class="info-card card">
                        
                        
                        <div class="mt-4">
                            <h5>Core Skills <a href="update/update.skills.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a> </h5>
                            <div class="skill-tags">
                <?php 
                    $skills =  $postObj->GetWAHClubUserSkillById($Userrow['ClubId']);
                   
                    foreach($skills as $skill) {
                ?>
                        <span class="skill-tag"><?=$skill['skill']?></span>
                <?php } ?>
                
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Your Tools <a href="update/update.tools.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a></h5>
                            <div class="skill-tags">
                                
                <?php 
                    $tools =  $postObj->GetWAHClubUserToolSById($Userrow['ClubId']);
                   
                    foreach($tools as $tool) {
                ?>
                        <span class="skill-tag"><?=$tool['tool']?></span>
                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Your Traits <a href="update/update.attributes.php" target="_blank" class="editbtn"><i class="fa fa-edit"></i> Edit</a></h5>
                            <div class="skill-tags">
                <?php 
                    $traits =  $postObj->GetUserAttributesById($Userrow['ClubId']);
                   
                    foreach($traits as $trait) {
                ?>
                        <span class="skill-tag"><?=$trait['attribute']?></span>
                <?php }  ?>
                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        
            <div class="row mt-4">
                <div class="col-xl-12 card-cover">
                    
                    <!-- Education Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Education</h4>
                                
                            </div>
                            <div class="timeline">
                    <?php 
                        $edus =  $postObj->GetUserEducationById($Userrow['ClubId']);
                        
                        if($edus != '') {
                        foreach($edus as $edu) {
                    ?>
                            <div class="timeline-item">
                                <h5><?=$edu['degree']?></h5>
                                <p><?=date('Y', strtotime($edu['yearfrom']));?> - <?=date('Y', strtotime($edu['yearto']));?></p>
                                <p><?=$edu['institution_name']?></p>
                            </div>
                            
                    <?php } editbutton('update/update.educations.php');
                
                } else { addbutton('update/update.educations.php'); }  ?> 
                    
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
                
        
            <div class="row mt-4">
                <div class="col-xl-12 card-cover">
                    
                    <!-- Work Experience -->
                    <div class="card">
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Work Experience</h4>
                            </div>
                            <div class="timeline">
                    <?php 
                        $exps =  $postObj->GetUserExperienceSById($Userrow['ClubId']);
                      if($exps != '') {
                           
                        foreach($exps as $exp) {
                    ?>
                                <div class="timeline-item">
                                    <h5><?=$exp['company_name'];?></h5>
                                    <p><?=$exp['role'];?> (<?=date('Y', strtotime($exp['durationfrom']));?> - 
                            <?php 
                                if($exp['durationto'] != NULL) {  
                                        echo date('Y', strtotime($exp['durationto']));
                                } else {
                                        echo $exp['present'];
                                }  
                            ?>
                                    
                                    )
                                    
                                    </p>
                                    <!--<p><?=$exp['description'];?></p>-->
                                </div>
                    <?php } editbutton('update/update.experiences.php');
                
                } else { addbutton('update/update.experiences.php'); }  ?> 
                                
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        
         
            <div class="row mt-4">
                <div class="col-xl-12 card-cover"> 
                
                    <!-- Projects Section -->
                    <div class="card"> 
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Projects</h4>
                                
                            </div>
                            
                            
                            <div class="accordion accordion-flush " id="accordionFlushProject">
            <?php 
                $projs =  $postObj->GetUserProjectsById($Userrow['ClubId']);
                
            if($projs != '') {
                
                $n = 20;
                foreach($projs as $proj) {
            ?>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?=$n?>">
                          <span class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$n?>" aria-expanded="false" aria-controls="flush-collapse<?=$n?>">
                            <?=$proj['project_name'];?>
                          </span>
                        </h2>
                        <div id="flush-collapse<?=$n?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushProject">
                          <div class="accordion-body">
                            
                            <h5>Role:</h5>
                            <p><?=$proj['project_role'];?></p>
                            <br>
                            
                            <h5>Objective:</h5>
                            <p><?=$proj['project_objective'];?></p>
                            <br>
                            
                            <h5>Outcome:</h5>
                            <p><?=$proj['project_outcome'];?></p>
                            <br>
                            
                            
                            <a href="<?=$proj['project_link'];?>" target="_blank">
                                <img src="/wahclub/public/img/projects/<?=$proj['project_photo'];?>">
                            </a>
                            
                            
                            
                          </div>
                        </div>
                      </div>
            <?php  $n++; } 
            
                editbutton('update/update.projects.php');
                
                } else { addbutton('update/update.projects.php'); } ?>
                      
                      
                      
                    </div>
                            
                            
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        
        
            <div class="row mt-4">
                <div class="col-xl-12 card-cover">
                    
                    <!-- Awards & Testimonials -->
                    <div class="grid-container">
                        <div class="card">
                            <div class="card-body">
                                <div class="section-header">
                                    <h4>Awards</h4>
                                    
                                </div>
            
                    <div class="accordion accordion-flush " id="accordionFlushExample">
            <?php 
                $awards =  $postObj->GetUserAwardsById($Userrow['ClubId']);
              
            if($awards != '') {
               $n = 1;
                foreach($awards as $award) {
            ?>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?=$n?>">
                          <span class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$n?>" aria-expanded="false" aria-controls="flush-collapse<?=$n?>">
                            <?=$award['award_title'];?>
                          </span>
                        </h2>
                        <div id="flush-collapse<?=$n?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                            <p><?=$award['awarding_body'];?> - <?=$award['year'];?></p>
                            
                            <br>
                            <h5>Why Receiving:</h5>
                            <p><?=$award['whyreceiving'];?></p>
                            <br>
                            <h5>Career Impact:</h5>
                            <p><?=$award['careerimpact'];?></p>
                            
                            
                            <img src="/wahclub/public/img/awards/<?=$award['award_photo'];?>">
                            
                            
                          </div>
                        </div>
                      </div>
            <?php  $n++; } 
                
                editbutton('update/update.awards.php');
                
                } else { addbutton('update/update.awards.php'); }?>
                      
                      
                      
                    </div>
                                
                                
                                
                            </div>
                        </div>
    
                        <div class="card">
                            <div class="card-body">
                                <div class="section-header">
                                    <h4>Testimonials</h4>
                                    
                                </div>
                                
                            <div class="accordion accordion-flush " id="accordionFlushTestm">
                                <?php 
                                    $testms =  $postObj->GetUsertestimonialsById($Userrow['ClubId']);
                            if($testms != '') {
                                   $n = 10;
                                    foreach($testms as $testm) {
                                ?>
                                          <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading<?=$n?>">
                                              <span class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$n?>" aria-expanded="false" aria-controls="flush-collapse<?=$n?>">
                                                <?=$testm['client_name'];?>
                                              </span>
                                            </h2>
                                            <div id="flush-collapse<?=$n?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushTestm">
                                              <div class="accordion-body">
                                                
                                                <h5>Client Name:</h5>
                                                <p><?=$testm['client_name'];?></p>
                                                <p><?=$testm['client_position'];?> (<?=$testm['client_company'];?>)</p>
                                                <br>
                                                <h5>Review:</h5>
                                                <p><?=$testm['client_review'];?></p>
                                                
                                                <img src="/wahclub/public/img/testimonials/<?=$testm['client_photo'];?>">
                                                
                                              </div>
                                            </div>
                                          </div>
                                <?php  $n++; }  
                                
                editbutton('update/update.testimonials.php');
                
                } else { addbutton('update/update.testimonials.php'); } ?>
                                          
                                          
                                          
                                        </div>
                                
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>    
        
                
        
            <div class="row mt-4">
                <div class="col-xl-12 card-cover">
                    
                    <!-- blog-Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Blogs</h4>
                                
                            </div>
                            <div class="grid-container">
                <?php 
                    $blogs =  $postObj->GetUserblogsById($Userrow['ClubId']);
                   if($blogs != '') {
                    foreach($blogs as $blog) {
                ?>
                                <div class="project-card">
                                    <a href="<?=$blog['blog_link'];?>" target="_blank"> 
                                        <img src="/wahclub/public/img/blogs/<?=$blog['blog_image'];?>" style="border-radius: 10px;" class="mb-3">
                                    
                                        <h5><?=$blog['blog_title'];?></h5>
                                    </a>
                                </div>
                <?php } 
                
                editbutton('update/update.blogs.php');
                
                } else { addbutton('update/update.blogs.php'); } ?>
                
                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> 
        
            <div class="row mt-4">
                <div class="col-xl-12 card-cover">
                    
                    
                    
                    
            
                </div>
            </div>
    
    <?php } ?>
        
        
                
                
        </div>
        
       </div>
             
                
            </div>
             
            
          </div>
          <br>
         
          
        </div>  <!--Conatiner-->
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  <!--
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="fa fa-bars"></span>
    </button>
  
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
      
    
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        
        <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 3;?>
            <?php include('user.leftmenu.php');?>
          </div>
        
        
      </div>
    </div>
  </div>
</nav>-->
  
  
  
  
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
  
  
  
  <!-- Start CTA -->
  <?php include('../footer.php');?>