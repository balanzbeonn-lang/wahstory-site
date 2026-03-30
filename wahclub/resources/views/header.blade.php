</head>

<body style="background: #0f0715;">

    <!-- Preloader Area Start -->
    <div class="preloader">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <!--<div class="preloader-heading">
            <div class="load-text">
                <span>L</span>
                <span>o</span>
                <span>a</span>
                <span>d</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
            </div>
        </div>-->
    </div>
    <!-- Preloader Area End -->


    <!-- start: Back To Top -->
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- end: Back To Top -->
 
        <!--<div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12  text-center">
                    Hurry up! Free registrations are ending soon. <a href="#" class="btn tj-btn-primary" title="Join WAHClub now">Join WAHClub now</a>
                </div>    
            </div>
        </div>
         <hr> -->
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
    
    <a href="/wahclub/" class="text-white text-decoration-none p-3" title="Home"><i class="fa fa-home" style=" transform: none; "></i> </a> 
    
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
                        <a href="/login?rurl={{ request()->getRequestUri() }}" class="text-white text-decoration-none p-3" title="Log In">Log In</a> 
                        <a href="/createaccount?rurl={{ request()->getRequestUri() }}" class="btn tj-btn-primary" title="Sign Up">Sign Up</a>
            @endif
                    
        
                        
                    </div>

                    <div class="menu-bar d-lg-none searchbutton">
                        <button>
                            <i class="fa-solid fa-search"></i> 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>