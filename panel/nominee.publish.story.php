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

if(!isset($_GET['nId']) || $_GET['nId'] == ''){
    header("location: nominees-list");
}

$post = $postObj->getNomineeById($_GET['nId']);
if($post == false){
    header("location: nominees-list");
}

$STORYDATA = $postObj->GetNomineeStoryDetails($_GET['nId']); 

// echo $STORYDATA['id'];
// echo $STORYDATA['nominationid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $STORYDATA['id'];
    $Nominationid = $STORYDATA['nominationid'];
    
    $_SESSION["response"]  = $postObj->PublishNomineeStory($id, $Nominationid);
}


$script = "";

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Story Published Successfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Publishing Story!','',
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
    #STellerSelect, #UserSelect{
        display: none;
    } 
    
    label {
        font-size: 15px;
        font-weight: 600;
        color: #000;
    }
    
</style>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
<h3>Story Status: <?php if($STORYDATA['isVerified'] == 1){ echo '<span class="btn btn-primary">Already Published <i class="fa fa-check"></i></span>';}else{ echo '<span class="btn btn-secondary">Not Published Yet</span>';} ?></h3>
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="" enctype="multipart/form-data" onsubmit="return confirmSubmit();">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
        <h4>Publish the Story </h4>
        <div class="card-header-action">
            <a data-collapse="#general" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
        </div>
                                    </div>
                                    
                                    
                                    <div class="collapse show" id="general">
                                        <div id="fieldgroup" class="card-body">
                                            
        <div class="col-md-12  mb-4">
            <label class="form-label">Story Title: </label>
            <input type="text" class="form-control" name="title" value="<?=$STORYDATA['title']?>" required>
        </div>                                    
                                           
        <div class="col-md-12  mb-4">
            <label class="form-label">Author: </label>
            <input type="text" class="form-control" name="author" value="<?=$post['name']?>" required>
        </div>  
        <div class="col-md-12 mb-4">           
            <label class="form-label">Category: </label>
            <select class="form-control selectric" name="Category" required>
                
        <?php if($post['category'] != ''){?>
            <option value="<?=$post['category']?>" selected><?=$post['category']?> UNDER <?=$post['category']?></option>
        <?php }else{ ?>
            <option value=""> --Select-- </option>
        <?php } ?>
                <option value="30">30 UNDER 30</option>
                <option value="40">40 UNDER 40</option>
                <option value="50">50 UNDER 50</option>
                
            </select>
        </div> 
        <div class="col-md-12 mb-4">           
            <label class="form-label">Sub Category: </label>
            <select class="form-control selectric" name="SubCategory" required>
            
            <?php if($post['subcategory'] != ''){?>
                <option value="<?=$post['subcategory']?>" selected><?=$post['subcategory']?></option>
            <?php }else{ ?>
                <option value=""> --Select-- </option>
            <?php } ?>
                <option value="Beyond the Ordinary">Beyond the Ordinary</option>
                <option value="Innovation Maestro">Innovation Maestro</option>
                <option value="Breaking Barriers">Breaking Barriers</option>
                
                <option value="Transformative Leadership">Transformative Leadership</option>
                <option value="Courage Under Fire">Courage Under Fire</option>
                <option value="Against All Odds">Against All Odds</option>
                
                <option value="The Hidden Impact Award">The Hidden Impact Award</option>
                <option value="Journey to Excellence">Journey to Excellence</option>
                <option value="Legacy Builder">Legacy Builder</option> 
            </select>
        </div>
        
        <div class="col-md-12 mb-4">           
            <h5>Question 1:</h5>
             <textarea id="editor1" name="q1" style="min-height: 350px;"><?=$STORYDATA['q1']?></textarea>
        </div>
        <div class="col-md-12 mb-4">           
            <h5>Question 2:</h5>
             <textarea id="editor2" name="q2" style="min-height: 350px;"><?=$STORYDATA['q2']?></textarea>
        </div>
        <div class="col-md-12 mb-4">           
            <h5>Question 3:</h5>
             <textarea id="editor3" name="q3" style="min-height: 350px;"><?=$STORYDATA['q3']?></textarea>
        </div>
        <div class="col-md-12 mb-4">           
            <h5>Question 4:</h5>
             <textarea id="editor4" name="q4" style="min-height: 350px;"><?=$STORYDATA['q4']?></textarea>
        </div>
        <div class="col-md-12 mb-4">           
            <h5>Question 5:</h5>
             <textarea id="editor5" name="q5" style="min-height: 350px;"><?=$STORYDATA['q5']?></textarea>
        </div>
                 
        <div class="col-md-12  mb-4">
            <div class="form-group row mb-4">

                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>

                <div class="col-sm-12 col-md-7">

                    <div id="image-preview" class="image-preview">

                        <label for="image-upload" id="image-label">Choose File</label>

                        <input type="file" name="image" accept="image/*" id="image-upload" />

                    </div>

                </div>

            </div>
        </div> 
                                         
                    
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group-append">
                                                
        <input type="submit" class="btn btn-primary ml-5" value="Publish"></input>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

             </div>
            
            </div>
        </section> 
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
    
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    
   <script>
    ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor3' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor4' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#editor5' ) )
        .catch( error => {
            console.error( error );
        } );
 
</script>

<script>
    function confirmSubmit() {
        // Display a confirmation dialog
        var isConfirmed = confirm("Are you sure you want to publish the story?");

        // Return true if the user clicks OK, and false otherwise
        return isConfirmed;
    }
</script>
    
     
</body>

</html>