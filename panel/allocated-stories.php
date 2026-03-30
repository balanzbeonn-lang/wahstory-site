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

$posts = $postObj->GetAllAllocatedStories();
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
                            <h4>All Allocated Stories</h4>
                            
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
                                                   S.No
                                                </th>
                                               <!-- <th class="text-center">
                                                   Id
                                                </th>-->
                                                <th>Group Id</th> 
                                                <th>Group Members Name</th> 
                                                <th>Name</th> 
                                                <th>Email</th> 
                                                <th>Phone</th> 
                                                <th>Category</th> 
                                                <th>Sub Category</th> 
                                                <th>Title</th> 
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
                                foreach ($posts as $post) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td> 
                                        <!--<td><?php echo $post["id"] ?></td> -->
                                        <td><?php echo $post["jurygroupid"] ?> 
                                        </td> 
                                        <td>
            <?php 
                $JurySql = $postObj->GetJuryByGroupId($post["jurygroupid"]);
                    if($JurySql != '' && $JurySql != NULL){ 
                        foreach($JurySql as $JuryRow){
                            echo $JuryRow["name"].", "; 
                        }
                    }
                    
                    $NomnyRow = $postObj->getNomineeById($post["nominationid"]);
            ?>
                                        </td>
                                        <td><?php echo $post["author"] ?></td>
                                        
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
                                            <a href="/wahspotlight/nominee/<?php echo $post["slug"] ?>" target="_blank">
                                                <?php echo $post["title"] ?>
                                            </a>
                                        </td>
                                        <td> </td>
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