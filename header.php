 <!--site search box-->
    <script type="application/ld+json">
       {
         "@context": "https://schema.org",
         "@type": "WebSite",
         "url": "https://www.wahstory.com/",
         "potentialAction": {
           "@type": "SearchAction",
           "target": "https://www.wahstory.com/search/{search_term_string}",
           "query-input": "required name=search_term_string"
         }
       }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://www.wahstory.com",
      "logo": "https://www.wahstory.com/images/logos/logo-light.png"
    }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LVRFRRWSM2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-LVRFRRWSM2');
    </script>
    
    </head>
  <body>
    <!--<div class="cs-preloader cs-center">
      <div class="cs-preloader_in"></div>
    </div>-->
    <!-- Start Header Section -->
    <header class="cs-site_header cs-style1 text-uppercase cs-sticky_header">
      <div class="cs-main_header">
        <div class="container">
          <div class="cs-main_header_in">
            <div class="cs-main_header_left">
              <a class="cs-site_branding" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" />
              </a>
            </div>
            <div class="cs-main_header_center">
              <div class="cs-nav cs-primary_font cs-medium">
                <ul class="cs-nav_list">
      <!--            <li>-->
      <!--              <a href="/">Home</a>-->
                  
				  <!--</li>-->
				  
                  <li>
                    <a href="/aboutus">About Us</a>
                  </li>
				  
                  <li class="menu-item-has-children">
                    <a href="/stories/">Stories</a>
                    <ul>
                      <?php foreach ($postObj->getCats() as $cat) : ?>
						<?php if ($cat['id'] === '12' || $cat['id'] === '13' || $cat['id'] === '14')
									continue; ?>
						<li><a href="/stories/<?php echo $cat['slug']; ?>"><?php echo $cat['name']; ?></a></li>
						
					<?php endforeach; ?>
					
					<?php $storyofthemonth = $postObj->getStoryofMonth(); ?>
						<li><a href="/story/<?php echo $storyofthemonth['slug']; ?>">Story of The Month</a></li>
									
                    </ul>
                  </li>
				  
				   <li>
                    <a href="/wahclub/" target="_blank">WAHClub</a>
                  </li>
				  
                  <li>
                    <a href="/wahcommunity/">WAH Community</a>
                  </li>
                  
                  <li>
                    <a href="/wahspotlight/" target="_blank" >WAH SPOTLIGHT</a>
                  </li> 
                  <li class="menu-item-has-children">
                    <a href="#">More</a>
                    <ul>
                        <li>
                            <a href="/collaborate/">Collaborate With Us</a> 
                        </li>
                        <li><a href="/shareyourstory/">Share Your Story</a></li>
                        <li><a href="/blogs">Blogs</a> </li>
                        <li><a href="/corporatenews">News</a> </li>
                        <!--<li> <a href="/shareyourstory/">Share Your Story</a> </li>-->
                    </ul>
                        
                  </li>
                      
                   
                </ul>
              </div>
            </div>
            <div class="cs-main_header_right">
                
              <div class="cs-toolbox">
                  
                <a href="javascript:void(0);" class="cs-header_cart header-search" aria-label="Open search">
                    <i class="fa fa-search p-2"></i>
                </a>

<form class="searchbar-section" method="get" action="/search_redirect">
    <div class="searchInput">
        <input autofocus type="search" name="query" placeholder="Search Story by Name, Story, Keywords" value="" class="form-control" required>
        <button type="submit" aria-label="Submit search">
            <i class="fa fa-search"></i>
        </button>
    </div>
</form>
                
                <div class="dropdown">
                  <button class="btn cs-header_cart dropdown-toggle hdrlogin" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i> Dashboard
                  </button>
                  <ul class="dropdown-menu">
                      
            <?php if(isset($_SESSION['userid'])){ ?>  
                <li><a href="/users/" class="dropdown-item">My Account</a></li>
                <li><a href="/logout?LogoutUser" class="dropdown-item">Log Out</a></li>
            <?php }else{ ?>
            <li><a class="dropdown-item" href="/createaccount">Create Account</a></li>
            <li><a class="dropdown-item" href="/login">Log In</a></li>
            <?php } ?>
            
                  </ul>
                </div>
                 
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
     
    <!-- End Header Section -->