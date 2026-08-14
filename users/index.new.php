<?php 
    session_start(); 
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    include('update/inc/meeting_bookings.php');
    $UtilityObj = new MeetingBookingUtility();
    
    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    } 
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']); 
    
    if(isset($_POST['SendUpgradeRequest'])){ 
        $UpgResp = $postObj->UpgradeUserAcc($_SESSION['userid'], $Userrow['name']);  
    }
    $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);
    
    if(isset($_POST['UpdateReminderStatus'])){
        if($_POST['ReminderStatus'] == 1){
            $response = $postObj->UpdateContentSuggestionStatus($_POST['ReminderrowId']); 
        }else{
            $response = "ERROR";
        }
    }
    
    if(isset($response)){
        if($response == "SUCCESS"){
            $SMSG = "Status Updated Successfully!"; 
        }elseif($response == "ERROR"){
            $EMSG = "Error while updating the status, try again!"; 
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
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
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
 
    :root {
      --main-bg: #191819;
      --main-pink: #e9204f;
      --main-grey: #232329;
      --white: #fff;
      --grey-text: #aaa;
      --card-hover: #2a2a30;
      --gradient-pink: linear-gradient(135deg, #e9204f, #ff4f7a);
      --gradient-blue: linear-gradient(135deg, #4f46e5, #7c3aed);
      --gradient-green: linear-gradient(135deg, #10b981, #06d6a0);
      --gradient-orange: linear-gradient(135deg, #f59e0b, #f97316);
      --gradient-purple: linear-gradient(135deg, #8b5cf6, #a855f7);
      --gradient-teal: linear-gradient(135deg, #14b8a6, #06b6d4);
    }
    .min-height {
        min-height : var(--min-height, 240px);
    }
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
	.alert .btn-close:hover{
	    cursor: pointer;
	}
	.alert .btn-close{
	    padding: 1rem 1rem;
	}
	.cs-font_11{
        font-size: 11px;
	}
	.postReminder-card{
	    background: #000000;
        border: 2px solid #343434;
        color: #ffffff;
        font-weight: 500;
        font-size: 14px;
        line-height: 22px;
        box-shadow: rgba(0,0,0,.05) 0rem 1.25rem 1.6875rem 0rem;
        transition: box-shadow .3s cubic-bezier(.4,0,.2,1) 0ms;
	}
	.cs-style2:hover{
	    background: #043b46;
	    color: #1ab5d5;
	}
	.cs-style2{
	    border: 1px solid #02abd1;
	    border-radius: 15px;
        background: #065a6c;
	}
	
	#SocialPostContent .modal-header{
	    border-bottom: 1px solid #404042 ;
	}
	#SocialPostContent .socialPost{
	    color:white;
	}
	#SocialPostContent .btn-close{
	    background-color: white;
	    font-size:15px;
	}
	#SocialPostContent .occasion-div{
	    display:flex;
	    align-items:baseline;
	    justify-content:start;
	    margin:0px 0px -10px 0px;
	} 
    #SocialPostContent .calender{
        margin:0px 10px 0px 0px;
        font-size: 25px;
        
    }
    
    #SocialPostContent .card{
        display:flex;
        align-items:center;
        justify-content:center;
        /*width: 40%;*/
        padding: 5px;
        background: #2f2f2f;
        border: 2px solid gray;
        border-radius: 15px;
        margin: 30px 0 0 0;
        min-height: 160px;
      }
    #SocialPostContent .deadline-div{
          display:flex;
          justify-content:center;
          /*width:150px;*/
          padding-bottom:5px;
          /*border-bottom:1px solid rgba(242, 241, 255, 0.5);*/
          margin-bottom:10px;
    }
    #SocialPostContent .deadline-icon{
         font-size: 40px;
         color: white;
         
         margin-bottom:5px;
         
         
    }
    #SocialPostContent .time-span{
            margin-bottom: 2px;
            font-size: 17px;
            line-height: 23px;
            letter-spacing: 1px;
            color: cyan;
    }
    #SocialPostContent .content-span{
            margin-bottom: 2px;
            font-size: 14px;
            line-height: 23px;
            letter-spacing: 1px;
            color: cyan;
    }
       
    #SocialPostContent .top-heading{
        margin-bottom: 2px;
        font-size: 20px;
        letter-spacing: 1px;
    }
    .postcontent{
        font-size: 18px;
        line-height: 28px;
    }
	
    .connectedsocial:hover .socialcomingsoon{
        display: flex;   
        background-color: #181515c9;
        /*transform: scale(1.1);*/
    }
    .socialcomingsoon{
        position: absolute;
        top: 0;
        left: 0;
        background: #181515c9;
        height: 100%;
        width: 100%;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 9;
        display: none;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }


    /* New Css */

        .icon-cover {
            padding: 10px;
            font-size: 20px;
            margin-left: auto;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            opacity: 1;
            /*background: #0075ff;*/
            color: #fff;
            border-radius: .7rem;
            box-shadow: rgba(20,20,20,.12) 0rem .25rem .375rem -.0625rem,rgba(20,20,20,.07) 0rem .125rem .25rem -.0625rem;
            transition: all .2s ease-in
        }
         
        
        .activity-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 12px;
            background: #000000;
            border-radius: 1.25rem;
        }
        .activity-box .icon, .wahclub-box .icon {
          font-size: 2.2rem;
          margin-bottom: 12px;
          padding: 16px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          width: 70px;
          height: 70px;
          transition: all 0.3s ease;
        }
        
        
            .iconbg1 { 
              background: rgba(233, 32, 79, 0.15);
              color: #ff4f7a;
            }
            .iconbg2 { 
              background: rgba(79, 70, 229, 0.15);
              color: #7c3aed;
            }
            .iconbg3 { 
              background: rgba(16, 185, 129, 0.15);
              color: #06d6a0;
            }
            .iconbg4 { 
              background: rgba(245, 158, 11, 0.15);
              color: #f97316;
            }
            .iconbg5 { 
              background: rgba(139, 92, 246, 0.15);
              color: #a855f7;
            }
            .iconbg6 { 
              background: rgba(20, 184, 166, 0.15);
              color: #06b6d4;
            }
        
        .activity-box .label, .wahclub-box .label {
            font-size: .888rem;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .activity-box .detail, .wahclub-box .detail {
            font-size: 0.9rem;
            border-radius: 20px;
            padding: 8px 16px;
            margin-top: 8px;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }
        
        .activity-box:hover{
            color: #fff;
            background: #332029;
        }
        .activity-box:hover .icon{
            color: #fff;
            
            /*background: rgb(0, 0, 0, 0.60);*/
        }
        .activity-box:hover .detail{
            /*background: rgb(0, 0, 0, 0.60);*/
        }

    /* New Css Ends*/
	
 </style>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
 <?php include('../header.php');?>
 <?php include('breadcrump.php');?>
 
 
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  <div class="container">
      
      <?php if(isset($UpgResp) && $UpgResp == 'success'){ ?>
        <h5 class="text-center" style="color: #4af186;"> Thank you for requesting to upgrade your account in premium, We'll get back to you soon!</h5>
      <?php }elseif(isset($UpgResp) && $UpgResp == 'error'){ ?>
        <h5 class="text-center text-pink"> Something went wrong, please try again...</h5>
      <?php } ?>
      
    <div class="row">
      <div class="col-lg-3">
        
        <div class="dashboard-left-menu">
            <div class="cs-shop_sidebar">
                <div class="cursor-pointer openleftmenu">
                   <i class="fa-solid fa-bars"></i>
                </div>
              <div class="cs-shop_sidebar_widget">
                <?php $Dmenu = 1;?>
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="cs-height_0 cs-height_lg_40"></div>
         
        <div class="row">
            <?php if(isset($EMSG) && $EMSG != ""){ ?>
                <p style="color: #e9204f;">
                    <?=$EMSG?>
                </p>
            <?php } ?>
            <?php if(isset($SMSG) && $SMSG != ""){ ?>
                <p style="color: #40c985;">
                    <?=$SMSG?>
                </p>
            <?php } ?>
            
           <div class="col-sm-12"> 
              <h4 class="mb-2">My Dashboard</h4>
              <hr class="mb-2">
            </div>
        
        </div>
        
        
        
         <?php 
         if(isset($MyCLubUserRow['subscription_status']) && $MyCLubUserRow['subscription_status'] === 'paid'){ ?>
        
            <div class="row">
            
                <div class="col-xl-4 col-lg-12 col-md-12 mb-3">
                    <div class="p-3 rounded-4 postReminder-card min-height"  style="--min-height: 100px;">
                        <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
                            <h6 class="mb-2"> 
                            <i class="fa-solid fa-calendar-days me-2"></i>
                            Approve Booking </h6>
                            <a href="/users/member.bookingrequests.php" class="mb-2">View All</a>
                        </div>
                        <div class="card-body pt-2">
                        <?php
                    $rows = $UtilityObj->GetAllPendingNewBookingRequests_Member($Userrow['ClubId']); 
                
                    if($rows !== NULL) {
                        foreach ($rows as $row) {
                            if($row['member_id'] == $Userrow['ClubId']) {
                                $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                            
                    ?>
                            <p style="border-bottom: 1px solid #333; padding-bottom: 8px;">
                                <a href="/users/member.bookingrequests.php">
                                    <?=$userrow['firstname'].' '.$userrow['lastname']?> has requested a meeting
                                    <br> 
                                    <small><?=date('d M Y', strtotime($row['slot_date']))?></small>
                                </a>
                                
                                <a href="/users/member.bookingrequests.php" class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 ViewPostBtn text-right">View Details</a>
                                 
                            </p> 
                           
                    <?php 
                    $Pendingcount = 1;
                            } 
                            
                    }
                    
                    if($Pendingcount !== 1) {
                    ?>
                        <p style="color: #a6a3a3;">
                                You do not have any meeting to approve!
                            </p>
                    <?php }  
                    
                    } else { ?>
                            <p style="color: #a6a3a3;">
                                You do not have any meeting to approve!
                            </p>
                    <?php } ?>
                        
                               
                        </div>
                    </div> 
                    <div class="p-3 mt-3 rounded-4 postReminder-card min-height"  style="--min-height: 100px;">
                        
                        <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
                            <h6 class="mb-2"> 
                            <i class="fa-solid fa-calendar-days me-2"></i>
                             Upcoming Meets </h6>
                            <a href="/users/member.bookingrequests.php" class="mb-2">View All</a>
                        </div>
                        
                        <div class="card-body pt-2">
                    <?php
                    $rows = $UtilityObj->GetAllConfirmedBookingRequests_Member($Userrow['ClubId']); 
                
                    if($rows !== NULL) {
                        foreach ($rows as $row) {
                            if($row['user_id'] == $Userrow['ClubId']) {
                                $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
                            } else {
                                $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                            }
                            
                    ?>
                            <p style="border-bottom: 1px solid #333; padding-bottom: 8px;">
                                <a href="">Meeting with <?=$userrow['firstname'].' '.$userrow['lastname']?>
                                    <br> 
                                    <small><?=date('d M Y', strtotime($row['slot_date']))?></small>
                                </a>
                                <a href="<?=$row['google_meet_link']?>" target="_blank" class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 ViewPostBtn text-right" style="background: #043b46;"><i class="fas fa-video me-1"></i>Join</a> 
                                   
                            </p>   
                    <?php } } else { ?>
                            <p style="color: #a6a3a3;">
                                You do not have any upcoming meeting!
                            </p>
                    <?php } ?>
                             
                            
                        </div>
                    
                    </div>
                </div>
                
                <div class="col-xl-8 col-lg-12 col-md-12 mb-3" >
                    
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="p-3 rounded-4 postReminder-card mb-3 min-height">
                        
                                <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
                                    <h6 class="mb-2"> 
                                        <i class="fa-solid fa-chart-simple me-2"></i>
                                        Social Health Score 
                                    </h6>
                                    <a href="/users/user.notifications.php" class="mb-2">View Score</a>
                                </div>
                                
                                <div class="card-body pt-2 text-center ">
                                    
                                    <div id="SocialScoreChart"></div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            
                            <div class="p-3 rounded-4 postReminder-card min-height mb-3">
                        
                                <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
                                    <h6 class="mb-2"> 
                                        <i class="fa-solid fa-chart-simple me-2"></i>
                                        Wellness Score 
                                    </h6>
                                    <a href="/users/user.notifications.php" class="mb-2">View Score</a>
                                </div>
                                
                                <div class="card-body pt-2">
                                    
                                    <div id="WellnessScoreChart"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                    
                    
                </div>
                
            </div> <!--Row Ends-->
        <?php } ?>
            
            
             <div class="cs-height_10 cs-height_lg_30"></div>
        
        <h5 class="mb-2" style="color: #999696;">My Activity</h5>
        <hr class="mb-2">
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
            <a href="user.likedstories.php" class="activity-box text-center">
                <div class="icon iconbg1">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <div class="label">Liked Stories</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
            <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
                
            <a href="user.savedstories.php" class="activity-box text-center">
                <div class="icon iconbg2">
                    <i class="bi bi-bookmark-fill"></i>
                </div>
                <div class="label">Saved Stories</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
            
            <div class="cs-height_10 cs-height_lg_10"></div>
             
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
                
            <a href="user.savedstories.php" class="activity-box text-center">
                <div class="icon  iconbg3">
                    <i class="fa fa-check-to-slot"></i>
                </div>
                <div class="label">Blog published</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
                
                
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
        </div>
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        <h5 class="mb-2" style="color: #999696;">WAHClub</h5>
        <hr class="mb-2">
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
            <a href="user.likedstories.php" class="activity-box text-center">
                <div class="icon iconbg4">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <div class="label">Profile Views</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
            <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
                
            <a href="user.savedstories.php" class="activity-box text-center">
                <div class="icon iconbg5">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div class="label">Profile Connections</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
            
            <div class="cs-height_10 cs-height_lg_10"></div>
             
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="cs-height_10 cs-height_lg_10"></div>
                
            <a href="user.savedstories.php" class="activity-box text-center">
                <div class="icon iconbg6">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="label">Work Requests</div>
                <div class="detail cs-btn cs-style1 d-block py-2">
                    See Detail
                </div>
            </a>
                
                
             <div class="cs-height_10 cs-height_lg_10"></div>
          </div>
        </div>
        
              
        
        
         
        
            
            <?php 
        if($Storyrow != NULL){
        $insights = $postObj->getStoryEngages($Storyrow['id']); ?>
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        <h5 class="mb-2" style="color: #999696;">WAHStory</h5>
        <hr class="mb-2">
                
        <div class="row">
        
          <div class="col-lg-4 col-sm-6">
            <div class="cs-height_10 cs-height_lg_10"></div>
             <div class="dash-item-box">
                <div class="dash-item-box-inner">
                    <div class="dash-item-box-inner-left">
                        <p>Story Likes</p>
                        <strong><?=$insights['likes'];?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-heart"></i>
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
                        <p>Story Views</p>
                        <strong><?=$insights['views'];?>+</strong>
                    </div>
                    <div class="dash-item-box-inner-right">
                        <div class="icon-cover">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
             </div>
             
             <div class="cs-height_10 cs-height_lg_10"></div>
             
          </div>
           
          
        </div> 
        <?php } ?>
        
        
        
        <div class="cs-height_30 cs-height_lg_30"></div>
        
        
        
        
        <!--<div class="row">-->
        <!--    <div class="col-lg-4 col-sm-12">-->
        <!--        <h5 class="mb-3" style="color: #999696;">My Rank</h5>-->
        <!--        <hr>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--        <div class="ringchart"></div>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--    </div>-->
            
        <!--    <div class="col-lg-4 col-sm-12">-->
        <!--        <h5 class="mb-3" style="color: #999696;">World-wide Likes</h5>-->
        <!--        <hr>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--        <div class="worldwidelikesofstory"></div>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--    </div>-->
            
        <!--    <div class="col-lg-4 col-sm-12">-->
        <!--        <h5 class="mb-3" style="color: #999696;">Views Growth Trendline</h5>-->
        <!--        <hr>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--        <div class="baarchart2"></div>-->
        <!--        <div class="cs-height_10 cs-height_lg_10"></div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="cs-height_10 cs-height_lg_10"></div>
        
    <?php 
            $SuggessionSQL = $postObj->getContentSuggestionByUsernStatus($_SESSION['userid'], 0);
            $SuggessionSQL = NULL;
            if($SuggessionSQL != NULL){
                    
    ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h5 class="mb-2" style="color: #999696;">Scheduled Social Posts</h5>
                <hr class="mb-2">
                           
                <div class="row">
        <?php foreach($SuggessionSQL as $SuggessionRow){ ?>
                 <div class="col-lg-4 col-sm-4 mb-3">
                    <div class="p-3 rounded-4 postReminder-card"><?=$SuggessionRow['platform']?> post pending at <?=date("d M, Y h:i A", strtotime($SuggessionRow['scheduletime']));?>
                    <br>
                    <a class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 ViewPostBtn" href="#SocialPostContent" data-bs-toggle="modal" data-notifid="<?=$SuggessionRow['id']?>">View Post</a> 
                <a href="#PostreminderStatus" data-bs-toggle="modal" data-notifid="<?=$SuggessionRow['id']?>" class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 alertStatusBtn">Update Status</a>
                    
                    
                    </div>
                 </div>
        <?php } ?>         
                </div>
                     
            </div>
        </div>
    <?php 
            }
    ?>
        
        <div class="cs-height_10 cs-height_lg_10"></div>
        <div class="cs-height_10 cs-height_lg_10"></div>
        
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h5 class="mb-2" style="color: #999696;">Connected Socials</h5>
                <hr class="mb-2">
              <div class="row p-relative connectedsocial">
            
            <div class="socialcomingsoon"><h3>Coming Soon</h3></div>    
                <!-- 
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box ">
                    <div class="dash-item-box-inner"  >
                        <div class="dash-item-box-inner-left">
                            <strong>Facebook</strong>
                            <div class="social-insights">
                                <a href="facebook.insights.php"> 
                                    <p>Friends</p>
                                    <strong>2580+</strong>
                                </a>
                                <a href="facebook.insights.php">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                            </div>
                            <br>
                            <a href="facebook.insights.php" class="cs-btn cs-style1" style="font-size: 12px; color: #fff;">View More Insights &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div> -->
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkFacebookModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Facebook</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>2930+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkFacebookModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div> <!--Ends-->
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkInstagramModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Instagram</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>2930+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>100+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkInstagramModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinklinkedinModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>LinkedIn</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Connections</p>
                                    <strong>1250+</strong>
                                </a>
                                <a href="#">
                                    <p>Posts</p>
                                    <strong>65+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinklinkedinModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-linkedin"></i>
                            </div>
                        </div>
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkTwitterModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Twitter</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Followers</p>
                                    <strong>1050+</strong>
                                </a>
                                <a href="#">
                                    <p>Tweets</p>
                                    <strong>105+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkTwitterModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-item-box disable">
                    <div class="dash-item-box-inner" <?php if($fbconnected == ''){ ?> data-bs-toggle="modal" data-bs-target="#LinkYoutubeModal" <?php }?>>
                        <div class="dash-item-box-inner-left">
                            <strong>Youtube</strong>
                            <div class="social-insights">
                    <?php if($fbconnected != ''){?>
                                <a href="#"> 
                                    <p>Subscribers</p>
                                    <strong>26050+</strong>
                                </a>
                                <a href="#">
                                    <p>Videos</p>
                                    <strong>185+</strong>
                                </a>
                    <?php }else{?>  
                                <a href="#LinkYoutubeModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                <?php }?>
                            </div>
                            
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover">
                                <i class="fa-brands fa-youtube"></i>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-item-box" style="background: #525252;">
                    <div class="dash-item-box-inner hover-mouse-pointer" data-bs-toggle="modal" data-bs-target="#LinkTiktokModal">
                        <div class="dash-item-box-inner-left">
                            <strong style="color: #999696">TikTok</strong>
                            <div class="social-insights">
                                <a href="#LinkTiktokModal" class="hover-primary" data-bs-toggle="modal"> 
                                    <p>&nbsp;
                                        <span style="font-size: 14px;">
                                             Connect <i class="fa fa-link"></i>
                                        </span>
                                        </p>
                                    <strong>&nbsp;
                                        <!--15250+-->
                                        </strong>
                                </a>
                                <a href="#LinkTiktokModal" data-bs-toggle="modal">
                                    <p>&nbsp;
                                        <!--Reals-->
                                    </p> 
                                </a>
                            </div>
                        </div>
                        <div class="dash-item-box-inner-right">
                            <div class="icon-cover" style="color: #999696; background: #d2d2d2;">
                                <i class="fa-brands fa-tiktok"></i>
                            </div>
                        </div>
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                
              </div>
                 
            </div>
        </div>
        
        
        <?php if($fbconnected != ''){ //Show When User has connected their FB?>
        
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">Social Insights</h5> 
                    <div>
                       
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <span class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Daily</span>
                      </li>
                      <li class="nav-item" role="presentation">
                        <span class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Monthly</span>
                      </li>
                    </ul>
                                              
                    </div>

                </div>
                 
                <hr class="mb-2">
                
                
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              
              <div class="row">
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                          <strong>Total Reach</strong>
                            <p><i class="fa-regular fa-eye"></i> 50+</p>
                      </div>
                    
                    <!--<div class="">-->
                    <!--    <div class="DailyReachAreaChart"></div>-->
                    <!--</div>-->
                    
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Content Intraction</strong>
                <p><i class="fa-solid fa-chart-line"></i> 45+</p>
                
                     </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                   <div class="dash-insights-counts2">
                       <div style="padding: 10px">
                    <strong>Profile Activity</strong>
                <p> <i class="fa-regular fa-clock"></i> 30+ </p>
                      </div>
                      
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
              
              
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  
                  <div class="row">
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Total Reach</strong>
                    <p><i class="fa-regular fa-eye"></i> 1800+</p>
                    
                    </div>
                    
                    
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                  <div class="dash-insights-counts2">
                      <div style="padding: 10px">
                    <strong>Content Intraction</strong>
                <p><i class="fa-solid fa-chart-line"></i> 1500+</p>
                     </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
                <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  
                   <div class="dash-insights-counts2">
                       <div style="padding: 10px">
                    <strong>Profile Activity</strong>
                    <p> <i class="fa-regular fa-clock"></i> 1000+</p>
                      </div>
                  </div>
                  
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                
              </div>
                  
                  </div> 
            </div>
                
              
                 
            </div>
        </div>
        <?php } ?>
        
        
        <?php if($fbconnected != ''){ //Show When User has connected their FB?>
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div style="display: flex; justify-content: space-between;">
                    <h5 class="mb-2" style="color: #999696;">My Recent Posts</h5>
                    <a href="#"> <span>View More</span> </a>
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
                      <a href="blog.php?slug=<?=$blog["slug"];?>" class="cs-post_thumb grayscale-img img-scale" style="background-image: url('/images/blogs/<?=$blog["img"] ?>'); background-size: cover;"> 
                        <div class="cs-post_overlay"></div>
                      </a>
                      <span class="social-recent-post-icon">
                          <i class="fa-brands fa-<?php if($n % 3 == 0){ echo "linkedin";}elseif($n % 2 == 0){ echo "facebook";}else{ echo "instagram";}?>"></i></span>
                          
                      <div class="cs-post_info">
                        <div class="cs-posted_by"><?php echo $blog["date"] ?></div>
                        <h2 class="cs-post_title text-ellipsis-2">
                          <a href="blog.php?slug=<?=$blog["slug"];?>"><?php echo $blog["title"] ?></a>
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
        
        <?php } ?>
        
    
    
        <div class="cs-height_50 cs-height_lg_50"></div>
        
        
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
  
<!--Socials Connect Modals -->

<!-- Modal -->
<div class="modal fade" id="LinkTwitterModal" tabindex="-1" aria-labelledby="LinkTwitterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkTwitterModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-twitter"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Twitter</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
 
 
<!-- Modal -->
<div class="modal fade" id="LinkInstagramModal" tabindex="-1" aria-labelledby="LinkInstagramModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkInstagramModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-instagram"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Instagram</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <button class="btn btn-primary" id="custom-fb-login-button"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
 
 
 
<!-- Modal -->
<div class="modal fade" id="LinklinkedinModal" tabindex="-1" aria-labelledby="LinklinkedinModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinklinkedinModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-linkedin"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Linked In</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
 
 
<!-- Modal -->
<div class="modal fade" id="LinkYoutubeModal" tabindex="-1" aria-labelledby="LinkYoutubeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkYoutubeModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-youtube"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Youtube</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
  
<!-- Modal -->
<div class="modal fade" id="LinkTiktokModal" tabindex="-1" aria-labelledby="LinkTiktokModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="LinkTiktokModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover">
                    <i class="fa-brands fa-tiktok"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Connect Tiktok</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Account</button>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
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
  <!-- Start CTA -->
  
 

<!-- Modal -->
<div class="modal fade" id="UpgradeAccModal" tabindex="-1" aria-labelledby="UpgradeAccModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="UpgradeAccModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-crown"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Request to Upgrade</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <form class="row" action="" method="POST">
            <div class="col-lg-12">
                <button class="cs-btn cs-style1" type="submit" name="SendUpgradeRequest">
                    <span>Send Request</span>
                    <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
                    </svg>                
                </button>
            </div>
            
       </form>
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
          <div>
              <p style="display: flex; font-size: 17px;">
                  <span>
                  <i class="fa fa-lock"></i> &nbsp; &nbsp;
                </span> 
              <span style=" font-size: 12px; line-height: 15px;">
                  After raising the request. <br>We will get back to you within 48 hours.
              </span>
              </p>
              
              </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button> 
      </div>
    </div>
  </div>
</div>
  
  
<a href="javascript:void(0);" id="discoverHealthModalBtn" data-bs-target="#discoverHealthModal" data-bs-toggle="modal" style="display: none;">Discover Your Social Health</a>
  
<!-- Modal -->
<div class="modal fade" id="discoverHealthModal" tabindex="-1" aria-labelledby="discoverHealthModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="discoverHealthModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-chart-column"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Discover Your Social Health</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
            <div class="col-lg-12">
                <a href="/social-health-impact/" class="cs-btn cs-style1" target="_blank">
                    <span>Discover Now</span>
                    <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
                    </svg>                
                </a>
            </div>
            
      </div>
      
      
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="PostreminderStatus" tabindex="-1" aria-labelledby="PostreminderStatusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="PostreminderStatusLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-bell-slash"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Update Status</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
            <div class="col-lg-12">
                 <form method="post" action="">
                     <input type="hidden" id="ReminderrowId" name="ReminderrowId" value="">
                     <input type="checkbox" id="ReminderStatus" name="ReminderStatus" value="1" required>
                     <label for="status" class="text-dark"> I have already posted this post.</label><br>
                     <button type="submit" name="UpdateReminderStatus" class="pt-1 pb-1 cs-font_14">Update</button>
                 </form>
            </div>
            
      </div>
      
      
    </div>
  </div>
</div>




  
  <!-- Modal -->
<div class="modal fade" id="SocialPostContent" tabindex="-1" aria-labelledby="SocialPostContentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background:#2f2f2f;">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="SocialPostContentLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-share"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px; color: #fff;">Social Post Content</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           
           <div class="row">
               
                <div class="col-lg-12">
                    <!--<i class="calender fa fa-calendar-o"></i>-->
                      <p class="postcontent">
                        Hi there, <br>
                        you have a social post suggestion from WAHStory to post on <strong id="platform-name"></strong>, kindly post this <strong id="ContentType"></strong> at the scheduled time.
                      </p>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-1">
                        <div class="deadline-div">
                            <i class="deadline-icon bi bi-patch-exclamation pt-2"></i>
                        </div>
                        <h4 class="top-heading">Deadline</h4> 
                        <span class="time-span date" id="post-time"></span>
                        <span class="time-span time">at <span id="postHour"></span></span>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-1">
                        <div class="deadline-div">
                            <i class="deadline-icon bi bi-cloud-download pt-2"></i>
                        </div>
                        <h4 class="top-heading">Content</h4> 
                        <a href="javascript:void(0);" class="content-span" target="_blank" id="imageattachment">Download Image <i class="bi bi-image"></i></a>
                        <a href="javascript:void(0);" class="content-span" target="_blank" id="contentattachment">Download Content <i class="bi bi-file-earmark-image"></i></a> 
                    </div>
                    
                </div>
              
              </div>
                
        </div>
           
            
      </div>
      
    </div>
  </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".alertStatusBtn").click(function() {
            var notifId = $(this).attr("data-notifid");
            $("#ReminderrowId").val(notifId); // Setting the value to data-notifid
        });
    });
