<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> Wah Story admin dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.ico' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="../assets/js/myangular.js"></script>
    <script src="assets/js/myjs.js"></script>
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/bundles/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="../assets/bundles/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="../assets/bundles/jquery-selectric/selectric.css">
    <link href="../assets/bundles/lightgallery/dist/css/lightgallery.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.ico' />
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
                </div>
            </nav>
            <!-- -- SideBar -- -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="../home.php"> Wah Story</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown active">
                            <a href="../home.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>


                        <li class="menu-header">Admin Tools</li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Add
                                    an item</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="../add-post.php">Add Post</a></li>
                                <li><a class="nav-link" href="../add-story-of-month.php">Add Story of the month</a></li>
                                <li><a class="nav-link" href="../add-compaign.php">Add Compaign</a></li>
                                <li><a class="nav-link" href="../addQA.php">Add Q/A</a></li>
                                <li><a class="nav-link" href="../add-videos.php">Add Videos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>Update an item</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="../update-post.php">Update Post</a></li>
                                <!-- <li><a class="nav-link" href="update-cat.php">Update Category</a></li>
                                <li><a class="nav-link" href="update-brand.php">Update Brand</a></li> -->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Delete an item</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="../delete-post.php">Delete Post</a></li>
                                <!-- <li><a class="nav-link" href="delete-cat.php">Delete Category</a></li>
                                <li><a class="nav-link" href="delete-brand.php">Delete Brand</a></li> -->
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Auth</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../users.php">Varify Users</a></li>
                                <li><a href="../varify-posts.php">Varify Posts</a></li>
                                <!-- <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                                <li><a href="auth-reset-password.html">Reset Password</a></li>
                                <li><a href="subscribe.html">Subscribe</a></li> -->
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Q/A</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../viewQA.php">View Q/A</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>