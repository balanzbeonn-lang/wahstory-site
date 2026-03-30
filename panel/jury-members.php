<?php
require_once("../db/postClass.php");
$postObj = new Post();


ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$postObj->adminCheck()) {
    $_SESSION["session_expire"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: logout');
}

$posts = $postObj->GetAllJuryMembers();
$alert = "";


if(isset($_POST['ADDNEWMEMBER'])){
    $response = $postObj->AddJuryMember();
}

if(isset($_POST['CREATEGROUP'])){
    $response = $postObj->CreateJuryGroup();
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
                            <h4>Jury Members <?php if(isset($response) && $response != ''){ echo $response;} ?></h4>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                <th>Linked In</th>
                                                <th>Evaluated Stories</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($posts as $post) { 
                    $GroupRow = $postObj->GetGroupById($post["groupid"]);
                                ?>
                                    <tr>
                                        <td><?php echo $i; 
                                        $i++; ?></td>
                                        <td><?php echo $post["name"]; ?></td>
                                        <td><?php echo $post["email"]; ?></td>
                                        <td><?php echo $GroupRow["groupname"]; ?></td>
                                        <td><?php echo $post["linkedin"]; ?></td>
                                        
        <?php 
            $EvaluatedStoriesSql = $postObj->GetEvaluatedStoriesByGroupId($post["groupid"], $post["id"]);
            if($EvaluatedStoriesSql != NULL){ 
                $ecount = COUNT($EvaluatedStoriesSql);
            }else{ 
                $ecount = 0;
            }
        ?>
                                        <td> <?=$ecount?></td>
                                        
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
            
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add New Jury Member</h4>
                        </div>
                        <div class="card-body">
                             
                        <form method="post" action="" enctype="multipart/form-data">
                            
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter Member Name*" required>
                            </div>
                            
                          </div>
                          
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter Member Email*" required>
                            </div>
                            
                          </div>
                          
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Create a  Password*" required>
                            </div>
                            
                          </div>
                          
                          <div class="col-lg-6 col-md-12">
                              
                            <div class="form-group">
                                <select name="Jurygroup" id="Jurygroup" class="form-control" required>
                                    <option value="">Select Group</option>
                    <?php 
                        $JuryGroupSql = $postObj->GetAllJuryGroups();
                        foreach($JuryGroupSql as $JuryGroupRow){
                    ?>
                                    <option value="<?=$JuryGroupRow['id']?>">Group <?=$JuryGroupRow['groupname']?></option>
                    <?php } ?> 
                                </select>
                            </div>
                            
                          </div>
                          
                          <div class="col-lg-12 col-md-12">
                              
                            <div class="form-group">
                                <input type="text" name="linkedin" class="form-control" placeholder="Enter Linked In*" required>
                            </div>
                            
                          </div>
                          
                          <div class="col-lg-12">
                            
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Post image</label>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" accept="image/*" id="image-upload" required />
                                    </div>
                                </div>
                            </div> 
                            
                          </div>
                          
                          
                          <div class="col-lg-12 text-center">
                          
                          <div class="form-group">
                                <input type="submit" name="ADDNEWMEMBER" class="btn btn-primary" value="ADD MEMBER NOW">
                            </div>
                          
                          </div>
                          
                          
                          </div>
                            
                        </form>
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jury Groups</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $posts = $postObj->GetAllJuryGroups();
                            if ($posts) {
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    S. No.
                                                </th>
                                                <th>Group Name</th>
                                                <th>Group Members</th>
                                                <th>Allocated Stories</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($posts as $post) {
                                
                                ?>
                                    <tr>
                                        <td><?php echo $i; 
                                        $i++; ?></td>
                                        <td><?php echo $post["groupname"]; ?></td>
                                        <td>
                                            
                            (<?php 
                             $JurySql = $postObj->GetJuryByGroupId($post['id']);
                        if($JurySql != '' && $JurySql != NULL){ 
                       
                            foreach($JurySql as $JuryRow){ 
                            
                            echo $JuryRow["name"].", "; }} ?>)
                            
                                        </td>
                                        
            <?php 
                $AllocatedSql = $postObj->GetCountallocatedStoriesByGroup($post['id']); 
            ?>
                                        <td> <?=$AllocatedSql['allocatedcount']?> </td>
                                        
                                        
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
                
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create a New Group</h4>
                        </div>
                        <div class="card-body">
                             
                        <form method="post" action="">
                            
                             
                            
                            <div class="form-group">
                                <input type="text" name="groupname" class="form-control" placeholder="Enter Group Name*" required>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="CREATEGROUP" class="btn btn-primary" value="CREATE NOW">
                            </div>
                            
                            
                        </form>
                        
                        
                        
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