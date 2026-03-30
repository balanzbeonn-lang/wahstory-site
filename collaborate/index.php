<?php 
session_start();
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

require_once("../inc/functions.php");
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

    <title>WAHStory | Collaborate With Us</title>
  
    <meta name="description" content="Our virtual webinar, featuring amazing speakers, exemplifies our dedication to advancing gender equality through innovation and technology. It's a testament to the power of collaboration and shared vision."/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />  
    
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/collaborate/">
    <meta name="identifier-URL" content="https://www.wahstory.com/collaborate/">
    <meta name="directory" content="Collaborate With Us"> 
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/collaborate/" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="Collaborate With Us | WahStory">
    <meta name="og:description" content="Our virtual webinar, featuring amazing speakers, exemplifies our dedication to advancing gender equality through innovation and technology. It's a testament to the power of collaboration and shared vision.">
    <meta property="og:url" content="https://www.wahstory.com/collaborate/" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/collaborate/digi4all.jpg" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:image:type" content="image/png" />
    
    <!-- CSS ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animation.css">
    <link rel="stylesheet" href="assets/css/plugins/feature.css"> 
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <link rel="stylesheet" href="assets/css/plugins/slick-theme.css"> 
    <link rel="stylesheet" href="assets/css/style.css">
    <!--site search box-->
    <script type="application/ld+json">
       {
         "@context": "https://schema.org",
         "@type": "WebSite",
         "url": "https://www.wahstory.com/",
         "potentialAction": {
           "@type": "SearchAction",
           "target": "https://www.wahstory.com/search/{search_term_string}",
           "query-input": "required name=search_term_string"
         }
       }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://www.wahstory.com",
      "logo": "https://www.wahstory.com/images/logos/logo-light.png"
    }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVRFRRWSM2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-LVRFRRWSM2');
    </script>
    
    <style>
        .has-droupdown > a::after {
  content: '\25BC'; /* Down arrow */
  margin-left: 5px;
  font-size: 0.8em;
}
    </style>
    
</head>

