<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../db/userClass.php");
$obj = new User;

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


$users = $obj->getUsers();
$alert = "";

if (isset($_SESSION["response_user"])) {
    switch ($_SESSION["response_user"]) {
        case "verified": {
                $alert = "<script>Swal.fire(
                    'User verified successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error_varify": {
                $script = "<script>Swal.fire(
                    'Error while verifying user!','',
                    'error'
                  )</script>";
                break;
            }
        case "unverified": {
                $alert = "<script>Swal.fire(
                    'User unverified successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error_unvarify": {
                $script = "<script>Swal.fire(
                    'Error while unverifying user!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["response_user"]);
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
                            <h4>Varify Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>User Name</th>
                                            <th>User Image</th>
                                            <th>User Email</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($users) {
                                            $i = 1;
                                            foreach ($users as $user) { ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $i;
                                                        $i++; ?>
                                                    </td>
                                                    <td><?php echo $user["name"]; ?></td>
                                                    <td>
                                                        <img src="images/users/user.png" width="45">
                                                    </td>
                                                    <td><?php echo $user["email"] ?></td>
                                                    
                                                    <td>
                                                        <div class="badge badge-<?php if ($user["verified"] == "true") {
                                                                                    echo "success";
                                                                                } else {
                                                                                    echo "danger";
                                                                                } ?> badge-shadow"><?php if ($user["verified"] == "true") {
                                                                                                        echo "Verified";
                                                                                                    } else {
                                                                                                        echo "Un-Verified";
                                                                                                    } ?></div>
                                                    </td>
                                                    <td><a href="<?php if ($user["verified"] == "true") {
                                                                        echo "actions/unverify.php?id=" . $user["id"];
                                                                    } else {
                                                                        echo "actions/verify.php?id=" . $user["id"];
                                                                    } ?>" class="btn btn-<?php if ($user["verified"] == "true") {
                                                                                                echo "danger";
                                                                                            } else {
                                                                                                echo "primary";
                                                                                            } ?>"><?php if ($user["verified"] == "true") {
                                                                                                        echo "Unverify";
                                                                                                    } else {
                                                                                                        echo "Verify";
                                                                                                    } ?></a></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<h1>No users</h1>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
<?php echo $alert ?>
</body>

</html>