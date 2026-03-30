<?php 
    session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    include('inc/update_education.php');
    $UtilityObj = new EduUtility();
    
    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script>window.location.href="/login.php"</script>';
    } 
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
    if(isset($_POST['UpdateEDU'])){
        
        $_SESSION['responce'] = $UtilityObj->UpdateUserEducation($Userrow['ClubId']);
    }
    
    if($_SESSION['responce']!=''){
        if($_SESSION['responce'] == 'SUCCESS') {
            $message = 'Updated Successfully!';
            echo '<script>window.location.href="update.educations.php?sucmsg='.$message.'"</script>';
        } else {
            $message = 'Something went wrong!';
            echo '<script>window.location.href="update.educations.php?errmsg='.$message.'"</script>';
        }
        
        unset($_SESSION['responce']);
        
    }
    
    $clubuser = $postObj->GetWAHClubUserById($Userrow['ClubId']);
    if($clubuser['subscription_status'] === 'paid') {
        $addable_exp_count = 5;
    } else {
        $addable_exp_count = 3;
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
    
  <title>Update Education | <?=$Userrow['name']?></title>
  
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
    
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
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
                <h4 class="mb-2">Update Your Education</h4>
                <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
              </div>
              
              <small class="field-instruction">(Share up to <?=$addable_exp_count?> education that highlight your journey and impact) </small>
              
              <hr class="mb-4">
            </div>
            
        <form id="updateprofile" action="" method="post"> 
        
        <div id="educationContainer">
        
        <?php 
        
            $edus = $postObj->GetUserEducationById($Userrow['ClubId']);
        
         if($edus != '') {
             $i = 0;
         
            foreach ($edus as $edu) {
            $i++;
        ?>
        
            <input type="hidden" value="<?=$edu['id'];?>" name="edu<?=$i?>id">
        
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <h4 class="mb-2 cs-font_20"> Education <?=$i?> details: </h4>
                </div>
            </div>
                
                <hr>
            
             <div class="cs-height_20 cs-height_lg_20"></div>
        
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Course Name *</label> 
                    <input type="text" class="cs-form_field" name="edu<?=$i?>course" placeholder="Enter Course Name *" autocomplete="off" value="<?=$edu['degree'];?>" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>University Name *</label>
                    <input type="text" class="cs-form_field" name="edu<?=$i?>university" placeholder="Enter University Name *" autocomplete="off" value="<?=$edu['institution_name'];?>" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>From *</label>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        <?php 
                        
                        $fromdate = $edu['yearfrom'];
                        $fromMonthNum = date("m", strtotime($fromdate));
                        $fromMonthFull = date("F", strtotime($fromdate));
                        
                        
                        $fromYearNum = date("Y", strtotime($fromdate));
                        $fromYearFull = date("Y", strtotime($fromdate));
                         
                        ?>
                        
                    <select name="edu<?=$i?>start-month" class="cs-form_field" required>
                        <option value="">Select Month</option>
                        <option value="<?=$fromMonthNum;?>" selected><?=$fromMonthFull;?></option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    
                    <div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">
                             
                             
                    <select name="edu<?=$i?>start-year" class="cs-form_field selectyear" required><option value="">Select Year</option>
                    <option value="<?=$fromYearNum;?>" selected><?=$fromYearFull;?></option>
                    </select> 
                    <div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6 toedu"> 
                
                    <label>To 
                    &nbsp;
                    &nbsp;
                    <span class="text-center p-0 m-0" style="color: #e9204f;">
                        OR
                    </span>
                     &nbsp;
                     &nbsp;
                     
            <?php 
            
            if($edu['present'] == NULL){
            
                $todate = $edu['yearto'];
                $toMonthNum = date("m", strtotime($todate));
                $toMonthFull = date("F", strtotime($todate));
                
                $toYearNum = date("Y", strtotime($todate));
                $toYearFull = date("Y", strtotime($todate));
                $checked = '';
                
                $disabled = '';
            
            }else {
                
                $checked = "checked";
                $disabled = "disabled";
            }
                
            
            ?>
                     
                    <input type="checkbox" id="edu<?=$i?>currentworking" name="edu<?=$i?>currentworking" value="1" class="form-checkbox required form-check-input" onchange="toggleEduInput('<?=$i?>')" <?=$checked;?>> 
                    
                    <span class="cs-font_10">I am currently pursuing this course</span></label> 
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        
                    <select name="edu<?=$i?>end-month" class="cs-form_field" required <?=$disabled;?>>
                        <option value="">Select Month</option>
                        
                <?php if($edu['present'] == NULL) { ?>
                    
                    <option value="<?=$toMonthNum?>" selected><?=$toMonthFull?></option>
                    
                <?php } ?> 
                
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    
                    <div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">
                             
                    <select name="edu<?=$i?>end-year" class="cs-form_field selectyear" required <?=$disabled;?>>
                        
                        <option value="">Select Year</option>
                        
                <?php if($edu['present'] == NULL) { ?>
                    
                    <option value="<?=$toYearNum?>" selected><?=$toYearFull?></option>
                    
                <?php } ?>
                    
                    </select> 
                    <div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                    
                </div>
                
                
            </div>
            
            <div class="cs-height_30 cs-height_lg_30"></div>
            
            
        <?php   } } else {?>
        
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Course Name *</label> 
                    <input type="text" class="cs-form_field" name="edu1course" placeholder="Enter Course Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>University Name *</label>
                    <input type="text" class="cs-form_field" name="edu1university" placeholder="Enter University Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>From *</label>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                                                
							<select name="edu1start-month" class="cs-form_field" required>
								<option value="">Select Month</option>						
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							
							<div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">                             
                             
							<select name="edu1start-year" class="cs-form_field selectyear" required>
								<option value="">Select Year</option>
							</select> 
							<div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6 toedu"> 
                
                    <label>To 
                    &nbsp;
                    &nbsp;
                    <span class="text-center p-0 m-0" style="color: #e9204f;">
                        OR
                    </span>
                     &nbsp;
                     &nbsp;
                      
                     
                    <input type="checkbox" id="edu1currentworking" name="edu1currentworking" value="1" class="form-checkbox required form-check-input" onchange="toggleEduInput('1')"> 
                    
                    <span class="cs-font_10">I am currently pursuing this course</span></label> 
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        
							<select name="edu1end-month" class="cs-form_field" required>
								<option value="">Select Month</option>
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
                    
							<div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">
                             
							<select name="edu1end-year" class="cs-form_field selectyear" required>								
								<option value="">Select Year</option>								
							</select> 
							<div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                    
                </div>
                 
            </div>
        
        <?php  } ?>
            
            
            
        </div> <!-- Container Closed  -->
            
            <div class="row">
                
                
                <div class="col-lg-6 pt-4 text-right">
                    <div> 
                    
                        <a href="javascipt:void(0);" id="addEducationButton" class="addmorebtn"> <i class="fa fa-plus-circle"></i> Add More </a>
                     &nbsp; &nbsp; &nbsp; &nbsp; 
                        <button class="cs-btn cs-style1 small py-2" type="submit" name="UpdateEDU">
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
  
  
  
  <!-- Script -->
    <script src="/assets/js/plugins/jquery-3.6.0.min.js"></script>
  
  <script> 
        function toggleEduInput(eduNumber) {
            const checkbox = document.getElementById(`edu${eduNumber}currentworking`);
            const endmonth = document.getElementsByName(`edu${eduNumber}end-month`);
            const endyear = document.getElementsByName(`edu${eduNumber}end-year`);
            if (endmonth.length > 0) { // Check if any input elements were found
                const input = endmonth[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
            if (endyear.length > 0) { // Check if any input elements were found
                const input = endyear[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
        }
    </script> 
   
      
      <script>
          const startYear = 1950;
          const endYear = <?=date("Y");?>;
          const yearDropdowns = document.getElementsByClassName("selectyear");
         
            for (let dropdown of yearDropdowns ) {
              for (let year = endYear; year >= startYear; year--) {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;
                dropdown.appendChild(option);
              }
             }
        </script>
        
    
      
    <script>
         <?php
         if(isset($i) && $i != ''){ ?>
             let EducationCount = <?=$i?>;
         <?php } else { ?>
         let EducationCount = 1;
         <?php } ?>
       
        
        // Function to initialize datepicker
        function YearInitializer() {
            
            const startYear = 1950;
            const endYear = 2025;
            const yearDropdowns = document.getElementsByClassName("selectyear");
         
            for (let dropdown of yearDropdowns ) {
              for (let year = endYear; year >= startYear; year--) {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;
                dropdown.appendChild(option);
              }
             }
        }
        
        // Initialize datepicker for existing elements on page load
        $(document).ready(function() {
            YearInitializer();
        });
        

        document.getElementById('addEducationButton').addEventListener('click', function() {
            
            
            
        if(EducationCount >= <?=$addable_exp_count?>) {
            alert("Max <?=$addable_exp_count?> Allowed!");
        }else{
            EducationCount++;
            
            const educationContainer = document.getElementById('educationContainer');

            const educationGroup = document.createElement('div');
            educationGroup.className = 'education-group';
            educationGroup.id = `education${EducationCount}`;

            educationGroup.innerHTML = ` 
                <br> 
              
               <div class="row">
                <div class="col-sm-6">
                    <h6 class="mb-2 cs-font_20"> Education ${EducationCount} details: </h6>
                </div>
                 
                <div class="col-sm-6" style="text-align: right;">
                    <button type="button" class="deleteEducationButton btn btn-danger m-0" onclick="deleteEducation(${EducationCount})"> <i class="fa-solid fa-trash"></i> </button>
                </div> 
            </div>
                
                <hr>
            
             <div class="cs-height_20 cs-height_lg_20"></div>
              
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Course Name *</label> 
                    <input type="text" class="cs-form_field" name="edu${EducationCount}course" placeholder="Enter Course Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>University Name *</label>
                    <input type="text" class="cs-form_field" name="edu${EducationCount}university" placeholder="Enter University Name *" autocomplete="off" required="">
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
              
                <div class="col-md-6"> 
                    <label>From *</label>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                                                
							<select name="edu${EducationCount}start-month" class="cs-form_field" required>
								<option value="">Select Month</option>						
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							
							<div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">                             
                             
							<select name="edu${EducationCount}start-year" class="cs-form_field selectyear" required>
								<option value="">Select Year</option>
							</select> 
							<div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6 toedu"> 
                
                    <label>To 
                    &nbsp;
                    &nbsp;
                    <span class="text-center p-0 m-0" style="color: #e9204f;">
                        OR
                    </span>
                     &nbsp;
                     &nbsp;
                      
                     
                    <input type="checkbox" id="edu${EducationCount}currentworking" name="edu${EducationCount}currentworking" value="1" class="form-checkbox required form-check-input" onchange="toggleEduInput('${EducationCount}')"> 
                    
                    <span class="cs-font_10">I am currently pursuing this course</span></label> 
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        
							<select name="edu${EducationCount}end-month" class="cs-form_field" required>
								<option value="">Select Month</option>
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
                    
							<div class="cs-height_20 cs-height_lg_20"></div>       
                            
                        </div>
                        <div class="col-md-6">
                             
							<select name="edu${EducationCount}end-year" class="cs-form_field selectyear" required>								
								<option value="">Select Year</option>								
							</select> 
							<div class="cs-height_20 cs-height_lg_20"></div>
                           
                        </div>
                    </div>
                    
                    
                </div>
                 
            </div>
            
            <div class="cs-height_30 cs-height_lg_30"></div>
              
            `;

            educationContainer.appendChild(educationGroup);
            
            YearInitializer();
            
            
            } //if less than 3
            
        });
         function deleteEducation(educationNumber) {
            const educationGroup = document.getElementById(`education${educationNumber}`);
            educationGroup.remove();
             
            EducationCount--;
             
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