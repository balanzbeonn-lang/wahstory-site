<?php 
session_start(); 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../inc/functions.php');
    $postObj = new Story();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: /login.php');
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
    
  <title>My Availability | <?=$Userrow['name']?></title>
  
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
  
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
     
     .cs-font_11{
	    font-size: 11px;
	}
	.cs-style2:hover{
	    background: #043b46;
	    color: #1ab5d5;
	}
	.cs-style2{
	    border: 1px solid #02abd1;
	    border-radius: 15px;
        background: #065a6c;
	}
	 .n-close{
	     position: absolute;
        right: 10px;
        display: flex;
        align-items: center;
        top: 0;
        height: 100%;
	 }
       
       .weekdays{
            list-style: none;
        }
       .weekdays li{
            display: inline-block;
            margin: 4px 4px; 
        }
        .weekdays li .cs-btn{ 
            padding: 3px 20px;
        }
        
        .edit-button {
            background: transparent;
            border: 1px solid #f12b59;
            color: #f12b59;
            padding: 0px 10px;
            line-height: 17px;
            border-radius: 15px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
 </style>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.css">

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/libs/jsPDF/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/export/bootstrap-table-export.min.js"></script>
    
 <?php include('../header.php');?>
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
                    <?php $Dmenu = 13;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
           
        </div>
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row">
              <?php if(isset($EMSG) && $EMSG != ""){ ?>
                <p style="color: #e9204f;">
                    <?=$EMSG?>
                </p>
            <?php } ?>
            <?php if(isset($SMSG) && $SMSG != ""){ ?>
                <p style="color: #40c985;">
                    <?=$SMSG?>
                </p>
            <?php } ?> 
            
            <div class="col-sm-12"> 
                
                
                <div class="row">
                    
                    <div class="col-sm-12 col-lg-12 position-relative">
                        <h4 class="mb-2 position-relative">My Availability</h4> <a href="/wahclub/shareavailability" class="edit-button"><i class="fa fa-edit"></i> Edit</a>
                        <hr>
                    </div>
                    
                    <div class="col-sm-12 col-lg-12 mt-2">
        <h6 class="mb-1 ps-2">  Working Days:</h6>
        <ul class="weekdays p-0 mb-3">
            <li><button type="button" class="cs-btn cs-style1">Mon</button></li>
            <li><button type="button" class="cs-btn cs-style1">Tue</button></li>
            <li><button type="button" class="cs-btn cs-style1">Wed</button></li>
            <li><button type="button" class="cs-btn cs-style1">Thu</button></li>
            <li><button type="button" class="cs-btn cs-style1">Fri</button></li>
        </ul>
        
        <h6 class="mb-1 ps-2">Time: <strong class="mb-1 ps-2">10:00 AM TO 6:00 PM</strong></h6>
        
                        
                    </div>
                    
            
            <!--
            
                    <div class="col-sm-12 col-lg-12 mt-5">
                        <h4 class="mb-2"><?=date('F');?> - Busy Times or Exceptions</h4>
                    </div>
                    
                    <div class="col-sm-12 col-lg-12">
                
                    
        <div class="table-responsive">
            <table class="table table-centered table-dark table-hover mb-0">
              <thead>
                <tr>  
                  <th>Date</th>
                  <th>From</th> 
                  <th>To</th> 
                  <th>Actions</th> 
                </tr>
              </thead>
              <tbody>
                  
                <tr>
                    <td>01/25/2025</td>
                    <td colspan="2">10:00 AM to 12:00 PM</td> 
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td> 
                </tr>
                  
                <tr>
                    <td>01/27/2025</td>
                    <td colspan="2">Not Available</td> 
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td> 
                </tr>
                  
                <tr>
                    <td>01/29/2025</td>
                    <td colspan="2">14:00 AM to 6:00 PM</td> 
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td> 
                </tr>
                 
              </tbody>
            </table>
      </div>
                    
                        
                    </div>  -->       
            
            
                    
                </div>
            
            </div>
             
            
            
          </div>
          <br>
         
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
</div>
  
  
   <!-- Start CTA -->
  <?php include('../footer.section.php');?>
  <?php include('footer.commonJS.php');?> 
    
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