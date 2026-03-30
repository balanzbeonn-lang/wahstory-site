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
    $_SESSION["response"]  = $postObj->addContentSuggestion();
}


$script = "";

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Suggestion Added Successfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $script = "<script>Swal.fire(
                'Error While Adding Suggestion!','',
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
        /*display: none;*/
    } 
    
    label {
        font-size: 15px;
    }
    .generate-btn{
        background:#33b9e3;
        border:none;
        padding:11px 22px;
        margin-top:29px;
        border-radius:5px;
        color: #fff;
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }
    .generate-btn:hover {
    background: #1c93b9; 
    box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
}
    
</style>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">


                <div class="row">
                    <div class="col-12 tex-right">
                       <a href="festival-calendar" class="btn btn-primary">Festival Calendar</a> 
                    </div>
                    <div class="col-12">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Create Content Suggestion</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#general" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="general">
                                        <div id="fieldgroup" class="card-body">
              
            <div class="row"> 
            
            <div class="col-lg-4 col-md-4 mb-4"> 
            <div id="UserSelect">
                <label class="form-label text-success">Select User: </label>
                <select class="form-control selectric" name="SelectedUserId">
                    <option value=""> --Select-- </option>
            <?php 
                $users = $postObj->getUsers();
                foreach($users as $userrow){ ?>
                    <option value="<?=$userrow['id'];?>"><?=$userrow['name'] ;?></option>
            <?php  } ?>
            
                </select>
            </div>
            
            </div>
            <div class="col-lg-4 col-md-4 mb-4">           
                <label class="form-label">Platform Name: </label>
                <select class="form-control selectric" name="platformname" required>
                    <option value=""> --Select-- </option>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Twitter">Twitter</option>
                    <!--<option value="Youtube">Youtube</option>-->
                    <!--<option value="TikTok">TikTok</option>-->
                </select>
            </div>
                     
            <!--<div class="col-md-12 mb-4">           -->
            <!--    <label class="form-label">Content Type: </label>-->
            <!--    <select class="form-control selectric" name="contentType" required>-->
            <!--        <option value=""> --Select-- </option>-->
            <!--        <option value="Image">Image</option>-->
            <!--        <option value="Article">Article</option>-->
            <!--        <option value="Video">Video</option>-->
            <!--        <option value="Opinion">Opinion</option>-->
            <!--    </select>-->
            <!--</div>-->
            
            <div class="col-lg-4 col-md-4  mb-4">
                        <div id="PFFacebook">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                  <label class="form-label">Content Type: </label>
                                  <select class="form-control selectric" name="contentType" required>
                                    <option value="">--Select--</option>
                                    <option value="Image">Image</option>
                                    <option value="Article">Article</option>
                                    <option value="Opinion">Opinion</option>
                                  </select>
                                </div>
                                
                                <!--<div class="col-md-12 mb-4">-->
                                <!--    <label class="form-label">Content:</label>-->
                                <!--  <input class="form-control" type="text" placeholder="" class="form-label" ></input>-->
                                <!--</div>-->
                                
                            </div>
                            
                        </div>
                        
                    
                    </div>
                    
            </div>
            
            <div class="row p-3">
                <div class="col-lg-12 col-md-12 mb-5">
                    <label class="form-label">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter title" class="form-control">
                </div>
                 
            </div>
            
            <div class="row p-3">
                <div class="col-lg-10 col-md-10 mb-5">
                    <label class="form-label">Generate Content</label>
                    <input type="text" id="GenerateContent" placeholder="Enter a topic" class="form-control">
                    <span style="font-size: 10px;">Powered By ChatGPT</span>
                </div>
                <div class="col-lg-2 col-md-2 mb-5">
                    <button id="generate" type="button" class="generate-btn">Generate</button>
                </div>
            </div>
            
            <div class="row">
                
            
                    <div class="col-lg-12 col-md-12  mb-4">
                        <div class="form-group col-md-12 mb-2">
                            <label class="form-label">Content
                            </label>
                            <div class="col-md-12 col-sm-12">
                                <textarea name="content" id="Generatedcontent" class="summernote" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="col-lg-12 col-md-12  mb-4">
                        
                        <label class="form-label">Suggestion Caption:</label>
                        
                        <div class="form-group">
                           <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="attachment" accept=".doc, .docx, .pdf">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                           </div>
                           <div><p>Maximum file size: 3.0MB</p></div>


                        </div>
                        
                    </div>-->
                    
                    <div class="col-md-12  mb-4">
                        <label class="form-label">Date Time</label>
                        <input type="datetime-local" required class="form-control" name="scheduleTime">
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
   
    
    <script>
        $(document).ready(function() {
        $('#generate').click(function() {
            var GenerateContentTopic = $('#GenerateContent').val();
            
       if (GenerateContentTopic !== "") {
            
            $.ajax({
                url: 'chatgptgenerator.php', // Replace 'your_server_url' with the actual URL
                method: 'POST',
                data: { content: GenerateContentTopic }, // Send the content as data
                success: function(response) {
                    
                    $('#Generatedcontent').val(response); 
                    $('#Generatedcontent').summernote('code', response);
                },
                error: function(xhr, status, error) {
                    // Handle error here
                    console.error('Error sending content:', error);
                }
            });
            
        }else{
            alert("Please enter the topic first");
        }
        
            });
        });
    </script>
    
    
   <script>
    $(document).ready(function() {
        // Other initialization code...

        $('#customFile').on('change', function() {
            // Reference to the file
            var file = this.files[0];
            var maxSize = 3 * 1024 * 1024; // 3MB

            if (file && file.size > maxSize) {
                // If file is too large
                alert("File too large. Please select a file less than 3MB.");
                $(this).val(''); // Clear the input
                $(this).next('.custom-file-label').html('Choose file'); // Reset the label
            } else if (file) {
                // Update the label with the file name
                $(this).next('.custom-file-label').html(file.name);
            }
        });

        // Existing '#generate' click event...
    });
</script>


    <?php echo $script; ?>
    
  
    
</body>

</html>