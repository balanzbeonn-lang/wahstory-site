<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("../db/postClass.php");
$postObj = new Post();
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

$NewsSQL = $postObj->getAllNews();

$alert = "";
 
if (isset($_SESSION["boost"])) {
    switch ($_SESSION["boost"]) {
        case "Success": {
                $alert = "<script>Swal.fire(
                    'Post Boosted Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                    'Error While Boosting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["boost"]);
}

if (isset($_SESSION["unboost"])) {
    switch ($_SESSION["unboost"]) {
        case "Success": {
                $alert = "<script>Swal.fire(
                    'Post Un-Boosted Successfully!','',
                    'success'
                  )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                    'Error While Un-Boosting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    unset($_SESSION["unboost"]);
}


?>
<?php include_once("navBar.php") ?>

<!-- Main Content -->
<div class="main-content">
    <section>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All News</h4>
                        <div class="card-header-action">
                            <a data-collapse="#top-posts" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="top-posts">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th> 
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Post Time</th>
                                            <th>Boost Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($NewsSQL) {
                                            $i = 1;
                                            foreach ($NewsSQL as $News) {
                                                // $checkBoost = $postObj->isBoosted($post["id"], "top");
                                                
                                                // $checkstoryofthemonth = $postObj->isSetStoryAsMonth($post["id"]);
                                                
                                                
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i;
                                                        $i++; ?>
                                                    </td>
                                                    <td><?php echo $News["title"]; ?></td>
                                                    <td><?php echo $News["author"]; ?></td>
                                                    <td>
                                                        <?php echo $News["PostTime"]; ?>
                                                    </td> 
                                                     
                                                    <td>
                                                        <!--<div class="badge badge-<?php if ($checkBoost) { echo "warning"; } ?> badge-shadow">
                                        <?php if ($checkBoost) { echo "Boosted"; } ?>
                                                            </div>-->
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                            <!--<div class="dropdown-menu">
                                                                <a href="update.php?id=<?php echo $post['id']; ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i>Edit</a>
                                                                <?php if ($checkBoost) { ?>
                                                                    <a onclick="unboostPost(<?php echo $post['id']; ?>,'top')" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Boost</a>
                                                                <?php } else { ?>
                                                                    <a onclick="boostPost(<?php echo $post['id']; ?>,'top')" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Boost</a>
                                                                <?php } 
                                                if($checkstoryofthemonth){
                                                
                                                }else{
                                                                ?>
                                                 <a onclick="storyofthemonth(<?php echo $post['id']; ?>)" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Story of the Month</a>
                                                    <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a target="_blank" href="/story/<?php echo $post["slug"]; ?>" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                                            </div>-->
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<h1>No News</h1>";
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
<script src="assets/js/app.min.js"></script>
<script src="assets/bundles/summernote/summernote-bs4.js"></script>
<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/bundles/ckeditor/ckeditor.js"></script>
<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/lightgallery/dist/js/lightgallery-all.js"></script>
<script src="assets/js/page/light-gallery.js"></script>
<script src="assets/js/page/ckeditor.js"></script>
<script src="assets/js/page/create-post.js"></script>
<script src="assets/js/page/index.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<script>


function storyofthemonth(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/storyofthemonth.php?id=" + id;
            }
        })
    }


    function boostPost(id, s) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Boost it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/boost.php?id=" + id + "&section=" + s;
            }
        })
    }

    function unboostPost(id, s) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Un-Boost it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/unboost.php?id=" + id + "&section=" + s;
            }
        })
    }

    function href(url) {
        window.location.href = "stats/" + url + ".php";
    }
    // Script for Company Campaign Update image upload Preview;
   
</script>
<?php echo $alert;
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>
</body>

</html>