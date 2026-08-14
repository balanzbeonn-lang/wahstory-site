<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    } 
    
    $Res_dateselected = $Res_strTimeselected = '';
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../inc/functions.php');
    $postObj = new Story();
    
    include('update/inc/meeting_bookings.php');
    $UtilityObj = new MeetingBookingUtility();
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
    if($clubuser['subscription_status'] !== 'paid') {
        echo '<script>window.location.href="/users/subscriptionplan.php";</script>';
        exit;
    }
    
    require_once '../googlemeet/google_config.php';
    $client = getClient();
    
    // Redirect to Google OAuth authentication if not authenticated
    $authUrl = $client->createAuthUrl();
    
    
    // ######### REJECT MEETING REQUEST AS MEMBER
    ##############################################################
    
    if(isset($_POST['rejectRequest']) && $_POST['rej_requestid'] != '') {
        
        $response = $UtilityObj->RejectBookingRequest($_POST['rej_requestid'], MeetingBookingUtility::BOOKING_REJECTED, $_POST['rej_remark']);
        
        if($response['status'] == 'success') {
            $UtilityObj->SendRejectBookingEmailMember($response['MemberName'], $response['MemberEmail'], $response['UserName']);
            $UtilityObj->SendRejectBookingEmailUser($response['UserName'], $response['UserEmail'], $response['MemberName']);
        }
    }
    
    // ######### WITHDRAW MEETING REQUEST AS USER
    ##############################################################
    
    if(isset($_POST['withdrawRequest']) && $_POST['rej_requestid'] != '') {
        $response = $UtilityObj->RejectBookingRequest($_POST['rej_requestid'], MeetingBookingUtility::BOOKING_WITHDRAWAL, $_POST['rej_remark']);
    }
    
    // ######### SEND RESCHEDULE MEETING REQUEST TO USER AS MEMBER
    ##############################################################
    
    if(isset($_POST['rescheduleMeeting']) && $_POST['res_requestid'] != '') {
          
        $response = $UtilityObj->RescheduleRequestSend($_POST['res_requestid'], MeetingBookingUtility::BOOKING_REQUESTED);
        
        if($response['status'] == 'success') {
            $bookingRow = $UtilityObj->GetBookingDetailsById($_POST['res_requestid']);
            $UtilityObj->SendRescheduleRequestToUserEmail($response['UserName'], $response['UserEmail'], $response['MemberName'], $bookingRow['slot_date'], $bookingRow['start_time']);
        }
    }
    
    // #### RESCHEDULE MEETING AND SET NEW DATE TIME FOR BOOKING BY USER TO MEMBER
    ##############################################################
    
    if(isset($_POST['rescheduleMeetingUpdate']) && $_POST['res_up_requestid'] != '') {
        $response = $UtilityObj->RescheduleMeetingUser($_POST['res_up_requestid'], $_POST['SelectedDateTimeInput']);
        
        if($response['status'] == 'success') {
            $UtilityObj->SendMeetingRescheduledToMemberEmail($response['MemberName'], $response['MemberEmail'], $response['UserName'], $_POST['SelectedDateTimeInput']);
        }
    }
    
    
    // #### CONFIRM BOOKING & CTEATE MEETING BY MEMBER
    ##############################################################
    
    if(isset($_POST['confirmMeeting']) && $_POST['conf_requestid'] != '') {
        
        if (isset($_SESSION['CONFIRM_MEETING'])) { 
           unset($_SESSION['CONFIRM_MEETING']);
        }
        $_SESSION['CONFIRM_MEETING'] = [
            'requestId' => $_POST['conf_requestid'],
            'status' => 'Confirmed',
            'remark' => $_POST['confirmRemark']
        ];
        echo '<script>window.location.href="'.$authUrl.'";</script>';
    }
    
    // #### CANCEL MEETING
    ##############################################################
    if(isset($_POST['cancelMeeting']) && $_POST['can_requestid'] != '') {
        
        $response = $UtilityObj->CancelMeeting($_POST['can_requestid'], MeetingBookingUtility::BOOKING_CANCELLED, $_POST['cancelRemark'], $Userrow['ClubId']);
        
        if($response['status'] == 'success') {
            if($Userrow['email'] == $response['MemberEmail']) {
                $UtilityObj->SendCancelMeetingEmail($response['UserName'], $response['UserEmail'], $response['MemberName'], $response['start_time']);
            } else {
                $UtilityObj->SendCancelMeetingEmail($response['MemberName'], $response['MemberEmail'], $response['UserName'], $response['start_time']);
            }
            
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
    
  <title>My Meetings | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WAHStory">
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
    :root{
        --bs-link-color: #ffffff;
        --bs-link-hover-color: #ffffff;
        
    } 
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
    .btn-outline-primary-botstrap {
        border-color: #0d6efd; 
        color: #0d6efd;
    }
    .btn-outline-primary-botstrap:hover, .btn-outline-primary-botstrap:focus {
        background-color: #0d6efd;
        border-color: #0d6efd; 
    }
    
    .nav-tabs {
        --bs-nav-tabs-link-hover-border-color: #00000000 #190d0d00 #dc3545;
        --bs-nav-tabs-link-active-color: #ffffff;
        --bs-nav-tabs-link-active-bg: #00000000;
        --bs-nav-tabs-link-active-border-color: #00000000 #00000000 #dc3545;
        --bs-nav-tabs-border-color: #dee2e600;
        --bs-nav-tabs-border-width: 0px;
    }
    
    .nav-tabs .nav-link {
        margin: 0;
        border-bottom: 3px solid transparent;
        text-transform: capitalize;
        padding: 0.55rem 1.25rem;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.5);
    }
    
    .nav-tabs button.nav-link::after {
         content: none;
    }
    
    .nav-tabs button.nav-link {
        box-shadow: none;
    }
    
    button {
        text-transform: capitalize;
    }
    
    .cs-font_11{
	    font-size: 11px;
	}
	.cs-style2:hover{
	    background: #043b46;
	    color: #1ab5d5;
	}
	.cs-style2{
	    border: 1px solid #02abd1;
	    border-radius: 15px;
        background: #065a6c;
	}
      
    .card {
           
        background: none;
        color: white; 
        padding: 10px;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    

    .card-cover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card-cover{
        background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        
    }
    .profile-card, .info-card {
        /*flex: 1;*/
        padding: 15px;
        position: relative; 
    }
    .card-body {
        padding: 10px;
    }

    #toolbar {
      margin: 0;
    }
    
    .text-muted{
        color: #a4a2a2 !important;
    }
    
    .table-dark thead th {
        background-color: rgba(241, 43, 89, 0.1);
        border-color: rgba(241, 43, 89, 0.2);
        color: #fff;
        font-weight: 600;
        padding: 12px;
    }
     
    table td, table th {
        font-size: 12px;
    }
    
    
    /* Confirm Modal */
    .modal-header{
	    border-bottom: 1px solid #404042 ;
	}
 
	.btn-close{
	    background-color: white;
	    font-size:15px;
	}
	
	.modal-header .modal-title{ 
        font-size: 23px;
        font-weight: 400;
    } 
    .modal-content {
        background: #2f2f2f;
    }
    .modal .form-control{
        background: #181818;
        border-color: #333;
        color: #fff;
    }
    /* Confirm Modal Ends */
    
    
    /* Date Time Slots */
    
        .previous-meeting{
            background: #181818;
            padding: 10px;
            border-radius: 10px;
        }
        
        #timesloats button {
            background-color: rgb(0 0 0);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            padding: 0.35rem 0.75rem;
            margin: 1%;
            border: 1px solid rgb(0 0 0);
            transition: all 0.3s ease;
            width: 20%;
        }
        
        button.Bookedtime-slot { 
            opacity: 0.4;
            cursor: not-allowed !important;
        }
        
        #timesloats button::after{
            content: none;
        }
        
        #timesloats button:hover:not(.Bookedtime-slot), #timesloats button.active {
            background-color: #f12b59;
            border-color: #f12b59;
            color: white; 
            box-shadow: 0 5px 15px rgba(241, 43, 89, 0.2);
        }
    
    /* Date Time Slots Ends */
    
    button.swal-button::after {
         content: none;
    }
    
    .swal-button {
        font-size: 12px;
        padding: 5px 10px;
        text-transform: capitalize;
    }
    .swal-title {
        font-size: 15px;
    }
    .swal-text {
        font-size: 13px;
    }
    
    .swal-button--confirm {
        background-color: #198754;
    }
    .swal-button--cancel {
        background-color: #e64942;
        color: #fff;
    }
    .swal-button--close {
        background-color: #5310f2;
    }
      
 </style>
    
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
  </script>
    
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
                    <?php $Dmenu = 8;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
            
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row">
              <?php if(isset($EMSG) && $EMSG != ""){ ?>
                <p style="color: #e9204f;">
                    <?=$EMSG?>
                </p>
            <?php } ?>
            <?php if(isset($SMSG) && $SMSG != ""){ ?>
                <p style="color: #40c985;">
                    <?=$SMSG?>
                </p>
            <?php } ?>
            
            <div class="col-sm-8"> 
                <h4 class="mb-2">My Meetings</h4>
                
            </div>
            <div class="col-sm-4 text-end"> 
                 <a class="btn btn-primary" href="/users/createmeeting/createmeeting.php">
                    <i class="fas fa-plus me-2"></i>Schedule New Meeting
                </a> 
            </div>
             
            
            <div class="col-sm-12 col-lg-12">
                <hr>
                
                <div class="row">
            
            <div class="col-sm-12 col-lg-12 mt-4 card-cover" style="min-height: 500px;">
                
                <nav class="info-card card">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        
                        <button class="nav-link active" id="nav-upcoming-tab" data-bs-toggle="tab" data-bs-target="#nav-upcoming" type="button" role="tab" aria-controls="nav-upcoming" aria-selected="true">Upcoming <span class="badge rounded-pill bg-primary ms-1">
                            <?= $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_CONFIRMED); ?>
                            </span></button> 
                        
                        <button class="nav-link" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false">Pending <span class="badge rounded-pill bg-warning ms-1"><?= $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_PENDING); ?></span></button>
                        
                        <button class="nav-link" id="nav-past-tab" data-bs-toggle="tab" data-bs-target="#nav-past" type="button" role="tab" aria-controls="nav-past" aria-selected="false">Past <span class="badge rounded-pill bg-secondary ms-1"><?= $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_COMPLETED); ?></span></button>
                         
                        <button class="nav-link" id="nav-cancelled-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelled" type="button" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled <span class="badge rounded-pill bg-danger ms-1"><?= $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_CANCELLED) + $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_REJECTED) + $UtilityObj->CountOfRequestsByStatus($Userrow['ClubId'], MeetingBookingUtility::BOOKING_WITHDRAWAL); ?></span></button>
                        
                      </div>
                </nav>
                <div class="tab-content mb-4" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="nav-upcoming" role="tabpanel" aria-labelledby="nav-upcoming-tab" tabindex="0">
            
            <!--Upcoming Meetings Starts-->
            
                <div class="table-responsive mb-4">
                    <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                      <thead>
                        <tr> 
                          <th>Booking Id</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Participants</th>
                          <th>Status</th> 
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody> 
                      
            <?php
            
            $rows = $UtilityObj->GetAllConfirmedBookingRequests_Member($Userrow['ClubId']); 
            
            // var_dump($rows);
            
            if($rows !== NULL) {
                $i = 1;
                foreach ($rows as $row) {
                    $host1 = $host2 = '';
                if($row['user_id'] == $Userrow['ClubId']) {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
                    $rescheduleModal = '#rescheduleModalUpdate';
                    $rescheduleBTN = 'rescheduleBTNUP';
                    $host2 = '(<small class="text-primary">Host</small>)';
                    
                } else {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                    $rescheduleModal = '#rescheduleModal';
                    $rescheduleBTN = 'rescheduleBTN';
                    $host1 = '(<small class="text-primary">Host</small>)';
                }
            
            ?>
                        <tr class="text-nowrap">
                            
                          <td>#WCBK000<?=$row['id']?></td> 
            
            <?php
                $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                $meetingStart_Time = $UtilityObj->ChangeTimezone($row['start_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $meetingEnd_Time = $UtilityObj->ChangeTimezone($row['end_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $SlotDate = date('Y-m-d', strtotime($meetingStart_Time));
            ?>
                          <td> <?= $UtilityObj->formatDate($SlotDate) ?>
                          </td>
            
                          <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?> (<?=$MemberTZRow['value']?>)
                          </td>
                          
                            <td>You <?=$host1?> & <a href="/wahclub/<?=$userrow['slug_username']?>" target="_blank"><?=$userrow['firstname'].' '.$userrow['lastname']?> <?=$host2?></a></td>
                            <td>
                                <span class="badge bg-success" data-bs-toggle="tooltip">Confirmed</span>    
                            </td>
                          
                           <td>
                            <div class="btn-group">
                                <a href="<?=$row['google_meet_link']?>" class="btn btn-sm btn-outline-primary-botstrap" data-bs-toggle="tooltip" data-bs-title="Join meeting!" target="_blank">
                                    <i class="fas fa-video me-1"></i>Join
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary <?=$rescheduleBTN?>" data-bs-toggle="modal" data-bs-target="<?=$rescheduleModal?>" data-id="<?=$row['id']?>" data-memberid="<?=$row['member_id']?>">
                                    <i class="fas fa-edit me-1"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger cancelBTN" data-bs-toggle="modal" data-bs-target="#cancelModal" data-id="<?=$row['id']?>">
                                    <i class="fas fa-times me-1"></i>
                                </button>
                            </div>
                          </td>
                           
                        </tr>
            <?php       } //End Foreach
                    } else { ?>
            
                        <tr>
                            <td colspan="6">
                                <p class="text-center my-5 text-muted">You don't have any upcoming meeting!</p>
                            </td>
                        </tr>
            <?php } ?>
                      
                        
                      </tbody>
                    </table>
                </div>
            
            <!--Upcoming Meetings Ends-->
            
            </div>
        
        <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab" tabindex="0">
        
            <!--pending Request Meetings Starts-->
            
                <div class="table-responsive mb-4">
                    <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                      <thead>
                        <tr> 
                          <th>Booking Id</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Participants</th>
                          <th>Status</th> 
                          <th>Comment</th> 
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody> 
            <?php
            
            $rows = $UtilityObj->GetAllPendingNewBookingRequests_Member($Userrow['ClubId']); 
            if($rows !== NULL) {
                
                $i = 1;
                foreach ($rows as $row) {
                    $host1 = $host2 = '';
                if($row['user_id'] == $Userrow['ClubId']) {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
                    $rescheduleModal = '#rescheduleModalUpdate';
                    $rescheduleBTN = 'rescheduleBTNUP';
                    $host2 = '(<small class="text-primary">Host</small>)';
                    $Reschedue_requested_msg = 'Host requested to reschedule, kindly reschedule it.';
                    $Reschedue_acknowledge_msg = "Waiting for host's confirmation.";
                    
                } else {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                    $rescheduleModal = '#rescheduleModal';
                    $rescheduleBTN = 'rescheduleBTN';
                    $host1 = '(<small class="text-primary">Host</small>)';
                    $Reschedue_requested_msg = 'Waiting for your participant to reschedule';
                    $Reschedue_acknowledge_msg = 'Waiting for your confirmation.';
                }
            ?>
                        <tr class="text-nowrap">
                            
                          <td>#WCBK000<?=$row['id']?></td> 
        <?php
            $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
            $meetingStart_Time = $UtilityObj->ChangeTimezone($row['start_time'], $row['slot_timezone'], $MemberTZRow['value']);
            $meetingEnd_Time = $UtilityObj->ChangeTimezone($row['end_time'], $row['slot_timezone'], $MemberTZRow['value']);
            $SlotDate = date('Y-m-d', strtotime($meetingStart_Time));
        ?>
                          <td> <?= $UtilityObj->formatDate($SlotDate) ?>
                          </td>
            
                          <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?> (<?=$MemberTZRow['value']?>)
                          </td> 
                          <td>You <?=$host1?> & <a href="/wahclub/<?=$userrow['slug_username']?>" target="_blank">
                                <?=$userrow['firstname'].' '.$userrow['lastname']?> <?=$host2?>
                                </a>
                          </td>
                          
                          
            <?php if($row['reschedule_status'] == 'Requested') { ?>
                          <td>
                            <span class="badge bg-warning text-dark" data-bs-toggle="tooltip" data-bs-title="<?=$Reschedue_requested_msg?>">Reschedule - <?=$row['status']?></span>    
                          </td>
                          
                          <td> 
                            <p><?=$Reschedue_requested_msg?></p> 
                          </td>
                          
            <?php   }else if($row['reschedule_status'] == 'Acknowledged') { ?>
                          <td>
                            <span class="badge bg-info text-dark" data-bs-toggle="tooltip" data-bs-title="<?=$Reschedue_acknowledge_msg?>">Acknowledged - <?=$row['status']?></span>    
                          </td>
                          <td> 
                            <p><?=$Reschedue_acknowledge_msg?></p> 
                          </td>
            <?php   }else {     ?>
                        <td>
                            <span class="badge bg-warning text-dark">
                                <?=$row['status']?></span>    
                        </td>
                        <td> 
                            <p>New Request</p> 
                          </td>
            <?php   }     ?>
            
                        
                        <td>
                            <div class="btn-group"> 
                        <?php if($row['user_id'] !== $Userrow['ClubId']) { ?>
                                <button type="button" class="btn btn-sm btn-outline-success confirmBTN" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="<?=$row['id']?>">
                                    <i class="fas fa-check me-1"></i>Confirm
                                </button>
                                
                        <?php 
                                $rajectBTN = 'rejectBTN';
                                $rajectModal = 'rejectModal';
                        }  else { 
                                $rajectBTN = 'withdrawBTN';
                                $rajectModal = 'withdrawModal';
                        }
                        
                // Not SHow Reschedule option if memebr already requested for reschedule
                        if ($row['member_id'] != $Userrow['ClubId'] || $row['reschedule_status'] == '') { 
                        ?>
                                <button type="button" class="btn btn-sm btn-outline-secondary <?=$rescheduleBTN?>" data-bs-toggle="modal" data-bs-target=" <?=$rescheduleModal?>" data-id="<?=$row['id']?>" data-memberid="<?=$row['member_id']?>"><i class="fas fa-edit me-1"></i></button>
                    <?php } ?>
                                <button type="button" class="btn btn-sm btn-outline-danger <?=$rajectBTN?>" data-bs-toggle="modal" data-bs-target="#<?=$rajectModal?>" data-id="<?=$row['id']?>"><i class="fas fa-times me-1"></i></button>
                            </div>
                        </td>
            
                          
                        </tr>
            <?php       } //End Foreach
                    } else { ?>
            
                        <tr>
                            <td colspan="7">
                                <p class="text-center my-5 text-muted">You don't have any pending request!</p>
                            </td>
                        </tr>
            <?php } ?>
                    
                      </tbody>
                    </table>
                </div>
            
            <!--pending Request Meetings Ends--> 
        </div>
        
        <div class="tab-pane fade" id="nav-past" role="tabpanel" aria-labelledby="nav-past-tab" tabindex="0">
        
            <!--Past Meetings Starts-->
                
                <div class="table-responsive mb-4">
                    <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                      <thead>
                        <tr> 
                          <th>Booking Id</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Participants</th>
                          <th>Status</th> 
                          <th>Your Reviews</th>
                          <th>Attendee Reviews</th>
                        </tr>
                      </thead>
                      <tbody> 
            
            <?php
            
            $rows = $UtilityObj->GetAllCompletedBookingRequests_Member($Userrow['ClubId']); 
            
            if($rows !== NULL) {
                $i = 1;
                foreach ($rows as $row) {
                    $host1 = $host2 = '';
                if($row['user_id'] == $Userrow['ClubId']) {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
                     
                    $host2 = '(<small class="text-primary">Host</small>)';
                    
                } else {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                     
                    $host1 = '(<small class="text-primary">Host</small>)';
                }
            
            ?>
                        <tr class="text-nowrap">
                            
                          <td>#WCBK000<?=$row['id']?></td> 
                         
            <?php
                $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                $meetingStart_Time = $UtilityObj->ChangeTimezone($row['start_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $meetingEnd_Time = $UtilityObj->ChangeTimezone($row['end_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $SlotDate = date('Y-m-d', strtotime($meetingStart_Time));
            ?>
                          <td> <?= $UtilityObj->formatDate($SlotDate) ?>
                          </td>
            
                          <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?> (<?=$MemberTZRow['value']?>)
                          </td>
                          
                          <td>You <?=$host1?> & <a href="/wahclub/<?=$userrow['slug_username']?>" target="_blank"><?=$userrow['firstname'].' '.$userrow['lastname']?> <?=$host2?></a></td>
                          <td>
                              <?php 
                    if($row['status'] == 'Confirmed') { ?>
                        <span class="badge bg-success" data-bs-toggle="tooltip">Completed</span> 
                    <?php } else{ ?>
                            <span class="badge bg-danger" data-bs-toggle="tooltip">Expired</span>    
                        <?php } ?>
                          </td>
                          
                          <td>
                              <?php $AttendeeMe = $UtilityObj->GetMyFeedback_Meeting($row['id'], $Userrow['ClubId']);
                                  if($AttendeeMe != NULL) {
                                      echo $AttendeeMe['attended_remarks'];
                                  }
                              ?>
                          </td>
                          
                          <td>
                              <?php $AttendeeParticipant = $UtilityObj->GetParticipantFeedback_Meeting($row['id'], $Userrow['ClubId']);
                                  if($AttendeeParticipant != NULL) {
                            echo $AttendeeParticipant['attended_remarks'];
                                  }
                              ?>
                          </td>
                          
                        </tr>
            <?php       } //End Foreach
                    } else { ?>
            
                        <tr>
                            <td colspan="7">
                                <p class="text-center my-5 text-muted">You don't have any past meeting!</p>
                            </td>
                        </tr>
            <?php } ?>
                        </tbody>
                    </table>
                </div> 
            
            <!--Past Meetings Ends-->
            
            
        </div>
         
        <div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
            <!--Cancelled Meetings Starts-->
            
                
                <div class="table-responsive mb-4">
                    <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                      <thead>
                        <tr> 
                          <th>Booking Id</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Participants</th>
                          <th>Status</th>   
                          <th>Remark</th>   
                        </tr>
                      </thead>
                      <tbody> 
            <?php
            
            $rows = $UtilityObj->GetAllCancelledRejectedBookingRequests_Member($Userrow['ClubId']); 
            
            if($rows !== NULL) {
                $i = 1;
                foreach ($rows as $row) {
                    
                    $host1 = $host2 = '';
                if($row['user_id'] == $Userrow['ClubId']) {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
                   
                    $host2 = '(<small class="text-primary">Host</small>)';
                    
                } else {
                    $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                    
                    $host1 = '(<small class="text-primary">Host</small>)';
                }
            
            ?>
                        <tr class="text-nowrap">
                            
                          <td>#WCBK000<?=$row['id']?></td> 
                          
                <?php
                $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                $meetingStart_Time = $UtilityObj->ChangeTimezone($row['start_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $meetingEnd_Time = $UtilityObj->ChangeTimezone($row['end_time'], $row['slot_timezone'], $MemberTZRow['value']);
                $SlotDate = date('Y-m-d', strtotime($meetingStart_Time));
            ?>
                          <td> <?= $UtilityObj->formatDate($SlotDate) ?>
                          </td>
            
                          <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?> (<?=$MemberTZRow['value']?>)
                          </td>
                          
                          <td>You <?=$host1?> & <a href="/wahclub/<?=$userrow['slug_username']?>" target="_blank"><?=$userrow['firstname'].' '.$userrow['lastname']?> <?=$host2?></a></td>
                          <td>
                            <span class="badge bg-danger" data-bs-toggle="tooltip"><?=$row['status']?></span> 
                    <?php  
                        $cancelledBy = $row['cancelled_by'];
                        $userMatch = ($cancelledBy === 'User' && $row['user_id'] == $Userrow['ClubId']) || 
                                     ($cancelledBy === 'Member' && $row['member_id'] == $Userrow['ClubId']) || 
                                     ($row['status'] == 'Withdrawal' && $row['user_id'] == $Userrow['ClubId']) || 
                                     ($row['status'] == 'Rejected' && $row['member_id'] == $Userrow['ClubId']);
                        
                        if ($userMatch) {
                            echo 'By You';
                        } else {
                            echo 'By <a href="/wahclub/'.$userrow['slug_username'].'" target="_blank">'.$userrow['firstname'].' '.$userrow['lastname'].'</a>';
                        }
                    
                    
                    if($row['cancellation_time'] !== NULL) {
                        echo '<br> <span class="small" title="Cancel Date">on '.$UtilityObj->formatDate($row['cancellation_time']).'</span>';
                    }
                    
                    ?>
                              
                          </td>
                          <td><?=$row['remarks']?></td>
                          
                        </tr>
            <?php       } //End Foreach
                    } else { ?>
            
                        <tr>
                            <td colspan="6">
                                <p class="text-center my-5 text-muted">You don't have any cancelled meeting!</p>
                            </td>
                        </tr>
            <?php } ?>
                    
                      </tbody>
                    </table>
                </div>
                
                
                
                
                
                
                
            
            <!--Cancelled Meetings Ends-->
            
        </div>
         
    </div>
    
    

            <!--Group Meetings ################################-->
            <!--Group Meetings ################################-->
                <nav class="info-card card">
                    
                <?php
                $rows = $UtilityObj->GetUpcomingGroupMeetings_Member($Userrow['ClubId']); 
                
                $rows_past = $UtilityObj->GetPastGroupMeetings_Member($Userrow['ClubId']); 
                
                ?>
                
                <div class="nav nav-tabs" id="nav-tab-group" role="tablist">
                     
                        <button class="nav-link active" id="nav-upcoming-Group-meeting-tab" data-bs-toggle="tab" data-bs-target="#nav-upcoming-Group-meeting" type="button" role="tab" aria-controls="nav-upcoming" aria-selected="true">Upcoming Group Meeting <span class="badge rounded-pill bg-primary ms-1">
                             <?php
                            //  var_dump($rows);
                             echo $rows ? count($rows) : 0; ?>
                            </span></button> 
                        <button class="nav-link" id="nav-past-Group-meeting-tab" data-bs-toggle="tab" data-bs-target="#nav-past-Group-meeting" type="button" role="tab" aria-controls="nav-past" aria-selected="true">Past Group Meeting <span class="badge rounded-pill bg-secondary ms-1">
                             <?php
                             echo $rows_past ? count($rows_past) : 0; ?>
                            </span></button> 
                      </div>
                </nav>
                <div class="tab-content mb-4" id="nav-tab-groupContent">
        
                    <div class="tab-pane fade show active" id="nav-upcoming-Group-meeting" role="tabpanel" aria-labelledby="nav-upcoming-Group-meeting-tab" tabindex="0">
                    
                    <!--Upcoming Meetings Starts-->
                        <div class="table-responsive mb-4">
                            <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                              <thead>
                                <tr> 
                                  <th>Meeting Id</th>
                                  <th>Meeting Host</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Status</th> 
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody> 
                              
                    <?php
                    
                    
                    if($rows !== NULL) {
                        $i = 1;
                        foreach ($rows as $row) {
                            
                $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                $meetingStart_Time = $UtilityObj->ChangeTimezone($row['start_time'], $row['member_timezone'], $MemberTZRow['value']);
                $meetingEnd_Time = $UtilityObj->ChangeTimezone($row['end_time'], $row['member_timezone'], $MemberTZRow['value']);
                $MeetingDate = date('Y-m-d', strtotime($meetingStart_Time));
                        
                    // var_dump($row);
                    ?>
                                <tr class="text-nowrap">
                                    
                                  <td>#WCGMT000<?=$row['id']?></td> 
                    
                    <?php
                    $Memberrow = $UtilityObj->GetWAHClubUserById($row['member_id']);;
                    ?>          
                                    
                                  <td>
                                      
                                <?php if($row['role'] == 'participant') {
                                echo '<a href="/wahclub/'.$Memberrow['slug_username'].'" target="_blank">'.$Memberrow['firstname'].' '.$Memberrow['lastname'].'</a>';
                                ?>
                                
                                <?php }else { echo "You";}?>
                                  </td>
                                  
                                  <td> <?= $UtilityObj->formatDate($MeetingDate) ?>
                                  </td>
                                  
                    
                                  <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?>
                                  <?php echo "(GMT".$MemberTZRow['value'].")";?>
                                  </td>
                                  
                                    <td>
                                        <span class="badge bg-success" data-bs-toggle="tooltip">Confirmed</span>    
                                    </td>
                                  
                                   <td>
                                    <div class="btn-group">
                                        <a href="<?=$row['google_meet_link']?>" class="btn btn-sm btn-outline-primary-botstrap" data-bs-toggle="tooltip" data-bs-title="Join meeting!" target="_blank">
                                            <i class="fas fa-video me-1"></i>Join
                                        </a>
                                <?php if($row['role'] == 'host') { ?>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-id="<?=$row['id']?>">
                                            <i class="fas fa-times me-1"></i>
                                        </button>
                                <?php } ?>
                                    </div>
                                  </td>
                                   
                                </tr>
                    <?php       } //End Foreach
                            } else { ?>
                    
                                <tr>
                                    <td colspan="6">
                                        <p class="text-center my-5 text-muted">You don't have any upcoming Group meeting!</p>
                                    </td>
                                </tr>
                    <?php } ?>
                              
                                
                              </tbody>
                            </table>
                        </div>
                    
                    <!--Upcoming Meetings Ends-->
                    
                    </div>
        
        
                    <div class="tab-pane fade" id="nav-past-Group-meeting" role="tabpanel" aria-labelledby="nav-past-Group-meeting-tab" tabindex="0">
                    
                    <!--Upcoming Meetings Starts-->
                        <div class="table-responsive mb-4">
                            <table class="table table-centered table-nowrap nowrap table-dark table-hover mb-0">
                              <thead>
                                <tr> 
                                  <th>Meeting Id</th>
                                  <th>Meeting Host</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Status</th>  
                                </tr>
                              </thead>
                              <tbody> 
                              
                    <?php
                    
                    
                    if($rows !== NULL) {
                        $i = 1;
                        foreach ($rows_past as $row_past) {
                            
                $MemberTZRow = $UtilityObj->getusertimezonebyclubuserid($Userrow['ClubId']);
                $meetingStart_Time = $UtilityObj->ChangeTimezone($row_past['start_time'], $row_past['member_timezone'], $MemberTZRow['value']);
                $meetingEnd_Time = $UtilityObj->ChangeTimezone($row_past['end_time'], $row_past['member_timezone'], $MemberTZRow['value']);
                $MeetingDate = date('Y-m-d', strtotime($meetingStart_Time));
                         
                    ?>
                                <tr class="text-nowrap">
                                    
                                  <td>#WCGMT000<?=$row_past['id']?></td> 
                    
                    <?php
                    $Memberrow = $UtilityObj->GetWAHClubUserById($row_past['member_id']);;
                    ?>          
                                    
                                  <td>
                                      
                                <?php if($row_past['role'] == 'participant') {
                                echo '<a href="/wahclub/'.$Memberrow['slug_username'].'" target="_blank">'.$Memberrow['firstname'].' '.$Memberrow['lastname'].'</a>';
                                ?>
                                
                                <?php }else { echo "You";}?>
                                  </td>
                                  
                                  <td> <?= $UtilityObj->formatDate($MeetingDate) ?>
                                  </td>
                                  
                    
                                  <td><?=$UtilityObj->formatTime($meetingStart_Time)?> - <?=$UtilityObj->formatTime($meetingEnd_Time)?>
                                  <?php echo "(GMT".$MemberTZRow['value'].")";?>
                                  </td>
                                  
                                    <td>
                                        <span class="badge bg-danger" data-bs-toggle="tooltip">Past</span>    
                                    </td>
                                  
                                   
                                   
                                </tr>
                    <?php       } //End Foreach
                            } else { ?>
                    
                                <tr>
                                    <td colspan="6">
                                        <p class="text-center my-5 text-muted">You don't have any past Group meeting!</p>
                                    </td>
                                </tr>
                    <?php } ?>
                              
                                
                              </tbody>
                            </table>
                        </div>
                    
                    <!--Upcoming Meetings Ends-->
                    
                    </div>
        
                </div>
            
            <!--Group Meetings ################################-->
    
    
    
            </div> 
            <!--Card Cover Ends-->
            
                </div>
                
                
                
               
                
            </div>
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
</div>
  
   <!-- Modal for Confirming -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
            <form method="post" action="">
                
                <input type="hidden" id="conf_requestid" name="conf_requestid" value="">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to confirm this meeting?</p>
                    <div class="mb-3">
                        <label for="confirmRemark" class="form-label small mb-1">Remark (Optional)</label>
                        <textarea class="form-control" id="confirmRemark" name="confirmRemark" rows="3" placeholder="Enter meeting points here!"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" id="confirmMeeting" name="confirmMeeting">Yes, Confirm</button>
                </div>
                
            </form>
            
            </div>
        </div>
    </div>
        
    <!-- Modal for Cancelling -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" id="can_requestid" name="can_requestid" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure you want to cancel this meeting?</p>
                
                    <div class="mb-3">
                        <label for="cancelRemark" class="form-label small">Remark (Optional)</label>
                        <textarea class="form-control" id="cancelRemark" name="cancelRemark" rows="3" placeholder="Enter reason, why you are cancelling this meeting!" required></textarea>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" id="cancelMeeting" name="cancelMeeting">Yes, Cancel</button>
                </div>
            
            </form>
            
            </div>
            
            
        </div>
    </div>
    
    
    <!-- Modal for Reject -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" id="rej_requestid" name="rej_requestid" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Meeting Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure you want to reject this request?</p>
                
                    <div class="mb-3">
                        <label for="rejectRemark" class="form-label small">Remark <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejectRemark" name="rej_remark" rows="3" placeholder="Enter reason, why you are rejecting this request!" required></textarea>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" id="rejectRequest" name="rejectRequest">Yes, Reject</button>
                </div>
            
            </form>
            
            </div>
            
        </div>
    </div>
    
    <!-- Modal for Withdraw -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" id="with_requestid" name="rej_requestid" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Withdraw Booking Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure you want to withdraw this request?</p>
                
                    <div class="mb-3">
                        <label for="rejectRemark" class="form-label small">Remark <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="rej_remark" rows="3" placeholder="Enter reason, why you are withdrawing this request!" required></textarea>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" name="withdrawRequest">Yes, Reject</button>
                </div>
            
            </form>
            
            </div>
            
        </div>
    </div>
    
    
    
    <!-- Modal for Rescheduling -->
    <div class="modal fade" id="rescheduleModalUpdate" tabindex="-1" aria-labelledby="rescheduleModalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
            <form method="post" action="">
                <input type="hidden" id="res_up_requestid" name="res_up_requestid" value="">
                <input type="hidden" id="SelectedDateTimeInput" name="SelectedDateTimeInput" value="" stype="opacity: 0">
                
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="rescheduleModalUpdateLabel">Reschedule Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    
                    <p class="mb-0">Select new date - time to reschedule your meeting </p>
                    
                    <div class="timeslot-container">
                        <div class="dateslots" id="dateslots">
            
                    <select id="rescheduledate" name="rescheduledate" class="my-1 normal cs-form_field py-1" required>
                            <option>Select Date</option> 
                    </select>
                            
                        </div>
                        <div class="d-flex flex-wrap" id="timesloats">
                            <p>Please select a date first.</p> 
                        </div>
                        
                        
                        <div id="selectedTimeslots" class="card previous-meeting mt-4 " style="display: none">
                            
                            <h5 class="mb-0"> Selected Time</h5>
                            <hr>
                            <div class="detail-card py-2">
                                <p class=" mb-0"><strong><i class="far fa-clock"></i></strong> 30 Minutes</p>
                                 
                            </div>
                            <div class="detail-card py-2">
                                 
                                <p class=" mb-0"> 
                                <strong><i class="far fa-calendar"></i></strong>
                                
                                    <span id="SelectedStartTime"></span>
                                    - 
                                    <span id="SelectedEndTime"></span>
                                    
                                    (<span class=" mb-0" id="SelectedDate" data-date=""></span>)
                                </p>
                                
                            </div>
                            <div class="detail-card py-2">
                                <p class=" mb-0">
                                    <strong><i class="fa-solid fa-earth-americas"></i></strong> <span class="mb-0" id="location-selectedtimezone"> (GMT +5:30) Bombay, Calcutta, Madras, New Delhi</span> </p>
                                 
                            </div>
                            
                    <div class="d-flex align-items-center mt-2">
                        <img class="w-6 h-6" src="https://pro-schedule.w3bd.com/images/svg/event-locations/google-meet.svg" width="40px"> &nbsp; &nbsp;  <h5 class="mb-0" style=" line-height: inherit; ">Google Meet</h5>
                    </div>
                    
                            
                        </div>
                        
                    </div>
                    
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" id="rescheduleMeetingUpdate" name="rescheduleMeetingUpdate">Reschedule Now </button>
                </div>
            </form>
            
            </div>
        </div>
    </div>
    
    <!-- Modal for Rescheduling -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
            <form method="post" action="">
                <input type="hidden" id="res_requestid" name="res_requestid" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="rescheduleModalLabel">Reschedule Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You can send the request for rescheduling the meeting to the participant.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" id="rescheduleMeeting" name="rescheduleMeeting">Request Reschedule</button>
                </div>
            </form>
            
            </div>
        </div>
    </div>
    
    
    <!-- Modal for Create A New Modal -->
    <div class="modal fade" id="createMeetingModal" tabindex="-1" aria-labelledby="createMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMeetingModalLabel">Create a New Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body"> 
                
                    <div class="row">
                        <div class="col-md-12">
                            <p>Select date and time to create a new meeting.</p>
                            <div class="mb-3">
                                <label for="newDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="newDate" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="newTime" class="form-label">From</label>
                                <select id="from-time" name="from-time" class="form-control" required>
                                    <!-- Options for 24 hours with 30-minute intervals -->
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
                                <input type="time" class="form-control" id="createmeetingtotime" required readonly>
                            </div>
                        </div> 
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="createmeetingparticipants" class="form-label">Guests
                                </label>
                                <input type="text" class="form-control" id="createmeetingparticipants" name="participants[]" placeholder="Add Guest's mail separated by comma" required>
                            </div>
                        </div> 
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success">Create Meeting</button>
                </div>
            
            </form>
            
            </div>
            
            
        </div>
    </div>
    
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   <script> 
   $(document).ready(function(){
       
    //   createmeetingtotime
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
       
        
        $('.confirmmeeting').click(function(){
          swal({
            title: "Are you sure you want to confirm the meeting?", 
            icon: "info", 
            dangerMode: false,
            buttons: {
              confirm: "Confirm Meeting",
              close: {
                text: "Close Popup",
                value: "close",
                visible: true,
                closeModal: true // This makes the popup close when "Close" is clicked
              }
            },
            
            closeOnClickOutside: false,
            closeOnEsc: false
            
          }).then((value) => {
            if (value === true) {
              swal("Meeting Confirmed!", "The meeting has been successfully confirmed!", "success");
            }
          });
        }); //Confirmation Ends
        
        //Cancel Meeting Starts ##################################
        $('.cancelmeeting').click(function(){
          swal({
            title: "Are you sure you want to cancel the meeting?", 
            text: "Once the meeting is cancelled, It can't be recover and reschedule!",
            icon: "warning", 
            dangerMode: true,
            buttons: {
              cancel: {
                    text: "Cancel Meeting",
                    value: "cancel",
                    visible: true
                  },
              close: {
                text: "Close Popup",
                value: "close",
                visible: true,
                closeModal: true // This makes the popup close when "Close" is clicked
              }
            },
            
            closeOnClickOutside: false,
            closeOnEsc: false
            
          }).then((value) => {
            if (value === "cancel") {
              swal("Meeting Cancelled!", "The meeting has been successfully cancelled!", "success");
            }
          });
        }); //Cancel Meeting Ends ################################


       
   });
    
  </script> 
   
  
    <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
    
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
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
            
        
            
            $('.rejectBTN').click(function(){
               let dataid = $(this).attr("data-id");
               $("#rej_requestid").val(dataid);
            });
            
            $('.withdrawBTN').click(function(){
               let dataid = $(this).attr("data-id");
               $("#with_requestid").val(dataid);
            });
            
            $('.rescheduleBTN').click(function(){
               let dataid = $(this).attr("data-id");
               $("#res_requestid").val(dataid);
            });
            
            $('.rescheduleBTNUP').click(function(){
               let dataid = $(this).attr("data-id");
               $("#res_up_requestid").val(dataid);
            });
            
            $('.confirmBTN').click(function(){
               let dataid = $(this).attr("data-id");
               $("#conf_requestid").val(dataid);
            });
            
            $('.cancelBTN').click(function(){
               let dataid = $(this).attr("data-id");
               $("#can_requestid").val(dataid);
            });
            
            
            
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        <?php if(isset($response) && $response['status'] == 'success'){ ?>
            function showSuccessAlert() {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '<?=$response['message']?>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                      popup: 'swal-success-alert'
                      
                    }
                  });
                }
            window.onload = showSuccessAlert();
        <?php } ?>
            
        <?php if(isset($response) && $response['status'] == 'error'){ ?>
            function showErrorAlert() {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '<?=$response['message']?>',
                    showConfirmButton: false,
                    timer: 3000,
                    color: "#716add",
                    timerProgressBar: true,
                    customClass: {
                      popup: 'swal-danger-alert'
                      
                    }
                  });
                }
            window.onload = showErrorAlert();
        <?php } ?>
        
    </script>
    
    
    <script>
        function getAvailableDates(memberId) {
            $.ajax({
                url: 'getmemberslots.php', 
                type: 'POST',
                data: { member_id: memberId, GETAVAILABLEDATES:true }, 
                success: function(response) {
                     if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response); 
                        } catch (e) {
                            console.error('Invalid JSON response:', e);
                            return;
                        }
                    }
                    
                    if (Array.isArray(response)) {
                        // Clear the current options
                        $('#rescheduledate').empty();
                        $('#rescheduledate').append('<option>Select Date</option>');
    
                        // Populate the dates dynamically
                        response.forEach(function(dateOption) {
                            $('#rescheduledate').append('<option value="'+dateOption.value+'">'+dateOption.label+'</option>');
                        });
                    } else {
                        console.error("Unexpected response format", response);
                    }
                    
                },
                error: function() {
                    alert('Error retrieving data');
                }
            });
        }
    
        
        
        function getMemberAvailableSlotsByDay(reqid, DayName) {
            $.ajax({
                url: 'getmemberslots.php', 
                type: 'POST',
                data: { reqid: reqid, dayname: DayName, GETAVAILABLESLOTS:true }, 
                success: function(response) {
                    if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response); 
                        } catch (e) {
                            console.error('Invalid JSON response:', e);
                            return;
                        }
                    }
                    
                  if (response && response.available && response.busy) {
                
                    const availableSlots = response.available; // Array of available slots
                    const busySlots = response.busy; // Array of busy slots
                    const busySlotTimes = busySlots.map(slot => slot.start_time);
                
                    var currentDate = new Date();
                    const formattedCurrentDate = new Intl.DateTimeFormat('en-CA').format(currentDate); 
                    
                    let slotbox = document.getElementById("timesloats");
                        slotbox.innerHTML = '';
                        
                    if(formattedCurrentDate != DayName ) {
                         
                        var timeSlots = generateTimeSlots(DayName, availableSlots.start_time, availableSlots.end_time)
                       
                        var TimeOptions = { hour: '2-digit', minute: '2-digit', hour12: true };    
                       
                        timeSlots.forEach(function(starttimes) {
                        
                            var starttimewithdate = DayName + ' ' + starttimes;
                            
                            var fullDateTimeString1 = DayName + 'T' + starttimes;
                            var timeslottext = new Date(fullDateTimeString1);
                            timeslottext = timeslottext.toLocaleTimeString('en-US', TimeOptions);
                            
                            if(busySlotTimes.includes(starttimewithdate)) {
                                
                                let Bookedslot = document.createElement("button");
                                Bookedslot.classList.add("Bookedtime-slot");
                                Bookedslot.setAttribute("type", "button");
                                Bookedslot.textContent = timeslottext;
                            
                                slotbox.appendChild(Bookedslot);
                                
                                //Bokked SLot
                            } else { 
                                
                                let slot = document.createElement("button");
                                    slot.classList.add("time-slot");
                                    slot.setAttribute("type", "button");
                                    slot.setAttribute("data-date", DayName);
                                    slot.setAttribute("data-time", starttimes);
                                    slot.textContent = timeslottext;
                                    slotbox.appendChild(slot);
                            }
                        });
                       
                    } else {
                        slotbox.innerHTML = 'No Slot Available, select a different date.';
                    }
                
                  } else {
                    console.error('Invalid response structure:', response);
                 }
                
                },
                error: function() {
                    alert('Error retrieving data');
                }
            });
        }
        
        
        
        function generateTimeSlots(slotDate, startTime, endTime) {
            const slots = [];
            let currentTime = new Date(`${slotDate}T${startTime}`); 
            const endTimeDate = new Date(`${slotDate}T${endTime}`);
        
            while (currentTime < endTimeDate) {
                // Format the current time to 'HH:MM:SS'
                const timeSlot = currentTime.toTimeString().split(' ')[0];
                slots.push(timeSlot);
        
                currentTime.setMinutes(currentTime.getMinutes() + 30);
            }
        
            return slots;
        }
        
        function handleSlotClick(slot, Timeoptions, dateoptions) {
            // Remove active class from all slots
            $('.time-slot').removeClass('active');
            // Add active class to clicked slot
            $(slot).addClass('active');
            $('#selectedTimeslots').css('display', 'block');
        
            let datadate = $(slot).attr('data-date'); // Expected format: YYYY-MM-DD
            let datatime = $(slot).attr('data-time'); // Expected format: HH:MM (24-hour or 12-hour)
            
            $('#SelectedDateTimeInput').val(datadate + ' ' + datatime);
        
            // Construct the full date-time string
            let fullDateTimeString = datadate + 'T' + datatime;
            var SelectedDate = new Date(fullDateTimeString);
        
            // Format the date and time
            $('#SelectedDate').html(SelectedDate.toLocaleDateString('en-US', dateoptions));
            $('#SelectedStartTime').html(SelectedDate.toLocaleTimeString('en-US', Timeoptions));
        
            // Calculate the end time (assuming 30 minutes for this example)
            var endtime = new Date(SelectedDate);
            endtime.setMinutes(SelectedDate.getMinutes() + 30); // Add 30 minutes
        
            $('#SelectedEndTime').html(endtime.toLocaleTimeString('en-US', Timeoptions));
        }
        
    </script>
    
    
    
    <script>
    $(document).ready(function() {
        
        const Timeoptions = { hour: '2-digit', minute: '2-digit', hour12: true };
        const dateoptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

        // Button click event
        $('.rescheduleBTNUP').click(function(){
            var Member_id = $(this).attr('data-memberid');
            getAvailableDates(Member_id);
        });

        // Date change event
        $('#rescheduledate').change(function(){
            var selectedOption = $(this).val();
            var reqID = $('#res_up_requestid').val();
            getMemberAvailableSlotsByDay(reqID, selectedOption);
            
            $('#timesloats').off('click', '.time-slot');
              // Delegate click events for time slots under #timesloats
            $('#timesloats').on('click', '.time-slot', function() {
                 handleSlotClick(this, Timeoptions, dateoptions);
            });
             
        });
        
        
        $('#timesloats .time-slot').on('click', function() {
            handleSlotClick(this, Timeoptions, dateoptions);
        });
        
    });
</script>

        
        
        
        
        
        
        </body>
    </html>