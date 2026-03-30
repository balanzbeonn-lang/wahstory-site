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

$posts = $postObj->GetAllUnallocatedStories();
$alert = "";


?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
<?php if(isset($_GET['message']) && $_GET['message'] === "SUCCESS") { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Stories Allocated Successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php } ?>

                    <div class="card">
                        <div class="card-header">
                            <h4>All Unallocated Stories</h4>
                            
                        </div>
                        <div class="card-body">
                            <?php
                            if ($posts) {
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1111">
                                        <thead>
                                            <tr>
                                                <th></th> 
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Name</th> 
                                                <th>Title</th> 
                                                <th> </th> 
                                                <th> </th> 
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
                                        <td></td> 
                                        <td><?php echo $post["id"] ?></td> 
                                        <td><?php echo $post["author"] ?></td> 
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
                                        <td> </td>
                                    </tr>
                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                        <hr>
                        
                        <select name="Jurygroup" id="Jurygroup" class="form-control" required>
                            <option value="">Select Group</option>
                <?php 
                    $groupSql = $postObj->GetAllJuryGroups();
                    foreach($groupSql as $groupRow) {
                ?>
                            <option value="<?=$groupRow['id']?>">Group <?=$groupRow['groupname']?> 
                            (<?php 
                             $JurySql = $postObj->GetJuryByGroupId($groupRow['id']);
                        if($JurySql != '' && $JurySql != NULL){ 
                            foreach($JurySql as $JuryRow){ 
                            
                            echo $JuryRow["name"].", "; }} ?>) 
                            </option>
                <?php } ?>
                        </select>
                        
                        
                        <button id="submitSelectedRows" class="btn btn-primary mt-4">Allocated Stories In Group</button>
                                
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
 
<script>
$(document).ready(function() {
    var table = $('#table-1111').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']]
    });

    $('#submitSelectedRows').on('click', function() {
        var selectedRowsData = table.rows({ selected: true }).data().toArray();
        
        var userIds = selectedRowsData.map(row => row[1]);
        
        var Jurygroup = $('#Jurygroup').val();
    
    if(Jurygroup !== '' && selectedRowsData.length > 0){
        var postData = {
            selectedRowsData: userIds,
            Jurygroup: Jurygroup
        };
         
        $.ajax({
            url: 'allocatedstories.fun.php',
            method: 'POST',
            data: postData,
            success: function(response) {
                
                if(response === "Success"){
                    window.location.href = window.location.pathname + "?message=SUCCESS&group="+Jurygroup;
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle error
            }
        });
        
    }else{
        alert("Please Select Group and Rows Both");
    }; //End If    
        
    });
});
</script>
 
 
</body>

</html>