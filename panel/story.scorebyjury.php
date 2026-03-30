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

if(isset($_GET["juryid"]) && $_GET["juryid"] != ''){
    $JuryRow = $postObj->GetJuryById($_GET["juryid"]);

    $Stories = $postObj->GetEvaluatedStories($_GET["juryid"]);
    
}else{
    header('location: evaluated-stories.php');
}



$alert = "";


?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                <a href="evaluated-stories"><i class="fa fa-arrow-left"></i> back</a> 
                    <div class="card">
                        <div class="card-header">
                            <h4>Stories <?=$JuryRow['name'];?> has evaluated.</h4>
                            
                        </div>
                        <div class="card-body">
                            <?php
                            if ($Stories) {
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>  
                                                <th class="text-center">
                                                   Id
                                                </th>
                                                <th>Jury Name</th> 
                                                <th>Nominee</th> 
                                                <th>Story Title</th> 
                                                <th>Total Score</th> 
                                                <th> </th> 
                                                <th> </th> 
                                                <th> </th> 
                                                <th> </th>  
                                                <th> </th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($Stories as $Story) { 
                                $TotalScore = 0;
                    $GroupRow = $postObj->GetGroupById($JuryRow["groupid"]);
                    $StoryRow = $postObj->GetNomineeStoryDetailsByStoryId($Story["storyid"]);
                                ?>
                                    <tr>
                                        <td><?php echo $Story["id"] ?></td> 
                                        <td><?php echo $JuryRow["name"] ?></td>
                                        <td><?php echo $StoryRow["author"] ?></td> 
                                        <td>
                                            <a href="/wahspotlight/nominee/<?php echo $StoryRow["slug"] ?>" target="_blank">
                                                <?php echo $StoryRow["title"] ?>
                                            </a>
                                        </td> 
                        <?php $TotalScore = $Story["skill1"] + $Story["skill2"] + $Story["skill3"] + $Story["skill4"] + $Story["skill5"] + $Story["skill6"] + $Story["skill7"] + $Story["skill8"] + $Story["skill9"] + $Story["skill10"] + $Story["skill11"] + $Story["skill12"] + $Story["skill13"] + $Story["skill14"] + $Story["skill15"]; ?>
                                        <td><?=$TotalScore;?></td>
                                        <td> </td>
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