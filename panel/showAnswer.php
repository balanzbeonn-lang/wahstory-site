<?php
if (empty($_GET["qid"]) || empty($_GET["id"])) {
    header("Location: viewQA.php");
}

require_once("../db/userClass.php");
require_once("../db/postClass.php");

$obj = new User;
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



$ques = json_decode($obj->getQuesById($_GET["qid"])["data"]);
$answerDetail = $postObj->getAnswerById($_GET["id"]);
$user = $postObj->getUserDetailsById($answerDetail["userID"]);
$ans = json_decode($answerDetail["data"]);

include_once("navBar.php");
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img src="images/users/user.png" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Total Posts</div>
                            <div class="profile-widget-item-value"><?php $posts = $obj->getUserCount("Posts", $answerDetail["userID"])["count"];
                                                                    if ($posts) {
                                                                        echo $posts;
                                                                    } else {
                                                                        echo "0";
                                                                    } ?></div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Total Likes</div>
                            <div class="profile-widget-item-value"><?php $Likes = $obj->getUserCount("Likes", $answerDetail["userID"])["count"];
                                                                    if ($Likes) {
                                                                        echo $Likes;
                                                                    } else {
                                                                        echo "0";
                                                                    } ?></div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Total Views</div>
                            <div class="profile-widget-item-value"><?php $Views = $obj->getUserCount("Views", $answerDetail["userID"])["count"];
                                                                    if ($posts) {
                                                                        echo $Views;
                                                                    } else {
                                                                        echo "0";
                                                                    } ?></div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description pb-0">
                    <div class="profile-widget-name mb-5"><?php echo $user["firstname"] . " " . $user["lastname"] ?>
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> <?php echo $user["email"]; ?>
                        </div>
                    </div>
                    <h1 class="mb-3"><?php echo $answerDetail["title"] ?></h1>
                    <?php
                    foreach (array_combine($ques, $ans) as $q => $a) {
                    ?>
                        <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                            <li class="media">
                                <div class="media-body ml-5">
                                    <div class="media-title mb-1"><span style='font-size:20px;'>&#9679;</span> <?php echo $q ?></div>
                                    <div class="media-description text-muted ml-3"><?php echo $a ?></div>
                                </div>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>
</body>

</html>