<?php 
session_start(); 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script> window.location.href="/login.php"; </script>';
        exit;
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
    if($clubuser['subscription_status'] !== 'paid') {
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
    if(isset($_POST['timezoneId']) && $_POST['timezoneId'] != '') {
        
        $response = $postObj->updateAvalibilityTimezoneClubUser($Userrow['ClubId'], $_POST['timezoneId']);
    }
    
    $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);
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
    
  <title>My Availability | <?=$Userrow['name']?></title>
  
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
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 
 
 <style>
        .btn {
            --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(#d91845, .5);
        }
         .btn-primary, .btn-primary:focus, .btn-primary:hover {
            background-color: #d91845;
            border-color: #d91845; 
        }
        .btn-outline-primary {
            border-color: #d91845; 
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: #d91845;
            border-color: #d91845; 
        }
        
         .single-post-content p b{
             color: #d1d1d1;
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

        .header-button .btn-primary {
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



.select2-container--default .select2-selection--single {
		background-color: #181818 !important;
		border: 1px solid #3433334a !important;
		border-radius: 8px  !important;
	
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #dbd9d9;
        font-size: 14px;
        line-height: 32px;
	}
	.select2-container .select2-selection--single {
	    height: 34px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #aaaaaab8;
        border-radius: 4px;
        background: #181818;
    }
	
	.select2-results__options {
		background: #181818 !important;
		font-size: 14px;
	}
	
	.select2-container--default .select2-results__option--selected {
		background-color: #000000 !important;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__choice__remove {
		padding: 2px 4px  !important;
		    color: #ffffff  !important;
		    border-right: 1px solid #6c6969;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__choice {
		background-color: #000000  !important;
		border: 2px solid #000000  !important;
		padding: 2px  !important;
		padding-left: 25px !important;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__choice__display {
		color: #e6e3e3  !important;
	}
	.select2-container .select2-search--inline .select2-search__field {
	    height: 35px !important;
        line-height: 35px;
	}
	.select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below {
	    border: 2px solid #333 !important;
        border-radius: 10px !important;
        padding: 0px 10px;
        background: #181818;
	}
    </style>
     
     
     
 <?php include('../header.php');?>
 <!-- Start Hero -->
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
              
            <div class="dashboard-left-menu">
                <div class="cs-shop_sidebar">
                    <div class="cursor-pointer openleftmenu">
                       <i class="fa-solid fa-bars"></i>
                    </div>
                  <div class="cs-shop_sidebar_widget">
                    <?php $Dmenu = 10;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
         
        
          <div class="row">
            <div class="col-sm-6 col-lg-4"> 
                <h4 class="mb-2">My Availability</h4>
            </div>
            <div class="col-sm-6 col-lg-8">
                <?php $timezones = $postObj->GetAllTimezones(); ?>
                
             <form action="" method="post" id="timezoneForm">
                <select name="timezoneId" id="timezoneId" class="cs-form_field py-1 small" style="border-color: #222020;" required>
                
            <?php 
                $updatedtimezone = $postObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                if($updatedtimezone !== NULL) {
            ?>
                   <option value="<?=$updatedtimezone['id']?>">
                       <?=$updatedtimezone['name']?>
                   </option>
            <?php } else { echo '<option value="">Select Timezone</option>';} ?>
                   
                  <?php foreach($timezones as $timezone) { ?>
                    <option value="<?=$timezone['id']?>"><?=$timezone['name']?></option>
                  <?php }   ?>
                </select>
             </form>
                
            </div>
            
            <div class="col-sm-12"> 
                <hr class="mb-4">
                <a href="shareavailability.calendar.php" class="btn btn-outline-primary text-white py-1">Calendar view</a>
                <a href="shareavailability.php" class="btn btn-primary py-1">Recurring Days</a>
            </div>
            
            
            <div class="col-sm-12 col-lg-12">
              <form method="post" action=""> 
                <!-- List View -->
                <div class="list-view">
          
            <?php
            $days[] = '';
                $myavailability = $postObj->GetAvailabilityByClubId($Userrow['ClubId']);
                
                    foreach ($myavailability as $row) {
                    
                        $day_lower = strtolower($row['day']);
                    ?>
                        <div class="day-row">
                            <input type="checkbox" class="day-toggle" name="day[]" id="<?=$day_lower?>" value="<?=$day_lower?>" checked>
                            <div class="day-name"><?=$row['day']?></div>
                            <div class="time-slots" id="<?=$day_lower?>-slots">
                                <div class="time-slot">
                                    <input type="time" class="time-input" name="start_time[]" value="<?=$row['start_time']?>">
                                    <span>-</span>
                                    <input type="time" class="time-input" name="end_time[]" value="<?=$row['end_time']?>">
                                    <!--<i class="fa fa-trash remove-slot"></i>-->
                                </div>
                                <!--<button class="add-slot btn btn-primary"><i class="fas fa-plus"></i> Add</button>-->
                            </div>
                        </div>
                        
                        
                        
                <?php $days[] = $row['day']; } ?>
                
                <?php 
                      $alldays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                      
                      foreach ($alldays as $aday) {
                          
                          if (!in_array($aday, $days)) {
                              
                              $lowerday = strtolower($aday);
                              
                              echo '<div class="day-row">
                                 
                                    <input type="checkbox" class="day-toggle" name="day[]" id="'.$lowerday.'" value="'.$lowerday.'">
                                    <div class="day-name">'.$aday.'</div>
                                    
                                    <div class="time-slots" id="'.$lowerday.'-slots"> 
                                        <span>Unavailable</span>
                                    </div>
                                </div>';
                          }
                      }
                ?>
                
 
                </div>
                
                <button type="button" id="myButton" name="post" class="cs-btn cs-style1 mt-4">Update</button>
          
              </form>
                
            </div>
            
          </div>
          
          
          
          <br>
         
         
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
  <script>
    document.getElementById('timezoneId').addEventListener('change', function() {
        document.getElementById('timezoneForm').submit();
    });
  </script>
  
  
   <script>
   document.addEventListener('DOMContentLoaded', function() {
    // Global variables for tracking state
    let slotCounter = {};
    const MAX_SLOTS = 3;

    // Initialize slot counters for checked days
    document.querySelectorAll('.day-toggle').forEach(toggle => {
        if (toggle.checked) {
            const dayId = toggle.id;
            const timeSlots = toggle.parentElement.querySelector('.time-slots');
            slotCounter[dayId] = timeSlots.querySelectorAll('.time-slot').length;
        }
    });

    // Day toggles
    document.querySelectorAll('.day-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const timeSlots = this.parentElement.querySelector('.time-slots');
            const dayId = this.id;
            
            if (this.checked) {
                // Clear existing content
                timeSlots.innerHTML = '';
                
                // Create initial time slot
                const slotDiv = document.createElement('div');
                slotDiv.className = 'time-slot';
                slotDiv.innerHTML = `
                    <input type="time" class="time-input" name="start_time[]" value="09:00">
                    <span>-</span>
                    <input type="time" class="time-input" name="end_time[]" value="17:00"> 
                `;
                timeSlots.appendChild(slotDiv);
                
                // Add the "Add" button
                // const addButton = document.createElement('button');
                // addButton.className = 'add-slot btn btn-primary';
                // addButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                // timeSlots.appendChild(addButton);
                
                slotCounter[dayId] = 1;
            } else {
                timeSlots.innerHTML = '<span>Unavailable</span>';
                slotCounter[dayId] = 0;
            }
        });
    });

    // Add slot button - using event delegation
    /*document.addEventListener('click', function(e) {
        if (e.target.closest('.add-slot')) {
            const addButton = e.target.closest('.add-slot');
            const timeSlots = addButton.parentElement;
            const dayId = timeSlots.closest('.day-row').querySelector('.day-toggle').id;
            
            if (!slotCounter[dayId]) {
                slotCounter[dayId] = 0;
            }
            
            if (slotCounter[dayId] < MAX_SLOTS) {
                const slotDiv = document.createElement('div');
                slotDiv.className = 'time-slot';
                slotDiv.innerHTML = `
                    <input type="time" class="time-input" name="start_time[]" value="09:00">
                    <span>-</span>
                    <input type="time" class="time-input" name="end_time[]" value="17:00">
                    <i class="fa fa-trash remove-slot"></i>
                `;
                
                addButton.remove();
                timeSlots.appendChild(slotDiv);
                slotCounter[dayId]++;
                
                if (slotCounter[dayId] < MAX_SLOTS) {
                    const newAddButton = document.createElement('button');
                    newAddButton.className = 'add-slot btn btn-primary';
                    newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                    timeSlots.appendChild(newAddButton);
                }
            }
        }
    });*/

    // Remove slot button - using event delegation
    /*document.addEventListener('click', function(e) {
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
                newAddButton.className = 'add-slot btn btn-primary';
                newAddButton.innerHTML = '<i class="fas fa-plus"></i> Add';
                timeSlots.appendChild(newAddButton);
            } 
        }
    });*/
    
    
});


</script>
    
    
<script>
    
    function getAvailabilityData() {
        const availabilityData = [];
        const days = document.querySelectorAll('.day-row');
        
        days.forEach(day => {
            const dayCheckbox = day.querySelector('.day-toggle');
            if (dayCheckbox.checked) {
                const dayName = day.querySelector('.day-name').textContent;
                const timeSlots = [];
                const slots = day.querySelectorAll('.time-slot');
                
                slots.forEach(slot => {
                    const startTime = slot.querySelector('.time-input[name="start_time[]"]').value;
                    const endTime = slot.querySelector('.time-input[name="end_time[]"]').value;
                    timeSlots.push({ startTime, endTime });
                });

                availabilityData.push({ day: dayName.toLowerCase(), timeSlots });
            }
        });

        return availabilityData;
    }

     // Submit the data to PHP via an AJAX request
    function submitAvailability() {
        const availabilityData = getAvailabilityData();
        // const timezoneId = document.getElementById('timezoneId');
        
        fetch('updateavail.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id: <?=$Userrow['ClubId'];?>, availabilityData }),
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response
            console.log(data.message);
            
            if(data.status == 'success') {
                window.location.reload();
            }
            
        });
    }
    
    // Attach the event listener to the button
    document.getElementById('myButton').addEventListener('click', function() {
        submitAvailability();
    });
    
    
    
    // updateAvalibilityTimezoneClubUser
    
