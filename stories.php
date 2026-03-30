<?php 
session_start();
    include('inc/functions.php');
    $postObj = new Story(); 
    
   if(isset($_GET["slug"]) && $_GET["slug"] != ''){
       
       $category = $postObj->getCatBySlug($_GET["slug"]);
    	if ($category) {
    		$posts = $postObj->getStoriesByCat($category['id']);
    	} else {
    		$posts = $postObj->getAllStories();
    	}
        
    } else {
    	$posts = $postObj->getAllStories();
    	$category['name'] = "All";
    	$category['slug'] = "";
    }
    
    if(!empty($_GET["query"])){
        $posts = $postObj->getPostsByQuery($_GET["query"]);
        $category['name'] = str_replace('-', ' ', $_GET["query"]);
    	$category['slug'] = "";
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
  <title>Success Stories | Inspiring Stories - Wah Story</title>
  
    <meta name="keywords" content="Storytelling, Storyteller, Corporate World, Stories to read, Sucess Stories, Speakers, Inspiring Stories, Digital Transformation, Entrepreneurs, startups, TedX Speakers, founders, India, Bangalore, Mumbai, Delhi, Women Leaders, Narrative"/>
  
    <meta name="description" content="Learn from these success stories through storytelling platform, Storyteller, Corporate World, Sucess Stories, Inspiring Stories, Entrepreneurs, startups, TedX Speakers, founders, Women Leaders Stories."/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />
    <meta name="abstract" content="">
    
    <meta name="topic" content=""> 
    <meta name="Classification" content="Sucess Stories">
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/stories/">
    <meta name="identifier-URL" content="https://www.wahstory.com/stories/">
    <meta name="directory" content="Home">
    <meta name="category" content="Her Story, Game Changer, Passion Story, Pride Story, Influencers, Living Well">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/stories/" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="WAHStory | Journeys of success, passion, pride and spark">
    <meta name="og:description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders.">
    <meta property="og:url" content="https://www.wahstory.com/stories/" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/logos/logo-light.png" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
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
         color: #d1d1d1;
     } 
    
    .cs-shop_sidebar{
       background-color: #181818; 
       padding: 0;
    }
    .cs-shop_sidebar_category_list li{
        border-bottom: 1px solid #3330;
    }
    .cat-stories-wrapper .cs-product_card.cs_style_1 .cs-product_thumb img{
        height: 465px;
        -o-object-fit: cover;
        object-fit: cover;
    }
     .cs-product_card.cs_style_1 .cs-product_thumb img{
        height: 465px;
        -o-object-fit: cover;
        object-fit: cover;
    }
    .color-theme{
        color: #e9204f;
    }
    
    .cs-card_storytitleCover{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        
        background: linear-gradient(0deg,#191c21 0,rgba(25,28,33,.5) 50%,rgba(25,28,33,0) 90%) 50% no-repeat;
    }
    .cs-card_storytitleWrapper{
        align-self: flex-end;
        text-align: center;
        transition: transform .5s ease-out;
        transform: translateY(138px);
    }
    .cs-card_storytitleCover:hover .cs-card_storytitleWrapper{ 
        transform: translateY(0px);
    }
    .cs-card_storytitleCover:hover .cs-card_storytitleWrapper .cs-card_storyreadbtn{ 
        opacity: 1;
    }
    .cs-card_storytitle{
        max-width: 220px;
    }
    .cs-card_storytitle p{
        font-weight: 600;
    }
    
    .cs-card_storyreadbtn{
        height: 138px;
        opacity: 0;
        transition: opacity .5s ease-out;
    }
    
    .cs-page_heading.cs-style1 {
        height: 250px;
        padding: 110px 0 10px;
    }
    .topspace{
        height: 50px;
    }
    .topspace30{
        height: 10px;
    }
    @media only screen and (max-width: 768px) {
        
        .cs-page_heading.cs-style1 {
            height: 170px;
            padding: 70px 0 10px;
        }
        
        .topspace{
            height: 15px;
        }
        
        .topspace30{
            height: 15px;
        }
        
        .cs-shop_sidebar_category_list li {
            font-size: 14px;
        }
        .SubscribeForm2 p{
            font-size: 14px;
        }
    }
 </style> 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="/assets/images/page-title-bg.jpeg">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">Meet the StoryTellers</h1> 
      </div>
    </div>
  </div>
  
  <!-- End Hero -->
  <div class="topspace"></div>
  <div class="cat-stories container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">
            
          <div class="cs-shop_sidebar_widget">
            <ul class="cs-shop_sidebar_category_list">
                <li <?php if($_GET['slug']==''){ echo 'class="active"';}?>><a href="/stories" class="colot-theme">All</a></li>
                <?php foreach ($postObj->getCats() as $cat) : ?>
						<?php if ($cat['id'] === '12' || $cat['id'] === '13' || $cat['id'] === '14')
									continue; ?>
						<li <?php if($_GET['slug']==$cat['slug']){ echo 'class="active"';}?>>
						   <a href="/stories/<?php echo $cat['slug']; ?>"><?php echo $cat['name']; ?></a>
						</li>
					<?php endforeach; ?>
                
            </ul>
          </div>
          
          
        </div>
      </div>
      <div class="col-lg-9">
        <div class="topspace30"></div>
        <h4 class="mb-2"><?=$category['name']?></h4>
          <hr class="mb-4">
        
        
        <div class="row cat-stories-wrapper">
            
        <?php
		if ($posts) {
			foreach ($posts as $post) {
				// $checkBoost = $postObj->isBoosted($post["id"], $_GET["cat"]);
		?>
            
          <div class="col-lg-4 col-sm-6">
              
            <div class="cs-product_card cs_style_1">
              <div class="cs-product_thumb grayscale-img">
                 
                <img src="/images/posts/<?=$post['img']?>" class="" alt="<?=$post['author']?>">
                <div class="cs-product_overlay"> 
                <div class="cs-card_storytitleCover">
                    
                  <div class="cs-card_storytitleWrapper"> 
                    <div class="cs-card_storytitle">
                        <a href="/story/<?=$post['slug']?>">
                            <h3 class="mb-1"><?=$post['author']?></h3>
                            <p class="TitlewithEllips"><?=$post['title']?></p>
                        </a>
                    </div>
                    <div class="cs-card_storyreadbtn">
                        <a href="/story/<?=$post['slug']?>" class="cs-btn cs-style1">
                            Read Story
                        </a>
                    </div>
                    
                  </div>
                  
                </div>
              
                </div>
                
              </div>
              
            </div>
            <div class="cs-height_55 cs-height_lg_25"></div>
          </div>
        <?php } 
            } ?>
          
        </div>
        
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_50"></div>
  
  <!-- Start CTA -->
  <?php include('footer.top.php');?>
     
    
  </body>
</html>