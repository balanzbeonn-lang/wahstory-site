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


if (empty($_GET["id"])) {
    header("Location: home.php");
} else {
    $post = $postObj->getPostById($_GET["id"]);
}

$script = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["response"]  = $postObj->updatePost($_GET["id"]);
    header('Location: update-post.php');
}
?>


<?php include_once("navBar.php") ?>

<!-- Main Content -->

<div class="main-content">

    <section class="section">

        <div class="section-body">



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <form id="mainForm" method="POST" enctype="multipart/form-data">

                            <div class="card-header">

                                <h4>Update Post Details</h4>

                            </div>

                            <div class="card-body">

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="title" type="text" class="form-control" required value="<?php echo $post['title'] ?>">

                                    </div>

                                </div>



                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="author" type="text" class="form-control" value="<?php echo $post['author'] ?>" required>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>

                                    <div class="col-sm-12 col-md-7">

                                        <select id="cat" class="form-control selectric" name="cat" required>
                                            <?php foreach ($postObj->getCats() as $cat) : ?>
                                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <script>
                                            $('#cat').val("<?php echo $post['category'] ?>");
                                        </script>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="quote" type="text" class="form-control" value='<?php echo $post["quote"]; ?>'>

                                    </div>

                                </div>

                            <div class="form-group row mb-4">

                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meta Description</label>

                                <div class="col-sm-12 col-md-7">

                                    <input name="metadescription" type="text" class="form-control" value="<?php echo $post["metadescription"]; ?>">

                                </div>

                            </div>
                        <div class="form-group row mb-4">

                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meta Keywords</label>

                                <div class="col-sm-12 col-md-7">

                                    <input name="metakeywords" type="text" class="form-control" value="<?php echo $post["metakeywords"]; ?>">

                                </div>

                            </div>
                            
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>

                                    <div class="col-sm-12 col-md-7">

                                        <textarea name="content" class="summernote" required><?php echo $post['content'] ?></textarea>

                                    </div>

                                </div>



                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post image</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="image" accept="image/*" type="file" class="custom-file-input" id="customFile">

                                        <label class="custom-file-label" for="customFile">Choose file</label>

                                    </div>

                                </div>





                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input type="submit" class="btn btn-primary" value="Update"></input>

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

<!-- Page Specific JS File -->

<script src="assets/js/page/ckeditor.js"></script>

<!-- Template JS File -->

<script src="assets/js/scripts.js"></script>

<!-- Custom JS File -->

<script src="assets/js/custom.js"></script>

</body>

</html>

<?php echo $script; ?>