<?php 
    session_start(); 
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    } 
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    include('update/inc/class.livechat.php');
    $UtilityObj = new ChatUtility();
    
    $clubuser = $UtilityObj->GetWAHClubUserById($Userrow['ClubId']);
    
    if($clubuser['subscription_status'] !== 'paid') {
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
    $MyFollowers = $UtilityObj->getMember_Followers($Userrow['ClubId']);
    $MyFollowings = $UtilityObj->getMember_Following($Userrow['ClubId']);
    
    $MyFollowers = $MyFollowers ?? [];
    $MyFollowings = $MyFollowings ?? [];
    
    $combinedList = array_merge($MyFollowers, $MyFollowings);
    
    $uniqueList = array_map("unserialize", array_unique(array_map("serialize", $combinedList)));
    $followersJson = json_encode($uniqueList);
    
    
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
    
  <title>Live Chat | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  
    <script src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>
    <style>
        .dashboard-left-menu .cs-shop_sidebar {
            z-index: 9999999999;
        }
        
        
        
    </style>
    
 <?php include('../header.php');?>
 <!-- Start Hero -->
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
          
            <div class="dashboard-left-menu">
                <div class="cs-shop_sidebar">
                    <div class="cursor-pointer openleftmenu">
                       <i class="fa-solid fa-bars"></i>
                    </div>
                  <div class="cs-shop_sidebar_widget">
                    <?php $Dmenu = 11;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
            
      </div>
      <div class="col-lg-9 single-profile">
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
            
            <div class="col-sm-8"> 
                <h4 class="mb-2">Live Chat</h4>
                
            </div>
            <div class="col-sm-4 text-end"> 
                <a href="/users/" style="color: #e9204f;" class="h3">
                    <i class="fas fa-times me-2 h3"></i>
                </a>
            </div>
            
            
            <div class="col-sm-12 col-lg-12">
                <hr>
                
                <div class="row">
            
            <div class="col-sm-12 col-lg-12 mt-4 card-cover  p-relative" style="min-height: 500px;">
                
                <p style="position: absolute; top: 40%; left: 40%;">Just a moment, please...</p>
                
    
                <div id="cometchat"></div>
                
      
                    
            </div> 
            <!--Card Cover Ends-->
            
                </div>
                
            </div>
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
</div>
   
    
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
   
  
    <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
    
    <script>
        window.addEventListener('DOMContentLoaded', async (event) => {
            const userId = "<?php echo htmlspecialchars($clubuser['id'], ENT_QUOTES, 'UTF-8'); ?>"; 
            const userName = "<?php echo htmlspecialchars($clubuser['firstname'] . ' ' . $clubuser['lastname'], ENT_QUOTES, 'UTF-8'); ?>"; 
            const followers = <?php echo $followersJson; ?>; 
            
        try {
            
            const confresponse = await fetch('api/chat_config.php');
            const config = await confresponse.json();
    
            if (!config.appID || !config.authKey || !config.widgetID) {
                console.error("Chat configuration missing!");
                return;
            }
        
            const followersArray = Object.values(followers);
        
            if (Array.isArray(followersArray)) {
                
                // Initialize Chat Widget
                CometChatWidget.init({
                    "appID": config.appID, 
                    "appRegion": config.appRegion,         
                    "authKey": config.authKey
                    
                }).then(response => {
        
                if (followersArray.length > 0) {
                    
                    const user = new CometChatWidget.CometChat.User(userId);
                    user.setName(userName); 
        
                    CometChatWidget.createOrUpdateUser(user).then((user) => {
                        // console.log("User 1 created or updated successfully:", user);
        
                        // Now, create or update followers
                        followersArray.forEach((follower) => {
                            
                            const followerId = String(follower.id); 
                            
                            const followerName = follower.firstname + ' ' + follower.lastname;
                            const followerSLName = 'https://wahstory.com/wahclub/' + follower.slug_username;
                            const followerUser = new CometChatWidget.CometChat.User(followerId);
                            followerUser.setName(followerName); 
                            followerUser.setLink(followerSLName); 
                            
        
                            // Create or update each follower on chat
                            CometChatWidget.createOrUpdateUser(followerUser).then((follower) => {
                                // console.log(`Follower ${followerName} created or updated successfully`);
        
                            });
                        });
        
                        // Log in User 1
                        CometChatWidget.login({
                            "uid": userId
                        }).then((loggedInUser) => {
                            //console.log("User 1 logged in successfully:", loggedInUser);
                            
                            if (followersArray.length > 0) {
                                const firstFollowerId = String(followersArray[0].id);
                                CometChatWidget.launch({
                                    "widgetID": config.widgetID, 
                                    "target": "#cometchat", 
                                    "roundedCorners": "true",
                                    "height": "500px",
                                    "width": "800px",
                                    "defaultID": firstFollowerId, 
                                    "defaultType": 'user'
                                });
                            }
                        });
        
                    });
                    
                } else {
            //Array Is Empty ****************
                    
                    const user = new CometChatWidget.CometChat.User(userId);
                    user.setName(userName); 
        
                    CometChatWidget.createOrUpdateUser(user).then((user) => {
                
                        CometChatWidget.login({
                            "uid": userId
                        }).then((loggedInUser) => {
                            CometChatWidget.launch({
                                    "widgetID": config.widgetID, 
                                    "target": "#cometchat", 
                                    "roundedCorners": "true",
                                    "height": "600px",
                                    "width": "800px"
                                });
                        });
                    
                    });
                    
                    // console.log("Followers empty.");
                } //Else Ends
        
        
                });
        
            } else {
                console.log("Invalid Followers data.");
            }
            
        } catch (error) {
            console.error("Error fetching chat config:", error);
        }
            
            
        });

    </script>
        
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
    
   
        
        </body>
    </html>