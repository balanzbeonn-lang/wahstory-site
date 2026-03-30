<?php
require_once("../db/postClass.php");
$postObj = new Post();

$prods = null;
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

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Post Deleted seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error while adding post!','',
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

if (isset($_GET["id"])) {
    $_SESSION["response"] = $postObj->delPost($_GET["id"]);
    header('Location: delete-post.php');
} elseif (isset($_GET["cat"])) {
    $posts = $postObj->getPostsByCat($_GET["cat"]);
} elseif (empty($_GET)) {
    $posts = $postObj->getAllPosts();
}
?>
<?php include_once("navBar.php") ?>
<div class="main-content">
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
                                            <li class="<?php if ($url == "delete-post") echo "active" ?>">
                                                <a href="delete-post" data-filter="*">All Categories</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=Game%20Changer") echo "active" ?>">
                                                <a href="delete-post?cat=Game Changer">Game Changer</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=Her%20Story") echo "active" ?>">
                                                <a href="delete-post?cat=Her Story">Her Story</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=Passion%20Story") echo "active" ?>">
                                                <a href="delete-post?cat=Passion Story">Passion Story</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=Pride%20Story") echo "active" ?>">
                                                <a href="delete-post?cat=Pride Story">Pride Story</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=News") echo "active" ?>">
                                                <a href="delete-post?cat=News">News</a>
                                            </li>
                                            <li class="<?php if ($url == "delete-post?cat=Blog") echo "active" ?>">
                                                <a href="delete-post?cat=Blog">Blog</a>
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
                                                                <a style="cursor: pointer" onclick="deletePost(<?php echo $post['id']; ?>)" class="project-title">Delete</a>
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
    function deletePost(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "delete-post.php?id=" + id;
            }
        })
    }
</script>