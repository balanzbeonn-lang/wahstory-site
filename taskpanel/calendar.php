<?php 
session_start();
require_once("../inc/functions.php");
    $postObj = new Story();
    $rows = $postObj->getAllContentSuggestion();
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
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    
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
        background: url('2.png');
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
</style>

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
                            <!--<h4 class="mb-sm-0">Calendar</h4>-->

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row mb-4">
                    <div class="col-xl-2">
                        
                    </div> <!-- end col-->
                    <div class="col-xl-8">
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

                <!-- Add New Event MODAL -->
                <div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header py-3 px-3">
                                <h5 class="modal-title" id="modal-title">Post Suggestion </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-0">
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                    <div class="row suggession-details">
                                        
										
						<div class="col-12 p-4  pb-0">
						    <p style="text-align: justify;">
						        Hi, 
						        <br> 
						        you have a social post suggestion from WAHStory to post on <span id="platform-name"></span>, kindly post this <span id="ContentType"></span> at the given time.
						    </p> 
						    
						    
					    </div>
					
					</div>
					
					
					
					<div class="row">
					    
					    <div class="col-12">
    						 <div class="inwrapper pt-4 pb-0 mb-0">
    						     
    						     <div class="row my-4 pb-0 mb-0">
    						        
    						        <div class="col-md-12 p-4">
    						            <span class="text-white">
    						                Post Title:
    						            </span>
    						            <h3 id="contenttitle" style="color: #fff; font-size: 20px;"></h3>
    						        </div>
    						        <div class="col-md-6 p-4">
    						          
    						          <div class="card mb-0 boxes">
    						          <div class="card-header text-center">
    						              <img src="https://html.hixstudio.net/seomy-prv/seomy/assets/img/services/services-1-icon-2.png" alt="">
    						          </div>
    						          <div class="card-body">
    						              <p>
    						              <i class="fa-regular fa-calendar"></i>
    						              <!--<span>Sun 23 March, 2023</span>-->
    						              <span id="post-time"></span>
    						              </p>
    						              <p class="mb-0">
    						              <i class="fa-regular fa-clock"></i>
    						              <span>8:00 pm</span>
    						              </p>
    						          </div>
    						              
    						          </div>
    						          
    						        </div>
    						        <div class="col-md-6 p-4">
    						          
    						          <div class="card boxes">
    						          <div class="card-header text-center">
    						              <img src="https://html.hixstudio.net/seomy-prv/seomy/assets/img/services/services-1-icon-4.png" alt="">
    						          </div>
    						          <div class="card-body">
    						              <p><a href="" target="_blank" id="contentattachment">
    						              <i class="fa-solid fa-link"></i>
    						              <span>Download Content</span>
    						              </a></p>
    						              <p class="mb-0">
    						              <a href="" target="_blank" id="imageattachment">
    						              <i class="fa-solid fa-link"></i>
    						              <span>Download Image</span>
    						              </a>
    						              </p>
    						          </div>
    						              
    						          </div>
    						          
    						        </div>
    						        
    						     </div>
    						     
    						 </div>
					    </div>	    
						    
					    
					</div>
					
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
                        <script>document.write(new Date().getFullYear())</script> © <a
                                href="https://www.wahstory.com/" target="_blank">www.WAHStory.com</a>
                    </div>
                    <div class="col-sm-6">
                         
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->




<script>
document.addEventListener("DOMContentLoaded", function () {
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
                url: 'ajax.php',
                data: { publicId: publicId },
                success: function (response) {
                    // Handle the response from the server here

                    document.getElementById("platform-name").innerText = response.platform;
                    document.getElementById("post-time").innerText = response.scheduletime;
                    document.getElementById("ContentType").innerText = response.contentType;
                    document.getElementById("contenttitle").innerText = response.title;
                    document.getElementById("contentattachment").href = "/images/contentsuggestion/attachments/" + response.caption;
                    // document.getElementById("postimg").src = "/images/contentsuggestion/" + response.img;
                    document.getElementById("imageattachment").href = "/images/contentsuggestion/" + response.img;

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