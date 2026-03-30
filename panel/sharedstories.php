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

$posts = $postObj->shareastory();
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
                            <h4>Shared Stories</h4>
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
                                                <th>Phone</th>
                                                <th>Company</th>
                                                <th>Designation</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Social Id</th>
                                                <th>Category</th>
                                                <th>Questions 1 </th>
                                                <th>Questions 2 </th>
                                                <th>Questions 3 </th>
                                                <th>Questions 4 </th>
                                                <th>Questions 5 </th>
                                                <th>Questions 6 </th>
                                                <th>Source</th>
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
                                                    <td><?php echo $post["company"] ?></td>
                                                    
                                                    <td><?php echo $post["designation"] ?></td>
                                                    
                                                    <td><?php echo $post["country"] ?></td>
                                                    <td><?php echo $post["city"] ?></td>
                                                    <td><?php echo $post["socialid"] ?></td>
                                                    
                                                    <td><?php echo $post["category"] ?></td>
                                                    
                                                    <td>
                                        <strong>Question 1</strong> <br>
                                                        <?php echo $post["ques1"] ?>
                                        </td>
                                         <td>
                                        <strong>Question 2</strong> <br>                
                                                        <?php echo $post["ques2"] ?> 
                                                        
                                          </td>
                                           <td>
                                        <strong>Question 3</strong> <br>                
                                                        <?php echo $post["ques3"] ?> 
                                                        
                                          </td>
                                           <td>
                                        <strong>Question 4</strong> <br>                
                                                        <?php echo $post["ques4"] ?>     
                                         </td>
                                          <td>
                                        <strong>Question 5</strong> <br>                
                                                        <?php echo $post["ques5"] ?> 
                                                        
                                          </td>
                                           <td>
                                        <strong>Question 6</strong> <br>                
                                                        <?php echo $post["ques6"] ?></td>
                                                        <td>
                                                        
                                                        <?php echo $post["hearsource"] ?></td>
                                                        
                                                        <td>
                                                        
                                                        <?php echo $post["date"] ?></td>
                                                    
                                                    
                                                    
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
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</body>

</html>