</script>
    
    
   <!-- Start CTA -->
  <?php include('../footer.section.php');?>
  <?php include('footer.commonJS.php');?> 
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
    <script> 
       $(document).ready(function() {          

         $('#timezoneId').select2({
          tags: false,
            placeholder: "Search Here *", // Set the placeholder text
          width: 'resolve', // Adjust width to fit container  
         });
		 
       });
       
       
       // Get all time input elements
    const timeInputs = document.querySelectorAll('input[type="time"]');

    // Loop through each time input element and add the event listener
    timeInputs.forEach(function(timeInput) {
        timeInput.addEventListener('input', function(event) {
            let timeValue = event.target.value;
    
            // Ensure the input has the format HH:MM
            if (timeValue.length === 5 && timeValue.includes(':')) {
                const [hours, minutes] = timeValue.split(':');
    
                // If minutes are not 00 or 30, set them to 00
                if (minutes !== '00' && minutes !== '30') {
                    timeValue = `${hours}:00`; // Set minutes to '00' if invalid
                }
    
                // Update the input value with the valid time
                event.target.value = timeValue;
            }
        });
    });
    </script>
    
    <script>
        $(document).ready(function () {
            // Open Left Menu Of User Dashboard
            const openMenuBtn = document.querySelector('.openleftmenu');
            const openMenuBtnicon = document.querySelector('.openleftmenu i');
            const sidebar = document.querySelector('.dashboard-left-menu');
             
            openMenuBtn.addEventListener('click', function () {
                sidebar.classList.toggle('open'); 
                openMenuBtnicon.classList.toggle('fa-times'); 
            });
        });
    </script>
    
  </body>
</html>