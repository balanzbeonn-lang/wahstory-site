<?php
require_once("../db/postClass.php");
$post = new Post();

if (!$post->adminCheck()) {
    $_SESSION["msg"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: index.php');
}

if (isset($_GET["delId"])) {
    $response = $post->delYoutubeVid($_GET["delId"]);
    switch ($response) {
        case "Success": {
                $_SESSION["response"] = "<script>Swal.fire(    
                    'Videos Deleted Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["response"] = "<script>Swal.fire(
                    'Error While Deleting Video!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: add-videos.php');
}

$videos = $post->getYoutubeVids();
?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="actions/addVideo" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4>Add Video</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="title" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="src" value="https://www.youtube.com/embed/" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="submit" class="btn btn-primary" value="Submit"></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="row">
                <?php if ($videos) {
                    foreach ($videos as $video) {
                ?>
                        <div class="col-md-6">
                            <div class="card">
                                <form method="POST" action="actions/updateVideo" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input name="title" value="<?php echo $video["title"] ?>" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input name="src" value="<?php echo $video["src"] ?>" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <input type="text" value="<?php echo $video['id']; ?>" hidden name="id">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="submit" class="btn btn-primary" value="Update"></input>
                                                <a style="cursor: pointer;color:white" onclick="delVid(<?php echo $video['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>

</div>



</div>

</section>

</div>

</div>

</div>
<script>
    function delVid(id) {
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
                window.location.href = "add-videos.php?delId=" + id;
            }
        })
    }
</script>

<script src="assets/js/app.min.js"></script>

<!-- JS Libraies -->

<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/summernote/summernote-bs4.js"></script>

<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/lightgallery/dist/js/lightgallery-all.js"></script>
<script src="assets/js/page/light-gallery.js"></script>
<script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>

<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>

<script src="assets/bundles/ckeditor/ckeditor.js"></script>

<!-- Page Specific JS File -->

<script src="assets/js/page/ckeditor.js"></script>

<!-- Template JS File -->

<script src="assets/js/scripts.js"></script>

<!-- Custom JS File -->

<script src="assets/js/custom.js"></script>

<script src="assets/js/page/create-post.js"></script>
<?php if (isset($_SESSION["response"])) {
    echo $_SESSION["response"];
    if (empty($_GET["delId"])) {
        unset($_SESSION["response"]);
    }
} ?>

</body>

</html>