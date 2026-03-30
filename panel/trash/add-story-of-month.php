<?php
require_once("../db/postClass.php");
$postObj = new Post();

$script = "";

if (!$postObj->adminCheck()) {
    $_SESSION["msg"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: index.php');
}

$post = $postObj->getStoryofMonth();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($post) {
        $_SESSION["update"]  = $postObj->updateStoryOfMonth();
    }
    else{
        $_SESSION["response"]  = $postObj->addStoryOfMonth();
    }
}



if (isset($_SESSION["response"])) {

    switch ($_SESSION["response"]) {

        case "Success": {

                $script = "<script>Swal.fire(

                'Story of the Month Added Seccussfully!','',

                'success'

                )</script>";

                break;
            }

        case "Error": {

                $script = "<script>Swal.fire(

                'Error While Adding Story of the Month!','',

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

        case "Error_size": {

                $script = "<script>Swal.fire(

                'Image size should be less than 1MB!','',

                'warning'

              )</script>";

                break;
            }
    }

    unset($_SESSION["response"]);
}

if (isset($_SESSION["update"])) {

    switch ($_SESSION["update"]) {

        case "Success": {

                $script = "<script>Swal.fire(

                'Story of the Month Updated Seccussfully!','',

                'success'

                )</script>";

                break;
            }

        case "Error": {

                $script = "<script>Swal.fire(

                'Error While Updating Story of the Month!','',

                'error'

              )</script>";

                break;
            }
    }

    unset($_SESSION["update"]);
}
?>

<?php include_once("navBar.php") ?>

<div class="main-content">

    <section class="section">

        <div class="section-body">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <form method="POST" enctype="multipart/form-data">

                            <div class="card-header">

                                <h4><?php if ($post) {
                                        echo "Update";
                                    } else {
                                        echo "Enter";
                                    } ?> Story Of The Month</h4>

                            </div>

                            <div class="card-body">

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="title" type="text" class="form-control" value="<?php if ($post) {
                                                                                                        echo $post['title'];
                                                                                                    } ?>" required>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="author" type="text" class="form-control" value="<?php if ($post) {
                                                                                                            echo $post['author'];
                                                                                                        } ?>" required>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Short Description</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="description" type="text" class="form-control" value="<?php if ($post) {
                                                                                                                echo $post['description'];
                                                                                                            } ?>" required>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="quote" type="text" class="form-control" value="<?php if ($post) {
                                                                                                        echo $post['quote'];
                                                                                                    } ?>" required>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>

                                    <div class="col-sm-12 col-md-7">

                                        <textarea name="content" class="summernote" required><?php if ($post) {
                                                                                                    echo $post['content'];
                                                                                                } ?></textarea>

                                    </div>

                                </div>

                                <?php if ($post["img"]) { ?>

                                    <div class="form-group row mb-4">

                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Image:</label>

                                        <div class="col-sm-12 col-md-7">

                                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                                <div class="col-md-8">
                                                    <a href="../images/posts/<?php echo $post["img"] ?>" data-sub-html="Demo Description">

                                                        <img class="img-responsive thumbnail" src="../images/posts/<?php echo $post["img"] ?>" alt="">

                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                <?php } ?>


                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post) {
                                                                                                                echo "Change Image:";
                                                                                                            } else {
                                                                                                                echo "Thumbnail";
                                                                                                            } ?></label>

                                    <div class="col-sm-12 col-md-7">

                                        <div id="image-preview" class="image-preview">

                                            <label for="image-upload" id="image-label">Choose File</label>

                                            <input type="file" accept="image/*" name="image" id="image-upload" <?php if (!$post) {
                                                                                                                    echo "required";
                                                                                                                } ?> />

                                        </div>

                                    </div>

                                </div>

                                <?php if ($post["video"]) { ?>

                                    <div class="form-group row mb-4">

                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Video :</label>

                                        <div class="col-sm-12 col-md-7">

                                            <video width="400" controls>
                                                <source src="videos/<?php echo $post["video"] ?>" type="video/mp4">
                                                Your browser does not support HTML5 video.
                                            </video>

                                        </div>

                                    </div>

                                <?php } ?>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post["video"]) {
                                                                                                                echo "Change";
                                                                                                            } else {
                                                                                                                echo "Post";
                                                                                                            } ?> Video</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="video" accept="video/*" type="file" class="custom-file-input" id="customFile">

                                        <label class="custom-file-label" for="customFile">Choose file</label>

                                    </div>

                                </div>

                                <?php if ($post["audio"]) { ?>

                                    <div class="form-group row mb-4">

                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Audio :</label>

                                        <div class="col-sm-12 col-md-7">

                                            <audio controls>
                                                <source src="audios/<?php echo $post["audio"] ?>">
                                                Your browser does not support the audio element.
                                            </audio>

                                        </div>

                                    </div>

                                <?php } ?>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post["audio"]) {
                                                                                                                echo "Change";
                                                                                                            } else {
                                                                                                                echo "Post";
                                                                                                            } ?> Audio</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="audio" accept="audio/*" type="file" class="custom-file-input" id="customFile">

                                        <label class="custom-file-label" for="customFile">Choose file</label>

                                    </div>

                                </div>





                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input type="submit" class="btn btn-primary" value="<?php if ($post) {
                                                                                                echo "Update";
                                                                                            } else {
                                                                                                echo "Publish";
                                                                                            } ?>"></input>

                                    </div>

                                </div>

                        </form>

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

<script src="assets/bundles/summernote/summernote-bs4.js"></script>
<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/bundles/ckeditor/ckeditor.js"></script>
<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/lightgallery/dist/js/lightgallery-all.js"></script>
<script src="assets/js/page/light-gallery.js"></script>
<script src="assets/js/page/ckeditor.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/page/create-post.js"></script>


</body>





<!-- Mirrored from www.radixtouch.in/templates/admin/ Tech Marketz/source/light/forms-editor.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 06:15:41 GMT -->



</html>

<?php echo $script; ?>