<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site Title -->
    <title>WAHClub - Home </title>
    <meta name="google-site-verification" content="m8zRMuKQzYkETGdmizTe1nIwH0o1rfBiToDEA6WIQck" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="https://www.wahstory.com/images/wah_fav.ico" />
    <link rel="shortcut icon" type="image/png" href="https://www.wahstory.com/images/wah_fav.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
    <!--V2 css -->
    <link rel="stylesheet" href="{{ asset('public/cssv2/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/cssv2/category-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/cssv2/card-slider.css') }}">
    <style>
        body {
            background-color: var(--tj-theme-accent-1) !important;
        }
        .hometopsearch input {
            background: var(--tj-theme-accent-1) !important;
        }
        .header-top {
            position: absolute;
            background-color: transparent;
            width: 100%;
            z-index: 99;
            padding: 30px 0 20px;
            position: relative;
        }
        .vertical-topcats {
            position: relative;
        }
        
        .topcats-overlay {
            width: 100%;
            height: 100%;
            display: block;
            position: absolute;
            z-index: 11;
            border-radius: 10px;
        }
        
        .skeleton {
              background-color: #110817;
              border-radius: 4px;
              margin-bottom: 12px;
              overflow: hidden;
            }
        
            .skeleton::after {
              content: '';
              position: absolute;
              top: 0;
              left: -100%;
              height: 100%;
              width: 100%;
              background: linear-gradient(to right, transparent 0%, rgba(255,255,255,0.5) 50%, transparent 100%);
              animation: loading 2s infinite;
              z-index: 11;
            }
        
            @keyframes loading {
              100% {
                left: 100%;
              }
            }
        
    </style>
    
    </head>
    <body>
    
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    
    <!-- HEADER START -->
    <header class="tj-header-area header-absolute">
        
        <div class="container">
            
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center justify-content-between">

                    <div class="logo-box">
                        <a href="/" title="Logo">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="WAHStory">
                        </a>
                    </div>
 

                    <div class="header-menu">
                        <nav>
                        <form action="{{ route('search-results') }}" method="get">
							<div class="form_group position-relative hometopsearch mb-0">
								<span class="position-absolute p-3"><i class="fa-solid fa-search"></i> </span>
								<input type="text" name="search" id="search" class="ps-5" placeholder="Who do you want to connect with today?" autocomplete="off" required>
							</div> 
						</form>
                        </nav>
                    </div>

                    <div class="header-button">
    
    <a href="/wahclub/" class="text-white text-decoration-none" title="Home"><i class="fa fa-home" style=" transform: none; "></i> </a> 
    <span class="menu-bar d-lg-none searchbutton">
        <button class="btn text-white py-0 px-2">
            <i class="fa-solid fa-search"></i> 
        </button>
    </span>
    
    
    @php
        //Comment Out this code when need to redirect user on their WAH User Dashboard
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
         }
        if (!isset($_SESSION['email'])) { 
            $_SESSION['email'] = session('email'); 
            $_SESSION['userid'] = session('userid');        
        }
    @endphp     
            @if(isset($_SESSION['userid']))
                        <a href="/users" class="btn tj-btn-primary" title="My Dashboard">
                            <i class="fa fa-user" style=" transform: none; "></i> Dashboard</a> 
            @else
                        <a href="/login?rurl={{ request()->getRequestUri() }}" class="text-white text-decoration-none" title="Log In">Log In</a> 
                        <a href="/createaccount?rurl={{ request()->getRequestUri() }}" class="btn tj-btn-primary" title="Sign Up">Sign Up</a>
            @endif
                    
        
                        
                    </div>

                    
                </div>
            </div>
        </div>
    </header>
    
    <main class="site-content" >
        <!-- HERO SECTION START -->
        <section class="hero-section d-flex align-items-center pb-3 mt-5" id="aboutme-section" style="background-color: #0f0715;">
             
            <div class="container">
                <div class="row align-items-center">                     
                    <div class="col-md-12">
						<h4 class="second-title"> Search by Categories</h4>
					</div>
                    <div class="col-md-12 vertical-topcats">
                            <div class=" skeleton topcats-overlay">
                                <!--Loader-->
                            </div>
						 <div class="toptags-widget wow fadeInRight" data-wow-delay=".5s" data-wow-items="3">
                            <div class="owl-carousel toptags-carousel" ata-items="3">
                                
                                 
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/professionals" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-user-tie"></i> Professionals </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/legal-financial-experts" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-scale-balanced"></i> Legal & Financial Experts </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/influencers-artists" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											
											<h3 class="resume-title"> <i class="fa-sharp fa-thin fa-people-arrows"></i> Influencers & Artists </h3>
											
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget"> 
										<a href="/wahclub/members/founders-entrepreneurs" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-briefcase"></i> Founders & Entrepreneurs</h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/wellness" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-spa"></i> Wellness </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/coaches" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-chalkboard-teacher"></i> Coaches </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/education-counsellors" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-user-graduate"></i> Education Counsellors </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/sports" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-medal"></i> Sports </h3>
										</a> 
									</div>									
                                </div>
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/marketing" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-sharp fa-thin fa-bullhorn"></i> Marketing</h3>
										</a> 
									</div>									
                                </div>
								
								<div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/architects-designers" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-buildings"></i> Architects & Designers </h3>
										</a> 
									</div>									
                                </div>
								<div class="tags-item">			 					
                                    <div class="resume-widget">
										<a href="/wahclub/members/hospitality" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-plate-utensils"></i> Hospitality</h3>
										</a> 
									</div>									
                                </div> 
                                
                                <div class="tags-item">								
                                    <div class="resume-widget">
										<a href="/wahclub/members/practitioners" class="resume-item wow fadeInRight" data-wow-delay=".5s">
											<h3 class="resume-title"> <i class="fa-thin fa-stethoscope"></i> Practitioners </h3>
										</a> 
									</div>									
                                </div>
                                 
                            </div>
                        </div>
						
                    </div>
                </div>
				
            </div>
        </section>
        <!-- HERO SECTION END -->
		
		<section class="resume-section category-sliders pt-2 pb-2" style="background: #0f0715">
            <div class="container">
				<div class="row">
					<div class="col-md-12">
						
						<div class="section-header mb-0">
							<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
								  Professionals    </h2>
							  <div data-wow-delay="0.4s" class="text-center wow fadeInLeft">
								<!-- <p>Empowering people in new a digital journey with my super services</p> -->    
							</div>
						</div>
						
						<hr style="border: 0;">
			
					</div>
				</div>
			
			@if($users->isNotEmpty())
				
				<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

                    <div class="owl-carousel category-carousel" id="testiCarousel-f5f74f8">
                    @foreach($users as $user)
                        <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$connections" />
    				@endforeach
                    </div>
                
                    <div class="text-center py-4">
                        <a href="/wahclub/members/professionals" class="view-more-btn">
                            View More <i class="fa-solid fa-arrow-up-right"></i>
                        </a>
                    </div>
                    
				</div>
				
			@endif
	    
	   </div>
    </section>
		
	<section class="resume-section category-sliders pt-2 pb-2" style="background: #0f0715">
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Founders & Entrepreneurs    </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($FoundersCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7hjfhgfu">
      
            @foreach($FoundersCatUsers as $user)
            
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$FounderConnections" />
				
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/founders-entrepreneurs" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
			
		
<!--Influencers & Artists ######################################	-->
<!--Influencers & Artists ######################################	-->

            <div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Influencers & Artists   </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($InfluencersCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($InfluencersCatUsers as $Influencer)
                <x-home_profile_card :user="$Influencer" :loggedinUser="$loggedinUser" :connections="$InfluencerConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/influencers-artists" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Influencers & Artists Ends ######################################	-->
<!--Influencers & Artists Ends ######################################	-->

<!--Wellness ######################################	-->
<!--Wellness ######################################	-->

            <div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Wellness   </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($WellnessCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($WellnessCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$WellnessConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/wellness" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Wellness Ends ######################################	-->
<!--Wellness Ends ######################################	-->



<!--Coaches ######################################	-->
<!--Coaches ######################################	-->

<div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Coaches    </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($CoachCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($CoachCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$CoachConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/coaches" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Coaches Ends ######################################	-->
<!--Coaches Ends ######################################	-->


<!--Marketing ######################################	-->
<!--Marketing ######################################	-->

<div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Marketing    </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($MarketingCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($MarketingCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$MarketingConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/marketing" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Marketing Ends ######################################	-->
<!--Marketing Ends ######################################	-->


<!--Hospitality ######################################	-->
<!--Hospitality ######################################	-->

<div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
							  Hospitality    </h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($HospitalityCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($HospitalityCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$HospitalityConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/hospitality" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Hospitality Ends ######################################	-->
<!--Hospitality Ends ######################################	-->
			

<!--Architect ######################################	-->
<!--Architect ######################################	-->

<div class="row">
				<div class="col-md-12">
					
					<div class="section-header mb-0">
						<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">Architects & Designers</h2>
						  
					</div>
					
					<hr style="border: 0;">
		
				</div>
			</div>
		
		@if($ArchitectCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7infbgg">
      
            @foreach($ArchitectCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$ArchitectConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/architects-designers" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Architect Ends ######################################	-->
<!--Architect Ends ######################################	-->
			
			
		</div>  
    </section>
	
    <!-- SERVICES SECTION START -->
    <section style="background: #050709;" class="py-5" id="MoreSkills">
        <div class="container">
                             
			<div class="row ">
				<div class="col-lg-12 pb-4" style="justify-content: space-between; display: flex;">	
			        <h4 class="second-title mb-0"> Top Skills</h4> 
                    <!--<a href="javascript:void(0);" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>-->
				</div>
			</div>
			
			
			        
			
			
			<div class="row skill-tabs">
			
			@if ($TopSkills)
			    @foreach ($TopSkills as $skill)
				<div class="col-lg-4">						
					<div class="resume-widget">
                        <a href="/wahclub/skills/{{ $skill->slug }}" class="resume-item wow fadeInRight" data-wow-delay=".5s">
						
							<div class="icon">
								<i class="fa-thin fa-head-side-brain"></i>
							</div>
							
                            <div class="time">
                                {{ $skill->skill }}
                            </div>
							
							<div class="lasticon">
								<i class="fa fa-arrow-right"></i>
							</div>
                             
                        </a>
                    </div>				
				</div>
			
			    @endforeach
			@endif
				
				 
				
			</div>
			
        </div>
    </section>
    <!-- SERVICES SECTION END -->

	<section class="resume-section category-sliders pt-5 pb-2" style="background: #0f0715">
        <div class="container">
			   
			 
<!--Education ######################################	-->
<!--Education ######################################	-->

        <div class="row">
			<div class="col-md-12">
				
				<div class="section-header mb-0">
					<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">Education Counsellors</h2>
					  
				</div>
				
				<hr style="border: 0;">
	
			</div>
		</div>
		
		@if($eduCounsellorCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7Educnsl">
      
            @foreach($eduCounsellorCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$eduCounsellorConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/education-counsellors" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Education Ends ######################################	-->
<!--Education Ends ######################################	-->


			 
			
		</div>  
    </section>


	       <!-- SKILLS SECTION START -->
	<section class="py-5" style="background: #050709">
		<div class="container">

			<div class="row ">
				<div class="col-lg-12 pb-4" style="justify-content: space-between; display: flex;">	
					<h4 class="second-title mb-0"> Tools and technologies</h4> 
					<!--<a href="javascript:void(0);" class="view-more-btn">
						View More <i class="fa-solid fa-arrow-up-right"></i>
					</a>-->
				</div>
			</div>
			


			<div class="row">
				
				<div class="col-md-12">
					<div class="skills-widget d-flex flex-wrap justify-content-between align-items-center">
						
				@if ($TopTools)
			        @foreach ($TopTools as $tool)
			            @if($tool->tool == 'Other')
			                @continue
			            @endif
						<div class="skill-item wow fadeInUp" data-wow-delay=".3s">
							<div class="skill-inner">
								<div class="icon-box toolimage">
					<a href="/wahclub/tools/{{ $tool->slug }}">
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
                    @endforeach
				@endif							
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- SKILLS SECTION END -->

	<section class="resume-section category-sliders pt-5 pb-2" style="background: #0f0715">
        <div class="container">
			 
			 
	    
	    		 
<!--Sports ######################################	-->
<!--Sports ######################################	-->

        <div class="row">
			<div class="col-md-12">
				
				<div class="section-header mb-0">
					<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">Sports</h2>
					  
				</div>
				
				<hr style="border: 0;">
	
			</div>
		</div>
		
		@if($SportsCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7Educnsl">
      
            @foreach($SportsCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$SportsConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/sports" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Sports Ends ######################################	-->
<!--Sports Ends ######################################	-->
	    
			 
	    		 
<!--Financial ######################################	-->
<!--Financial ######################################	-->

        <div class="row">
			<div class="col-md-12">
				
				<div class="section-header mb-0">
					<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">Legal & Financial Experts</h2>
					  
				</div>
				
				<hr style="border: 0;">
	
			</div>
		</div>
		
		@if($LegalFinancialCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7Educnsl">
      
            @foreach($LegalFinancialCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$LegalFinancialConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/legal-financial-experts" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Financial Ends ######################################	-->
<!--Financial Ends ######################################	-->
	    			 
	    		 
<!--Practitioners ######################################	-->
<!--Practitioners ######################################	-->

        <div class="row">
			<div class="col-md-12">
				
				<div class="section-header mb-0">
					<h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">Practitioners</h2>
					  
				</div>
				
				<hr style="border: 0;">
	
			</div>
		</div>
		
		@if($PractitionersCatUsers->isNotEmpty())
			
			<div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

            <div class="owl-carousel category-carousel" id="testiCarousel-f5f7Educnsl">
      
            @foreach($PractitionersCatUsers as $user)
                <x-home_profile_card :user="$user" :loggedinUser="$loggedinUser" :connections="$PractitionerConnections" />
			@endforeach
			  
            </div>
            
                <div class="text-center py-4">
                    <a href="/wahclub/members/practitioners" class="view-more-btn">
                        View More <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
                
			</div>
			
		@endif
		
<!--Practitioners Ends ######################################	-->
<!--Practitioners Ends ######################################	-->
	    
			
		</div>  
    </section>
 
</main>

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
                <a href="/login?rurl=/wahclub/" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Login to Connect</a>
            
            @endif
        </div>
    </div>
    
  </div>
  
</div>
</div>
</div> 


<footer class="tj-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-logo-box">
                        <a href="#"><img src="https://www.wahstory.com/images/logos/logo-white.png" alt=""></a>
                    </div>
                     <div class="footer-menu">
                        <nav>
                            <ul>
                                <li><a href="/wahclub/" target="_blank">WAHClub</a></li>
                                <li><a href="/createaccount" target="_blank">Register for WAHClub</a></li>  
                                
                                <li><a href="/" target="_blank">WAHStory</a></li>
                                <li><a href="/corporatenews" target="_blank">WAHNews</a></li>
                                <li><a href="/wahcommunity/" target="_blank">WAHCommunity</a></li>
                            </ul>
                        </nav>
                    </div>
                    
                  
                    <div class="row">
                        
                        <div class="col-md-12 pb-3">
                            
                            
                    <ul class="ul-reset social-icons justify-content-center">
                     <li>
                        <a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                     </li>
                     <li>
                        <a href="https://www.instagram.com/wahstory/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                     </li>
                     <li>
                        <a href="https://www.linkedin.com/company/wahstory/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                     </li> 
                  </ul>
                            
                        </div>
                        
                    </div>
                    
                    <div class="copy-text">
                        <p>© 2025 All rights reserved</p>
                        
                        <div class="fixed-button">
                            
                                        <a href="https://www.wahstory.com/createaccount" target="_blank" class="btn tj-btn-primary px-3 small" style="gap: 3px;"><i class="fa-regular fa-star fa-spin" style=" transform: none; "></i>Build Your Profile</a>
                            
                            
                                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
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
                    
                    // console.log(response.message);
                },
                error: function(xhr) {
                  alert('Error: ' + xhr.responseJSON.message);
                }
          });
              
        })
    });
</script>
@endif

    
 <!-- CSS here -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/backToTop.js') }}"></script>
    <script src="{{ asset('public/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('public/jsv2/main.js') }}"></script>
    
    <script>
      setTimeout(() => {
        document.querySelector('.topcats-overlay').style.display = 'none';
      }, 2000);
    </script>

</body>
</html>