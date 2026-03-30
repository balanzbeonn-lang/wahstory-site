    @php
        
        //Comment Out this code when need to redirect user on their WAH User Dashboard
        
        // if (session_status() == PHP_SESSION_NONE) {
           // session_start();
        // }
    
        // Check if the email is not already set in PHP session
        // if (!isset($_SESSION['email'])) { 
        
            // $_SESSION['email'] = session('email'); 
            // $_SESSION['userid'] = session('userid');        
        //}
        
        // unset($_SESSION['email'], $_SESSION['userid']);
        
    @endphp
    
   
    

<!DOCTYPE html>
<html class="no-js" lang="en">
<head> 
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>Checkout Plan - WAHClub </title>

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
                    <div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2"> 
                        
                        <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-header">
                               
                                <div class="card">
                                    
        <div class="card-header">
            <h3 class="section-tixtle text-center mt-3" style=" color: #f12b59; font-size: 22px; "><strong>WAHClub Premium Plan</strong> ($12 Monthly) </h3>
        </div>
        <div class="card-body">
                                        
            <div class="row">
                <div class="col-md-12">
                    Have a coupon? 
                    <a href="javascript:void(0);" class="text-decoration-none" id="couponformopen">
                    Click here to enter your code 
                    </a>
                    
                    <div id="couponform" style="display: none;">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="form-group mt-2">
                                        <input type="text" class="form-control" id="couponcode" placeholder="Enter Code">
                                    </div>
                                </div>
                                <div class="col-md-3  col-sm-4">
                                    <button type="button" id="verifycode" class="btn btn-primary mt-2">Verify</button>
                                </div>
                                <div id="couponverified" class="text-success ps-4 small"  style="display: none;">
                                    <h6 class="text-success my-1 mt-2">
                                        Your code has applied:
                                    </h6> 
                                    <p> 10% Off Subtotal (98WAH10)  <a href="" class="text-decoration-none text-success"><strong>Remove</strong></a></p> 
                                </div>
                                
                            </div>
    
                        </form>
                        <hr>
                    </div>
                    
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            <td>$<span id="subtotal" data-value="12">12.00</span></td>
                        </tr>
                        <tr id="subtotaldiscounttr" style="display: none;">
                            <th class="text-success">Subtotal Discount
                                <p class="fw-normal">(10% off Subtotal (98WAH10))</p>
                            </th>
                            <td class="text-success">
                                <strong>
                                -$<span id="subtotaldiscount" data-value="0">1.20</span>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Tax <span class="badge bg-secondary opacity-75">10%</span></th>
                            <td>$<span id="taxamount" data-value="1.20">1.20</span></td> 
                        </tr>
                        <tr>
                            <th>Total</th> 
                            <td>
                                <strong>
                                    $<span id="totalamount" data-value="13.20">13.20</span>
                                </strong>
                            </td>
                        </tr>
                         
                    </table>
                    <label>
                    <input type="checkbox" value="1" checked required="">
                     I have read and agree to the website <a href="/termsandconditions" target="_blank"> terms and conditions.</a></label>
                    
                    <button type="button" class="btn btn-primary w-100 mt-4" onclick="location.href='paymentsuccess'">Subscribe Now</button>
                    
                </div>
            </div>
            
        </div>
        
                                </div>
                              
                            </div>
                        </div>
                        
                        <a href="/users/" style="color: #f12b59;font-size: 16px;text-decoration: none;margin: 10px;display: block;">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        
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
                     
                    <div class="copy-text">
                        <p>&copy; <?=date('Y')?> All rights reserved</p>
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
    
    <script>
        $(document).ready(function (){
           $('#couponformopen').click(function(){
               $('#couponform').slideToggle();
           }) 
           
           $('#verifycode').click(function(){
                var subtotalvalue = $('#subtotal').data("value");
               
                var discountamount  = (subtotalvalue * 10 ) / 100;
                var subtotalamount = subtotalvalue - discountamount;
                
                var taxamount = $('#taxamount').data("value");
                
                var totalamount = parseFloat(taxamount) + parseFloat(subtotalamount);
                
                $('#totalamount').html(totalamount.toFixed(2));
                
                $('#couponverified').show();
                $('#subtotaldiscounttr').show();
                
           }) 
        });
    </script>
    
</body>

</html>