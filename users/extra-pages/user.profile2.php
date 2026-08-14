<?php 
session_start(); 
    include('../inc/functions.php');
    $postObj = new Story();
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{
            header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']);
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    if(isset($_POST['UpdateProfilePic'])){
        
        $ResponsePic = $postObj->UpdateProfilePic($_SESSION['userid']);
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
    
  <title>My Profile | <?=$Userrow['name']?></title>
  
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
        /* Original styles */
        .tj-header-area .header-menu {
            margin-left: inherit;
        }
        .tj-header-area .header-button {
            margin-left: inherit;
        }
        .hero-section::before {
            content: none;
        }
        .view-more-btn:hover {
            background-color: #f12b59;
            color: #fff; 
        }
        .view-more-btn {
            color: #f12b59; 
            text-decoration: none;
            border: 1px solid #f12b59;
            padding: 5px 14px;
            border-radius: 15px;
            font-size: 13px;
            transition: background .25s ease, color .25s ease;
        }
        .section-header .section-title {
            background-color: #fff;
        }

        /* Enhanced profile styles */
        body {
            font-size: 14px;
            line-height: 1.4;
        }
        
        .container {
            margin-left: 60px;
            padding: 10px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .profile-section {
            display: flex;
            gap: 10px;
            padding: 15px;
            margin-top: 10px;
            background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: linear-gradient(145deg, rgb(25 24 24) 0%, rgb(37 36 36) 100%);
            color: white;
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .profile-card, .info-card {
            flex: 1;
            padding: 15px;
            position: relative; 
        }
        
        .profile-card img {
            width: 120px;
            height: 120px;
            border: 4px solid #f12b59;
            padding: 3px;
            transition: transform 0.3s ease;
            border-radius: 50%;
        }

        .profile-card img:hover {
            transform: scale(1.05);
        }
        
        .skill-tag {
            background: linear-gradient(135deg, #f12b59 0%, #f65d82 100%);
            color: white;
            border: none;
            padding: 4px 8px;
            margin: 2px;
            border-radius: 20px;
            font-size: 0.85em;
            transition: transform 0.2s ease;
        }

        .skill-tag:hover {
            transform: scale(1.5);
        }

        /* Education timeline */
        .education-timeline {
            display: flex;
            overflow-x: auto;
            padding: 15px 0;
            gap: 15px;
        }
        
        .education-item {
            border-top: 2px solid #f12b59;
            padding: 15px;
            margin: 0;
            min-width: 250px;
            flex: 0 0 auto;
            position: relative;
        }
        
        .education-item::before {
            content: '';
            width: 10px;
            height: 10px;
            background: #f12b59;
            border-radius: 50%;
            position: absolute;
            left: 20px;
            top: -6px;
        }

        /* Timeline styles */
        .timeline {
            display: flex;
            overflow-x: auto;
            padding: 15px 0;
            gap: 15px;
        }

        .timeline-item {
            border-top: 2px solid #f12b59;
            padding: 15px;
            margin: 0;
            min-width: 250px;
            flex: 0 0 auto;
            position: relative;
            transition: transform 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateY(-5px);
        }

        .timeline-item::before {
            content: '';
            width: 10px;
            height: 10px;
            background: #f12b59;
            border-radius: 50%;
            position: absolute;
            left: 20px;
            top: -6px;
        }

        /* Projects area */
        .project-card {
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px;
        }

        /* Grid container */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            padding: 10px;
        }

        /* Dropdown styles for Awards and Testimonials */
        .dropdown-section {
            margin-bottom: 10px;
        }
        
        .dropdown-toggle {
            width: 100%;
            text-align: left;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .dropdown-content {
            display: none;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0 0 8px 8px;
            margin-top: -5px;
        }
        
        .dropdown-content.active {
            display: block;
        }

        /* Reduced spacing */
        h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        h5 {
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }
        
        p {
            margin-bottom: 0.3rem;
        }
        
        .card-body {
            padding: 10px;
        }

        /* Edit button styles */
        .edit-button {
            background: transparent;
            border: 1px solid #f12b59;
            color: #f12b59;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .edit-button:hover {
            background: #f12b59;
            color: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
            }
            .container {
                margin-left: 20px;
                margin-right: 20px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 
 <?php include('breadcrump.php');?>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs-shop_sidebar">
          
          <div class="cs-shop_sidebar_widget">
            <?php $Dmenu = 3;?>
            <?php include('user.leftmenu.php');?>
          </div>
           
        </div>
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
        <div class="row">
            <div class="col-sm-12"> 
                
                
                <!-- Profile Section -->
                <div class="profile-section">
                    <div class="profile-card card">
                        <button class="edit-button">Edit</button> 
                        <img src="/images/users/<?=$Userrow['profile_image']?>">
                        <h4 class="mt-3"><?=$Userrow['name'];?></h4>
                        <p>My Current Position</p>
                        <p><strong>Email:</strong> <?=$Userrow['email'];?></p>
                        <p><strong>Phone:</strong> <?=$Userrow['phone'];?></p>
                    </div>
                    <div class="profile-card card">
                        <div class="mt-4">
                           <h4>Your WAHStory</h4>
                                <div class="story-title-area p-3 mt-3" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                <h5>Story Title</h5>
                <p class="text-white-50">Nidhi Mathur - Founder And Director At Future Fit LLP | Franchise owner at Cult Fit</p>
                                </div>
            <div class="text-center mt-4">
                <a href="#" class="view-more-btn">Read Full Story</a>
            </div>
        </div>
    </div>
                </div>
<div class="card">
    <div class="card-body">
        <div class="section-header">
            <h4>Skills & Tools</h4>
            <button class="edit-button">Edit</button>
        </div>
        
        <div class="mb-4">
            <h5>Core Skills</h5>
            <div class="skill-tags">
                <span class="skill-tag">Web Development</span>
                <span class="skill-tag">UI/UX Design</span>
                <span class="skill-tag">System Integration</span>
                <span class="skill-tag">React</span>
                <span class="skill-tag">Vue.js</span>
            </div>
        </div>
        
        <div class="mb-4">
            <h5>Your Traits</h5>
            <div class="skill-tags">
                <span class="skill-tag">Web Development</span>
                <span class="skill-tag">UI/UX Design</span>
                <span class="skill-tag">System Integration</span>
                <span class="skill-tag">React</span>
            </div>
        </div>
        
        <div>
            <h5>Your Tools</h5>
            <div class="skill-tags">
                <span class="skill-tag">Web Development</span>
                <span class="skill-tag">UI/UX Design</span>
                <span class="skill-tag">System Integration</span>
                <span class="skill-tag">React</span>
                <span class="skill-tag">Vue.js</span>
                <span class="skill-tag">Vue.js</span>
            </div>
        </div>
    </div>
</div>
                <!-- Education Section -->
                <div class="card">
                    <div class="card-body">
                        <div class="section-header">
                            <h4>Education</h4>
                            <button class="edit-button">Edit</button>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <h5>Bachelor of Technology</h5>
                                <p>2018 - 2022</p>
                                <p>Computer Science Engineering</p>
                            </div>
                            <div class="timeline-item">
                                <h5>Higher Secondary</h5>
                                <p>2016 - 2018</p>
                                <p>Science Stream</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Experience -->
                <div class="card">
                    <div class="card-body">
                        <div class="section-header">
                            <h4>Work Experience</h4>
                            <button class="edit-button">Edit</button>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <h5>WAHStory</h5>
                                <p>Developer (2024-11-01 - Present)</p>
                                <p>Web development and system integration</p>
                            </div>
                            <div class="timeline-item">
                                <h5>ELEMENTS</h5>
                                <p>Designer (2024-08-01 - 2024-12-01)</p>
                                <p>UI/UX design and frontend development</p>
                            </div>
                            <div class="timeline-item">
                                <h5>Google</h5>
                                <p>SEO Specialist (2021-06-01 - 2022-07-01)</p>
                                <p>Search engine optimization and analytics</p>
                            </div>
                        </div>
                    </div>
                </div>
                     
                <!-- Projects Section -->
                <div class="card">
                    <div class="card-body">
                        <div class="section-header">
                            <h4>Projects</h4>
                            <button class="edit-button">Edit</button>
                        </div>
                        <div class="grid-container">
                            <div class="project-card">
                                <h5>Web Designing Project</h5>
                                <p>Status: In Progress - 2 Days Left</p>
                            </div>
                            <div class="project-card">
                                <h5>Mobile App Development</h5>
                                <p>Status: Testing Phase - 5 Days Left</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Awards & Testimonials -->
                <div class="grid-container">
                    <div class="card">
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Awards</h4>
                                <button class="edit-button">Edit</button>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Best Developer Award - WAHStory
                                </button>
                                <div class="dropdown-content">
                                    <p>WAHStory - 2024</p>
                                </div>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Innovation Excellence - ELEMENTS
                                </button>
                                <div class="dropdown-content">
                                    <p>ELEMENTS - 2024</p>
                                </div>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Innovation Excellence - ELEMENTS
                                </button>
                                <div class="dropdown-content">
                                    <p>ELEMENTS - 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="section-header">
                                <h4>Testimonials</h4>
                                <button class="edit-button">Edit</button>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Project Manager, WAHStory
                                </button>
                                <div class="dropdown-content">
                                    <p>"Excellent work ethic and technical skills"</p>
                                </div>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Lead Designer, ELEMENTS
                                </button>
                                <div class="dropdown-content">
                                    <p>"Innovative approach to problem-solving"</p>
                                </div>
                            </div>
                            <div class="dropdown-section">
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                                    Lead Designer, ELEMENTS
                                </button>
                                <div class="dropdown-content">
                                    <p>"Innovative approach to problem-solving"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- blog-Section -->
                <div class="card">
                    <div class="card-body">
                        <div class="section-header">
                            <h4>Blogs</h4>
                            <button class="edit-button">Edit</button>
                        </div>
                        <div class="grid-container">
                            <div class="project-card">
                                <h5>Nature Project</h5>
                                <p>Testing Phase - 5 Days Left</p>
                            </div>
                            <div class="project-card">
                                <h5>website Development</h5>
                                <p>Testing Phase - 5 Days Left</p>
                            </div>
                            <div class="project-card">
                                <h5>App Development</h5>
                                <p>Status: Testing Phase - 5 Days Left</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
             
                
            </div>
             
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Get all the fade-item elements
      const fadeItems = document.querySelectorAll(".fade-item");
    
      // Set initial state
      let currentItemIndex = 0;
      fadeItems[currentItemIndex].style.opacity = "1";
    
      // Function to handle fading and showing next item
      function fadeNextItem() {
        fadeItems[currentItemIndex].style.opacity = "0";
        currentItemIndex = (currentItemIndex + 1) % fadeItems.length;
        fadeItems[currentItemIndex].style.opacity = "1";
      }
      // Start the automatic fading after a certain interval (e.g., every 3 seconds)
      setInterval(fadeNextItem, 3000);
    });
  </script>
  
  
<!-- Modal -->
<div class="modal fade" id="ProfilePicModal" tabindex="-1" aria-labelledby="ProfilePicModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
 <form class="row" action="" method="POST" enctype="multipart/form-data">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="ProfilePicModalLabel">
            <div class="dash-item-box-inner" style="color: #181818;">
                <div class="icon-cover" style="background: #e9204f;">
                    <i class="fa fa-image"></i>
                </div> &nbsp; &nbsp;
                <span style="font-size: 18px;">Update Profile Picture</span>
            </div>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       
            <div class="col-lg-12">
                <div class="form-group">
                <label for="profilePicFile" class="text-dark">Select Image</label><br>
                 <input type="file" name="file" id="profilePicFile"  accept=".jpg, .png, .webp, .jpeg" class="text-dark form-control" required>
                </div>
            </div>
             
       
       
      </div>
      <div class="modal-footer py-1" style="justify-content: space-between; color: #181818">
        <button type="submit" name="UpdateProfilePic" class="cs-btn cs-style1 spotbtns text-right">UPDATE</button>
      </div>
      
    </form>
    
    </div>
  </div>
</div>
  
  <!-- Start CTA -->
  <?php include('../footer.php');?>