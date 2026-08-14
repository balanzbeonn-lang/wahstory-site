<?php 
    session_start(); 

    include('../../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        echo '<script>window.location.href="/login.php"</script>';
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
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
    
  <title>Update Story | <?=$Userrow['name']?></title>
  
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
      
    button:disabled {
        background: #383838 !important;
        border-color: #383838 !important;
        cursor: not-allowed !important;
        color: #918b8b !important;
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
    
    #toolbar {
      background-color: #2a2a2a;
        border: 1px solid #000000;
        padding: 6px;
        border-radius: 10px;
        box-shadow: 0 5px 11px rgb(0 0 0);
        z-index: 999999;
        position: relative;
        margin-bottom: -2px;
    }
    #toolbar button, #toolbar select {
      border: none;
      background: none;
      margin: 2px;
      padding: 5px 10px;
      cursor: pointer;
      font-size: 14px;
      border-radius: 5px;
      color: #cdc9c9;
    }
    #toolbar button:hover, #toolbar select:hover {
      background-color: #4a4646;
    }
    #editor {
      border: 1px solid #ddd;
      padding: 10px;
      min-height: 200px;
      overflow-y: auto;
      margin-top: 10px;
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
                <h4 class="mb-2">Update Your Story</h4>
                <a href="/users/user.profile.php" style="color: #e9204f;" class="h3"><i class="fa fa-times"></i></a>
              </div>
              
              
              <hr class="mb-4">
            </div>
            
        <form id="updateprofile" action="" enctype="multipart/form-data" method="post"> 
        
        <div id="storyContainer">
        
        <?php 
        
        $story = $postObj->GetUserClubStoryById($Userrow['ClubId']);
        
         if($story != '') {
             
        ?>
        
            <input type="hidden" value="<?=$story['id'];?>" name="storyid">
        
            
             <div class="cs-height_20 cs-height_lg_20"></div>
        
            
            <div class="row"> 
                <div class="col-md-12 col-lg-12">
                  <div class="form_group">
                    <label>Story Title: (Max 10 Words) </label>
                        <input type="text" class="cs-form_field" name="currentTitle" value="<?=htmlspecialchars($story['title'])?>" id="currentstorytitle" placeholder="Give a title to your story*" oninput="checkWordLen(this, 10)" onblur="truncateExcess(this, 10)" required="">
                        <p class="word-counter success">0/10 Words</p>
                    
                  </div>
                  <div class="cs-height_30 cs-height_lg_40"></div>
                  
                </div>
                
        <?php 
            if($story['storycontent'] != NULL) {
        ?>
            
                <div class="col-md-12 col-lg-12">
                        
                    <div class="form_group">
                        
                        <div id="toolbar">
                            <button type="button" onclick="formatText('bold')"><b>B</b></button>
                            <button type="button" onclick="formatText('italic')"><i>I</i></button>
                            <button type="button" onclick="formatText('underline')"><u>U</u></button>
                            <button type="button" onclick="formatText('strikeThrough')">S</button>
                            <button type="button" onclick="formatText('justifyLeft')">Left</button>
                            <button type="button" onclick="formatText('justifyCenter')">Center</button>
                            <button type="button" onclick="formatText('justifyRight')">Right</button>
                            <button type="button" onclick="formatText('insertUnorderedList')">• List</button>
                            <button onclick="formatText('insertOrderedList')">1. List</button>
                            <button onclick="addLink()">Link</button>
                            <select onchange="setHeading(this.value)">
                                <option value="">Heading</option>
                                <option value="H1">H1</option>
                                <option value="H2">H2</option>
                                <option value="H3">H3</option>
                                <option value="H4">H4</option>
                                <option value="H5">H5</option>
                                <option value="H6">H6</option>
                            </select>
                        </div>
                        
                        
                        <textarea id="currentstory" rows="5" class="cs-form_field" placeholder="Story Content" autocomplete="off" required=""><?=$story['storycontent'];?></textarea> 
                        
                    </div>
                    
                    <div class="cs-height_30 cs-height_lg_40"></div>
                    
                </div>
            
        
        <?php } else {?>
        
        <!--If Full Story Not Available-->
        
                <div class="col-md-12 col-lg-12">
                    
                    <div class="form_group">
                        <label>1.  What important skills do you think have helped you succeed, and how did you develop them during your journey? </label>
                        <textarea name="ques1" id="ques1" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""><?=$story['q1'];?></textarea>
                        <p class="word-counter success">0/250 Words</p> 
                            
                    </div>
                    <div class="cs-height_30 cs-height_lg_40"></div>
                    
                </div>
                
                <div class="col-md-12 col-lg-12">
                    <div class="form_group">
                        <label>2. How do you deal with tough times, and what have you learned from getting through difficult situations? </label>
                        
                        <textarea name="ques2" id="ques2" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""><?=$story['q2'];?></textarea>
                        <p class="word-counter success">0/250 Words</p>
                    </div>
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
                <div class="col-md-12 col-lg-12">
                    <div class="form_group">
                        <label>3. How do you think you've made a difference in your work, community, or in other people's lives? </label>
                        
                        <textarea name="ques3" id="ques3" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""><?=$story['q3'];?></textarea>
                        <p class="word-counter success">0/250 Words</p>
                            
                    </div>
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
                <div class="col-md-12 col-lg-12">
                    <div class="form_group">
                        <label>4. Can you recall a pivotal point in your journey where you felt you had reached a significant milestone in success?
                        </label>
                        
                        <textarea name="ques4" id="ques4" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""><?=$story['q4'];?></textarea>
                        <p class="word-counter success">0/250 Words</p>
                    </div>
                    
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
                <div class="col-md-12 col-lg-12">
                    <div class="form_group">
                        <label>5. How do you define success, and what goals have you set for yourself to achieve it? </label>
                        
                        <textarea name="ques5" id="ques5" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""><?=$story['q5'];?></textarea>
                        <p class="word-counter success">0/250 Words</p>
                    </div>
                    <div class="cs-height_30 cs-height_lg_40"></div>
                </div>
                
        <?php } ?>
                
                
            </div>
            
            
            <div class="row">
                
                <div class="col-lg-12 pt-4 text-right">
                     
                    <button class="cs-btn cs-style1 small py-2" type="button" name="UpdateBLOG" id="UPDATEStory"> 
                        <span>Update Now</span>
                    </button>
                      
                </div>
            </div>
            
            
            <div class="cs-height_30 cs-height_lg_30"></div>
            
        <?php   } else {
            //If user has not updated the story in WAHClub
        ?>
        
        
            <?php
            
            // Check if user has the story in WAHStory
            
            if($Storyrow != NULL) {
                //User Old Story
            ?>   
                    
                    <div class="col-md-12 col-lg-12"> 
                        <div class="form_group">
                            <label>Story Title: (Max 10 Words) </label>
                            <input type="text" class="cs-form_field" name="currentTitle" id="currentstorytitle" placeholder="Give a title to your story*" oninput="checkWordLen(this, 10)" onblur="truncateExcess(this, 10)" value="<?=$Storyrow['title'];?>">
                            <p class="word-counter success">0/10 Words</p>
                            
                        </div>
                        
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                    
                    <div class="col-md-12 col-lg-12">
                            
                        <div class="form_group">
                            
                            <div id="toolbar">
                                <button type="button" onclick="formatText('bold')"><b>B</b></button>
                                <button type="button" onclick="formatText('italic')"><i>I</i></button>
                                <button type="button" onclick="formatText('underline')"><u>U</u></button>
                                <button type="button" onclick="formatText('strikeThrough')">S</button>
                                <button type="button" onclick="formatText('justifyLeft')">Left</button>
                                <button type="button" onclick="formatText('justifyCenter')">Center</button>
                                <button type="button" onclick="formatText('justifyRight')">Right</button>
                                <button type="button" onclick="formatText('insertUnorderedList')">• List</button>
                                <button onclick="formatText('insertOrderedList')">1. List</button>
                                <button onclick="addLink()">Link</button>
                                <select onchange="setHeading(this.value)">
                                    <option value="">Heading</option>
                                    <option value="H1">H1</option>
                                    <option value="H2">H2</option>
                                    <option value="H3">H3</option>
                                    <option value="H4">H4</option>
                                    <option value="H5">H5</option>
                                    <option value="H6">H6</option>
                                </select>
                            </div>
                            
                            <textarea id="oldstory" rows="5" class="cs-form_field" placeholder="Story Content" autocomplete="off" required=""><?=$Storyrow['content'];?></textarea> 
                            
                        </div>
                        
                        <div class="cs-height_30 cs-height_lg_40"></div>
                        
                    </div>
                
                
            
            <?php
            
            } else {
                //Write a new Story
            ?>
            
            
                
                <div class="row"> 
                    
                    <div class="col-md-12 col-lg-12"> 
                        <div class="form_group">
                            <label>Story Title: (Max 10 Words) </label>
                            <input type="text" class="cs-form_field" name="currentTitle" id="currentstorytitle" placeholder="Give a title to your story*" oninput="checkWordLen(this, 10)" onblur="truncateExcess(this, 10)">
                            <p class="word-counter success">0/10 Words</p>
                            
                        </div>
                        
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                
                </div>
                
                <div class="row" id="rawwrittenstory"> 
                    
                    
                    <div class="col-md-12 col-lg-12">
                        
                        <div class="form_group">
                            <label>1.  What important skills do you think have helped you succeed, and how did you develop them during your journey? </label>
                            <textarea name="ques1" id="ques1" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""></textarea>
                        <p class="word-counter success">0/250 Words</p> 
                                
                        </div>
                        <div class="cs-height_30 cs-height_lg_40"></div>
                        
                    </div>
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="form_group">
                            <label>2. How do you deal with tough times, and what have you learned from getting through difficult situations? </label>
                            
                            <textarea name="ques2" id="ques2" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""></textarea>
                            <p class="word-counter success">0/250 Words</p>
                        </div>
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="form_group">
                            <label>3. How do you think you've made a difference in your work, community, or in other people's lives? </label>
                            
                            <textarea name="ques3" id="ques3" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""></textarea>
                            <p class="word-counter success">0/250 Words</p>
                                
                        </div>
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="form_group">
                            <label>4. Can you recall a pivotal point in your journey where you felt you had reached a significant milestone in success?
                            </label>
                            
                            <textarea name="ques4" id="ques4" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""></textarea>
                            <p class="word-counter success">0/250 Words</p>
                        </div>
                        
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="form_group">
                            <label>5. How do you define success, and what goals have you set for yourself to achieve it? </label>
                            
                            <textarea name="ques5" id="ques5" rows="5" class="cs-form_field editableTextarea" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)" required=""></textarea>
                            <p class="word-counter success">0/250 Words</p>
                        </div>
                        <div class="cs-height_30 cs-height_lg_40"></div>
                    </div>
                    
                </div>
            
            <?php } ?>
            
            <div class="row" id="aienhancedStory" style="display: none;">
                
                <div class="col-md-12 col-lg-12">
                    
                    <div class="form_group">
                        
                        <div id="toolbar">
                            <button type="button" onclick="formatText('bold')"><b>B</b></button>
                            <button type="button" onclick="formatText('italic')"><i>I</i></button>
                             <button type="button" onclick="formatText('underline')"><u>U</u></button>
                            <button type="button" onclick="formatText('strikeThrough')">S</button>
                            <button type="button" onclick="formatText('justifyLeft')">Left</button>
                            <button type="button" onclick="formatText('justifyCenter')">Center</button>
                            <button type="button" onclick="formatText('justifyRight')">Right</button>
                            <button type="button" onclick="formatText('insertUnorderedList')">• List</button>
                            <button onclick="formatText('insertOrderedList')">1. List</button>
                            <button onclick="addLink()">Link</button>
                            <select onchange="setHeading(this.value)">
                                <option value="">Heading</option>
                                <option value="H1">H1</option>
                                <option value="H2">H2</option>
                                <option value="H3">H3</option>
                                <option value="H4">H4</option>
                                <option value="H5">H5</option>
                                <option value="H6">H6</option>
                            </select>
                        </div>
                        
                        <textarea id="aigeneratedstory" rows="5" class="cs-form_field" placeholder="Story Content" autocomplete="off" required=""></textarea> 
                        
                    </div>
                    
                    <div class="cs-height_30 cs-height_lg_40"></div>
                    
                </div>
                
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-12 pt-4 text-right">
                     
                    <button class="cs-btn cs-style1 small py-2" type="button" name="UpdateBLOG" id="UPDATEStory"> 
                        <span>Update Now</span>
                    </button>
                     <button type="button" class="cs-btn cs-style1 small py-2"  id="generateStoryBtn" style="display: none;">Enhance Your Story With AI</button>
                    <div id="cs-result"></div>
                     
                </div>
            </div>
            
        
        <?php  } ?>
        
            
        </div> <!-- Container Closed  -->
            
            
          
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
  function formatText(command) {
    document.execCommand(command, false, null);
  }

  function addLink() {
    const url = prompt("Enter the URL:");
    if (url) {
      document.execCommand("createLink", false, url);
    }
  }

  function setHeading(heading) {
    if (heading) {
      document.execCommand("formatBlock", false, heading);
    }
  }
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showSuccessAlert() {
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Updated Successfully!',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                  popup: 'swal-success-alert'
                  
                }
              });
            }
            
            
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
            
            
            <?php if(isset($_GET['sucmsg'])){ ?>
                showSuccessAlert();
            <?php } ?>
             
            
    </script>
    
    <script>
    
    let storyEditor; 
    
    if (document.querySelector('#currentstory')) {
        ClassicEditor
            .create(document.querySelector('#currentstory'), {
                toolbar: true
            })
            .then(editor => {
                storyEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
     
    
    let AIstoryEditor; 
    let OldstoryEditor; 
    
    if (document.querySelector('#oldstory')) {
        ClassicEditor
            .create(document.querySelector('#oldstory'), {
                toolbar: true
            })
            .then(editor => {
                OldstoryEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
    
    
    $('#UPDATEStory').click(function() { 
            
        $(this).html("<i class='fa-solid fa-spinner fa-spin'></i> &nbsp; Submiting");
        
        var formElement = document.getElementById('updateprofile');
        var formData = new FormData(formElement);
        
    if (storyEditor) {
        var storyCONTENT = storyEditor.getData();
        formData.append('storycontent', storyCONTENT);
        
    } else if(AIstoryEditor) {
        var storyCONTENT = AIstoryEditor.getData();
        formData.append('storycontent', storyCONTENT);
    
    } else if(OldstoryEditor) {
        var storyCONTENT = OldstoryEditor.getData();
        formData.append('storycontent', storyCONTENT);
    }
        
 
         $.ajax({
            url: 'inc/update_story.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    console.error("Invalid JSON response:", response);
                }

                if (response.status === 'success') {
                    $('#UPDATEStory').html("Updated &nbsp; <i class='fa-solid fa-check '></i>");
                    
                    setInterval(function(){
                        $('#UPDATEStory').html("Updated Now");
                    }, 3000);
                    
                    window.location.href="update.story.php?sucmsg=Updated Successfully!";
                    
                } else {
                    $('#UPDATEStory').html("Update Now");
                    showErrorAlert();
                    
                }
            },
            error: function(xhr) {
                // Handle error
                alert('Error: ' + (xhr.responseJSON?.message || "An error occurred"));
            }
        });
    });
    
    </script>
    
    
    <script>
     $(document).ready(function() {
         
        $('#ques5').on('input', function() {
            $('#generateStoryBtn').show(); 
        });
        
        <?php if($Storyrow != NULL) { ?> 
            $('#generateStoryBtn').show();
        <?php } ?>
          
        $('#generateStoryBtn').click(function() { 
            $(this).html("Enhancing Your Story &nbsp; <i class='fa-solid fa-spinner fa-spin'></i> ");
            
            
            if (OldstoryEditor) {
                var allques = OldstoryEditor.getData(); 
                
            } else {
                
                var q1 = document.getElementById('ques1').value;
                var q2 = document.getElementById('ques2').value;
                var q3 = document.getElementById('ques3').value;
                var q4 = document.getElementById('ques4').value;
                var q5 = document.getElementById('ques5').value;
                
                var allques = '<p>' + q1 + '</p> <p>' + q2 + '</p> <p>' + q3 + '</p> <p>' + q4 + '</p> <p>' + q5 + '</p>';
                
            }
               
               $("#generateStoryBtn").attr("disabled", true)
               
             $.ajax({
                url: 'inc/enhancestorybyai.php',
                type: 'POST',
                data: {content: allques},
                success: function(response) {
                   
                    if (response.status === 'success') {
                        0
                        
                        $('#rawwrittenstory').hide();
                        
                        $('#aienhancedStory').show(); 
                        
                        
                        if (document.querySelector('#oldstory')) {
                            $('#oldstory').hide();
                        }
                      
                    if (document.querySelector('#aigeneratedstory')) {   
                            ClassicEditor
                            .create(document.querySelector('#aigeneratedstory'), {
                                toolbar: true
                            })
                            .then(editor => {
                                const generatedContent = response.story;
                                editor.setData(generatedContent);
                                AIstoryEditor = editor;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                            
                        $('#currentstorytitle').val(response.title);
                        
                        $('#generateStoryBtn').remove();
                        
                        
                    } else if (response.status === 'error') {
                        console.log("Something Went Wrong! Error");
                    }else {
                        console.log("Something Went Wrong!!!");
                    }
                },
                error: function(xhr) {
                    // Handle error
                    alert('Error: ' + (xhr.responseJSON?.message || "An error occurred"));
                }
            });
            
            
        });
        
    });
    
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