<?php 
session_start();
ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include("functions.php");
    $postObj = new SocialHealth();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!==''){
        
        $ScoreROw = $postObj->getDataEmail($_SESSION['email']);
        if($ScoreROw !== NULL){
            header('location: /social-health-impact/graphdash/');
        }
    }
    
    if(isset($_POST['ViewScore'])){
        
        $ScoreROw = $postObj->getDataEmail($_POST['email']);
        
        
        if($ScoreROw !== NULL || $ScoreROw !== FALSE){
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            header('location: /social-health-impact/graphdash/');
        }
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="Social Health Impact, Digital Social Health, Health Matters,  Digital Health, Social Health, WahStory"/>
        <meta name="description" content="We believe that nurturing your Social Health involves being intentional about how you engage, connect, and inspire on social media platforms."/>
        
        <meta name="copyright" content="WAHStory">
        <meta name="language" content="en">
        <meta name="language" content="hi">
        <meta name="theme-color" content="#e9204f" />
        <meta name="topic" content="Digital Social Health, Health Matters,  Digital Health, Social Health, WahStory">
        <meta name="author" content="WahStory">
        <meta name="copyright" content="wahstory.com">
        
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="rating" content="General">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        
        
        <link rel="shortcut icon" href="/images/wah_fav.ico">
     
        <title>Social Health Impact | WAHStory</title>
        
        <meta name="url" content="https://www.wahstory.com/social-health-impact/">
        <meta name="identifier-URL" content="https://www.wahstory.com/social-health-impact/">
        <link rel="canonical" href="https://www.wahstory.com/social-health-impact/" />
        
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="Website" />
        <meta name="og:title" content="Social Health Impact | WahStory">
        <meta name="og:description" content="We believe that nurturing your Social Health involves being intentional about how you engage, connect, and inspire on social media platforms.">
        <meta property="og:url" content="https://www.wahstory.com/social-health-impact/" />
        <meta property="og:site_name" content="WAHStory.com" />
        <meta property="og:image" content="https://www.wahstory.com/social-health-impact/img/WE-ALL-HAVE-A-STORY.jpg" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="250" />
        <meta property="og:image:type" content="image/png/webp" />
    
     

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;700;800&family=Roboto:wght@400;500;600;700&display=swap');
</style>

    <style>
        section {
            display: block;
        }
        .modal-body h3{
            font-size: 18px;
            line-height: 30px;
        }
        /*===========================
2.0 *** BANNER AREA START ***
=============================*/

.slide-banner {
    height: 100vh;
    background-repeat: no-repeat !important;
    background-position: center center !important;
    background-size: cover !important;
    position: relative;
}

.overly {
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    background: rgba(7, 1, 23, 0.8);
}

.banner-content {
    height: 100%;
}

.banner-content .container {
    height: 100%;
}

.banner-text {
    position: relative;
    top: 40%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 1;
}

.banner-text::after {
    position: absolute;
    content: '';
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%) rotate(45deg);
    -ms-transform: translate(-50%, -50%) rotate(45deg);
    transform: translate(-50%, -50%) rotate(45deg);
    width: 300px;
    height: 300px;
    border: 4px solid rgba(247, 56, 89, 0.2);
    z-index: -1;

}

.banner-text h2 {
    font-size: 30px;
    color: #fff;
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
    margin-bottom: 6px;
}

.banner-text h1 {
    font-size: 51px;
    color: #e9204f;
    font-family: 'Open Sans', sans-serif;
    font-weight: 900;
    text-transform: uppercase;
    margin-top: 0;
}

.banner-text p {
    line-height: 25px;
    padding: 5px 170px 15px;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    text-align: justify;
    font-size: 17px;
    color: #fff;

}

.banner-text .ban-btn {
    background: none;
    font-size: 16px;
    margin-top: 15px;
    color: #fff;
    border: 1px solid #fff;
    padding: 14px 20px;
    border-radius: 50px;
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
    -webkit-transition: all linear .3s;
    -o-transition: all linear .3s;
    transition: all linear .3s;
    text-decoration: none;
}

