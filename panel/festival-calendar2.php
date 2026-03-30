<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $_SESSION["response"]  = $postObj->addCalendarFestivals();
}


$script = "";

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Festival Added Successfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Adding Festival!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["response"]);
}


include_once("navBar.php");
?>
<style> 
    
    label {
        font-size: 15px;
    }
    
</style>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                         
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Festival List</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#generallist" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    
            <div class="collapse show" id="generallist">
             <div id="fieldgroup2" class="card-body">
                                        
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Festival</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php 
                $yr = 2024;
            $FestSQL = $postObj->GetListOfFestivals($yr);
            foreach($FestSQL as $festRow){
              
                ?>
                                <tr>
                                    <!--<th><?=$festRow['date'];?></th> -->
                                    <th><?=date("l d M, Y h:i A", strtotime($festRow['date']));?></th> 
                                    
                                    <th><?=$festRow['title'];?></th> 
                                    <th><?=$festRow['description'];?></th> 
                                    <th><a href="<?=$festRow['imagelink'];?>" target="_blank"><img src="<?=$festRow['imagelink'];?>" width="150px"></a></th> 
                                </tr>
            <?php } ?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
            
            </div>
                                    
            
                                     
                                </div>
                         
                    </div>
                </div>






            </div>
            
            
            

                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Add Festival</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#general" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    
            <div class="collapse show" id="general">
             <div id="fieldgroup" class="card-body">
                                        
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Festival Title *:</label> 
                            <input name="title" type="text" class="form-control" required> 
 
                    </div>
                    <div class="col-md-12  mb-4">
                        <label class="form-label">Date Time *</label>
                        <input type="datetime-local" required class="form-control" name="festivaldate">
                    </div>
                                            
                    <div class="col-md-12 mb-4">  
                        <label class="form-label">Description *:</label>
                        <input name="description" type="text" class="form-control" required> 
                    </div>
                                            
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Image URL:</label>
                        <input name="imagelink" type="text" class="form-control"> 
                    </div>
                    
                </div>
            </div>
            
            </div>
                                    
            <div class="card-footer">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-primary ml-5" value="Add"></input>
                </div>
            </div>
                                     
                                </div>
                        </form>
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
    <script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="assets/bundles/ckeditor/ckeditor.js"></script>
    <script src="assets/js/page/ckeditor.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/page/create-post.js"></script>
    <?php echo $script; ?>
    
    
</body>

</html>