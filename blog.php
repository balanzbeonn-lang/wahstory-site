<?php 
session_start();

    include('inc/functions.php');
    $postObj = new Story(); 
    
    if(isset($_GET["slug"]) && $_GET["slug"] != ''){
        
        $script = "";
    	$blog = $postObj->getBlogByslug($_GET["slug"]);
    	if(!$blog){
    	    $blog = $postObj->getStoryByID($_GET["slug"]);
    	    if(!$blog){
    	        	header("Location: /blogs/");
    	    }
    	}
    // 	$postObj->setBlogViews($post["id"]);
    	
    }
    else{
        header("Location: /blogs/");
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
  <title><?=$blog["title"]?> | WAHStory</title>
  
  
    <meta name="keywords" content="<?=$blog["metakeywords"]?>"/>
  
    <meta name="description" content="<?=$blog["metadescription"]?>"/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />  
    
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/blog/<?=$blog["slug"]?>">
    <meta name="identifier-URL" content="https://www.wahstory.com/blog/<?=$blog["slug"]?>">
    <meta name="directory" content="Blog & News"> 
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/blog/<?=$blog["slug"]?>" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="<?=$blog["title"]?> | WAHStory">
    <meta name="og:description" content="<?=$blog["metadescription"]?>">
    <meta property="og:url" content="https://www.wahstory.com/blog/<?=$blog["slug"]?>" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/blogs/<?=$blog["img"]?>" />
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
         color: #d1d1d1;
     } 
     .cs-post.cs-style2 p{
         margin-bottom: 15px;
        line-height: inherit;
        text-align: justify;
        font-size: 14px !important;
     }
     .cs-post.cs-style2 p span{ 
        font-size: 16px !important;
     }
     .single-post-content a{
         color: #e9204f;    
         }
     .single-post-content a:hover{
         color: #fff;    
         }
    
        .cs-post.cs-style2 .cs-post_title {
                -webkit-box-orient: unset;
                line-height: 40px;
                font-size: 30px; 
            
        }
        
    /*@media screen and (max-width:768px){
        .cs-post.cs-style2 .cs-post_title {
                font-size: 18px;
            
        }
    }*/
    
    @media screen and (max-width:991px){
        .cs-post.cs-style2 .cs-post_title {
                font-size: 20px;
            
        }
    }
         
 </style> 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="/assets/images/page-title-bg.jpeg">
      <div class="container">
        <div class="cs-page_heading_in">
          <h1 class="cs-page_title cs-font_50 cs-white_color"><?=$blog['title'];?></h1>
           
        </div>
      </div>
    </div>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  
  <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="cs-post cs-style2">
              <div class="cs-post_thumb cs-radius_15">
                <img src="/images/blogs/<?=$blog["img"];?>" alt="<?=$blog["alttext"]?>" class="w-100 cs-radius_15">
              </div>
              <div class="cs-height_30 cs-height_lg_30"></div>
              <div class="cs-post_info">
                <div class="cs-post_meta cs-style1 cs-ternary_color cs-semi_bold cs-primary_font">
                  <span class="cs-posted_by"><?=$blog['date'];?></span> 
                </div>
                
                <h2 class="cs-post_title"><?=$blog['title'];?></h2>
                <div class="cs-height_20 cs-height_lg_20"></div>
    
                    <div class="single-post-content">
                    <?=$blog['content'];?>
                  
                    </div>
              </div>
            </div>
             
            
          </div>
          <div class="col-xl-3 col-lg-4 offset-xl-1">
            <div class="cs-height_0 cs-height_lg_80"></div>
            <div class="cs-sidebar cs-right_sidebar cs-accent_5_bg_2">
               
              <div class="cs-sidebar_item widget_search">
                <h4 class="cs-sidebar_widget_title">Search</h4>
                <form class="cs-sidebar_search" method="get" action="/blogs/">
                  <input type="search" name="blogsearch" placeholder="Search by Title, Keywords..." value="">
                  <button class="cs-sidebar_search_btn" type="submit">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11.4351 10.0629H10.7124L10.4563 9.81589C11.3528 8.77301 11.8925 7.4191 11.8925 5.94625C11.8925 2.66209 9.23042 0 5.94625 0C2.66209 0 0 2.66209 0 5.94625C0 9.23042 2.66209 11.8925 5.94625 11.8925C7.4191 11.8925 8.77301 11.3528 9.81589 10.4563L10.0629 10.7124V11.4351L14.6369 16L16 14.6369L11.4351 10.0629ZM5.94625 10.0629C3.66838 10.0629 1.82962 8.22413 1.82962 5.94625C1.82962 3.66838 3.66838 1.82962 5.94625 1.82962C8.22413 1.82962 10.0629 3.66838 10.0629 5.94625C10.0629 8.22413 8.22413 10.0629 5.94625 10.0629Z" fill="currentColor" />
                    </svg>
                  </button>
                </form>
              </div>
              
              <div class="cs-sidebar_item">
                <h4 class="cs-sidebar_widget_title">Recent Blogs</h4>
                <ul class="cs-recent_posts">
        <?php 
        
        foreach($postObj->getRecentBlogs(5) as $blog){ 
        ?>
                  <li>
                    <div class="cs-recent_post">
                      <a href="/blog/<?=$blog['slug'];?>" class="cs-recent_post_thumb">
                        <div class="cs-recent_post_thumb_in cs-bg" data-src="/images/blogs/<?=$blog['img'];?>"></div>
                      </a>
                      <div class="cs-recent_post_info">
                        <h3 class="cs-recent_post_title">
                          <a href="/blog/<?=$blog['slug'];?>"><?=$blog['title'];?>...</a>
                        </h3>
                        <div class="cs-recent_post_date cs-primary_40_color"><?=$blog['date'];?></div>
                      </div>
                    </div>
                  </li>
        <?php   }   ?>
                  
                </ul>
              </div>
               
            
            </div>
          </div>
        </div>
      </div>
    </section>
    
  <div class="cs-height_20 cs-height_lg_20"></div>
  
   
  
  
  <!-- Start CTA -->
  <?php include('footer.top.php');?>
     
    
  </body>
</html>