.banner-text .ban-btn:hover {
    color: #fff;
    background: #f73859;
    -o-transition: all linear .5s;
    transition: all linear .5s;
    -webkit-transition: all linear .5s;
    border-color: #f73859;
}

.social-icon {
    padding-top: 35px;
}

.social-icon i {
    font-size: 18px;
    width: 40px;
    height: 40px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    margin: 0 4px;
    -webkit-transition: all linear .5s;
    -o-transition: all linear .5s;
    transition: all linear .5s;
}

.social-icon i:hover {
    background: #e9204f;
    -webkit-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
}

.slidPrv {
    position: absolute;
    top: 50%;
    left: 20px;
    height: 40px;
    width: 40px;
    text-align: center;
    color: #fff;
    line-height: 40px;
    font-size: 20px;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    border-radius: 50%;
    z-index: 99;
    -o-transition: all .3s;
    transition: all .3s;
    -webkit-transition: all .3s;
    cursor: pointer;
}

.container_check{
    color: #fff;
}
.container_check a{
    color: #e9204f;
}

.btn_1,
a.btn_1 {
    border: none;
    color: #fff;
    background: #e9204f;
    outline: 0;
    cursor: pointer;
    display: inline-block;
    text-decoration: none;
    padding: 12px 25px;
    color: #fff;
    font-weight: 600;
    text-align: center;
    line-height: 1;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -webkit-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    font-size: 14px;
    font-size: .875rem
}

.btn_1:hover,
a.btn_1:hover {
    background-color: #d80075
}

@media only screen and (max-width: 992px) {
    
    .slide-banner {
    height: 250vh;
    }
    .banner-content .container {
        height: 100%;
    }
    .banner-text p {
        padding: 5px 10px 15px;
    }
    
    
}
@media only screen and (max-width: 768px) {
    .banner-text p {
        line-height: 25px;
        padding: 5px 0px 15px;
    }
    
    .slide-banner {
    height: 240vh;
    }
    
    .banner-content .container {
        height: 100%;
    }
    .banner-text::after {
        width: 200px;
    height: 200px;
    }

}


@media only screen and (max-width: 576px) {
    
    .slide-banner {
    height: 140vh;
    }
    
}

     
    </style>
