    <?php 
@session_start();

// ini_set('display_errors', 1);
// error_reporting(E_ALL);
    include('inc/functions.php');
    $postObj = new Story();
    // $StoryObj = new StoryTeller(); 
    
    if(isset($_GET["slug"]) && $_GET["slug"] != ''){
        
        $script = "";
    	$post = $postObj->getStory($_GET["slug"]);
    	if($post == NULL){
    	    $post = $postObj->getStoryByID($_GET["slug"]);
    	    if(!$post){
    	        	header("Location: /");
    	    }
    	    
    	}
    	$rowresa = $postObj->setStoryViews($post["id"]);
    	
    } 
    else{
        header("Location: /stories");
    }
    
    $rcActive1 = $rcActive2 = $rcActive3 = $rcActive4 = $rcActive5 = "";
    $heartclass = $saveclass = 'fa-regular';
    $saveclasstext = 'Save';
    if(isset($_SESSION['userid'])){ 
        
    	$rcActiveResponce = $postObj->GetstoryreactionByUID($post["id"], $_SESSION['userid']);
    	$SaveStoryResponce = $postObj->GetstorySavedByUID($post["id"], $_SESSION['userid']);
    	
    	if($SaveStoryResponce !== NULL){
    	    $saveclass = 'fa';
    	    $saveclasstext = "Saved";
    	}else{
    	    $saveclass = 'fa-regular';
    	    
    	    $saveclasstext = "Save";
    	}
    	
    	switch($rcActiveResponce['reaction']){
    	   case 'Heartfelt':
    	        $rcActive1 = 'active';
    	        $heartclass = 'fa';
    	   break;
    	   case 'Inspiring':
    	        $rcActive2 = 'active';
    	        $heartclass = 'fa';
    	   break;
    	   case 'Spellbound':
    	        $rcActive3 = 'active';
    	        $heartclass = 'fa';
    	   break;
    	   case 'Passionate':
    	        $rcActive4 = 'active';
    	        $heartclass = 'fa';
    	   break;
    	   case 'Passionate':
    	        $rcActive5 = 'active';
    	        $heartclass = 'fa';
    	   break;
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
    
  <!-- Site Title -->
  <title><?=$post["title"]?> | WAHStory</title>
  
  
    <meta name="keywords" content="<?=$post["metakeywords"]?>"/>
  
    <meta name="description" content="<?=$post["metadescription"]?>"/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />  
    
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/story/<?=$post["slug"]?>">
    <meta name="identifier-URL" content="https://www.wahstory.com/story/<?=$post["slug"]?>">
    <meta name="directory" content="Story">
    <meta name="category" content="Her Story, Game Changer, Passion Story, Pride Story, Influencers, Living Well">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/story/<?=$post["slug"]?>" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="<?=$post["title"]?> | WAHStory">
    <meta name="og:description" content="<?=$post["metadescription"]?>">
    <meta property="og:url" content="https://www.wahstory.com/story/<?=$post["slug"]?>" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/posts/<?=$post["img"]?>" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:image:type" content="image/png" />
  
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
   
 
 <style>
     .single-post-content p b{
         color: #efeeee;
     } 
     /*.single-post-content p b{*/
     /*    color: #efeeee;*/
     /*} */
     
     .topbtns .cs-btn.cs-style1{
         line-height: 1.2em;  
        font-size: 13px;
        padding: 7px 10px;
        border-radius: 5px;
     }
     .single-post-content p{
         font-weight: 400;  
         font-family: 'Segoe UI', sans-serif !important;
         
         }
     .single-post-content p b, .single-post-content p span b{
         font-size: 16pt; 
         font-weight: 500;
         }
     .single-post-content p, .single-post-content p span{
         font-size: 14pt;   
         line-height: 26px;
         }
         
        
     .single-post-content p{
         text-align: justify;
     }
     .single-post-content a{
         color: #e9204f;    
         }
     .single-post-content a:hover{
         color: #fff;    
         }
         
    .reactions-ul li img{
        filter: grayscale(100%);
    }  
           
    .reactions-ul li:hover img, .reactions-ul li.active img{
        filter: none;
    }  
    
    .card{
        border:3px solid  #000;
         /*box-shadow: 0 4px 8px 0 #848482, 0 6px 20px 0 #696969;*/
    }
    .card-body{
        background: #000;
         
    } 
    .card-img-top{
    border-radius:0;  
    background: #000;
    }
    .card-footer{
        /*background:#343434;*/
        
    }
    .card-footer:last-child{
        border-radius:0;
    }
    .card-footer .text-muted{
        
        color:white !important;
    }
         

    .mycommunitySection .communityItem .position-absolute {
        bottom: 4px;
        right: 0;
        left: 0;
    }

    .mycommunitySection .communityItem .img-fluid {
        height: 70px;
        width: 70px;
        object-fit: cover;
    }
    .mycommunitySection .communityItem {
        background-color: #323232;
    }
    .mycommunitySection .communityItem p{
        color: #fff;
        font-size: 13px;
    }
    
    .text-muted{
        color: #99a2ab !important;
    }


    .feeds .feed-item h2, .feeds .feed-item h1, .feeds .feed-item h3{
        font-size: 1.4rem;
        font-weight: 500;
    }
    .feeds .feed-item {
        background-color: #323232;
    }
    .feeds .feed-item .content {
        font-size: 14px;
    }
    .feeds .feed-item img.user-img {
        height: 30px;
        object-fit: cover;
        width: 30px;
    }
    .authorName{
        font-size: 12px;
    }

.connect-options .dropdown button{
    background: #e9204f;
    color: #fff;
    text-transform: none;
    margin-bottom: 10px;
}

.connect-options .dropdown ul.dropdown-menu {
    background-color: #2b2929;
    border-top: 2px solid #e9204f;
    padding: 10px 0;
    border-radius: 6px 4px 5px 5px;
}
.connect-options .dropdown ul.dropdown-menu li a {
   
    text-transform: none;
}

     
 </style>
 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="/assets/images/page-title-bg.jpeg">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color"><?=$post["title"]?></h1>
        <ol class="breadcrumb text-uppercase">
          <li class="breadcrumb-item active"><a href="/stories/<?php echo $postObj->getCatById($post["category"])['slug']; ?>" class="post-cat fashion"><?php echo $postObj->getCatById($post["category"])['name']; ?>
          </a></li>
        </ol>
      </div>
    </div>
  </div>
  <!-- End Hero -->
  <div class="cs-height_30 cs-height_lg_30"></div>
  
  <div class="container">
      
        <div class="row">
            <div class="col-md-12 topbtns" style="text-align: right;">
                <?php if($postObj->getStoryProducts($post['id']) != ''){ ?> 
                <a href="#StoryProducts" class="cs-btn cs-style1 py-2 px-3"><i class="fa fa-shopping-cart"></i>  &nbsp; Products</a> &nbsp; &nbsp;
                <?php } if($postObj->getStoryGallery($post['id']) != ''){ ?>
                <a href="#StoryGallery" class="cs-btn cs-style1 py-2 px-3"><i class="fa-regular fa-images"></i>  &nbsp; Gallery</a>
                <?php } ?>
             
        <?php if(isset($_SESSION['logged_in']) && $post["id"] == $_SESSION['storyid']){ ?> 
             &nbsp; &nbsp;
                <a href="single.updatestory.php" class="cs-btn cs-style1 py-2 px-3"><i class="fa fa-edit"></i>  &nbsp; Update Story</a>
            
        <?php } ?>
        </div>
            <div class="col-md-6">
                <div class="cs-height_20 cs-height_lg_20"></div>
                <img src="/images/posts/<?=$post["img"]?>" alt="<?=$post["author"]?>" class="w-100 cs-radius_15">
            </div>
            <div class="col-md-6">
                <div class="cs-height_20 cs-height_lg_20"></div>
                <div class="cs-section_heading cs-style1 text-center">
                   
                  <!--<h3 class="cs-section_subtitle">Netta Jenkins</h3>-->
                  <h2 class="cs-section_title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                      <?=$post["author"]?>
                  </h2>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="cs-social_btns cs-style1" style="justify-content: center;">
        <?php $postDetails = $postObj->getStoryDetailsByID($post["userid"]);?>
            <?php if($postDetails['linkedin'] != ''){ ?>
                  <a href="<?=$postDetails['linkedin']?>" class="cs-center" target="_blank">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.04799 13.7497H1.45647V5.4043H4.04799V13.7497ZM2.75084 4.2659C1.92215 4.2659 1.25 3.57952 1.25 2.75084C1.25 2.35279 1.40812 1.97105 1.68958 1.68958C1.97105 1.40812 2.35279 1.25 2.75084 1.25C3.14888 1.25 3.53063 1.40812 3.81209 1.68958C4.09355 1.97105 4.25167 2.35279 4.25167 2.75084C4.25167 3.57952 3.57924 4.2659 2.75084 4.2659ZM13.7472 13.7497H11.1613V9.68722C11.1613 8.71903 11.1417 7.4774 9.81389 7.4774C8.46652 7.4774 8.26004 8.5293 8.26004 9.61747V13.7497H5.67132V5.4043H8.15681V6.54269H8.19308C8.53906 5.887 9.38421 5.19503 10.6451 5.19503C13.2679 5.19503 13.75 6.92215 13.75 9.16546V13.7497H13.7472Z" fill="white" />
                    </svg>
                  </a>
            <?php } ?>
            <?php if($postDetails['inatagramid'] != ''){ ?>
                  <a href="<?=$postDetails['inatagramid']?>" target="_blank" class="cs-center">
                      <i class="fa-brands fa-instagram text-white"></i>
                    </a>
            <?php }  if($postDetails['fbid'] != ''){ ?>
                    <a href="<?=$postDetails['fbid']?>" class="cs-center" target="_blank">
                      <i class="fa-brands fa-facebook text-white"></i>
                    </a>
            <?php } if($postDetails['twitterid'] != ''){ ?>
                    <a href="<?=$postDetails['twitterid']?>" class="cs-center" target="_blank">
                      <i class="fa-brands fa-twitter text-white"></i>
                    </a>
            <?php } if($postDetails['youtubechannel'] != ''){ ?>
                    <a href="<?=$postDetails['youtubechannel']?>" class="cs-center" target="_blank">
                      <i class="fa-brands fa-youtube text-white"></i>
                    </a> 
            <?php } ?>
            <?php $PageURL = $postObj->getCompleteURL(); ?>
                    <a href="javascript:void(0);" data-url="<?=$PageURL?>" class="cs-center" id="pageurl" title="Copy Story Link">
                      <i class="fa fa-share-alt text-white"></i>
                    </a>
                   
                </div>
                  
                   <div class="cs-height_50 cs-height_lg_50"></div>
                  <div class="cs-post cs-style2">
                  <blockquote class="cs-primary_font"><?=$post["quote"]?> <small><?=$post["author"]?></small>
                </blockquote>
                </div>
                  
                </div>
                
                <div class="cs-height_40 cs-height_lg_40"></div>
                
            </div>
        </div>
      
     
    <div class="cs-height_20 cs-height_lg_20"></div>
    
    <div class="single-post-content">
				<?=$post["content"]?>			
    </div>
    
    
    <div class="row" id="reactions">
        <div class="col-lg-4 col-sm-4  text-center">
            <div class="reaction-like-wrap">
            <?php if(isset($_SESSION['userid'], $_SESSION['email'])){ ?>
                <ul class="reactions-ul">
                    <li class="<?=$rcActive1?>" data-storyid="<?=$post["id"]?>" data-reaction="Heartfelt"><a href="javascript:void(0);" class="like-button" title="Heartfelt">
                        <img src="/assets/images/icons/r-heartfelt.png" alt="Heartfelt">
                    </a></li>
                    <li class="<?=$rcActive2?>" data-storyid="<?=$post["id"]?>" data-reaction="Inspiring"><a href="javascript:void(0);" class="like-button" title="Inspiring">
                        
                        <img src="/assets/images/icons/r-inspiring.png" alt="Inspiration">
                    </a></li>
                    <li class="<?=$rcActive3?>" data-storyid="<?=$post["id"]?>" data-reaction="Spellbound"><a href="javascript:void(0);" class="like-button" title="Spellbound">
                        <img src="/assets/images/icons/r-spellbound.png" alt="Spellbound">
                    </a></li>
                    <li class="<?=$rcActive4?>" data-storyid="<?=$post["id"]?>" data-reaction="Passionate"><a href="javascript:void(0);" class="like-button" title="Passionate">
                        <img src="/assets/images/icons/r-passionate.png" alt="Passionate">
                    </a></li>
                    <li class="<?=$rcActive5?>" data-storyid="<?=$post["id"]?>" data-reaction="Heroic"><a href="javascript:void(0);" class="like-button" title="Heroic">
                        <img src="/assets/images/icons/r-heroic.png" alt="Heroic">
                    </a></li>
                </ul> 
            <?php }else{ ?>
            <a href="/login?rurl=/story/<?=$_GET["slug"].'#reactions';?>" class="login-redirect cs-btn cs-style1">Login <i class="fa-solid fa-arrow-right"></i></a>
            <?php } ?>
                <button class="cs-btn cs-style1" id="reactionbtn"><i class="<?=$heartclass?> fa-heart"></i> &nbsp;<span id="liketext">React</span> </button>
            </div>
            
        </div>
        
        <div class="col-lg-4 col-sm-4 text-center">
            <div class="story-save-wrap">
                
            <?php if(isset($_SESSION['userid'], $_SESSION['email'])){ }else{ ?>
                <a href="/login?rurl=/story/<?=$_GET["slug"].'#reactions';?>" class="login-redirect cs-btn cs-style1">Login <i class="fa-solid fa-arrow-right"></i></a>
                <?php } ?>
                <button class="cs-btn cs-style1" id="savestory"><i class="<?=$saveclass?> fa-bookmark"></i> &nbsp;<span id="storysavetext"><?=$saveclasstext?></span> </button>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 text-center">
            <div class="story-share-wrap">
                
            <?php if(isset($_SESSION['userid'], $_SESSION['email'])){ ?>
                <div class="shareicons">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_linkedin"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_copy_link"></a>
                    </div>
                </div>
            <?php }else{ ?>
                <a href="/login?rurl=/story/<?=$_GET["slug"].'#reactions';?>" class="login-redirect cs-btn cs-style1">Login <i class="fa-solid fa-arrow-right"></i></a>
                <?php } ?>
                
                <button class="cs-btn cs-style1"><i class="fa fa-share"></i> &nbsp;Share </button>
            </div>
        </div>
        
    </div>
    
    
              <div class="cs-height_100 cs-height_lg_100"></div>
    
 <!-- Start Blog Section -->
    <section class="cs-shape_wrap_4 cs-parallax">  
      <div class="container-fluid">
        <div class="cs-slider cs-style2 cs-gap-24">
         
         <!--<div class="container">   
          <div class="cs-slider_heading cs-style1">
              
                <div class="cs-section_heading cs-style1">
                  <h3 class="cs-section_subtitle wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s"> Social Feeds </h3>
                </div>
            
                <div class="cs-slider_arrows cs-style1 cs-primary_color">
                  <div class="cs-left_arrow cs-center">
                    <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.469791 5.96967C0.176899 6.26256 0.176899 6.73744 0.469791 7.03033L5.24276 11.8033C5.53566 12.0962 6.01053 12.0962 6.30342 11.8033C6.59632 11.5104 6.59632 11.0355 6.30342 10.7426L2.06078 6.5L6.30342 2.25736C6.59632 1.96447 6.59632 1.48959 6.30342 1.1967C6.01053 0.903806 5.53566 0.903806 5.24276 1.1967L0.469791 5.96967ZM26.0001 5.75L1.00012 5.75V7.25L26.0001 7.25V5.75Z" fill="currentColor" />
                    </svg>
                  </div>
                  <div class="cs-right_arrow cs-center">
                    <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M25.5305 7.03033C25.8233 6.73744 25.8233 6.26256 25.5305 5.96967L20.7575 1.1967C20.4646 0.903806 19.9897 0.903806 19.6968 1.1967C19.4039 1.48959 19.4039 1.96447 19.6968 2.25736L23.9395 6.5L19.6968 10.7426C19.4039 11.0355 19.4039 11.5104 19.6968 11.8033C19.9897 12.0962 20.4646 12.0962 20.7575 11.8033L25.5305 7.03033ZM0.00012207 7.25H25.0001V5.75H0.00012207V7.25Z" fill="currentColor" />
                    </svg>
                  </div>
                </div> 
                
            </div>
          </div>-->
        
        <h5 class="mb-3" style="color: #999696;">Social Feeds</h5>
        <hr class="mb-2">
        
        <div class="cs-slider cs-gap-24">
          <div class="cs-height_20 cs-height_lg_20"></div>
          <div class="cs-slider_container" data-autoplay="1" data-autoplaySpeed="200" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
            <div class="cs-slider_wrapper featured-stories">
            
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   <img src="/images/custom/linkmedscr-2.png" class="card-img-top" alt="...">
                </div>
             </div>    
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   <img src="/images/custom/linkmedscr-3.png" class="card-img-top" alt="...">
                </div>
             </div>    
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   <img src="/images/custom/instascr-1.png" class="card-img-top" alt="...">
                </div>
             </div>    
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   <img src="/images/custom/instascr-2.png" class="card-img-top" alt="...">
                </div>
             </div>
             
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   <img src="/images/custom/linkmedscr-4.png" class="card-img-top" alt="...">
                </div>
             </div>    
                
              
            </div>
          </div>
          <!-- .cs-slider_container -->
          <div class="cs-pagination cs-style1 cs-hidden_desktop"></div>
               
        </div>
        <!-- .cs-slider -->
      </div> 
    </section>
    <!-- End Blog Section -->
    
    <div class="cs-height_65 cs-height_lg_45"></div>
     
     <div class="row mycommunitySection">
        <div class="col-lg-12 col-sm-12">
    
            <div style="display: flex; justify-content: space-between;">
                <h5 class="mb-2" style="color: #999696;">My Community</h5> 
            </div>
            <hr class="mb-2"> 
            
          <div class="row">
        
            <div class="col-md-4">
                
                 <div class="cs-slider cs-style2 cs-gap-24">
                    <div class="cs-slider cs-gap-24">
            			<div class="cs-slider_container" data-autoplay="1" data-autoplaySpeed="200" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
            				<div class="cs-slider_wrapper featured-stories">
            				
        <div class="cs-slide  pt-4">
            <div class="cs-post cs-style1 ">
            	<div class="me-2 py-2 px-4 shadow-sm rounded-4 communityItem">
                    <div class="text-center">
                        <div class="position-relative d-flex justify-content-center">
                            <a href="#" class="text-decoration-none" tabindex="0">
                              <img src="/wahcommunity/upload/community/img/fav-logo1320886158.png" class="img-fluid rounded-circle mb-3" alt="profile-img">
                              <div class="position-absolute">
                                <span class="material-icons bg-primary small p-1 fw-bold text-white rounded-circle fa fa-check" ></span>
                              </div>
                            </a>
                        </div> 
                        <p class="m-0">WAHStory</p>
                        <p class="mb-0 followers">4+ <span class="text-muted">Members</span></p>
                    </div>
                </div>
            </div>
        </div>
        
            				
        <div class="cs-slide pt-4">
            <div class="cs-post cs-style1 ">
            	<div class="me-2 py-2 px-4 shadow-sm rounded-4 communityItem">
                    <div class="text-center">
                        <div class="position-relative d-flex justify-content-center">
                            <a href="#" class="text-decoration-none" tabindex="0">
                              <img src="/wahcommunity/upload/community/img/fav-logo1320886158.png" class="img-fluid rounded-circle mb-3" alt="profile-img">
                              <div class="position-absolute">
                                <span class="material-icons bg-primary small p-1 fw-bold text-white rounded-circle fa fa-check" ></span>
                              </div>
                            </a>
                        </div> 
                        <p class="m-0">WAHStory</p>
                        <p class="mb-0 followers">4+ <span class="text-muted">Members</span></p>
                    </div>
                </div>
            </div>
        </div>
            				
            				
            				</div>
            			</div>
            		</div>
            	</div>
                 
                <div class="cs-height_20 cs-height_lg_20"></div>
                
            </div>
            
             <div class="col-md-4">
                   
                   
                   <div class="pt-4 feeds">
                                            
                    <div class="p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex">
                          <img src="/images/users/user-icon572905492.jpg" class="img-fluid rounded-circle user-img" alt="profile-img">
                          <div class="d-flex ms-3 align-items-start w-100">
                            <div class="w-100">
                              <div class="d-flex align-items-center justify-content-between">
                                <a href="javascript:void(0);" class="text-decoration-none d-flex align-items-center">
                                  <h6 class="authorName mb-0">Amit Kapoor
                                  <span class="ms-2 bg-primary p-1 md-16 rounded-circle fa fa-check"></span> </h6>
                                </a>
                                <div class="d-flex align-items-center small">
                                  <p class="text-muted mb-0">23, May</p>
                                   
                                </div>
                              </div> 
                              <div class="my-2 content">
                                 
                                <p class="text-dark"></p><h2>7 Powerful Traits Common in High Performing Leaders</h2><p>Great leaders aren't born, they're made. But what exactly makes a leader truly high-performing?&nbsp; While leadership styles can vary, there are core character traits that consistently propel individuals to the forefront.</p> 
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                        
                    </div> 
            </div>
            
            <div class="col-md-4">
                   
                   
                   <div class="pt-4 feeds">
                                            
                    <div class="p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex">
                          <img src="/images/users/user-icon572905492.jpg" class="img-fluid rounded-circle user-img" alt="profile-img">
                          <div class="d-flex ms-3 align-items-start w-100">
                            <div class="w-100">
                              <div class="d-flex align-items-center justify-content-between">
                                <a href="javascript:void(0);" class="text-decoration-none d-flex align-items-center">
                                  <h6 class="authorName mb-0">Amit Kapoor
                                  <span class="ms-2 bg-primary p-1 md-16 rounded-circle fa fa-check"></span> </h6>
                                </a>
                                <div class="d-flex align-items-center small">
                                  <p class="text-muted mb-0">23, May</p>
                                   
                                </div>
                              </div> 
                              <div class="my-2 content">
                                 
                                <p class="text-dark"></p><h2>7 Powerful Traits Common in High Performing Leaders</h2><p>Great leaders aren't born, they're made. But what exactly makes a leader truly high-performing?&nbsp; While leadership styles can vary, there are core character traits that consistently propel individuals to the forefront.</p> 
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                        
                    </div> 
            </div>
            
          </div>
             
        </div>
    </div> 
    
    
    <div class="cs-height_65 cs-height_lg_45"></div>
    
 <!-- Start Blog Section -->
    <section class="cs-shape_wrap_4 cs-parallax">  
      <div class="container-fluid">
        <div class="cs-slider cs-style2 cs-gap-24">
         
        <h5 class="mb-3" style="color: #999696;">Blogs & Articles</h5>
        <hr class="mb-2">
        
        <div class="cs-slider cs-gap-24">
          <div class="cs-height_20 cs-height_lg_20"></div>
          <div class="cs-slider_container" data-autoplay="1" data-autoplaySpeed="200" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
            <div class="cs-slider_wrapper featured-stories">
               
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   
                   <div class="card h-100">
                        <img src="https://www.wahstory.com/images/blogs/Collaborationpostfor(InstagramPost)(8)397998241.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">5 Ways Solopreneurs Can Sale Their Business Through Collaboration</h5>
                    <p class="card-text" align="justify">In today's fast-paced business world, the pressure to constantly innovate and differentiate can lead companies down a path of complexity. Feature creep, convoluted processes, and jargon...</p>
                     </div>
                     </div>
                   
                </div>
             </div>    
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   
                   <div class="card h-100">
                        <img src="https://www.wahstory.com/images/blogs/BrandStorytelling(2)(1)1094969136.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">How to Keep an Entrepreneurial Spirit Alive in Your Small Business</h5>
                    <p class="card-text" align="justify">In today's fast-paced business world, the pressure to constantly innovate and differentiate can lead companies down a path of complexity. Feature creep, convoluted processes, and jargon...</p>
                     </div>
                     </div>
                   
                </div>
             </div>    
              
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   
                   <div class="card h-100">
                        <img src="https://www.wahstory.com/images/blogs/Collaborationpostfor(InstagramPost)(7)1475407198.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Spotlighting Success: SHRM India Joins Hands with WAHstory</h5>
                    <p class="card-text" align="justify">In today's fast-paced business world, the pressure to constantly innovate and differentiate can lead companies down a path of complexity. Feature creep, convoluted processes, and jargon...</p>
                     </div>
                     </div>
                   
                </div>
             </div>  
             
             
            <div class="cs-slide ">
                <div class="cs-post cs-style1 ">
                   
                   <div class="card h-100">
                        <img src="https://www.wahstory.com/images/blogs/BrandStorytelling(2)(1)1094969136.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">How to Keep an Entrepreneurial Spirit Alive in Your Small Business</h5>
                    <p class="card-text">In today's fast-paced business world, the pressure to constantly innovate and differentiate can lead companies down a path of complexity. Feature creep, convoluted processes, and jargon...</p>
                     </div>
                     </div>
                   
                </div>
             </div>   
              
            </div>
          </div>
          <!-- .cs-slider_container -->
          <div class="cs-pagination cs-style1 cs-hidden_desktop"></div>
               
        </div>
        <!-- .cs-slider -->
      </div> 
    </section>
    <!-- End Blog Section -->
    
    
    <div class="cs-height_65 cs-height_lg_45"></div>
    
     <section class="cs-shape_wrap_4 cs-parallax"> 
        <div class="container">
            <div class="row connect-options">
                
                <div class="col-md-4 text-center">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Books & Products <i class="fa fa-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                        <li><a class="dropdown-item" href="#">Another action &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                        <li><a class="dropdown-item" href="#">Something else here &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                      </ul>
                    </div>
                </div>
                
                
                <div class="col-md-4 text-center">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Connect with Amit Kapoor <i class="fa fa-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                        <li><a class="dropdown-item" href="#">Another action &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                        <li><a class="dropdown-item" href="#">Something else here &nbsp;<i class="fa fa-arrow-right"></i></a></li>
                      </ul>
                    </div>
                </div>
                
                
                
                <div class="col-md-4 text-center">
                    <div class="cs-height_20 cs-height_lg_20"></div>
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Visit Website <i class="fa fa-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://www.wahstory.com/" target="_blank"> www.wahstory.com </a></li>
                        <li><a class="dropdown-item" href="https://www.elementshrs.com/" target="_blank"> www.elementshrs.com </a></li>
                        <li><a class="dropdown-item" href="https://investinu.co.in/" target="_blank"> www.investinu.co.in </a></li>
                        
                      </ul>
                    </div>
                </div>
                
            </div>
        </div>
     
     </section>
    
    
    
    
    
    <?php if($postObj->getStoryProducts($post['id']) != ''){ ?> 
    <div class="cs-height_65 cs-height_lg_45"></div>
     
     <div class="row">
        <div class="col-lg-12 col-sm-12">
    
            <div style="display: flex; justify-content: space-between;" id="StoryProducts">
                <h5 class="mb-2" style="color: #999696;">Products</h5> 
            </div>
            <hr class="mb-2"> 
            
          <div class="row">
        <?php 
        //Fetch Products 
        foreach ($postObj->getStoryProducts($post['id']) as $product){
        ?>
             <div class="col-md-4">
              <div class="cs-height_10 cs-height_lg_10"></div>
              <div class="productswrapper">
                <div class="productimage">
                    <img src="/assets/images/products/<?=$product['img']?>">
                </div>
                <div class="producttitle">
                    <a href="<?=$product['link']?>" target="_blank"><?=$product['producttitle']?> </a>
                </div>
                <?php if($product['link'] != ''){ ?>
                <a href="<?=$produt['link']?>" target="_blank" class="cs-btn cs-style1"> <i class="fa fa-shopping-cart"></i>&nbsp; Buy Now</a>
                <?php } ?>
              </div>
              <div class="cs-height_10 cs-height_lg_10"></div>
            </div>
        <?php 
        }
        //ends ?>
            
           
            
          </div>
             
        </div>
    </div>
    <?php } ?>
     
     <?php if($postObj->getStoryGallery($post['id']) != ''){ ?>
     <div class="cs-height_50 cs-height_lg_50"></div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12">
            
                <div style="display: flex; justify-content: space-between;" id="StoryGallery">
                    <h5 class="mb-2" style="color: #999696;">Gallery</h5> 
                </div> 
                <hr class="mb-2">
           
              <div class="row">
            <?php foreach ($postObj->getStoryGallery($post['id']) as $gallery){ ?>
                 <div class="col-md-4">
                  <div class="cs-height_10 cs-height_lg_10"></div>
                  <div class="my-gallerywrapper">
                    <div class="galleryimage">
                        <img src="/assets/images/gallery/<?=$gallery['img']?>">
                    </div>
                     
                  </div>
                  <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
            <?php } ?>
                
              </div>
            </div>
        </div>
     <?php } ?>
     
      
    
 </div>  
  
  <div class="cs-height_115 cs-height_lg_80"></div>
  
<!-- Start CTA -->

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <!--postreaction.php-->
    <script>
        $(document).ready(function() {
    $('ul.reactions-ul li').on('click', function(e) {
        $('ul.reactions-ul li').removeClass('active');
        $(this).addClass('active');
        
        
        $('button#reactionbtn i').removeClass('fa-regular');
        $('button#reactionbtn i').addClass('fa');
        
        const storyId = $(this).data('storyid');
        const reaction = $(this).data('reaction');
        const UserId = <?=$_SESSION['userid']?>;

        $.ajax({
            type: 'POST',
            url: '/postreaction.php',
            data: {
                storyid: storyId,
                reaction: reaction,
                userid: UserId,
                action: 'react'
            },
            success: function(response) {
                // Handle the response from the server here
                // console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.error(textStatus, errorThrown);
            }
        });
    });
    
    
    //Save Story
    $('button#savestory').on('click', function(e) {
        
        $('button#savestory i').removeClass('fa-regular');
        $('button#savestory i').addClass('fa');
        
	    $('#storysavetext').html("Saved");
        
        $.ajax({
            type: 'POST',
            url: '/postreaction.php',
            data: {
                storyid: <?=$post["id"]?>,
                userid: <?=$_SESSION['userid']?>,
                action: 'save'
            },
            success: function(response) {
                // Handle the response from the server here
                // console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.error(textStatus, errorThrown);
            }
        });
    
    });
    
    
});

    </script>
    <!-- AddToAny BEGIN -->

<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
<script>
  document.getElementById('pageurl').addEventListener('click', function(event) {
    event.preventDefault();
    copyToClipboard(this.getAttribute('data-url'));
    alert("Link Copied, Now Share it on linkedIn, Instagram, and Others");
    $(this).find('i').addClass('fa-check');
  });

  function copyToClipboard(text) {
    var textarea = document.createElement("textarea");
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    document.body.removeChild(textarea);
  }
</script>


<?php include('footer.top.php');?>
     
    
  </body>
</html>