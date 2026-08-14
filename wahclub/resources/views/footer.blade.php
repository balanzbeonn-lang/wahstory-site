<style>
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
        
        
      }
</style>
    
    <!-- FOOTER AREA START -->
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
                        <p>&copy; {{ now()->year }} All rights reserved</p>
                        
                        <div class="fixed-button">
                            
            @if (!isset($loggedinUser) || $loggedinUser == null)
                            <a href="https://www.wahstory.com/createaccount" target="_blank" class="btn tj-btn-primary px-3 small"  style="gap: 3px;"><i class="fa-regular fa-star fa-spin" style=" transform: none; "></i>Build Your Profile</a>
                            
                            
            @endif
                            
                        </div>
                        
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
    <script src="{{ asset('public/js/frontpage.js') }}"></script>
    