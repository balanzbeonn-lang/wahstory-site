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


$posts = $postObj->getAllPreRegistrationsWahClub();

?>


<?php include_once("navBar.php") ?>

<!-- Main Content -->

<div class="main-content">

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>WAHClub - Pre Registrations [<?=count($posts);?>]</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-striped" id="total_likes">
                                    <thead>
                                        <tr> 
	                
                        	                <th>S. No. </th>
                        	                <th>Date</th> 
                        	                <th>First Name</th>
                        	                <th>Last Name</th>
                        	                <th>Email</th>
                        	                <th>Phone</th>
                        	                <th>Social</th> 
                        	            </tr>
	             
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($posts) { 
                                            $i = 1;
                                            foreach ($posts as $post) { ?>

                                    <tr>
                    	               <td><?=$i++;?></td>
                    	               <td><?=$post['date'];?></td> 
                    	               <td><?=$post['firstname'];?></td>
                    	               <td><?=$post['lastname'];?></td>
                    	               <td><?=$post['email'];?></td>
                    	               <td><?=$post['phone'];?></td>
                    	               <td>
                    	                   <a href="<?=$post['socialprofile'];?>" target="_blank"><?=$post['socialprofile'];?></a>
                    	                   
                    	                   </td> 
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
</body>

</html>
<?php echo $script; ?>