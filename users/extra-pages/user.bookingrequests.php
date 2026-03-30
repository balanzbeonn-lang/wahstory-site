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
    
  <title>User Meetings | <?=$Userrow['name']?></title> 
  
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
                <?php $Dmenu = 7;?>
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
                <h4 class="mb-2">Meetings</h4>
            </div>
            <!--<div class="col-sm-4 text-end"> 
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMeetingModal">
                    <i class="fas fa-plus me-2"></i>Schedule New Meeting
                </button>
            </div>-->
             
            
            <div class="col-sm-12 col-lg-12">
                <hr>
                
                <div class="row">
            
            <div class="col-sm-12 col-lg-12 mt-4 card-cover" style="min-height: 500px;">
                
                <nav class="info-card card">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        
                        <button class="nav-link active" id="nav-upcoming-tab" data-bs-toggle="tab" data-bs-target="#nav-upcoming" type="button" role="tab" aria-controls="nav-upcoming" aria-selected="true">Upcoming <span class="badge rounded-pill bg-primary ms-1">1</span></button>
                        
                        <button class="nav-link" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false">Pending <span class="badge rounded-pill bg-warning ms-1">1</span></button>
                        
                        <button class="nav-link" id="nav-past-tab" data-bs-toggle="tab" data-bs-target="#nav-past" type="button" role="tab" aria-controls="nav-past" aria-selected="false">Past <span class="badge rounded-pill bg-secondary ms-1">0</span></button>
                        
                        <button class="nav-link" id="nav-cancelled-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelled" type="button" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled <span class="badge rounded-pill bg-danger ms-1">0</span></button>
                        
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
                        <tr class="text-nowrap">
                            
                          <td>#WCBK0001</td> 
                          <td>7 Mar, 2025</td> 
                          <td>10:00 PM - 10:30 PM</td> 
                          <td>You & <a href="javascript:void(0);">Pratham Kakkar</a></td>
                          <td>
                            <span class="badge bg-success text-light">Confirmed</span>    
                          </td>
                          <td>
                            <div class="btn-group">
                                <a href="https://meet.google.com/wod-qcyy-dnd" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="Join meeting!" target="_blank"><i class="fas fa-video me-1"></i>Join</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#rescheduleModal"><i class="fas fa-edit me-1"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="fas fa-times me-1"></i></button>
                            </div>
                          </td>
                        </tr>
                    
                         
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
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <tr class="text-nowrap">
                            
                          <td>#WCBK0002</td> 
                          <td>20 Mar, 2025</td> 
                          <td>10:00 PM - 10:30 PM</td> 
                          <td>You & <a href="javascript:void(0);">Pratham Kakkar</a></td>
                          <td>
                            <span class="badge bg-warning text-dark">Pending</span>    
                          </td>
                          <td>
                            <div class="btn-group"> 
                                
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#rescheduleModal"><i class="fas fa-edit me-1"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="fas fa-times me-1"></i></button>
                            </div>
                          </td>
                        </tr>
                    
                         
                      </tbody>
                    </table>
                </div>
            
            <!--pending Request Meetings Ends--> 
        </div>
        
        <div class="tab-pane fade" id="nav-past" role="tabpanel" aria-labelledby="nav-past-tab" tabindex="0">
        
            <!--Past Meetings Starts-->
            
                <p class="text-center my-5 text-muted">You don't have any past meeting!</p>
            
            <!--Past Meetings Ends-->
            
            
        </div>
         
        <div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
            <!--Cancelled Meetings Starts-->
            
                <p class="text-center my-5 text-muted">You don't have any cancelled meeting!</p>
            
            <!--Cancelled Meetings Ends-->
            
        </div>
         
    </div>
                
      
                    
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
                
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to confirm this meeting?</p>
                    <div class="mb-3">
                        <label for="confirmRemark" class="form-label small mb-1">Remark (Optional)</label>
                        <textarea class="form-control" id="confirmRemark" rows="3" placeholder="Enter meeting points here!" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" id="confirmMeeting">Yes, Confirm</button>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure you want to cancel this meeting?</p>
                
                    <div class="mb-3">
                        <label for="cancelRemark" class="form-label small">Remark (Optional)</label>
                        <textarea class="form-control" id="cancelRemark" rows="3" placeholder="Enter reason, why you are cancelling this meeting!" required></textarea>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" id="cancelMeeting">Yes, Cancel</button>
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
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="rescheduleModalLabel">Reschedule Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="previous-meeting mb-4">
                        <p class="mb-0">Current Meeting Time</p>
                        <div class="small">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>Mar 07, 2025</span>
                            <i class="far fa-clock ms-3 me-2"></i>
                            <span>10:00 PM - 10:30 PM</span>
                        </div>
                    </div>
                    
                    <p class="mb-0">Select new date - time to reschedule your meeting </p>
                    
                    <div class="timeslot-container">
                        <div class="dateslots" id="dateslots">
                            
                    <select id="rescheduledate" name="rescheduledate" class="my-1 normal cs-form_field py-1" required>
                            <option>Select Date</option> 
                            <option value="2025-03-08" selected>Mar 08, 2025</option>
                            <option value="2025-03-09">Mar 09, 2025</option>
                            <option value="2025-03-10">Mar 10, 2025</option>
                            <option value="2025-03-11">Mar 11, 2025</option> 
                            <option value="2025-03-12">Mar 12, 2025</option> 
                            <option value="2025-03-13">Mar 13, 2025</option> 
                            <option value="2025-03-14">Mar 14, 2025</option> 
                            <option value="2025-03-15">Mar 15, 2025</option> 
                            <option value="2025-03-16">Mar 16, 2025</option> 
                            <option value="2025-03-17">Mar 17, 2025</option> 
                    </select>
                            
                        </div>
                        <div class="d-flex flex-wrap justify-content-center00" id="timesloats">
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="10:00:00">10:00 AM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="10:30:00">10:30 AM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="11:00:00">11:00 AM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="11:30:00">11:30 AM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="12:00:00">12:00 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="12:30:00">12:30 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="13:00:00">01:00 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="13:30:00">01:30 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="14:00:00">02:00 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="14:30:00">02:30 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="15:00:00">03:00 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="15:30:00">03:30 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="16:00:00">04:00 PM</button>
                            <button class="time-slot" type="button" data-date="2025-03-07" data-time="16:30:00">04:30 PM</button>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" id="rescheduleMeeting">Reschedule Now </button>
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
          console.log(fromtimes);
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


    //Select Time Slot
    
        var timeSlots = document.querySelectorAll('.time-slot');
	    
	    $(timeSlots).click(function(){
	        
	        $(timeSlots).removeClass('active');
	        $(this).addClass('active');
	    });

       
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
        });
    </script>
        
        </body>
    </html>
    