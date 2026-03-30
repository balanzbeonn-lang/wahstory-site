<?php 
session_start();
ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) || $_SESSION['email']==''){
        echo '<script> window.location.href="/login.php"; </script>';
        exit;
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);
    
    /*if(isset($_POST['AddProduct'])){
        $_SESSION['responce'] = $postObj->AddProduct($Storyrow['id']);
    }*/
    
   /* if($_SESSION['responce']!=''){
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
        
    } */
    
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
   
    
  <title>My Blogs | <?=$Userrow['name']?></title>
  
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
     .ck-content {
        
        min-height: 370px;
        
    }
    .ck-editor__editable {
        color: black !important;}
    .ck-source-editing-area{
            min-height:370px;
            color: black;
        }
    /*#editor {*/
    /*    height: 200px;*/
    /*}*/
    /*.ql-toolbar {*/
    
    /*    border-top-left-radius: 20px;*/
    /*    border-top-right-radius: 20px;*/
    /*}*/

    /*.ql-container {*/
    /*    border-bottom-left-radius: 20px;*/
    /*    border-bottom-right-radius: 20px;*/
    /*}*/
 </style> 
 
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <!--<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>-->
   <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/super-build/ckeditor.js"></script>


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
                    <?php $Dmenu = 5;?>
                    <?php include('user.leftmenu.php');?>
                  </div>
                </div>
            </div>
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12"> 
              <h4 class="mb-2">Add Blog</h4>
              <hr class="mb-4">
            </div>
         <form id="addproducts" action="" method="POST" enctype="multipart/form-data"> 

          <div class="col-sm-12"> 
            <input type="text" class="cs-form_field" name="productname" placeholder="Title*" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-sm-12"> 
            <input type="text" class="cs-form_field" name="productlink" placeholder="Author Name"> 
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          <div class="col-sm-12" style="border: 2px solid #ccc; border-radius: 20px; overflow: hidden;"> 
          <textarea id="editor" class="cs-form_field" name="content" placeholder="Add Your Content Here"></textarea>
                <!--<script>-->
                <!--ClassicEditor-->
                <!--    .create(document.querySelector('#editor'))-->
                <!--    .catch(error => {-->
                <!--        console.error(error);-->
                <!--    });-->
                <!--</script>-->
                <script>
            // This sample still does not showcase all CKEditor&nbsp;5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        
                        'heading', '|',
                        'bold', 'italic', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: "Enter Your Content Here",
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    'ExportPdf',
                    'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            });
        </script>
          </div>
          <div class="cs-height_20 cs-height_lg_20"></div>
          <div class="col-sm-12"> 
            <input type="file" class="cs-form_field" name="file" required="">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          
          
          <div class="col-lg-12">   
            <button class="cs-btn cs-style1" type="submit" name="AddBLOG">
              <span>Add Blog</span>
                              
            </button>
            <div id="cs-result"></div>
          </div>
        </form> 
        
        
          </div> <!-- Row Ends-->
          
          <div class="cs-height_60 cs-height_lg_50"></div>
          
          <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h4 class="mb-2" >My Blogs</h4>
                <hr>
                <div class="cs-height_20 cs-height_lg_20"></div>
            </div>
          </div>
          
          <div class="row">
              
    <!--<?php    
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
    <?php } } ?>-->
            
            
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