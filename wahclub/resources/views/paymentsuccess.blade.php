
<!DOCTYPE html>
<html class="no-js" lang="en">
<head> 
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>Payment Success - WAHClub </title>

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
             /* Header Styles */
        .tj-header-area {
            background-color: transparent;
            padding: 20px 0;
            position: relative;
            z-index: 100;
        }

        .header-absolute {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .logo-box img {
            max-height: 40px;
        }

        .hometopsearch {
            position: relative;
        }

        .hometopsearch input {
            width: 400px;
            padding: 10px 40px;
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .hometopsearch i {
            color: white;
        }

        .header-button .tj-btn-primary {
            background: #1a73e8;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        /* Main Content Styles */
        .hero-section {
            background-color: var(--primary-color);
            padding-top: 100px;
            min-height: 200px;
            position: relative;
        }

        .hero-section h1 {
            color: white;
            margin-bottom: 30px;
        }

        .main-content {
            padding: 40px 0;
            min-height: calc(100vh - 200px);
        }

        .schedule-container {
            background-color: rgb(25 24 24);
            border-radius: 8px;
            padding: 20px;
            margin-top: -50px;
            position: relative;
        }

        /* View Toggle Styles */
        .view-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .view-toggle button {
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            background: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .view-toggle button.active {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        /* List View Styles */
        .list-view {
            display: block;
        }

        .list-view.hidden {
            display: none !important;
        }

        .day-row {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .day-row:last-child {
            border-bottom: none;
        }

        .day-name {
            width: 100px;
            font-weight: bold;
        }

        .time-slots {
            flex-grow: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /*align-items: center;*/
        }

        .time-slot {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .time-input {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            width: 120px;
            background: white;
            color: black;
            font-size: 12px;
        }

        .remove-slot {
            color: #e52955;
            cursor: pointer;
            padding: 5px;
        }
        
        

        .add-slot {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .add-slot:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .day-toggle {
            width: 20px;
            height: 20px;
            margin-right: 15px;
        }
        
        .fa-plus {
            transform: none !important;
        }

    
    @media only screen and (max-width: 992px) {
        
        .time-slots {
            display: inline-block;
        }
        .time-slot {
            padding: 2px;
        }
        
    }
    
    @media only screen and (max-width: 768px) {
            
            .day-row {
                display: block;
            }
            .day-name {
                display: inline;
            }
            .time-slots {
                display: block;
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
                    <div class="col-md-12">
                        
            <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                <!-- List View -->
                <div class="list-view">
                    <div class="day-row">
                     
                        <input type="checkbox" class="day-toggle" id="sunday">
                        <div class="day-name">Sunday</div>
                        
                        <div class="time-slots" id="sunday-slots"> 
                            <span>Unavailable</span>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="monday">
                        <div class="day-name">Monday</div>
                        <div class="time-slots" id="monday-slots">
                            <span>Unavailable</span>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="tuesday" checked>
                        <div class="day-name">Tuesday</div>
                        <div class="time-slots" id="tuesday-slots">
                            <div class="time-slot">
                                <input type="time" class="time-input" value="09:00">
                                <span>-</span>
                                <input type="time" class="time-input" value="17:00">
                                <i class="fa fa-trash remove-slot"></i>
                            </div>
                            <button class="add-slot btn tj-btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="wednesday" checked>
                        <div class="day-name">Wednesday</div>
                        <div class="time-slots" id="wednesday-slots">
                            <div class="time-slot">
                                <input type="time" class="time-input" value="09:00">
                                <span>-</span>
                                <input type="time" class="time-input" value="17:00">
                                <i class="fa fa-trash remove-slot"></i>
                            </div>
                            <button class="add-slot btn tj-btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="thursday" checked>
                        <div class="day-name">Thursday</div>
                        <div class="time-slots" id="thursday-slots">
                            <div class="time-slot">
                                <input type="time" class="time-input" value="09:00">
                                <span>-</span>
                                <input type="time" class="time-input" value="17:00">
                                <i class="fa fa-trash remove-slot"></i>
                            </div>
                            <button class="add-slot btn tj-btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="friday" checked>
                        <div class="day-name">Friday</div>
                        <div class="time-slots" id="friday-slots">
                            <div class="time-slot">
                                <input type="time" class="time-input" value="09:00">
                                <span>-</span>
                                <input type="time" class="time-input" value="17:00">
                                <i class="fa fa-trash remove-slot"></i>
                            </div>
                            <button class="add-slot btn tj-btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="day-row">
                        <input type="checkbox" class="day-toggle" id="saturday">
                        <div class="day-name">Saturday</div>
                        <div class="time-slots" id="saturday-slots">
                            <span>Unavailable</span>
                        </div>
                    </div>
                </div>
                    
            </div>
                    
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2"> 
                        
                        <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-header">
                               
                                <div class="card"> 
                                    
        
        <div class="card-body">
               
             
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                     <i class="fa fa-badge-check display-1 text-success"></i>
                </div>
                <div class="col-md-12 text-center py-4">
                    
                    <h3 class="text-black">Payment succeeded!</h3>
                    
                    <p>Thank you for successfully processing your payment. Your premium subscription is active and will expire on June <?=date('d')?>, 2025.</p>
                    
                </div>
                <div class="col-md-12 text-center py-4">
                    
                    <a href="/users/" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Your Dashboard
                    </a>
                    
                </div>
                
            </div>
            
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
    document.addEventListener('DOMContentLoaded', function() {
        // Global variables for tracking state
        let slotCounter = {};
        const MAX_SLOTS = 3;

        // Format time from 24h to 12h
        function formatTime(time) {
            if (!time) return '';
            const [hours, minutes] = time.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const formattedHour = hour % 12 || 12;
            return `${formattedHour}:${minutes} ${ampm}`;
        }

        // Create a new time slot
        function createTimeSlot(dayId) {
            if (!slotCounter[dayId]) {
                slotCounter[dayId] = 0;
            }
            slotCounter[dayId]++;

            const disabled = slotCounter[dayId] >= MAX_SLOTS ? 'disabled' : '';
            return `
                <div class="time-slot">
                    <input type="time" class="time-input" value="09:00">
                    <span>-</span>
                    <input type="time" class="time-input" value="17:00">
                    <i class="fa fa-trash remove-slot"></i>
                </div>
                <button class="add-slot btn tj-btn-primary" ${disabled}><i class="fas fa-plus"></i> Add</button>
            `;
        }

        // Set day availability
        function setDayAvailable(timeSlots, dayId) {
            timeSlots.innerHTML = createTimeSlot(dayId);
        }

        function setDayUnavailable(timeSlots, dayId) {
            timeSlots.innerHTML = '<span>Unavailable</span>';
            slotCounter[dayId] = 0;
        }

        // Initialize event listeners
        function initializeEventListeners() {
            // Day toggles
            document.querySelectorAll('.day-toggle').forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const timeSlots = this.parentElement.querySelector('.time-slots');
                    const dayId = this.id;
                    if (this.checked) {
                        setDayAvailable(timeSlots, dayId);
                    } else {
                        setDayUnavailable(timeSlots, dayId);
                    }
                });

                // Initialize checked days
                if (toggle.checked) {
                    const timeSlots = toggle.parentElement.querySelector('.time-slots');
                    setDayAvailable(timeSlots, toggle.id);
                }
            });

            // Add slot button
            document.addEventListener('click', function(e) {
                if (e.target.closest('.add-slot')) {
                    const addButton = e.target.closest('.add-slot');
                    const timeSlots = addButton.parentElement;
                    const dayId = timeSlots.closest('.day-row').querySelector('.day-toggle').id;
                    
                    if (slotCounter[dayId] < MAX_SLOTS) {
                        const slotDiv = document.createElement('div');
                        slotDiv.className = 'time-slot';
                        slotDiv.innerHTML = `
                            <input type="time" class="time-input" value="09:00">
                            <span>-</span>
                            <input type="time" class="time-input" value="17:00">
                            <i class="fa fa-trash remove-slot"></i>
                        `;
                        
                        addButton.remove();
                        timeSlots.appendChild(slotDiv);
                        slotCounter[dayId]++;
                        
                        if (slotCounter[dayId] < MAX_SLOTS) {
                            const newAddButton = document.createElement('button');
                            newAddButton.className = 'add-slot btn tj-btn-primary';
                            newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                            timeSlots.appendChild(newAddButton);
                        }
                    }
                }
            });

            // Remove slot button
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-slot')) {
                    const removeButton = e.target.closest('.remove-slot');
                    const timeSlot = removeButton.closest('.time-slot');
                    const timeSlots = timeSlot.parentElement;
                    const dayId = timeSlots.closest('.day-row').querySelector('.day-toggle').id;
                    
                    timeSlot.remove();
                    slotCounter[dayId]--;
                    
                    const addButton = timeSlots.querySelector('.add-slot');
                    if (addButton) {
                        addButton.disabled = false;
                    } else if (slotCounter[dayId] < MAX_SLOTS) {
                        const newAddButton = document.createElement('button');
                        newAddButton.className = 'add-slot btn tj-btn-primary';
                        newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                        timeSlots.appendChild(newAddButton);
                    }
                }
            });
        }

        // Initialize everything
        initializeEventListeners();
    });
</script>

  
</body>

</html>