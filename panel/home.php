<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("../db/postClass.php");
$postObj = new Post();
$script = "";
if (!$postObj->adminCheck()) {
    $_SESSION["session_expire"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: logout');
}

$posts = $postObj->getAllPosts();
$alert = "";

if (isset($_SESSION["storyofthemonth"])) {
    switch ($_SESSION["storyofthemonth"]) {
        case "Success": {
                $alert = "<script>Swal.fire(
                    'Story of the month Set Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                    'Error While Setting Story of the month!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["storyofthemonth"]);
}


if (isset($_SESSION["boost"])) {
    switch ($_SESSION["boost"]) {
        case "Success": {
                $alert = "<script>Swal.fire(
                    'Post Boosted Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                    'Error While Boosting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["boost"]);
}

if (isset($_SESSION["unboost"])) {
    switch ($_SESSION["unboost"]) {
        case "Success": {
                $alert = "<script>Swal.fire(
                    'Post Un-Boosted Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                    'Error While Un-Boosting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["unboost"]);
}


?>
<?php include_once("navBar.php") ?>

<!-- Main Content -->
<div class="main-content">
    <section>
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="href('totalPosts')" style="cursor: pointer">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Posts</h5>
                                        <h2 class="mb-3 font-18"><?php echo $postObj->getAllPostsCount("Posts")["count"] ?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="href('totalReactions')" style="cursor: pointer">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> Total Reactions</h5>
                                        <h2 class="mb-3 font-18">
                        <?php 
                        //echo $postObj->getAllPostsCount("Reactions")["count"] ?>
                        </h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="href('totalLikes')" style="cursor: pointer">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Likes</h5>
                                        <h2 class="mb-3 font-18"><?php echo $postObj->getAllPostsCount("Likes")["count"] ?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="href('totalViews')" style="cursor: pointer">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Views</h5>
                                        <h2 class="mb-3 font-18"><?php echo $postObj->getAllPostsCount("Views")["count"] ?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1>Top Section</h1>
        <div class="card">
            <div class="card-header">
                <h4>Set As Top Section and Story of The Month</h4>
                <div class="card-header-action">
                    <a data-collapse="#top-posts" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="top-posts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "top");
                                        
                                        $checkstoryofthemonth = $postObj->isSetStoryAsMonth($post["id"]);
                                        
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"]; ?></td>
                                            <td><?php echo $post["date"]; ?></td>
                                            <td>
                                                <?php echo $post["title"]; ?>
                                            </td>
                                            <td><?php echo $post["author"]; ?></td>
                                            <td><?php echo $post["category"]; ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img']; ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]); ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id']; ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id']; ?>,'top')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id']; ?>,'top')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } 
                                        if($checkstoryofthemonth){
                                        
                                        }else{
                                                        ?>
                                         <a onclick="storyofthemonth(<?php echo $post['id']; ?>)" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Story of the Month</a>
                                            <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Story of the Month</h4>
                        <div class="card-header-action">
                            <a data-collapse="#story-of-month" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="story-of-month">
                        <div class="card-body">
                            <?php //include_once("includes/storyofmonth.php") ?>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>

        <hr>

        <h1>Second Section</h1>

        <div class="card">
            <div class="card-header">
                <h4>Trending Posts</h4>
                <div class="card-header-action">
                    <a data-collapse="#trending-posts" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="trending-posts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "trending"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'trending')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'trending')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <h1>Third Section</h1>

        <div class="card">
            <div class="card-header">
                <h4>What's New Posts</h4>
                <div class="card-header-action">
                    <a data-collapse="#whatsnew-posts" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="whatsnew-posts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-3">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "whatsNew"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'whatsNew')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'whatsNew')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <h1>Manage Posts by Categories</h1>

        <!-- Game Changer Category -->
        <div class="card">
            <div class="card-header">
                <h4>Game Changer Category</h4>
                <div class="card-header-action">
                    <a data-collapse="#game-changer" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="game-changer">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-7">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = $postObj->getPostsByCat(8);
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "Game Changer"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'Game Changer')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'Game Changer')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Her Story Category -->
        <div class="card">
            <div class="card-header">
                <h4>Her Story Category</h4>
                <div class="card-header-action">
                    <a data-collapse="#her-story" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="her-story">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-8">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = $postObj->getPostsByCat(9);
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "Her Story"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'Her Story')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'Her Story')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Passion Story Category -->
        <div class="card">
            <div class="card-header">
                <h4>Passion Story Category</h4>
                <div class="card-header-action">
                    <a data-collapse="#passion-story" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="passion-story">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-9">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = $postObj->getPostsByCat(10);
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "Passion Story"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'Passion Story')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'Passion Story')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Pride Story Category -->
        <div class="card">
            <div class="card-header">
                <h4>Pride Story Category</h4>
                <div class="card-header-action">
                    <a data-collapse="#pride-story" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="pride-story">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-10">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = $postObj->getPostsByCat(11);
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "Pride Story"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'Pride Story')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'Pride Story')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Blog Category -->
        <div class="card">
            <div class="card-header">
                <h4>Blogs</h4>
                <div class="card-header-action">
                    <a data-collapse="#blogs" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="blogs">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-10">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Post id</th>
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Post Category</th>
                                    <th>Post Image</th>
                                    <th>Post By</th>
                                    <th>Boost Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = $postObj->getPostsByCat(13);
                                if ($posts) {
                                    $i = 1;
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "Blog"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'Blog')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'Blog')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h1>No Posts</h1>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <!-- NEWS Category -->
        <div class="card">
            <div class="card-header">
                <h4>News Posts</h4>
                <div class="card-header-action">
                    <a data-collapse="#news-posts" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="news-posts">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $posts = $postObj->getPostsByCat(12);
                        if ($posts) {
                            $i = 1;
                        ?>
                            <table class="table table-striped" id="table-6">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Post id</th>
                                        <th>Post Date</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Post Category</th>
                                        <th>Post Image</th>
                                        <th>Post By</th>
                                        <th>Boost Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($posts as $post) {
                                        $checkBoost = $postObj->isBoosted($post["id"], "news"); ?>

                                        <tr>
                                            <td>
                                                <?php echo $i;
                                                $i++; ?>
                                            </td>
                                            <td><?php echo $post["id"] ?></td>
                                            <td><?php echo $post["date"] ?></td>
                                            <td>
                                                <?php echo $post["title"] ?>
                                            </td>
                                            <td><?php echo $post["author"] ?></td>
                                            <td><?php echo $post["category"] ?></td>
                                            <td>
                                                <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                            </td>
                                            <td><?php echo ucfirst($post["origin"]) ?></td>
                                            <td>
                                                <div class="badge badge-<?php if ($checkBoost) {
                                                                            echo "warning";
                                                                        } ?> badge-shadow"><?php if ($checkBoost) {
                                                                                                echo "Boosted";
                                                                                            } ?></div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                    <div class="dropdown-menu">
                                                        <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                        <?php if ($checkBoost) { ?>
                                                            <a onclick="unboostPost(<?php echo $post['id'] ?>,'News')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                        <?php } else { ?>
                                                            <a onclick="boostPost(<?php echo $post['id'] ?>,'News')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                        <?php } ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "<h1>No Posts</h1>";
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>


        <hr>
         
        <h1>Fifth Section</h1>
        <div class="card">
            <div class="card-header">
                <h4>Testimonials</h4>
                <div class="card-header-action">
                    <a data-collapse="#testimonials" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="testimonials">
                <div class="card-body">
                    <?php
                    // include_once("includes/testimonials_image.php");
                    // include_once("includes/testimonials.php") ?>
                </div>
            </div>
        </div>

         
        <!-- <div class="card">
            <div class="card-header">
                <h4>About Us</h4>
                <div class="card-header-action">
                    <a data-collapse="#aboutUs" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="aboutUs">
                <div class="card-body">
                    <?php //include_once("includes/testimonials.php") ?>
                </div>
            </div>
        </div> -->
        <!-- <div class="card">
            <div class="card-header">
                <h4>Advertise with us</h4>
                <div class="card-header-action">
                    <a data-collapse="#Advertise-with-us" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="Advertise-with-us">
                <div class="card-body">
                    <?php //include_once("includes/videos.php") ?>
                </div>
            </div>
        </!-->
        <!-- <div class="card">
            <div class="card-header">
                <h4>Our Voices</h4>
                <div class="card-header-action">
                    <a data-collapse="#our-voices" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="our-voices">
                <div class="card-body">
                </div>
            </div>
        </div> -->
        <hr>

        <h1>Last Section</h1>
        <div class="card">
            <div class="card-header">
                <h4>Meet The Team</h4>
                <div class="card-header-action">
                    <a data-collapse="#team" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="team">
                <div class="card-body">
                    <?php //include_once("includes/team.php") ?>
                </div>
            </div>
        </div>

    </section>
</div>
</div>
</div>
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/summernote/summernote-bs4.js"></script>
<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/bundles/ckeditor/ckeditor.js"></script>
<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/lightgallery/dist/js/lightgallery-all.js"></script>
<script src="assets/js/page/light-gallery.js"></script>
<script src="assets/js/page/ckeditor.js"></script>
<script src="assets/js/page/create-post.js"></script>
<script src="assets/js/page/index.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<script>


function storyofthemonth(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/storyofthemonth.php?id=" + id;
            }
        })
    }


    function boostPost(id, s) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Boost it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/boost.php?id=" + id + "&section=" + s;
            }
        })
    }

    function unboostPost(id, s) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Un-Boost it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/unboost.php?id=" + id + "&section=" + s;
            }
        })
    }

    function href(url) {
        window.location.href = "stats/" + url + ".php";
    }
    // Script for Company Campaign Update image upload Preview;
   
</script>
<?php echo $alert;
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>
</body>

</html>