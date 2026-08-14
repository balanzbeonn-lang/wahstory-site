@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    
    if (!$story || $story->storycontent === NULL) {
        header("location: https://www.wahstory.com/wahclub/build-my-presence/$user->id?status=completeprofile");
        exit();
    }
    
    if (count($skills) === 0) {
        header("location: https://www.wahstory.com/wahclub/build-my-presence/$user->id?status=completeprofile");
        exit();
    }
    
    if (count($tools) === 0) {
        header("location: https://www.wahstory.com/wahclub/build-my-presence/$user->id?status=completeprofile");
        exit();
    } 
    
    if (!isset($UserAttributes) || count($UserAttributes) === 0) {
        header("location: https://www.wahstory.com/wahclub/build-my-presence/$user->id?status=completeprofile");
        exit();
    }
    
    // For Calendar Timezones
    if($mytimezone) {
        $memberTimeZone = $mytimezone->value;
    } else {
        $memberTimeZone = '+5:30';
    } 
    
    $UserTimeZone = '+5:30'; 
    
    
    $isLoggedIn = isset($loggedinUser) && $loggedinUser != null;
    $isNotSameUser = $isLoggedIn && $_SESSION['email'] !== $user->email;
    $isPaidUser = $isLoggedIn && $loggedinUser->subscription_status === 'paid';
    $isPaidMember = $user->subscription_status === 'paid';
    
    $isConnected = isset($connections[$user->id]) && $connections[$user->id] == 1;
    
    
      
     if ($isLoggedIn) {
        
        if ($isPaidUser) {
            $playVideo = '<div class="intro-video-play-button">
                                <a href="javascript:void(0);"  class="popup-video video-play-btn" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                            <div class="video-close-btn" style="display: none">
                                <i class="fa-solid fa-times"></i>
                            </div>
                            <div class="video-overlay" style="display: none">
                                <video width="100%" style="border-radius: 10px; " controls>
                                    <source src="' . asset('public/img/pratham-vdo.mp4') . '" type="video/mp4">
                                    <source src="' . asset('public/img/pratham-vdo.ogg') . '" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>';
        } else {
        
            $playVideo = '<div class="intro-video-play-button" data-bs-target="#paidFeature" data-bs-toggle="modal"> <a href="javascript:void(0);"  class="popup-video video-play-btn" data-cursor-text="Play"> <i class="fa-solid fa-play"></i> </a> </div>';
        }
     
     } else{
     
        $playVideo = '<div class="intro-video-play-button" data-bs-target="#loginModal" data-bs-toggle="modal"> <a href="javascript:void(0);"  class="popup-video video-play-btn" data-cursor-text="Play"> <i class="fa-solid fa-play"></i> </a> </div>';
     
     }
     
