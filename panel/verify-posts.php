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


require_once("../db/userClass.php");
$obj = new User;

$posts = $obj->getUserPosts();
$alert = "";

if (isset($_SESSION["varify_post_res"])) {
    switch ($_SESSION["varify_post_res"]) {
        case "varified": {
                $alert = "<script>Swal.fire(
                    'Post Verified Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error_varify": {
                $script = "<script>Swal.fire(
                    'Error While Verifying Post!','',
                    'error'
                  )</script>";
                break;
            }
        case "Rejected": {
                $alert = "<script>Swal.fire(
                    'Post Rejected Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error_reject": {
                $script = "<script>Swal.fire(
                    'Error While Rejecting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["varify_post_res"]);
}

?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Verify Posts</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($posts) {
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Post id</th>
                                                <th>Post Date</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Post Category</th>
                                                <th>Post Image</th>
                                                <th>User ID</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 1;
                                            foreach ($posts as $post) { ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $i;
                                                        $i++; ?>
                                                    </td>
                                                    <td><?php echo $post["id"] ?></td>
                                                    <td><?php echo $post["date"] ?></td>
                                                    <td>
                                                        <?php echo $post["title"] ?>
                                                    </td>
                                                    <td><?php echo $post["author"] ?></td>
                                                    <td><?php echo $post["category"] ?></td>
                                                    <td>
                                                        <img src="../images/posts/<?php echo $post['img'] ?>" width="45">
                                                    </td>
                                                    <td><?php echo $post["userid"] ?></td>
                                                    <td>
                                                        <div class="badge badge-<?php if ($post["adminAction"] == "varified") {
                                                                                    echo "success";
                                                                                } elseif ($post["adminAction"] == "rejected") {
                                                                                    echo "danger";
                                                                                } elseif ($post["adminAction"] == "unvarified") {
                                                                                    echo "warning";
                                                                                } ?> badge-shadow"><?php if ($post["adminAction"] == "varified") {
                                                                                                        echo "Verified";
                                                                                                    } elseif ($post["adminAction"] == "rejected") {
                                                                                                        echo "Rejected";
                                                                                                    } elseif ($post["adminAction"] == "unvarified") {
                                                                                                        echo "Un-verified";
                                                                                                    } ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                            <div class="dropdown-menu">
                                                                <a href="update.php?id=<?php echo $post['id'] ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                                <?php if ($post["adminAction"] == "unvarified") { ?>
                                                                    <a onclick="acceptPost(<?php echo $post['id'] ?>)" class="dropdown-item has-icon text-success"><i class="fas fa-check-circle"></i>Accept</a>
                                                                    <a onclick="rejectPost(<?php echo $post['id'] ?>)" class="dropdown-item has-icon text-danger"><i class="fas fa-ban"></i>Reject</a>
                                                                <?php } elseif ($post["adminAction"] == "varified") { ?>
                                                                    <a onclick="rejectPost(<?php echo $post['id'] ?>)" class="dropdown-item has-icon text-danger"><i class="fas fa-ban"></i>Reject</a>
                                                                <?php } elseif ($post["adminAction"] == "rejected") { ?>
                                                                    <a onclick="acceptPost(<?php echo $post['id'] ?>)" class="dropdown-item has-icon text-success"><i class="fas fa-check-circle"></i>Accept</a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a target="_blank" href="../single.php?id=<?php echo $post["id"] ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a onclick="delPost(<?php echo $post['id'] ?>)" class="dropdown-item has-icon text-danger"><i class="fas fa-trash-alt"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                        <?php
                                            }
                                        } else {
                                            echo "<h1>No Posts</h1>";
                                        }
                        ?>
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
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/datatables.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<script>
    function acceptPost(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, accept it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/accept-post.php?id=" + id;
            }
        })
    }

    function rejectPost(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/reject-post.php?id=" + id;
            }
        })
    }

    function delPost(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/delete-post.php?id=" + id;
            }
        })
    }
</script>
<?php echo $alert ?>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</body>

</html>