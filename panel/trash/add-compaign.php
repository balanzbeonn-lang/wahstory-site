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

$script = "";


$compaign = $post->getCompaign();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($compaign) {
        $_SESSION["response"]  = $post->updateCompaign();
    } else {
        $_SESSION["response"]  = $post->addCompaign();
    }
}

if (isset($_SESSION["response"])) {

    switch ($_SESSION["response"]) {

        case "Success": {

                $script = "<script>Swal.fire(

                'Compaign Added Seccussfully!','',

                'success'

                )</script>";

                break;
            }

        case "Error": {

                $script = "<script>Swal.fire(

                'Error While Adding Compaign!','',

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

                                <h4><?php if ($compaign) {
                                        echo "Update";
                                    } else {
                                        echo "Enter";
                                    } ?> Compaign Details</h4>

                            </div>

                            <div class="card-body">


                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="title" value="<?php echo $compaign["title"] ?>" type="text" class="form-control" required>

                                    </div>

                                </div>
                               

                                <?php if ($compaign) { ?>

                                    <div class="form-group row mb-4">

                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Compaign Image:</label>

                                        <div class="col-sm-12 col-md-7">

                                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                                <div class="col-md-8">
                                                    <a href="../images/posts/<?php echo $compaign["img"] ?>" data-sub-html="Demo Description">

                                                        <img class="img-responsive thumbnail" src="../images/posts/<?php echo $compaign["img"] ?>" alt="">

                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                <?php } ?>




                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($compaign) {
                                                                                                                echo "Change Image:";
                                                                                                            } else {
                                                                                                                echo "Thumbnail";
                                                                                                            } ?></label>

                                    <div class="col-sm-12 col-md-7">

                                        <div id="image-preview" class="image-preview">

                                            <label for="image-upload" id="image-label">Choose File</label>

                                            <input type="file" accept="image/*" name="image" id="image-upload" <?php if ($compaign) {
                                                                                                                    echo "";
                                                                                                                } else {
                                                                                                                    echo "required";
                                                                                                                } ?> />

                                        </div>

                                    </div>

                                </div>


                                <!-- <div class="form-group row mb-4">

                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Video</label>

                                                <div class="custom-file col-sm-12 col-md-7">

                                                    <input name="video" accept="video/*" type="file" class="custom-file-input" id="customFile">

                                                    <label class="custom-file-label" for="customFile">Choose file</label>

                                                </div>

                                            </div>

                                            <div class="form-group row mb-4">

                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Audio</label>

                                                <div class="custom-file col-sm-12 col-md-7">

                                                    <input name="audio" accept="audio/*" type="file" class="custom-file-input" id="customFile">

                                                    <label class="custom-file-label" for="customFile">Choose file</label>

                                                </div>

                                            </div> -->





                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input type="submit" class="btn btn-primary" value="<?php if ($compaign) {
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

</body>

</html>

<?php echo $script; ?>