<?php
require_once("../db/postClass.php");
$postObj = new Post();

if (!$postObj->adminCheck()) {
    $_SESSION["session_expire"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: logout');
}


$prods = null;
$script = "";
if (isset($_GET["cat"])) {
    $posts = $postObj->getPostsByCat($_GET["cat"]);
} elseif (empty($_GET)) {
    $posts = $postObj->getAllPosts();
}

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Post Updated seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error while updating post!','',
                'error'
              )</script>";
                break;
            }
        case "not_admin": {
                $script = "<script>Swal.fire(
                'Sorry but you are not a admin!','',
                'warning'
              )</script>";
                break;
            }
    }
    unset($_SESSION["response"]);
}

?>
<?php include_once("navBar.php") ?>
<div class="main-content">

    <script>
        console.log('<?= $url; ?>');
    </script>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bootstrap snippet">
                                <section id="portfolio" class="gray-bg padding-top-bottom">
                                    <!--==== Portfolio Filters ====-->
                                    <div class="categories">
                                        <ul>
                                            <li class="<?php if ($url == "update-post") echo "active" ?>">
                                                <a href="update-post" data-filter="*">All Categories</a>
                                            </li>
                                            <li class="<?php if ($url == "update-post?cat=8") echo "active" ?>">
                                                <a href="update-post?cat=8">Game Changer</a>
                                            </li>
                                            <li class="<?php if ($url == "update-post?cat=9") echo "active" ?>">
                                                <a href="update-post?cat=9">Her Story</a>
                                            </li>
                                            <li class="<?php if ($url == "update-post?cat=10") echo "active" ?>">
                                                <a href="update-post?cat=10">Passion Story</a>
                                            </li>
                                            <li class="<?php if ($url == "update-post?cat=11") echo "active" ?>">
                                                <a href="update-post?cat=11">Pride Story</a>
                                            </li>
                                            
                                            <li class="<?php if ($url == "update-post?cat=22") echo "active" ?>">
                                                <a href="update-post?cat=22">Influencers of the Century</a>
                                            </li>
                                            <li class="<?php if ($url == "update-post?cat=16") echo "active" ?>">
                                                <a href="update-post?cat=16">Living Well </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <!-- ======= Portfolio items ===-->
                                    <div class="projects-container scrollimation in">
                                        <div class="row">
                                            <?php if ($posts) {
                                                foreach ($posts as $post) {
                                            ?>
                                                    <article class="col-md-3 col-sm-6 portfolio-item web-design apps psd">
                                                        <div class="portfolio-thumb in">
                                                            <a href="#" class="main-link">
                                                                <div class="update-post-img" style="background-image: url('../images/posts/<?php echo $post["img"]; ?>');"></div>
                                                                <!-- <img style="max-height:210px;" class="img-responsive img-center" src="../images/posts/<?php echo $post["img"]; ?>" alt=""> -->
                                                                <a style="cursor: pointer" onclick="updatePost(<?php echo $post['id']; ?>)" class="project-title">Update</a>
                                                                <span class="overlay-mask"></span>
                                                            </a>
                                                        </div>
                                                    </article>
                                            <?php    }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>

</html>
<?php echo $script; ?>
<script>
    function updatePost(id) {
        window.location.href = "update.php?id=" + id;
    }
</script>