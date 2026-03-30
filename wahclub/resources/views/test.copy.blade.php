@php
    use Carbon\Carbon;
    
    $UserTimeZone = '+5:30';
    

    $timezone = session('User_Selected_Timezone', 'NotSet');
    
    if($timezone === 'NotSet') {
        $memberTimeZone = '+5:30';
    } else {
        $memberTimeZone = $timezone;
    } 
@endphp
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
    <link rel="stylesheet" href="{{ asset('public/css/frontpage.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">      

    <style>
    
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
            .time-slot { 
                width: 20%;
            }
        } 
        @media only screen and (max-width: 520px) {
            .time-slot { 
                width: 26%;
            }
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
                    <div class="col-lg-8 col-md-8 offset-lg-2 offset-md-2"> 
                        
                        <div class="contact-form-box wow fadeInLeft pt-2" data-wow-delay=".3s">
                            <div class="section-header">
                   
                <?php 
                    $path = storage_path('app/public/schedule.json.save');
                    $schedules = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
                    
                    function CheckSchedule($schedules, $DayName, $MemberId){
                        $filteredSchedule = array_filter($schedules, function ($entry) use ($DayName, $MemberId) {
                            return $entry['user_id'] == $MemberId && $entry['day'] == $DayName; 
                        });
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
         
        
        $ReturnedSchedule = CheckSchedule($schedules, $LoopDayNameMemberTZ, 249);
        if($ReturnedSchedule != NULL) {
            
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
                        if($ReturnedSchedule == NULL) { 
                            $JumptonextDay = $JumptonextDay + 1;
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
                <div class="form_group position-relative d-flex align-items-center">
                     <i class="fa-solid fa-earth-asia" style="font-size: 16px; position: absolute; z-index: 8; left: 5px;"></i>
                    <select name="timezoneId" id="timezoneid" class="ps-4"  style="z-index: 999" >
                            
                        @foreach($timezones as $timezone)
                        <option value="{{ $timezone->value }}"> {{ $timezone->name }} </option>
                        @endforeach
                            
                    </select>
                </div>
                @endif
                
                    <p>Let Member Timezone : {{ $memberTimeZone }} </p>
                    <p>Let User Selected Timezone : {{ $UserTimeZone }} </p>
                    
                        </div>
                    </div>
                    
                        
                    
                </div> <!--Availability Ends-->
                    
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
                                <p class=" mb-0">1 hr</p>
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
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Location</h5>
                                <p class="mb-0">New Delhi, Chennai, Kolkata</p>
                            </div>
                        </div>
                    </div>
                   
                   
                    
                </div>
                
                
                
            </div>
            
        </form>
         
                              
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
    
    
    function GenerateTimeSlots (StartTimeG, EndTimeG) {
         
        let StartTime = new Date(StartTimeG);
        let EndTime = new Date(EndTimeG);
        
        let slotbox = document.getElementById("timesloats");
            slotbox.innerHTML = '';
        
        while(StartTime < EndTime) {
             
            formattedTime = StartTime.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            })
             
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
    }
    
  </script>
    
    <script>
        $('#timezoneid').change(function() {
            var timezoneB = document.getElementById('timezoneid').value; // Get the selected timezone from the dropdown
        
            // Create a new XMLHttpRequest for the AJAX call
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('timezone.update') }}", true);  // Define the route to handle the request in Laravel
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");  // CSRF token for security
            
            // Send the timezone data via POST
            xhr.send("Usertimezone=" + encodeURIComponent(timezoneB));
            
            // Handle the AJAX response
            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                    console.log("Success: ", xhr.responseText);
                } else {
                    // Error handling
                    console.log("Error: ", xhr.status, xhr.statusText);  // Log error if something goes wrong
                    alert("There was an error updating the timezone.");
                }
            };
    
            // Handle errors
            xhr.onerror = function() {
                console.log("Request failed");
                alert("AJAX request failed. Please try again.");
            };
        });
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
            const currentTime = new Date();
            let startTimeInNewTimezone = new Date(startTime);
    
            // If the start time is in the past, add 2 hours
            if (startTimeInNewTimezone <= currentTime) {
                startTimeInNewTimezone = new Date(currentTime);
                startTimeInNewTimezone.setHours(currentTime.getHours() + 2);
                startTimeInNewTimezone.setMinutes(00);
            }
            
            return startTimeInNewTimezone;
        }
    
    </script>

</body>

</html>