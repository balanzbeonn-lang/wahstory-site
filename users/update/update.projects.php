<?php 
    session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    include('inc/update_project.php');
    $UtilityObj = new ProjUtility();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        echo '<script>window.location.href="/login.php"</script>';
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
    if(isset($_POST['UpdatePROJ'])){
        
        $_SESSION['responce'] = $UtilityObj->UpdateUserProject($Userrow['ClubId']);
    }
    
    if($_SESSION['responce']!=''){
        if($_SESSION['responce'] == 'SUCCESS') {
            $message = 'Updated Successfully!';
            echo '<script>window.location.href="update.projects.php?sucmsg='.$message.'"</script>';
        } else {
            $message = 'Something went wrong!';
            echo '<script>window.location.href="update.projects.php?errmsg='.$message.'"</script>';
        }
        
        unset($_SESSION['responce']);
        
    }
    
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>Update Project | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     form#updateprofile label{
         font-size: 15px;
         margin-bottom: 5px;
     }
     form#updateprofile .cs-form_field{
         padding: 8px 20px;
     }
       
     .swal-success-alert .swal2-timer-progress-bar-container {
         background: #a5dc86;
     }
     .swal-success-alert .swal2-title {
         color: #2c6a09;
     }
     
     .swal-danger-alert .swal2-title {
         color: #f75252;
     }
     
     .swal2-timer-progress-bar {
         background: rgba(0, 0, 0, .4);
     }
     
     p.word-counter.success {
        color: #15ab3a;
    }
     p.word-counter.error {
        color: red;
    }
    
    input:disabled {
        background: #383838 !important;
        border-color: #383838;
        cursor: not-allowed;
    }
    
    option:checked {
        background: #0d6efd !important;  
    }
     
     
     .addmorebtn {
        border: 2px solid #e9204f;
        border-radius: 20px;
        padding: 5px 10px;
     }
     
    select:disabled {
        opacity: 1;
        background: #333;
        border-color: #333;
        color: #8b8888 !important;
        cursor: not-allowed;
    }
        
        .ck.ck-editor__top.ck-reset_all {
            display: none;
        }
        
        
         .ck.ck-content{
                min-height: 150px;
            }
        .ck.ck-editor__main>.ck-editor__editable{
            background: #101010 !important; 
            
            padding: 10px 20px;
            border-radius: 15px !important;
            outline: none;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
            border: 2px solid #999696 !important;
            background-color: transparent;
            color: #fff;
        }
        .ck.ck-toolbar{
            border: none;
        }
    
 </style>
     
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    
 <?php include('../../header.php');?>
 <!-- Start Hero -->
   
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  <div class="container">
    <div class="row">
     <div class="col-lg-3">
        
        <div class="dashboard-left-menu">
            <div class="cs-shop_sidebar">
                <div class="cursor-pointer openleftmenu">
                   <i class="fa-solid fa-bars"></i>
                </div>
              <div class="cs-shop_sidebar_widget">
                <?php $Dmenu = 3;?>
                <?php include('../user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12">  
              <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-2">Update Your Projects</h4>
                <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
              </div>
              
              <small class="field-instruction">(Share up to 2 projects that highlight your journey and impact) </small>
              
              <hr class="mb-4">
            </div>
            
        <form id="updateprofile" action="" enctype="multipart/form-data" method="post"> 
        
        <div id="projectContainer">
        
        <?php 
        
            $projs = $postObj->GetUserProjectsById($Userrow['ClubId']);
        
         if($projs != '') {
             $i = 0;
         
            foreach ($projs as $proj) {
        $i++;
        ?>
        
            <input type="hidden" value="<?=$proj['id'];?>" name="project<?=$i?>id">
        
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <h4 class="mb-2 cs-font_20"> Project <?=$i?> details: </h4>
                </div>
            </div>
                
                <hr>
            
             <div class="cs-height_20 cs-height_lg_20"></div>
        
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Project Name *</label> 
                    <input type="text" class="cs-form_field" name="project<?=$i?>name" placeholder="Enter Project Name *" autocomplete="off" value="<?=$proj['project_name'];?>" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-4">
                    <label>Update Project Image <span class="small">(Max-size: 200 KB)</span>: </label>
                    <input type="file" class="cs-form_field" name="project<?=$i?>file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg">
                </div>
                <div class="col-md-2">
                <?php 
                    if(!empty($proj['project_photo'])) {
                        echo '<img src="/wahclub/public/img/projects/'.$proj['project_photo'].'" style="width: 140px;">';
                    }
                ?>
                </div>
                
            </div>
                
                
            <div class="row">
                
                <div class="col-md-12"> 
                    <label>Project Link (Optional) </label>
                    <input type="url" class="cs-form_field" name="project<?=$i?>link" placeholder="Enter Project Link (Optional)" autocomplete="off" value="<?=$proj['project_link'];?>">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                <div class="col-md-12"> 
                  <div class="form_group">
                    <label>1. What was the objective of the project? </label>
                    <textarea name="project<?=$i?>Objective" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""><?=$proj['project_objective'];?></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                  
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12">
                   <div class="form_group"> 
                    <label>2. What was your role in the project? </label>
                    <textarea name="project<?=$i?>Role" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""><?=$proj['project_role'];?></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  
                  </div>
                    
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12"> 
                  <div class="form_group">
                    <label>3. What were the outcomes and impact of the
                          project? </label>
                    <textarea name="project<?=$i?>Outcome" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""><?=$proj['project_outcome'];?></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
            </div>
            
            <div class="cs-height_30 cs-height_lg_30"></div>
            
            
        <?php   } } else {?>
        
            
            
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Project Name *</label> 
                    <input type="text" class="cs-form_field" name="project1name" placeholder="Enter Project Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6">
                    <label>Upload Project Image <span class="small">(Max-size: 200 KB)</span>: </label>
                    <input type="file" class="cs-form_field" name="project1file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg">
                </div>
                
                <div class="col-md-12"> 
                    <label>Project Link (Optional) </label>
                    <input type="url" class="cs-form_field" name="project1link" placeholder="Enter Project Link (Optional)" autocomplete="off">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
                <div class="col-md-12">
                     
                    
                   <div class="form_group"> 
                   
                    
                    <label>1. What was the objective of the project? </label>
                    <textarea name="project1Objective" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                        
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12"> 
                
                 <div class="form_group">
                    <label>2. What was your role in the project? </label>
                    <textarea name="project1Role" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                        
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12">
                
                  <div class="form_group">
                      
                    <label>3. What were the outcomes and impact of the
                          project? </label>
                    <textarea name="project1Outcome" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                    
                  </div>
                        
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
            </div>
            
        
        <?php  } ?>
        
            
        </div> <!-- Container Closed  -->
            
            <div class="row">
                
                
                <div class="col-lg-6 pt-4 text-right">
                    <div> 
                    
                        <a href="javascipt:void(0);" id="addProjectButton" class="addmorebtn"> <i class="fa fa-plus-circle"></i> Add More </a>
                     &nbsp; &nbsp; &nbsp; &nbsp; 
                        <button class="cs-btn cs-style1 small py-2" type="submit" name="UpdatePROJ">
                            <span>Update Now</span>
                        </button>
                        
                        <div id="cs-result"></div>
                        
                    </div>
                </div>
                 
                
            </div>
          
        </form> 
        
          </div> <!-- Row Ends-->
          
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
   
  
  
    <script>
// Function to check word count and show real-time feedback
function checkWordLen(obj, wordLen) {
    var text = obj.value.trim();
    var words = text.split(/\s+/);
    var wordCount = words.length > 0 && words[0] !== "" ? words.length : 0;  // Handle empty input case
    var paragraph = obj.closest('.form_group').querySelector('.word-counter'); // Select the element by class within the same container
    
    // Always display the current word count, even if it exceeds the limit
    if (wordCount > wordLen) {
        paragraph.classList.remove('success');
        paragraph.classList.add('error');
        paragraph.innerHTML = wordCount + '/' + wordLen + ' (Word limit exceeded!)';  // Show current word count
    } else {
        paragraph.classList.remove('error');
        paragraph.classList.add('success');
        paragraph.innerHTML = wordCount + '/' + wordLen + " Words";  // Show word count within limit
    }
}

// Function to remove extra words when input loses focus
function truncateExcess(obj, wordLen) {
    var text = obj.value.trim();
    var words = text.split(/\s+/);
    
    if (words.length > wordLen) {
        obj.value = words.slice(0, wordLen).join(" ");  // Truncate to the first `wordLen` words
    }

    // Recalculate the word count and update the counter after truncation
    checkWordLen(obj, wordLen);
}
</script>
  
   <!-- Script -->
    <script src="/assets/js/plugins/jquery-3.6.0.min.js"></script>
    
    <script>
        function maximagesize() {
            
            const fileInputs = document.querySelectorAll('input[type="file"]');
            
            fileInputs.forEach((fileInput) => {
                fileInput.addEventListener('change', function () {
                    
                    const file = this.files[0];
                    const maxFileSize = 200 * 1024; // 200 KB
            
                    if (file.size > maxFileSize) {
                        alert("Image Size Exceed! Maximum Size Allowed: 200 KB");
                        this.value = ''; // Clear the selected file
                        return;
                    }
            
                });
            });
    
        }
     
         
         
        $(document).ready(function() {
            maximagesize();
        }); 
        
    </script>
      
    <script>
         <?php
         if(isset($i) && $i != ''){ ?>
             let ProjectCount = <?=$i?>;
         <?php } else { ?>
         let ProjectCount = 1;
         <?php } ?>
       

        document.getElementById('addProjectButton').addEventListener('click', function() {
            
        if(ProjectCount >= 2) {
            alert("Max 2 Allowed!");
        }else{
            ProjectCount++;
            
            const projectContainer = document.getElementById('projectContainer');

            const projectGroup = document.createElement('div');
            projectGroup.className = 'project-group';
            projectGroup.id = `project${ProjectCount}`;

            projectGroup.innerHTML = ` 
                <br> 
              
               <div class="row">
                <div class="col-sm-6">
                    <h6 class="mb-2 cs-font_20"> Project ${ProjectCount} details: </h6>
                </div>
                 
                <div class="col-sm-6" style="text-align: right;">
                    <button type="button" class="deleteProjectButton btn btn-danger m-0" onclick="deleteProject(${ProjectCount})"> <i class="fa-solid fa-trash"></i> </button>
                </div> 
            </div>
                
                <hr>
            
             <div class="cs-height_20 cs-height_lg_20"></div>
              
             
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Project Name *</label> 
                    <input type="text" class="cs-form_field" name="project${ProjectCount}name" placeholder="Enter Project Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6">
                    <label>Upload Project Image <span class="small">(Max-size: 200 KB)</span>: </label>
                    <input type="file" class="cs-form_field" name="project${ProjectCount}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg">
                </div>
                
                <div class="col-md-12"> 
                    <label>Project Link (Optional) </label>
                    <input type="url" class="cs-form_field" name="project${ProjectCount}link" placeholder="Enter Project Link (Optional)" autocomplete="off">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
                <div class="col-md-12"> 
                  <div class="form_group">
                    <label>1. What was the objective of the project? </label>
                    <textarea name="project${ProjectCount}Objective" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                  
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12"> 
                 <div class="form_group">
                    <label>2. What was your role in the project? </label>
                    <textarea name="project${ProjectCount}Role" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                 </div>
                 
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-12"> 
                  <div class="form_group">
                    <label>3. What were the outcomes and impact of the
                          project? </label>
                    <textarea name="project${ProjectCount}Outcome" rows="5" class="cs-form_field editableTextarea" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required=""></textarea>
                    <p class="word-counter success">0/150 Words</p>
                  </div>
                        
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
            </div>
            
            
            <div class="cs-height_30 cs-height_lg_30"></div>
              
            `;

            projectContainer.appendChild(projectGroup);
            
            maximagesize();
            
            } //if less than 2 
            
        });
         function deleteProject(projectNumber) {
            const projectGroup = document.getElementById(`project${projectNumber}`);
            projectGroup.remove();
             
            ProjectCount--;
             
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        <?php if(isset($_GET['sucmsg'])){ ?>
            function showSuccessAlert() {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '<?=$_GET['sucmsg'];?>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                      popup: 'swal-success-alert'
                      
                    }
                  });
                }
            window.onload = showSuccessAlert();
        <?php } ?>
            
        <?php if(isset($_GET['errmsg'])){ ?>
            function showErrorAlert() {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 3000,
                    color: "#716add",
                    timerProgressBar: true,
                    customClass: {
                      popup: 'swal-danger-alert'
                      
                    }
                  });
                }
            window.onload = showErrorAlert();
        <?php } ?>
        
    </script>
    
   
  <!-- Start CTA -->
  <?php include('../../footer.section.php');?>
      <?php include('../footer.commonJS.php');?> 
        
        <script>
            $(document).ready(function () {
                // Open Left Menu Of User Dashboard
                const openMenuBtn = document.querySelector('.openleftmenu');
                const openMenuBtnicon = document.querySelector('.openleftmenu i');
                const sidebar = document.querySelector('.dashboard-left-menu');
                 
                openMenuBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('open'); 
                    openMenuBtnicon.classList.toggle('fa-times'); 
                });
            });
        </script>
    </body>
</html>