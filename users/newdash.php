<?php
    session_start();

    include('../inc/functions.php');
    $postObj = new Story();

    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    }

    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']);
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);

    if(isset($_POST['SendUpgradeRequest'])){
        $UpgResp = $postObj->UpgradeUserAcc($_SESSION['userid'], $Userrow['name']);
    }
    $CheckUpg = $postObj->CheckUpgradeUserAcc($_SESSION['userid']);

    if(isset($_POST['UpdateReminderStatus'])){
        if($_POST['ReminderStatus'] == 1){
            $response = $postObj->UpdateContentSuggestionStatus($_POST['ReminderrowId']);
        }else{
            $response = "ERROR";
        }
    }

    if(isset($response)){
        if($response == "SUCCESS"){
            $SMSG = "Status Updated Successfully!";
        }elseif($response == "ERROR"){
            $EMSG = "Error while updating the status, try again!";
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">

    <title>My Dashboard | <?=$Userrow['name']?></title>

    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />

  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/plugins/animate.css">

  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>

 <style>
    body {
        background-color: #111317; /* Darker body background for contrast with sidebar */
        overflow-x: hidden; /* Prevent horizontal scroll if any */
    }

    .dashboard-layout {
        display: flex;
        min-height: 100vh;
        position: relative; /* Ensure it can contain absolutely positioned elements */
    }

    .dashboard-sidebar {
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        background-color: rgba(28, 30, 34, 0.85); /* Dark, semi-transparent background */
        backdrop-filter: blur(10px) saturate(120%);
        -webkit-backdrop-filter: blur(10px) saturate(120%); /* Safari */
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        padding: 20px 0;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        transition: width 0.3s ease, left 0.3s ease; /* Added left transition */
        box-shadow: 2px 0 10px rgba(0,0,0,0.3); /* Subtle shadow for depth */
    }

    .sidebar-logo {
        padding: 0 25px 20px 25px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar-logo a {
        display: flex;
        align-items: center;
        color: #f0f0f0;
        text-decoration: none;
        font-size: 1.5rem;
        font-weight: 700;
    }
    .sidebar-logo img {
        height: 40px;
        margin-right: 10px;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1; /* Allows menu to take available space */
        overflow-y: auto; /* Scroll for long menus */
    }
    .sidebar-nav li a {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: #a0aec0; /* Tailwind gray-500 equivalent */
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: background-color 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
        border-left: 3px solid transparent;
    }
    .sidebar-nav li a:hover {
        background-color: rgba(255, 255, 255, 0.03);
        color: #e9204f; /* Accent color */
        padding-left: 28px; /* Indent on hover */
    }
    .sidebar-nav li a.active {
        color: #ffffff;
        background-color: rgba(233, 32, 79, 0.1); /* Accent color with transparency */
        border-left-color: #e9204f; /* Accent color */
        font-weight: 600;
    }
    .sidebar-nav li a i {
        width: 20px; /* Fixed width for icons */
        margin-right: 15px;
        font-size: 1rem; /* Icon size */
        text-align: center;
    }

    .sidebar-footer {
        padding: 20px 25px;
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        color: #a0aec0;
        font-size: 0.8rem;
        text-align: center;
        /* Position the footer absolutely within the sidebar to prevent content pushing */
        position: sticky;
        bottom: 0;
        background-color: rgba(28, 30, 34, 0.85); /* Match sidebar background */
        z-index: 1001; /* Ensure it stays above other content if sidebar scrolls */
    }


    .dashboard-main-content-area {
        margin-left: 260px;
        width: calc(100% - 260px);
        padding-top: 0;
        transition: margin-left 0.3s ease, width 0.3s ease;
        padding-bottom: 80px; /* Add padding to prevent content from hiding under footer */
    }

    .sidebar-toggle-btn {
        display: none; /* Hidden by default, shown only on mobile */
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001; /* Above sidebar when closed */
        background-color: rgba(28, 30, 34, 0.85);
        backdrop-filter: blur(5px);
        color: #f0f0f0;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 1.2rem;
    }


    @media (max-width: 992px) {
        .dashboard-sidebar {
            left: -260px; /* Hidden by default */
        }
        .dashboard-sidebar.open {
            left: 0;
        }
        .dashboard-main-content-area {
            margin-left: 0;
            width: 100%;
        }
        .sidebar-toggle-btn {
            display: block; /* Show toggle button on mobile */
        }
    }


     .single-post-content p b{
         color: #d1d1d1;
     }
     .social-recent-posts .cs-post .cs-post_thumb{
        height: 300px;
        width: 350px;
     }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #e9204f;
    }
    .nav-link{
        color: #999696;
        padding: 5px 15px;
    }
    .nav-link:focus, .nav-link:hover{
        color: #e9204f;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    	background: none;
        border-bottom: 2px solid #e9204f;
        border-radius: 0px;
        color: #e9204f;
        font-weight: 700;
	}
	.cs-post.cs-style1 .cs-post_info{
	    padding: 35px 25px 0px 25px;
	}
	.cs-post.cs-style1 .cs-post_info p span{
        font-size: 14px;
        padding-right: 20px;
	}
	.alert .btn-close:hover{
	    cursor: pointer;
	}
	.alert .btn-close{
	    padding: 1rem 1rem;
	}
	.cs-font_11{
        font-size: 11px;
	}
	.postReminder-card{
	    background: #000000;
        border: 2px solid #343434;
        color: #ffffff;
        font-weight: 500;
        font-size: 14px;
        line-height: 22px;
        box-shadow: rgba(0,0,0,.05) 0rem 1.25rem 1.6875rem 0rem;
        transition: box-shadow .3s cubic-bezier(.4,0,.2,1) 0ms;
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
        padding: 5px;
        background: #2f2f2f;
        border: 2px solid gray;
        border-radius: 15px;
        margin: 30px 0 0 0;
        min-height: 160px;
      }
    #SocialPostContent .deadline-div{
          display:flex;
          justify-content:center;
          padding-bottom:5px;
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
    }
    .postcontent{
        font-size: 18px;
        line-height: 28px;
    }

    .connectedsocial:hover .socialcomingsoon{
        display: flex;
        background-color: #181515c9;
    }
    .socialcomingsoon{
        position: absolute;
        top: 0;
        left: 0;
        background: #181515c9;
        height: 100%;
        width: 100%;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 9;
        display: none;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* ===== REFINED STYLES FOR DASHBOARD CARDS ===== */
    .wah-main-content .bg-\[\#1f2937\] {
        background: linear-gradient(145deg, #2a3544, #1f2937); /* Slightly adjusted gradient */
        box-shadow: 0 5px 15px rgba(0,0,0,0.3), /* Stronger shadow */
                    0 10px 25px rgba(0,0,0,0.35), /* Stronger shadow */
                    inset 0 1px 1px rgba(255, 255, 255, 0.06), /* Brighter inner highlight */
                    inset 0 -1px 1px rgba(0,0,0,0.15); /* Stronger inner shadow */
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                    box-shadow 0.3s ease-out,
                    border-color 0.3s ease-out;
        position: relative;
        border: 1px solid transparent;
        overflow: hidden;
        border-radius: 12px; /* Slightly more rounded corners */
    }

    .wah-main-content .bg-\[\#1f2937\]::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, 0.1); /* Brighter border */
        pointer-events: none;
        z-index: 1;
        transition: border-color 0.3s ease-out;
    }

    .wah-main-content .bg-\[\#1f2937\]:hover {
        transform: translateY(-7px) scale(1.01); /* More pronounced lift */
        box-shadow: 0 10px 25px rgba(0,0,0,0.35), /* Stronger hover shadow */
                    0 20px 45px rgba(0,0,0,0.4), /* Stronger hover shadow */
                    inset 0 1px 2px rgba(255, 255, 255, 0.08), /* Brighter inner highlight on hover */
                    inset 0 -1px 2px rgba(0,0,0,0.2); /* Stronger inner shadow on hover */
    }

    .wah-main-content .bg-\[\#1f2937\]:hover::before {
        border-color: rgba(255, 255, 255, 0.25); /* More visible border on hover */
    }

    /* STATS Styling */
    .wah-main-content .statistic-value {
        font-size: 2.8rem; /* Larger font size for stats */
        font-weight: 700; /* Bolder font */
        color: #e0e0e0; /* Lighter, more premium white */
        letter-spacing: -0.05em; /* Tighter letter spacing for a sleek look */
        line-height: 1;
    }

    .wah-main-content .statistic-label {
        font-size: 0.9rem; /* Slightly larger label */
        color: #a0aec0; /* Existing gray, but ensure good contrast */
        text-transform: uppercase; /* Uppercase for labels */
        letter-spacing: 0.05em; /* Spaced out labels */
        font-weight: 500;
    }

    /* Profile Card specific */
    .profile-card-header {
        color: #f9fafb; /* Lighter white for titles */
        font-weight: 600;
        font-size: 1.25rem; /* Larger profile name */
    }

    /* Buttons */
    .wah-main-content a.bg-\[\#2563eb\] {
        background-color: #2563eb;
        background-image: linear-gradient(45deg, #2563eb, #3b82f6); /* Gradient for buttons */
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    }
    .wah-main-content a.bg-\[\#2563eb\]:hover {
        background-color: #3b82f6;
        background-image: linear-gradient(45deg, #3b82f6, #2563eb);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
        transform: translateY(-2px);
    }
    .wah-main-content a.border-\[\#2563eb\] {
        border-color: #2563eb;
        color: #2563eb;
        transition: all 0.3s ease;
    }
    .wah-main-content a.border-\[\#2563eb\]:hover {
        background-color: rgba(37, 99, 235, 0.1);
        color: #3b82f6;
    }

    /* Checkbox styling */
    input[type="checkbox"].accent-\[\#2563eb\] {
        /* This is a common way to style checkboxes to match a color */
        accent-color: #2563eb;
        width: 1.2em; /* Make checkbox slightly larger */
        height: 1.2em;
    }
    .peer-checked\:bg-\[\#2563eb\] {
        background-color: #2563eb;
        box-shadow: 0 2px 5px rgba(37, 99, 235, 0.3);
    }

    /* General layout adjustments for top area */
    .dashboard-main-content-area .container {
        padding-top: 40px; /* Add top padding to move content down */
    }

    /* Footer styling to prevent overlap */
    footer {
        position: relative; /* Change to relative to flow naturally or adjust as needed */
        margin-left: 260px; /* Match main content margin */
        width: calc(100% - 260px); /* Match main content width */
        background-color: #111317; /* Ensure background color for footer */
        z-index: 50; /* Ensure footer is above other content if necessary */
        transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for footer with sidebar */
    }

    /* Adjust footer for mobile */
    @media (max-width: 992px) {
        footer {
            margin-left: 0;
            width: 100%;
        }
    }

 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

 <button class="sidebar-toggle-btn" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>

 <div class="dashboard-layout">
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-logo">
            <a href="/dashboard/">
                <span>WAHStory</span>
            </a>
        </div>
        <ul class="sidebar-nav">
            <li><a href="newdash (2).php" class="active"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> Social Health Insights</a></li>
            <li><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li><a href="#"><i class="fas fa-users"></i> WAHClub</a></li>
            <li><a href="#"><i class="fas fa-link"></i> My Connections</a></li>
            <li><a href="#"><i class="fas fa-briefcase"></i> Work Together</a></li>
            <li><a href="meetings.php"><i class="fas fa-calendar-check"></i> Meetings</a></li>
            <li><a href="#"><i class="fas fa-user-clock"></i> My Availability</a></li>
            <li><a href="#"><i class="fas fa-comments"></i> Live Chat</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="#"><i class="fas fa-globe-americas"></i> WAH Community</a></li>
        </ul>
        <div class="sidebar-footer">
            &copy; <?= date("Y") ?> WahStory
        </div>
    </aside>

    <main class="dashboard-main-content-area">
        <div class="cs-height_50 cs-height_lg_40 d-none d-lg-block"></div>
        <div class="container">

            <?php if(isset($UpgResp) && $UpgResp == 'success'){ ?>
                <h5 class="text-center" style="color: #4af186;"> Thank you for requesting to upgrade your account in premium, We'll get back to you soon!</h5>
            <?php }elseif(isset($UpgResp) && $UpgResp == 'error'){ ?>
                <h5 class="text-center text-pink"> Something went wrong, please try again...</h5>
            <?php } ?>

            <div class="row mb-4">
                <div class="col-lg-12">
                    <h4 class="mb-2 text-white">My Dashboard</h4>
                    <hr class="mb-2 border-secondary">
                </div>
            </div>

        <div class="wah-main-content px-0 sm:px-0 md:px-0 py-8 bg-[#191818] min-h-screen">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-[#1f2937] rounded-lg p-6 flex flex-col items-start shadow">
                    <span class="statistic-label">Story Views</span>
                    <span class="statistic-value mt-2"><?= $Storyrow['views'] ?? '77,678' ?></span>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex flex-col items-start shadow">
                    <span class="statistic-label">Story Likes</span>
                    <span class="statistic-value mt-2"><?= $Storyrow['likes'] ?? '66,894' ?></span>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex flex-col items-start shadow">
                    <span class="statistic-label">Total Votes</span>
                    <span class="statistic-value mt-2"><?= $VotesCount ?? '30,205' ?></span>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex flex-col items-start shadow">
                    <span class="statistic-label">Blog Published</span>
                    <span class="statistic-value mt-2"><?= $Userrow['blogs'] ?? '0' ?></span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-10 mb-10">
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="<?= $Userrow['profile_img'] ?? 'assets/images/profile.jpg' ?>" alt="Profile" class="w-20 h-20 rounded-full border-3 border-[#2563eb] object-cover shadow-lg"> <div>
                            <div class="profile-card-header"><?= $Userrow['firstname'].' '.$Userrow['lastname'] ?></div>
                            <div class="text-sm text-gray-400 mt-1">WAHClub Profile <span class="font-bold text-[#4af186]">(100% Complete)</span></div> </div>
                    </div>
                    <div class="flex gap-3 mt-4"> <a href="insights.php" class="bg-[#2563eb] text-white px-5 py-2.5 rounded text-sm font-semibold hover:bg-blue-700 transition duration-300 ease-in-out">View Insights</a>
                        <a href="profile.php" class="border border-[#2563eb] text-[#2563eb] px-5 py-2.5 rounded text-sm font-semibold hover:bg-blue-700 hover:text-white transition duration-300 ease-in-out">Edit Profile</a>
                    </div>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 flex flex-col justify-between shadow">
                    <div>
                        <div class="font-semibold text-xl mb-2 text-[#f9fafb]">Social Health Score</div> <div class="text-5xl font-bold text-[#2563eb] mb-3 leading-none"><?= $Userrow['social_health_score'] ?? 'View Insights' ?></div> <a href="insights.php" class="bg-[#2563eb] text-white px-5 py-2.5 rounded text-sm font-semibold hover:bg-blue-700 transition duration-300 ease-in-out">View Details</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-10 mb-10">
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 shadow">
                    <div class="font-semibold text-xl mb-4 text-[#f9fafb]">Meeting Show Options</div>
                    <div class="flex flex-col gap-4"> <label class="flex items-center gap-3 cursor-pointer"> <input type="checkbox" class="accent-[#2563eb] w-5 h-5" checked> <span class="text-[#f9fafb] text-base">Show Upcoming Meetings</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="accent-[#2563eb] w-5 h-5">
                            <span class="text-[#f9fafb] text-base">Show Past Meetings</span>
                        </label>
                    </div>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 shadow">
                    <div class="font-semibold text-xl mb-4 text-[#f9fafb]">Weekly Availability</div>
                    <div class="grid grid-cols-7 gap-3"> <?php $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']; foreach($days as $day): ?>
                        <div>
                            <div class="font-semibold text-center mb-2 text-[#f9fafb]"><?= $day ?></div>
                            <div class="flex flex-col gap-1.5"> <span class="bg-[#2563eb] text-white text-xs rounded px-2.5 py-1.5 text-center font-medium">9:00 AM</span>
                                <span class="bg-[#2563eb] text-white text-xs rounded px-2.5 py-1.5 text-center font-medium">2:00 PM</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-10 mb-10">
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 flex items-center justify-between shadow">
                    <div>
                        <div class="font-semibold text-lg text-[#f9fafb]">Profile Visibility</div>
                        <div class="text-sm text-gray-400 mt-1">Control who can see your profile</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="relative w-14 h-7 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#2563eb]"></div>
                        <span class="ml-3 text-sm font-medium text-[#f9fafb]">Public</span>
                    </label>
                </div>
                <div class="bg-[#1f2937] rounded-lg p-6 flex-1 flex items-center justify-between shadow">
                    <div>
                        <div class="font-semibold text-lg text-[#f9fafb]">Meeting Availability</div>
                        <div class="text-sm text-gray-400 mt-1">Toggle your meeting slots</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="relative w-14 h-7 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#2563eb]"></div>
                        <span class="ml-3 text-sm font-medium text-[#f9fafb]">Active</span>
                    </label>
                </div>
            </div>

            <div class="bg-[#1f2937] rounded-lg p-6 mb-10 shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="font-semibold text-xl text-[#f9fafb]">Upcoming Meets</div>
                    <a href="meetings.php" class="text-[#2563eb] hover:underline text-sm font-medium">View All <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between border-b border-gray-700 pb-3 last:border-b-0 last:pb-0">
                        <span class="text-[#f9fafb] text-base">Meeting with <?= $Userrow['firstname'].' '.$Userrow['lastname'] ?></span>
                        <span class="text-sm text-gray-400"><?= date('d M Y') ?></span>
                        <a href="#" class="bg-[#2563eb] text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-blue-700 transition">Join</a>
                    </div>
                    </div>
            </div>

            <div class="bg-[#1f2937] rounded-lg p-6 mb-10 shadow">
                <div class="font-semibold text-xl mb-4 text-[#f9fafb]">Recent Activity</div>
                <ul class="space-y-3"> <li class="flex items-center justify-between">
                        <span class="text-[#f9fafb] text-base"><i class="fas fa-heart text-red-500 mr-2"></i>Liked 2+ stories</span>
                        <span class="text-xs text-gray-400">Today</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-[#f9fafb] text-base"><i class="fas fa-bookmark text-yellow-500 mr-2"></i>Saved 2+ stories</span>
                        <span class="text-xs text-gray-400">Yesterday</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-[#f9fafb] text-base"><i class="fas fa-eye text-purple-500 mr-2"></i>Profile viewed by 10+ users</span>
                        <span class="text-xs text-gray-400">This week</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[#1f2937] rounded-lg p-6 mb-10 shadow">
                <div class="font-semibold text-xl mb-4 text-[#f9fafb]">Connect Social Media</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"> <a href="#" class="connectedsocial relative bg-[#2563eb] text-white px-4 py-2 rounded text-center font-semibold hover:bg-blue-700 transition">
                        Facebook
                        <div class="socialcomingsoon">Coming Soon</div>
                    </a>
                    <a href="#" class="connectedsocial relative bg-[#2563eb] text-white px-4 py-2 rounded text-center font-semibold hover:bg-blue-700 transition">
                        Twitter
                        <div class="socialcomingsoon">Coming Soon</div>
                    </a>
                    <a href="#" class="connectedsocial relative bg-[#2563eb] text-white px-4 py-2 rounded text-center font-semibold hover:bg-blue-700 transition">
                        LinkedIn
                        <div class="socialcomingsoon">Coming Soon</div>
                    </a>
                </div>
            </div>

            <div class="flex justify-end mb-10">
                <a href="preview.php" class="bg-[#2563eb] text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">Live Preview <i class="fas fa-external-link-alt ml-2"></i></a>
            </div>

            <div class="bg-[#1f2937] rounded-lg p-6 shadow">
                <div class="font-semibold text-xl mb-4 text-[#f9fafb]">Notifications</div>
                <ul class="space-y-2">
                    <li class="text-base text-gray-400">No new notifications.</li>
                </ul>
            </div>

        </div>
    </div>
</main>
</div>

<?php include('../footer.section.php');?>
<?php include('footer.commonJS.php');?>


<div class="modal fade" id="PostreminderStatus" tabindex="-1" aria-labelledby="PostreminderStatusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="PostreminderStatusLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-bell-slash"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Update Status</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="col-lg-12">
                 <form method="post" action="">
                     <input type="hidden" id="ReminderrowId" name="ReminderrowId" value="">
                     <input type="checkbox" id="ReminderStatus" name="ReminderStatus" value="1" required>
                     <label for="status" class="text-dark"> I have already posted this post.</label><br>
                     <button type="submit" name="UpdateReminderStatus" class="pt-1 pb-1 cs-font_14">Update</button>
                 </form>
            </div>

      </div>


    </div>
  </div>
</div>

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".alertStatusBtn").click(function() {
            var notifId = $(this).attr("data-notifid");
            $("#ReminderrowId").val(notifId);
        });

        // Sidebar active link logic
        var currentFilename = window.location.pathname.split("/").pop();
        if (currentFilename === "") { // Handles root path or directory default
             // Assuming 'newdash (2).php' or similar is the default dashboard page
            currentFilename = 'newdash (2).php'; // Adjust if your default file name is different
        }

        $('.sidebar-nav li a').each(function() {
            var $this = $(this);
            var linkFilename = $this.attr('href').split("/").pop();

            // Make Dashboard active if current page is the main dashboard page
            if (linkFilename === currentFilename) {
                $this.addClass('active');
            } else {
                $this.removeClass('active');
            }
        });

        // Fallback if no link is active (e.g. ensure Dashboard is active on the main dashboard page)
        if ($('.sidebar-nav li a.active').length === 0) {
            $('.sidebar-nav li a[href*="newdash (2).php"]').addClass('active');
        }

        // Sidebar toggle for mobile
        $('#sidebarToggle').on('click', function() {
            $('#dashboardSidebar').toggleClass('open');
        });

    });
</script>


  <script>
    $(document).ready(function() {
        $(".ViewPostBtn").click(function() {
            var notifId = $(this).attr("data-notifid");
        $.ajax({
                type: 'POST',
                url: 'calendarajax.php', // Ensure this path is correct
                data: { publicId: notifId },
                dataType: 'json', // Expect JSON response
                success: function (response) {
                    if(response && response.platform && response.scheduletime && response.contentType) {
                        document.getElementById("platform-name").innerHTML = response.platform;

                        var scheduleTime = new Date(response.scheduletime.replace(/-/g, "/")); // Ensure date is parsed correctly

                        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        var weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                        var day = scheduleTime.getDate();
                        var month = months[scheduleTime.getMonth()];
                        var year = scheduleTime.getFullYear();
                        var weekday = weekdays[scheduleTime.getDay()];
                        var formattedDate = weekday + " " + day + " " + month + ", " + year;
                        document.getElementById("post-time").innerText = formattedDate;

                        var hours = scheduleTime.getHours();
                        var minutes = scheduleTime.getMinutes();
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12;
                        minutes = minutes < 10 ? '0'+minutes : minutes;
                        var formattedTime = hours + ':' + minutes + ' ' + ampm;
                        document.getElementById("postHour").innerText = formattedTime;

                        document.getElementById("ContentType").innerText = response.contentType;

                        var contentAttachment = document.getElementById("contentattachment");
                        if (response.caption) {
                            contentAttachment.href = "/images/contentsuggestion/attachments/" + response.caption;
                            contentAttachment.style.display = "inline";
                        } else {
                            contentAttachment.style.display = "none";
                        }

                        var imageAttachment = document.getElementById("imageattachment");
                        if (response.img) {
                            imageAttachment.href = "/images/contentsuggestion/" + response.img;
                            imageAttachment.style.display = "inline";
                        } else {
                            imageAttachment.style.display = "none";
                        }
                    } else {
                        // console.error("Invalid response structure:", response);
                        // Handle error display in modal if needed
                    }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // console.error("AJAX error:", textStatus, errorThrown);
                // Handle error display in modal if needed
            }
        });
        });
    });
</script>

      <script src="//code.tidio.co/xevxx6yr1y8hel4trwkgl5bpvlskjh1r.js" async></script>

</body>
</html>