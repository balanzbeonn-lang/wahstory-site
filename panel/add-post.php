<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once("../db/postClass.php");
$postObj = new Post;

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["response"]  = $postObj->addPost();
}



if (isset($_SESSION["response"])) {

    switch ($_SESSION["response"]) {

        case "Success": {

                $script = "<script>Swal.fire(

                'Post added seccussfully!','',

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

<!-- Main Content -->

<div class="main-content">

    <section class="section">

        <div class="section-body">



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <form method="POST" enctype="multipart/form-data">

                            <div class="card-header">

                                <h4>Enter Post Details</h4>

                            </div>

                            <div class="card-body">


                        <p class="mb-0">Personal Details</p>
                        <hr class="mt-0">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Name *    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="phone" type="tel" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email *</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="email" type="email" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gender</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="gender" class="form-control selectric"> 
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                            <option value="prefer_not_to_say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="city" type="text" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Country</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="country" type="text" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">LinkedIn</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="linkedin" type="url" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Instagram</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="instagram" type="url" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bio</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="bio" class="form-control"></textarea>
                                    </div>
                                </div>
                        
                        <p class="mb-0">Story Details</p>
                        <hr class="mt-0">

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="title" type="text" class="form-control" required>

                                    </div>

                                </div>



                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="author" type="text" class="form-control" required>

                                    </div>

                                </div>





                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>

                                    <div class="col-sm-12 col-md-7">

                                        <select class="form-control selectric" name="cat" required>
                                            <?php foreach ($postObj->getCats() as $cat) : ?>
                                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="quote" type="text" class="form-control">

                                    </div>

                                </div>
                                
                             <div class="form-group row mb-4">

                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meta Description</label>

                                <div class="col-sm-12 col-md-7">

                                    <input name="metadescription" type="text" class="form-control">

                                </div>

                            </div>
                        <div class="form-group row mb-4">

                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meta Keywords</label>

                                <div class="col-sm-12 col-md-7">

                                    <input name="metakeywords" type="text" class="form-control">

                                </div>

                            </div>


                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>

                                    <div class="col-sm-12 col-md-7">

                                        <textarea name="content" class="summernote" required></textarea>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post image</label>

                                    <div class="col-sm-12 col-md-7">

                                        <div id="image-preview" class="image-preview">

                                            <label for="image-upload" id="image-label">Choose File</label>

                                            <input type="file" name="image" accept="image/*" id="image-upload" required />

                                        </div>

                                    </div>

                                </div>
                                <!-- 
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post image</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="image" accept="image/*" type="file" class="custom-file-input" id="customFile" required>

                                        <label class="custom-file-label" for="customFile">Choose file</label>

                                    </div>

                                </div> -->

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Video</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="video" accept="video/*" type="file" class="custom-file-input" id="customFile">

                                        <label class="custom-file-label" for="customFile">Choose file</label>

                                    </div>

                                </div>

                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Audio</label>

                                    <div class="custom-file col-sm-12 col-md-7">

                                        <input name="audio" accept="audio/*" type="file" class="custom-file-input" id="customFile2">

                                        <label class="custom-file-label" for="customFile2">Choose file</label>

                                    </div>

                                </div>





                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input type="submit" class="btn btn-primary" value="Publish"></input>

                                    </div>

                                </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



</div>

</section>
>

</div>

</div>

</div>

<!-- General JS Scripts -->

<script src="assets/js/app.min.js"></script>

<!-- JS Libraies -->

<script src="assets/bundles/summernote/summernote-bs4.js"></script>

<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

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