<?php 
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
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
         

     
 </style>
 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="/assets/images/page-title-bg.jpeg">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color"><?=$post["title"]?></h1>
        <ol class="breadcrumb text-uppercase">
          <li class="breadcrumb-item active"><a href="/stories/<?php echo $postObj->getCatById($post["category"])['slug']; ?>" class="post-cat fashion"><?php echo $postObj->getCatById($post["category"])['name']; ?></a></li>
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