<!DOCTYPE html>
<html class="no-js" lang="en">
<head> 
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>WAHClub - WAHStory </title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="https://www.wahstory.com/images/wah_fav.ico" />
    <link rel="shortcut icon" type="image/png" href="https://www.wahstory.com/images/wah_fav.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/flaticon_gerold.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">    
    <style>
      .char-presanter {
        position: relative;
        display: flex;
        background: #140c1c;
        justify-content: center;
      }

      .char-presanter span {
        font-size: 9em;
        color: var(--tj-theme-primary);
        font-weight: bold;
        opacity: 0;
        animation: drop 0.4s linear forwards;
      }

      .char-presanter span:nth-child(2) {
        animation-delay: 0.6s;
      }

      .char-presanter span:nth-child(3) {
        animation-delay: 0.8s;
      }

      .char-presanter span:nth-child(4) {
        animation-delay: 1s;
      }

      .char-presanter span:nth-child(5) {
        animation-delay: 1.2s;
      }

      .char-presanter span:nth-child(6) {
        animation-delay: 1.4s;
      }

      .char-presanter span:nth-child(7) {
        animation-delay: 1.6s;
      }

      .char-presanter span:nth-child(8) {
        animation-delay: 1.8s;
      }

      .char-presanter span:nth-child(9) {
        animation-delay: 2s;
      }

      .char-presanter span:nth-child(10) {
        animation-delay: 2.2s;
      }

      @keyframes  drop {
        0% {
          transform: translateY(-200px) scaleY(0.9);
        }
        5% {
          opacity: 0.7;
        }
        50% {
          transform: translateY(0px) scaleY(1);
          opacity: 1;
        }
        65% {
          transform: translateY(-17px) scaleY(0.9);
        }
        75% {
          transform: translateY(-22px) scaleY(0.9);
        }
        100% {
          transform: translateY(0px) scaleY(1);
          opacity: 1;
        }
      }


      
      .section-header{
        max-width: none;
      }
      .section-header .section-title{
        display: block;
        text-align: center;
      }

    .fw-400{
        font-weight: 400;
        font-size: 16px;
      }
      
      @media screen and (max-width: 992px) {
          .char-presanter span {
              font-size: 7rem;
          }
      }
      @media screen and (max-width: 768px){
          .char-presanter span {
              font-size: 5rem;
          }
      }
      @media screen and (max-width: 520px){
          .char-presanter span {
              font-size: 4rem;
          }
      }
      
      body{
          background: #050709;
      }
    </style>
    
    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVRFRRWSM2"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-LVRFRRWSM2'); </script>
    
</head>

<body>

    <!-- Preloader Area Start -->
    
    <!-- Preloader Area End -->


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
                <div class="col-12 d-flex flex-wrap align-items-center justify-content-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>   
                </div>
            </div>
        </div>
    </header>
     
    
    <main class="site-content" > 
        <!-- CONTACT SECTION START -->
        <section class="contact-section" id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 order-2 order-md-1">
                        <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-header">
                              <div class="char-presanter">
                                  <span>W</span>
                                  <span>A</span>
                                  <span>H</span>
                                  <span>C</span>
                                  <span>L</span>
                                  <span>U</span>
                                  <span>B</span> 
                                  <span>!</span> 
                              </div>

                              <h2 class="section-title text-center">Coming Soon! </h2>
                              
                              <div class="row">
                                <div class="col-md-12 text-center order-2 order-md-1 py-4">
                                                     
                                  <a href="/getmeinwahclub.php" class="btn tj-btn-primary-new fw-400" > Join The Club <i class="fa fa-arrow-right"></i> </a> 

                                </div>
 
                              </div>


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
                     
                    <div class="copy-text">
                        <p>&copy; @php echo date('Y'); @endphp All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

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
    
</body>

</html>