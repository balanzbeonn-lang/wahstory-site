<?php 
session_start(); 

    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script> window.location.href="/login.php"; </script>';
        exit;
    }
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    if($Userrow['ClubId'] == '' || $Userrow['ClubId'] == NULL) {
        echo '<script> window.location.href="/users/"; </script>';
        exit;
    }
    
    if($postObj->IsPaid($Userrow['ClubId']) !== TRUE){
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
     
     if(isset($_POST['AcceptConnectionInvitation'])){
          $response = $postObj->UpdateConnectionInvitation(1);
     }
     
     if(isset($_POST['IgnoreConnectionInvitation'])){
          $response1 = $postObj->UpdateConnectionInvitation(2);
     }
 
    if(isset($response)){
        if($response == "success"){
            $SMSG = "Accepted successfully!"; 
        }elseif($response == "error"){
            $EMSG = "Error while accepting connection, try again!"; 
        }
        
    }
    
    if(isset($response1)){
        if($response1 == "success"){
            $SMSG = "Ignored successfully!"; 
        }elseif($response1 == "error"){
            $EMSG = "Error while ignoring connection, try again!"; 
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
    
  <title>Club Connections | <?=$Userrow['name']?></title>
  
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
	 .inv-acceptBtn{
	    background: no-repeat;
        border: 2px solid #087990;
        border-radius: 10px;
        padding: 5px 15px;
        display: block;
        text-transform: capitalize;
        font-weight: 500;
        font-size: 17px;
        font-family: sans-serif;
        margin-left: 10px;
	 }
     
     .connection-profile{
         background: #000000;
        border-radius: 10px;
     }
     .connection-profile .photo img{
        border-radius: 50%;
        height: 80px;
        width: 80px;
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
           
        <div class="dashboard-left-menu">
            <div class="cs-shop_sidebar">
                <div class="cursor-pointer openleftmenu">
                   <i class="fa-solid fa-bars"></i>
                </div>
              <div class="cs-shop_sidebar_widget">
                <?php $Dmenu = 4;?>
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row">
              <div class="col-md-12"> 
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
            
                  <h5 class="mb-2" style="color: #999696;">My Connections</h5>
                <hr class="mb-4"> 
              </div>
              <div class="col-md-12">
                  
                  <div class="row">
                      
    <?php $rawconnections = $postObj->GetAllConnectionsByUserId($Userrow['ClubId'], 1); 
        if($rawconnections != NULL){  
        
        foreach($rawconnections as $connections){
            
            if($connections['user_id_2'] == $Userrow['ClubId']) {
                $member = $postObj->GetWAHClubUserById($connections['user_id_1']);
            } else {
                $member = $postObj->GetWAHClubUserById($connections['user_id_2']);
            }
            
        ?>
                      <div class="col-lg-3 pb-2">
                        <div class="card connection-profile">
                            <div class="card-body">  
                                
                                <div class="photo text-center">
                                    <img src="/wahclub/public/img/photos/<?=$member['photo'];?>">
                                </div>
                                <div class="content">
                                    <h6 class="text-center mt-2 mb-0">
                                        <a href="/wahclub/<?=$member['slug_username']?>" target="_blank"><?=$member['firstname'].' '.$member['lastname']?> </a>
                                    </h6>
                                    
                                </div>
                                
                            </div>
                        </div>
                      </div> 
    <?php   }  }  ?>
                      
                  </div>
                  
              </div>
          </div>
          
          <div class="cs-height_50 cs-height_lg_50"></div>
          
          <div class="row">
              
            <div class="col-sm-9">  
                <h5 class="mb-2" style="color: #999696;">Connection Requests</h5>
            </div>
            
            <div class="col-sm-12"> 
                <hr class="mb-4">
            </div>
            
            <div class="col-sm-12 col-lg-12">
                
                <div class="row">
            
        <?php $rawconnections = $postObj->GetAllConnectionsByUserId($Userrow['ClubId'], 0); 
        if($rawconnections != NULL){ 
            
        ?>
                    
        <?php  
            foreach($rawconnections as $connections){
                $invitations = $postObj->GetWAHClubUserById($connections['user_id_1']);
        ?>
           <div class="col-sm-12">
               <div class="alert alert-primary alert-dismissible fade show py-2" style="background: #054958;border: 2px solid #087990;color: #1ab5d5;" role="alert"> 
               <a href="/wahclub/<?=$invitations['slug_username']?>" target="_blank"> <strong><?=$invitations['firstname'].' '.$invitations['lastname']?></strong></a> is inviting you to connect
                
               at 
                <span class="small"><?=date("d M, Y h:i A", strtotime($connections['created_at']));?></span>     
               </a>
               
               <div class="d-inline-flex">
                   
                   <form action="" method="POST">
                       <input type="hidden" name="invitationid" value="<?=$connections['id']?>" />
                       <button type="submit" name="AcceptConnectionInvitation" class="inv-acceptBtn" style="background: #e9204f; border-color: #e9204f;" >
                           Accept
                       </button>
                   </form>
                   <form action="" method="POST">
                       <input type="hidden" name="invitationid" value="<?=$connections['id']?>" />
                       <button type="submit" name="IgnoreConnectionInvitation" class="inv-acceptBtn" >
                           Ignore
                       </button>
                   </form>
                   
               </div>
               
                     
                </div>
           </div>
    <?php   } 
            }else{ ?> 
            <div class="col-md-12">  
                <p style="color: #727272; font-size: 13px;">No request at the moment.</p>
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
  
</div>
  
    
   <!-- Start CTA -->
    <?php include('../footer.section.php');?>
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
        
        </body>
    </html>