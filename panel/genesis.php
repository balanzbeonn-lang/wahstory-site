<?php
require_once("../db/postClass.php");
$postObj = new Post();
$alert = "";
if (!$postObj->adminCheck()) {
    $_SESSION["session_expire"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: logout');
}

$genesis = $postObj->getGenesis();
include_once("navBar.php");
?>

<div class="main-content">
    <section class="section">
        <form method="POST" action="actions/<?php if ($genesis) echo "update_genesis";
                                            else echo "add_genesis"; ?>" enctype="multipart/form-data">
            <div class="card-header">
                <h4>Enter Genesis Details</h4>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                <div class="col-sm-12 col-md-7">
                    <input value="<?php if ($genesis) echo $genesis["val1"] ?>" name="title" type="text" class="form-control" <?php if (!$genesis) echo "required"; ?>>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 1 :</label>
                <div class="col-sm-12 col-md-7">
                    <textarea name="content1" class="summernote" <?php if (!$genesis) echo "required"; ?>>
                    <?php if ($genesis) echo $genesis["val3"] ?>
            </textarea>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>
                <div class="col-sm-12 col-md-7">
                    <input value="<?php if ($genesis) echo $genesis["val2"] ?>" name="quote" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 2 :</label>
                <div class="col-sm-12 col-md-7">
                    <textarea name="content2" class="summernote" <?php if (!$genesis) echo "required"; ?>>
                    <?php if ($genesis) echo $genesis["val4"] ?>
            </textarea>
                </div>
            </div>
            <?php
            if ($genesis["img"]) :
            ?>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image :</label>
                    <div class="col-sm-12 col-md-7">
                        <img width="100%" src="../images/extras/<?php echo $genesis["img"]; ?>" alt="">
                        <input hidden value="<?php echo $genesis["id"]; ?>" name="id">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                <div class="col-sm-12 col-md-7">
                    <div id="image-preview-3" class="image-preview">
                        <label for="image-upload-3" id="image-label-3">Choose File</label>
                        <input type="file" accept="image/*" name="image" id="image-upload-3" <?php if (!$genesis) echo "required"; ?> />
                    </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                    <input type="submit" class="btn btn-primary" value="<?php if ($genesis) echo "Update";
                                                                        else echo "Submit"; ?>"></input>
                </div>
            </div>
        </form>
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
<?php echo $alert ?>
<?php
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>
</body>

</html>