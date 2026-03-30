<?php 
session_start();
    include('inc/functions.php');
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
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
    <!-- Site Title -->
    <title> News | WAHStory</title>
  
    <meta name="keywords" content=""/>
  
    <meta name="description" content=""/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />   
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/blogs/">
    <meta name="identifier-URL" content="https://www.wahstory.com/blogs/">
    <meta name="directory" content="Blogs">  
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/blogs/" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="Blog & News | WAHStory">
    <meta name="og:description" content="">
    <meta property="og:url" content="https://www.wahstory.com/blogs/" />
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
     .right-2 .topNewsHeight img{
         max-height:165px;
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
        height: 230px;
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
     
     
     
 </style> 
   
    
 <?php include('header.php');?>
 <!-- Start Hero -->
  
  
   <!-- End Hero -->

  <div class="cs-height_120 cs-height_lg_80"></div>
  
  <section>
            <div class="cs-height_35 cs-height_lg_30"></div>
      <div class="container blogs-wrapper">
        <div class="row">
            <div class="col-lg-6 mb-4">
                
                <div id="carouselExampleCaptions" class="carousel slide NewsTopLeftContainer" data-bs-ride="carousel" data-bs-interval="3000">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  </div>
                  <div class="carousel-inner topNewsHeight">
                      
        <?php 
        $imgUrl = "";
        $n = 1;
        foreach ($postObj->getCorporateNews('DESC', 4, 0) as $topnewsrow) { ?>
        
                    <div class="carousel-item <?php if($n == 1){ echo "active"; }?>">
                        <a target="_blank" href="<?=$topnewsrow['sourceURL']?>" class="image-container">
                      <?php 
            if($topnewsrow['image'] != ''){
                $imgUrl = "/images/news/".$topnewsrow['image']; 
            }else{
                $imgUrl = $topnewsrow['imageURL'];
            }
        ?>
                  <img src="<?php echo $imgUrl;?>" class="d-block w-100" alt="<?=$topnewsrow['title']?>" title="<?=$topnewsrow['title']?>"> 
                      </a>
                      
                      <div class="carousel-caption d-md-block ">
                          <a target="_blank" href="<?=$topnewsrow['sourceURL']?>" title="<?=$topnewsrow['title']?>">
                        <h5><?=$topnewsrow['title']?></h5>
                        <p ><?=$topnewsrow['caption']?></p>
                        </a>
                      </div>
                    </div>
        <?php $n++; } ?>
                    
                     
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                
            </div> 
            
    <?php 
    $imgUrl = '';
    foreach ($postObj->getCorporateNews('DESC', 2, 4) as $topnewsrow) { ?> 
    
            <div class="col-lg-3 mb-4 newscard right-2"><div class="card w-100 topNewsHeight" style="width: 18rem;">
                <a target="_blank" href="<?=$topnewsrow['sourceURL']?>">
                    <?php 
            if($topnewsrow['image'] != ''){
                $imgUrl = "/images/news/".$topnewsrow['image']; 
            }else{
                $imgUrl = $topnewsrow['imageURL'];
            }
        ?>
                  <img src="<?php echo $imgUrl;?>" class="card-img-top" alt="<?=$topnewsrow['title']?>" title="<?=$topnewsrow['title']?>"></a>
                  
                  <div class="card-body">
                      <h5 class="newstitle"><a target="_blank" href="<?=$topnewsrow['sourceURL']?>" title="<?=$topnewsrow['title']?>"><?=$topnewsrow['title']?></a></h5>
                      
                    <p class="card-text" align="justify1"><?=$topnewsrow['caption']?></p>
                    
                    <a href="<?=$topnewsrow['sourceURL']?>" target="_blank" class="text-small readmorebtn btns">Read More <i class="fa fa-arrow-right"></i></a>
                    
                  </div>
                </div>
            </div> 
        <?php } ?>
         
                
           
        </div>
        
        
        
      </div>
    </section>
    
      <div class="cs-height_50 cs-height_lg_40"></div>
 <!-- Start Blog Section -->
    <section class="cs-shape_wrap_4 cs-parallax">  
      <div class="container-fluid">
        <div class="cs-slider cs-style2 cs-gap-24">
         
         <div class="container">   
            <div class="cs-slider_heading cs-style1">
              
                <div class="cs-section_heading cs-style1">
                  <!--<h3 class="cs-section_subtitle wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s"> Stories on the Rise </h3>-->
                  <h2 class="cs-section_title">More News</h2>
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
          </div>
        
        
        <div class="cs-slider cs-gap-2">
          <div class="cs-height_10 cs-height_lg_10"></div>
              
          <div class="cs-slider_container" data-autoplay="0" data-autoplaySpeed="200" data-loop="1" data-speed="1000" data-center="0" data-variable-width="1" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
            <div class="cs-slider_wrapper featured-stories">
         <?php
         $imgUrl = '';
    		foreach ($postObj->getCorporateNews('DESC', 200, 6) as $newsrow) {
    		    
    	?>
    	<div class="cs-slide">
         <div class="cs-post cs-style1 ">
            <div class="morenewscard">
               <div class="card w-40 topNewsHeight">
        <?php 
            if($newsrow['image'] != ''){
                $imgUrl = "/images/news/".$newsrow['image']; 
            }else{
                $imgUrl = $newsrow['imageURL'];
            }
        ?>
                  <img src="<?php echo $imgUrl;?>" class="card-img-top" alt="<?=$newsrow['title']?>" title="<?=$newsrow['title']?>"> 
                  <div class="card-body"> 
                      <h5 class="morenewstitle"><a href="<?=$newsrow['sourceURL']?>" target="_blank"  title="<?=$newsrow['title']?>"><?=$newsrow['title']?> </a></h5>
                   <p><?php echo $newsrow['caption']?></p>
                   <a href="<?=$newsrow['sourceURL']?>" target="_blank" class="text-small readmorebtn btns">Read More <i class="fa fa-arrow-right"></i></a>
                  </div> 
                  
                </div>
            </div>
          </div>
        </div>
        
    <?php } ?>
              <!-- .cs-slide -->
           
              
             
              
              
            </div>
          </div>
          <!-- .cs-slider_container -->
          <div class="cs-pagination cs-style1 cs-hidden_desktop"></div>
               
        </div>
        <!-- .cs-slider -->
      </div> 
    </section>
    <!-- End Blog Section -->
    
    
  <div class="cs-height_50 cs-height_lg_80"></div>
  
 
  
  <!-- Start CTA -->
  <?php include('footer.top.php');?>
     
    
  </body>
</html>