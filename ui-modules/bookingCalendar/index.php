<?php
    require_once(__DIR__ . '/calanderClass.php');

    $obj = new Calendar();
?>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <!-- Site Title -->
    <title>Booking Calendar - WAHClub </title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="https://www.wahstory.com/images/wah_fav.ico" />
    <link rel="shortcut icon" type="image/png" href="https://www.wahstory.com/images/wah_fav.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/animate.min.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/font-awesome-pro.min.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/flaticon_gerold.css"> 
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/nice-select.css">
    
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/backToTop.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/odometer-theme-default.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/magnific-popup.css">

    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/main.css">
    <link rel="stylesheet" href="https://www.wahstory.com/wahclub/public/css/responsive.css">   
    <style>
        .btn-light.active {
            color: #fff;
            background: #f12b59;
            border-color: #f12b59;
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }
        .btn-light:hover {
            color: #fff;
            background: #f12b59;
            border-color: #f12b59;
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }
     
     
        .date-slot {
            width: 90%;
            background-color: rgba(241, 43, 89, 0.1);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            padding: 0.35rem 0.75rem;
            border: 1px solid rgba(241, 43, 89, 0.2);
            transition: all 0.3s ease;
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
        
        .date-unavailable, .date-unavailable:hover {
            cursor: not-allowed !important;
        }
        
        
        /* ################################################### */
        /* From Uiverse.io by Admin12121 */ 
.switch-button {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  justify-content: center;
  margin: auto;
  height: 55px;
}

.switch-button .switch-outer {
  height: 100%;
  background: #252532;
  width: 115px;
  border-radius: 165px;
  -webkit-box-shadow: inset 0px 5px 10px 0px #16151c, 0px 3px 6px -2px #403f4e;
  box-shadow: inset 0px 5px 10px 0px #16151c, 0px 3px 6px -2px #403f4e;
  border: 1px solid #32303e;
  padding: 6px;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
}

.switch-button .switch-outer input[type="checkbox"] {
  opacity: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  position: absolute;
}

.switch-button .switch-outer .button-toggle {
  height: 42px;
  width: 42px;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#3b3a4e),
    to(#272733)
  );
  background: -o-linear-gradient(#3b3a4e, #272733);
  background: linear-gradient(#3b3a4e, #272733);
  border-radius: 100%;
  -webkit-box-shadow: inset 0px 5px 4px 0px #424151, 0px 4px 15px 0px #0f0e17;
  box-shadow: inset 0px 5px 4px 0px #424151, 0px 4px 15px 0px #0f0e17;
  position: relative;
  z-index: 2;
  -webkit-transition: left 0.3s ease-in;
  -o-transition: left 0.3s ease-in;
  transition: left 0.3s ease-in;
  left: 0;
}

.switch-button
  .switch-outer
  input[type="checkbox"]:checked
  + .button
  .button-toggle {
  left: 58%;
}

.switch-button
  .switch-outer
  input[type="checkbox"]:checked
  + .button
  .button-indicator {
  -webkit-animation: indicator 1s forwards;
  animation: indicator 1s forwards;
}

.switch-button .switch-outer .button {
  width: 100%;
  height: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  position: relative;
  -webkit-box-pack: justify;
  justify-content: space-between;
}

.switch-button .switch-outer .button-indicator {
  height: 25px;
  width: 25px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  border-radius: 50%;
  border: 3px solid #ef565f;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  right: 10px;
  position: relative;
}

@-webkit-keyframes indicator {
  30% {
    opacity: 0;
  }

  0% {
    opacity: 1;
  }

  100% {
    opacity: 1;
    border: 3px solid #60d480;
    left: -68%;
  }
}

@keyframes indicator {
  30% {
    opacity: 0;
  }

  0% {
    opacity: 1;
  }

  100% {
    opacity: 1;
    border: 3px solid #60d480;
    left: -68%;
  }
}
        /* ################################################### */
    
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
    
    <main class="site-content">
        <!-- CONTACT SECTION START -->
        <section class="contact-section" id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 order-2 order-md-1">
                
            <?php
                
                $days_availability = $obj->getAvailabilityDays(249);
                $Custom_availability = $obj->getCustomAvailabilityDates(249);
                
                // var_dump($Custom_availability);
    
                $LoopDates = [];
                $today = new DateTime();
                
                for ($i = 0; $i < 15; $i++) {
                    $LoopDates[] = $today->format('Y-m-d');
                    
                    $today->modify('+1 day');
                }
                $Current_DateTime = new DateTime();
            ?>
                       
                       <div data-wow-delay="0.5s" class="carouselWrap wow fadeInRight mb-2" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">
                            <div class="owl-carousel days-carousel">
                            
                        <?php 
                        $i = 1;
                    foreach($LoopDates as $LoopDate) {
                        $activeClass = '';
                        $LoopFullDate = new DateTime($LoopDate);
                        $LoopDayName = $LoopFullDate->format('l');
                        $Loop_Date = $LoopFullDate->format('Y-m-d');
                        
                        if($Current_DateTime->format('Y-m-d') == $LoopFullDate->format('Y-m-d')) {
                            $activeClass = 'active';
                        }
                        
                        
                        $recurringAvailability = array_filter($days_availability, function($availability) use ($LoopDayName) {
                                return $availability['day'] === $LoopDayName;
                            });
                        
                        $CustomAvailability = array_filter($Custom_availability, function($item) use ($Loop_Date) {
                                return $item['date'] === $Loop_Date;
                            });
                            
                        if (!empty($recurringAvailability)) {
                            $availableday = reset($recurringAvailability);
                        
                        ?>  <div class="day-item">
                                <button type="button" class="btn btn-light date-slot <?=$activeClass?>" data-date="<?=$Loop_Date?>" data-starttime="<?=$availableday['start_time']?>" data-endtime="<?=$availableday['end_time']?>">
                                    <?=$LoopFullDate->format('D');?>
                                    <br>
                                    <strong><?=$LoopFullDate->format('d');?></strong>
                                </button>
                            </div>
                            
                        <?php } elseif (!empty($CustomAvailability)) {
                            
                        //If you need multiple times for same dates need to convert here in foreach loop
                            $AvailabilityDate = reset($CustomAvailability);
                            
                        ?>
                            <div class="day-item">
                                <button type="button" class="btn btn-light date-slot  <?=$activeClass?>" data-date="<?=$AvailabilityDate['date']?>" data-starttime="<?=$AvailabilityDate['start_time']?>" data-endtime="<?=$AvailabilityDate['end_time']?>">
                                    <?=$LoopFullDate->format('D');?>
                                    <br>
                                    <strong><?=$LoopFullDate->format('d');?></strong>
                                </button>
                            </div>
                            
                        <?php } else { ?>
                            
                            <div class="day-item">
                                <button type="button" class="btn btn-light date-slot date-unavailable disabled" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="No available slots on this day">
                                    <?=$LoopFullDate->format('D');?>
                                    <br>
                                    <strong><?=$LoopFullDate->format('d');?></strong>
                                </button>
                            </div>
                            
                        
                        <?php } // Availability Checks Ends ?>
                    
                    <?php } // Loop Dates Ends Foreach ?>
                    
                            </div>
                        </div>
                        
                        <div id="timeslots">
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="selectedslot"></div>
                        
                        <label class="switch-button" for="switch">
  <div class="switch-outer">
    <input id="switch" type="checkbox">
    <div class="button">
      <span class="button-toggle"></span>
      <span class="button-indicator"></span>
    </div>
  </div>
</label>
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
                        <p>&copy; 2025 All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

    <!-- CSS here -->
    <script src="https://www.wahstory.com/wahclub/public/js/jquery.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/bootstrap.bundle.min.js"></script> 
    <script src="https://www.wahstory.com/wahclub/public/js/nice-select.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/backToTop.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/smooth-scroll.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/appear.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/wow.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/gsap.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/one-page-nav.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/lightcase.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/owl.carousel.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/isotope.pkgd.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/odometer.min.js"></script>
    <script src="https://www.wahstory.com/wahclub/public/js/magnific-popup.js"></script>

    <script src="https://www.wahstory.com/wahclub/public/js/main.js"></script>
    
    <script>
        $(".days-carousel.owl-carousel").owlCarousel({
			loop: true, 
			nav: true,
			dots: false,
			autoplay: false,
			active: true,
			smartSpeed: 1000,
			autoplayTimeout: 7000,
			responsive: {
				0: {
					items: 3,
				},
				600: {
					items: 4.4,
				},
				1000: {
					items: 5,
				},				
				1200: {
					items: 7,
				},
			},
		});
    </script>
    
    <script>
        $(document).ready(function() {
            var activeDate = document.querySelectorAll('.date-slot');
            
            $(activeDate).click(function() {
                $(activeDate).removeClass('active')
                $(this).addClass('active')
                let slotdate = $(this).data('date');
                let slotstarttime = $(this).data('starttime');
                let slotendtime = $(this).data('endtime');
                
                GenerateTimeSlots(slotdate, slotstarttime, slotendtime);
                
            });
            
            var Current_activeDate = document.querySelector('.date-slot.active');
            var Current_slotdate = Current_activeDate.getAttribute('data-date');
            var Current_slotstarttime = Current_activeDate.getAttribute('data-starttime');
            var Current_slotendtime = Current_activeDate.getAttribute('data-endtime');
            
            GenerateTimeSlots(Current_slotdate, Current_slotstarttime, Current_slotendtime);
        });
    
    
    
    
    // ################ FUNCTIONS ####################
    // ################ FUNCTIONS ####################

        // Function to format the time as "hh:mm AM/PM" in local time zone
        function formatTime(date) {
            let hours = date.getHours();  // Get the local hours
            let minutes = date.getMinutes();
            const period = hours >= 12 ? 'PM' : 'AM';
    
            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12;  // Convert 0 to 12 for midnight (12:00 AM)
    
            // Add leading zero to minutes if necessary
            minutes = minutes < 10 ? `0${minutes}` : minutes;
    
            return `${hours}:${minutes} ${period}`;
        }
        
        //To Generate Time Slots
        function GenerateTimeSlots(slotdate, slotstarttime, slotendtime) {
            
            var startdatetime = slotdate + ' ' + slotstarttime;
            var enddatetime = slotdate + ' ' + slotendtime;

            const timeslotcover = document.getElementById('timeslots');
            timeslotcover.innerHTML = '';
 
            let startTime = new Date(startdatetime);
            startTime.setHours(startTime.getHours() + 1); //Add One Hour
            
            let endTime = new Date(enddatetime);
            
            while (startTime < endTime) {
                
                const timeslotbtn = document.createElement('button');
                timeslotbtn.type = 'button';
                timeslotbtn.classList.add('time-slot');
                let dateStr = FormatDateYMD(startTime);
                let timeStr = startTime.toTimeString().split(' ')[0];
                timeslotbtn.setAttribute('data-date', dateStr);
                timeslotbtn.setAttribute('data-time', timeStr);
                
                let formattedTime = formatTime(startTime);
                    timeslotbtn.innerText = formattedTime;
                timeslotcover.append(timeslotbtn);

                startTime.setMinutes(startTime.getMinutes() + 30);
            }
        }
        
        
        function FormatDateYMD(startTime) {
            let year = startTime.getFullYear();
            let month = String(startTime.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            let day = String(startTime.getDate()).padStart(2, '0');
            
            return `${year}-${month}-${day}`;
        }
    </script>
    <script>
         $(document).on('click', '.time-slot', function() {
            const SelectedSlotDetails = document.getElementById('selectedslot');
                SelectedSlotDetails.innerHTML = '';
            $('.time-slot').removeClass('active');
            $(this).addClass('active');
            let slotdate = $(this).data('date');
            let slotdateTime = $(this).data('time');
            SelectedSlotDetails.innerHTML = 'Date:' + slotdate + ' Time:' + slotdateTime;
        });
    </script>

    
</body>
</html>