</script> 


  <script>
    $(document).ready(function() {
        $(".ViewPostBtn").click(function() {
            var notifId = $(this).attr("data-notifid");
        $.ajax({
                type: 'POST',
                url: 'calendarajax.php',
                data: { publicId: notifId },
                success: function (response) {
                    
                // Handle the response from the server here
            document.getElementById("platform-name").innerHTML = response.platform;
        
            var dateString = response.scheduletime.split(' ')[0];
        
        var datePart = new Date(dateString);
        
    // Array of month names    
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
    // Array of weekday names
    var weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    
    // Get the day, month, year components
    var day = datePart.getDate();
    var month = months[datePart.getMonth()];
    var year = datePart.getFullYear();
    // Get the weekday
    var weekday = weekdays[datePart.getDay()];
    // Construct formatted date string
    var formattedDate = weekday + " " + day + " " + month + ", " + year;
             
        document.getElementById("post-time").innerText = formattedDate;
            
            //Extracting Time as AM/PM
        var timePart = response.scheduletime.split(' ')[1];
        var timeComponents = timePart.split(':');
        var hours = parseInt(timeComponents[0], 10);
        var ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Convert hours to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // Handle midnight (0 hours)
        
        var formattedTime = hours + ':' + timeComponents[1] + ' ' + ampm; 

                
            document.getElementById("postHour").innerText = formattedTime;
            
            document.getElementById("ContentType").innerText = response.contentType;
            // document.getElementById("contenttitle").innerText = response.title;
            
            if (response.caption) {
                document.getElementById("contentattachment").href = "/images/contentsuggestion/attachments/" + response.caption;
            } else {
                document.getElementById("contentattachment").style.display = "none";
            }
            
            if (response.img) {
            document.getElementById("imageattachment").href = "/images/contentsuggestion/" + response.img;
            }else{
                document.getElementById("imageattachment").style.display = "none";
            }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle errors here
                // console.error(textStatus, errorThrown);
            }
        });
        
        
        //fun click ends
        });
    });
