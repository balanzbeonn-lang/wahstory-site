<?php 
    session_start();
    include __DIR__ . '/../../inc/functions.php';
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        echo '<script>window.location.href="/login.php"</script>';
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>Update Quicks | <?=$Userrow['name']?></title>
  
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
         font-size: 12px;
         margin-bottom: 5px;
     }
     form#updateprofile .cs-form_field{
         padding: 8px 20px;
     }
     .swal2-timer-progress-bar-container {
         background: #a5dc86;
     }
     .swal2-title {
         color: #2c6a09;
     }
     
     .swal2-timer-progress-bar {
         background: rgba(0, 0, 0, .4);
     }
     
     input:disabled {
        background: #383838 !important;
        border-color: #383838;
        cursor: not-allowed;
    }
    
    
    
    .select2-container{
        width: 100% !important;
      }
     
     .select2-container--default .select2-selection--multiple {
		background-color: #181818 !important;
		border: 2px solid #999696 !important;
		border-radius: 15px  !important;
	
	}
	
	.select2-results__options {
		background: #181818 !important;
	}
	
	.select2-container--default .select2-results__option--selected {
		background-color: #000000 !important;
	}
	
	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
		padding: 2px 4px  !important;
		    color: #ffffff  !important;
		    border-right: 1px solid #6c6969;
	}
	
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #000000  !important;
		border: 2px solid #000000  !important;
		padding: 2px  !important;
		padding-left: 25px !important;
	}
	
	.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
		color: #e6e3e3  !important;
	}
	.select2-container .select2-search--inline .select2-search__field {
	    height: 35px !important;
        line-height: 35px;
	}
	.select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below {
	    border: 2px solid #333 !important;
        border-radius: 10px !important;
        padding: 0px 10px;
        background: #181818;
	}
     
     
     
    /* Loading Classes ############################################### */
    #UpdateYourInterest {
        height: 400px;
    }
    
     .step-section {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        transform: translateX(100%);
        opacity: 0;
        transition: transform 0.5s ease, opacity 0.5s ease;
        z-index: -1;
    }
    
    .step-section.active {
        transform: translateX(0);
        opacity: 1;
        z-index: 1;
    }
    
    .step-section.hidden {
        display: none;
    }
    .step-section.left {
        transform: translateX(-100%);
        opacity: 0;
    }
    
    button.loading {
        cursor: not-allowed;
        opacity: 0.5;
        text-transform: capitalize;
    }
    
    /* Loading Classes ############################################### */
 </style>
 
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
                            <h4 class="mb-2">Update Quick Details </h4>
                            <a href="/users/user.profile.php" class="cs-btn cs-style1 py-1">View Profile</a>
                            <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
                        </div>
                        
                        <hr class="mb-4" />
                    </div>
                        <p class="text-success" id="stepNotify" style="display: none"> <i class="fa-solid fa-circle-notch"></i> You're almost done! </p>
                    <div class="col-lg-12" style="position: relative; min-height: 400px;">
                        
                    
                        
    <?php if(isset($_GET['UpdateQuickProfile']) || $Userrow['ClubId'] == NULL) { ?>
        
        <div class="step-section p-4" id="QuickProfileForm">
           <form id="updateprofile" action="" enctype="multipart/form-data" method="POST">
               <input type="hidden" class="cs-form_field" name="savequickprofile" value="1"/>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Select Gender * </label>
                    <select class="cs-form_field" name="gender">
                        <?php if($Userrow['gender'] != ''){  ?>
                        <option value="<?=$Userrow['gender']?>"><?=$Userrow['gender']?></option>
                        <?php }else{ ?>
                        <option value="">Select Gender</option>
                        <?php } ?>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Star Sign</label>
                    <select class="cs-form_field" id="starsign" name="starsign">
                    <?php if(isset($Userrow['starsign']) && $Userrow['starsign'] != ''){ ?>
                        <option value="<?=$Userrow['starsign']?>"><?=$Userrow['starsign']?></option>
                        <?php } else { ?>
                        <option value="">Select Your Star Sign</option>
                        <?php } ?>
                        <option value="Aries">Aries</option>
                        <option value="Taurus">Taurus</option>
                        <option value="Gemini">Gemini</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Leo">Leo</option>
                        <option value="Virgo">Virgo</option>
                        <option value="Libra">Libra</option>
                        <option value="Scorpio">Scorpio</option>
                        <option value="Sagittarius">Sagittarius</option>
                        <option value="Capricorn">Capricorn</option>
                        <option value="Aquarius">Aquarius</option>
                        <option value="Pisces">Pisces</option>
                    </select>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                </div>
                <div class="col-md-6 mb-2">
                    <label>City *</label>
                    <input type="text" class="cs-form_field" name="city" placeholder="Enter Your City*" value="<?=$Userrow['city']?>" required="" />
                    <div class="cs-height_10 cs-height_lg_10"></div>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Select Country *</label>
                    <select class="cs-form_field" name="country">
                        <?php if($Userrow['country'] != ''){  ?>
                        <option value="<?=$Userrow['country']?>"><?=$Userrow['country']?></option>
                        <?php }else{ ?>
                        <option value="">Select Country</option>
                        <?php } ?>
    
                        <?php 
            $CountrySql = $postObj->getAllCountries(); foreach($CountrySql as $CountryRow){ ?>
                        <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
                        <?php } ?>
                    </select>
                    <div class="cs-height_20 cs-height_lg_20"></div>
                </div>
            </div> 
            <!--Row Ends-->
            <p class="text-success" id="SuccessMessage" style="display: none;"> <i class="fa fa-check"></i> Saved Successfully!</p>
            <p class="text-danger" id="ErrorMessage" style="display: none;"> Something Went Wrong, Submit Again.</p>
            <!-- Content -->
            <button class="cs-btn cs-style1 next-btn" type="button" id="SaveData">Save</button>
          </form>
          
        </div>
        
        
    <?php } elseif (isset($_GET['UpdateInterest']) && $Userrow['ClubId'] != NULL){ 
    ?>
        
        <div class="step-section" id="QuickProfileForm" style="display: none;">
            <form id="updateprofile" action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" class="cs-form_field" name="saveYourInterest" value="1"/>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label>Select the interests or hobbies that best describe you * </label>
                        <select id="MultipleHobbiesSelect" class="cs-form_field" name="Hobbies[]" multiple="multiple">
                            <?php
                            $selectedHobbies = $postObj->GetHobbyByUserId($Userrow['ClubId']); 
                            foreach ($selectedHobbies as $HobbyRow) { ?>
                            <option value="<?=$HobbyRow['hobby_id'];?>" selected>
                                <?=$HobbyRow['hobby'];?>
                            </option>
                            <?php 
                            }
                            $Hobbies = $postObj->GetWAHClubAllHobbies(); if($Hobbies != '') { foreach ($Hobbies as $hobby) { ?>
                            <option value="<?=$hobby['id'];?>"><?=$hobby['hobby'];?></option>
                            <?php }
                            } 
                        ?>
                        </select>
                    </div>
        
                    <div class="col-md-12 mt-4 mb-2">
                        <label>Pick the sports you're into or love playing * </label>
                        <select id="MultipleSportsSelect" class="cs-form_field" name="sports[]" multiple="multiple">
                            <?php
                            $selectedHobbies = $postObj->GetHobbyByUserId($Userrow['ClubId']); 
                            foreach ($selectedHobbies as $HobbyRow) { ?>
                            <option value="<?=$HobbyRow['hobby_id'];?>" selected>
                                <?=$HobbyRow['hobby'];?>
                            </option>
                            <?php 
                            }
                            $Hobbies = $postObj->GetWAHClubAllHobbies(); if($Hobbies != '') { foreach ($Hobbies as $hobby) { ?>
                            <option value="<?=$hobby['id'];?>"><?=$hobby['hobby'];?></option>
                            <?php }
                            } 
                        ?>
                        </select>
                    </div>
                </div>
                <p class="text-success" id="SuccessMessage" style="display: none;"> <i class="fa fa-check"></i> Saved Successfully!</p>
                <p class="text-danger" id="ErrorMessage" style="display: none;"> Something Went Wrong, Submit Again.</p>
                <!-- Content -->
                <button class="cs-btn cs-style1 next-btn" type="button" id="SaveData">Save</button>
            </form>
        </div>
    <?php }?>
        
        
       
                            
                    </div>
                         
                   
                </div>
                <!-- Row Ends-->
            </div>
             
        </div>
        
     
    </div>
  
  </div>
    <div class="cs-height_50 cs-height_lg_80"></div>
  
    <script src="/assets/js/plugins/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <script> 
         $(document).ready(function() {          
    
             $('#MultipleHobbiesSelect').select2({
              tags: false,
                placeholder: "Search any hobby *", // Set the placeholder text
              width: 'resolve', // Adjust width to fit container
              maximumSelectionLength: 3,
              language: {
                    maximumSelected: function () {
                        return "You can only select 3 hobbies"; // Custom message
                    }
                }
             });
             
             $('#MultipleSportsSelect').select2({
              tags: false,
                placeholder: "Search any sport *", // Set the placeholder text
              width: 'resolve', // Adjust width to fit container
              maximumSelectionLength: 3,
              language: {
                    maximumSelected: function () {
                        return "You can only select 3 sports"; // Custom message
                    }
                }
             });
            
            $('.step-section').hide().removeClass('active');
            $('#QuickProfileForm').show().addClass('active');
            
         });
        </script>
        
        
        <script>
            const submitButton = document.getElementById('SaveData');
            const updateprofileForm = document.getElementById('updateprofile');
            const SuccessMessage = document.getElementById('SuccessMessage');
            const ErrorMessage = document.getElementById('ErrorMessage');
            
            submitButton.addEventListener('click', function () {
                $(this).addClass('loading');
                $(this).text('Saving...');
                
                const formData = new FormData(updateprofileForm);
                const data = {};
            
                const hobbies = document.getElementById("MultipleHobbiesSelect");
                if (hobbies) {
                    data["Hobbies[]"] = Array.from(hobbies.selectedOptions).map(option => option.value);
                }

                formData.forEach((value, key) => {
                    if (key !== "Hobbies[]") {  // Avoid overwriting the hobbies field
                        data[key] = value;
                    }
                });
                  
                // Send data to the server
                fetch('post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') { 
                        SuccessMessage.style.display = 'block';
                        ErrorMessage.style.display = 'none';
                        window.location.href= result.rurl;
                        $('#stepNotify').text("You're almost done!")
                    } else { 
                        SuccessMessage.style.display = 'none';
                        ErrorMessage.style.display = 'block';
                        ErrorMessage.textContent = result.message;
                        console.log('Error:', result.message);
                    }
                })
                .catch((error) => {
                    SuccessMessage.style.display = 'none';
                    ErrorMessage.style.display = 'block';
                    console.error('Error:', error); 
                });
            });

        </script>
    </body>
</html>