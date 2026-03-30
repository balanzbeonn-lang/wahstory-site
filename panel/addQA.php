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


$script = "";

if (isset($_SESSION["updateQuestions"])) {
    switch ($_SESSION["updateQuestions"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Questions Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Updating Questions!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["updateQuestions"]);
}

if (isset($_SESSION["addQuestions"])) {
    switch ($_SESSION["addQuestions"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Questions Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Adding Questions!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["addQuestions"]);
}

if (isset($_SESSION["delQuestions"])) {
    switch ($_SESSION["delQuestions"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Questions Deleted Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Deleting Questions!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["delQuestions"]);
}



include_once("navBar.php");
?>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="actions/addQA" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Add Questions</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#general" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="general">
                                        <div id="fieldgroup" class="card-body">
                                            <div class="form-group">
                                                <div class="input-group col-md-4">
                                                    <label class="col-form-label">Title </label>
                                                    <input type="text" required class="form-control" name="title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control" name="questions[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group-append">
                                                <button onclick="addField()" class="btn btn-primary" type="button">Add More</button>
                                                <input type="submit" class="btn btn-primary ml-5" value="Publish"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>






                <?php
                $questions = $postObj->getQA();
                if ($questions) {
                    foreach ($questions as $question) {
                ?>
                        <div class="row col-12 col-md-12 col-lg-12">
                            <div class="card-body">
                                <form method="POST" action="actions/updateQuestion" enctype="multipart/form-data">
                                    <div class="card card-primary" id="<?php echo $question["id"] . '_head' ?>">
                                        <div class="card-header">
                                            <h4 id="title"><?php echo $question["title"] ?> </h4>
                                            <h4 id="edit_title" style="display: none">Title : <input required type="text" class="form-control" name="title" value="<?php echo $question['title'] ?>"></h4>
                                            <div class="card-header-action">
                                                <a data-collapse="#<?php echo $question["id"] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                            </div>
                                        </div>
                                        <div class="collapse show" id="<?php echo $question["id"] ?>">
                                            <div id="fieldgroup" class="card-body">
                                                <?php
                                                foreach (json_decode($question["data"]) as $data) {
                                                ?>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input required type="text" class="form-control" disabled name="questions[]" value="<?php echo $data ?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <input name="id" value="<?php echo $question["id"] ?>" hidden>
                                            </div>
                                            <div class="card-footer">
                                                <div class="input-group-append">
                                                    <button id="edit_btn" onclick="edit(<?php echo $question['id'] ?>)" class="btn btn-warning" type="button">Edit</button>
                                                    <button hidden id="dontEdit_btn" onclick="dontEdit(<?php echo $question['id'] ?>)" class="btn btn-warning" type="button">Don't Edit</button>
                                                    <button onclick="del(<?php echo $question['id'] ?>)" class="btn btn-danger ml-3" type="button">Delete</button>
                                                    <input disabled id="update" type="submit" class="btn btn-primary ml-3" value="Update"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <script>
                function edit(id) {
                    $('#' + id).find('input').removeAttr('disabled');
                    $('#' + id).find('update').attr('disabled', false);
                    $('#' + id).find('#dontEdit_btn').removeAttr('hidden');
                    $('#' + id).find('#edit_btn').attr('hidden', true);
                    $('#' + id + '_head').find('#title').css("display", "none");
                    $('#' + id + '_head').find('#edit_title').css("display", "block");
                }

                function dontEdit(id) {
                    $('#' + id).find('input').attr('disabled', true);
                    $('#' + id).find('update').attr('disabled', true);
                    $('#' + id).find('#edit_btn').attr('hidden', false);
                    $('#' + id).find('#dontEdit_btn').attr('hidden', true);
                    $('#' + id + '_head').find('#title').css("display", "block");
                    $('#' + id + '_head').find('#edit_title').css("display", "none");
                }

                function addField() {
                    let div = '<div class="form-group"><div class="input-group"><input required type="text" class="form-control" name="questions[]"></div></div>';
                    $('#general').find('#fieldgroup').append(div);
                }

                function del(id) {
                    window.location.assign("actions/delQA.php?id=" + id);
                }
            </script>
        </section>
    </div>
    </div>
    </div>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="assets/bundles/codemirror/lib/codemirror.js"></script>
    <script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="assets/bundles/ckeditor/ckeditor.js"></script>
    <script src="assets/js/page/ckeditor.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/page/create-post.js"></script>
    <?php echo $script; ?>
</body>

</html>