<?php 
session_start();
require_once("../inc/functions.php");
$postObj = new Story();

    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
    }else{ 
        header('location: ../login.php');
    }
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']);
    
    $rows = $postObj->getContentSuggestionByUser($_SESSION['userid']);
?>
<!doctype html>
<html lang="en">
<!--getContentSuggestion-->
<!--#e9204f //Primary Pink-->
<!--#941b38 //Secondary Pink-->
<!--#0bb197 //Secondary Green-->
<!--#099680 //Primary Green-->
<head>
    <meta charset="utf-8" />
    <title>WAHStory - Calendar </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="WAHStory" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    <!-- Bootstrap Css -->
    <link href="/users/calendar/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/users/calendar/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/users/calendar/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    
    

<style>
    .modal-header .modal-title{
        color: #343a40;
        font-size: 23px;
        font-weight: 400;
    }
    .modal-header{
       /* background: linear-gradient(45deg, #f54266, #3858f9);
    box-shadow: 5px 7px 26px -5px #502965;
    -webkit-box-shadow: 5px 7px 26px -5px #502965;*/
    
    /*border: none;*/
    
    }
    .suggession-details p{
        font-size: 23px;
        
    }
    .inwrapper{
        width: 100%;
        height: auto;
        background: url('calendar/2.png');
        background-position: top right;
        border-radius: 10px;
    }
    .card.boxes{
        min-height: 235px;
    }
    .bg-primary {
        background: #e9204f !important;
    }
    a{
        color: #e9204f;
    }
    
    
    /*To change the Calendar UI In Black*/
    
    .CalendarUi .card-body {
		background: #000;
		border: none;
		color: #80838b;
	}
	
	.fc .fc-toolbar h2 { 
        color: #ffffffb5;
    }
    .fc .fc-daygrid-day.fc-day-today {
        background-color: rgb(11 177 151 / 26%);
    }
	
    .fc .fc-button-group button {
        background-color: #941b38;
        border-color: #000000;
    }
    
    .fc .fc-button-group button:hover {
        background-color: #e9204f;
        border-color: #000000;
    }
    
    .fc .fc-button-primary {
        color: #c3c3c3;
    }
    
    .fc .fc-button-primary {
        background-color: #4f6f8f;
    }
    
    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #e9204f !important;
        border-color: #2f3032 !important;
    }
    
	.fc .fc-col-header-cell {
        background-color: #121212;
    }
    .fc .fc-scrollgrid {
        border: 1px solid #323334 !important;
    }
	.fc .fc-scrollgrid {
		border: none;
	}
	.fc td, .fc th {
		border: var(--bs-border-width) solid #3a3a3a;
	}
	.fc .fc-day-other .fc-daygrid-day-top {
		opacity: 0.6;
	}
    
    .fc .fc-daygrid-day-number{
        font-size: 14px;
    }
    .fc .fc-button-group > .fc-button, .fc .fc-today-button, .fc .fc-timegrid-axis-cushion {
        text-transform: capitalize;
    }
    
    
    #SocialPostContent .modal-header{
	    border-bottom: 1px solid #404042 ;
	}
	#SocialPostContent .socialPost{
	    color:white;
	}
	#SocialPostContent .btn-close{
	    background-color: white;
	    font-size:15px;
	}
	#SocialPostContent .occasion-div{
	    display:flex;
	    align-items:baseline;
	    justify-content:start;
	    margin:0px 0px -10px 0px;
	} 
    #SocialPostContent .calender{
        margin:0px 10px 0px 0px;
        font-size: 25px;
        
    }
    
    #SocialPostContent .card{
        display:flex;
        align-items:center;
        justify-content:center;
        /*width: 40%;*/
        padding: 5px;
        background: #2f2f2f;
        border: 2px solid gray;
        border-radius: 15px;
        margin: 30px 0 0 0;
        min-height: 180px;
       }
        #SocialPostContent .deadline-div{
          display:flex;
          justify-content:center;
          /*width:150px;*/
          padding-bottom:5px;
          /*border-bottom:1px solid rgba(242, 241, 255, 0.5);*/
          margin-bottom:10px;
      }
     #SocialPostContent .deadline-icon{
         font-size: 40px;
         color: white;
         
         margin-bottom:5px;
         
         
     }
     #SocialPostContent .time-span{
            margin-bottom: 2px;
            font-size: 17px;
            line-height: 23px;
            letter-spacing: 1px;
            color: cyan;
       }
     #SocialPostContent .content-span{
            margin-bottom: 2px;
            font-size: 14px;
            line-height: 23px;
            letter-spacing: 1px;
            color: cyan;
       }
       
     #SocialPostContent .top-heading{
        margin-bottom: 2px;
        font-size: 20px;
        letter-spacing: 1px;
          color: #f1fefe;
     }
     .postcontent{
        font-size: 18px;
        line-height: 28px;
        color: #c0c0c0;
     }
    
    .dash-item-box-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .dash-item-box-inner .icon-cover {
        padding: 10px;
        font-size: 20px;
        margin-left: auto;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        opacity: 1;
        background: #0075ff;
        color: #fff;
        border-radius: .7rem;
        box-shadow: rgba(20,20,20,.12) 0rem 0.25rem 0.375rem -0.0625rem, rgba(20,20,20,.07) 0rem 0.125rem 0.25rem -0.0625rem;
        transition: all .2s ease-in;
    } 
    
