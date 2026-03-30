<?php 
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("inc/functions.php");
$postObj = new Story();
?>
<!DOCTYPE html>
<html class="no-js" lang="en"> 
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?=BASE_URL?>/images/wah_fav.ico">
    
    <title>WAHStory | Journeys of success, passion, pride and spark</title>

    <meta name="keywords" content="Storytelling, Storyteller, Sucess Stories, Speakers, Inspiring Stories, Corporate World, Stories to read, Digital Transformation, Entrepreneurs, TedX Speakers, founders, startups, India, Bangalore, Mumbai, Delhi, Women Leaders, Narrative"/>
    <meta name="description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders."/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />
    <meta name="abstract" content="Engage with talented writers and embark on a journey to share your own creative stories on our storytelling platform. Explore a diverse collection of narratives that captivate and inspire.">
    
    <meta name="topic" content="storytelling, Founders, Diversity and Inclusion, HR, Powerful Lessons, Author, Life Mantra, Mentor, Setbacks to Success"> 
    <meta name="Classification" content="Sucess Stories">
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="wahstory.com">
    <meta name="url" content="https://www.wahstory.com/">
    <meta name="identifier-URL" content="https://www.wahstory.com/">
    <meta name="directory" content="Home">
    <meta name="category" content="Her Story, Game Changer, Passion Story, Pride Story, Influencers, Living Well">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="WAHStory | Journeys of success, passion, pride and spark">
    <meta name="og:description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders.">
    <meta property="og:url" content="https://www.wahstory.com/" />
    <meta property="og:site_name" content="WahStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/og-wahstory.webp" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
    <meta property="og:image:type" content="image/png" />
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- CDNS -->
    
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='//cdnjs.cloudflare.com' />
    <link rel='dns-prefetch' href='//cdn.jsdelivr.net' />
    <link rel='dns-prefetch' href='//www.googletagmanager.com' />
    <link rel='dns-prefetch' href='//www.google-analytics.com' />    
    <!-- CDNS /-->
    
    
    <!--<link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css" />-->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/plugins/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/plugins/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/plugins/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/style.css" /> 
    
    
    <style>
           
        .cs-shape_wrap_5 .cs-shape_5 {
            right: 10px;
            bottom: 10px;
            height: 170px;
            width: 170px;
            position: fixed;
            background-color: #000;
            border-radius: 52%;
            z-index: 21;
        }
        
        .cs-shape_wrap_5 .cs-shape_6 {
            right: 46px;
            bottom: 48px;
            height: 125px;
            width: 95px;
            /*padding: 8px;*/
            z-index: 20;
            position: fixed;
            /*background: #000;*/
            border-radius: 50%;
        }
        
        .shapewithtextbottom:hover {
            background: #e9204f;
            color: #000;
        }
        
       .shapewithtextbottom a:hover {
            color: #000;
        }
   
    .cs-isotop_item.9, .cs-isotop_item.8, .cs-isotop_item.10, .cs-isotop_item.11, .cs-isotop_item.22, .cs-isotop_item.16 {
        display: none;
        }
        
        
        /*NEWS CARD STYLES START HERE*/
        :root {
            --image-gradient-overlay-start-color: rgba(0, 0, 0, 0);
            --image-gradient-overlay-end-color: rgb(0 0 0 / 98%);
        }

     .single-post-content p b{
         color: #d1d1d1;
     } 
     .cs-post.cs-style2 p{
        margin-bottom: 15px;
        line-height: inherit;
     }
     .card{
         border:5px solid black;
         border-radius:10px;
     }
     .card-body{
         background:black ;
         
     }
     .card .card-body h5{
         padding:2px 10px 0 10px;
     }
     .topNewsHeight{
         min-height:440px;
     }
     .carousel-inner.topNewsHeight img{
         min-height:440px;
     }
     .carousel-inner.topNewsHeight img{
         min-height:440px;
     }
     
     /*.card.topNewsHeight img.card-img-top{
         max-height: 158px;
     }*/
     
     .image-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                var(--image-gradient-overlay-start-color),
                var(--image-gradient-overlay-end-color)
            );
            pointer-events: none; /* Ensures the overlay doesn't interfere with image interactions */
        } 
         .NewsTopLeftContainer .carousel-caption{
            right: 5%;
            bottom: -0.25rem;
            left: 5%;
         }
     
     
     
     .carousel-indicators{
    position: absolute;
    right: 0px;
    bottom: -30px;
    left: 0;
    z-index: 2;
    display: flex;
    justify-content: center;
    padding: 0;
    margin-right: 15%;
    margin-bottom: 0rem;
    margin-left: 15%;
    list-style: none;
         
     }
     
     .carousel-caption {
        position: absolute;
        right: 15%;
        bottom: 1.25rem;
        left: 15%;
        padding-top: 2.25rem;
        padding-bottom: 0.1rem;
        color: #fff;
        text-align: center;
    }
    .morenewscard img{
        border: 0;
        max-width: 100%;
        height: 201px;
    }
     
     
     @media only screen and (max-width: 767px){
         .topNewsHeight{
             min-height:auto;
         }
         .carousel-inner.topNewsHeight img{
             min-height:auto;
         }
         .carousel-caption{
             font-size:10px;
         }
         .NewsTopLeftContainer .carousel-caption {
            right: 3%;
            bottom: -1.10rem;
            left: 5%;
            line-height: initial;
        }
        .NewsTopLeftContainer .carousel-caption h5 {
            font-size:14px;
            line-height: 16px;
            font-weight:1000;
        }
        
        .cs-shape_wrap_5 .cs-shape_6 {
        right: 40px;
        bottom: 30px;
        height: 85px;
        width: 54px;
        /* padding: 8px; */
        z-index: 20;
        position: fixed;
        /* background: #000; */
        border-radius: 50%;
     }
     .cs-shape_wrap_5 .cs-shape_5 {
            right: 10px;
            bottom: 10px;
            height: 110px;
            width: 110px;
            position: fixed;
            background-color: #000;
            border-radius: 52%;
            z-index: 21;
       }
      
        
    } 
     
     
     .morenewscard .topNewsHeight {
        min-height: 490px;
    }
     
     
    .newscard p{
         display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /*text-align: justify;*/
     } 
     
     .morenewscard p{
         display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /*text-align: justify;*/
     }
     
     .carousel-item p{
         display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /*text-align: justify;*/
     }
     .carousel-item h5{
         display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; 
     }
     
    .newscard .newstitle, .morenewstitle{
         display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; 
     }
     
     
     .readmorebtn:hover i{
         margin-left: 10px;
         transition: all 0.2s ease-in-out;
     }
     .readmorebtn{
        border-color: #e9204f96;
        color: #e9204fd6;
        font-size: 13px;
        padding: 2px 8px;
        font-weight: 700;
     }
     
    /*.cs-isotop_item.ui_ux_design:not(.ui_ux_design.all){*/
    /*    display: none !important;*/
    /*}*/
    
    /* Skeleton Loading */
    
    .skeleton-loader {
      position: relative;
      overflow: hidden;
        background-color: #323131;
    }
    .skeleton-loader:after{
      content: "";
      -webkit-animation: ssc-loading 1.3s infinite;
              animation: ssc-loading 1.3s infinite;
      height: 100%;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transform: translateX(-100%);
              transform: translateX(-100%);
      z-index: 1;
      background: -webkit-gradient(linear, left top, right top, from(transparent), color-stop(rgba(255, 255, 255, 0.3)), to(transparent));
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }
    
    @keyframes ssc-loading {
      from {
        -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
      }
      to {
        -webkit-transform: translateX(100%);
                transform: translateX(100%);
      }
    }
    
    .loading-title {
        height: 40px;
        background-position: center;
        border-radius: 15px;
    } 
    .loading-subtitle {
        height: 20px;
        background-position: center;
        border-radius: 15px;
    } 
    .loading-image-card {
        height: 380px;
        background-position: center;
        border-radius: 15px;
    } 
     
    </style>
    
 <?php include('header.php');?>
 
 <!-- Start Hero -->
    <div class="cs-hero cs-style1 cs-bg cs-fixed_bg cs-shape_wrap_1" data-src="assets/images/girlbanner.webp" id="home">
      <div class="container">
        <div class="cs-hero_text">
          <h1 class="cs-hero_title wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s"> 
		  
		  Unlocking the <br />Storytelling Potential</h1>
           
        </div>
        <a href="/shareyourstory/" class="cs-btn cs-style1 mt-2">
            <span>Share Your Story</span>
              <!--<svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
              </svg> -->
            
        </a>
      </div>
      
      <a href="#homeinsights" class="cs-down_btn" aria-label="Scroll to insights section" title="Scroll to insights section"></a>
    </div>
    <!-- End Hero -->
 
    <!-- Start FunFact -->
    <section>
      <div class="container">
        <div class="cs-funfact_wrap cs-type1">
          <div class="cs-funfact_shape" data-src="assets/images/funfact_shape_bg.svg"></div>
          <div class="cs-funfact_left">
            <div class="cs-funfact_heading">
              <h2>Impactful Stories Around The Globe</h2>
              <p> Our platform has journeyed across continents, capturing stories that resonate from every corner of the world. </p>
            </div>
          </div>
          <div class="cs-funfact_right" id="homeinsights">
            <div class="cs-funfacts">
              <div class="cs-funfact cs-style1">
                <div class="cs-funfact_number cs-primary_font cs-semi_bold cs-primary_color">
                  <span data-count-to="500" class="odometer"></span>
                </div>
                <div class="cs-funfact_text">
                  <span class="cs-accent_color">+</span>
                  <p>Stories Covered</p>
                </div>
              </div>
              <div class="cs-funfact cs-style1">
                <div class="cs-funfact_number cs-primary_font cs-semi_bold cs-primary_color">
                  <span data-count-to="50" class="odometer"></span>
                </div>
                <div class="cs-funfact_text">
                  <span class="cs-accent_color">+</span>
                  <p>Countries</p>
                </div>
              </div>
              <div class="cs-funfact cs-style1">
                  <?php
                  $heartprints_num = $postObj->getAllStoriesCount("Views")["count"];
                  if ($heartprints_num >= 1000000) {
                        $heartprints = round($heartprints_num / 1000000, 1);
                        $keyp = 'M';
                    } else{
                        $heartprints = round($heartprints_num / 1000, 1);
                        $keyp = 'K'; 
                    }
                  ?>
                <div class="cs-funfact_number cs-primary_font cs-semi_bold cs-primary_color">
                  <span data-count-to="<?=round($heartprints)?>" class="odometer"></span><?=$keyp?>
                </div>
                <div class="cs-funfact_text">
                  <span class="cs-accent_color">+</span>
                  <p>Heartprints</p>
                </div>
              </div>
              <div class="cs-funfact cs-style1">
                <div class="cs-funfact_number cs-primary_font cs-semi_bold cs-primary_color">
                  <span data-count-to="1.5" class="odometer"></span>M
                </div> 
                <div class="cs-funfact_text">
                  <span class="cs-accent_color">+</span>
                  <p>Social Reach</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
       
    <div id="mid-sections">
        
        <div class="cs-height_150 cs-height_lg_80"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4  py-2">
                    <div class="loading-subtitle skeleton-loader mb-2" style="width: 80%;"></div>
                    <div class="cs-height_30"></div>
                    <div class="loading-title skeleton-loader"></div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
            </div>
        </div>
        <div class="cs-height_150 cs-height_lg_80"></div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 py-2">
                    <div class="loading-subtitle skeleton-loader mb-2" style="width: 80%;"></div>
                    <div class="cs-height_30"></div>
                    <div class="loading-title skeleton-loader"></div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2 py-2">
                    <div class="loading-title skeleton-loader"></div>
                </div>
            </div>
            <div class="cs-height_30"></div>
            <div class="row">
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
                <div class="col-md-3 loading py-2">
                    <div class="loading-image-card skeleton-loader"></div>
                </div>
            </div>
        </div>
        <div class="cs-height_150 cs-height_lg_80"></div>
        
    </div>
    
    
  <script src="assets/js/plugins/swiper.min.js"></script>
  
   <script>
        
        
            // Set a delay before fetching the section
        document.addEventListener('DOMContentLoaded', function(){
            
            setTimeout(function() {
                // Fetch content from section.php asynchronously
                fetch('home-sections/mid-sections.php')
                    .then(response => response.text()) // Get the response as text
                    .then(data => {
                        // Insert the fetched content into the delayed-section
                        document.getElementById('mid-sections').innerHTML = data;
  
                        // Make the section visible after it's loaded
                        document.getElementById('mid-sections').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error loading section:', error);
                    });
            }, 1000); // Delay of 5 seconds
            
        });
    </script>
   
  
   <?php include('footer.top.php');?>
     
    
  </body>
</html>