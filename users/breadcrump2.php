<?php 
    if(isset($_POST["GetInWAHCLUB"])){
        
        $response = $postObj->GetWAHUserInWahclub($_SESSION['userid']);
        
        if($response == 'success') {
            // header('location: /wahclub/build-my-presence/'.$_SESSION['club_userid']);
            
            echo '<script>window.location.href="/wahclub/build-my-presence/'.$_SESSION['club_userid'].'";</script>';
            
            $SMSG = "Connected Successfully!"; 
        } else {
            $EMSG = "Something went wrong, please try again!"; 
        }
        
    } 


if($Userrow['ClubId'] != ''){
    $MyCLubUserRow = $postObj->GetWAHClubUserById($Userrow['ClubId']);
}
?>

<!-- CSS for Premium Badge -->
<style>
    .dash-profile-image {
        position: relative;
    }
    
    .premium-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: linear-gradient(135deg, rgba(15 184 255 / 0.85), rgba(36 60 165 / 0.85));
        color: #fff;
        padding: 3px 8px;
        font-size: 10px;
        border-radius: 0 5px 0 8px;
        box-shadow: -1px 1px 3px rgba(0,0,0,0.2);
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="<?=BASE_URL?>/assets/images/page-title-bg.jpeg">
    <div class="container">
        
        <div class="row" style="align-items: center;">
            <div class="col-md-3 mt-2"> 
                 
                
                <div class="">
                    <h4>Social Health Score</h4>
                
    <?php     $HelthScore = $postObj->getSocialHealthScoreByEmail($_SESSION['email']); 
        if($HelthScore === false){
    ?>
                <a href="/social-health-impact/" class="cs-btn cs-style1">
                    Take the Assessment
                </a>
    <?php }else{ ?>
                <a href="/social-health-impact/graphdash/" class="cs-btn cs-style1">
                    View Insights &nbsp; <i class="fa fa-arrow-right"></i>
                </a>    
    <?php } ?>
                </div>
                
            </div>
            <div class="col-md-6  mt-2">
            
            <div class="cs-page_heading_in">
                <h4 class="cs-page_title cs-white_color"><?=$Userrow['name']?></h4>
                <ol class="breadcrumb text-uppercase">
                  <li class="breadcrumb-item active">
                      
                     <?php 
                    //  var_dump($Storyrow);
            if($Storyrow != NULL){ 
                $catrow = $postObj->getStoryCatById($Storyrow['category']); 
                echo $catrow['name'];
            }
                $CheckUpg = false;
                ?>
                    </li>
                </ol>
         <?php
         
          $WAHCLUBUSER = $postObj->GetWAHClubUserByEmail($_SESSION['email']);
          
        $process = 0;
        
        if($WAHCLUBUSER !== FALSE){
            
            $ClubProfileprocess = $postObj->ClubProfileProcess();
            $ClubProfileprocess = $ClubProfileprocess ? $ClubProfileprocess : 0;
         
         ?>
    <?php if($ClubProfileprocess <= 95){ ?>
        <a href="https://www.wahstory.com/wahclub/build-my-presence/<?=$WAHCLUBUSER['id']?>" target="_blank" class="cs-btn cs-style1 d-block py-2"><i class="fa fa-id-card"></i> &nbsp; Complete Your Profile (<?=$ClubProfileprocess?>%)
    <?php }else{ ?>
        <a href="/wahclub/<?=$WAHCLUBUSER['slug_username']?>" target="_blank" class="cs-btn cs-style1 d-block py-2"><i class="fa fa-id-card"></i> &nbsp; WAHClub Profile (<?=$ClubProfileprocess?>%)
    <?php } ?>
        
        <?php if($ClubProfileprocess <= 95) { ?>
        <br>
        
            <div class="progress mt-1" style="height: 7px;">
              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: <?=$ClubProfileprocess;?>%;" aria-valuenow="<?=$ClubProfileprocess;?>" aria-valuemin="0" aria-valuemax="100"></div> (<?=$ClubProfileprocess?>%)
            </div>
        <?php } ?>
        
        </a>
      
      <?php
        if($MyCLubUserRow['subscription_status'] !== 'paid') {
      
      ?>
       <a href="/users/subscriptionplan.php" 
   class="cs-btn cs-style1 d-block py-2 mt-3" 
   style="background: linear-gradient(45deg, #ff9800, #ff5722); 
          border: none; 
          box-shadow: 0 4px 15px rgba(255, 87, 34, 0.4); 
          animation: pulse 1.5s infinite; 
          position: relative; 
          overflow: hidden;
          transition: all 0.3s ease;"
   onmouseover="this.style.background='linear-gradient(45deg, #ff5722, #ff9800)'; this.style.transform='translateY(-2px)';" 
   onmouseout="this.style.background='linear-gradient(45deg, #ff9800, #ff5722)'; this.style.transform='translateY(0)';">
    <i class="fa fa-crown"></i> &nbsp; <strong>UNLOCK PREMIUM</strong> 
    <span style="background-color: #ffc107; 
                 color: #212529; 
                 margin-left: 5px; 
                 font-size: 10px; 
                 padding: 3px 6px; 
                 border-radius: 10px; 
                 display: inline-block;">SPECIAL OFFER</span>
</a>

<script>
// Inline animation for the pulsing effect
document.head.insertAdjacentHTML('beforeend', `
    <style>
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }
    </style>
`);
</script>
        
        
        <?php } // Premium BTN
        
        } else{ ?>
            
            
            
            <form action="" method="POST">
                
                <button type="submit" class="cs-btn cs-style1" name="GetInWAHCLUB">Get me in WAHClub</button>
                
            </form>
            
            
            
            
            <!--<a href="#UpgradeAccModal" class="cs-btn cs-style1" data-bs-toggle="modal"><i class="fa fa-crown"></i> &nbsp; Upgrade to Premium </a>-->
        
        <?php } ?>
        
            </div>
                
            </div>
            <div class="col-md-3  mt-2"> 
            
            <div class="dash-profile-image position-relative">
            <?php if(isset($MyCLubUserRow) && $MyCLubUserRow != ''){  ?>
            
                <img src="/wahclub/public/img/photos/<?=$MyCLubUserRow['photo']?>">
                <?php if(isset($MyCLubUserRow['subscription_status']) && $MyCLubUserRow['subscription_status'] === 'paid'){ ?>
                    <div class="premium-badge">★ Premium</div>
                <?php } ?>
            
            <?php } else { ?>
            
                <?php if($Userrow['profile_image'] != ''){ ?>
                    <img src="/images/users/<?=$Userrow['profile_image']?>">
                <?php }else{ ?>
                    <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg">
                <?php } ?>
            
            <?php } ?>
            
            </div>
            
            </div>
            
            
        </div>
        
      
    </div>
  </div>