</script>
  

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //   // Get all the fade-item elements
    //   const fadeItems = document.querySelectorAll(".fade-item");
    
    //   // Set initial state
    //   let currentItemIndex = 0;
    //   fadeItems[currentItemIndex].style.opacity = "1";
    
    //   // Function to handle fading and showing next item
    //   function fadeNextItem() {
    //     fadeItems[currentItemIndex].style.opacity = "0";
    //     currentItemIndex = (currentItemIndex + 1) % fadeItems.length;
    //     fadeItems[currentItemIndex].style.opacity = "1";
    //   }
    //   // Start the automatic fading after a certain interval (e.g., every 3 seconds)
    //   setInterval(fadeNextItem, 3000);
    // });
  </script>
  
  <script type="text/javascript">
        $(window).on('load', function() {
            $('#discoverHealthModalBtn').click();
        });
    </script>  
      
    <!-- Start CTA -->
      <?php include('../footer.section.php');?>
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://www.wahstory.com/assets/js/dashboard.js"></script>
      <?php include('footer.commonJS.php');?> 
        
        <script>
            $(document).ready(function () {
                // Open Left Menu Of User Dashboard
                const openMenuBtn = document.querySelector('.openleftmenu');
                const openMenuBtnicon = document.querySelector('.openleftmenu i');
                const sidebar = document.querySelector('.dashboard-left-menu');
                 
                openMenuBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('open'); 
                    openMenuBtnicon.classList.toggle('fa-times'); 
                });
            });
        </script>
        <script src="//code.tidio.co/xevxx6yr1y8hel4trwkgl5bpvlskjh1r.js" async></script>
        
        <script>
            var options = {
          series: [76],
          chart: {
          type: 'radialBar',
          offsetY: -2,
          sparkline: {
            enabled: true
          }
        },
         stroke: {
        width: 0,
            color: ["#e9204f"],
        },
        plotOptions: {
          radialBar: {
            startAngle: -100,
            endAngle: 100,
            track: {
              background: "#e7e7e7",
              strokeWidth: '97%',
              margin: 5, // margin is in pixels
              dropShadow: {
                enabled: false,
                top: 2,
                left: 0,
                color: '#fff',
                opacity: 1,
                blur: 1
              }
            },
            dataLabels: {
              name: {
                show: false
              },
              value: {
                offsetY: -2,
                fontSize: '22px'
              }
            }
          }
        },
        grid: {
          padding: {
            top: -10
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            shadeIntensity: 0.4,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          },
        },
        labels: ['Average Results'],
        colors: ['#e9204f'],
        };

        var chart = new ApexCharts(document.querySelector("#SocialScoreChart"), options);
        chart.render();
        
        //WAQ Score
        var wellnessscore = {
          series: [76],
          chart: {
          type: 'radialBar',
          offsetY: -2,
          sparkline: {
            enabled: true
          }
        },
        plotOptions: {
          radialBar: {
            startAngle: -100,
            endAngle: 100,
            track: {
              background: "#e7e7e7",
              strokeWidth: '97%',
              margin: 5, // margin is in pixels
              dropShadow: {
                enabled: false,
                top: 2,
                left: 0,
                color: '#444',
                opacity: 1,
                blur: 2
              }
            },
            dataLabels: {
              name: {
                show: false
              },
              value: {
                offsetY: -2,
                fontSize: '22px'
              }
            }
          }
        },
        grid: {
          padding: {
            top: -10
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            shadeIntensity: 0.4,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 53, 91]
          },
        },
        labels: ['Average Results'],
        colors: ['#e9204f'],
        };

        var chart = new ApexCharts(document.querySelector("#WellnessScoreChart"), wellnessscore);
        chart.render();
        </script>
        
    
  </body>
</html>