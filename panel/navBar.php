<?php
$reqUrl = $_SERVER['REQUEST_URI'];
$trimUrl = rtrim($reqUrl, "");
$explodeUrl = explode("/", $trimUrl);
$url = end($explodeUrl); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> Wah Story admin dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='../images/wah_fav.png' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
    <!-- <script src="assets/js/myangular.js"></script> -->
    <script src="assets/js/myjs.js"></script>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/bundles/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="assets/bundles/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
    <link href="assets/bundles/lightgallery/dist/css/lightgallery.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='../images/wah_fav.png' />
</head>

<body ng-app="myApp">
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                    </ul>
                    <a href="logout" class="btn btn-primary" style="background-color: red;position:absolute;top:15px;right:30px">Logout</a>
                </div>
            </nav>
            <!-- -- SideBar -- -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="home"> Wah Story</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown <?php if ($url == "home") echo "active" ?>">
                            <a href="home" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        
                        
                <li class="dropdown <?php if ($url == "add-blog" || $url == "update-blog") echo "active" ?>">
                    <a href="javascript:void(0);" class="menu-toggle nav-link has-dropdown">
                        <i data-feather="layout"></i>
                        <span>Add a Blog</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="nav-link" href="add-blog">Add Blog</a>
                        </li> 
                        <li>
                            <a class="nav-link" href="update-blog">Update Blog</a>
                        </li>
                    </ul>
                </li>
                        <li class="dropdown <?php if ($url == "add-post" || $url == "add_category" || $url == "update-post") echo "active" ?>">
                            <a href="javascript:void(0);" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Add
                                    a Post</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="add-post">Add Post</a></li> 
                                <li><a class="nav-link" href="update-post">Update Post</a></li>
                                <li><a class="nav-link" href="add_category">Add New Category</a></li>
                                <li><a class="nav-link" href="delete-post">Delete Post</a></li> 
                            </ul>
                        </li>
                        
                        <li class="dropdown <?php if ($url == "add-corporatenews") echo "active" ?>">
                            <a href="javascript:void(0);" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Corporate News</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="add-corporatenews">Add Corporate News</a></li> 
                                <li><a class="nav-link" href="add-corporatenews">Update Corporate News</a></li> 
                                <li><a class="nav-link" href="add-corporatenews">Delete Corporate News</a></li> 
                            </ul>
                        </li>

                   <li class="dropdown <?php if ($url == "socialhealthform") echo "active" ?>">
                        <a href="socialhealthform" class="nav-link"><i data-feather="pie-chart"></i><span>Social Health Users</span></a>
                    </li>
                    
                    
                    <li class="dropdown <?php if ($url == "pre-registers-wahclub" || $url == "registers-wahclub" || $url == "add-nfccard" || $url == "update-nfccard" || $url == "nfccards") echo "active" ?>">
                        <a href="javascript:void(0);" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>WAHClub</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="pre-registers-wahclub">Pre Registers</a></li> 
                            <li><a class="nav-link" href="registers-wahclub">WAHClub Registers</a></li>  
                            
                            <li>
                                <a class="nav-link" href="add-nfccard">Add NFC Card</a>
                            </li> 
                            <li>
                                <a class="nav-link" href="update-nfccard">Update NFC Card</a>
                            </li>
                            <li>
                                <a class="nav-link" href="nfccards">All NFC Cards</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                   <li class="dropdown <?php if ($url == "getintouchrequests") echo "active" ?>">
                        <a href="getintouchrequests" class="nav-link"><i data-feather="pie-chart"></i><span>Service Enquiries</span></a>
                    </li>
                    
                   <li class="dropdown <?php if ($url == "sharedstories") echo "active" ?>">
                        <a href="sharedstories" class="nav-link"><i data-feather="pie-chart"></i><span>Shared Stories</span></a>
                    </li>
                    
                   <li class="menu-header">Content Suggestion</li>
                    <li class=" <?php if ($url == "add-event") echo "active" ?>">
                        <a href="add-event" class="nav-link"><i data-feather="grid"></i><span>Add Suggestion</span></a>
                    </li>
                    <li class=" <?php if ($url == "festival-calendar") echo "active" ?>">
                        <a href="festival-calendar" class="nav-link"><i data-feather="grid"></i><span>Festival Calendar</span></a>
                    </li>
                   
                   
                   <li class="menu-header">Nominations</li>
                   
                   <li class=" <?php if ($url == "nominees-list") echo "active" ?>">
                        <a href="nominees-list" class="nav-link"><i data-feather="grid"></i><span>Nominees List</span></a>
                    </li>
                    
                   <li class=" <?php if ($url == "nomination-invitations") echo "active" ?>">
                        <a href="nomination-invitations" class="nav-link"><i data-feather="grid"></i><span>Nomination Invitations</span></a>
                    </li>
                    
                    <li class=" <?php if ($url == "unallocated-stories") echo "active" ?>">
                        <a href="unallocated-stories" class="nav-link"><i data-feather="grid"></i><span>Unallocated Stories</span></a>
                    </li>
                    
                    <li class=" <?php if ($url == "allocated-stories") echo "active" ?>">
                        <a href="allocated-stories" class="nav-link"><i data-feather="grid"></i><span>Allocated Stories</span></a>
                    </li>
                    <li class=" <?php if ($url == "evaluated-stories") echo "active" ?>">
                        <a href="evaluated-stories" class="nav-link"><i data-feather="check"></i><span>Evaluated Stories</span></a>
                    </li>
                    
                    
                    <li class=" <?php if ($url == "jury-members") echo "active" ?>">
                        <a href="jury-members" class="nav-link"><i data-feather="grid"></i><span>Jury Members</span></a>
                    </li>
                   
                   
                   
                   <li class="menu-header">Authorised</li>
                    <li class="dropdown <?php if ($url == "users" || $url == "verify-posts") echo "active" ?>">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Authorised</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="users">Verify Users</a></li>
                                <li><a href="verify-posts">Verify Posts</a></li>
                            </ul>
                        </li>
                        </ul>
                
                </aside>
            </div>