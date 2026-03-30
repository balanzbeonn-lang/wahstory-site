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

$cats = $postObj->getCats();
?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="card">
            <form method="POST" action="actions/addCat" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category Name</label>
                        <div class="col-sm-12 col-md-7">
                            <input name="name" type="text" class="form-control" required>
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
            <?php if ($cats) {
                foreach ($cats as $cat) {
            ?>
                    <div class="col-md-4">
                        <div class="card">
                            <form method="POST" action="actions/updateCat" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Category</label>
                                        <div class="col-sm-12 col-md-8">
                                            <input name="name" value="<?php echo $cat["name"] ?>" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <input type="text" value="<?php echo $cat['id']; ?>" hidden name="id">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4"></label>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="submit" class="btn btn-primary" value="Update"></input>
                                            <a style="cursor: pointer;color:white" onclick="delCat(<?php echo $cat['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
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
            function delCat(id) {
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
                        window.location.href = "actions/delCat.php?id=" + id;
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

<?php
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>
</body>

</html>