<body>
    <main class="page-wrapper">
        <!-- Start Header Area  -->
        <header class="rainbow-header header-default header-transparent header-sticky">
            <div class="container position-relative">
                <div class="row align-items-center row--0">
                    <div class="col-lg-3 col-md-6 col-4">
                        <div class="logo">
                            <a href="/">
                                <img class="logo-light" src="https://www.wahstory.com/images/logos/logo-white.png" alt="Corporate Logo">
                                <img class="logo-dark" src="https://www.wahstory.com/images/logos/logo-white.png" alt="Corporate Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-8 position-static">
                        <div class="header-right">

                            <nav class="mainmenu-nav d-none d-lg-block">
                                <ul class="mainmenu">
                                    <!--<li class=""><a href="/">Home</a></li>-->
                                    <li><a href="/aboutus">About Us</a></li>           <li>
                                            <a href="/shareyourstory/">Share Your Story</a>
                                          </li>                         

                                    <li class="has-droupdown has-menu-child-item">
                                        <a href="/stories">Stories</a>
                                        <ul class="submenu"> 
                                        
                    <?php foreach ($postObj->getCats() as $cat) : ?>
                                            
                    <?php if ($cat['id'] === '12' || $cat['id'] === '13' || $cat['id'] === '14') continue; ?>
                    
                    <li><a href="/stories/<?php echo $cat['slug']; ?>"><?php echo $cat['name']; ?></a></li>
                    <?php endforeach; ?>
                    <?php $storyofthemonth = $postObj->getStoryofMonth(); ?>
                    <li><a href="/story/<?php echo $storyofthemonth['slug']; ?>">Story of The Month</a></li>
                    
                                            
                                        </ul>
                                    </li>
                                    
                                    <li><a href="/wahcommunity/">WAH Community</a></li>
                                    <li>
                                        <a href="/wahspotlight/">WAH SPOTLIGHT</a>
                                      </li>
                                      
                                   <li class="has-droupdown has-menu-child-item">
                                        <a href="javascript:void(0);"> More </a>
                                        <ul class="submenu"> 
                                        <li><a href="/collaborate/">
                                                Collaborate With Us</a></li>
                                        <li><a href="/blogs">Blogs</a></li>     <li><a href="/corporatenews">News</a> </li>   
                                         <!--<li><a href="/shareyourstory/">-->
                                         <!--        Share You Story</a></li>    -->
                                    
                                            
                                            
                                            
                                        </ul>
                                    </li>
                                    
                                   
                                     
                                </ul>
                            </nav>
                            
                            <!-- Start Header Btn  -->
                            <div class="header-btn">
                <?php if(isset($_SESSION['logged_in'])){ ?>     
                <a class="btn-small round" href="/users/"><i class="feather-user"></i> My Account</a>
                <?php }elseif(isset($_SESSION['userid'])){ ?> 
                <a class="btn-small round" href="/users/"><i class="feather-user"></i> My Account</a>
                <?php }else{ ?>
                        <a class="btn-small round" href="/login"><i class="feather-user"></i> Login</a>
                <?php } ?>
                            </div>
                            <!-- End Header Btn  -->

                            <!-- Start Mobile-Menu-Bar -->
                            <div class="mobile-menu-bar ml--5 d-block d-lg-none">
                                <div class="hamberger">
                                    <button class="hamberger-button">
                                        <i class="feather-menu"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Start Mobile-Menu-Bar -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header Area  -->
        <div class="popup-mobile-menu">
            <div class="inner">
                <div class="header-top">
                    <div class="logo">
                        <a href="index.html">
                            <img class="logo-light" src="https://www.wahstory.com/images/logos/logo-white.png" alt="Corporate Logo">
                            <img class="logo-dark" src="https://www.wahstory.com/images/logos/logo-white.png" alt="Corporate Logo">
                        </a>
                    </div>
                    <div class="close-menu">
                        <button class="close-button">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                </div>
                <ul class="mainmenu">
                    <li class=""><a href="/">Home</a></li>
                                    <li><a href="/aboutus">About Us</a></li>                                    

                                    <li class="has-droupdown has-menu-child-item"><a href="#">Stories</a>
                                        <ul class="submenu">
                                            <li><a href="#">Her Story</a></li> 
                                            <li><a href="#">Game Changer</a></li> 
                                            <li><a href="#">Passion Story</a></li> 
                                            <li><a href="#">Pride Story</a></li> 
                                            <li><a href="#">Influencers</a></li> 
                                            <li><a href="#">Living Well</a></li> 
                                            <li><a href="#">Story Of The Month</a></li> 
                                        </ul>
                                    </li>
                                    
                                    <li><a href="/wahcommunity/">WAH Community</a></li>
                                    <li>
                                        <a href="/wahspotlight/">WAH SPOTLIGHT</a>
                                      </li>
                                    
                                    <li class="has-droupdown has-menu-child-item">
                                        <a href="javascript:void(0);"> More </a>
                                        <ul class="submenu"> 
                                             <li><a href="/shareyourstory/">
                                                 Share You Story</a></li>
                                    
                                            <li><a href="/collaborate/">
                                                Collaborate With Us</a></li>
                                            <li><a href="/blogs">Blogs</a></li>
                                            
                                        </ul>
                                    </li>
                </ul>

            </div>
        </div> 




        <!-- Start Slider Area  -->
        <div class="slider-area slider-style-4 variation-2 slider-activation slider-dot rainbow-slick-dot rainbow-slick-arrow">
            <!-- Start Single Slider  -->
            <div class="height-450 bg-overlay bg_image bg_main-banner d-flex align-items-center" data-black-overlay="5">
                <div class="container">
                    <div class="row row--30 align-items-center">
                        <div class="col-12">
                            <div class="inner text-center">
                                <h1 class="title">COLLABORATE WITH US</h1> 
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slider  -->
             
        </div>
        <!-- End Slider Area  -->

        <!-- Start progress style-large  -->
        <div class="rainbow-progressbar-area rainbow-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="400" data-sal-delay="150">
                             
                            <h2 class="title w-600 mb--20">Creating a world where every voice is heard.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row row--30 mt--20">

                            <!-- Start Single Progress Bar  -->
                            <div class="col-lg-3 col-md-6 col-sm-6 mt--30 col-12">
                                <div class="radial-progress-single">
                                    <div class="radial-progress" data-percent="100" data-bar-color="#000" data-track-color="#0f0f11" data-fill-color="#000">
                                        <div class="circle-text">
                                            <span class="count">50+</span>
                                            <p>Countries</p>
                                        </div>
                                    </div>
                                    <div class="circle-info">
                                        <h4 class="title">Global Reach</h4>
                                        <!--<h6 class="subtitle">Presentation your skill</h6>-->
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Progress Bar  -->

                            <!-- Start Single Progress Bar  -->
                            <div class="col-lg-3 col-md-6 col-sm-6 mt--30 col-12">
                                <div class="radial-progress-single">
                                    <div class="radial-progress" data-percent="100" data-bar-color="#000" data-track-color="#0f0f11">
                                        <div class="circle-text">
                                            <span class="count">500+</span>
                                        </div>
                                    </div>
                                    <div class="circle-info">
                                        <h4 class="title">Stories Covered</h4> 
                                        <!--<h4 class="title">Powerful Stats</h4> -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Progress Bar  -->

                            <!-- Start Single Progress Bar  -->
                            <div class="col-lg-3 col-md-6 col-sm-6 mt--30 col-12">
                                <div class="radial-progress-single">
                                    <div class="radial-progress" data-percent="100" data-bar-color="#000" data-track-color="#0f0f11">
                                        <div class="circle-text">
                                            <span class="count">259K+</span>
                                        </div>
                                    </div>
                                    <div class="circle-info">
                                        <h4 class="title">Heartprints</h4> 
                                        <!--<h4 class="title">Inspiring Change</h4> -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Progress Bar  -->

                            <!-- Start Single Progress Bar  -->
                            <div class="col-lg-3 col-md-6 col-sm-6 mt--30 col-12">
                                <div class="radial-progress-single">
                                    <div class="radial-progress" data-percent="100" data-bar-color="#000" data-track-color="#0f0f11" data-fill-color="#000">
                                        <div class="circle-text">
                                            <span class="count">200K+</span>
                                        </div>
                                    </div>
                                    <div class="circle-info">
                                        <h4 class="title">Collaborative Impact</h4> 
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Progress Bar  -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End progress style-large  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->

        <!-- Start Feature Services Area  -->
        <div class="rbt-feature-area pt--60  pb--60">
            <div class="container">
                <!-- Start Feature Header Top  -->
                <div class="row mb--40 ">
                    <div class="col-lg-12">
                        <div class="section-title text-center sal-animate">
                            <h2 class="title w-600 mb--20">Collaboration Methods</h2> 
                        </div>
                    </div>
                </div>
                <!-- End Feature Header Top  -->
                <!-- Start Feature Service  -->
                <div class="row g-5  service-wrapper">
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-activity"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Campaign Planning & Execution</a></h4>
                                <p align="justify" class="mb-2">Collaborate with us to strategize and execute compelling digital campaigns that captivate your target audience. By blending your expertise with our storytelling prowess, we can create campaigns that resonate, engage, and deliver impactful results.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest radius text-center rbt-border">
                            <div class="icon">
                                <i class="feather-loader"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Startup Marketing Kit</a></h4> 
                                <p align="justify" class="mb-2">Join forces to design and deliver comprehensive marketing kits tailored for startups. Our storytelling approach combined with your industry insights will empower startups with the tools they need to stand out in a competitive landscape.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-cloud-lightning"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">UI & UX Designing</a></h4>
                                
                                <p align="justify" class="mb-2">Let's merge your UI/UX design expertise with our storytelling finesse to craft captivating user experiences. Together, we can transform digital interactions into memorable narratives that keep users engaged and inspired.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-star"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Online Reputation Management</a></h4>
                                <p align="justify" class="mb-2">Collaborate to safeguard and enhance online reputations. Our narrative-driven approach combined with your strategic management skills will help clients build and maintain a positive brand image across digital platforms.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-message-circle"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Communication Workshops</a></h4>
                                <p align="justify" class="mb-2">Partner to conduct impactful communication workshops that teach the art of storytelling and effective messaging. By blending our training techniques with your industry insights, participants will master the art of compelling communication.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-globe"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Bespoke Thought Leadership</a></h4>
                                <p align="justify" class="mb-2">Co-create bespoke thought leadership content that positions brands as industry leaders. By blending your domain knowledge with our narrative expertise, we can craft compelling content that elevates brand credibility.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-refresh-cw"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Employer Branding Services</a></h4>
                                <p align="justify" class="mb-2">Collaborate to build a unique employer brand story that attracts and retains top talent. Our storytelling proficiency, combined with your HR insights, will create a brand narrative that resonates with potential employees.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style bg-color-blackest text-center rbt-border">
                            <div class="icon">
                                <i class="feather-share-2"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Social Media Marketing</a></h4>
                                <p align="justify" class="mb-2">Unite storytelling and social media expertise to craft captivating content that sparks engagement across platforms. Our narrative-driven approach, coupled with your social media strategies, will elevate brand visibility and engagement.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                    <!-- Start Single Service  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate">
                        <div class="service service__style--1 icon-circle-style icon-circle-style bg-color-blackest radius text-center rbt-border">
                            <div class="icon">
                                <i class="feather-trending-up"></i>
                            </div>
                            <span class="sk__iconbox-icon-dash"></span>
                            
                            <div class="content pt-2">
                                <h4 class="title w-600"><a href="#">Market Communication</a></h4>
                                <p align="justify" class="mb-2">Join hands to develop persuasive market communication strategies that convey brand stories effectively. By leveraging your market insights and our storytelling skills, we can create campaigns that resonate with target audiences.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Service  -->
                </div>
                <!-- End Feature Service  -->
            </div>
        </div>
        <!-- End Feature Services Area  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator">
            </div>
        </div>
        <!-- End Seperator Area  -->

        
        <div class="rainbow-brand-area rainbow-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            
                            <h2 class="title w-600 mt--20">Our Collaboraters</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="advance-brand brand-carousel-init rainbow-slick-arrow" style="background: #fff; padding: 15px;">
                            
                            <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/assets/images/logos/google.png" alt="Google" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/assets/images/logos/hsbc.png" alt="HSBC" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/assets/images/logos/godaddy.png" alt="Godaddy" data-uk-svg=""></div>
                                </div>
                                
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/assets/images/logos/genpact.png" alt="Genpact" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/sutherland.png" alt="sutherland" data-uk-svg=""></div>
                                </div> 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/tata.png" alt="tata" data-uk-svg=""></div>
                                </div> 
                                
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/linkedin.png" alt="tata" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/news-nation.png" alt="tata" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/wipro.png" alt="tata" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/axis-bank.png" alt="tata" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/accenture.png" alt="tata" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/cognizant.png" alt="tata" data-uk-svg=""></div>
                                </div> 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/ey.png" alt="tata" data-uk-svg=""></div>
                                </div> 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/jio.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/hp.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/rs.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/hccb.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/reckitt.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/airbus.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/unilever.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/hackerearth.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/dcb-bank.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/concerntrix.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/symantec.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/mompresso.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/lmg.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/unqork.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/svpindia.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                                 
                                <div class="item logo">
                                    <div class="inner"><img src="/aboutusassets/images/storiesbrands/vision7.png" alt="tata" data-uk-svg=""></div>
                                </div>  
                            
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Brand Style-1  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->

        <!--Start Section Two Area  -->
        <div class="slider-area rainbow-section-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="thumbnail">
                            <img src="assets/imgs/Rajpal-image.png" alt="Rajpal Yadav">
                        </div>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="inner Collaborate-inner text-left">
                            <h3 class="title">Rajpal Yadav X WAHStory</h3>
                            <p class="description">When comedy meets talent, the result is magic. As Rajpal Yadav's laughter-filled journey continues, our collaboration stands as a shining example of how stories and talent can come together to create something truly exceptional.</p>
                            <div class="button-group">
                                <a class="btn-collaborate-play popup-video" href="/story/actor-comedian-writer-film-director-producer">
                                    <i class="feather-arrow-right"></i><span>Read Story</span>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End Section Two Area  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->
        <!--Start Section Three Area  -->
        <div class="slider-area rainbow-section-gap">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner Collaborate-inner text-left">
                            <h3 class="title">Zahara Fernandes X WAHStory</h3>
                            <p class="description">The collaboration between Zahara Fernandes and WahStory is a powerful initiative aimed at breaking down barriers and emphasizing the significance of promoting gender diversity. Through this collab we focused on creating valuable opportunities that empower women to not only succeed but to truly thrive. </p>
                            <div class="button-group">
                                <a class="btn-collaborate-play popup-video" href="/story/she-her-managing-director-global-delivery-leader-india-pride-sponsor-at-accenture">
                                    <i class="feather-arrow-right"></i><span>Read Story</span>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="thumbnail">
                            <img src="assets/imgs/collab-Zahara-Fernandes.webp" alt="Zahara Fernandes">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End Section Three Area  -->
        
         <!--Start Section Four Area  -->
        <div class="slider-area rainbow-section-gap">
            <div class="container">
                <div class="row align-items-center">
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="thumbnail">
                            <img src="assets/imgs/wahverse-ep2.webp" alt="Jeeveshu Ahluwalia">
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner Collaborate-inner text-left">
                            <h3 class="title">Jeeveshu Ahluwalia X WAHStory</h3>
                            <p class="description">Our podcast collaboration with Jeeveshu carries a profound purpose – to inspire each individual who listens. Through his experiences, we aimed to sparked a fire of determination, encouraging everyone to follow their dreams with unwavering persistence. The collaborative effort is a reminder that life's challenges can be steppingstones to success, if we face them head-on and refuse to give up. </p>
                            <div class="button-group">
                                <a class="btn-collaborate-play popup-video" href="https://open.spotify.com/episode/3kNUzYRpUV2NJw8SUWBaB6?si=lHFSGs_YTHOQYL0EYyd1qQ" target="_blank">
                                    <i class="feather-arrow-right"></i><span>Listen Now</span>
                                </a>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--End Section Four Area  -->

         <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->
        <!--Start Section Three Area  -->
        <div class="slider-area rainbow-section-gap">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner Collaborate-inner text-left">
                            <h3 class="title">DIGI4ALL : Innovation and Technology for Gender Equality</h3>
                            <p class="description">Our virtual webinar, featuring amazing speakers, exemplifies our dedication to advancing gender equality through innovation and technology. It's a testament to the power of collaboration and shared vision. </p>
                           <!-- <div class="button-group">
                                <a class="btn-collaborate-play popup-video" href="/story/she-her-managing-director-global-delivery-leader-india-pride-sponsor-at-accenture">
                                    <i class="feather-arrow-right"></i><span>Read Story</span>
                                </a>
                            </div>-->

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="thumbnail">
                            <img src="assets/imgs/digi4all.jpg" height="425px" width="425px" alt="DIGI4ALL">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End Section Three Area  -->
        
        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->

        <!--Start Section Four Area  -->
        <!--<div class="slider-area rainbow-section-gap">-->
        <!--    <div class="container">-->
        <!--        <div class="row align-items-center">-->
        <!--            <div class="col-lg-6 col-md-6 col-sm-12">-->
        <!--                <div class="thumbnail">-->
        <!--                    <img src="https://www.humansofbombay.in/wp-content/uploads/2022/06/pics-1-03-1024x764.png" alt="image-slider">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-6 col-md-6 col-sm-12">-->
        <!--                <div class="inner Collaborate-inner text-left">-->
        <!--                    <h3 class="title">Successfully Renovating An Occupied Lab</h3>-->
        <!--                    <p class="description">While there are 18 areas of lab business that are most targeted by the OIG, CMS, and DOJ for investigation, most lab investigations will focus on one of the seven mentioned.</p>-->
        <!--                    <div class="button-group">-->
        <!--                        <a class="btn-collaborate-play popup-video" href="https://www.youtube.com/watch?v=tj9-MGHCs38">-->
        <!--                            <i class="feather-play"></i><span>See how it works</span>-->
        <!--                        </a>-->
        <!--                    </div>-->

        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--End Section Five Area  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->
        <!--Start Section Three Area  -->
        <!--<div class="slider-area rainbow-section-gap">-->
        <!--    <div class="container">-->
        <!--        <div class="row align-items-center">-->

        <!--            <div class="col-lg-6 col-md-6 col-sm-12">-->
        <!--                <div class="inner Collaborate-inner text-left">-->
        <!--                    <h3 class="title">New Laboratory Startups</h3>-->
        <!--                    <p class="description">Through clinical laboratory tests, healthcare providers can diagnose specific diseases or conditions, monitor patient health, and make decisions for patient care. </p>-->
        <!--                    <div class="button-group">-->
        <!--                        <a class="btn-collaborate-play popup-video" href="https://www.youtube.com/watch?v=tj9-MGHCs38">-->
        <!--                            <i class="feather-play"></i><span>See how it works</span>-->
        <!--                        </a>-->
        <!--                    </div>-->

        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="col-lg-6 col-md-6 col-sm-12">-->
        <!--                <div class="thumbnail">-->
        <!--                    <img src="https://www.humansofbombay.in/wp-content/uploads/2022/06/pics-1-04-1024x764.png" alt="image-slider">-->
        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--End Section Three Area  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- End Seperator Area  -->

        <!-- Start Time Line Area  -->
        <div class="rainbow-timeline-area rainbow-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                           
                            <h2 class="title w-600 mb--20">Collaboration Process</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 mt--50">
                        <div class="timeline-style-two bg-color-blackest">
                            <div class="row row--0">
                                <div class="col-lg-3 col-md-3 rainbow-timeline-single">
                                    <div class="rainbow-timeline">
                                        <h6 class="title">Project Initiation</h6>
                                        <div class="progress-line">
                                            <div class="line-inner"></div>
                                        </div>
                                        <div class="progress-dot">
                                            <div class="dot-level">
                                                <div class="dot-inner"></div>
                                            </div>
                                        </div>
                                        <p class="description">We work closely with you to lay the foundation for a successful collaboration.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 rainbow-timeline-single">
                                    <div class="rainbow-timeline">
                                        <h6 class="title">Strategy and Planning</h6>
                                        <div class="progress-line">
                                            <div class="line-inner"></div>
                                        </div>
                                        <div class="progress-dot">
                                            <div class="dot-level">
                                                <div class="dot-inner"></div>
                                            </div>
                                        </div>
                                        <p class="description">Together, we outline tasks, timelines, and milestones.</p>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 rainbow-timeline-single">
                                    <div class="rainbow-timeline">

                                        <h6 class="title">Design and Development</h6>
                                        <div class="progress-line">
                                            <div class="line-inner"></div>
                                        </div>
                                        <div class="progress-dot">
                                            <div class="dot-level">
                                                <div class="dot-inner"></div>
                                            </div>
                                        </div>
                                        <p class="description">Our teams collaborate to bring your project to life with user-centric design and cutting-edge development practices.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 rainbow-timeline-single">
                                    <div class="rainbow-timeline">
                                        <h6 class="title">Deployment and Support</h6>
                                        <div class="progress-line">
                                            <div class="line-inner"></div>
                                        </div>
                                        <div class="progress-dot">
                                            <div class="dot-level">
                                                <div class="dot-inner"></div>
                                            </div>
                                        </div>
                                        <p class="description">With your approval, we deploy the project and provide post-launch support.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Time Line Area  -->

        <!-- Start Seperator Area  -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
                
                
                
            </div>
        </div>
        <!-- End Seperator Area  -->

        
        <!-- Start Footer Area  -->
        <footer class="rainbow-footer footer-style-default variation-two">
            
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="rainbow-footer-widget">
                                <img src="/images/logos/logo-white.png" width="156px">
                                <div class="inner">
                                    <h6 class="subtitle">"We believe there is power in people, power in community!"</h6>
                                    <ul class="social-icon social-default justify-content-start">
                                        <li><a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank">
                                                <i class="feather-facebook"></i>
                                            </a>
                                        </li> 
                                        <li><a href="https://www.instagram.com/wahstory/" target="_blank">
                                                <i class="feather-instagram"></i>
                                            </a>
                                        </li>
                                        <li><a href="https://www.linkedin.com/company/wahstory/" target="_blank">
                                                <i class="feather-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="rainbow-footer-widget">
                                <h4 class="title">Quick Links</h4>
                                <div class="inner">
                                    <ul class="footer-link link-hover"> 
                                      <li>
                                        <a href="/wahcommunity/" target="_blank">WAH Community</a>
                                      </li>
                                      <li>
                                        <a href="/shareyourstory/">Share Your Story</a>
                                      </li>
                                      <li>
                                        <a href="/aboutus">About Us</a>
                                      </li>
                                      <li>
                                        <a href="/contact">Contact Us</a>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="rainbow-footer-widget">
                                <div class="widget-menu-top">
                                    <h4 class="title">Our Initiatives</h4>
                                    <div class="inner">
                                        <ul class="footer-link link-hover"> 
                                          <li><a href="https://www.elementshrs.com/" target="_blank">Elements HR Services</a></li>
                                          <li><a href="https://www.investinu.co.in/" target="_blank">Invest In U</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="rainbow-footer-widget">
                                <h4 class="title">Subscribe</h4>
                                <div class="inner">
                                    <div>Be the first to know about new stories, campaigns and events!
                                    </div>
                                    <p style="display: none;">Subscribed Successfully!</p>
                                     <form class="contact-form-2" method="post" id="subscribe-form">
                                         
                                    <div class="form-group">
                                        <input type="email" name="SubscribeEmail" id="email" placeholder="Enter Email" required>
                                    </div>
                                    
                                    <button name="submit" type="submit" id="SubscribeNowBtn" class="btn-default">
                                        <span>Submit Now</span>
                                    </button>
                                    
                                     </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area  -->
        <!-- Start Copy Right Area  -->
        <div class="copyright-area copyright-style-one">
            <div class="container " style="border-top: 1px solid #464646;">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-4 col-sm-12 col-12">
                        <div class="copyright-left">
                            <p class="copyright-text"><?=date('Y')?> © <a href="/" style="color: #fff;">www.wahstory.com</a>. All rights reserved.</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-8 col-sm-12 col-12">
                        <div class="copyright-right text-lg-end">
                            <ul class="ft-menu link-hover text-right"> 
                              <li>
                                <a href="/privacy.policy">Terms of Use</a>
                              </li>
                              <li>
                                <a href="/privacy.policy">Privacy Policy</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copy Right Area  -->
    </main>

    <!-- All Scripts  -->
    <!-- Start Top To Bottom Area  -->
    <div class="rainbow-back-top">
        <i class="feather-arrow-up"></i>
    </div>
    <!-- End Top To Bottom Area  -->
    <!-- JS
============================================ -->
    <script src="assets/js/vendor/jquery.min.js"></script>  
    <script src="assets/js/vendor/bootstrap.min.js"></script> 
    <script src="assets/js/vendor/waypoint.min.js"></script>
    <script src="assets/js/vendor/wow.min.js"></script>
    <script src="assets/js/vendor/counterup.min.js"></script> 
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/lightbox.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/easypie.js"></script>
    <script src="assets/js/vendor/text-type.js"></script>  
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="/assets/js/subscribe.js"></script>
</body>

</html>