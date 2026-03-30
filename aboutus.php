<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("inc/functions.php");

$postObj = new Story();

$queryObj = new submitqueries();  
$script ='';
if(isset($_POST['LETSTALK'])){
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        
    $_SESSION["response"] = $queryObj->letstalk();
    
    if (isset($_SESSION["response"])) {
        
        switch($_SESSION["response"]){
            
            case "SUCCESS":{
                $status = "Success";
                $script = 'Thank you, We will get back to you soon!';
                echo '<script>window.location.href = "/aboutus?sucmsg='.$script.'";</script>';
                break;
            }
            case "ERROR":{
                $status = "Error!";
                $script = 'Please try again! <br> Something went wrong';
               echo '<script>window.location.href = "/aboutus?errmsg='.$script.'";</script>';
                break;
                        }    
        
            
        } unset($_SESSION["response"]);
    }  
    
    }else{
        $script = "Please select Google reCAPTCHA, and try again...";
       echo '<script>window.location.href = "/aboutus?errmsg='.$script.'";</script>';
    }
    
}


?>

<!DOCTYPE html>
<html class="no-js" lang="en">
 
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="WAHStory">
  <!-- Favicon Icon -->
      <link rel="shortcut icon" href="/images/wah_fav.ico">
    <meta name="theme-color" content="#181818" />
        
        <meta name="description" content="WAHStory.com is a digital storytelling and knowledge sharing platform featuring inspiring stories of today's most successful leaders."/>
    
        <meta name="language" content="en">
        <meta name="language" content="hi">
        <meta name="theme-color" content="#181818" />
        <meta name="abstract" content="Engage with talented writers and embark on a journey to share your own creative stories on our storytelling platform. Explore a diverse collection of narratives that captivate and inspire.">
        <meta name="topic" content="storytelling, Founders, Diversity and Inclusion, HR, Powerful Lessons, Author, Life Mantra, Mentor, Setbacks to Success"> 
        <meta name="Classification" content="Sucess Stories">
        <meta name="author" content="WAHStory">
        <meta name="copyright" content="WAHStory">
        <meta name="url" content="https://www.WAHStory.com/aboutus">
        <meta name="identifier-URL" content="https://www.WAHStory.com/aboutus">
        <meta name="directory" content="About Us">
        <meta name="category" content="Her Story, Game Changer, Pride Story, Living Well, Passion Story">
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="rating" content="General">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        
        <link rel="canonical" href="https://www.WAHStory.com/aboutus" />
        <!-- Site Title -->
        <title>About Us | WAHStory</title>
        
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="website" />
        <meta name="og:title" content="WAHStory | About Us">
        <meta name="og:description" content="About on WAHStory.com">
        <meta property="og:url" content="https://www.WAHStory.com/aboutus" />
        <meta property="og:site_name" content="WAHStory.com" />
        <meta property="og:image" content="https://www.wahstory.com/images/og-wahstory.webp" />
        <meta property="og:image:width" content="355" />
        <meta property="og:image:height" content="133" />
        <meta property="og:image:type" content="image/png" />
        
        
        <link rel="stylesheet" href="aboutusassets/assets/css/normalize.min.css" />
        <link rel="stylesheet" href="aboutusassets/assets/css/pr.animation.css" />
        <link rel="stylesheet" href="aboutusassets/assets/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="aboutusassets/assets/css/uikit.min.css" />
        <link rel="stylesheet" href="aboutusassets/assets/css/fonts.css" />
        <link rel="stylesheet" href="aboutusassets/assets/css/pixeicons.css" />
        <link href="aboutV2Style.css" rel="stylesheet">
        <!--- Font Awesome Starts-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        
        <!--- Font Awesome Ends-->
        
        <style>
           @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;family=Poppins:wght@300;400;600;700&amp;display=swap");
        .subscribe-input{
            display: block;
            height: 50px;
            width: 100%;
            border-radius: 10px;
            background-color: #000;
            border: none;
            padding: 5px 90px 5px 15px;
            outline: none;
            color: #fff;  
            border: 1px solid #000;
            margin-bottom: 10px;
        }
        .uk-input.subscribe-input:focus{
            border-color:#E9204F;
            background: #000;
        }
        .subscribe-button{
            height: auto;
            padding: 15px 26px;
            line-height: 1.5em;
            font-weight: 600;
            border-radius: 15px;
            background-color: #E9204F;
            border: 1px solid #E9204F;
            color: #fff;
            cursor: pointer;
            transition: all .3s;
        }
        .subscribe-button:hover{
            background: #000;
        }
        
        .pr__header .inner .navbar-tigger > span{
            background-color: #fff;
        }
        li.sub-menu ul li:hover a, li.sub-menu ul li a:hover{
            color: #e9204f !important;
        }
        
        .message-box {
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0 100px 0;
    max-width: 500px;
    text-align: center;
    font-family: Arial, sans-serif;
    color: #fff;
}

/* Success Message Box */
.message-box.success {
    background-color: #1B1B1B;
    border: 1px solid #1d7a1d;
     box-shadow: 0 4px 20px rgba(0, 255, 0, 0.6);
}

/* Error Message Box */
.message-box.error {
    background-color: #1B1B1B;
    border: 1px solid #e9204f;
    box-shadow: 0 4px 20px rgba(255, 0, 0, 0.9);
}

/* Icon Styling */
.message-box img {
    display: block;
    margin: 0 auto 10px;
    border-radius: 50%;
    padding: 10px;
}

/* Success Icon */
.message-box.success img {
    background-color: rgba(0, 255, 0, 0.2); /* Green shadow */
}

