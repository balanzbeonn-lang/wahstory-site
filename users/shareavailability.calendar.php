<?php 
    session_start(); 
    
    include('../inc/functions.php');
    $postObj = new Story();
    
    include('update/inc/update_availability.php');
    $calendarObj = new CalendarBooking();
    
    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script> window.location.href="/login.php"; </script>';
        exit;
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);
    
    $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
    if($clubuser['subscription_status'] !== 'paid') {
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
    
    if(isset($_POST['timezoneId']) && $_POST['timezoneId'] != '') {
        $response = $postObj->updateAvalibilityTimezoneClubUser($Userrow['ClubId'], $_POST['timezoneId']);
    }
    
    if(isset($_GET['delExpId']) && $_GET['delExpId'] != '') {
       $response = $calendarObj->deleteExceptions($Userrow['ClubId'], $_GET['delExpId']);
    echo '<script> window.location.href="shareavailability.calendar.php"; </script>';
        exit;
    }
    if(isset($_POST['ADDEXCEPTION'])) {
        $response = $calendarObj->updateExceptions($Userrow['ClubId'], $_POST['ExceptionDate']);
    }
    if(isset($_POST['ADDCUSTOMAVAILABILITY'])) {
        $response = $calendarObj->AddCustomAvalibility($Userrow['ClubId'], $_POST['CS_Avail_Date'], $_POST['CS_Avail_StartTime'], $_POST['CS_Avail_EndTime']);
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

             
         
    
        /* Calendar Styles */
        .calendar-view {
            background: rgb(25 24 24);
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            overflow: hidden;
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
            font-size: 1.1em;
        }
    
        .calendar-header h3 {
            margin: 0;
            color: white;
            font-size: clamp(1.2rem, 4vw, 1.5rem);
        }
    
        /* Calendar Grid */
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            width: 100%;
        }
    
        .calendar-day-header {
            font-weight: bold;
            text-align: center; 
            font-size: clamp(0.8rem, 2.5vw, 1rem);
        }
    
        .calendar-day {
            position: relative;
            width: 100%; 
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.05);
            height: 80px; 
            text-align: center;
            cursor: pointer;
            overflow: hidden;
        }
    
        .calendar-day.has-schedule {
            background-color: rgba(207, 37, 77, 0.1);
        }
    
        .calendar-day-inner {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        
        .skeletoneffect {
          position: relative;
          width: 100%;
          height: 100%;
        }
        
        .skeletoneffect::before {
          content: '';
          position: absolute;
          top: 0;
          left: -100%;
          width: 100%;
          height: 100%;
          background: linear-gradient(90deg, rgba(160, 160, 160, 0) 0%, rgba(160, 160, 160, 0.6) 50%, rgba(160, 160, 160, 0) 100%);
          animation: skeletonloading .9s infinite;
        }
        
        @keyframes skeletonloading {
          0% {
            left: -100%;
          }
          100% {
            left: 100%;
          }
        }
        
    
        .calendar-day-content {
            font-size: 12px;
            color: #ccc; 
        }
        
        
        
        .slot-edit-icon{
            position: absolute;
            top: -6px;
            right: -10px;
            /*background: #333;*/
            width: 35px;
            height: 35px;
            border-radius: 20px;
            line-height: 35px;
            overflow: hidden;
            z-index: 111;
            padding-right: 2px;
            -webkit-transition:all .3s ease;transition:all .3s ease
        }
        .calendar-day.has-schedule:hover .slot-edit-icon{ 
            background: #e9204f;
            color: #fff;
        }
        
     
        /* Responsive Styles */
        @media (max-width: 992px) {
         .calendar-day { 
                height: 60px;  /* Set a fixed height for each day */
                
            }
   
        }
        @media (max-width: 768px) {
             
            .schedule-container {
                margin-top: -30px;
                padding: 10px;
            }
    
            .calendar-view {
                padding: 10px;
            }
    
            .calendar-grid {
                gap: 4px;
            }
    
            .calendar-day-inner {
                padding: 4px;
            }
    
            .calendar-day-header {
                font-size: 0.8rem;
                padding: 2px;
            }
    
            .calendar-day-content {
                font-size: 0.7rem;
                line-height: 1.2;
            }
    
            .calendar-day-content div {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
     
        }
    
        @media (max-width: 480px) {
           
            .calendar-grid {
                gap: 2px;
            }
    
            .calendar-day-inner {
                padding: 2px;
            }
    
            .calendar-day-header {
                font-size: 0.7rem;
            }
    
            .calendar-day-content {
                font-size: 0.6rem;
            }
    
            .calendar-header h3 {
                font-size: 1rem;
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
        <div class="cs-shop_sidebar">
          
          <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 10;?>
            <?php include('user.leftmenu.php');?>
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
                <?php $timezones = $postObj->GetAllTimezones(); 
                $updatedtimezone = $postObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                ?>
             <form action="" method="post" id="timezoneForm">
                 
                <select name="timezoneId" id="timezoneId" class="cs-form_field py-1 small" style="border-color: #222020;" required>
            
            <?php 
               
                
                if($updatedtimezone !== NULL) {
            ?>
                   <option value="<?=$updatedtimezone['id']?>" selected>
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
                <a href="shareavailability.calendar.php" class="btn btn-primary py-1">Calendar view</a>
                <a href="shareavailability.php" class="btn btn-outline-primary text-white py-1">Recurring Days</a>
            </div>
            
            
            <div class="col-sm-12 col-lg-12">
              <form method="post" action=""> 
                 
                <div class="schedule-container">
                    <div class="calendar-view">
                        <div class="calendar-header">
                            <button type="button" class="prev-month"><i class="fas fa-chevron-left"></i></button>
                            <h3 class="current-month">January 2025</h3>
                            <button type="button" class="next-month"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="calendar-grid">
                            <!-- Calendar days will be populated by JavaScript -->
                        </div>
                    </div> 
                    
                    
                    
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="my-2">Exceptions</h4>
                                <button class="add-date-hours cs-btn cs-style1 small py-1 my-2" type="button" data-bs-toggle="modal" data-bs-target="#availabilityExceptionModal"> Add Exception</button>
                            </div>
                             
                        </div>
                        
                        <div class="col-md-12">
                        
                    <table class="table table-striped table-dark">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                <?php
                
                    $Exceptions = $calendarObj->GetAllExceptionsByUser($Userrow['ClubId']);
                    if($Exceptions != NULL) { 
                        $i = 1;
                    foreach($Exceptions as $Exception) {
                ?>      <tr>
                          <th scope="row"><?=$i++?></th>
                          <td><?php echo date("l d, M Y", strtotime($Exception['exception_date']));?></td>
                          <td>
                              <a href="shareavailability.calendar.php?delExpId=<?=$Exception['id']?>" class="text-danger">
                                <i class="fa fa-trash"></i>
                              </a>
                          </td>
                        </tr>
                <?php } } else { ?>
                       
                       <tr>
                           <td colspan="3" align="center" class="text-secondary"> No Exception added yet!</td>
                       </tr>
                <?php } ?>       
                       
                      </tbody>
                    
                    </table>
                    
                        </div>
                        
                    </div>  <!-- Row Ends-->
                    
                    
                </div>
                 
          
              </form>
                
            </div>
            
          </div>
          
          
          
          <br>
         
         
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
      
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>

  <script>
    document.getElementById('timezoneId').addEventListener('change', function() {
        document.getElementById('timezoneForm').submit();
    });
  </script>
  
  
<!-- Modal -->
    <div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgb(25 24 24);border-radius: 8px;width: 100%;max-width: 400px;border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="availabilityModalLabel">Set Availability</h5>
                    <button type="button" class="btn-close pb-3" data-bs-dismiss="modal" aria-label="Close" style="background: none;">
                        <i class="fa fa-times text-white h3 mb-0 pb-0"></i>
                    </button>
                </div>
                <div class="modal-body">
                
                <form method="post" action="">
                    
                    <p id="selectedDateText"></p>
                    <input type="hidden" id="availabilityDate" name="CS_Avail_Date">
                    
                    <div class="row"> 
                        <div class="input col-md-6 col-md-6">
                            <label for="availabilityfrom" class="small">Start time:</label>
                            <select id="availabilityfrom" name="CS_Avail_StartTime" class="cs-form_field py-1" required>
                                    <!-- Options for 24 hours with 30-minute intervals -->
                                    <option value="">From</option>
                                    <option value="00:00">12:00 AM</option>
                                    <option value="00:30">12:30 AM</option>
                                    <option value="01:00">01:00 AM</option>
                                    <option value="01:30">01:30 AM</option>
                                    <option value="02:00">02:00 AM</option>
                                    <option value="02:30">02:30 AM</option>
                                    <option value="03:00">03:00 AM</option>
                                    <option value="03:30">03:30 AM</option>
                                    <option value="04:00">04:00 AM</option>
                                    <option value="04:30">04:30 AM</option>
                                    <option value="05:00">05:00 AM</option>
                                    <option value="05:30">05:30 AM</option>
                                    <option value="06:00">06:00 AM</option>
                                    <option value="06:30">06:30 AM</option>
                                    <option value="07:00">07:00 AM</option>
                                    <option value="07:30">07:30 AM</option>
                                    <option value="08:00">08:00 AM</option>
                                    <option value="08:30">08:30 AM</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="13:30">01:30 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="14:30">02:30 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="15:30">03:30 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="16:30">04:30 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="17:30">05:30 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="18:30">06:30 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                    <option value="19:30">07:30 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                    <option value="20:30">08:30 PM</option>
                                    <option value="21:00">09:00 PM</option>
                                    <option value="21:30">09:30 PM</option>
                                    <option value="22:00">10:00 PM</option>
                                    <option value="22:30">10:30 PM</option>
                                    <option value="23:00">11:00 PM</option>
                                    <option value="23:30">11:30 PM</option>
                                </select>
                            
                        </div>   
                        <div class="input col-md-6 col-md-6"> 
                            <label for="availabilityto" class="small">End time:</label>
                            <select id="availabilityto" name="CS_Avail_EndTime" class="cs-form_field py-1" required>
                                    <option value="">To</option>
                                    <option value="00:00">12:00 AM</option>
                                    <option value="00:30">12:30 AM</option>
                                    <option value="01:00">01:00 AM</option>
                                    <option value="01:30">01:30 AM</option>
                                    <option value="02:00">02:00 AM</option>
                                    <option value="02:30">02:30 AM</option>
                                    <option value="03:00">03:00 AM</option>
                                    <option value="03:30">03:30 AM</option>
                                    <option value="04:00">04:00 AM</option>
                                    <option value="04:30">04:30 AM</option>
                                    <option value="05:00">05:00 AM</option>
                                    <option value="05:30">05:30 AM</option>
                                    <option value="06:00">06:00 AM</option>
                                    <option value="06:30">06:30 AM</option>
                                    <option value="07:00">07:00 AM</option>
                                    <option value="07:30">07:30 AM</option>
                                    <option value="08:00">08:00 AM</option>
                                    <option value="08:30">08:30 AM</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="13:30">01:30 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="14:30">02:30 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="15:30">03:30 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="16:30">04:30 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="17:30">05:30 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="18:30">06:30 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                    <option value="19:30">07:30 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                    <option value="20:30">08:30 PM</option>
                                    <option value="21:00">09:00 PM</option>
                                    <option value="21:30">09:30 PM</option>
                                    <option value="22:00">10:00 PM</option>
                                    <option value="22:30">10:30 PM</option>
                                    <option value="23:00">11:00 PM</option>
                                    <option value="23:30">11:30 PM</option>
                                </select>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 pt-4 text-end"> 
                            <button type="submit" class="cs-btn cs-style1 py-1" name="ADDCUSTOMAVAILABILITY" id="saveAvailability">Save</button>
                        </div>
                    </div>
                    
                </form>
                    
                </div>
                 
            </div>
        </div>
    </div>
    
    
<!-- Modal -->
    <div class="modal fade" id="availabilityExceptionModal" tabindex="-1" aria-labelledby="availabilityExceptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgb(25 24 24);border-radius: 8px;width: 100%;max-width: 400px;border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="availabilityExceptionModalLabel">Set Exception</h5>
                    <button type="button" class="btn-close pb-3" data-bs-dismiss="modal" aria-label="Close" style="background: none;">
                        <i class="fa fa-times text-white h3 mb-0 pb-0"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="row"> 
                            <div class="input col-md-12 col-md-12">
                                <label for="ExceptionDate" class="small">Exception Date:</label>
                                <input type="date" id="ExceptionDate" name="ExceptionDate" class="cs-form_field py-1" required>
                                <small>I am unavailable on this day</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pt-4 text-end"> 
                                <button type="submit" class="cs-btn cs-style1 py-1" name="ADDEXCEPTION" id="saveAvailabilityException">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const systemcurrentDate = new Date();
            
            const currentMonthNumber = systemcurrentDate.getMonth();
            const currentYearNumber = systemcurrentDate.getFullYear();
            
            let currentYear = currentYearNumber;
            let currentMonth = currentMonthNumber;
            
            const availabilityModal = new bootstrap.Modal(document.getElementById("availabilityModal"));
            const selectedDateText = document.getElementById("selectedDateText");
            const availabilityDate = document.getElementById("availabilityDate");
            const availabilityFromInput = document.getElementById("availabilityfrom");
            const availabilityToInput = document.getElementById("availabilityto");
            // const availabilityInput = document.getElementById("availability");
            const saveAvailabilityBtn = document.getElementById("saveAvailability");
            let selectedDayElement = null;
            
            // Format time from 24h to 12h
            function formatTime(time) {
                const [hours, minutes] = time.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const formattedHour = hour % 12 || 12;
                return `${formattedHour}:${minutes} ${ampm}`;
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
        
                // Add empty cells for days before the first day of the month
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day';
                    const emptyDayInner = document.createElement('div');
                    emptyDayInner.className = 'calendar-day-inner';
                    emptyDay.appendChild(emptyDayInner);
                    calendarGrid.appendChild(emptyDay);
                }
        
                // Add calendar days
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(year, month, day);
                    const dayOfWeek = date.getDay(); 
                    
                    const NameOfDay = date.toLocaleString('en-us', { weekday: 'long' });
                    // Removed 
                    
                    var month = date.getMonth();
                    var Year = date.getFullYear();
                    
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day';
                    
                    dayCell.dataset.day = day;
                    
                    const dayCellInner = document.createElement('div');
                    dayCellInner.className = 'calendar-day-inner skeletoneffect';
                    
                    var month1 = month + 1;
                    if (dayOfWeek >= 0 && dayOfWeek <= 7) { // Monday to Friday
                     

                        
                    var excepdate = `${year}-${month1}-${day}`;  // Format the date as 'YYYY-MM-DD'
                    
                // First fetch request for custom availability
            	fetchAvailability({
            		userid: <?php echo $Userrow['ClubId']; ?>,
            		date: excepdate,
            		getexceptionbydate: true
            	}, data => {
            		if (data.success) {
            		    updateUnavailableDayCell(dayCell, day, year, month1);
            		} else {
            	
            	var customselectedDate = `${year}-${month1}-${day}`;  // Format the date as 'YYYY-MM-DD'
                   // First fetch request for custom availability
                	fetchAvailability({
                		userid: <?php echo $Userrow['ClubId']; ?>,
                		date: customselectedDate,
                		getcustomavailabilitybydate: true
                	}, data => { 
                		if (data.success) {
                			updateDayCell(dayCell, day, data.availability.starttime, data.availability.endtime, year, month1);
                		} else {
                			// Second fetch request for day-wise availability if custom availability is not found
                			fetchAvailability({
                				userid: <?php echo $Userrow['ClubId']; ?>,
                				weekdayname: NameOfDay,
                				getavailabilitybydayname: true
                			}, data => {
                				if (data.success) {
                					updateDayCell(dayCell, day, data.availability.starttime, data.availability.endtime, year, month1);
                				} else {
                				    updateUnavailableDayCell(dayCell, day, year, month1);
                				}
                			});
                		}
                	});
                	
                    
            		}
            	}); //Exceptions Checking Ends
        
        
                    } else {
                        updateUnavailableDayCell(dayCell, day, year, month1);
                    } 
        
                    dayCell.appendChild(dayCellInner);
                    
                    dayCell.addEventListener("click", function () {
                        
                        selectedDayElement = this; 
                        
                        var dayContent = selectedDayElement.querySelector('.calendar-day-content');
                        var dataDate = dayContent.getAttribute('data-date');
                        
                        var dayCellDate = dataDate;
                        dayCellDate = new Date(dayCellDate);
                        const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
                        const formattedDate = dayCellDate.toLocaleDateString('en-GB', options);

                        selectedDateText.innerHTML = '<strong>' + formattedDate + '</strong>';
                        availabilityDate.value = dataDate;
                        availabilityFromInput.value = "";
                        availabilityToInput.value = "";
                        availabilityModal.show();
                    });
                    
                    
                    calendarGrid.appendChild(dayCell);
                }
            }
             
            saveAvailabilityBtn.addEventListener("click", function () {
                if (selectedDayElement && availabilityFromInput.value !== '' && availabilityToInput.value !== '') {
                    selectedDayElement.innerHTML = `
                    <div class="calendar-day-header">${selectedDayElement.dataset.day}</div>
                            <div class="calendar-day-content" data-date="" data-starttime="${availabilityFromInput.value}" data-endtime="${availabilityToInput.value}">
                                <div>${availabilityFromInput.value} - ${availabilityToInput.value}</div>
                            </div>`;
                    availabilityModal.hide();
                }
            });
        
            // Initialize month navigation
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
        
            // Initialize calendar
            generateCalendar(currentYear, currentMonth);
        });
        
        // Function to handle availability fetch
	function fetchAvailability(dataPayload, successCallback) {
		fetch('actions/post.php', {
			method: 'POST',
			body: JSON.stringify(dataPayload),
			headers: { 'Content-Type': 'application/json' }
		})
		.then(response => response.json())
		.then(data => successCallback(data))
		.catch(error => console.error('Error fetching availability:', error));
	}
        
        // Function to update the day cell content
	function updateDayCell(dayCell, day, starttime, endtime, year, month1) {
	    let starttimeParts = starttime.split(":");
	    let endtimeParts = endtime.split(":");
		dayCell.classList.add('has-schedule');
		dayCell.innerHTML = `
			<div class="calendar-day-header">${day}</div>
			<div class="calendar-day-content" data-date="${year}-${month1}-${day}" data-starttime="${starttime}" data-endtime="${endtime}">
				<div>${starttimeParts[0]}:${starttimeParts[1]} - ${endtimeParts[0]}:${endtimeParts[1]}</div>
				<div class="slot-edit-icon"><i class="fa fa-pen-to-square"></i></div>
			</div>
		`;
	}  
	
	// Function to update the day cell content as Un Available
	function updateUnavailableDayCell(dayCell, day, year, month1) {
		dayCell.innerHTML = `
			<div class="calendar-day-header">${day}</div>
			<div class="calendar-day-content" data-date="${year}-${month1}-${day}">
				<div>Unavailable</div>
				<div class="slot-edit-icon"><i class="fa fa-plus"></i></div>
			</div>
		`;
	}
        </script>


  <!-- Start CTA -->
  <?php include('update/footer.php');?>
    
   
  
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script> 
        $(document).ready(function() {          

            $('#timezoneId').select2({
              tags: false,
                placeholder: "Search Here *", // Set the placeholder text
              width: 'resolve', // Adjust width to fit container  
            });
    		 
    		$('#timezoneId').on('change', function() {
              $('#timezoneForm').submit(); // Submit the form
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
		 
       });
       
       
       

    </script>
    
    </body>
</html>