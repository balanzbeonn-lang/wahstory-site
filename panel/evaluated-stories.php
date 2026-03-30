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

$posts = $postObj->GetEvaluatedStories(NULL);
$alert = "";


?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Evaluated Stories</h4>
                            
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
                                                   Id
                                                </th>
                                                <th>Group Name</th> 
                                                <th>Jury Name</th> 
                                                <th>Nominee</th> 
                                                <th>Category</th> 
                                                <th>Email</th> 
                                                <th>Phone</th> 
                                                <th>Sub Category</th> 
                                                <th>Story Title</th> 
                                                <th>Total Score</th> 
                                                <th> </th> 
                                                <th> </th> 
                                                <th> </th> 
                                                <th> </th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($posts as $post) { 
                                $TotalScore = 0;
                    $JuryRow = $postObj->GetJuryById($post["juryid"]);
                    $GroupRow = $postObj->GetGroupById($JuryRow["groupid"]);
                    $StoryRow = $postObj->GetNomineeStoryDetailsByStoryId($post["storyid"]);
                    $NomnyRow = $postObj->getNomineeById($StoryRow["nominationid"]);
                    
                                ?>
                                    <tr>
                                        <td><?php echo $post["id"] ?></td> 
                                        <td><a href="jury-members" target="_blank"><?php echo $GroupRow["groupname"];?></a></td> 
                                        <td><a href="story.scorebyjury.php?juryid=<?=$post["juryid"];?>"><?php echo $JuryRow["name"] ?></a></td> 
                                        <td><?php echo $StoryRow["author"] ?></td> 
                                        
                                        <td>
                                            <?=$NomnyRow['email'];?>
                                        </td>
                                        <td>
                                            <?=$NomnyRow['phone'];?>
                                        </td>
                                        
                                        <td>
                                            <?=$NomnyRow['category'];?>
                                        </td>
                                        <td>
                                            <?=$NomnyRow['subcategory'];?>
                                        </td>
                                        
                                        <td>
                                            <a href="/wahspotlight/nominee/<?php echo $StoryRow["slug"] ?>" target="_blank">
                                                <?php echo $StoryRow["title"] ?>
                                            </a>
                                        </td> 
                        <?php $TotalScore = $post["skill1"] + $post["skill2"] + $post["skill3"] + $post["skill4"] + $post["skill5"] + $post["skill6"] + $post["skill7"] + $post["skill8"] + $post["skill9"] + $post["skill10"] + $post["skill11"] + $post["skill12"] + $post["skill13"] + $post["skill14"] + $post["skill15"]; ?>
                                        <td><?=$TotalScore;?></td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td> 
                                    </tr>
                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                      
                        <?php
                            } else {
                                echo "<h1>No Request Found</h1>";
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

<?php echo $alert ?>
 
 
</body>

</html>