</style>

</head>

<body data-sidebar="dark" style="background: #181818;">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <!--<div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Calendar</h4>

                        </div>
                    </div>
                </div>-->
                <!-- end page title -->

                <div class="row mb-4">
                    <div class="col-xl-2">
                        
                    </div> <!-- end col-->
                    <div class="col-xl-8 CalendarUi">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                    <div class="col-xl-2">
                        
                    </div> <!-- end col-->
                </div> <!-- end row-->
                <div style='clear:both'></div>
 
                
                
    
    
  <!-- Modal -->
<div class="modal fade" id="SocialPostContent" tabindex="-1" aria-labelledby="SocialPostContentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background:#2f2f2f;">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="SocialPostContentLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-share"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px; color: #fff;">Social Post Content</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           
           <div class="row">
               
                <div class="col-lg-12">
                    <!--<i class="calender fa fa-calendar-o"></i>-->
                      <p class="postcontent">
                        Hi there, <br>
                        you have a social post suggestion from WAHStory to post on <strong id="platform-name"></strong>, kindly post this <strong id="ContentType"></strong> at the scheduled time.
                      </p>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-1">
                        <div class="deadline-div">
                            <i class="deadline-icon bi bi-patch-exclamation pt-2"></i>
                        </div>
                        <h4 class="top-heading">Deadline</h4> 
                        <span class="time-span date" id="post-time"></span>
                        <span class="time-span time">at <span id="postHour"></span></span>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-1">
                        <div class="deadline-div">
                            <i class="deadline-icon bi bi-cloud-download pt-2"></i>
                        </div>
                        <h4 class="top-heading">Content</h4> 
                        <a href="javascript:void(0);" class="content-span" target="_blank" id="imageattachment">Download Image <i class="bi bi-image"></i></a>
                        <a href="javascript:void(0);" class="content-span" target="_blank" id="contentattachment">Download Content <i class="bi bi-file-earmark-image"></i></a> 
                    </div>
                    
                </div>
              
              </div>
                
        </div>
           
            
      </div>
      
    </div>
  </div>
                
                

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
 
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->




