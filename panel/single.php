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


$alert = "";
?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <?php
        $reactions = $postObj->getSingleReactions();
        ?>
        <div class="card">
            <form method="POST" action="actions/addReaction" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Add Reaction</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Reaction</label>
                        <div class="col-sm-12 col-md-7">
                            <input name="reaction" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>

                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview-4" class="image-preview">
                                <label for="image-upload-4" id="image-label-4">Choose File</label>
                                <input type="file" accept="image/*" name="image" id="image-upload-4" required />
                            </div>
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
        <div class="row">
            <?php if ($reactions) {
                foreach ($reactions as $reaction) {
            ?>
                    <div class="col-md-4">
                        <div class="card">
                            <form method="POST" action="actions/updateReaction" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Reaction</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input name="reaction" value="<?php echo $reaction["reaction"] ?>" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                                        <div class="col-sm-12 col-md-5">
                                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                                <div class="col-md-8">
                                                    <a href="../images/reactions/<?php echo $reaction["img"] ?>" data-sub-html="Demo Description">
                                                        <img class="img-responsive thumbnail" src="../images/reactions/<?php echo $reaction["img"] ?>" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                            <div id="image-preview-2" class="image-preview col-sm-12 col-md-6">
                                                <label for="image-upload-2" id="image-label-2">Choose File</label>
                                                <input type="file" accept="image/*" name="image" id="image-upload-3" />
                                            </div>
                                    </div>

                                    <input type="text" value="<?php echo $reaction['id']; ?>" hidden name="id">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="submit" class="btn btn-primary" value="Update"></input>
                                            <a style="cursor: pointer;color:white" onclick="delReaction(<?php echo $reaction['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
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
        <script>
            function delReaction(id) {
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
                        window.location.href = "actions/delReaction.php?id=" + id;
                    }
                })
            }
        </script>
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