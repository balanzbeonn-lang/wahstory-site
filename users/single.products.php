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
    
    if(isset($_POST['AddProduct'])){
        $_SESSION['responce'] = $postObj->AddProduct($Storyrow['id']);
    }
    
    if($_SESSION['responce']!=''){
        switch($_SESSION['responce']){
            case 'SUCCESS':
                $message = 'Product Added Successfully!';
                break;
            case 'ERROR':
                $message = 'Something went wrong, try again...';
                default :
                $message = 'Something went wrong, try again...';   
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
    
  <title>My Products | <?=$Userrow['name']?></title>
  
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
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    <?php $Dmenu = 3;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
            
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12"> 
              <h4 class="mb-2">Add Products</h4>
              <hr class="mb-4">
            </div>
         <form id="addproducts" action="" method="POST" enctype="multipart/form-data"> 

          <div class="col-sm-12"> 
            <input type="text" class="cs-form_field" name="productname" placeholder="Product Name*" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-12"> 
            <input type="text" class="cs-form_field" name="productlink" placeholder="Enter Product External Link"> 
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-12"> 
            <input type="file" class="cs-form_field" name="file" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          
          <div class="col-lg-12">   
            <button class="cs-btn cs-style1" type="submit" name="AddProduct">
              <span>Add Product</span>
                              
            </button>
            <div id="cs-result"></div>
          </div>
        </form> 
        
        
          </div> <!-- Row Ends-->
          
          <div class="cs-height_60 cs-height_lg_50"></div>
          
          <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h4 class="mb-2" >My Products</h4>
                <hr>
                <div class="cs-height_20 cs-height_lg_20"></div>
            </div>
          </div>
          
          <div class="row">
              
    <?php    
    if($Storyrow != NULL){ 
    foreach($postObj->getStoryProducts($Storyrow['id']) as $prdrow){ ?>
            <div class="col-sm-6 col-md-4 storydashproducts">
                <a href="single.products.php?pid=1">
                    <img src="/assets/images/products/<?=$prdrow['img']?>">
                    <p><?=$prdrow['producttitle']?></p>
                    <a href="https://www.amazon.in/Entrepreneurship-Development-Management-Bhatnagar-Budhiraja/dp/8190651803/ref=sr_1_9?keywords=business+development+books&qid=1689070693&sprefix=Business+developme%2Caps%2C346&sr=8-9" class="cs-btn cs-style1" target="_blank">Buy Now <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
                      </svg></a>
                </a>
            </div>
    <?php } } ?>
            
            
          </div>
        
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
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