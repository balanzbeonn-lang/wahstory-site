<?php
require_once("../../db/postClass.php");
$obj = new Post;
$posts = $obj->getAllPosts();


?>
<?php include_once("navBar.php") ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Posts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Post id</th>
                                            <th>Post Date</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Post Category</th>
                                            <th>Post Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($posts) {
                                            $i = 1;
                                            foreach ($posts as $post) { ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $i;
                                                        $i++; ?>
                                                    </td>
                                                    <td><?php echo $post["id"] ?></td>
                                                    <td><?php echo $post["date"] ?></td>
                                                    <td>
                                                        <?php echo $post["title"] ?>
                                                    </td>
                                                    <td><?php echo $post["author"] ?></td>
                                                    <td><?php echo $post["category"] ?></td>
                                                    <td>
                                                        <img src="../../images/posts/<?php echo $post['img'] ?>" width="45">
                                                    </td>
                                                    <td>
                                                        <a target="_blank" href="../../single.php?id=<?php echo $post["id"] ?>" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
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
<script src="../assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="../assets/bundles/datatables/datatables.min.js"></script>
<script src="../assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="../assets/js/page/datatables.js"></script>
<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="../assets/js/custom.js"></script>
<?php echo $alert ?>
</body>

</html>