<?php 
session_start(); 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
     
    if(isset($_POST['CREATECOMMUINITY'])){
        $_SESSION['responce'] = $postObj->CreateCommunity($_SESSION['userid']);
    }
    if(isset($_POST['JOINCOMMUINITY'])){
        $_SESSION['responce'] = $postObj->JoinCommunity($_SESSION['userid']);
    }
    
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Community Created Successfully!'; 
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
        }
        unset($_SESSION['responce']);
        
    } 
     
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>Notifications | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
        :root {
            --primary-color: #0f0715;
            --secondary-color: #cf254d;
            --text-color: white;
            --border-color: #e0e0e0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--primary-color);
            color: var(--text-color);
        }

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
            align-items: center;
        }

        .time-slot {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .time-input {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            width: 120px;
            background: white;
            color: black;
        }

        .remove-slot {
            color: #666;
            cursor: pointer;
            padding: 5px;
        }

        .add-slot {
            color: var(--secondary-color);
            cursor: pointer;
            padding: 5px 10px;
            border: 1px solid var(--secondary-color);
            border-radius: 4px;
            background: white;
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

        /* Calendar View Styles */
        .calendar-view {
            display: none;
            background: rgb(25 24 24);
            padding: 20px;
            border-radius: 8px;
        }

        .calendar-view.active {
            display: block !important;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header button {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            padding: 5px 10px;
        }

        .calendar-header h3 {
            margin: 0;
            color: white;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar-day {
            border: 1px solid var(--border-color);
            padding: 10px;
            min-height: 100px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.05);
        }

        .calendar-day.has-schedule {
            background-color: rgba(207, 37, 77, 0.1);
        }

        .calendar-day-header {
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }

        .calendar-day-content {
            font-size: 0.9em;
            color: #ccc;
        }

        /* Timezone Selector Styles */
        .timezone-selector {
            margin-top: 20px;
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .timezone-selector select {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            margin-left: 10px;
            min-width: 200px;
            background: white;
            color: black;
        }

        /* Footer Styles */
        .tj-footer-area {
            background-color: var(--primary-color);
            padding: 40px 0;
            color: white;
            text-align: center;
        }

        .footer-logo-box img {
            max-height: 40px;
            margin-bottom: 20px;
        }





        .modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.modal-buttons button {
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.cancel-date {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--text-color);
}

.apply-date {
    background: var(--secondary-color);
    border: none;
    color: white;
}








.date-specific-hours {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.date-specific-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.date-specific-header h3 {
    color: white;
    margin-bottom: 5px;
}

.date-specific-header p {
    color: #888;
    margin: 0;
    font-size: 0.9em;
}

.add-date-hours {
    background: var(--secondary-color);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.add-date-hours:hover {
    background: #b51f42;
}

.date-specific-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.date-slot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255, 255, 255, 0.05);
    padding: 12px 16px;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.date-slot-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.date-slot-date {
    color: white;
    font-weight: 500;
    min-width: 100px;
}

.date-slot-time {
    color: #ccc;
}

.remove-date {
    background: transparent;
    border: none;
    color: #888;
    cursor: pointer;
    padding: 8px;
    border-radius: 4px;
}

.remove-date:hover {
    color: var(--secondary-color);
    background: rgba(207, 37, 77, 0.1);
}

/* Date Modal Styles */
.date-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.date-modal-content {
    background: rgb(25 24 24);
    padding: 24px;
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.date-modal-content h3 {
    color: white;
    margin-bottom: 20px;
}

.date-input-group, .time-input-group {
    margin-bottom: 20px;
}

.time-input-group {
    display: flex;
    gap: 20px;
}

.date-input-group label, .time-input-group label {
    display: block;
    color: #ccc;
    margin-bottom: 8px;
}

.date-input, .time-input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.05);
    color: white;
}

.modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 24px;
}

.modal-buttons button {
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.cancel-date {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.cancel-date:hover {
    background: rgba(255, 255, 255, 0.05);
}

.apply-date {
    background: var(--secondary-color);
    border: none;
    color: white;
}

.apply-date:hover {
    background: #b51f42;
}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 <!-- Start Hero -->
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">
          
          <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 9;?>
            <?php include('user.leftmenu.php');?>
          </div>
           
        </div>
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
        
        <!-- Main Content -->
    <section class="main-content">
        <div class="container">
            <div class="schedule-container">
                <div class="view-toggle">
                    <button data-view="list" class="active">Weekly hours</button>
                    <button data-view="calendar">Calendar view</button>
                </div>

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
                                <i class="fas fa-times remove-slot"></i>
                            </div>
                            <button class="add-slot"><i class="fas fa-plus"></i> Add</button>
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
                                <i class="fas fa-times remove-slot"></i>
                            </div>
                            <button class="add-slot"><i class="fas fa-plus"></i> Add</button>
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
                                <i class="fas fa-times remove-slot"></i>
                            </div>
                            <button class="add-slot"><i class="fas fa-plus"></i> Add</button>
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
                                <i class="fas fa-times remove-slot"></i>
                            </div>
                            <button class="add-slot"><i class="fas fa-plus"></i> Add</button>
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

                <!-- Calendar View -->
                <div class="calendar-view">
                    <div class="calendar-header">
                        <button class="prev-month"><i class="fas fa-chevron-left"></i></button>
                        <h3 class="current-month">January 2025</h3>
                        <button class="next-month"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <div class="calendar-grid">
                        <!-- Calendar days will be populated by JavaScript -->
                    </div>
                </div>

                <div class="date-specific-hours">
                    <div class="date-specific-header">
                        <div>
                            <h3>Date-specific hours</h3>
                            <p>Adjust hours for specific days</p>
                        </div>
                        <button class="add-date-hours"><i class="fas fa-plus"></i> Hours</button>
                    </div>
                    <div class="date-specific-list">
                        <!-- Date-specific hours will be populated here -->
                    </div>
                </div>


                <div class="timezone-selector">
                    <label for="timezone">Time zone:</label>
                    <select id="timezone">
                        <option value="IST">India Standard Time (IST)</option>
                        <option value="PST">Pacific Standard Time (PST)</option>
                        <option value="EST">Eastern Standard Time (EST)</option>
                        <option value="GMT">Greenwich Mean Time (GMT)</option>
                        <option value="JST">Japan Standard Time (JST)</option>
                        <option value="AEST">Australian Eastern Standard Time (AEST)</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
    
   
   <script>
     document.addEventListener('DOMContentLoaded', function() {
    // Global variables for tracking state
    let slotCounter = {};
    const MAX_SLOTS = 3;
    let currentYear = 2025;
    let currentMonth = 0;
    let dateSpecificHours = [];

    // Format time from 24h to 12h
    function formatTime(time) {
        if (!time) return '';
        const [hours, minutes] = time.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const formattedHour = hour % 12 || 12;
        return `${formattedHour}:${minutes} ${ampm}`;
    }

    // Format date for display
    function formatDate(date) {
        const d = new Date(date);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
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
                <i class="fas fa-times remove-slot"></i>
            </div>
            <button class="add-slot" ${disabled}><i class="fas fa-plus"></i> Add</button>
        `;
    }

    // Set day availability
    function setDayAvailable(timeSlots, dayId) {
        timeSlots.innerHTML = createTimeSlot(dayId);
        updateCalendarView();
    }

    function setDayUnavailable(timeSlots, dayId) {
        timeSlots.innerHTML = '<span>Unavailable</span>';
        slotCounter[dayId] = 0;
        updateCalendarView();
    }

    // Generate calendar view
    function generateCalendar(year, month) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDay = firstDay.getDay();

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                          'July', 'August', 'September', 'October', 'November', 'December'];
        document.querySelector('.current-month').textContent = `${monthNames[month]} ${year}`;

        const calendarGrid = document.querySelector('.calendar-grid');
        calendarGrid.innerHTML = '';

        // Add day headers
        const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        days.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'calendar-day-header';
            dayHeader.textContent = day;
            calendarGrid.appendChild(dayHeader);
        });

        // Map full day names to their IDs
        const dayToId = {
            0: 'sunday',
            1: 'monday',
            2: 'tuesday',
            3: 'wednesday',
            4: 'thursday',
            5: 'friday',
            6: 'saturday'
        };

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < startingDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'calendar-day';
            calendarGrid.appendChild(emptyDay);
        }

        // Add calendar days
        for (let day = 1; day <= daysInMonth; day++) {
    const date = new Date(year, month, day);
    const dayOfWeek = date.getDay();
    const dayCell = document.createElement('div');
    dayCell.className = 'calendar-day';
    
    // Format the date string to match date-specific hours format
    // Fix: Ensure proper date formatting with timezone handling
    const dateString = new Date(Date.UTC(year, month, day)).toISOString().split('T')[0];
    
    // Check for date-specific hours first
    const specificHours = dateSpecificHours.find(entry => {
        // Fix: Compare dates without time component
        const entryDate = new Date(entry.date);
        const compareDate = new Date(dateString);
        return entryDate.getFullYear() === compareDate.getFullYear() &&
               entryDate.getMonth() === compareDate.getMonth() &&
               entryDate.getDate() === compareDate.getDate();
    });
    
    if (specificHours) {
        dayCell.classList.add('has-schedule');
        dayCell.innerHTML = `
            <div class="calendar-day-header">${day}</div>
            <div class="calendar-day-content">
                <div class="specific-hours">
                    ${formatTime(specificHours.startTime)} - ${formatTime(specificHours.endTime)}
                    <span class="specific-indicator">Custom</span>
                </div>
            </div>
        `;
    } else {
        // Rest of your existing code for regular weekly schedule
        const dayId = dayToId[dayOfWeek];
        const dayToggle = document.querySelector(`#${dayId}`);
        const timeSlots = document.querySelector(`#${dayId}-slots`);
        
        const dayContent = document.createElement('div');
        dayContent.className = 'calendar-day-content';
        
        if (dayToggle && dayToggle.checked) {
            dayCell.classList.add('has-schedule');
            const slots = timeSlots.querySelectorAll('.time-slot');
            
            if (slots.length > 0) {
                slots.forEach(slot => {
                    const inputs = slot.querySelectorAll('input[type="time"]');
                    if (inputs.length === 2) {
                        const start = formatTime(inputs[0].value);
                        const end = formatTime(inputs[1].value);
                        dayContent.innerHTML += `<div>${start} - ${end}</div>`;
                    }
                });
            }
        } else {
            dayContent.innerHTML = '<div>Unavailable</div>';
        }
        
        dayCell.innerHTML = `
            <div class="calendar-day-header">${day}</div>
            ${dayContent.outerHTML}
        `;
    }
    
    calendarGrid.appendChild(dayCell);
}
    }

    // Date-specific hours functions
    function renderDateSpecificHours() {
        const dateSpecificList = document.querySelector('.date-specific-list');
        dateSpecificList.innerHTML = dateSpecificHours
            .sort((a, b) => new Date(a.date) - new Date(b.date))
            .map(entry => `
                <div class="date-slot" data-date="${entry.date}">
                    <div class="date-slot-info">
                        <span class="date-slot-date">${formatDate(entry.date)}</span>
                        <span class="date-slot-time">
                            ${formatTime(entry.startTime)} – ${formatTime(entry.endTime)}
                        </span>
                    </div>
                    <button class="remove-date">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `).join('');
    }

    function addDateSpecificHours() {
        const date = document.getElementById('specific-date').value;
        const startTime = document.getElementById('specific-start-time').value;
        const endTime = document.getElementById('specific-end-time').value;

        if (date && startTime && endTime) {
            const existingIndex = dateSpecificHours.findIndex(entry => entry.date === date);
            
            if (existingIndex !== -1) {
                dateSpecificHours[existingIndex] = { date, startTime, endTime };
            } else {
                dateSpecificHours.push({ date, startTime, endTime });
            }
            
            renderDateSpecificHours();
            document.querySelector('.date-modal').style.display = 'none';
            
            // Clear inputs
            document.getElementById('specific-date').value = '';
            document.getElementById('specific-start-time').value = '09:00';
            document.getElementById('specific-end-time').value = '17:00';
            
            updateCalendarView();
        }
    }

    function removeDateSpecificHours(date) {
        dateSpecificHours = dateSpecificHours.filter(entry => entry.date !== date);
        renderDateSpecificHours();
        updateCalendarView();
    }

    // Initialize event listeners
    function initializeEventListeners() {
        // View toggle
        document.querySelectorAll('.view-toggle button').forEach(button => {
            button.addEventListener('click', function() {
                const view = this.dataset.view;
                document.querySelectorAll('.view-toggle button').forEach(btn => 
                    btn.classList.remove('active'));
                this.classList.add('active');

                if (view === 'calendar') {
                    document.querySelector('.list-view').classList.add('hidden');
                    document.querySelector('.calendar-view').classList.add('active');
                    generateCalendar(currentYear, currentMonth);
                } else {
                    document.querySelector('.list-view').classList.remove('hidden');
                    document.querySelector('.calendar-view').classList.remove('active');
                }
            });
        });

        // Month navigation
        document.querySelector('.prev-month').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentYear, currentMonth);
        });

        document.querySelector('.next-month').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentYear, currentMonth);
        });

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
                        <i class="fas fa-times remove-slot"></i>
                    `;
                    
                    addButton.remove();
                    timeSlots.appendChild(slotDiv);
                    slotCounter[dayId]++;
                    
                    if (slotCounter[dayId] < MAX_SLOTS) {
                        const newAddButton = document.createElement('button');
                        newAddButton.className = 'add-slot';
                        newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                        timeSlots.appendChild(newAddButton);
                    }
                    
                    updateCalendarView();
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
                    newAddButton.className = 'add-slot';
                    newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                    timeSlots.appendChild(newAddButton);
                }
                
                if (timeSlots.querySelectorAll('.time-slot').length === 0) {
                    const dayToggle = timeSlots.closest('.day-row').querySelector('.day-toggle');
                    dayToggle.checked = false;
                    setDayUnavailable(timeSlots, dayId);
                }
                
                updateCalendarView();
            }
        });

        // Date-specific hours event listeners
        const addDateHoursBtn = document.querySelector('.add-date-hours');
        const dateModal = document.querySelector('.date-modal');
        const cancelDateBtn = document.querySelector('.cancel-date');
        const applyDateBtn = document.querySelector('.apply-date');
        const dateSpecificList = document.querySelector('.date-specific-list');

        addDateHoursBtn.addEventListener('click', () => {
            dateModal.style.display = 'flex';
        });

        cancelDateBtn.addEventListener('click', () => {
            dateModal.style.display = 'none';
        });

        applyDateBtn.addEventListener('click', addDateSpecificHours);

        dateSpecificList.addEventListener('click', (e) => {
            if (e.target.closest('.remove-date')) {
                const dateSlot = e.target.closest('.date-slot');
                const date = dateSlot.dataset.date;
                removeDateSpecificHours(date);
            }
        });

        // Close modal when clicking outside
        dateModal.addEventListener('click', (e) => {
            if (e.target === dateModal) {
                dateModal.style.display = 'none';
            }
        });

        // Time input changes
        document.addEventListener('input', function(e) {
            if (e.target.matches('input[type="time"]')) {
                updateCalendarView();
            }
        });
    }

    // Update calendar when weekly schedule changes
    function updateCalendarView() {
        if (document.querySelector('.calendar-view').classList.contains('active')) {
            generateCalendar(currentYear, currentMonth);
        }
    }

    // Initialize everything
    initializeEventListeners();
    generateCalendar(currentYear, currentMonth);
});
        </script>
  
  <?php include('../footer.php');?>