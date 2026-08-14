<?php 
session_start(); 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    
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
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>Notifications | <?=$Userrow['name']?></title>
  
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
  
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     .likedimage img{
         border-radius: 10px;
     }
     .likedimage h4{
        font-size: 18px;
        font-weight: 500;
        text-align: center;
     }
     .likedimage h4:hover{
        color: #e9204f;
     }
     .cs-font_11{
	    font-size: 11px;
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
	
	/*#occasionImg{
	     width: 100%;
	}*/
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
     
      
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 <!-- Start Hero -->
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">
          
          <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 9;?>
            <?php include('user.leftmenu.php');?>
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
            
            <div class="col-sm-9"> 
                <h4 class="mb-2">Notifications</h4>
            </div>
            
            <div class="col-sm-12"> 
                <hr class="mb-4">
            </div>
            
            <div class="col-sm-12 col-lg-12">
                
                <div class="row">
            
        <?php $SuggessionSQL = $postObj->getContentSuggestionByUsernStatus($_SESSION['userid'], 0); 
        if($SuggessionSQL != NULL){ 
            
        ?>
                    
        <?php  
            foreach($SuggessionSQL as $SuggessionRow){
        ?>
           <div class="col-sm-12"> 
           
           <div class="alert alert-primary alert-dismissible fade show" style="background: #054958;border: 2px solid #087990;color: #1ab5d5;" role="alert"> <?=$SuggessionRow['platform']?> post pending at <?=date("d M, Y h:i A", strtotime($SuggessionRow['scheduletime']));?>   
                <a class="cs-btn  ms-2 cs-style2 py-1 px-3 cs-font_11 ViewPostBtn" href="#SocialPostContent" data-bs-toggle="modal" data-notifid="<?=$SuggessionRow['id']?>">View Post</a> 
                <a href="#PostreminderStatus" data-bs-toggle="modal" class="cs-btn ms-2 cs-style2 py-1 px-3 cs-font_11 alertStatusBtn" data-notifid="<?=$SuggessionRow['id']?>">Update Status</a>
            </div>
           
           </div>
    <?php   } 
            }else{ ?>
            <div class="col-md-12">
                <p>I haven't any notification yet.</p>
            </div>
        <?php }  ?>
                    
                </div>
                
            </div>
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
   

  
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