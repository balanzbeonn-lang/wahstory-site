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


$posts = $postObj->getAllSocialHealthUsers();

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
                            <h4>Social Health Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="total_likes">
                                    <thead>
                                        <tr align="center">
	                <th colspan="5">Personal Information</th>
	                <th colspan="2">Social Media Engagement</th>
	                <th colspan="2">Frequency and Content</th>
	                <th>Objectives of Social Media Engagement</th>
	                <th colspan="2">Impact and Perception</th>
	                
	                <th colspan="2">Time Management</th>
	                
	                <th colspan="2">Content Strategy</th>
	                
	                <th colspan="2">Engagement Metrics</th>
	                
	                <th colspan="2">Objectives and Target Audience</th>
	                <th colspan="2">Challenges and Improvement</th>
	                <th colspan="2">Influencer and Advertisements</th>
	                <th>Preferred Social Media Platform</th>
	                <th colspan="2">Self-Perception</th>
	                
	                <th>Overall Impact Assessment</th>
	                <th>Additional Comments</th>
	                
	                <th rowspan="2">Date</th> 
	            </tr>
	            <tr>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Phone</th>
	                <th>Occupation</th>
	                <th>Company</th>
	                
	                <th>Actively engage social</th>
	                <th>Social platforms</th>
	                <th>frequently interaction</th>
	                <th>Sharing content type</th>
	                <th>Primary objectives</th>
	                <th>Perceive the impact</th>
	                <th>Digital presence</th>
	                <th>Spends time on platform</th>
	                <th>Is time well spent</th>
	                <th>Content balance</th>
	                <th>Engage content type</th>
	                
	                <th>Monitor engagement</th>
	                <th>Incorporate engagement</th>
	                
	                <th>Important objective</th>
	                <th>Primary target audience </th>
	                
	                <th>Challenges you face</th>
	                <th>Areas of improvement </th>
	                
	                <th>Influencers follower </th>
	                <th>Purchase from influencer</th>
	                
	                <th>Preferred Platform  </th> 
	                
	                <th>Self-Perception  </th> 
	                <th>Compared activity</th> 
	                
	                <th>Overall digital presence</th> 
	                
	                <th>Additional Comments</th> 
	            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($posts) {
                                            $i = 1;
                                            foreach ($posts as $post) { ?>

                                                <tr>
	               <td><?=$post['name'];?></td>
	               <td><?=$post['email'];?></td>
	               <td><?=$post['phone'];?></td>
	               <td><?=$post['occupation'];?></td>
	               <td><?=$post['company'];?></td>
	               
	               <td><?=$post['professionalpurposes'];?></td>
	               <td><?=$post['social_platforms'];?></td>
	               <td><?=$post['interactwithplatform'];?></td>
	               <td><?=$post['content_type'];?></td>
	               <td><?=$post['primary_objectives'];?></td>
	               <td><?=$post['impactsocial_social_engagement'];?></td>
	               <td><?=$post['digital_presence'];?></td>
	               <td><?=$post['average_spend_time'];?></td>
	               <td><?=$post['is_time_well_spent'];?></td>
	               <td><?=$post['personal_professional_balance'];?></td>
	               <td><?=$post['content_type_engage'];?></td>
	               <td><?=$post['monitor_engagement_metrics'];?></td>
	               <td><?=$post['incorporate_engagement_metrics'];?></td>
	               <td><?=$post['important_social_objective'];?></td>
	               <td><?=$post['primary_target_audience'];?></td>
	               <td><?=$post['social_impact_challenges'];?></td>
	               <td><?=$post['areas_of_improvement'];?></td>
	               <td><?=$post['social_media_influencers'];?></td>
	               <td><?=$post['service_recommendation'];?></td>
	               <td><?=$post['prefered_social'];?></td>
	               <td><?=$post['self_esteem'];?></td>
	               <td><?=$post['compared_social_activity'];?></td>
	               <td><?=$post['overall_digital_presence'];?></td>
	               <td><?=$post['additional_comments'];?></td>
	               <td><?=$post['date'];?></td>
	               
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
<?php echo $script; ?>