/* Error Icon */
.message-box.error img {
    background-color: rgba(255, 0, 0, 0.2); /* Red shadow */
}

/* Message Text Styling */
.message-box p {
    font-size: 18px;
    margin: 0;
}
        
        
        /* Footer Sticky Baar */
        
        .static-subscribe{color:#181818;padding:10px 20px;background:#00000094;width:100%;position:fixed;bottom:0;z-index:9999999}
.static-subscribe .static-subscribe-content form{display:flex}.static-subscribe .static-subscribe-content form input{width:100%;display:inherit;position:relative;border-color:#e9204f}.static-subscribe .static-subscribe-content form button{position:absolute;top:-6px;right:-2px;z-index:1;padding:12px 15px;border:1px solid #99969600;height:46px;border-radius:0 12px 12px 0}
        
        
        .spotlightAwarttitle {
    margin: 0;
    font-family: Oswald, sans-serif;
    font-size: 3.2rem; 
    line-height: 3rem;
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    
    display: flex;
    /*align-items: center;*/
}

.spotlightAwarttitle i b:nth-child(1),
.spotlightAwarttitle span b:nth-child(1) {
    color: #ec398b;
    font-weight: 700; 
}

.spotlightAwarttitle i b:nth-child(2),
.spotlightAwarttitle span b:nth-child(2) {
    color: #efa506;
    font-weight: 700; 
}

.spotlightAwarttitle i b:nth-child(3),
.spotlightAwarttitle span b:nth-child(3) {
    color: #00acee;
    font-weight: 700; 
}
.spotbtns{
        font-size: 20px; 
        font-family: 'Poppins',sans-serif; 
        font-weight: 500; 
        padding: 8px 15px !important;
    border-radius: 5px !important;
    }

@media screen and (max-width:991px){
    .spotlightAwarttitle { 
        font-size: 1.5rem;  
    }
    .spotbtns{
        font-size: 15px;  
        padding: 5px 10px !important;
    }
}

@media screen and (max-width:768px){
    .spotlightAwarttitle { 
        font-size: 1.5rem;  
        justify-content: center;
    }
    .spotbtns{
        margin-top: 10px;
        font-size: 12px;  
        padding: 5px 10px !important;
    }
    .static-subscribe-content{ 
        text-align: center;  
    }
}

        /* Footer Sticky Baar Ends */
        
        
    
        </style>
        
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
        
        
        
        
    </head>
    <body class="home front-page">

        <div class="pr__mobile__nav" id="navbar-mobile" data-uk-offcanvas="overlay: true; flip: true; mode: none">
            <div class="uk-offcanvas-bar">

                <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 2;"></button>

                <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                    <ul>
                    <!--<li><a href="/">Home</a></li>-->
                    <li><a href="/aboutus">About Us</a></li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">Stories</a>
                        <ul>
        					<li><a href="/stories/her-story">Her Story</a></li>
        					<li><a href="/stories/game-changer">Game Changer</a></li>
        					<li><a href="/stories/pride-story">Pride Story</a></li>
        					<li><a href="/stories/influencers">Influencers</a></li>
        					<li><a href="/stories/living-well">Living Well </a></li>
        					<li><a href="/stories/passion-story">Passion Story</a></li>
        					<li><a href="/story/top-100-influential-coaching-leader-global-leadership-coach-organisational-psychologist">Story of The Month</a></li>
    				    </ul>
                    </li>
                    
                     <li>
                    <a href="/shareyourstory/">Share Your Story</a>
                  </li>
                    
                    <li><a href="/wahcommunity/">WAH Community</a></li>
                   
                    
                    <li>
                    <a href="/wahspotlight/" target="_blank" >WAH SPOTLIGHT</a>
                  </li> 
                      <li class="sub-menu">
                        <a href="javascript:void(0);">More</a>
                        <ul>
                            <li><a href="/collaborate/">Collaborate With Us</a> </li>
                            <li><a href="/blogs">Blogs</a> </li>
                            <li><a href="/corporatenews">News</a> </li>
                            <li><a href="/shareyourstory/">Share Your Story</a></li>
                        </ul>
                            
                      </li>
                      
                      
                      <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-user"></i> DASHBOARD</a>
                        <ul>
                            <?php if(isset($_SESSION['logged_in'])){ ?>     
                            <li><a href="/single.dashboard.php" class="dropdown-item">My Account</a></li>
                            <li><a href="/logout.php?LogoutStoryTeller" class="dropdown-item">Log Out</a></li>
                            <?php }elseif(isset($_SESSION['userid'])){ ?>  
                            <li><a href="/dashboard.php" class="dropdown-item">My Account</a></li>
                            <li><a href="/logout.php?LogoutUser" class="dropdown-item">Log Out</a></li>
                            <?php }else{ ?>
                            <li><a class="dropdown-item" href="/login">My Account</a></li>
                            <li><a class="dropdown-item" href="/login">Log In</a></li>
                            <?php } ?>
                        </ul>
                            
                      </li>
                    
                    
                </ul>
                </nav>

            </div><!-- Off Canvas Bar End -->
        </div><!-- Mobile Nav End -->
        
        <!-- Off Canvas Bar End -->
        <!-- Mobile Nav End -->

        <div class="pr__wrapper" id="site-wrapper">

            <div class="pr__hero__wrap111" style="background: url('/aboutusassets/images/about-banner.webp'); background-size: cover; background-repeat: no-repeat; background-position: center;" id="site-hero000">

                <header class="pr__header">
                    <div class="uk-container">
                        <div class="inner">
                            <div class="logo">
                                <a href="/">
                                    <img src="https://www.WAHStory.com/images/logos/logo-white.png" alt="WAHStory">
                                </a>
                            </div>
                            <div class="navbar pr-font-second">
                                <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                                    <ul>
                                        <!--<li><a href="/">Home</a></li>-->
                                        <li><a href="/aboutus">About Us</a></li>
                                        <li class="sub-menu"><a href="javascript:void(0);">Stories</a>
                                        <ul>
																													<li><a href="/stories/her-story">Her Story</a></li>
																													<li><a href="/stories/game-changer">Game Changer</a></li>
																																							<li><a href="/stories/pride-story">Pride Story</a></li>
																																							<li><a href="/stories/influencers">Influencers</a></li>
																																							<li><a href="/stories/living-well">Living Well </a></li>
									
									<li><a href="/stories/passion-story">Passion Story</a>
									</li>
																		<li><a href="/story/top-100-influential-coaching-leader-global-leadership-coach-organisational-psychologist">Story of The Month</a></li>
								</ul>
								
								<li>
                                    <a href="/shareyourstory/">Share Your Story</a>
                                  </li>
                                        </li>
                                        <li><a href="/wahcommunity/">WAH Community</a></li>
                                        
                                        
                                       
                                         <li>
                                        <a href="/wahspotlight/">WAH SPOTLIGHT</a>
                                      </li> 
                                      <li class="sub-menu">
                                        <a href="javascript:void(0);">More</a>
                                        <ul>
                                            <li><a href="/collaborate/">Collaborate With Us</a> </li>
                                            <li><a href="/blogs">Blogs</a> </li>
                                            <li><a href="/corporatenews">News</a> </li>
                                            <!--<li><a href="/shareyourstory/">Share Your Story</a></li>-->
                                        </ul>
                                            
                                      </li>
                                      
                                      
                                      <li class="sub-menu">
                                        <a href="javascript:void(0);"><i class="fa fa-user"></i> DASHBOARD</a>
                                        <ul>
             <?php if(isset($_SESSION['logged_in'])){ ?>     
                <li><a href="/single.dashboard.php" class="dropdown-item">My Account</a></li>
                <li><a href="/logout.php?LogoutStoryTeller" class="dropdown-item">Log Out</a></li>
            <?php }elseif(isset($_SESSION['userid'])){ ?>  
                <li><a href="/dashboard.php" class="dropdown-item">My Account</a></li>
                <li><a href="/logout.php?LogoutUser" class="dropdown-item">Log Out</a></li>
            <?php }else{ ?>
            <li><a class="dropdown-item" href="/login">My Account</a></li>
            <li><a class="dropdown-item" href="/login">Log In</a></li>
            <?php } ?>
                                        </ul>
                                            
                                      </li>
                                      
                                        
                                    </ul>
                                </nav>
                                
                    <!--<form id="srform" method="get" action="/search_redirect" style="display: inline;" class="d-none d-sm-inline  header-search-2">
                        <input autofocus type="search" name="query" placeholder="Search by Name, Story, Keywords" value="" required>
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>-->
                                 
                            </div>
                            <div class="navbar-tigger" data-uk-toggle="target: #navbar-mobile" style="color: #fff;">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </header><!-- Site Header End -->

                <section class="pr__hero uk-section" id="pr__hero" style="">
                    <div class="uk-container">
                        <div class="section-inner">
                            <div class="hero-content uk-grid" data-uk-grid="">
                                <div class="uk-width-2-3@s">
                                    
                         <?php 
                                if (isset($_GET['sucmsg']) && $_GET['sucmsg'] != '') {
                                ?>
                                <div id="message-box" class="message-box success" style="display: none;">
                                    <img src="https://img.icons8.com/?size=100&id=70yRC8npwT3d&format=png&color=000000" alt="Success">
                                    <p><?php echo htmlspecialchars($_GET['sucmsg']); ?></p>
                                </div>
                                <?php 
                                } 
                                ?>
                                
                                <?php 
                                if (isset($_GET['errmsg']) && $_GET['errmsg'] != '') {
                                ?>
                                <div id="message-box" class="message-box error" style="display: none;">
                                    <img src="https://img.icons8.com/?size=100&id=Sd2tYsgMJNyn&format=png&color=000000" alt="Error">
                                    <p><?php echo htmlspecialchars($_GET['errmsg']); ?></p>
                                </div>
                                <?php 
                                } 
                                ?>
                                    
                                    <hr class="line pr__hr__primary">
                                    <h2 class="title uk-heading-hero">Unlocking the Journey of Every Story</h2>
                                    <!--<a class="button uk-button uk-button-large uk-button-default uk-margin-top" href="#pr__services"
                                        data-uk-scroll="">Getting Started</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- Site Hero End -->

                <section class="pr__features uk-section uk-padding-remove-bottom" id="pr_features">
                    <div class="uk-container">
                        <div class="section-inner">
                            <div class="items-listing features-boxes uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m"
                                data-uk-grid="">
                                <div class="item feature-box">
                                    <div class="inner"> 
                                        <i class="icon fa fa-smile-o pr__icon__large"></i>
                                        <h3 class="title uk-h4">Compassion</h3>
                                        <hr class="line pr__hr__secondary">
                                        <p class="description">Stories have the ability to transcend barriers and touch the very core of human emotions. At our core, we believe that storytelling is a universal language that unites us all. Through the stories we curate, we strive to build bridges between cultures, generations, and perspectives.</p>
                                    </div>
                                </div>
                                <div class="item feature-box">
                                    <div class="inner">
                                        <i class="icon fa fa-thumbs-o-up pr__icon__large"></i>
                                        <h3 class="title uk-h4">Commitment</h3>
                                        <hr class="line pr__hr__secondary">
                                        <p class="description">Our commitment extends beyond merely sharing stories; it's about sparking change and making a difference. We are dedicated to crafting narratives that ignite curiosity, stimulate conversations, and empower individuals and organizations to take action.</p>
                                        <!--<a href="#" class="link uk-position-cover"></a>-->
                                    </div>
                                </div>
                                <div class="item feature-box">
                                    <div class="inner">
                                        <i class="icon fa fa-paper-plane-o pr__icon__large"></i>
                                        <h3 class="title uk-h4">Continuous Communication</h3>
                                        <hr class="line pr__hr__secondary">
                                        <p class="description">We're not just storytellers; we're community builders. Our commitment to continuous communication ensures that you're always in the loop, engaged, and an active participant in our journey. Whether it's updates on new stories, discussions, or collaborative opportunities, we keep the lines of communication open.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- Section: Features End -->

            </div><!-- Hero Wrap End -->

            <div class="pr__content" id="site-content">

                <hr class="pr__vr__section">
                <section class="pr__services pr__section uk-section uk-section-large" id="pr__services">
                    <div class="section-outer">
                        <div class="section-heading">
                            <div class="uk-container">
                                <div class="inner">
                                    <div class="left">
                                        <hr class="line pr__hr__secondary">
                                        <h2 class="title uk-h1">Services.</h2>
                                        <span class="subtitle pr__heading__secondary">We work with you, Not for you</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-inner">
                            <div class="uk-container">
                                <div class="items-listing services-boxes uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s"
                                    data-uk-grid="">
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-strategy"></i>
                                            <h5 class="title uk-h5">Campaign Planning & Execution</h5>
                                            <i class="icon pr-arrow-right"></i>
                                            <!--<a href="#" class="link uk-position-cover"></a>-->
                                            
                                            
                                        </div>
                                        <div class="outer">
                                            <p>
                                               Design campaigns that deliver to your marketing objectives and execute them on time. 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-browser"></i>
                                            <h5 class="title uk-h5">Startup Marketing Kit</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        <div class="outer">
                                            <p>
                                               Bring your product and services to market with confidence. Get all you need to kickstart your marketing with an inclusive package, exclusively designed for you.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-presentation"></i>
                                            <h5 class="title uk-h5">UI & UX Designing</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        <div class="outer">
                                            <p>
                                               We create functionally beautiful digital experiences that highly engage with your target audience. We tend to create meaningful relationships amidst brands and their consumers through inspiring design.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-clipboard"></i>
                                            <h5 class="title uk-h5">Online Reputation Management</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        <div class="outer">
                                            <p>
                                               Online reputation management includes managing your business and its brand value across every review and rating forum to every social media platform.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-tools"></i>
                                            <h5 class="title uk-h5">Communication Workshops</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        
                                        <div class="outer">
                                            <p>
                                               Decode the magic of storytelling. Give your teams tools and techniques to be better communicators.
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-chat"></i>
                                            <h5 class="title uk-h5">Bespoke Thought Leadership</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        
                                        <div class="outer">
                                            <p>
                                               Amplify your voice, expand your reach. Leverage social platforms to transform your thoughts into compelling narratives.
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-target"></i>
                                            <h5 class="title uk-h5">Employer Branding Services</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        
                                        <div class="outer">
                                            <p>
                                              Define a unique brand identity, reduce cost per hire, stand out in the employer’s market, engage better, and stay ahead on the talent expectation curve with our proven frameworks.
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-lightbulb"></i>
                                            <h5 class="title uk-h5">Social Media Marketing</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        
                                        <div class="outer">
                                            <p>
                                               We provide expertise in design implementation providing a full range of social media marketing services(SMM) bounding in popular social media platforms, content generation, creatives ideation, social branding techniques.
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="item service-box style-one">
                                        <div class="inner">
                                            <i class="overlay-icon icon pr-line-search"></i>
                                            <h5 class="title uk-h5">Market Communication</h5>
                                            <i class="icon pr-arrow-right"></i>
                                             
                                        </div>
                                        
                                        <div class="outer">
                                            <p>
                                               Elevate the positioning of your products and services with nuanced business storytelling.
                                            </p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- Section: Services End -->

                <hr class="pr__vr__section">
                <section class="pr__works pr__section section-slider uk-section uk-section-large" id="pr__works">
                    <div class="section-outer">
                        <div class="section-heading">
                            <div class="uk-container">
                                <div class="inner">
                                    <div class="left">
                                        <hr class="line pr__hr__secondary">
                                        <h2 class="title uk-h1">Stories.</h2>
                                        <span class="subtitle pr__heading__secondary">Igniting Emotion, Inspiring Action!</span>
                                    </div>
                                    <div class="right">
                                            <a class="button uk-button uk-button-default" href="/stories/">View all</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-inner">
                            <div class="uk-container uk-container-no">
                                <div class="items-listing works-boxes works-slider owl-carousel" data-items="4" data-margin="30"
                                    data-loop="true" data-center="true" data-autoplay="true" data-dots="true">
            
            <?php
				foreach ($postObj->getTrendingStories(13, "trending") as $post) {
				?>    
            
                                    <div class="item work-box">
                                        <div class="outer">
                                            <div class="image pr__image__cover pr__ratio__square" data-src="images/posts/<?php echo $post["img"] ?>"
                                                data-uk-img="" style="background-image: url('images/posts/<?php echo $post["img"] ?>');"></div>
                                            <div class="inner">
                                                <h3 class="title uk-h4"><?php echo $post["author"] ?></h3>
                                                <p class="category"><?php echo $post["title"] ?></p>
                                                <a href="/story/<?php echo $post["slug"] ?>" class="link uk-position-cover"></a>
                                            </div>
                                        </div>
                                    </div>
            <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- Section: Works End -->

                <hr class="pr__vr__section">
                <section class="pr__about pr__section uk-section uk-section-large" id="pr__about">
                    <div class="section-outer">
                        <div class="section-heading">
                            <div class="outer">
                                <div class="uk-container">
                                    <div class="inner uk-grid" data-uk-grid="">
                                        <div class="left uk-width-expand">
                                            <hr class="line pr__hr__secondary">
                                            <h2 class="title uk-h1">About.</h2>
                                            <span class="subtitle pr__heading__secondary">Navigating the Individual and Organizational Journey</span>
                                        </div>
                                        <div class="right uk-width-3-5@s">
                                            <p>We're driven by a singular mission that fuels every aspect of our business: to empower individuals and organizations to achieve their goals through the transformative power of storytelling. A well-told story can create an emotional connection with your audience, build trust and credibility, and differentiate you from others. We understand that in today's dynamic landscape, whether you're a startup, a brand, or a company, the ability to craft and convey a compelling story is paramount.</p>
                                        </div>
                                    </div>
                                </div><!-- Container End -->
                            </div><!-- Outer End -->
                        </div><!-- Heading End -->
                        <div class="section-inner">
                            <div class="uk-container">
                                <div class="gallery-boxes pr__grd__overlay uk-grid uk-grid-match uk-grid-medium"
                                    data-uk-grid="">
                                    <div class="left uk-width-expand">
                                        <div class="item gallery-box big">
                                            <div class="outer">
                                                <div class="image pr__image__cover" data-src="aboutusassets/assets/images/about_01.jpg" data-uk-img="" style="background-image: url('aboutusassets/assets/images/about_01.jpg');"></div>
                                                <div class="inner">
                                                    <h3 class="title uk-h5">Philosophy</h3>
                                                    <p class="description">Transforming Visions into Reality</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right uk-width-1-3@m">
                                        <div class="item gallery-box small">
                                            <div class="outer">
                                                <div class="image pr__image__cover" data-src="aboutusassets/assets/images/about_01-1.jpg" data-uk-img="" style="background-image: url('aboutusassets/assets/images/about_01-1.jpg');"></div>
                                                <div class="inner">
                                                    <h3 class="title uk-h5">Teamwork</h3>
                                                    <p class="description">Committed and Creative</p>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item gallery-box small">
                                            <div class="outer">
                                                <div class="image pr__image__cover" data-src="aboutusassets/assets/images/about_02.jpg" data-uk-img="" style="background-image: url('aboutusassets/assets/images/about_02.jpg');"></div>
                                                <div class="inner">
                                                    <h3 class="title uk-h5">Partnership</h3>
                                                    <p class="description">Driving Results Together</p>
                                                    <!--<a href="#" class="link uk-position-cover" data-uk-toggle=""></a>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-boxes uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-margin-large-top"
                                    data-uk-grid="">
                                    <div class="item about-box">
                                        <div class="outer">
                                            <div class="inner">
                                                <h3 class="title uk-h5">Who we are</h3>
                                                <p class="description" align="justify">At WAHStory, our mission extends beyond business; it's about empowering both individuals and organizations to create narratives that truly connect. We're driven by the belief that storytelling is a formidable tool—one that not only sets businesses apart but also builds bridges of trust, credibility, and inspiration.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item about-box">
                                        <div class="outer">
                                            <div class="inner">
                                                <h3 class="title uk-h5">Our philosophy</h3>
                                                <p class="description" align="justify">Our approach starts with understanding your essence. Whether you're a business or an individual, we work hand-in-hand to explore the depths of your story. We peel back layers to uncover the core values, missions, and aspirations that make you who you are. These elements become the foundation of the narrative that will shape perceptions and ignite connections.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item about-box">
                                        <div class="outer">
                                            <div class="inner">
                                                <h3 class="title uk-h5">How we work</h3>
                                                <p class="description" align="justify">At our core, we are storytellers driven by the belief that every individual, every brand, and every venture has a unique narrative waiting to be shared. Our approach is simple yet profound: we curate stories and facilitate a dynamic exchange between creators and audiences. Through this symbiotic relationship, we help you not only tell your story but also understand the heartbeat of your audience. Let's collaborate to give your story the wings it deserves.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Container End -->
                        </div><!-- Inner End -->
                    </div><!-- Outer End -->
                </section><!-- Section: About End -->


                <div class="pr__clients__logos pr__section uk-section uk-section-large uk-padding-remove-top" id="pr__clients__logos">
                    <div class="uk-container">
                        <hr class="pr__hr__section">
                        <h2 class="title uk-h1" style="font-size: 41px; text-align: center;">Transformative <span style="color: #E9204F;">Stories</span> of Individuals from Global Brands</h2>
                        <div class="section-outer uk-padding uk-padding-remove-bottom uk-padding-remove-horizontal clientsSlider ">
                            <div class="owl-carousel" data-items="5" data-loop="true" data-center="true" data-margin="10" data-autoplay="true" data-nav="true" data-speed="300" data-autoplay-speed="1000" data-responsive='{"0":{"items":2},"600":{"items":4},"1000":{"items":5}}'>
                                <div class="item logo">
                                    <div class="inner"><img src="aboutusassets/assets/images/logos/google.png" alt="Google" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="aboutusassets/assets/images/logos/hsbc.png" alt="HSBC" data-uk-svg=""></div>
                                </div>
                                <div class="item logo">
                                    <div class="inner"><img src="aboutusassets/assets/images/logos/godaddy.png" alt="Godaddy" data-uk-svg=""></div>
                                </div>
                                
                                <div class="item logo">
                                    <div class="inner"><img src="aboutusassets/assets/images/logos/genpact.png" alt="Genpact" data-uk-svg=""></div>
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
                                 
                                
                            </div> 
                        </div> 
                    </div> 
                </div> 

            <div class="form-outer pt-50  uk-section">
                <div class="uk-container uk-container-xsmall">
                    <div class="form-inner uk-position-relative">
                        <h2 class="uk-modal-title uk-h1" style="text-align: center;">Let's Talk?</h2>
                        <p style="text-align: center;">Let’s make something awesome together</p>
                        
                        <div class="inner" style="text-align: center;">
                            <a id="pr__contact" href="#pr__contact__form" class="button uk-button uk-button-large uk-button-default"
                                data-uk-toggle="">Make an enquiry</a>
                        </div>
                        
                    </div>
                </div>
            </div>

<?php 
$blogs = $postObj->getBlogs(10);
?>


                <hr class="pr__vr__section">
                <section class="pr__blog pr__section section-slider uk-section uk-section-large" id="pr__blog">
                    <div class="section-outer">
                        <div class="section-heading pr__center">
                            <div class="uk-container">
                                <div class="inner">
                                    <div class="center">
                                        <h2 class="title uk-h1">Blog & News.</h2>
                                        <span class="subtitle pr__heading__secondary">Explore, Engage, and Stay Informed!</span>
                                    </div>
                                </div>
                            </div><!-- Container End -->
                        </div><!-- Heading End -->
                        <div class="section-inner">
                            <div class="uk-container uk-container-no">
                                <div class="blog-listing style-one blog-slider owl-carousel" data-items="4" data-loop="true"
                                    data-center="true" data-margin="30" data-autoplay="true" data-dots="true">
        	<?php
			    if ($blogs) {
				    foreach ($blogs as $blog) {
			?>
            
                                    <article class="post type-post">
                                        <div class="outer">
                                            <div class="featured-image">
                                                <div class="image pr__image__cover" data-src="/images/blogs/<?php echo $blog["img"] ?>" data-uk-img="" style="background-image: url('/images/blogs/<?php echo $blog["img"] ?>');"></div>
                                            </div>
                                            <div class="inner">
											
                                                <h3 class="title uk-h5"><a href="/blog/<?php echo $blog["slug"] ?>"><?php echo $blog["title"] ?></a></h3>
                                                
                                                <a class="category" href="#"> <span class="post-author"><i class="fa fa-user"></i> <?php echo $blog["author"] ?></span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
											<span class="post-date"><i class="fa fa-clock-o"></i> <?php echo $blog["date"] ?></span> 
											
											</a>
                                                
                                                <a href="/blog/<?php echo $post["slug"] ?>" class="more icon pr-arrow-right"></a>
                                                <a href="/blog/<?php echo $post["slug"] ?>" class="link"></a>
                                            </div>
                                        </div>
                                    </article>
                                    
            <?php } ?>
            <?php } ?>
        
        
                                </div>
                            </div><!-- Container End -->
                        </div><!-- Inner End -->
                    </div><!-- Outer End -->
                </section><!-- Section: Blog End -->

                <hr class="pr__vr__section">
            </div><!-- Site Content End -->

            <footer class="pr__footer footer-area" id="site-footer">

                <div class="pr__footer__top">
                    <div class="section-outer"> 
                        <div class="uk-container">
                            <div class="section-inner">
                                <div class="columns uk-grid" data-uk-grid="">
                                    
                                    <div class="pr__cta column">
                                        <div class="inner">
                                <h5 class="title">Quick Links</h5>
                                
                                <ul>
								<li><a href="/wahcommunity/">WAH Community</a></li>
								<li><a href="/shareyourstory/">Share Your Story</a></li>
								<li><a href="/aboutus">About Us</a></li> 
								<li><a href="/contact">Contact Us</a></li> 
							</ul>
                                
                                        </div>
                                    </div>
                                    
                    <div class="pr__cta column">
                        <div class="inner">
                <h5 class="title">Our Initiatives</h5>
                
                <ul>
                    <li><a href="https://www.elementshrs.com" target="_blank">Elements HR Services</a></li>
                    <li><a href="https://www.investinu.co.in" target="_blank">Invest In U </a></li>
                    
                </ul>
                
                        </div>
                    </div>
                    <div class="pr__cta column">
                        <div class="inner">
                <h5 class="title">Subscribe</h5>
                
                 <p>Be the first to know about new<br> stories, campaigns and events!</p>
                                <input type="email" placeholder="Enter Email" class="uk-input subscribe-input">
                               <button class="uk-button subscribe-button" type="submit" name="Subscribe">Subscribe</button>
                
                        </div>
                    </div>
                                    
                                    
                                    <div class="pr__social column">
                                        
                                        <a href="/" class="foo-logo"><img src="/images/logos/logo-white.png" alt="WAHStory Logo" style="width: 156px;"></a>
                                        
                                        <p style="font-size: 16px;">"We believe there is power in<br> people, power in community!"</p>
                                        
                                        <div class="inner">
                                            
                                            <a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank" class="icon pr-logo-facebook"></a>
                                            
                                            <a href="https://www.instagram.com/WAHStory/" target="_blank" class="icon pr-logo-instagram"></a>
                                            <a href="https://www.linkedin.com/company/WAHStory/" target="_blank" class="icon pr-logo-linkedin"></a>
                                        </div>
                                        <br>
                                        <h2>
                                            <!--<a href="https://discord.com/invite/jD347qrFVa" target="_blank">-->
                                            <!--    Join Our Community-->
                                            <!--</a>-->
                                        </h2>
                                        <br>
                                    </div>
                                </div>
                            </div><!-- Inner End-->
                        </div><!-- Container End-->
                    </div><!-- Outer End-->
                </div><!-- Footer Top End-->
                <!--
                <div class="pr__footer__center uk-section uk-section-small">
                    <div class="uk-container">
                        <ul>
                            <li><a href="#">Berlin.<span class="phone">+21 30 310 0010</span></a></li>
                            <li><a href="#">Melbourne.<span class="phone">+21 201 161 0011</span></a></li>
                        </ul>
                    </div>
                </div> -->
                
 <!--   <div class="static-subscribe" id="fixed-div">-->
 <!--    <div class="static-subscribe-content uk-container  footer-sticky122">-->
 <!--           <div class="uk-grid">-->
            
 <!--               <div class=" inner">-->
                
                     
 <!--                    <h5 class="spotlightAwarttitle"><span><b>W</b><b>A</b><b>H</b></span><span>story Spotlight</span> &nbsp;<span style="color: #fff; font-size: 20px;">Award</span></h5> -->
                     
                     
 <!--                </div>-->
                
 <!--               <div class=" inner">-->
 <!--                   <a href="/wahspotlight/cat.php" target="_blank" class="spotbtns uk-button subscribe-button">Vote Now </a> &nbsp;-->
 <!--                   <a href="/wahspotlight/selfnomination.php" target="_blank" class="spotbtns uk-button subscribe-button"> Nominations Are Closed Now  </a>-->
                    
 <!--               </div>-->
                
 <!--           </div>-->
          
 <!--    </div>-->
 <!--</div>-->
                
                <div class="pr__footer__bottom uk-section" style="margin-top: 20px;">
                    <div class="section-outer">
                        <div class="uk-container">
                            <div class="section-inner">
                                <div>
                                    <div class="pr__copyrights">
                                        <div class="inner uk-grid">
                                            <div class="left uk-width-expand uk-first-column">
                                             
                                                <p><?=date('Y');?> © <a href="/" target="_blank">www.WAHStory.com</a>, All rights reserved.</p>
                                            
                                            </div>
                                            
                                            <div class="right uk-width-3-5@s">
                                            
                                            <p align="right">
                                                <a href="">Privacy Policy</a> | <a href="">Terms Of Use</a>
                                            </p>
                                            
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div><!-- Inner End-->
                        </div><!-- Container End-->
                    </div><!-- Outer End-->
                </div><!-- Footer Bottom End-->

            </footer><!-- Site Footer End-->

        </div><!-- Site Wrapper End -->
        




        <div id="pr__contact__form" class="pr__contact__form uk-modal-full" data-uk-modal="">
            <div class="uk-modal-dialog" data-uk-height-viewport="">
                <div class="form-outer">
                    <div class="uk-container uk-container-xsmall">
                        <div class="form-inner uk-position-relative">
                            <button class="uk-modal-close-full" type="button" data-uk-close="ratio: 2;"><span>Close</span></button>
                            <h2 class="uk-modal-title uk-h1">Let's Talk?</h2>
                            <p>Let’s make something awesome together</p>
                            <form class="pr__contact pr__form" action="">
                                <div class="pr__form__group">
                                    <label for="name">Your Name <span class="required">*</span></label>
                                    <input class="pr-input" id="name" name="name" type="text" />
                                </div>
                                <div class="pr__form__group">
                                    <label for="email">Your E-Mail <span class="required">*</span></label>
                                    <input class="pr-input" id="email" name="email" type="text" />
                                </div>
                                
                                <div class="pr__form__group">
                                    <label for="phone">Your Phone </label>
                                    <input class="pr-input" id="phone" name="phone" type="tel" />
                                </div>
                                
                                <div class="pr__form__group">
                                    <label for="subject">Your Subject <span class="required">*</span></label>
                                    <input class="pr-input" id="subject" name="subject" type="text" />
                                </div>
                        
                            <div class="inner uk-grid">
                    <!-- For Individual-->
                                <div class="pr__form__group uk-width-expand uk-first-column uk-margin-medium-top">
                            
                            <label for="services">Select Services (<span style="color: #e9204f;">Individual</span>) <span class="required">*</span></label>  
                            <div class="checkboxes">
                            <ul>
                                 <li>
                                    <input type="checkbox" id="vehicle0" name="services[]" value="LinkedIn Management">
                                    <label for="vehicle1">LinkedIn Management</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle1" name="services[]" value="Social Media Branding">
                                    <label for="vehicle1">Social Media Branding</label>
                                </li>
                                
                                <li>
                                    <input type="checkbox" id="vehicle2" name="services[]" value="Collaborations and Partnerships">
                                    <label for="vehicle2">Collaborations and Partnerships</label>
                                </li>
                               
                                <li>
                                    <input type="checkbox" id="vehicle3" name="services[]" value="Online Reputation Management">
                                    <label for="vehicle4">Online Reputation Management</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle4" name="services[]" value="Photography and Videography">
                                    <label for="vehicle5">Photography and Videography</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle5" name="services[]" value="Influencer Partnerships">
                                    <label for="vehicle2">Influencer Partnerships</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle6" name="services[]" value="Email Marketing">
                                    <label for="vehicle6">Email Marketing</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle7" name="services[]" value="Content Creation">
                                    <label for="vehicle7">Content Creation</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle8" name="services[]" value="Search Engine Optimization">
                                    <label for="vehicle8">Search Engine Optimization (SEO)</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle81" name="services[]" value="Personal Brand Strategy">
                                    <label for="vehicle81">Personal Brand Strategy</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle82" name="services[]" value="Website Development">
                                    <label for="vehicle82">Website Development</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle83" name="services[]" value="Public Relations">
                                    <label for="vehicle83">Public Relations (PR)</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle84" name="services[]" value="Networking Support">
                                    <label for="vehicle84">Networking Support</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle85" name="services[]" value="Book and Author Branding">
                                    <label for="vehicle85">Book and Author Branding</label>
                                </li>
                            </ul>
              
                            </div>
                                    
                                    
                            <div class="pr__form__group" style="margin-top: 0px;">
                                    <label for="vehicle86" style="font-size: 17px; font-weight: 500; text-transform: initial;">If Other Service (please specify)</label>
                                    <input type="text" id="vehicle86" name="services[]" class="pr-input" placeholder="Please Specify">
                            </div>
                                    
                                </div>
                    <!-- For Business-->
                                <div class="pr__form__group uk-width-1-2@s uk-margin-medium-top">
                            
                            <label for="servicesBusiness">Select Services (<span style="color: #e9204f;">Business</span>) <span class="required">*</span></label>  
                            <div class="checkboxes">
                            <ul>
                                <li>
                                    <input type="checkbox" id="vehicle11" name="servicesBusiness[]" value="Campaign Planning & Execution ">
                                    <label for="vehicle11">Campaign Planning & Execution</label>
                                </li>
                                
                                <li>
                                    <input type="checkbox" id="vehicle12" name="servicesBusiness[]" value="Startup Marketing Kit">
                                    <label for="vehicle12">Startup Marketing Kit</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle13" name="servicesBusiness[]" value="Website Design and Development">
                                    <label for="vehicle13">Website Design and Development </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle14" name="servicesBusiness[]" value="Brand Positioning">
                                    <label for="vehicle14">Brand Positioning</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle15" name="servicesBusiness[]" value="Communication Workshops">
                                    <label for="vehicle15">Communication Workshops</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle16" name="servicesBusiness[]" value="Bespoke Thought Leadership">
                                    <label for="vehicle16">Bespoke Thought Leadership </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle61" name="servicesBusiness[]" value="Employer Branding Services">
                                    <label for="vehicle61">Employer Branding Services</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle17" name="servicesBusiness[]" value="Social Media Marketing">
                                    <label for="vehicle17">Social Media Marketing </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle18" name="servicesBusiness[]" value="Market Communication">
                                    <label for="vehicle18">Market Communication</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle19" name="servicesBusiness[]" value="Brand Strategy Development">
                                    <label for="vehicle19">Brand Strategy Development</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle20" name="servicesBusiness[]" value="Content Strategy and Creation">
                                    <label for="vehicle20">Content Strategy and Creation</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle21" name="servicesBusiness[]" value="Social Media Management">
                                    <label for="vehicle21">Social Media Management</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle22" name="servicesBusiness[]" value="Digital Marketing">
                                    <label for="vehicle22">Digital Marketing</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle23" name="servicesBusiness[]" value="Brand Experience Design">
                                    <label for="vehicle23">Brand Experience Design</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="vehicle24" name="servicesBusiness[]" value="Search Engine Optimization">
                                    <label for="vehicle24">Search Engine Optimization (SEO)</label>
                                </li>
                            </ul>
              
                            </div>
                                    
                                    
                            <div class="pr__form__group" style="margin-top: 0px;">
                                    <label for="vehicle25" style="font-size: 17px; font-weight: 500; text-transform: initial;">If Other Service (please specify)</label>
                                    <input type="text" id="vehicle25" name="servicesBusiness[]" class="pr-input" placeholder="Please Specify">
                            </div>
                                    
                                </div>
                            </div>
                            
                            
                                <div class="pr__form__group">
                                    <label for="message">Your message <span class="required">*</span></label>
                                    <textarea class="pr-textarea" id="message" name="message"></textarea>
                                </div>
                                
                                <div class="g-recaptcha" data-sitekey="6LfD06weAAAAAOjL1EFxao0cMF8c-caJNaKAY9PD"></div>
                                
                                <p class="pr__form__group uk-margin-large">
                                    <button class="uk-button uk-button-large uk-button-primary" type="submit" name="LETSTALK">Send message</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Contact Form Popup End -->



        <!-- Needed Scripts -->
        <script src="aboutusassets/assets/js/jquery.min.js"></script>
        <script src="aboutusassets/assets/js/anime.min.js"></script>
        <script src="aboutusassets/assets/js/pr.animation.js"></script>
        <script src="aboutusassets/assets/js/uikit.min.js"></script>
        <script src="aboutusassets/assets/js/owl.carousel.min.js"></script>
        <script src="aboutusassets/assets/js/validate.js"></script>
        <script src="aboutusassets/assets/js/main.js"></script>
        
        
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
        
       <?php if(isset($_GET['enquiry'])){ ?>
        <script>
            // Get a reference to the button element
            var button1 = document.getElementById("pr__contact");
            function autoButtonClick() {
                button1.click();
            }

        // Call the function to trigger the button click on page load
        window.addEventListener("load", autoButtonClick);
            
            
        </script>
        <?php } ?>
         <script>
function showOtherInput(select) {
  var otherInput = document.getElementById("other-input");
  if (select.value === "other") {
    otherInput.style.display = "block";
  } else {
    otherInput.style.display = "none";
  }
}
</script>


<?php if (isset($_GET['sucmsg'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var messageBox = document.querySelector('.message-box.success');
    messageBox.style.display = 'block';
});
</script>
<?php } ?>

<?php if (isset($_GET['errmsg'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var messageBox = document.querySelector('.message-box.error');
    messageBox.style.display = 'block';
});
</script>
<?php } ?>

        
    </body>

</html>
