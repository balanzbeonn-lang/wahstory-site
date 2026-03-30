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

$posts = $postObj->getAllNominattionInvitations();
 
?>
<?php include_once("navBar.php") ?>
<div class="main-content">

    <script>
        console.log('<?= $url; ?>');
    </script>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <h3> 
                        Nomination Invitations
                    </h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                         
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
                                                <th>Invitee Name</th>
                                                <th>Invitee Email</th>
                                                <th>Invitee Phone</th> 
                                                <th>Nominee Name</th>
                                                <th>Nominee Email</th>
                                                <th>Nominee Phone</th> 
                                                <th>Nominee Social ID</th> 
                                                <th>Date</th>
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
                                <td><?php echo $post["name"] ?></td>
                                <td><?php echo $post["email"] ?></td>
                                <td>
                                    <?php echo $post["phone"] ?>
                                </td>
                                <td><?php echo $post["nominee_name"] ?></td>
                                <td><?php echo $post["nominee_email"] ?></td>
                                <td>
                                    <?php echo $post["nominee_phone"] ?>
                                </td>
                                <td>
                                    <?php echo $post["nominee_social"] ?>
                                </td>
                                <td>
                                    <?php echo date("d  M, Y", strtotime($post["datetime"])); ?>
                                </td>
                                                     
                                                </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                        <?php
                                            
                                        } else {
                                            echo "<h5>No Record Available</h5>";
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
<script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>

</html>
<?php echo $script; ?>
  