<?php 
session_start(); 

    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script> window.location.href="/login.php"; </script>';
        exit;
    }
    
    include('../../inc/functions.php');
    $postObj = new Story();
    
    require_once($_SERVER['DOCUMENT_ROOT'] . '/users/update/inc/meeting_bookings.php');
    
    $Obj = new MeetingBookingUtility();
    $ClubUsers = $Obj->GetAllWAHClubUsers();
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
    if($clubuser['subscription_status'] !== 'paid') {
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
    
    require_once '../../googlemeet/google_config.php';
    $client = getClient();
    
    // Redirect to Google OAuth authentication if not authenticated
    $authUrl = $client->createAuthUrl();
     
    if(isset($_POST['CREATEONEONONE_MEETING'])) {
         
        if (isset($_SESSION['CREATE_ONEONONE_MEETING'])) { 
           unset($_SESSION['CREATE_ONEONONE_MEETING']);
        }
        $_SESSION['CREATE_ONEONONE_MEETING'] = [
            'user_id' => $_POST['participantid'],
            'member_id' => $Userrow['ClubId'],
            'meeting_title' => $_POST['OneMeetingTitle'],
            'meeting_note' => $_POST['OneMeetingnote'],
            'meeting_date' => $_POST['OneNewDate'],
            'start_time' => $_POST['from-time'],
            'end_time' => $_POST['to-time'],
            'status' => 'Confirmed'
        ];
        echo '<script>window.location.href="'.$authUrl.'";</script>';
        
    }
    if(isset($_POST['CREATEGROUPMEETING'])) {
        
        if($_POST['GroupParticipantsIds'] != '') {
            // $resp = $Obj->CreateGroupMeeting($_POST['GroupParticipantsIds'], $Userrow['ClubId'], $_POST['newDate'], $_POST['Groupfrom-time'], $_POST['Groupto-time'], $timeZOne, $meetingLink, $_POST['MeetingTitle'], $_POST['MeetingNote']);
             
            if (isset($_SESSION['CREATEGROUP_MEETING'])) { 
               unset($_SESSION['CREATEGROUP_MEETING']);
            }
        $Ids = explode(',', $_POST['GroupParticipantsIds']);
        $Ids_unique = array_unique($Ids);
        $ParticipantsIds = implode(',', $Ids_unique);
             
            $_SESSION['CREATEGROUP_MEETING'] = [
                'user_ids' => $ParticipantsIds,
                'member_id' => $Userrow['ClubId'],
                'meeting_title' => $_POST['MeetingTitle'],
                'meeting_note' => $_POST['MeetingNote'],
                'meeting_date' => $_POST['newDate'],
                'start_time' => $_POST['Groupfrom-time'],
                'end_time' => $_POST['Groupto-time'],
                'status' => 'Confirmed'
            ];
            echo '<script>window.location.href="'.$authUrl.'";</script>';
        } else {
            echo '<script>alert("No Member Selected for Invitation!");</script>';
        }
        
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
    
  <title>Create Meeting | <?=$Userrow['name']?></title>
  
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
    :root{
        --bs-link-color: #ffffff;
        --bs-link-hover-color: #ffffff;
    } 
    .btn {
        --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(#d91845, .5);
    }
    
    .btn-primary{
        background-color: #3a3a3a;
        border-color: #262525;
    }
    
    .btn-primary.active, .btn-primary:focus, .btn-primary:hover{
        
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
    .btn-outline-primary-botstrap {
        border-color: #0d6efd; 
        color: #0d6efd;
    }
    
    .text-transform-none {
        text-transform:none
    }
    
    .btn-outline-primary-botstrap:hover, .btn-outline-primary-botstrap:focus {
        background-color: #0d6efd;
        border-color: #0d6efd; 
    }
      #Groupmeeting-wrapper, #viewparticipantprofile {
         display: none;
     }
    
    /* Confirm Modal */
    .card{
	    background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
	}
    .card-header{
	    border-bottom: 1px solid #404042 ;
	}
	.btn-close{
	    background-color: white;
	    font-size:15px;
	}
	.card-header .card-title{ 
        font-size: 23px;
        font-weight: 400;
    } 
    .card-content {
        background: #2f2f2f;
    }
    .card .form-control{
        background: #181818;
        border-color: #333;
        color: #fff;
    }
    /* Confirm Modal Ends */
      
    .select2-container{
        width: 100% !important;
    }
    
    .select2-dropdown {
        z-index: 9999999999;
    }
    .select2-search--dropdown {
        background: #181818;
    }
    .select2-results__options {
    	background: #181818 !important;
    }
    .select2-container--default .select2-results__option--selected {
    	background-color: #000000 !important;
    }
    
    .select2-container--default .select2-search--dropdown .select2-search__field {
        background: #181818;
        border-radius: 4px;
    }
    
    .select2-container--default .select2-selection--single {
        background-color: #181818;
        height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered { 
        color: #fff;
        line-height: 36px;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        padding-top: 5px !important;
        padding: 0px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 3px;
    }
        
    
    /*For Multiple*/
    /*// ##################################################### */
    .select2-container--default .select2-selection--multiple {
		background-color: #181818 !important;
		border: 1px solid #999696 !important;
		border-radius: 8px  !important;
	
	}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
		padding: 2px 4px  !important;
		    color: #ffffff  !important;
		    border-right: 1px solid #6c6969;
	}
	
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #000000  !important;
		border: 2px solid #000000  !important;
		padding: 2px  !important;
		padding-left: 25px !important;
	}
	
	.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
		color: #e6e3e3  !important;
	}
        
    .select2-container .select2-search--inline .select2-search__field {
	    height: 25px !important;
        line-height: 25px;
	}
	.select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below {
	    border: 2px solid #333 !important;
        border-radius: 10px !important;
        padding: 0px 10px;
        background: #181818;
	}
    
    .form-label {
        font-size: 13px;
    }
    
    #CREATEONEONONE_MEETING, #CREATEGROUPMEETING, #MemberCountByKeyword, #MemberCountByCatg {
        display: none;
    }
      
 </style>
    
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
  </script>
     
     
     
 <?php include('../../header.php');?>
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
                    <?php $Dmenu = 8;?>
                    <?php include('../user.leftmenu.php');?>
                  </div>
                </div>
            </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
            <div class="row">
                <div class="col-sm-8"> 
                    <h4 class="mb-2">Create Meeting</h4>
                </div>
                <div class="col-sm-4 text-end"> 
                     <a class="btn btn-primary active" href="/users/member.bookingrequests.php">
                        <i class="fas fa-list me-2"></i>My Meetings
                    </a> 
                </div>
                <hr class="mb-4">
            </div>
            
            <div class="row">
                <div class="col-sm-12 col-lg-12"> 
                    <button class="btn btn-primary active" id="createMeetingOnetoOne">
                        <i class="fas fa-plus me-2"></i>Schedule One-On-One Meeting
                    </button>
                    
                    <button class="btn btn-primary" id="createMeetingGroup">
                        <i class="fas fa-plus me-2"></i>Schedule Group Meeting
                    </button>
                    
                </div>
                
                <div class="col-sm-12 col-lg-12" id="oneononemeeting-wrapper"> 
                    
                    <div class="card mt-5">
                        <form method="post" action="">
                            <div class="card-header">
                                <h5 class="card-title mb-0" id="createMeetingOnetoOneModalLabel">
                                    Create a One-on-One Meeting
                                </h5> 
                                
                                <p class="mb-0">
                                    (Select date and time to create a new meeting.)
                                </p>
                            </div>
            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="OneMeetingTitle" class="form-label">Meeting Title *</label>
                                            <input type="text" class="form-control" id="OneMeetingTitle" name="OneMeetingTitle" placeholder="Enter meeting title" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="OneMeetingnote" class="form-label">Meeting Notes</label>
                                            <textarea class="form-control" id="OneMeetingnote" name="OneMeetingnote" placeholder="Enter Meeting notes"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                         
                                        <div class="mb-3">
                                            <label for="OneNewDate" class="form-label">Date *</label>
                                            <input type="date" class="form-control" id="OneNewDate" name="OneNewDate" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="OneFromTime" class="form-label">From *</label>
                                            <select id="one-from-time" name="from-time" class="form-control" required>
                                                <!-- Options for 24 hours with 30-minute intervals -->
                                                <option value="">Choose Time</option>
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="OneToTime" class="form-label">To </label>
                                            <input type="time" class="form-control" id="one-to-time" name="to-time" required readonly />
                                        </div>
                                    </div>
            
                                    <div class="col-md-12">
                                        <div class="mb-1">
                                            <label for="createmeetingparticipants" class="form-label">Choose Participant *
                                            </label> 
                                           
                            <select id="OneOnOneParticipant" class="form-control" name="participantid" required>
                                <option value=""></option>
                    <?php 
                            if($ClubUsers !== NULL) {
                                foreach($ClubUsers as $ClubUser) { 
                                if($ClubUser['subscription_status'] === 'paid') {
                                ?>
                                    <option value="<?=$ClubUser['id']?>"><?=$ClubUser['firstname']?></option>
                    <?php           }
                                }
                            }       ?>
                            
                            </select> 
                                            
                                        </div>
                                        <a href="" id="viewparticipantprofile" target="_blank" class="btn btn-primary mt-2 py-1 px-2" style="font-size: 13px;"> View Profile <i class="fa fa-arrow-right"></i> </a>
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="card-footer"> 
                             <span id="errormsg" class="text-danger cs-primary_font" style="display: none; font-size: 16px;"><i class="fa-solid fa-triangle-exclamation"></i> Slot not available, kindly select different slot.</span>
                                <span id="errormsg2" class="text-danger cs-primary_font" style="display: none; font-size: 16px;"><i class="fa-solid fa-triangle-exclamation"></i> Kindly select date & time!</span>
                                <br>
                                
                                <button type="button" class="btn btn-primary text-transform-none" id="CREATEONEONONE_MEETING_DISABLED" disabled>Create Meeting</button>
                                <button type="submit" class="btn btn-primary text-transform-none active" name="CREATEONEONONE_MEETING" id="CREATEONEONONE_MEETING">Create Meeting</button>
                                
                            </div>
                        </form>
                    </div>
                    
                </div>
                
                
                <div class="col-sm-12 col-lg-12" id="Groupmeeting-wrapper"> 
                    
                    <div class="card mt-5">
                        <form method="post" action="">
                            
                            <div class="card-header">
                                <h5 class="card-title mb-0" id="createMeetingcardLabel">Create a Group Meeting</h5> 
                                <p class="mb-0">(Select date and time to create a new meeting.)</p>
                            </div>
                        <input type="hidden" class="form-control" id="GroupParticipantsIds" name="GroupParticipantsIds"/>
                            <div class="card-body"> 
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="MeetingTitle" class="form-label">Meeting Title *</label>
                                            <input type="text" class="form-control" id="MeetingTitle" name="MeetingTitle" placeholder="Enter meeting title" required />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="Meetingnote" class="form-label">Meeting Notes</label>
                                            <textarea class="form-control" id="Meetingnote" name="MeetingNote" placeholder="Enter Meeting notes"></textarea>
                                        </div>
                                    </div>
                                        
                                        <div class="mb-3">
                                            <label for="newDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="newDate" name="newDate" required>
                                        </div>
                                        <span id="errormsg_fieldNotSelected" class="text-danger cs-primary_font" style="display: none; font-size: 16px;"><i class="fa-solid fa-triangle-exclamation"></i> Kindly select date & time!</span>
                                
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newTime" class="form-label">From</label>
                                            <select id="from-time" name="Groupfrom-time" class="form-control" required>
                                                <!-- Options for 24 hours with 30-minute intervals -->
                                                <option value="">Choose Time</option>
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newTime" class="form-label">To
                                            </label>
                                            <input type="time" class="form-control" name="Groupto-time" id="createmeetingtotime" required readonly>
                                        </div>
                                    </div> 
                                    
                                    <span id="NotAvailable_errormsg" class="text-danger cs-primary_font" style="display: none; font-size: 16px;"> <i class="fa-solid fa-triangle-exclamation"></i> Slot not available from your side, kindly select different slot.</span>
                                    
        <div class="col-md-12 mt-4">
            <h5 class="mb-2"> Who do you want to invite?</h5>
            <hr>
            
            <div class="mb-3 mt-2">
                <label for="MultipleParticipantSelect" class="form-label">Select Individually
                </label>
                
                <select class="form-control" name="inviteIndividuallyparticipant[]" id="MultipleParticipantSelect" multiple="multiple">                                
                    <option value=""></option>
                    <?php 
                            if($ClubUsers !== NULL) {
                                foreach($ClubUsers as $ClubUser) { 
                                if($ClubUser['subscription_status'] === 'paid') {
                                ?>
                                    <option value="<?=$ClubUser['id']?>"><?=$ClubUser['firstname']?></option>
                    <?php           }
                                }
                            }       
                    ?>
                </select>
            </div>
            
            <p class="form-label">OR</p>
                
            <div class="mb-3 mt-2">
                <label for="invitekeyword" class="form-label">Select Keyword
                </label>
                
                <select id="invitekeyword" class="form-control" name="participant">                                
                    <option value=""></option>
                    <?php include('filter_keywords.php');?>
                </select>
                <p id="MemberCountByKeyword" class="small text-primary"><span></span> Members Selected</p>
                
            </div>
            
            <label class="form-label">Select Category
                </label>
        </div>
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg1" class="form-label">
                <input type="checkbox" id="catg1" class="categoryCheck" value="Legal, Financial Experts"> Legal & Financial Experts
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg2" class="form-label">
                <input type="checkbox" id="catg2" class="categoryCheck" value="Founder, Entrepreneur"> Founders &amp; Entrepreneurs
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg3" class="form-label">
                <input type="checkbox" id="catg3" class="categoryCheck" value="Influencer, Artist"> Influencers & Artists
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg4" class="form-label">
                <input type="checkbox" id="catg4" class="categoryCheck" value="Wellness"> Wellness
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg5" class="form-label">
                <input type="checkbox" id="catg5" class="categoryCheck" value="5"> Coaches
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg6" class="form-label">
                <input type="checkbox" id="catg6" class="categoryCheck" value="6"> Education Counsellors 
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg7" class="form-label">
                <input type="checkbox" id="catg7" class="categoryCheck" value="7"> Sports 
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg8" class="form-label">
                <input type="checkbox" id="catg8" class="categoryCheck" value="8"> Marketing 
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg9" class="form-label">
                <input type="checkbox" id="catg9" class="categoryCheck" value="9"> Architects & Designers 
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg10" class="form-label">
                <input type="checkbox" id="catg10" class="categoryCheck" value="Hospitality"> Hospitality  
                </label>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-1">
                <label for="catg11" class="form-label">
                <input type="checkbox" id="catg11" class="categoryCheck" value="11"> Practitioners  
                </label>
            </div>
        </div>
                                     
                                    
                                </div>
                            
                <p id="MemberCountByCatg" class="small text-primary"><span></span> Members Selected</p>
                
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary text-transform-none" id="CREATEGROUPMEETING_DISABLED" disabled>Create Meeting</button>
                                <button type="submit" class="btn btn-primary text-transform-none active" name="CREATEGROUPMEETING" id="CREATEGROUPMEETING">Create Meeting</button>
                            </div>
                            
                        </form>
                    </div>
                    
                </div>
                
            </div>
          
          <br>
         
         
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
   <!-- Start CTA -->
  <?php include('../../footer.section.php');?>
  <?php include('../footer.commonJS.php');?> 
   
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script> 
       $(document).ready(function(){
            
            $('#invitekeyword').select2({
                placeholder: 'Select a keyword',
                allowClear: true
            });
            
            $('#MultipleParticipantSelect').select2({
                tags: false,
                placeholder: "Search any Member *", // Set the placeholder text
                width: 'resolve', // Adjust width to fit container
             });
            
            $('#OneOnOneParticipant').select2({
                placeholder: 'Select a participant',
                allowClear: true
            });
            
            $('#createMeetingOnetoOne').click(function(){
                $('#createMeetingGroup').removeClass('active');
                $('#createMeetingOnetoOne').addClass('active');
                $('#Groupmeeting-wrapper').hide(); 
                $('#oneononemeeting-wrapper').show();
            });
            $('#createMeetingGroup').click(function(){
                $('#createMeetingOnetoOne').removeClass('active');
                $('#createMeetingGroup').addClass('active');
                $('#oneononemeeting-wrapper').hide();
                $('#Groupmeeting-wrapper').show();
            });
            
           
           $('#OneNewDate').on('input', function(){
               $('#OneOnOneParticipant').val(null).trigger('change');
           });
           
           $('#one-from-time').change(function(){
               
               $('#OneOnOneParticipant').val(null).trigger('change');
               let fromtime = $(this).val();
               var timeParts = fromtime.split(':');
               
               if(timeParts[1] === '00'){
                   var newtimeHour = timeParts[0];
                   var newtimeMin = 30;
               } else { 
                   var newtimeHour = (parseInt(timeParts[0], 10) + 1).toString().padStart(2, '0');
                   var newtimeMin = '00';
               }
               if(newtimeHour == 24) {
                   newtimeHour = '00';
               }
              let fromtimes = newtimeHour + ':' + newtimeMin;
              $('#one-to-time').val(fromtimes);
           });
           
        //   Group Meeting Select Time
           $('#from-time').change(function(){
               let fromtime = $(this).val();
               var timeParts = fromtime.split(':');
               
               if(timeParts[1] === '00'){
                   var newtimeHour = timeParts[0];
                   var newtimeMin = 30;
               } else { 
                   var newtimeHour = (parseInt(timeParts[0], 10) + 1).toString().padStart(2, '0');
                   var newtimeMin = '00';
               }
               
               if(newtimeHour == 24) {
                   newtimeHour = '00';
               }
              let fromtimes = newtimeHour + ':' + newtimeMin;
            //   console.log(fromtimes);
              $('#createmeetingtotime').val(fromtimes);
              
           });
        });
    
    </script>
    
    <script> 
        $(document).ready(function() {
            
            $('#OneOnOneParticipant').change(function(){
                var selected_ParticipantId = $(this).val();
                var selected_StartTime = $('#one-from-time').val();
                var selected_slotdate = $('#OneNewDate').val();
                
        var selectedDateTime = new Date(selected_slotdate);
        var currentDate = new Date();

        var todayOnly = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        
        if (selectedDateTime > todayOnly) {
                
            if (selected_ParticipantId && selected_slotdate && selected_StartTime) {
                
                selected_StartTime = selected_slotdate + ' ' + selected_StartTime; 
                
                async function runSlotCheck() {
                    try {
                        await checkmemberslot(selected_ParticipantId, <?=$Userrow['ClubId']?>, selected_StartTime);
                        return true;
                    } catch (err) {
                        return false;
                    }
                }
                var isAvailable = runSlotCheck();
                if(isAvailable) {
                    $.ajax({
                        url: 'post.php',
                        type: 'POST',
                        data: {userid: selected_ParticipantId, GetUserData: true},
                        success: function(response){
                                if (typeof response === 'string') {
                                    response = JSON.parse(response);  // Parse if it's a string
                                }
                                $('#viewparticipantprofile').show();
                                $('#viewparticipantprofile').attr('href', '/wahclub/' + response.slug_username);
                                $('#errormsg2').hide();
                        },
                         error: function(xhr, status, error) {
                            console.error("Status:", status);
                            alert("An error occurred");
                        }
                    });
                } //isAvailable Ends
            
            
            } else {
                
                $('#errormsg2').show();
            }
        } else {
            alert("You Have Selected Past Date");
            $('#OneNewDate').val('');
            $('#one-from-time').val('');
            $('#one-from-to').val('');
            $('#errormsg2').show();
            //Selected Past Date
        }
            
            });
        });
        
        function checkmemberslot(userid, memberid, starttime){
            //To check User is not booked already
            $.ajax({
                url: 'post.php',
                type: 'POST',
                data: {userid: userid, memberid: memberid, starttime: starttime, CheckSlot: true},
                success: function(response){ 
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }
                        if(response.status == 'AVAILABLE') {
                            $('#errormsg').hide();
                            $('#CREATEONEONONE_MEETING_DISABLED').hide();
                            $('#CREATEONEONONE_MEETING').show();
                        }else{
                            $('#CREATEONEONONE_MEETING').hide();
                            
                            $('#errormsg').show();
                        }
                },
                 error: function(xhr, status, error) {
                     $('#CREATEONEONONE_MEETING').hide();
                }
            });
        }
    </script>
    
    
    <script>
    // Group meetings ##############################################
    // Group meetings ##############################################
    
        $(document).ready(function(){
           $('#newDate').on('input', function(){
               
               var DateValue = $(this).val();
               var timeValue = $('#from-time').val();
               
        var selectedDateTime = new Date(DateValue);
        var currentDate = new Date();

        var todayOnly = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        if (selectedDateTime > todayOnly) {
            
            if(timeValue && DateValue){
               let StartTime = DateValue + ' ' + timeValue;
                GetAvailabilityByDateTime(<?=$Userrow['ClubId']?>, StartTime);
                $('#errormsg_fieldNotSelected').hide();
           } else {
                $('#errormsg_fieldNotSelected').show();
           }
           
        } else {
            alert("You Have Selected Past Date");
            $('#newDate').val('');
            $('#from-time').val('');
            $('#createmeetingtotime').val('');
            $('#errormsg_fieldNotSelected').show();
            //Selected Past Date
        }
               
               
               
           });
           
           $('#from-time').change(function(){
               var timeValue = $(this).val();
               var DateValue = $('#newDate').val();
               if(timeValue && DateValue){
                   let StartTime = DateValue + ' ' + timeValue;
                    GetAvailabilityByDateTime(<?=$Userrow['ClubId']?>, StartTime);
                   $('#errormsg_fieldNotSelected').hide();
               } else {
                   $('#errormsg_fieldNotSelected').show();
               }
           });
           
           
           $('#invitekeyword').change(function(){
               var keyword = $(this).val();
               if(keyword){
                   GetClubUsersBykeyword(<?=$Userrow['ClubId']?>, keyword);
                }
           });
            
            $('.categoryCheck').click(function(){
                if ($(this).prop('checked')) {
                    var catg = $(this).val();
                    if(catg){
                       SearchByCategory(<?=$Userrow['ClubId']?>, catg);
                    }
                }
           });
           
           
        });
        
        function GetAvailabilityByDateTime(memberid, starttime){
            //To check User is not booked already
            $.ajax({
                url: 'post.php',
                type: 'POST',
                data: {memberid: memberid, starttime: starttime, CheckSlotByDate: true},
                success: function(response){ 
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }
                        if(response.status == 'AVAILABLE') {
                            $('#NotAvailable_errormsg').hide();
                            $('#CREATEGROUPMEETING_DISABLED').hide();
                            $('#CREATEGROUPMEETING').show();
                        }else{
                            $('#CREATEGROUPMEETING').hide();
                            
                            $('#CREATEGROUPMEETING_DISABLED').show();
                            $('#NotAvailable_errormsg').show();
                        }
                },
                 error: function(xhr, status, error) {
                     $('#CREATEGROUPMEETING').hide();
                }
            });
        }
        
        function GetClubUsersBykeyword(memberid, keyword){
            // Search Users By Keyword and fetch
            $.ajax({
                url: 'post.php',
                type: 'POST',
                data: {memberid: memberid, keyword: keyword, SearchByKeyword: true},
                success: function(response){ 
                    console.log(response); 
                    $("#MemberCountByKeyword").hide();
                    
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        } 
                        if(response.users){
                            $('#MultipleParticipantSelect').val([]).trigger('change');
                            $("#MemberCountByKeyword").show();
                            $("#MemberCountByKeyword span").html(response.users.length);
                            console.log(response.users.length);
                            let ids = [];
                            response.users.forEach(user => {
                                ids.push(user.id);
                            }); 
                            $('#GroupParticipantsIds').val(ids.join(','));
                        }
                },
                 error: function(xhr, status, error) {
                    console.log("An Error Accuring, while fetching!");
                }
            });
        }
        
        function SearchByCategory(memberid, category){
            // Search Users By Keyword and fetch
            $.ajax({
                url: 'post.php',
                type: 'POST',
                data: {memberid: memberid, catg: category, SearchByCategory: true},
                success: function(response){ 
                    console.log(response);
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        } 
                        
                        if(response.users){
                            $('#MultipleParticipantSelect').val([]).trigger('change');
                            $("#MemberCountByCatg").show();
                            $("#MemberCountByCatg span").html(response.users.length);
                            
                            let ids = [];
                            response.users.forEach(user => {
                                
                                let currentUsers = $('#GroupParticipantsIds').val();
                                $('#GroupParticipantsIds').val(currentUsers ? currentUsers + ',' + user.id : user.id);
                            }); 
                            
                        }
                },
                 error: function(xhr, status, error) {
                    console.log("An Error Accuring, while fetching!");
                }
            });
        }
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
            
            
            $('#MultipleParticipantSelect').on('change', function() {
                // Get the selected users
                var selectedUsers = $(this).val();
                
                // Join the selected users with a comma and update the second input field
                $('#GroupParticipantsIds').val(selectedUsers.join(', '));
            });
            
            
        });
    </script>
    
    <?php
    
    /*$users = $Obj->GetWAHClubUsersWithFilter('Founder');
    if($users) {
        
        $html = "<table border='1'>";
        $html .= "<tr><th>First Name</th><th>Role</th><th>degree</th><th>Email</th></tr>";
        $prevemail = '';
        
        foreach ($users as $user) {
            if ($prevemail == $user['email']) {
                continue;
            }
            $html .= "<tr><td>" . htmlspecialchars($user['firstname']) . "</td>";
            $html .= "<td>" . htmlspecialchars($user['role']) . "</td>";
            $html .= "<td>" . htmlspecialchars($user['degree']) . "</td>";
            $html .= "<td>" . htmlspecialchars($user['email']) . "</td></tr>";
            $prevemail = $user['email'];
        }
        
        $fileContent = "<!DOCTYPE html>\n<html>\n<head><title>Users</title></head>\n<body>\n";
        $fileContent .= $html;
        $fileContent .= "\n</body>\n</html>";
        
        $json = json_encode($users, JSON_PRETTY_PRINT);
        
        $file = fopen("test.php", "w");
        if ($file) {
            fwrite($file, $fileContent);
            fclose($file);
        }
        
    }*/
    
    
    ?>
    
  </body>
</html>