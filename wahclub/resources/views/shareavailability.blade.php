
<!DOCTYPE html>
<html class="no-js" lang="en">
<head> 
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>Share Your Availability - WAHClub </title>

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
        .weekdays li{
            display: inline-block;
            margin: 4px 4px; 
        }
        .weekdays li .btn{ 
            padding-left: 5px;
            padding-right: 5px;
        }
        .nice-select { 
            font-size: 16px;
            line-height: 30px;
            border: solid 1px #bdb8b8;
        }
        .form-control {
            border-color: #bdb8b8;
        }
        
        input:disabled {
            cursor: not-allowed;
        }
        
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
                        
                        <div class="contact-form-box wow fadeInLeft pt-2" data-wow-delay=".3s">
                            <div class="section-header">
                                <a href="/users/mycalendar.php" class="btn btn-outline-primary px-2 py-0 mb-3"><i class="fa fa-arrow-left"></i> Back</a>
                               
                                <div class="card">
                                    
        
        <div class="card-body">
            
        <form method="post" action="">       
        
            <div class="row mt-2"> 
            
                <div class="col-md-12">
                    <h3 class="text-black">Share Your Availability</h3>
                    <hr>
                </div>
                
                <div class="col-md-12 mt-2">
                    <h5 class="text-dark">Choose Recurring Days:</h5>
                    <ul class="weekdays ps-0">
                        <li>
                            <input type="checkbox" class="btn-check" id="Sun-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Sun-check">Sun</label>
                        </li>
                        <li>
                            <input type="checkbox" class="btn-check" id="Mon-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Mon-check">Mon</label>
                        </li> 
                        <li>
                            <input type="checkbox" class="btn-check" id="Tue-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Tue-check">Tue</label>
                        </li>
                        <li>
                            <input type="checkbox" class="btn-check" id="Wed-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Wed-check">Wed</label>
                        </li>
                        <li>
                            <input type="checkbox" class="btn-check" id="Thu-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Thu-check">Thu</label>
                        </li>
                        <li>
                            <input type="checkbox" class="btn-check" id="Fri-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Fri-check">Fri</label>
                        </li>
                        <li>
                            <input type="checkbox" class="btn-check" id="Sat-check" autocomplete="off">
                            <label class="btn btn-outline-primary" for="Sat-check">Sat</label>
                        </li> 
                    </ul>
                    
                </div>
                
                <div class="col-lg-12 col-md-12 mt-4">
                    <h5 class="text-dark">Set Your Daily Availability:</h5>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="fromtime" class="fw-semibold">From: </label>
                        <input type="time" class="form-control" name="fromtime" id="fromtime" aria-describedby="timeHelp">
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="totime" class="fw-semibold">To: </label>
                        <input type="time" class="form-control" name="totime" id="totime" aria-describedby="timeHelp">
                    </div>
                </div>
                
                
                <div class="col-md-12 py-4">
                    
                    <div class="form-group">
                     <label class="fw-semibold">Timezone: </label> 
                     <br>
                     <select name="timezone" class="form-control w-100">
                         
                        <option value="Asia/Calcutta" selected>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
   
                        <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                        <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                        <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                        <option value="US/Alaska">(GMT-09:00) Alaska</option>
                        
                    </select>
                    
                    </div>
                    
                </div>  
                
                <div class="col-md-12 card text-start mt-4">
                    
                <div class="accordion accordion-flush" id="Excpaccordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed fw-semibold py-2 my-2" type="button" data-bs-toggle="collapse" data-bs-target="#Excp-collapseOne" aria-expanded="false" aria-controls="Excp-collapseOne">
                        Add Exceptions to Your Schedule:
                      </button>
                    </h2>
                    <div id="Excp-collapseOne" class="accordion-collapse collapse" data-bs-parent="#Excpaccordion">
                      <div class="accordion-body">
                      
                <div  id="exceptionscontainer">
    
    <div class="row exceptions">
        <div class="col-lg-12 col-md-12 py-2">
            <div class="form-group">
                <label for="excp1date" class="fw-semibold">Date: </label> 
                <input type="date" class="form-control" name="excp1date" id="excp1date" aria-describedby="timeHelp">
            </div>
            <div class="form-group">
                <label>
                <input type="checkbox" autocomplete="off" id="excp1wholeday" onchange="toggleExcpInput('1')">
                 I'm not available whole day: </label>
            </div>
        </div> 
        
        <div class="col-lg-6 col-md-6 py-2">
            <div class="form-group">
                <label for="excp1fromtime" class="fw-semibold">From: </label>
                <input type="time" class="form-control" name="excp1fromtime" id="excp1fromtime" aria-describedby="timeHelp">
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 py-2">
            <div class="form-group">
                <label for="excp1totime" class="fw-semibold">To: </label>
                <input type="time" class="form-control" name="excp1totime" id="excp1totime" aria-describedby="timeHelp">
            </div>
        </div>
    </div>
                    
                </div>
                
                <button type="button" id="addexceptionbutton" class="btn text-primary"><i class="fa fa-plus"></i> Add More</button>
                      
                      
                      </div>
                    </div>
                  </div> 
                </div>
                    
                </div>
                
                <div class="col-md-12 text-center py-4">
                     
                    <button type="button" class="btn btn-primary" onclick="location.href='/users/mycalendar.php';">
                        <i class="fa fa-calendar-days"></i> Update Availability
                    </button>
                    
                </div>
                
            </div>
            
        </form>
        
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
        function toggleExcpInput(excpNumber) {
            const checkbox = document.getElementById(`excp${excpNumber}wholeday`);
            const fromtime = document.getElementsByName(`excp${excpNumber}fromtime`);
            const totime = document.getElementsByName(`excp${excpNumber}totime`);
            if (fromtime.length > 0) { // Check if any input elements were found
                const input = fromtime[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
            if (totime.length > 0) { // Check if any input elements were found
                const input = totime[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
        }
    </script>
  
  <script>
  let ExceptionCount = 1;
      document.getElementById('addexceptionbutton').addEventListener('click', function() {
            
        if(ExceptionCount >= 3) {
            alert("Max 3 Allowed!");
        }else{
            ExceptionCount++;
            
            const exceptionscontainer = document.getElementById('exceptionscontainer');

            const exceptionsGroup = document.createElement('div');
            exceptionsGroup.className = 'exceptions-group';
            exceptionsGroup.id = `exceptions${ExceptionCount}`;

            exceptionsGroup.innerHTML = ` 
                <br> 
               <div class="row exceptions">
                            
            <div class="col-lg-12 col-md-12 py-2">
                <div class="form-group">
                    <label for="excp${ExceptionCount}date" class="fw-semibold">Date: </label>
                    <input type="date" class="form-control" name="excp${ExceptionCount}date" id="excp${ExceptionCount}date" aria-describedby="timeHelp">
                </div>
                
                <div class="form-group">
                    <label>
                    <input type="checkbox" autocomplete="off" id="excp${ExceptionCount}wholeday"  onchange="toggleExcpInput('${ExceptionCount}')">
                     I'm not available whole day: </label>
                </div>
                
            </div> 
            
            <div class="col-lg-6 col-md-6 py-2">
                <div class="form-group">
                    <label for="excp${ExceptionCount}fromtime" class="fw-semibold">From: </label>
                    <input type="time" class="form-control" name="excp${ExceptionCount}fromtime" id="excp${ExceptionCount}fromtime" aria-describedby="timeHelp">
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 py-2">
                <div class="form-group">
                    <label for="excp${ExceptionCount}totime" class="fw-semibold">To: </label>
                    <input type="time" class="form-control" name="excp${ExceptionCount}totime" id="excp${ExceptionCount}totime" aria-describedby="timeHelp">
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 py-2 text-end">
                 <button type="button" class="deleteExceptionsButton btn btn-danger m-0" onclick="deleteExceptions('${ExceptionCount}')"> <i class="fa-solid fa-trash"></i> </button>
            </div>
            
        </div>
            `;

            exceptionscontainer.appendChild(exceptionsGroup);
             
            
            } //if less than 3
            
        });
         function deleteExceptions(exceptionsNumber) {
            const exceptionsGroup = document.getElementById(`exceptions${exceptionsNumber}`);
            exceptionsGroup.remove();
             
            ExceptionCount--;
             
        }
        
        
        
  </script>
   
  
  
</body>

</html>