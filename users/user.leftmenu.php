<?php
    $HelthScore = $postObj->getSocialHealthScoreByEmail($_SESSION['email']);
    $WAQScore = $postObj->hasUserCompletedWellnessAssessment($_SESSION['email']);
    
    if($Dmenu == NULL){ $Dmenu = 1; }   
?>

    <ul class="cs-shop_sidebar_category_list">
  
        <li class="<?php if($Dmenu==1){ echo 'active';}?>">
            <a href="/users/"><i class="bi bi-house-door-fill"></i> Dashboard</a>
        </li>
        
    <?php if($HelthScore === false){ ?>
        <li id= 'socialhealth'data-step="1" data-intro="Explore your personalized social health insights here." class="<?php if($Dmenu==2){ echo 'active';}?>">
            <a href="/social-health-impact/" target="_blank"><i class="bi bi-star-fill"></i> Discover Social Health</a>
        </li>
    <?php }else{ ?>
        <li class="<?php if($Dmenu==2){ echo 'active';}?>">
            <a href="/social-health-impact/graphdash/" target="_blank"><i class="bi bi-bar-chart-fill"></i> Social Health Insights</a>
        </li>
    <?php } ?> 
    
    <?php
    
    if($WAQScore){ ?>
        <li>
            <a href="/assessments/report.php?fiticon=<?=$WAQScore['slug']?>" target="_blank"><i class="bi bi-bar-chart-fill"></i> Wellness Score</a>
        </li>
    <?php }else{ ?>
        <li class="">
            <a href="/assessments/wellness-assessment.php" target="_blank"><i class="bi bi-star-fill"></i> Take Wellness Assessment</a>
        </li>
    <?php } ?> 
    
        <li class="<?php if($Dmenu==3){ echo 'active';}?>" id='editprofile' data-step="14" data-intro="Click here to edit you WAHClub Profile">
            <a href="/users/user.profile.php"> <i class="bi bi-person-fill"></i> Profile</a>
        </li> 
  
    <?php 
        $profileCompleted = $postObj->ClubProfileProcess();
        $profileCompleted = $profileCompleted ? $profileCompleted : 0;
        
        $WAHCLUBUSER = $postObj->GetWAHClubUserByEmail($_SESSION['email']); 
 
        if(isset($profileCompleted) && $profileCompleted > 80) {
            $clublink = 'href="/wahclub/'.$WAHCLUBUSER['slug_username'].'" target="_blank"';
            $lock = '';
        }else{
            $clublink = 'href="/wahclub/build-my-presence/'.$WAHCLUBUSER['id'].'" target="_blank"';
            $lock = '<i class="fa fa-lock" style="color: #636161; "></i>';
        }
    ?>
        <!--<li>
            <a <?=$clublink?> >WAHClub  </a>
        </li>-->
   
      
    <?php if($Storyrow != NULL){ ?>
        <li>
            <a href="/story/<?=$Storyrow['slug']?>" target="_blank"> <i class="bi bi-journal-medical"></i> My Story</a>
        </li>
    <?php } ?>
  
  <?php if($WAHCLUBUSER != FALSE && $WAHCLUBUSER['subscription_status'] === 'paid'){ ?>
  
        <li id='connections'  data-step="2" data-intro="View and manage your connections on WAHClub."class="<?php if($Dmenu==4){ echo 'active';}?>">
            <a href="/users/user.clubconnections.php"><i class="bi bi-people-fill"></i> My Connections</a>
        </li>
        
        <li class="<?php if($Dmenu==5){ echo 'active';}?>">
            <a href="/users/user.clubqueries.php"><i class="bi bi-envelope-fill"></i> Work Together</a>
        </li>
        
        <li id='meetings' data-step="3" data-intro="Check your scheduled meetings here." class="<?php if($Dmenu==8){ echo 'active';}?>">
            <a href="/users/member.bookingrequests.php"><i class="bi bi-calendar-event-fill"></i> Meetings</a>
        </li>
        <li id='setavail' data-step="4" data-intro="Set your weekly availability for others to book meetings." class="<?php if($Dmenu==10){ echo 'active';}?>">
            <a href="/users/shareavailability.calendar.php"> <i class="bi bi-calendar2-week-fill"></i> My Availability</a>
        </li>
        <li id='livechat' data-step="5" data-intro="Start real-time conversations with your network."class="<?php if($Dmenu==11){ echo 'active';}?>">
            <a href="/users/livechat.php"><i class="bi bi-chat-dots-fill"></i> Live Chat</a>
        </li>
        
  <?php  } else{ 
   
  ?>
        
        <li id='connectionslock' data-step="6" data-intro="This feature is locked. Unlock Premium to make connections">
            <a href="javascript:void(0);" class="premium-feature" style="color: #636161; "><i class="bi bi-people-fill"></i> My Connections <i class="fa fa-crown" style="color: #636161; "></i></a>
        </li>
        <li>
            <a href="javascript:void(0);" class="premium-feature" style="color: #636161; "><i class="bi bi-envelope-fill"></i> Work Together <i class="fa fa-crown" style="color: #636161; "></i></a>
        </li>
        <li id='meetingslock'data-step="7" data-intro="Locked! Unlock Premium to access meetings.">
            <a href="javascript:void(0);" class="premium-feature" style="color: #636161; "><i class="bi bi-calendar-event-fill"></i> Meetings <i class="fa fa-crown" style="color: #636161; "></i></a>
        </li>
        <li id='setavaillock'data-step="8" data-intro="Set availability is a premium feature. Upgrade to unlock.">
            <a href="javascript:void(0);" class="premium-feature" style="color: #636161; "><i class="bi bi-calendar2-week-fill"></i> My Availability <i class="fa fa-crown" style="color: #636161; "></i></a>
        </li>
        <li id='livechatlock' data-step="9" data-intro="Live chat is available for premium members only.">
            <a href="javascript:void(0);" class="premium-feature" style="color: #636161; "><i class="bi bi-chat-dots-fill"></i> Live Chat <i class="fa fa-crown" style="color: #636161; "></i></a>
        </li>
  
    <!-- Subscription Modal - Smaller Size -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">Premium Feature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <p class="text-center">Please upgrade your account to unlock exclusive features.</p>
                </div>
                <div class="modal-footer pt-0">
                    <a href="/users/subscriptionplan.php" class="cs-btn cs-style1 py-1">
                        <i class="fa fa-crown text-light"></i>UNLOCK PREMIUM
                    </a>
                </div>
            </div>
        </div>
    </div>

<style>
/* Modal styling */
#subscriptionModal .modal-content {
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    border: none;
    background-color: #2d2d2d;
}

