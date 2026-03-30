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
if (empty($_GET)) {
    $blogs = $postObj->getBlogs();
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
                                   
                                    <!-- ======= Portfolio items ===-->
                                    <div class="projects-container scrollimation in">
                                        <div class="row">
                                            <?php if ($blogs) {
                                                foreach ($blogs as $blog) {
                                            ?>
                                                    <article class="col-md-3 col-sm-6 portfolio-item web-design apps psd">
                                                        <div class="portfolio-thumb in">
                                                            <a href="#" class="main-link">
                                                                <div class="update-post-img" style="background-image: url('../images/blogs/<?php echo $blog["img"]; ?>');"></div>
                                                                <!-- <img style="max-height:210px;" class="img-responsive img-center" src="../images/posts/<?php echo $blog["img"]; ?>" alt=""> -->
                                                                <a style="cursor: pointer" onclick="updateBlog(<?php echo $blog['id']; ?>)" class="project-title">Update</a>
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
    function updateBlog(id) {
        window.location.href = "updateblog.php?id=" + id;
    }
</script>