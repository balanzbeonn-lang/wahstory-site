<?php
require_once("../db/postClass.php");
require_once("../db/userClass.php");
$postObj = new Post();
$userObj = new User();

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
                'Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Updating Product!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["updateQuestions"]);
}

if (isset($_SESSION["addTestimonial"])) {
    switch ($_SESSION["addTestimonial"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Testimonial Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Adding Testimonial!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["addTestimonial"]);
}

if (isset($_SESSION["delQuestions"])) {
    switch ($_SESSION["delQuestions"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Testimonial Deleted Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Deleting Testimonial!','',
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
                <?php
                $questions = $postObj->getQA();
                if ($questions) {
                    foreach ($questions as $question) {
                ?>
                        <div class="row col-12 col-md-12 col-lg-12">
                            <div class="card-body">
                                    <div class="card card-primary" id="<?php echo $question["id"] . '_head' ?>">
                                        <div class="card-header">
                                            <h4 id="title"><?php echo $question["title"] ?> </h4>

                                            <div class="card-header-action">
                                                <a data-collapse="#<?php echo $question["id"] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                            </div>
                                        </div>
                                        <div class="collapse show" id="<?php echo $question["id"] ?>">
                                            <div id="fieldgroup" class="card-body">
                                                <div class="card-body">
                                                    <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                                        <?php
                                                        $answers = $postObj->getAnswers($question["id"]);
                                                        if ($answers) {
                                                            foreach ($answers as $answer) {
                                                                $user = $postObj->getUserDetailsById($answer["userID"]);
                                                        ?>
                                                                <li class="media">
                                                                    <img class="mr-3 rounded-circle" width="50" src="images/users/user.png">
                                                                    <div class="media-body col-md-4">
                                                                        <div class="media-title"><?php echo $user["firstname"] . " " . $user["lastname"] ?></div>
                                                                        <div class="text-job text-muted"><?php echo $user["email"] ?></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <?php echo $answer["date"] ?>
                                                                    </div>
                                                                    <div class="media-cta">
                                                                        <a href="showAnswer.php?id=<?php echo $answer["id"] ?>&qid=<?php echo $question["id"] ?>" class="btn btn-outline-primary">Show Answer</a>
                                                                    </div>
                                                                </li>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <h1 class="text-center">No answers yet.</h1>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <h1 class="text-center">No Questions yet</h1>
                    <h2 class="text-center">Add some Questions in 'Add an item' section</h2>
                <?php } ?>
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
                    window.location.assign("delTestimonial.php?id=" + id);
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