#subscriptionModal .modal-header {
    border-bottom: 1px solid #444;
    padding: 15px 15px 10px;
    background-color: #2d2d2d;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    position: relative;
    justify-content: center;
}

#subscriptionModal .modal-title {
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 5px;
}

#subscriptionModal .close {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 24px;
    opacity: 0.7;
    color: #fff;
    padding: 0;
    margin: 0;
    z-index: 10;
    background-color: transparent;
    border: none;
}

#subscriptionModal .close:hover {
    opacity: 1;
}

#subscriptionModal .modal-body {
    padding: 15px 10px;
}

#subscriptionModal .modal-body p {
    color: #fff;
    font-size: 14px;
    margin-bottom: 5px;
}

#subscriptionModal .modal-footer {
    border-top: none;
    padding: 10px;
    justify-content: center;
}

#subscriptionModal .btn-primary {
    background-color: #ec407a;
    border-color: #ec407a;
    border-radius: 30px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
    padding: 8px 20px;
    min-width: 200px;
}

#subscriptionModal .fa-crown {
    color: #FFD700;
    margin-right: 5px;
}
</style>
        
        <!-- Ensure jQuery is loaded first, then add the modal script -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if jQuery is already loaded
            if (typeof jQuery === 'undefined') {
                // If jQuery isn't loaded, add it dynamically
                var script = document.createElement('script');
                script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
                script.onload = initializeModal;
                document.head.appendChild(script);
            } else {
                // If jQuery is already loaded, initialize the modal
                initializeModal();
            }
            
            function initializeModal() {
                // Make sure Bootstrap's JS is loaded
                if (typeof jQuery.fn.modal === 'undefined') {
                    var bootstrapScript = document.createElement('script');
                    bootstrapScript.src = 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js';
                    bootstrapScript.onload = setupModalTriggers;
                    document.head.appendChild(bootstrapScript);
                } else {
                    setupModalTriggers();
                }
                
                function setupModalTriggers() {
                    jQuery('.premium-feature').on('click', function(e) {
                        e.preventDefault();
                        jQuery('#subscriptionModal').modal('show');
                    });
                }
            }
        });
        </script>
  
  <?php  } ?>
  
        <li class="<?php if($Dmenu==6){ echo 'active';}?>">
            <a href="/users/user.notifications.php"><i class="bi bi-bell-fill"></i> Notifications</a> 
    <?php 
        $notifications = $postObj->GetAllNotificationsById($_SESSION['email'], 0);
        if($notifications != NULL) {
            $total_notifications = count($notifications); 
        ?>  
            <a href="/users/user.notifications.php" class="notification-count-circle text-white"><?=$total_notifications;?></a>
    <?php } ?>
        
        </li>
        
        <li class=""><a href="/wahcommunity/"><i class="bi bi-globe"></i> WAH Community</a></li>
        
        <li class="<?php if($Dmenu==9){ echo 'active';}?>">
            <a href="/users/user.changepassword.php"><i class="bi bi-lock-fill"></i> Change Password</a>
        </li>
        
        <li><a href="/logout.php?LogoutUser"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul> 
<style> 
    @media screen and (max-width: 575px){
        .cs-page_heading.cs-style1 {
            height: 500px;
        }
        
    }
    @media screen and (max-width: 767px){
        .cs-page_heading.cs-style1 {
            height: 540px;
        }
        
    }
</style>