<script>
document.addEventListener("DOMContentLoaded", function () {
    var n = new bootstrap.Modal(document.getElementById("SocialPostContent"), {
            keyboard: !1
        }),
        t = (document.getElementById("SocialPostContent"), document.getElementById("modal-title")),
        a = document.getElementById("form-event"),
        l = null,
        d = null,
        i = document.getElementsByClassName("needs-validation"),
        l = null,
        d = null,
        e = new Date,
        s = e.getDate(),
        o = e.getMonth(),
        e = e.getFullYear(),
        s = [
            <?php foreach($rows as $row){ echo '{';
   
               $Sday = date("d", strtotime($row['scheduletime']));
               $Smonth = date("m", strtotime($row['scheduletime']));
               $Fyear = date("Y", strtotime($row['scheduletime']));
               $Shour = date("H", strtotime($row['scheduletime']));
               $Smin = date("i", strtotime($row['scheduletime']));

               $CurrentDay = date("d");
               $CurrentMonth = date("m");
               $CurrentYear = date("Y");

               if($Sday > $CurrentDay){
                   $EventDayValue = ($Sday - $CurrentDay) + $CurrentDay;
               }elseif($Sday < $CurrentDay){
                   $EventDayValue = $CurrentDay - ($CurrentDay - $Sday);
               }elseif($Sday == $CurrentDay){
                   $EventDayValue = $Sday;
               }else{
                   $EventDayValue = $Sday;
               } 
           ?>
            title: "<?=$row['title']?>",
            id: <?=$row['id']?>,
            start: new Date(<?=$Fyear?>, <?=$Smonth?> - 1, <?=$EventDayValue?>, <?=$Shour?>, <?=$Smin?>),
            className: "bg-primary"
            <?php echo '}, '; } ?>
        ],
        e = document.getElementById("calendar");

    function r(e) {
        n.show(), a.classList.remove("was-validated"), a.reset(), l = null, t.innerText = "Add Event", d = e
    }

    function c() {
        return 768 <= window.innerWidth && window.innerWidth < 1200 ? "dayGridMonth" : window.innerWidth <= 768 ? "listMonth" : "dayGridMonth"
    }
    var m = new FullCalendar.Calendar(e, {
        timeZone: "local",
        editable: !0,
        droppable: !0,
        selectable: !0,
        initialView: c(),
        themeSystem: "bootstrap",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        windowResize: function (e) {
            var t = c();
            m.changeView(t)
        },
        eventDidMount: function (e) {
            "done" === e.event.extendedProps.status && (e.el.style.backgroundColor = "red", e = e.el.getElementsByClassName("fc-event-dot")[0]) && (e.style.backgroundColor = "white")
        },
        eventClick: function (e) {

            var publicId = e.el.fcSeg.eventRange.def.publicId;
            // Now you can use the publicId variable
            // console.log(publicId);

            $.ajax({
                type: 'POST',
                url: 'calendarajax.php',
                data: { publicId: publicId },
                success: function (response) {
                    
                // Handle the response from the server here
            document.getElementById("platform-name").innerHTML = response.platform;
        
            var dateString = response.scheduletime.split(' ')[0];
        
        var datePart = new Date(dateString);
        
    // Array of month names    
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
    // Array of weekday names
    var weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    
    // Get the day, month, year components
    var day = datePart.getDate();
    var month = months[datePart.getMonth()];
    var year = datePart.getFullYear();
    // Get the weekday
    var weekday = weekdays[datePart.getDay()];
    // Construct formatted date string
    var formattedDate = weekday + " " + day + " " + month + ", " + year;
             
            document.getElementById("post-time").innerText = formattedDate;
                
                //Extracting Time as AM/PM
            var timePart = response.scheduletime.split(' ')[1];
            var timeComponents = timePart.split(':');
            var hours = parseInt(timeComponents[0], 10);
            var ampm = hours >= 12 ? 'PM' : 'AM';
            
            // Convert hours to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // Handle midnight (0 hours)
            
            var formattedTime = hours + ':' + timeComponents[1] + ' ' + ampm; 

                    
                    document.getElementById("postHour").innerText = formattedTime;
                    
                    document.getElementById("ContentType").innerText = response.contentType;
                    // document.getElementById("contenttitle").innerText = response.title;
                    
                    if (response.caption) {
                        document.getElementById("contentattachment").href = "/images/contentsuggestion/attachments/" + response.caption;
                    } else {
                        document.getElementById("contentattachment").style.display = "none";
                    }
                    
                    if (response.img) {
                    document.getElementById("imageattachment").href = "/images/contentsuggestion/" + response.img;
                    }else{
                        document.getElementById("imageattachment").style.display = "none";
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    // console.error(textStatus, errorThrown);
                }
            });

            n.show(), a.reset(), d = null, t.innerText = "Post Suggestion", d = null
        },
        events: s
    });
    m.render()

});

</script>

<!-- JAVASCRIPT -->
<script src="/users/calendar/assets/libs/jquery/jquery.min.js"></script>
<script src="/users/calendar/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/users/calendar/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/users/calendar/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/users/calendar/assets/libs/node-waves/waves.min.js"></script>

<!-- plugin js -->
<script src="/users/calendar/assets/libs/fullcalendar/index.global.min.js"></script>
<!-- Calendar init -->

<script src="/users/calendar/assets/js/app.js"></script>

</body>
</html>