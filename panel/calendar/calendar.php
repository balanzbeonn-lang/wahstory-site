<?php 
require_once("../../db/postClass.php");
$postObj = new Post();
$rows = $postObj->getContentSuggestion();
?>
<!doctype html>
<html lang="en">
<!--getContentSuggestion-->
<head>

    <meta charset="utf-8" />
    <title>Calendar </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Calendar</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row mb-4">
                    <div class="col-xl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <button type="button" class="btn font-16 btn-primary waves-effect waves-light w-100"
                                    id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal">
                                    Create New Event
                                </button>

                                <div id="external-events">
                                    <br>
                                    <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                    <div class="external-event fc-event bg-success" data-class="bg-success">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event
                                        Planning
                                    </div>
                                    <div class="external-event fc-event bg-info" data-class="bg-info">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                                    </div>
                                    <div class="external-event fc-event bg-warning" data-class="bg-warning">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating
                                        Reports
                                    </div>
                                    <div class="external-event fc-event bg-danger" data-class="bg-danger">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create
                                        New theme
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col-->
                    <div class="col-xl-9">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
                <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                <div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header py-3 px-4">
                                <h5 class="modal-title" id="modal-title">Add Suggestion </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                    <div class="row">
                                        
										
										<div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post Time</label>
                                                <p id="post-time"></p>
                                                
                                            </div>
                                        </div> <!-- end col-->
                                        
										<div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Platform Name</label>
                                                <p id="platform-name"></p>
                                                
                                            </div>
                                        </div> <!-- end col-->
										
										<div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post Title</label>
                                                <p id="contenttitle"></p>
                                                
                                            </div>
                                        </div> <!-- end col-->
                                        
										<div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post Content</label>
                                                <p id="suggestedcontent"></p>
                                                
                                            </div>
                                        </div> <!-- end col-->
                                        
										<div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label"> Priority</label>
                                                <p id="priority"></p>
                                                
                                            </div>
                                        </div> <!-- end col-->
										
                                    </div> <!-- end row-->
                                    
                                </form>
                            </div>
                        </div>
                        <!-- end modal-content-->
                    </div>
                    <!-- end modal dialog-->
                </div>
                <!-- end modal-->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by <a
                                href="#" target="_blank">Pavan</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->




<script>

document.addEventListener("DOMContentLoaded", function() {
	// e = Whole Date
	// s = Current Date
	// o = Current Month
	// start: new Date(e, o, s - 4, 16, 20),
	// 					Cr Date - day, hour, minutes
	
    var n = new bootstrap.Modal(document.getElementById("event-modal"), {
            keyboard: !1
        }),
        t = (document.getElementById("event-modal"), document.getElementById("modal-title")),
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
        s = (new FullCalendar.Draggable(document.getElementById("external-events"), {
            itemSelector: ".external-event",
            eventData: function(e) {
                return {
                    title: e.innerText,
                    start: new Date,
                    className: e.getAttribute("data-class")
                }
            }
        }), [<?php foreach($rows as $row){ echo '{';
   
   $Sday = date("d", strtotime($row['scheduletime']));
   $Smonth = date("m", strtotime($row['scheduletime']));
   $Fyear = date("Y", strtotime($row['scheduletime']));
   $Shour = date("H", strtotime($row['scheduletime']));
   $Smin = date("i", strtotime($row['scheduletime']));
   
//   $STIME = date("h:i", strtotime($row['scheduletime']));
   
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
   
   <?php    echo '}, '; }   ?>
   
       
        //     {
        //     title: "Long Event",
        //     start: new Date(e, o, s),
        //     className: "bg-warning"
        // }, {
        //     id: 999,
        //     title: "Repeating Event",
        //     start: new Date(e, o, s - 4, 16, 20),
        //     allDay: !1,
        //     className: "bg-info"
        // }, {
        //     id: 999,
        //     title: "Repeating Event",
        //     start: new Date(e, o, s + 4, 16, 0),
        //     allDay: !1,
        //     className: "bg-primary"
        // }, {
        //     title: "Meeting",
        //     start: new Date(e, o, s, 10, 30),
        //     allDay: !1,
        //     className: "bg-success"
        // }, {
        //     title: "Lunch",
        //     start: new Date(e, o, s, 12, 0),
        //     end: new Date(e, o, s, 14, 0),
        //     allDay: !1,
        //     className: "bg-danger"
        // }, {
        //     title: "Birthday Party",
        //     start: new Date(e, o, s + 1, 19, 0),
        //     end: new Date(e, o, s + 1, 22, 30),
        //     allDay: !1,
        //     className: "bg-success"
        // }, {
        //     title: "Click for Google",
        //     start: new Date(e, o, 28),
        //     end: new Date(e, o, 29),
        //     url: "http://google.com/",
        //     className: "bg-dark"
        // }
        ]),
        e = (document.getElementById("external-events"), document.getElementById("calendar"));

    function r(e) {
        n.show(), a.classList.remove("was-validated"), a.reset(), l = null, t.innerText = "Add Event", d = e
    }

    function c() {
        return 768 <= window.innerWidth && window.innerWidth < 1200 ? "timeGridWeek" : window.innerWidth <= 768 ? "listMonth" : "dayGridMonth"
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
        windowResize: function(e) {
            var t = c();
            m.changeView(t)
        },
        eventDidMount: function(e) {
            "done" === e.event.extendedProps.status && (e.el.style.backgroundColor = "red", e = e.el.getElementsByClassName("fc-event-dot")[0]) && (e.style.backgroundColor = "white")
        },
        eventClick: function(e) { 
            
            var publicId = e.el.fcSeg.eventRange.def.publicId;
            // Now you can use the publicId variable
            // console.log(publicId);
            
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: { publicId: publicId },
            success: function(response) {
                // Handle the response from the server here
            
        document.getElementById("platform-name").innerText = response.platform;
        document.getElementById("post-time").innerText = response.scheduletime; 
        document.getElementById("contenttitle").innerText = response.title; 
        document.getElementById("suggestedcontent").innerText = response.caption;
        
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                // console.error(textStatus, errorThrown);
            }
        });
        
        n.show(), a.reset(), d = null, t.innerText = "Post Suggestion", 
        document.getElementById("priority").innerText = "High", d = null
        },
        events: s
    });
    m.render() 
    
});

</script>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- plugin js -->
<script src="assets/libs/fullcalendar/index.global.min.js"></script>
<!-- Calendar init -->

<script src="assets/js/app.js"></script>

</body>
</html>