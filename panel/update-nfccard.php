<?php
require_once("../db/postClass.php");
$postObj = new Post;

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["response"]  = $postObj->UpdateNFCcard($_POST['rowid']);
}

if (isset($_SESSION["response"])) {

    switch ($_SESSION["response"]) {

        case "Success": {

                $script = "<script>Swal.fire(

                'Card updated seccussfully!','',

                'success'

                )</script>";

                break;
            }

        case "Error": {

                $script = "<script>Swal.fire(

                'Error while updating!','',

                'error'

              )</script>";

                break;
            }

        case "not_admin": {

                $script = "<script>Swal.fire(

                'Sorry but you are not a admin!','',

                'warning'

              )</script>";

                break;
            }

        case "Error_size": {

                $script = "<script>Swal.fire(

                'Image size should be less than 1MB!','',

                'warning'

              )</script>";

                break;
            }
    }

    unset($_SESSION["response"]);
}

?>


<?php include_once("navBar.php") ?>

<!-- Main Content -->

<div class="main-content">

    <section class="section">

        <div class="section-body">



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <form method="POST" enctype="multipart/form-data">

                            <div class="card-header">

                                <h4>Update NFC Card Details</h4>

                            </div>

                            <div class="card-body">
                                
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Select Member
                                    </label>

                                    <div class="col-sm-12 col-md-7">

                                        <select class="form-control selectric" name="userID" id="UserSelect" required>
                                            
                            <option value=""> Select Member </option>
                            
                    <?php foreach ($postObj->GetAllWAHClubUsers() as $user) : ?>
                    
                    <?php if(isset($_GET['userid']) && $_GET['userid'] != '') {
                            if($user['id'] == $_GET['userid']) { ?>
                            
                            <option value="<?= $user['id'] ?>" selected>
                                <?=$user['firstname'] . ' ' . $user['lastname'] ?>
                            </option>
                    <?php            
                            }
                          }
                    ?>
                        <option value="<?= $user['id'] ?>">
                            <?=$user['firstname'] . ' ' . $user['lastname'] ?>
                        </option>
                    <?php endforeach; ?>
                                        </select>

                                    </div>

                                </div>
                                
            <?php
            
            if(isset($_GET['userid']) && $_GET['userid'] != '') {
                $nfcRow = $postObj->GetNFCcardDetilsUserId($_GET['userid']);
                
                if($nfcRow !== NULL) {
                    
            ?>
            <input  type="hidden"  name="rowid" value="<?=$nfcRow['id']?>" required>
                                 
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title/Designation</label></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input name="designation" type="text" class="form-control" value="<?=$nfcRow['designation']?>" required>

                                    </div>

                                </div>
                                
                                 <div class="form-group row mb-4">
    <?php
            $displayoptions = explode(', ', $nfcRow['displayoptions']);
              
    ?>
    
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> Show Phone number</label></label>
    
                                    <div class="col-sm-12 col-md-7">
    
                                       <input class="form-check-input" type="checkbox" name="phone" value="phone" id="PhoneCheckbox" 
                        <?php echo in_array('phone', $displayoptions) ? 'checked' : '';  ?>
                                       >
                     
                                    </div>
    
                                </div>
                                
                                <div class="form-group row mb-4">
    
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
    
                                    <div class="col-sm-12 col-md-7">
    
                                        <input class="form-check-input" type="checkbox" name="email" value="email" id="emailCheckbox" <?php echo in_array('email', $displayoptions) ? 'checked' : '';  ?>>
    
                                    </div>
    
                                </div>
                                
                                <div class="form-group row mb-4">
        
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> Show LinkedIn Link</label>
    
                                    <div class="col-sm-12 col-md-7">
    
                                       <input class="form-check-input" type="checkbox" name="linkedin" value="linkedin" id="linkedinCheckbox" <?php echo in_array('linkedin', $displayoptions) ? 'checked' : '';  ?>>
                        
                                    </div>
    
                                </div>
                                
                                <div class="form-group row mb-4">
    
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Show Instagram Link</label>
    
                                    <div class="col-sm-12 col-md-7">
    
                                        <input class="form-check-input" type="checkbox" name="instagram" value="instagram" id="instagramCheckbox" <?php echo in_array('instagram', $displayoptions) ? 'checked' : '';  ?>>
                       
                                    </div>
    
                                </div>
                                
                                <div class="form-group row mb-4">
    
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> Show Website or Other Link</label>
    
                                    <div class="col-sm-12 col-md-7">
    
                                        <input name="website" value="<?=$nfcRow['otherlink']?>" type="url" class="form-control">
                       
    
                                    </div> 
    
                                </div>
                                
                                <div class="form-group row mb-4">
    
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> Card Status</label>
    
                                    <div class="col-sm-12 col-md-7">
    
                       
                            <select class="form-control selectric" name="status" id="StatusSelect">
                                <option value="<?=$nfcRow['status']?>" selected> <?=$nfcRow['status']?> </option>
                                <option value="Inactive"> Inactive </option>
                                <option value="Active"> Active </option>
                            </select>
                            
                            
    
                                    </div> 
    
                                </div>
                                
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Card Front Image</label>

                                    <div class="col-sm-12 col-md-7">

                                        <div id="image-preview" class="image-preview">

                                            <label for="image-upload" id="image-label">Choose File</label>

                                            <input type="file" name="image" accept="image/*" id="image-upload"  />

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-12 col-md-4">
                                        <img src="https://nfc.wahstory.com/cards/<?=$nfcRow['cardfrontimage']?>" width="200px">
                                    </div>

                                </div>
                                
                                
                                <div class="form-group row mb-4">

                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                                    <div class="col-sm-12 col-md-7">

                                        <input type="submit" class="btn btn-primary" value="UPDATE"></input>

                                    </div>

                                </div>
                <?php
                        } else {
                             echo "<center><h5>No Record Found, Please <a href='add-nfccard' class='btn btn-primary'>add nfc card</a> first!</h5></center>";
                        }
                        
                    }                
                ?>

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

<script src="assets/bundles/summernote/summernote-bs4.js"></script>

<script src="assets/bundles/codemirror/lib/codemirror.js"></script>
<script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

<script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>

<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>

<script src="assets/bundles/ckeditor/ckeditor.js"></script>

<!-- Page Specific JS File -->

<script src="assets/js/page/ckeditor.js"></script>

<!-- Template JS File -->

<script src="assets/js/scripts.js"></script>

<!-- Custom JS File -->

<script src="assets/js/custom.js"></script>
<script src="assets/js/page/create-post.js"></script>
<script>
    $('#UserSelect').change(function(){
            var UserSelect = document.getElementById('UserSelect').value;
            window.location.href="?userid=" + UserSelect;
            
    });
</script>

</body>

</html>

<?php echo $script; ?>