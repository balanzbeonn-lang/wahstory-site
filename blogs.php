<?php 
session_start();

    include('inc/functions.php');
    $postObj = new Story(); 
    
    $slug = "blog";
    $category = $postObj->getBlogCatBySlug($slug);
    
    $blogs = $postObj->getBlogs(4);
    
    
    // Number of blog posts per page
    $postsPerPage = 12;
    // Get the current page number from the URL
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    $offset = ($current_page - 1) * $postsPerPage;
    
    $blogs = $postObj->getBlogsWithPagination($offset,$postsPerPage);
    $Totalblogs = $postObj->getCountBlogs();
    
    if(!empty($_GET["blogsearch"])){
        
        $blogs = $postObj->getBlogsBySearch($_GET["blogsearch"]);
        $Totalblogs = $postObj->getBlogsCountBySearch($_GET["blogsearch"]); 
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
    
    <!-- Site Title -->
    <title>Blog & News | WAHStory</title>
  
    <meta name="keywords" content=""/>
  
    <meta name="description" content=""/>
    
    <meta name="copyright" content="WAHStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" />   
    <meta name="author" content="WAHStory">
    <meta name="copyright" content="WAHStory.com">
    <meta name="url" content="https://www.wahstory.com/blogs/">
    <meta name="identifier-URL" content="https://www.wahstory.com/blogs/">
    <meta name="directory" content="Blogs">  
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    
    <link rel="canonical" href="https://www.wahstory.com/blogs/" />
    
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website" />
    <meta name="og:title" content="Blog & News | WAHStory">
    <meta name="og:description" content="">
    <meta property="og:url" content="https://www.wahstory.com/blogs/" />
    <meta property="og:site_name" content="WAHStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/logos/logo-light.png" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
    <meta property="og:image:type" content="image/png" />
    

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
     .cs-post.cs-style2 p{
        margin-bottom: 15px;
        line-height: inherit;
     }
 </style> 
 <?php include('header.php');?>
 <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="/assets/images/page-title-bg.jpeg">
      <div class="container">
        <div class="cs-page_heading_in">
          <h1 class="cs-page_title cs-font_50 cs-white_color">Our Blogs</h1>
          <ol class="breadcrumb text-uppercase">
            <li class="breadcrumb-item">
              <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">Blogs </li>
          </ol>
           
        </div>
      </div>
    </div>
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_40"></div>
  
  <section>
      <div class="container blogs-wrapper">
        <div class="row">
            
          <div class="col-lg-12"> 
            <div class="row">
                <div class="col-lg-12"> 
                   <div class="cs-sidebar_item widget_search">
                        <form class="cs-sidebar_search" method="get" action="">
                          <input type="search" name="blogsearch" placeholder="Search by Title, Keywords..." value="<?=$_GET["blogsearch"]?>">
                          <button class="cs-sidebar_search_btn" type="submit">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11.4351 10.0629H10.7124L10.4563 9.81589C11.3528 8.77301 11.8925 7.4191 11.8925 5.94625C11.8925 2.66209 9.23042 0 5.94625 0C2.66209 0 0 2.66209 0 5.94625C0 9.23042 2.66209 11.8925 5.94625 11.8925C7.4191 11.8925 8.77301 11.3528 9.81589 10.4563L10.0629 10.7124V11.4351L14.6369 16L16 14.6369L11.4351 10.0629ZM5.94625 10.0629C3.66838 10.0629 1.82962 8.22413 1.82962 5.94625C1.82962 3.66838 3.66838 1.82962 5.94625 1.82962C8.22413 1.82962 10.0629 3.66838 10.0629 5.94625C10.0629 8.22413 8.22413 10.0629 5.94625 10.0629Z" fill="currentColor" />
                            </svg>
                          </button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
        <div class="cs-height_35 cs-height_lg_30"></div>
          <div class="col-lg-12"> 
            <div class="row"> 
        
    <?php
    
        function getWords($string, $numOfWords) {
            
            $string = strip_tags($string);
            $words = explode(' ', $string);
            $result = array_slice($words, 0, $numOfWords);
            return implode(' ', $result);
        }
                    
		if ($blogs) {
			foreach ($blogs as $blog) {
		?>
        
        <div class="col-lg-6 col-md-6">
		  <div class="cs-post cs-style2">
              <a href="/blog/<?=$blog["slug"];?>" class="cs-post_thumb cs-radius_15">
                <img src="/images/blogs/<?=$blog["img"];?>" alt="<?=$blog["title"];?>" class="w-100 cs-radius_15">
              </a>
              <div class="cs-post_info">
                <div class="cs-post_meta cs-style1 cs-ternary_color cs-semi_bold cs-primary_font">
                  <span class="cs-posted_by"><?=$blog["date"];?></span> 
                </div>
                <h2 class="cs-post_title">
                  <a href="/blog/<?=$blog["slug"];?>"><?=$blog["title"];?></a>
                </h2>
                <div class="cs-post_sub_title"> 
                
                
                 <?php 
                
                $limitedWords = getWords($blog["content"], 50);
                echo $limitedWords;
                
                ?>
                
                </div>
                <a href="/blog/<?=$blog["slug"];?>" class="cs-text_btn">
                  <span>Read More</span>
                  <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5307 6.53033C25.8236 6.23744 25.8236 5.76256 25.5307 5.46967L20.7577 0.696699C20.4648 0.403806 19.99 0.403806 19.6971 0.696699C19.4042 0.989593 19.4042 1.46447 19.6971 1.75736L23.9397 6L19.6971 10.2426C19.4042 10.5355 19.4042 11.0104 19.6971 11.3033C19.99 11.5962 20.4648 11.5962 20.7577 11.3033L25.5307 6.53033ZM0.000366211 6.75H25.0004V5.25H0.000366211V6.75Z" fill="currentColor" />
                  </svg>
                </a>
              </div>
            </div>
            <div class="cs-height_95 cs-height_lg_60"></div>
		  
		  </div>
	<?php }
	    } ?>
      
        <div class="col-lg-12">
            <ul class="cs-pagination_box cs-center cs-white_color cs-mp0 cs-semi_bold">
                <?php
                $total_pages = ceil($Totalblogs / $postsPerPage);
                $pages_before_after = 2;
                $start_page = max(1, $current_page - $pages_before_after);
                $end_page = min($total_pages, $current_page + $pages_before_after);
        
                // Show 'First' link if current page is not the first page
                
        
                // Show 'Previous' link if not on the first page
                if ($current_page > 1) {
                    ?>
                    <li>
                        <a class="cs-pagination_item cs-center" href="?page=<?= $current_page - 1; ?>">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 10.728L2.44884 6L7 1.272L5.77558 0L0 6L5.77558 12L7 10.728Z" fill="currentColor" />
                            </svg>
                        </a>
                    </li>
                <?php
                }
                
        
                // Show pagination numbers with "..." separator for skipped values
                $prev_gap = false;
                for ($i = 1; $i <= $total_pages; $i++) {
                    
                     
                    
                    if ($i < $start_page && $start_page - $i > $pages_before_after) {
                        // Skip pagination numbers before the range and show "..." separator
                        if (!$prev_gap) {
                            echo '<li><a class="cs-pagination_item cs-center" href="?page=1">...</a></li>';
                            $prev_gap = true;
                        }
                        continue;
                    }
        
                    if ($i > $end_page && $i - $end_page > $pages_before_after) {
                        // Skip pagination numbers after the range and show "..." separator
                        if (!$prev_gap) {
                            echo '<li><a class="cs-pagination_item cs-center" href="?page='.$total_pages.'">...</a></li>';
                            $prev_gap = true;
                        }
                        continue;
                    }
        
                    $active = isset($_GET['page']) && $_GET['page'] == $i ? 'active' : '';
                    ?>
                    <li>
                        <a class="cs-pagination_item cs-center <?= $active ?>" href="?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                <?php
                    $prev_gap = false;
                }
        
                // Show 'Next' link if not on the last page
                if ($current_page < $total_pages) {
                    ?>
                    <li>
                        <a class="cs-pagination_item cs-center" href="?page=<?= $current_page + 1; ?>">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 1.272L4.55116 6L0 10.728L1.22442 12L7 6L1.22442 0L0 1.272Z" fill="currentColor" />
                            </svg>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>


                
            </div>
          </div>
          
           
        </div>
      </div>
    </section>
    
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
  
  
  <!-- Start CTA -->
  <?php include('footer.top.php');?>
     
    
  </body>
</html>