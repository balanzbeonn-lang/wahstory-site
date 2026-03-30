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

 
$posts = $postObj->EarlyRegisteredWahclubUsers();


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
                            <h4>WAHClub - Registrations [<?=count($posts);?>]</h4>
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
                        	                <th>Profile Completed</th>
                        	                <th>Email</th>  
                        	                <th>Socials</th>
                        	                <th>Industry</th>
                        	                <th>Skills</th>
                        	                <th>Tools</th>
                        	                <th>Traits</th>
                        	                <th>Experience</th>
                        	                <th>Education</th>
                        	                <th>Project</th>
                        	                <th>Award</th>
                        	                <th>Testimonials</th>
                        	                <th>Blogs</th>
                        	                <th>Story</th> 
                        	            </tr>
	             
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($posts) { 
                                            $i = 1;
                                            foreach ($posts as $post) { ?>

<?php

$U_socialslinks = $U_industries = $U_skills = $U_tools = $U_Attributes = $U_Experiences = $U_edu = $U_proj = $U_awd = $U_testm = $U_blogs = $U_story = "No";


        $WAHCLUBUSER = $postObj->GetWAHClubUserByEmail($post['email']);
          
        $process = 0;
        
        if($WAHCLUBUSER !== FALSE){  
        
            if ($WAHCLUBUSER['title'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['firstname'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['lastname'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['photo'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['phone'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['email'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalexperience'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalproject'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalproject'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalawards'] != ''){
                $process += 4.34; 
            } 
        
        $usersocials = $postObj->GetWAHClubUserSocialsById($WAHCLUBUSER['id']);
        if($usersocials !== FALSE){  
            foreach ($usersocials as $usersocial) {
                $process += 2.17;
            }
            $U_socialslinks = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Userindustry = $postObj->GetWAHClubUserIndustryById($WAHCLUBUSER['id']);
        if($Userindustry !== FALSE){  
            $process += 4.34;  
            
            $U_industries = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Userskill = $postObj->GetWAHClubUserSkillById($WAHCLUBUSER['id']);
        if($Userskill !== FALSE){  
            $process += 4.34; 
            
            $U_skills = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Usertools = $postObj->GetWAHClubUserToolSById($WAHCLUBUSER['id']);
        if($Usertools !== FALSE){ 
            foreach ($Usertools as $Usertool) {
                $process += 0.27; 
            }
            $U_tools = '<span class="btn btn-success"> Yes </span>';
        }
        
        $UserAttributes = $postObj->GetUserAttributesById($WAHCLUBUSER['id']);
        if($UserAttributes !== FALSE){ 
            
            foreach ($UserAttributes as $UserAttribute) {
                $process += 2.17; 
            }
            $U_Attributes = '<span class="btn btn-success"> Yes </span>';
        }
         
        
        $UserExperiences = $postObj->GetUserExperienceSById($WAHCLUBUSER['id']);
        if($UserExperiences !== FALSE){
            foreach ($UserExperiences as $UserExperience) {
                $process += 1.44; 
            }
            $U_Experiences = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Usereducations = $postObj->GetUserEducationById($WAHCLUBUSER['id']);
        if($Usereducations !== FALSE){
            foreach ($Usereducations as $Usereducation) {
                $process += 1.44; 
            }
            $U_edu = '<span class="btn btn-success"> Yes </span>';
        }
        
        $UserProjects = $postObj->GetUserProjectsById($WAHCLUBUSER['id']);
        if($UserProjects !== FALSE){
            foreach ($UserProjects as $UserProject) {
                $process += 2.17; 
            }
            $U_proj = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Userawards = $postObj->GetUserAwardsById($WAHCLUBUSER['id']);
        if($Userawards !== FALSE){
            foreach ($Userawards as $Useraward) {
                $process += 2.17; 
            }
            $U_awd = '<span class="btn btn-success"> Yes </span>';
        }
        
        $testimonials = $postObj->GetUsertestimonialsById($WAHCLUBUSER['id']);
        if($testimonials !== FALSE){
            $process += 4.34;  
            
            $U_testm = '<span class="btn btn-success"> Yes </span>';
        }
        
        $Userblogs = $postObj->GetUserblogsById($WAHCLUBUSER['id']);
        if($Userblogs !== FALSE){
            $process += 4.34;  
            $U_blogs = '<span class="btn btn-success"> Yes </span>';
        }
        
        $ClubStory = $postObj->GetUserClubStoryById($WAHCLUBUSER['id']);
        if($ClubStory !== FALSE){
            $process += 8.68;  
            $U_story = '<span class="btn btn-success"> Yes </span>';
        }
        
        $ClubProfileprocess = round($process);
        if($ClubProfileprocess > 100 ){
            $ClubProfileprocess = 100;
        }
        
        }else{
            $ClubProfileprocess = 15;
        }
        
         ?>


                                    <tr>
                    	               <td><?=$i++;?></td>
                    	               <td><?php
                    	               if($post['registered_date']) {
                    	                   echo date("Y-m-d", strtotime($post['registered_date']));
                    	               }
                    	               
                    	               
                    	               ?></td> 
                    	               <td><?=$post['firstname'];?></td>
                    	               <td><?=$post['lastname'];?></td>
                    	               <td> <?=$ClubProfileprocess;?> %</td>
                    	               <td><?=$post['email'];?></td>   
                    	                   <td><?=$U_socialslinks;?></td> 
                    	                   <td><?=$U_industries;?></td> 
                    	                   <td><?=$U_skills;?></td> 
                    	                   <td><?=$U_tools;?></td> 
                    	                   <td><?=$U_Attributes;?></td> 
                    	                   <td><?=$U_Experiences;?></td> 
                    	                   <td><?=$U_edu;?></td> 
                    	                   <td><?=$U_proj;?></td> 
                    	                   <td><?=$U_awd;?></td> 
                    	                   <td><?=$U_testm;?></td> 
                    	                   <td><?=$U_blogs;?></td> 
                    	                   <td><?=$U_story;?></td>
                    	                   
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