</head>
<body>


 <!-- BANNER AREA START -->
    <section id="banner"> 
        <div class="slider-img">
            <div class="slide-banner" style="background: url(img/banner1.jpg)">
               
                <div class="overly">
                    
                    <div class="container">
                    <div class="row py-2">
                        <div class="col-md-12 text-end">
                            <a href="javascript:void(0);" style="color: #e9204f; text-decoration: none; font-size: 20px;
    font-weight: 500;" data-bs-toggle="modal" data-bs-target="#ViewYourScore">View Your Score</a>
                        </div>
                    </div>
                    </div>
                    
                    <div class="banner-content">
                        <div class="container text-center">
                            <div class="banner-text"> 
                            <h2>YOUR DIGITAL SOCIAL</h2>
                                <h1>HEALTH MATTERS</h1>
                                <p>Much like your physical health, your online interactions play a vital role in your overall well-being. We believe that nurturing your Social Health involves being intentional about how you engage, connect, and inspire on social media platforms. Your digital actions have the power to shape communities, influence opinions, and contribute to a more connected world.
                                <br>
                                <br>
                                Assessing your Social Health through your Digital Social Impact, you're taking a step toward a more purposeful and influential online journey. Let's dive into the assessment and discover the positive impact you can make in the digital world.</p>
                                
                                
                                <form action="socialfootprints.php" method="post">
                                    <div class="form-group terms">
                                        <label class="container_check">
                                            <input type="checkbox" name="terms" value="1" class="required" required
       oninvalid="this.setCustomValidity('Please accept the terms and conditions to proceed.')"
       oninput="this.setCustomValidity('')">
                                            Kindly acknowledge acceptance of our <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a> before proceeding with the form.
                                            
                                        </label>
                                    </div>
                                    <button type="submit" class="ban-btn">Get Started <i class="fa fa-arrow-right"></i></button>
                                </form>
                                 
                                <div class="social-icon text-center">
                                    <a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/wahstory/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> 
                                    <a href="https://www.linkedin.com/company/wahstory/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    
                                    <a href="https://www.youtube.com/@WAHstory" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
    </section>
    <!-- BANNER AREA END -->

	<!-- Modal terms -->
	<div class="modal fade" id="ViewYourScore" tabindex="-1" role="dialog" aria-labelledby="ViewYourLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="ViewYourLabel">View Your Score</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" action="">
					    
                    <label class="cs-shop-label">Name *</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name " required="">
                    <br>
                    <label class="cs-shop-label">Email *</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Your Email " required="">
                    
                    <button class="btn_1 my-2" type="submit" name="ViewScore">
                      <span>View Score</span>
                      <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"></path>
                      </svg>
                                     
                    </button>
                    
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h3>Terms and Conditions for Participation in the Digital Social Health Assessment</h3>
                    <p align="justify">Welcome to the Digital Social Health Assessment conducted by WAHStory. We greatly appreciate your participation in this vital initiative, and we are committed to ensuring transparency, data security, and your rights as a participant. By engaging in this assessment, you agree to the following comprehensive terms and conditions:</p>
                    <h3>1. Data Usage and Confidentiality:</h3>
                     <p align="justify">  - Your participation in this assessment implies your consent for us to collect and process data you provide, exclusively for the purpose of understanding your social health and its various dimensions.</p>
                    <p align="justify">   - We guarantee the utmost confidentiality and protection of your personal information, including your name, contact details, and any other identifiable data.</p>
                    <p align="justify">   - Under no circumstances will your data be shared with third parties. It will be securely stored within the confines of this assessment.</p>
                    <h3>2. Research and Analysis:</h3>
                    <p align="justify">   - Data collected from this assessment will be employed solely for research and analysis purposes. We are committed to enhancing our understanding of social connections and well-being in the digital era.</p>
                    <p align="justify">   - The aggregated, anonymized data may be used to improve our services, further our research, and contribute to the broader knowledge base on Digital Social Health.</p>
                    <h3>3. Privacy Commitment:</h3>
                    <p align="justify">   - We consider your privacy as our utmost priority. Stringent security measures have been implemented to protect your data against any unauthorized access, disclosure, alteration, or destruction.</p>
                    <p align="justify">   - Our commitment to data privacy extends throughout the entire assessment process.</p>
                    <h3>4. Public Sharing:</h3>
                    <p align="justify">   - It's important to note that, on a case-by-case basis, we may request your explicit permission to share your anonymized data publicly. </p>
                    <p align="justify">   - Such sharing may involve the presentation of specific insights or patterns in the data to contribute to a better understanding of Digital Social Health.</p>
                    <p align="justify">   - It is essential to emphasize that your participation in this assessment does not automatically grant permission for public data sharing. We will always seek your informed consent beforehand.</p>
                    <h3>5. Data Ownership:</h3>
                       - You maintain full ownership rights over the data you provide in this assessment. WAHStory will not assert any ownership claims over your personal information or responses.</p>
                    <h3>6. Withdrawal of Consent:</h3>
                       - You have the absolute right to withdraw your consent for participation at any point in the assessment process. If you choose to do so, your data will be promptly removed from our assessment and will not be used for research or analysis.</p>
                    <h3>7. Contact Information:</h3>
                    <p align="justify"> If you have any inquiries, concerns, or requests related to your data, privacy, or this assessment, please do not hesitate to reach out to us at info@wahstory.com. Our team is readily available to address your needs.</p>
                    <p align="justify">By engaging in the Digital Social Health Assessment, you acknowledge that you have carefully read and consented to these terms and conditions. Your dedication to privacy and data protection resonates with our mission to foster a healthier and more connected digital world.</p>
                    <p align="justify">We express our sincere gratitude for your participation in this critical initiative. Your invaluable insights will significantly contribute to a deeper understanding of Digital Social Health for the collective benefit of all.</p>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
</body>
</html>