@endphp
  
   
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>{{ $user->firstname }} {{ $user->lastname }} - WAHClub </title>
    
    
<meta name="csrf-token" content="{{ csrf_token() }}">

     <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/wahclub/{{ $user->slug_username }}">
    <meta name="identifier-URL" content="https://www.wahstory.com/wahclub/{{ $user->slug_username }}"> 
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    
     <link rel="canonical" href="https://www.wahstory.com/wahclub/{{ $user->slug_username }}" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="{{ $user->firstname }} {{ $user->lastname }} | WAHClub">
    <meta name="og:description" content="{{ Str::limit(strip_tags($story->storycontent), 100) }}">
    <meta property="og:url" content="https://www.wahstory.com/wahclub/{{ $user->slug_username }}" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/wahclub/public/img/photos/{{ $user->photo }}" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="400" />
    <meta property="og:image:type" content="image/png" />
    
    

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="https://www.wahstory.com/images/wah_fav.ico" />
    <link rel="shortcut icon" type="image/png" href="https://www.wahstory.com/images/wah_fav.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/flaticon_gerold.css') }}"> 
    <link rel="stylesheet" href="{{ asset('/public/css/nice-select.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">   
     
    
    <style>
          
        .hero-sub-title {
            text-transform: capitalize;
        }
        
        #shareprofileli{
            position: relative;
        }
        #shareprofileli span{
            background: #000;
            padding: 11px 10px;
            border-radius: 10px;
            position: absolute;
            min-width: 140px;
            top: 40px;
            display: none;
        }
        
        
        .video-overlay {
            position: absolute;
            top: 0;
            z-index: 9;
            background: #1a0918;
            border-radius: 10px;
            width: 100%;
        }
        
        .video-close-btn {
            position: absolute;
            top: -14px;
            right: -14px;
            z-index: 99;
            cursor: pointer;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 20px;
            background: #a71f3f;
        }
        
        
        
        
        #works-section .portfolio-box .portfolio-item {
            padding: 15px;
        }
        
        #works-section .portfolio-box .image-box img{
            height: 400px;
            min-width: 500px;
            border-radius: 10px;
        }
        
        #works-section .portfolio-box .portfolio-item {
            padding: 10px;
            /*width: auto;*/
        }

        #awards-section .portfolio-box .portfolio-item{
            padding: 10px;
            /*width: auto;*/
        }
        
         #awards-section  .portfolio-box .image-box img {
            height: 400px;
            border-radius: 10px;
        }

        .testimonials-widget .testimonial-item .thoughts-box {
            padding: 0px 10px 20px 10px;
        }
        
        .testimonials-widget .testimonial-item .quote {
            font-size: 13px;
            margin-bottom: 15px;
        }
        
        .testimonials-widget .testimonial-item span.designation {
            font-size: 12px;
        }
        
        .blog-item .blog-thumb img { 
            height: 270px;
        }
        
        .limited-lines {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3; /* Limits to 3 lines */
            overflow: hidden;
            line-height: 1.5; /* Adjust as needed */
            max-height: 4.5em; /* Adjust based on line-height */
        }
        
        .limited-lines-2 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2; /* Limits to 3 lines */
            overflow: hidden;
             
        }
        .limited-lines-1 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1; /* Limits to 3 lines */
            overflow: hidden;
            line-height: 1.5; /* Adjust as needed */
            max-height: 4.5em; /* Adjust based on line-height */
        }
        
        .story_content p{
            text-align: justify;
        }
        .popup_modal_content .portfolio_navigation {
            padding: 5px 50px;
        }
        
        .icon-box.toolimage span{
            font-size: 44px;
            padding: 14px;
            font-family: 'FontAwesome';
            color: #fff;
            border: 1px solid #333;
            border-radius: 20px;
            -o-transition: 0.3s;
            transition: 0.3s;
        }
        .skill-inner:hover .icon-box.toolimage span{
            
            border-color: #fff;
        }
        
        .skills-widget .skill-item .number {
            -o-transition: 0.3s;
            transition: 0.3s;
        }
        .skills-widget .skill-item:hover .number {
            
            color: #fff;
        }
        
        .resume-widget.skill-box .resume-item .time {
            font-size: 13px;
            margin-bottom: 0;
        }
        
        .skill-box{ 
            /*box-shadow: 8px 8px 0 0 #bb2246, 8px 8px 0 1px #dfcaca;*/
            /*border-width: 1px;*/
            border-radius: 8px;
            -o-transition: 0.3s;
            transition: 0.3s;
            
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(to right, var(--tj-theme-primary) 0%, var(--tj-theme-secondary) 51%, var(--tj-theme-primary) 100%);
             
                padding: 15px 10px;
                margin-bottom: 10px;
        }
        
        .resume-widget.skill-box .resume-item {
            /*border: 1px solid #dfcaca;*/
            border-radius: 8px;
            background: inherit; 
                margin-bottom: 0;
                padding: 20px 10px;
        }
        /*.skill-box:hover {
            box-shadow: 8px 8px 0 0 #140c1c, 8px 8px 0 1px #dfcaca;
            border-width: 1px;
            border-radius: 8px;
        }*/
        
        .skill-box.resume-widget .resume-item:before {
           border-radius: 8px; 
        }
        
        
        
        
        
        .blog-item .blog-content .blog-title { 
            font-size: 14px;
            
                }
                
        .blog-item .blog-content {
            padding: 12px 14px 12px; 
            bottom: 10px;
            
        }
        .fixed-button {
            position: fixed;
            bottom: 40%;
                right: -50px;
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
            -o-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg);
            z-index: 98;
        }
        
    .login-popup-close{
        position: absolute;
        top: -8px;
        right: 0px;
        color: #fff;
        font-size: 23px;
        background: none;
    }
     
    .pending-connection:hover{
        border: 1px solid #989898;
    }
    .pending-connection{
        background: none;
        border: 1px solid #989898;
        font-weight: 300;
        letter-spacing: 1.01px;
    }
        
        
    @media only screen and (max-width: 767px) {
        
        .fixed-button{
            position: fixed;
            left: 0px;
            height: 60px;
            width: 100%;
            background: #0f0715;
            display: flex;
            align-items: center;
            justify-content: center;
            bottom: 0;
            -webkit-transform: none; 
            transform: none;
            z-index: 98;
        }
        
        .tj-footer-area { 
            margin-bottom: 50px;
        }
        
        .progress-wrap { 
            bottom: 7px;
            }
        
    }
    
    
    /* Calendar CSS  ################################*/
    /* Calendar CSS  ################################*/
    
    
    .btn-outline-primary {
        --bs-btn-color: #f12b59;
        --bs-btn-border-color: #f12b59;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #f12b59;
        --bs-btn-hover-border-color: #f12b59;
        --bs-btn-active-bg: #f12b59;
        --bs-btn-active-border-color: #f12b59;
        }
    
        button.disabled {
            background: #2a2727 !important;
            cursor: not-allowed !important;
            color: #7a7a7a !important;
        }
    
         .owl-nav {
        	padding: 5px;
        	position: absolute;
            top: -72px;
            right: 5px;
        }
        
          .owl-nav button.owl-prev{
        	margin-right: 10px;
        		
        }
          .owl-nav button.owl-next{
        	margin-left: 10px;
        		
        }
          .toptags-widget .owl-nav button.owl-prev,   .toptags-widget .owl-nav button.owl-next{
        	padding: 0.5rem 0.945rem 0.7rem 0.945rem !important;
            border-radius: 50%;
            background: #43454c;
            isolation: isolate;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            line-height: 1.3rem;
            letter-spacing: .01em;
            text-transform: capitalize;
            transition: background .25s ease, box-shadow .25s ease;
            vertical-align: middle;
            white-space: nowrap;
            font-size: 30px;
        	opacity: 0.8;
        }
          .owl-nav button.owl-prev:hover,   .owl-nav button.owl-next:hover {
        	opacity: 1;
        }
        
    
        .time-slot {
            background-color: rgba(241, 43, 89, 0.1);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            padding: 0.35rem 0.75rem;
            margin: 1%;
            border: 1px solid rgba(241, 43, 89, 0.2);
            transition: all 0.3s ease;
            width: 18%;
        }
        .Bookedtime-slot {
            background-color: rgba(241, 43, 89, 0.1);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            padding: 0.35rem 0.75rem;
            margin: 1%;
            border: 1px solid rgba(241, 43, 89, 0.2);
            transition: all 0.3s ease;
            width: 18%;
            opacity: 0.4;
            cursor: not-allowed !important;
        }
        
        .time-slot:hover, .time-slot.active {
            background-color: #f12b59;
            color: white; 
            box-shadow: 0 5px 15px rgba(241, 43, 89, 0.2);
        }
    
        .date-slot {
            background-color: rgba(241, 43, 89, 0.1);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            padding: 0.35rem 0.75rem; 
            border: 1px solid rgba(241, 43, 89, 0.2);
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .unavailable.date-slot:hover, .unavailable.date-slot.active {
            background-color: rgba(241, 43, 89, 0.1);
        }
        .date-slot:hover, .date-slot.active {
            background-color: #f12b59;
            color: white; 
            box-shadow: 0 5px 15px rgba(241, 43, 89, 0.2);
        }
        
        .unavailable {
            opacity: 0.3;
            cursor: auto !important;
        }
        
        
        .tooltip {
            --bs-tooltip-bg : #5b5959 !important;
        }
        
        .bookinginfo-ul li{
            display: inline-block;
            list-style: none;
            padding: 5px 8px;
            font-size: 12px;
        }
        
        
        .detail-card {
            transition: all 0.3s ease;
            border: 1px solid #f12b59;
            background: rgba(241, 43, 89, 0.1);
            border-radius: 10px;
            min-height: 130px;
            padding: 10px;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            /*box-shadow: 0 5px 15px rgba(241, 43, 89, 0.15);*/
            border-bottom: 10px solid #f12b59;
        }
        
        .detail-card p {
            font-size: 0.8rem;
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }

        
            
        @media only screen and (max-width: 992px) {
            .time-slot, .Bookedtime-slot { 
                width: 20%;
            }
        } 
        @media only screen and (max-width: 520px) {
            .time-slot, .Bookedtime-slot { 
                width: 26%;
            }
        }
    
     
    
    /* Calendar CSS Ends  ################################*/
    /* Calendar CSS Ends  ################################*/
    
    
    
    
    </style>
    
</head>

<body>

   


    <!-- start: Back To Top -->
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- end: Back To Top -->

    <!-- HEADER START -->
    <header class="tj-header-area header-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>
 

                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li><a href="/wahclub/"><i class="fa fa-home"></i></a></li>
                                 
                                <li  class="current-menu-ancestor"><a href="#aboutme-section">About Me</a></li>
                                <li><a href="#skills-section">Skills</a></li>
                            @if(!$projects->isEmpty())
                                <li><a href="#works-section">Projects</a></li>
                            @endif
                                
                                <li><a href="#experience-section">Experience</a></li>

                            @if(!$awards->isEmpty())
                                <li><a href="#awards-section">Awards</a></li>
                            @endif
                            @if(!$testimonials->isEmpty())
                                <li><a href="#testimonials-section">Testimonials</a></li>
                            @endif
                            @if(!$blogs->isEmpty())
                                <li><a href="#blogs-section">Blogs</a></li> 
                            @endif
                            
                            @if($isLoggedIn)
                                <li><a href="/users/" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @else
                                <li><a href="/login?rurl={{ request()->getRequestUri() }}" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @endif

                            </ul>
                        </nav>
                    </div>

                    <div class="header-button">
                        <a href="#contact-section" class="btn tj-btn-primary">Let's Connect!</a> 
                    </div>

                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="tj-header-area header-2 header-sticky sticky-out">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>
 

                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li><a href="/wahclub/"><i class="fa fa-home"></i></a></li>
                                <li  class="current-menu-ancestor"><a href="#aboutme-section">About Me</a></li>
                                <li><a href="#skills-section">Skills</a></li>
                            @if(!$projects->isEmpty())
                                <li><a href="#works-section">Projects</a></li>
                            @endif
                                <li><a href="#experience-section">Experience</a></li>
                                
                            @if(!$awards->isEmpty())
                                <li><a href="#awards-section">Awards</a></li>
                            @endif
                            @if(!$testimonials->isEmpty())
                                <li><a href="#testimonials-section">Testimonials</a></li>
                            @endif
                            @if(!$blogs->isEmpty())
                                <li><a href="#blogs-section">Blogs</a></li> 
                            @endif
                            @if($isLoggedIn)
                                <li><a href="/users/" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @else
                                <li><a href="/login?rurl={{ request()->getRequestUri() }}" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @endif

                            </ul>
                        </nav>
                    </div>

                    <div class="header-button">
                        <a href="#contact-section" class="btn tj-btn-primary">Let's Connect!</a> 
                    </div>

                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <main class="site-content" >
        <!-- HERO SECTION START -->
        <section class="hero-section d-flex align-items-center" id="aboutme-section">
            <div class="intro_text">
                <svg viewBox="0 0 1320 300">
                    <text x="50%" Y="50%" text-anchor="middle">
                        HI
                    </text>
                </svg>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="hero-content-box">
                            
                            <span class="hero-sub-title wow fadeInLeft" data-wow-delay="1.1s">{{ $user->firstname }} {{ $user->lastname }} 
                    @if($user->subscription_status === 'paid')
                    
					    <img decoding="async" src="{{ asset('public/img/shapes/premium-tag.png') }}" style="width: 30px;height: 30px;display: inline;margin-bottom: 5px;"/>
				    @endif
					        </span>
                            <h1 class="hero-title wow fadeInLeft" data-wow-delay="1.2s" style="color: #fff;">{{ $story->title }}
                            </h1>

                            <div class="hero-image-box d-md-none text-center wow fadeInRight" data-wow-delay="1.3s">
                                <img src="{{ asset('public/img/photos/'. $user->photo) }}"  class="userProfilePhoto" alt="">
                                
                        @if($user->id === 251)
                            <!--Video Section for Mobile-->
                                 {!! $playVideo !!}
                            <!--Video Section Ends -->
                        @endif
                                
                            </div>

                            <p class="lead wow fadeInLeft limited-lines" data-wow-delay="1.4s">{{ html_entity_decode(strip_tags($story->storycontent)); }} </p> <a href="javascript:void(0);" data-mfp-src="#portfolio-wrapper" class="service-link modal-popup" style="color: #f12b59;">Read More</a>
                            <div class="button-box d-flex flex-wrap align-items-center">
                               <!-- <a href="#" class="btn tj-btn-secondary wow fadeInLeft" data-wow-delay="1.5s">Download
                                    CV</a> -->
                                <ul class="ul-reset social-icons wow fadeInLeft" data-wow-delay="1.6s">
                                
                                @foreach ($socials as $social)

                                    @if($social->platform == 'Facebook')
                                        <li><a href="{{ $social->link }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                                    @elseif($social->platform == 'Instagram')
                                        <li><a href="{{ $social->link }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                    @elseif($social->platform == 'Linkedin')
                                        <li><a href="{{ $social->link }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    @elseif($social->platform == 'Twitter')
                                        <li><a href="{{ $social->link }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li> 
                                    @endif

                                @endforeach
                                
                                <li id="shareprofileli"><a href="javascript:void(0);" id="ShareProfile"><i class="fa-regular fa-share-nodes"></i></a>
                                    
                                    <span><i class="fa-sharp fa-regular fa-link-simple"></i> Link Copied</span>
                                
                                </li> 
                                    
                                </ul>
                        
            @php
		    $userID = $user->id;
            $myconnections = \App\Models\Connection::where(function ($query) use ($userID) {
                
                $query->where(function ($query) use ($userID) {
                    $query->where('user_id_1', $userID)
                            ->orWhere('user_id_2', $userID);
                })->where('status', 1);
                      
            })->get();
        @endphp
        @php
            $connectionCount = $myconnections->count();
        @endphp
			 
			 
		@php 
            $connectionIcon = 'fa-user-vneck';
        @endphp 
			 
			 @if (isset($loggedinUser) && $loggedinUser != null)
                
                @if ( $_SESSION['email'] !== $user->email )
                
			        @php 
			            $memberID = $user->id;
			        @endphp 
				         
				        
    				@if(isset($connections[$memberID]))
    				 
    				    @if($connections[$memberID] == 1)
    				    
        				    @php 
                                $connectionIcon = 'fa-user-check';
                            @endphp 
    				    
    				    @endif
    				
    				@endif
    				
    	        @endif
    				
    	    @endif
    				
			 
			                    <a href="javascript:void(0);" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-normal" data-wow-delay="1.8s" title="Profile Views" style="gap: 3px;"><i class="fa-regular fa-eye" style=" transform: none;  "></i>{{ $user->views * 27 }}+ views </a>
                        
        @if($isPaidMember)
        <!--If the portfolio Holder (Member) is Paid-->
                                <a href="javascript:void(0);" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-normal imconnected" data-wow-delay="1.8s" title="My Connections" style="gap: 3px;"><i class="fa-regular {{ $connectionIcon }}" style=" transform: none;  "></i> {{ $connectionCount }} </a>
                         
            @php
                $memberID = $user->id;
                $isConnectionPending = isset($connections[$memberID]) && $connections[$memberID] !== 1;
                $isConnected = isset($connections[$memberID]) && $connections[$memberID] == 1;
            @endphp       
                                
             
            @if ($isLoggedIn)
                @if ($isNotSameUser)
                    @if ($isConnectionPending)
                        <a href="javascript:void(0);" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400 pending-connection" data-wow-delay="1.8s" title="The connection is pending; please wait for {{ $user->firstname }} to accept it.">
                            <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                        </a>
                    @elseif ($isConnected)
                        <style>
                            .imconnected {
                                background-image: linear-gradient(to right, #035e39 0%, #1c9542 51%, #035e39 100%);
                            }
                        </style>
                        
                    @else
                    
                    
                        @if ($isPaidUser)
                            <a href="javascript:void(0);" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-normal connectprofile-btn" data-memberid="{{ $user->id }}" title="Connect with {{ $user->firstname }}" style="gap: 3px;" data-wow-delay="1.8s">
                                <i class="fa fa-plus small" style="transform: none;"></i> Connect
                            </a>
                
                            <a href="javascript:void(0);" class="btn tj-btn-primary pending-connection py-2 px-2 small wow fadeInLeft fw-normal" style="display: none;" data-wow-delay="0.3s" title="The connection is pending; please wait for {{ $user->firstname }} to accept it.">
                                <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                            </a>
                        @else
                            
                            <a href="#paidFeature" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" title="Connect with {{ $user->firstname }}" style="gap: 3px;" data-wow-delay="1.8s">
                                <i class="far fa-plus small" style="transform: none;"></i> Connect
                            </a>
                        @endif
                        <!--Checking Paids Ends-->
                        
                        
                    @endif 
                    <!--Checking Connections Ends-->
                    
                    @if ($isPaidUser)
                      @if ($isConnected)
                        @if (!empty($availabilities) && $availabilities !== "No availabilities set")
                        <a href="#BookSlotModal" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" style="gap: 3px;" data-wow-delay="1.8s">
                            <i class="fa-solid fa-calendar-days small" style="transform: none;"></i> Book a Slot
                        </a>
                        @endif
                        
                      @else
                        <a href="#getConnect" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" style="gap: 3px;" data-wow-delay="1.8s">
                            <i class="fa-solid fa-calendar-days small" style="transform: none;"></i> Book a Slot
                        </a>
                      @endif
                      
                    @else
                        <a href="#paidFeature" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" style="gap: 3px;" data-wow-delay="1.8s">
                            <i class="fa-solid fa-calendar-days small" style="transform: none;"></i> Book a Slot
                        </a>
                    @endif
                    <!--Checking Paids Ends-->
                
                @endif 
                <!--When Logged In User Not Same-->
            
            @else
                <a href="#loginModal" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" title="Connect with {{ $user->firstname }}" style="gap: 3px;" data-wow-delay="1.8s">
                    <i class="far fa-plus small" style="transform: none;"></i> Connect
                </a>
            
                <a href="#loginModal" class="btn tj-btn-primary py-2 px-2 small wow fadeInLeft fw-400" data-bs-toggle="modal" title="Connect with {{ $user->firstname }}" style="gap: 3px;" data-wow-delay="1.8s">
                    <i class="fa-solid fa-calendar-days small" style="transform: none;"></i> Book a Slot
                </a>
            @endif  <!--User Is Not Loggedin-->
        
        
        @endif  <!--If Member is Paid-->
             
             
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <div class="hero-image-box text-center wow fadeInRight" data-wow-delay="1.5s">
                @if ($user->photo)
                    <img src="{{ asset('public/img/photos/'. $user->photo) }}" alt="" class="userProfilePhoto">
                    @if($user->id === 251)
                         {!! $playVideo !!}
                    @endif
                @else
                    <img src="{{ asset('public/img/photos/user-photo.jpg') }}" alt="">
                @endif
                            

                        </div>
                    </div>
                </div>

                <div class="funfact-area">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                                <div class="number"><span class="odometer" data-count="{{ $user->totalexperience }}">0</span>+</div>
                                <div class="text">Years of <br>Experience</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                                <div class="number"><span class="odometer" data-count="{{ $user->totalproject }}">0</span>+</div>
                                <div class="text">Project <br>Completed</div>
                            </div>
                        </div>
                        
                        
            @php
            
             $Clientrange = $user->totalclients; 
            
             
            if (strpos($Clientrange, '-') !== false) {
            
                list($min, $max) = array_map('trim', explode('-', $Clientrange));
                
            } else {
            
                $min = $max = trim($Clientrange);
            }
             
            @endphp
                        
                        <div class="col-6 col-lg-3">
                            <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                                <div class="number"><span class="odometer" data-count="{{ $max }}">0</span>+</div>
                                <div class="text">Happy <br>Clients</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                                <div class="number"><span class="odometer" data-count="{{ $user->totalawards }}">0</span>+</div>
                                <div class="text">Awards & <br>Recognition</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO SECTION END -->

        <!-- SERVICES SECTION START -->
        <section class="services-section" id="personalitytraits-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header text-center">
                            <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Personality Traits</h2> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="services-widget position-relative">
            @php    $n = 1;  @endphp
                        @foreach ($UserAttributes as $UserAttribute)
                            <div class="service-item current d-flex flex-wrap align-items-center wow fadeInUp"
                                data-wow-delay=".5s">
                                <div class="left-box d-flex flex-wrap align-items-center">
                                    <span class="number">0{{ $n }}</span>
                                    <h3 class="service-title">
                                        {{ $UserAttribute->attribute }}</h3>
                                </div>
                                <div class="right-box">
                                    <p>{{ $UserAttribute->description }}</p>
                                </div>
                                <i class="flaticon-up-right-arrow"></i> 
                            </div>
                            @php    $n++;  @endphp
                        @endforeach
                             
                            <div class="active-bg wow fadeInUp" data-wow-delay=".5s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SERVICES SECTION END -->
        
        
        <!-- SERVICES SECTION START -->
        <section class="services-section pt-2 pb-5" id="skills-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header text-center">
                            <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Key Skills & Tools</h2>
                            <p class=" wow fadeInUp" data-wow-delay=".4s">Here are the key skills and tools that define my expertise</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    
                    
                    @foreach ($skills as $skill)
                    
                    <div class="col-md-4">
                    
                        <div class="resume-widget skill-box tj-btn-primary">
                         
                            <div class="resume-item wow fadeInLeft btn tj-btn-secondary" data-wow-delay=".4s" style="bac">
                                <div class="time text-white">
                                 {{ $skill->skill }}
                                </div>
                                
                            </div> 
  
                        </div>
                    
                    </div>
                    @endforeach
                    
                     
                </div>
            </div>
        </section>
        <!-- SERVICES SECTION END -->
        
                <!-- SKILLS SECTION START -->
        <section class="services-section pt-2" id="tools-section">
            <div class="container">
 

                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="skills-widget d-flex flex-wrap justify-content-center align-items-center">
                        <?php $i = 3; ?>
                        @foreach ($tools as $tool)
                        
                        
                        @if($tool->tool == 'Other')
                         
            @if($user->otherTools != NULL)
                         
                @foreach(explode(',', $user->otherTools) as $otherTool)
                
                         <div class="skill-item wow fadeInUp" data-wow-delay=".{{ $i }}s">
                                <div class="skill-inner">
                                 <a href="https://www.google.com/search?q={{ $otherTool }}" title="{{ $otherTool }}" target="_blank" style="text-decoration: none;">
                                    <div class="icon-box toolimage">
                                        
                        <span>{{ strtoupper(substr($otherTool, 0, 1)) }}</span>  
                                    
                                    </div>
                                    <div class="number">{{ $otherTool }}</div>
                                 </a>
                                </div> 
                            </div>
                         
                @endforeach
                         
            @endif
				                @continue
				        @endif
                            <div class="skill-item wow fadeInUp" data-wow-delay=".{{ $i }}s">
                                <div class="skill-inner">
                                 <a href="https://www.google.com/search?q={{ $tool->tool }}" title="{{ $tool->tool }}" target="_blank" style="text-decoration: none;">
                                    <div class="icon-box toolimage">
                        @if ($tool->image)
                                        <img src="{{ asset('public/img/tools/'. $tool->image ) }}" alt="{{ $tool->tool }}">
                        @else
                                        <span>{{ strtoupper(substr($tool->tool, 0, 1)) }}</span>
                        @endif 
                                    
                                    
                                    </div>
                                    <div class="number">{{ $tool->tool }}</div>
                                 </a>
                                </div> 
                            </div>
                        <?php $i++; ?>
                        @endforeach
 
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SKILLS SECTION END -->
        
 @if(!$projects->isEmpty())
        <!-- PORTFOLIO SECTION START -->
        <section class="portfolio-section" id="works-section">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="section-header text-center">
                            <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Projects & Work Handled</h2>
                            <p class=" wow fadeInUp" data-wow-delay=".4s">Here are the projects and tasks I have successfully managed</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                            <div class="portfolio-sizer"></div>
                            <div class="gutter-sizer"></div>
                        
                        <div class="row">
                        @foreach ($projects as $project)

                            <div class="portfolio-item branding col-md-6 my-2">
                                <div class="image-box">
                        
                        @if($project->project_photo)
                                    <img src="{{ asset('public/img/projects/'. $project->project_photo ) }}" alt="">
                                    
                        @else
                                    <img src="{{ asset('public/img/projects/project-photo.jpg') }}" alt="">
                        @endif
                                    
                                </div>
                                <div class="content-box">
                                    <h3 class="portfolio-title">{{ $project->project_name }}</h3>
                                    <p class="limited-lines-2">{{ $project->project_objective }}</p>
                                    <i class="flaticon-up-right-arrow"></i>
                                    <a href="{{ $project->project_link }}" class="portfolio-link" target="_blank"></a>
                                </div>
                            </div>

                        @endforeach
                            </div>
                             
                             
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- PORTFOLIO SECTION END -->
    @endif


        <!-- RESUME SECTION START -->
        <section class="resume-section" id="experience-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header wow fadeInUp" data-wow-delay=".3s">
                            <h2 class="section-title">My Experience</h2>
                        </div>


                        <div class="resume-widget">
                        
                        @foreach ($experiences as $experience)
                            <div class="resume-item wow fadeInLeft" data-wow-delay=".4s">
                                <div class="time">
                                {{ Carbon::parse($experience->durationfrom)->format('M Y') }} - 
                            @if ($experience->durationto !== NULL)
                                
                                {{ Carbon::parse($experience->durationto)->format('M Y') }}
                            @else
                                Present
                            @endif
                                </div>
                                <h3 class="resume-title">{{ $experience->role }}</h3>
                                <div class="institute">
                                    {{ $experience->company_name }}
                                </div>
                            </div>
                        @endforeach
  
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="section-header wow fadeInUp" data-wow-delay=".4s">
                            <h2 class="section-title">My Education</h2>
                        </div>
                    
                    @foreach ($educations as $education)
                        <div class="resume-widget">
                            <div class="resume-item wow fadeInRight" data-wow-delay=".5s">
                                <div class="time">
                                 {{ Carbon::parse($education->yearfrom)->format('M Y') }} -
                                
                        @if ($education->yearto !== NULL)
                                
                                {{ Carbon::parse($education->yearto)->format('M Y') }}
                            @else
                                Present
                            @endif
                                </div>
                                <h3 class="resume-title"> {{ $education->degree }} </h3>
                                <div class="institute"> {{ $education->institution_name }} </div>
                            </div>
                    @endforeach
  

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- RESUME SECTION END -->
 
    @if(!$awards->isEmpty())
        <!-- PORTFOLIO SECTION START -->
        <section class="portfolio-section" id="awards-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header text-center mb-3">
                            <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Awards & Recognition
                            </h2>
                            <p class=" wow fadeInUp" data-wow-delay=".4s">These are the awards and recognitions I have received, reflecting my achievements and contributions.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                         
                        <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                            <div class="portfolio-sizer"></div>
                            <div class="gutter-sizer"></div>
                    
                    <div class="row"> 
                        @foreach ($awards as $award)
                            
                            <div class="portfolio-item col-md-6 my-2">
                                <div class="image-box">
                        @if ($award->award_photo)
                            <img src="{{ asset('public/img/awards/'. $award->award_photo ) }}" alt="">
                        @else
                        
                            <img src="{{ asset('public/img/awards/star-award.jpg') }}" alt="">
                        @endif
                                </div>
                                <div class="content-box">
                                    <h3 class="portfolio-title">{{ $award->award_title }}</h3>
                                    <p class="limited-lines-2">{{ $award->whyreceiving }}</p>
                                    <i class="flaticon-up-right-arrow"></i> 
                                </div>
                            </div>
                            
                        @endforeach 
                        
                        </div>
                             
                           
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- PORTFOLIO SECTION END -->
    @endif

 
    @if(!$testimonials->isEmpty())
        <!-- TESTIMONIAL SECTION START -->
        <section class="testimonial-section" id="testimonials-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-header">
                            <h2 class="section-title wow fadeInLeft" data-wow-delay=".3s">What My Clients Say</h2>
                            <p class=" wow fadeInLeft" data-wow-delay=".4s">Here’s what my clients have to say about my work and the value I bring</p>
                        </div>
                    </div>

                    <div class="col-lg-10 col-xl-10 offset-xl-1">
                        <div class="testimonials-widget wow fadeInRight" data-wow-delay=".5s" data-wow-items="3">
                            <div class="owl-carousel testimonial-carousel" ata-items="3">

                        @foreach($testimonials as $testimonial)

                                <div class="testimonial-item">
                                    <div class="top-area d-flex flex-wrap justify-content-between">
                                        <div class="logo-box">
                                @if($testimonial->client_photo)
                                          
                                    <img src="{{ asset('public/img/testimonials/' . $testimonial->client_photo) }}" alt="">
                                            
                                @else
                                    
                                    <img src="{{ asset('public/img/testimonials/testmonial-client.png') }}" alt="">
                                
                                @endif
                                
                                
                                        </div> 
                                    </div>
                                    <div class="thoughts-box">
                                        <h4 class="name">{{ $testimonial->client_name }}</h4>
                                        <span class="designation mb-2">( {{ $testimonial->client_position }} )</span>
                                        <p class="quote mb-0">“{{ $testimonial->client_review }}</p>
                                        
                                    
                                    </div> 
                                     
                                    
                                                                       
                                    
                                </div>

                        @endforeach
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- TESTIMONIAL SECTION END -->    
    @endif
 
    
    @if(!$blogs->isEmpty())
        <!-- BLOG SECTION STAR -->
        <section class="blog-section" id="blogs-section">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="section-header text-center">
                            <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Recent Blogs</h2>
                            <p class=" wow fadeInUp" data-wow-delay=".4s">Check out my recent blogs, where I share insights, experiences, and expertise on various topics</p>
                        </div>
                    </div>
                </div>
                <div class="row">

                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".5s">
                            <div class="blog-thumb">
                                <a href="{{ $blog->blog_link }}" target="_blank"> 
                    @if ($blog->blog_image)
                        <img src="{{ asset('public/img/blogs/' . $blog->blog_image) }}" alt="">
                    @else
                        
                        <img src="{{ asset('public/img/blogs/blog-photo.jpg') }}" alt="">
                    
                    @endif
                                </a>
                                 
                            </div>

                            <div class="blog-content">                                 
                                <h3 class="blog-title"><a href="{{ $blog->blog_link }}" target="_blank" class="limited-lines-2">{{ $blog->blog_title }}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
                     
                </div>
            </div>
        </section>
        <!-- BLOG SECTION END -->
    @endif
 
    @if (!empty($availabilities) && $availabilities !== "No availabilities set")
    <!-- Modal -->
<div class="modal fade" id="BookSlotModal" tabindex="-1" aria-labelledby="BookSlotModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="background: #140c1c; ">
      <div class="modal-body">
          <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
          
          
        <!-- CONTACT SECTION START -->
        <section class="contact-section py-3" id="bookslot" style=" background: none; ">
            <div class="container">
                 
            <!--Calendar Starts ################-->
                <div class="row">
                    <div class="col-lg-12 col-md-12"> 
                        
                        <div class="contact-form-box wow fadeInLeft pt-2" data-wow-delay=".3s">
                            <div class="section-header mb-0">
                   
                <?php 
                $schedules = $availabilities->toArray();
                
                function CheckSchedule($schedules, $DayName, $MemberId)
                    {
                        // Filter the schedule by user_id and dayname
                        $filteredSchedule = array_filter($schedules, function ($entry) use ($DayName, $MemberId) {
                            return $entry['user_id'] == $MemberId && $entry['day'] == $DayName;
                        });
                // var_dump($filteredSchedule);
                        // Return the filtered result
                        return $filteredSchedule;
                    }
                     
                     
                    
                ?>
                              
        <form method="post" action="">       
        
            <div class="row mt-2"> 
            
                <div class="col-md-12">
                    <h3 class="">Schedule a Meeting</h3>
                   
                   <?php 
                        
                        $ServerDateNow = Carbon::now(); //Server Current Date & Time
                        
                        $UserDateNow = $ServerDateNow->setTimezone($UserTimeZone);
                        
                        $dates = [];
                        for ($i = 0; $i < 15; $i++) {
                            $dates[] = $UserDateNow->copy()->addDays($i);
                        }
                        $JumptonextDay = '';
                    ?>
                   
                    <h6 id="selectedDate">
                        Today, {{ $UserDateNow->format('F d'); }}
                        
                    </h6>
                    <hr>
                    
                </div>
                
                <div class="col-md-12">
                    <div class="available-slots" id="AvailableSlots">
                        <div class="toptags-widget wow fadeInRight mb-4" data-wow-delay=".5s" data-wow-items="3">
                            <div class="owl-carousel toptags-carousel" ata-items="3">
                                
                                <?php
                                $JumptonextDay = '';
                                ?>
                            @foreach ($dates as $date)
                            
                            <?php
                            
        $ServerDateNow = Carbon::now();
        
        $DateInMemberTZ = Carbon::parse($date)->setTimezone($memberTimeZone);
        $LoopDateInMemberTZ = $DateInMemberTZ->format('Y-m-d');
        $LoopDayNameMemberTZ = $DateInMemberTZ->format('l');
        
        $MemberDateTimeNow = Carbon::now()->setTimezone($memberTimeZone);
        $MemberCurrentDate = $MemberDateTimeNow->format('Y-m-d');
        $MemberCurrentDateTime = $MemberDateTimeNow->format('Y-m-d H:i');
        
        $MemberCurrentDateTime = $MemberDateTimeNow->addHours(2)->format('Y-m-d H').":00:00";
        
        $MemberDateTimeNow2 = Carbon::now()->setTimezone($memberTimeZone);
         
        if(isset($JumptonextDay) && $JumptonextDay != ''){
            $nextDayMemberCurrentDate = $MemberDateTimeNow2->addDay($JumptonextDay);
        } else {
            $nextDayMemberCurrentDate = $MemberDateTimeNow2->addDay();
        }
         
        
        $ReturnedSchedule = CheckSchedule($schedules, $LoopDayNameMemberTZ, $user->id);
        if(!empty($ReturnedSchedule)) {
            
            $filteredSchedule = array_values($ReturnedSchedule);
            $LoopDateStartTimeInMemberTZ = $LoopDateInMemberTZ . " " .$filteredSchedule[0]['start_time'];
            $LoopDateEndTimeInMemberTZ = $LoopDateInMemberTZ . " " .$filteredSchedule[0]['end_time'];
            
            if($LoopDateInMemberTZ == $MemberCurrentDate) {
            
                if($LoopDateEndTimeInMemberTZ > $MemberCurrentDateTime) {
                    //Slots Will Be generate
                    
                    $SlotStartDateTimeInUserTZ = Carbon::parse($LoopDateStartTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                    $SlotEndDateTimeInUserTZ = Carbon::parse($LoopDateEndTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                    
                    if($SlotStartDateTimeInUserTZ->format('Y-m-d') < $SlotEndDateTimeInUserTZ->format('Y-m-d')){
                        
                        $SetBackENdTime = $SlotEndDateTimeInUserTZ;
                        $SlotEndDateTimeInUserTZ = Carbon::parse($SlotStartDateTimeInUserTZ->format('Y-m-d') . ' 23:00:00', $UserTimeZone);
                    }
                    
                    if($SlotStartDateTimeInUserTZ->format('H:i') > '21:00'){
                        $SlotStartDateTimeInUserTZ = Carbon::parse($SetBackENdTime->format('Y-m-d') . ' 00:00:00', $UserTimeZone);
                        $SlotEndDateTimeInUserTZ = $SetBackENdTime;
                    }
                    
                    $dayDisplay = 'Today';
                    $activeClass = "active";
                    $todayClass = "today";
                    
                } else {
                   
                    // Loop Will be Continue
                    
                    $JumptonextDay = 1;
                    continue;
                }
                
            } elseif($LoopDateInMemberTZ == $nextDayMemberCurrentDate->format('Y-m-d') && $JumptonextDay > 0){
                
                
                
                $dayDisplay = 'Today';
                $activeClass = "active";
                $todayClass = "today";
                $SlotStartDateTimeInUserTZ = Carbon::parse($LoopDateStartTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                $SlotEndDateTimeInUserTZ = Carbon::parse($LoopDateEndTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                if($SlotStartDateTimeInUserTZ->format('Y-m-d') < $SlotEndDateTimeInUserTZ->format('Y-m-d')){
                    
                    $SetBackENdTime = $SlotEndDateTimeInUserTZ;
                    $SlotEndDateTimeInUserTZ = Carbon::parse($SlotStartDateTimeInUserTZ->format('Y-m-d') . ' 23:00:00', $UserTimeZone);
                }
                
                if($SlotStartDateTimeInUserTZ->format('H:i') > '21:00'){
                    $SlotStartDateTimeInUserTZ = Carbon::parse($SetBackENdTime->format('Y-m-d') . ' 00:00:00', $UserTimeZone);
                    $SlotEndDateTimeInUserTZ = $SetBackENdTime;
                }
                
                
            } else { //Date is not Same
            
                $dayDisplay = $activeClass = $todayClass = "";
                $SlotStartDateTimeInUserTZ = Carbon::parse($LoopDateStartTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                $SlotEndDateTimeInUserTZ = Carbon::parse($LoopDateEndTimeInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
                if($SlotStartDateTimeInUserTZ->format('Y-m-d') < $SlotEndDateTimeInUserTZ->format('Y-m-d')){
                    $SetBackENdTime = $SlotEndDateTimeInUserTZ;
                    $SlotEndDateTimeInUserTZ = Carbon::parse($SlotStartDateTimeInUserTZ->format('Y-m-d') . ' 23:00:00', $UserTimeZone);
                }
                if($SlotStartDateTimeInUserTZ->format('H:i') > '21:00'){
                    $SlotStartDateTimeInUserTZ = Carbon::parse($SetBackENdTime->format('Y-m-d') . ' 00:00:00', $UserTimeZone);
                    $SlotEndDateTimeInUserTZ = $SetBackENdTime;
                }
            }
            
        } else{ // Schedule Is Empty
        
            $SlotStartDateTimeInUserTZ = Carbon::parse($LoopDateInMemberTZ, $memberTimeZone)->setTimezone($UserTimeZone);
        }
                                
                            ?>
                    <div class="date-item">            
                                    
                        @if(!empty($ReturnedSchedule)) 
                            <button type="button" class="date-slot  {{ $activeClass }} {{ $todayClass }}" 
                                    data-date="{{ $SlotStartDateTimeInUserTZ->format('Y-m-d') }} 00:00:00" 
                                    data-starttime="{{ $SlotStartDateTimeInUserTZ->format('H:i:s') }}"
                                    data-endtime="{{ $SlotEndDateTimeInUserTZ->format('H:i:s') }}"  
                                @if(!empty($filteredSchedule[1]))
                                    data-starttime2="{{ $filteredSchedule[1]['start_time'] }}"
                                    data-endtime2="{{ $filteredSchedule[1]['end_time'] }}"
                                @endif
                            >
                        @else
                            <button type="button" class="date-slot unavailable" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="No available slots on this day">
                        @endif
                                
                                <h3 class="resume-title mb-1" style="font-size: 16px;">{{ $SlotStartDateTimeInUserTZ->format('D') }}</h3>
                                <h3 class="resume-title h4 mb-0"> {{ $SlotStartDateTimeInUserTZ->format('d') }} </h3>  
                            </button>
                                    
                    </div>
                    
                    <?php
                        if(empty($ReturnedSchedule)) { 
                            if($JumptonextDay != ''){
                                $JumptonextDay = $JumptonextDay + 1;
                            } else {
                                $JumptonextDay = 1;
                            }
                            
                            continue;
                        }
                    ?>
                    
                @endforeach
                
                                    
                            </div>
                        </div>
                    
                    
                    
                        
                    <div class="d-flex flex-wrap justify-content-center" id="timesloats"></div>
                    
                    
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                 
              @if($timezones)     
              
              <h6>Time zone</h6>
                <div class="form_group position-relative d-flex align-items-center">
                     <i class="fa-solid fa-earth-asia" style="font-size: 16px; position: absolute; z-index: 8; left: 5px;"></i>
                    <select name="timezoneId" id="timezoneid" class="ps-4 normal"  style="z-index: 999" >
                            
                        @foreach($timezones as $timezone)
                            <?php  
                            $formattedOffset = preg_replace('/^([+-])0(\d)/', '$1$2', $timezone->value); //Without 0
                            if($formattedOffset == $UserTimeZone){
                            ?>
                                <option value="{{ $timezone->value }}" selected> {{ $timezone->name }} </option>
                            <?php } else { ?>
                                <option value="{{ $timezone->value }}"> 
                                    {{ $timezone->name }} </option>
                            <?php } ?>
                        @endforeach
                            
                    </select>
                </div>
                @endif
                    <!--<p>Member Timezone : {{ $memberTimeZone }} </p>-->
                    <!--<p>User Selected Timezone : {{ $UserTimeZone }} </p>-->
                    
                        </div>
                    </div>
                    
                        
                    
                </div>
                    
                </div>
                
                
                <div class="col-md-12" >
                    
                    
                    
                    
                </div>
                <div class="col-md-12" id="ConfirmMeeting" style="display:none">
                   
                   <div class="row">
                       <div class="col-md-12" id="booking-info">
                           <a href="javascript:void(0);" id="backbtn" class="btn btn-outline-primary px-2 py-0 mb-3"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                   </div>
                   
                    <div class="row align-items-center text-center g-2">
                        <div class="col-md-12 col-lg-12 col-xl-4">
                            <div class="detail-card">
                                <i class="far fa-clock"></i>
                                <h5>Duration</h5>
                                <p class=" mb-0">30 Minutes</p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-4">
                            <div class="detail-card">
                                <i class="far fa-calendar"></i>
                                <h5>Date &amp; Time</h5>
                                <p class=" mb-0">
                                    <span id="SelectedStartTime"></span>
                                    - 
                                    <span id="SelectedEndTime"></span>
                                </p>
                                <p class=" mb-0" id="SelectedDate"></p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-4">
                            <div class="detail-card">
                                <i class="fa-solid fa-earth-americas"></i>
                                <h5>Time zone</h5>
                                <p class="mb-0" id="location-selectedtimezone"></p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12 mt-4">
                            <div class="d-flex justify-content-center">
                                <img class="w-6 h-6" src="https://pro-schedule.w3bd.com/images/svg/event-locations/google-meet.svg" width="40px"> &nbsp; &nbsp;  <h5 class="mb-0" style=" line-height: inherit; ">Google Meet</h5>
                            </div>
                             
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12 pt-4 ">
                             <a href="javascript:void(0);" class="btn tj-btn-primary-new px-5 py-3 mb-3" id="confirmbookingslot"> Book Now <i class="fa fa-arrow-right"></i></a>
                             
                             <p class="d-none text-success" id="successmsg"></p>
                             <p class="d-none text-danger" id="errormsg"></p>
                        </div>
                    </div>
                    
                    
                    
                   
                   
                    
                </div>
                
                
                
            </div>
            
        </form>
         
                              
                            </div>
                        </div>
                        
                    </div>
 
                </div>  
                <!--Calendar Ends ################-->
                
            </div>
        </section>
        
        
    </div><!--Modal Ends-->
    
    </div>
  </div>
</div> 
        
    @endif 
    <!--When Use has Availabilities-->
        
        <!-- CONTACT SECTION START -->
        <section class="contact-section" id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        
                        <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-header w-100" style="max-width: inherit;">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        
        <?php
        
        $toemail = session('email'); 
        $toname = session('name'); 
        
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/smtpmailfun.php');

$maildata = array();

$maildata["sender"] = array(
                "email" => "info@wahstory.com",
                "name" => "WAHStory" 
                );
                
$maildata["receiver"] = array(
                array(
                    "email" => $toemail,
                    "name" => $toname
                    )
                );
                
    $maildata["subject"] = "Welcome to WAHClub - We are Excited to Connect";
    
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    Welcome to WAHClub! | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 15px;"> Dear '. $toname .', </p> 
            		
            		<p style="font-size: 15px;"> Thank you for reaching out to <strong>WAHClub</strong>!</p>
            		<p style="font-size: 15px;"> Your query has been received, and '. $user->title .' '. $user->firstname .' '. $user->lastname .' will be in touch with you soon to explore how you can collaborate and bring your ideas to life. </p>
            		<p style="font-size: 15px; margin-bottom: 10px;"> In the meantime, you can also join and become a member of <strong>WAHClub</strong> by signing up here:
            		 </p>
            		 <br>
            		<a href="https://www.wahstory.com/getmeinwahclub.php" style="background: #df2853;display: inline;padding: 10px;font-weight: 700;border-radius: 5px; color: #fff !important; text-decoration: none;" target="_blank"> Sign Up </a>
            		<br>
            		<br>
            		<p style="font-size: 15px;">
            		    Stay tuned for exciting updates from our community!  
            		    </p> 
            		<p style="font-size: 15px;"> If you have any questions, do not hesitate to reply to this email <a href="mailto:info@wahstory.com">info@wahstory.com</a> - we are here to help!  </p> 
            		<p style="font-size: 15px;"> We are here to support you! </p> 
            		  
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> Team WAHStory</p>
            		
                    
                    </body>
                    </html>';
     
echo SendMailBySMTP($maildata); 



$fullname = $user->firstname .' '. $user->lastname;

$maildata2 = array();

$maildata2["sender"] = array(
                "email" => "info@wahstory.com",
                "name" => "WAHStory" 
                );
                
$maildata2["receiver"] = array(
                array(
                    "email" => $user->email,
                    "name" => $fullname
                    )
                );
                
    $maildata2["subject"] = "New Query Received on WahClub!";
    
        $maildata2['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    Welcome to WAHClub | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 15px;"> Dear '. $user->firstname .' '. $user->lastname .', </p> 
            		 
            		<p style="font-size: 15px;">You have received a new query on WAHClub! Someone is interested in connecting with you and exploring collaboration opportunities.  </p>
            		<p style="font-size: 15px; margin-bottom: 10px;"> Please log in to your WAHClub account to view and respond to the query.  </p>
            		
            		<br>
            		<a href="https://www.wahstory.com/login" style="background: #df2853;display: inline;padding: 10px;font-weight: 700;border-radius: 5px; color: #fff !important; text-decoration: none;" target="_blank"> Log In </a>
            		<br>
            		<br>
            		
            		
            		<p style="font-size: 15px;"> If you have any questions, do not hesitate to reply to this email <a href="mailto:info@wahstory.com">info@wahstory.com</a> - we are here to help you!  </p>   
            		  
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> Team WAHStory</p>
                    
                    </body>
                    </html>';
     
echo SendMailBySMTP($maildata2);

?>
        
        
        
    </div>
@endif


                                 
                                 <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="section-title">Let’s work together!</h2>
                                    </div>
                                    <div class="col-md-4 text-end">
                                 
                                    </div>
                                </div>
                                <p>I’m excited to connect with you. I’ll reach out soon to explore how we can work together and bring our ideas to life!
                                </p>
                            </div>

                            <div class="tj-contact-form">
                    
                    @if ($isLoggedIn && $isPaidUser)
                                <form action="{{ url('letsconnectformsubmit') }}" method="post" id="sendmessageform">
                                    @csrf
                            <input type="hidden" name="UserIDCurrent" value="{{ $user->id }}">
                                    
                                    <div class="row gx-3">
                                        <div class="col-sm-6">
                                            <div class="form_group">
                                                
                                                <input type="text" name="fname" id="fname" placeholder="First name"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form_group">
                                                <input type="text" name="lname" id="lname" placeholder="Last name"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form_group">
                                                <input type="email" name="email" id="email" placeholder="Email address"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form_group">
                                                <input type="tel" name="phone" id="phone" placeholder="Phone number"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form_group">
                                                <textarea name="message" id="message" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form_btn">
                                                <button type="submit" id="sendmessage" class="btn tj-btn-primary">Send Message</button> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                    @else
                    
                        <div class="row gx-3">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <input type="text" placeholder="First name"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <input type="text" placeholder="Last name"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <input type="email" placeholder="Email address"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <input type="tel" placeholder="Phone number"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form_group">
                                    <textarea placeholder="Message"></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="col-12">
                                <div class="form_btn">
                                    @if ($isLoggedIn)
                                        @if (!$isPaidUser)
                                        <button type="button" data-bs-target="#paidFeature" data-bs-toggle="modal" class="btn tj-btn-primary">Send Message</button>
                                        @endif
                                    @else
                                        <button type="button" data-bs-target="#loginModal" data-bs-toggle="modal" class="btn tj-btn-primary">Send Message</button>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    
                    @endif
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
        </section>
        <!-- CONTACT SECTION END -->
    </main>

    <!-- FOOTER AREA START -->
    <footer class="tj-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-logo-box">
                        <a href="/"><img src="https://www.wahstory.com/images/logos/logo-white.png" alt=""></a>
                    </div>
                    <div class="footer-menu">
                        <nav>
                            <ul>
                                <li><a href="/wahclub/"><i class="fa fa-home"></i></a></li>
                                <li class="current-menu-ancestor"><a href="#aboutme-section">About Me</a></li>
                                <li><a href="#skills-section">Skills</a></li> 
                            @if(!$projects->isEmpty())
                                <li><a href="#works-section">Projects</a></li>
                            @endif
                                <li><a href="#experience-section">Experience</a></li>
                            
                            @if(!$awards->isEmpty())
                                <li><a href="#awards-section">Awards</a></li>
                            @endif
                            @if(!$testimonials->isEmpty())
                                <li><a href="#testimonials-section">Testimonials</a></li>
                            @endif
                            @if(!$blogs->isEmpty())
                                <li><a href="#blogs-section">Blogs</a></li> 
                            @endif
                            @if($isLoggedIn)
                                <li><a href="/users/" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @else
                                <li><a href="/login?rurl={{ request()->getRequestUri() }}" title="My Account"><i class="fa fa-user-vneck"></i></a></li>
                            @endif

                            </ul>
                        </nav>
                    </div>
                    <div class="copy-text">
                        <p>&copy; {{ now()->format('Y') }} All rights reserved</p>
                @if(!$isLoggedIn) 
                        <div class="fixed-button">
                            
                            <a href="https://www.wahstory.com/getmeinwahclub.php" target="_blank" class="btn tj-btn-primary px-3 small"  style="gap: 3px;"><i class="fa-regular fa-star fa-spin" style=" transform: none; "></i>Build Your Profile</a>
                            
                        </div>
                @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->
    
    
    
        <!-- start: Portfolio Popup -->
        <div id="portfolio-wrapper" class="popup_content_area zoom-anim-dialog mfp-hide">
            <div class="popup_modal_content">
                 <div class="portfolio_description mt-0">
                    <h2 class="title">{{ $story->title }} </h2>
                    
                </div> 
                <div class="portfolio_story_approach d-block">
                    <div class="portfolio_story d-block">
                         
                        <div class="story_content" style=" width: 100%; max-width: inherit; ">
                            {!! $story->storycontent !!}
                             
                        </div>
                    </div>
                </div>

                <div class="portfolio_navigation">
                    
                    
                </div>
            </div>
        </div>
        <!-- end: Portfolio Popup -->




<!-- Modal -->
<div class="modal fade" id="getConnect" tabindex="-1" aria-labelledby="getConnectLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #140c1c; ">
      
      <div class="modal-body">
          <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
        
        <div class="row">
            <div class="col-lg-12">
                
                <h3 class="h5"> Get Connected First!</h3>
                
                <p class="small"> Please be a connection first in order to book a slot.
                </p>
                
            </div>
           
        </div>
        
      </div>
      
    </div>
  </div>
</div> 


<!-- Modal -->
<div class="modal fade" id="paidFeature" tabindex="-1" aria-labelledby="paidFeatureLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #140c1c; ">
      
      <div class="modal-body">
          <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
        
        <div class="row">
            <div class="col-lg-12">
                
                <h3 class="h5"> Welcome to WAHClub</h3>
                
                <p class="small"> Please upgrade your account to unlock exclusive features.
                </p>
                
            </div>
            
            <div class="col-lg-12">
                @if(isset($_SESSION['userid']))
                    <a href="/users/subscriptionplan.php?rurl={{ request()->getRequestUri() }}&&clubid={{ $loggedinUser->id }}" class="btn tj-btn-primary p-3"><i class="fa-solid fa-stars" style="transform: none;"></i>  Upgrade Now</a>
                @else
                    <a href="/login?rurl=/wahclub/" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Login to Connect</a>
                
                @endif
            </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div> 


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #140c1c; ">
       
      <div class="modal-body">
          <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
        
        <div class="row">
            <div class="col-lg-12">
                
                <h3 class="h5"> Welcome to WAHClub</h3>
                
                <p class="small"> Login & become a WAHClub member for professional recommendations, real-time engagement & other exclusive features.
                </p>
                
            </div>
            
            <div class="col-lg-12">
                @if(isset($_SESSION['userid']))
                    <a href="/users/" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Get me in WAHClub</a>
                @else
                    <a href="/login?rurl={{ request()->getRequestUri() }}" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Login to Connect</a>
                
                @endif
            </div>
        </div>
        
      </div>
      
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
      
    </div>
  </div>
</div> 




    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #140c1c; ">
            
          <div class="modal-body">
              <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-times"></i>
              </button>
            
            <div class="row">
                <div class="col-lg-12">
                    <video width="100%" height="500px" style="border-radius: 10px; " controls>
                        <source src="{{ asset('public/img/pratham-vdo.mp4') }}" type="video/mp4">
                        <source src="{{ asset('public/img/pratham-vdo.ogg') }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            
          </div>
          
        </div>
      </div>
      
    </div> 


    <!-- CSS here -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script> 
    <script src="{{ asset('public/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('public/js/backToTop.js') }}"></script>
    <script src="{{ asset('public/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('public/js/appear.min.js') }}"></script>
    <script src="{{ asset('public/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/js/gsap.min.js') }}"></script>
    <script src="{{ asset('public/js/one-page-nav.js') }}"></script>
    <script src="{{ asset('public/js/lightcase.js') }}"></script>
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/js/odometer.min.js') }}"></script>
    <script src="{{ asset('public/js/magnific-popup.js') }}"></script>

    <script src="{{ asset('public/js/main.js') }}"></script>
      
<script>
    document.getElementById('ShareProfile').addEventListener('click', function() {
        // Create a temporary input element
        const tempInput = document.createElement('input');
        // Set its value to the current URL
        tempInput.value = window.location.href;
        // Append it to the body
        document.body.appendChild(tempInput);
        // Select the input value
        tempInput.select();
        // Copy the selected text to the clipboard
        document.execCommand('copy');
        // Remove the temporary input element
        document.body.removeChild(tempInput);
         
        const lispan = $('#shareprofileli span');
        
            lispan.css("display", "block").hide().fadeIn();
         
         // Change the icon to a checkmark and animate
        $('#ShareProfile').html('<i class="fa-regular fa-check"></i>').hide().fadeIn();
    
        // Set a timeout to change back to the share icon
        setTimeout(() => {
            $('#ShareProfile').fadeOut(() => {
                $(this).html('<i class="fa-regular fa-share-nodes"></i>').fadeIn();
            });
            
            // Hide the span after 5 seconds with a fade-out effect
            setTimeout(() => {
                lispan.fadeOut();
            }, 1000);
        }, 2000);
        
        
        // Optionally alert the user
    });
</script>



<script>
        $(document).ready(function() {
            $('#sendmessageform').on('submit', function(event) {
                // Disable the submit button
                $('#sendmessage').prop('disabled', true);
                 
                $('#sendmessage').html('<i class="fa-sharp fa-regular fa-spinner fa-spin"></i> Sending...');
 
            });
             
    @if (!empty($availabilities) && $availabilities !== "No availabilities set")
    
            var selectedtimezone = document.getElementById('timezoneid');
            
            var LOCselectedtimezone = document.getElementById('location-selectedtimezone');
            LOCselectedtimezone.innerHTML = selectedtimezone.options[selectedtimezone.selectedIndex].text;
            
    @endif
            
    @if($isPaidUser) // Any User You are Loggedin
    //TO SHow INTRO TOP VIDEO ON PROFILE PHOTO ##################
            $('.video-play-btn').click(function(){
                $('.userProfilePhoto').fadeTo(100, 0);
                $('.video-overlay').fadeIn();
                $('.video-close-btn').fadeIn();
                $('.video-play-btn').hide();
            });
            $('.video-close-btn').click(function(){
                $('.userProfilePhoto').fadeTo(0, 100);
                $('.video-close-btn').fadeOut();
                $('.video-overlay').fadeOut();
                $('.video-play-btn').show();
            });
     @endif     
            
                
        }); 
    
</script>



@if(isset($_SESSION['userid']))
    <script>
        $(document).ready(function(){
             
            $('.connectprofile-btn').click(function(){
            var clubmemberid = $(this).data("memberid");
            
            var useremail = "{{ $_SESSION['email'] }}"; 
            
            var $button = $(this);
            
                $button.find('.fa-plus').remove();
                
                
            event.preventDefault();
            $button.off('click');
            $button.addClass('disabled');
            
             $button.append(" <i class='fa fa-spinner fa-spin'></i>");
            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
                $.ajax({
                    url: '/wahclub/connectwithclubmember', // Route to your method
                    type: 'POST',
                    data: JSON.stringify({
                        memberid: clubmemberid,
                        useremail: useremail
                    }), 
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Include CSRF token in the request header
                    },
                    success: function(response) {
                        
                        if(response.status == 'success') {
                            $button.next('.pending-connection').css("display", "block"); 
                            $button.css("display", "none"); 

                        }
                        
                        console.log(response.message);
                    },
                    error: function(xhr) {
                      alert('Error: ' + xhr.responseJSON.message);
                    }
              });
                  
            })
        });
    </script>
@endif


@if (!empty($availabilities) && $availabilities !== "No availabilities set")

 <script>
  
   $(document).ready(function ($) {
		
    /*------------------------------------------------------
        // category Carousel
  	/------------------------------------------------------*/
  	
  	    $(".toptags-carousel.owl-carousel").owlCarousel({
			loop: false,
			margin: 30,
			nav: true,
			dots: false,
			autoplay: false,
			active: true, 
			smartSpeed: 1000, 
			responsive: {
				0: {
					items: 2.5,
				},
				600: {
					items: 3,
				},
				1000: {
					items: 4,
				},
				1400: {
					items: 4,
				},
			},
			onTranslated:callBack
			
		});
		
		function callBack(){ 
             if ( this.currentItem == 0 ) {
              $('.owl-carousel .owl-prev').addClass('disabled');
            }
        }
         
	/*------------------------------------------------------
        // category Carousel
  	/------------------------------------------------------*/
	var dateSlot = document.querySelectorAll('.date-slot');
		
	$(dateSlot).click(function (){
	        
	  //Check if the slot is available for the day     
	   if ($(this).data("date")) { 
	       
	        $(dateSlot).removeClass("active");
	        $(this).addClass("active");
	       
	        var datestr = $(this).data("date");
	        
	        var starttime = $(this).data("starttime");
	        var endtime = $(this).data("endtime");
	        
	            if ($(this).data("starttime2")) {
	                var starttime2 = $(this).data("starttime2");
	                var endtime2 = $(this).data("endtime2");
	            }
	            
	        var startdatetime = datestr.split(' ')[0] + ' ' + starttime;
	        var enddatetime = datestr.split(' ')[0] + ' ' + endtime;
	       
	        let timezoneA = '{{ $memberTimeZone }}';  //Member Timezone
            let timezoneB = '{{ $UserTimeZone }}';  //User Selected Timezone
            // var timezoneB = document.getElementById('timezoneid').value;
       
            // let startdatetimeA = convertTimezone(startdatetime, timezoneA, timezoneB);
            // let enddatetimeA = convertTimezone(enddatetime, timezoneA, timezoneB);
	        //function
	       // GenerateTimeSlots(startdatetimeA, enddatetimeA);
	       
	       var newStartTime = addMoreHoursInStartTime(startdatetime, timezoneB);
	       
	       GenerateTimeSlots(newStartTime, enddatetime);
	        
	        var dateISO = datestr.replace(' ', 'T');
	        var date = new Date(dateISO);
	        
	        var currentDate = new Date();
	        
	        currentDate.setHours(0, 0, 0, 0);
	        date.setHours(0, 0, 0, 0);
	        
	        var weekday = date.toLocaleString('en-US', {weekday : 'long'});
	        var month = date.toLocaleString('en-US', {month : 'long'});
	        var day = String(date.getDate()).padStart(2, '0');
	        
	        var formattedDate = (currentDate.getTime() === date.getTime()) ? `Today, ${month} ${day}` : `${weekday}, ${month} ${day}`;
	        
	        var selectedDate = document.getElementById("selectedDate");
	        selectedDate.innerHTML = formattedDate;
	        
	    } //Check if the slot is available for the day ends   
	        
	        var timeSlots = document.querySelectorAll('.time-slot');
    	    $(timeSlots).click(function(){
    	        $('#AvailableSlots').hide();
    	        $('#ConfirmMeeting').show();
    	        
    	        var datatime = $(this).data('time');
    	        var datadate = $(this).data('date');
    	        //function
    	        SelectTimeSlot(datatime, datadate); 
    	    });
	        
	    }); //Date SLot Click Ends
	    
	    $('[data-bs-toggle="tooltip"]').tooltip();
	    
	    var backbtn = document.getElementById("backbtn");
        $(backbtn).click(function(){
            $('#ConfirmMeeting').hide();
            $('#AvailableSlots').show();
        });
        
    });//Document Ready Ends
    
    <?php 
       
        if(isset($bookedslots) && !empty($bookedslots)) {
           $start_times = $bookedslots->pluck('start_time')->toArray();
            // Convert the array of start times to a JavaScript array
            $start_times_js = json_encode($start_times);
        } else {
            $start_times_js = json_encode([]); // Return an empty array if $bookedslots is not set or not an array
        }
    ?>
    
    function GenerateTimeSlots (StartTimeG, EndTimeG) {
         
        let StartTime = new Date(StartTimeG);
        let EndTime = new Date(EndTimeG);
        
        
        let slotbox = document.getElementById("timesloats");
            slotbox.innerHTML = '';
        
        while(StartTime < EndTime) {
            
        //Booked Hour Slot
            var bookedSlotTime = StartTime.toTimeString().split(' ')[0];
            var bookedSlotDate = StartTime.toLocaleDateString('en-CA').split('T')[0];
             
             var BookedSlotDateTime = bookedSlotDate + ' ' + bookedSlotTime;
             
            formattedTime = StartTime.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            })
            
            var bookedSlots = <?= $start_times_js ?>;
           
            if(bookedSlots.includes(BookedSlotDateTime)) {
                
                let Bookedslot = document.createElement("button");
                Bookedslot.classList.add("Bookedtime-slot");
                Bookedslot.setAttribute("type", "button");
                Bookedslot.textContent = formattedTime;
            
                slotbox.appendChild(Bookedslot);
                
                StartTime.setMinutes(StartTime.getMinutes() + 30);
                continue;
            }
            
             
            let slot = document.createElement("button");
                slot.classList.add("time-slot");
                slot.setAttribute("type", "button");
                slot.setAttribute("data-date", StartTime.toLocaleDateString('en-CA').split('T')[0]);
                slot.setAttribute("data-time", StartTime.toTimeString().split(' ')[0]);
                slot.textContent = formattedTime;
            
            slotbox.appendChild(slot); 
            StartTime.setMinutes(StartTime.getMinutes() + 30);
        }
    }
   
   
    window.onload = function(){
        
       var dateSlotActive = document.querySelector(".date-slot.active");
       
       var starttime = $(dateSlotActive).data("starttime");
       var endtime = $(dateSlotActive).data("endtime");
       var date = $(dateSlotActive).data("date");
       
       var StartTimeG = date.split(' ')[0] + ' ' + starttime;
	   var EndTimeG = date.split(' ')[0] + ' ' + endtime;
       
    
        let timezoneA = '{{ $memberTimeZone }}';  //Member Timezone
        let timezoneB = '{{ $UserTimeZone }}';  //User Selected Timezone
       
        let startdatetimeA = convertTimezone(StartTimeG, timezoneA, timezoneB);
            //User Selected Time is this
        let enddatetimeA = convertTimezone(EndTimeG, timezoneA, timezoneB);
       
        var newStartTime = addMoreHoursInStartTime(StartTimeG, timezoneB);
        
       //function
       GenerateTimeSlots(newStartTime, EndTimeG);
       
       var timeSlots = document.querySelectorAll('.time-slot');
	    
	    $(timeSlots).click(function(){
	        $('#AvailableSlots').hide();
	        $('#ConfirmMeeting').show();
	        
	        var datatime = $(this).data('time');
	        var datadate = $(this).data('date');
	        //function
	        SelectTimeSlot(datatime, datadate);
	    });
    }
    
    
    function SelectTimeSlot(datatime, datadate){
          
    	const options = { hour: '2-digit', minute: '2-digit', hour12: true };
    	        
	    var fullDateTimeString = datadate + 'T' + datatime;
        var startdate = new Date(fullDateTimeString);
                
        var SelectedStartTime = document.getElementById("SelectedStartTime");
        SelectedStartTime.innerHTML = startdate.toLocaleTimeString('en-US', options); 
    	        
        var endtime = new Date(startdate);
        endtime.setMinutes(startdate.getMinutes() + 30); 
    	        
        var SelectedEndTime = document.getElementById("SelectedEndTime");
        SelectedEndTime.innerHTML = endtime.toLocaleTimeString('en-US', options);
    
        const dateoptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var SelectedDate = document.getElementById("SelectedDate");
        SelectedDate.innerHTML = startdate.toLocaleDateString('en-US', dateoptions);
        
    // Newly Addedd for Booking Confirmation
        SelectedDate.setAttribute('data-date', startdate);
    // Newly Addedd for Booking Confirmation
        
    }
    
  </script>
    
    <script>
        $('#timezoneid').change(function(){
            var timezoneB = document.getElementById('timezoneid').value;
            
            var timezoneA = '{{ $memberTimeZone }}';
            //var timezoneB = '{{ $UserTimeZone }}'; // Selected Timezone
            
            var dateSlotActive = document.querySelector(".date-slot.active");
       
            var starttime = $(dateSlotActive).data("starttime");
            var endtime = $(dateSlotActive).data("endtime");
            var date = $(dateSlotActive).data("date");
            
            var StartTimeG = date.split(' ')[0] + ' ' + starttime;
	        var EndTimeG = date.split(' ')[0] + ' ' + endtime;
              
            
            let startdatetimeA = convertTimezone(StartTimeG, timezoneA, timezoneB);
            let enddatetimeA = convertTimezone(EndTimeG, timezoneA, timezoneB);
            
            var newStartTime = addMoreHoursInStartTime(startdatetimeA, timezoneB); 
            
             //function
            GenerateTimeSlots(newStartTime, enddatetimeA);
            
            
        
       //function
    //   GenerateTimeSlots(newStartTime, EndTimeG);
            
            
            var timeSlots = document.querySelectorAll('.time-slot');
        	    $(timeSlots).click(function(){
        	        $('#AvailableSlots').hide();
        	        $('#ConfirmMeeting').show();
        	        
        	        var datatime = $(this).data('time');
        	        var datadate = $(this).data('date');
        	        //function
        	        SelectTimeSlot(datatime, datadate); 
        	    });
            
        })
    </script>
    
    <script>
        function convertTimezone(datetime, timezoneA, timezoneB) {
            
            let [datePart, timePart] = datetime.split(" ");
            let [year, month, day] = datePart.split("-").map(Number);
            let [hours, minutes, seconds] = timePart.split(":").map(Number);
         
            let offsetA = parseInt(timezoneA.split(':')[0]) * 60 + parseInt(timezoneA.split(':')[1]);
            let offsetB = parseInt(timezoneB.split(':')[0]) * 60 + parseInt(timezoneB.split(':')[1]);
        
            let date = new Date(Date.UTC(year, month - 1, day, hours, minutes, seconds));
            
            date.setUTCMinutes(date.getUTCMinutes() - offsetA);
        
            date.setUTCMinutes(date.getUTCMinutes() + offsetB);
        
            let formattedDate = date.toISOString().replace('T', ' ').substring(0, 19);
            return formattedDate;
        }
         

    </script>
    
    
    <script>
        function addMoreHoursInStartTime(startTime, timezoneOffset) {
            // const currentTime = new Date();
            
            var currentTimeWithOffset = getTimeWithOffset(timezoneOffset);
            currentTimeWithOffset = new Date(currentTimeWithOffset);
            
            let startTimeInNewTimezone = new Date(startTime);
    
            // If the start time is in the past, add 2 hours
            if (startTimeInNewTimezone <= currentTimeWithOffset) {
                startTimeInNewTimezone = new Date(currentTimeWithOffset);
                startTimeInNewTimezone.setHours(currentTimeWithOffset.getHours() + 2);
                startTimeInNewTimezone.setMinutes(00);
                startTimeInNewTimezone.setSeconds(00);
            }
            
            return startTimeInNewTimezone;
        }
        
        
    
        function getTimeWithOffset(offset) {
            
            const currentTime = new Date();
            
            offset = offset.replace(/^([+-])(\d{1})(?=:)/, (match, sign, hour) => {
                return `${sign}${hour.padStart(2, '0')}`;
            });
                
            const options = {
                timeZone: `${offset}`,
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
            };
        
            const formattedTime = currentTime.toLocaleString('en-US', options);
            const [datePart, timePart] = formattedTime.split(', ');
            const [month, day, year] = datePart.split('/');
            const [hour, minute, second] = timePart.split(':');
            const formattedDate = `${year}-${month}-${day} ${hour}:${minute}:${second}`;
        
            return formattedDate;
        }
        
         
    </script>
    
    <script>
    
    $(document).ready(function(){
    
      $('#confirmbookingslot').click(function(){
          
          var bookbtn = $(this);
          
          bookbtn.addClass('disabled');
          bookbtn.html('Booking... <i class="fa fa-spinner fa-spin"></i>');
          
          setTimeout(() => {
              bookbtn.html('Book Now <i class="fa fa-arrow-right"></i>');
              bookbtn.removeClass('disabled');
          }, 5000); // 5 seconds
          
          
        
        var rawDateString = document.getElementById("SelectedDate").getAttribute("data-date");
        var ConfirmedDateTimeZone = document.getElementById("timezoneid").value;
        
        
         var cleanedDateString = rawDateString.replace(/\s\([^)]+\)$/, "");

        // Convert the cleaned date string into a JavaScript Date object
        var ConfirmedDateTime = new Date(cleanedDateString).toISOString(); // ISO format

        
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/wahclub/bookaslot', // Route to your method
            type: 'POST',
            data: JSON.stringify({
                memberslug: '{{ $user->slug_username }}',
                slottime: ConfirmedDateTime,
                slottimezone: ConfirmedDateTimeZone
            }), 
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken  // Include CSRF token in the request header
            },
            success: function(response) {
                
                if(response.status == 'success') {
                    // console.log(response.message);
                     window.location.href="/wahclub/thankyoutest";
                    
                    $('#successmsg').removeClass('d-none');
                    $('#successmsg').html(response.message);
                    
                    
                } else {
                    console.log(response.message);    
                    
                    $('#errormsg').removeClass('d-none');
                    $('#errormsg').html(response.message);
                    setTimeout(() => {
                      $('#errormsg').addClass('d-none');
                  }, 5000); // 5 seconds
                    
                }
                
                
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);  // Log the detailed error response
                alert('Error: ' + xhr.responseText);  // Show the error message
              }
        });
      
      });
      
    });
        
    </script>
    
    @endif 
        <!--As it ends for Sloting User-->
    
     
   
</body>

</html>