@include('head')

<meta name="csrf-token" content="{{ csrf_token() }}">
    
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	
	<style>
	     .skillfilter-outer .select2-container--default .select2-selection--single:focus {

            border-color: var(--tj-theme-primary);
        }
        .skillfilter-outer .select2-container--default .select2-selection--single {
            background-color: #ffffff00;
            border: 1px solid var(--tj-grey-4);
            border-radius: 4px;
            padding: 8px 5px;
            height: auto;
        }
        .skillfilter-outer .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 10px;
        }

        .skillfilter-outer .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #ffffff; 
        }
        .select2-dropdown {
            background-color: #0f0715;
            border: 1px solid var(--tj-grey-4);
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #cc254c;
            background: #33333300;
            color: #fff;
            border-radius: 5px;
        }
        .select2-search--dropdown .select2-search__field {
            padding: 6px;
            width: 100%;
            box-sizing: border-box;
        }
        .select2-container--default .select2-results__option--selected {
            background-color: #b32143;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #b32143;
            color: white;
        }
	</style>


@include('header')


@php
$categories = [
    'professionals' => ['name' => 'Professionals', 'icon' => 'fa-user-tie'],
    'legal-financial-experts' => ['name' => 'Legal & Financial Experts', 'icon' => 'fa-gavel'],
    'influencers-artists' => ['name' => 'Influencers & Artists', 'icon' => 'fa-people-arrows'],
    'founders-entrepreneurs' => ['name' => 'Founders & Entrepreneurs', 'icon' => 'fa-briefcase'],
    'wellness' => ['name' => 'Wellness', 'icon' => 'fa-spa'],
    'coaches' => ['name' => 'Coaches', 'icon' => 'fa-chalkboard-teacher'],
    'education-counsellors' => ['name' => 'Education Counsellors', 'icon' => 'fa-user-graduate'],
    'sports' => ['name' => 'Sports', 'icon' => 'fa-medal'],
    'marketing' => ['name' => 'Marketing', 'icon' => 'fa-bullhorn'],
    'architects-designers' => ['name' => 'Architects & Designers', 'icon' => 'fa-buildings'],
    'hospitality' => ['name' => 'Hospitality', 'icon' => 'fa-plate-utensils'],
    'practitioners' => ['name' => 'Practitioners', 'icon' => 'fa-stethoscope']
];
@endphp


@php
    if ($categorytitle && array_key_exists($categorytitle, $categories)) {
        $categoryValue = $categories[$categorytitle];
        $currentCat = $categoryValue['name'];
    }
@endphp
    <main class="site-content" >
       
       <section class="resume-section category-sliders pt-5 pb-2" style="background: #0f0715">
            <div class="container">
				 
				<div class="row mt-5">
					<div class="col-md-12 col-lg-12 mt-lg-5 breadcrump">
                        <a href="/wahclub/mainpage" class="btn tj-btn-primarye py-1 " style="color: #f12b59;">
                            Home
                        </a> / 
                        <span class="px-2" style="color: #fff;">
                            Categories
                        </span> / 
                        <span class="px-2" style="color: #fff;">
                            {{ $currentCat }}
                        </span> 
                    </div>
				    
					<div class="col-md-12 col-lg-7">
						
						<div class="section-header mb-0 mt-4">
                            <div>
                                <h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft"> 

                                    <a href="javascript:void(0);"> 
                   
                                        {{ $currentCat }}
                   
                                    </a> </h2>
                                  <div data-wow-delay="0.4s" class="wow fadeInLeft">
                                    <p>Empowering connections with pioneers across different fraternities.</p>    
                                </div>
                                
                            
                            </div>                            
							
						</div>
						
						<hr style="border: 0;">
			
					</div>

                    <div class="col-md-12 col-lg-5">

                        <div class="row mb-0 mt-md-4">
                            <div class="col-12 skillfilter-outer">
                                
                                <label for="skillFilter" class="m-0">Sort by Category:</label>
 
                                <select name="skillFilter" id="skillFilter" class="skillFilter py-3 normal" style="height: auto; width: 100%;"> 
                
                                        
                @php
                    
                    if($categorytitle) {
                    
                          $slct = $categories[$categorytitle];
                         
                        echo '<option value="'. $categorytitle .'" selected>'. $slct['name'] .'</option>';
                        
                    }
                        
                        
                    @endphp
                                     
                              
                              
                              <option value="professionals">Professionals</option>
                              
                              <option value="legal-financial-experts">Legal & Financial Experts</option>
                              <option value="influencers-artists">Influencers & Artists</option>
                              <option value="founders-entrepreneurs">Founders & Entrepreneurs</option>
                              <option value="wellness">Wellness</option>
                              <option value="coaches">Coaches</option>
                              <option value="education-counsellors">Education Counsellors</option>
                              <option value="sports">Sports</option>
                              <option value="marketing">Marketing</option>
                              <option value="architects-designers">Architects & Designers</option>
                              <option value="hospitality">Hospitality</option>
                              <option value="practitioners">Practitioners</option> 
                                     
                                </select> 
                                 

                            </div>
                        </div>

					</div>
					 
				</div>
				
				
				
				 <div data-wow-delay="0.5s" class="categories-widget carouselWrap wow fadeInRight mb-5" data-loop="yes" data-dot="yes" data-autoplay="yes" data-delay="3000">

                <div class="row" id="user-list">
                  @if ($users->isEmpty())
                    <p>No users found.</p>
                @else
                    @include('partials.user-list', ['users' => $users])
                @endif
					 
 
                </div>
                
@php
        // Get 6 random keys from the array
    $randomCategoriesKeys = array_rand($categories, 6);
    
    // Get the random categories based on the selected keys
    $randomCategories = [];
    foreach ($randomCategoriesKeys as $key) {
        $randomCategories[$key] = $categories[$key];
    }
@endphp            
                
    
                

                <div class="text-center py-4">
            
                    <a href="javascript:void(0);" class="view-more-btn" id="loading" style="display:none;">
                        Loading More <i class="fa-solid fa-loader fa-spin"></i>
                    </a>

               
                </div>
                
                
                    <div class="row" id="exploremorecategory" style="display:none">
                        
                        <div class="col-md-12">
    						
    						 <div class="toptags-widget">
    						     
                                <div class="row">
                                    
                @foreach ($randomCategories as $slug => $explorecategory)
                                    <div class="col-md-4">
                                        <div class="tags-item">								
                                            <div class="resume-widget">
        										<a href="/wahclub/members/{{ $slug }}" class="resume-item wow fadeInRight me-0" data-wow-delay=".5s">
        											<h3 class="resume-title"> <i class="fa-thin {{ $explorecategory['icon'] }}"></i> {{ $explorecategory['name'] }} </h3>
        										</a> 
        									</div>									
                                        </div>
                                    
                                    </div>
                @endforeach
                                    
                                </div>
                                
                            </div>
    						
                        </div>
                         
                    </div>
            
				</div>
				 
			</div>
                    
        </section>


     
    </main>
 
 
 
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #140c1c; ">
      
      <div class="modal-body">
          <button type="button" class="btn-close login-popup-close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
        
        <div class="row">
            <div class="col-lg-12">
                
                <h3 class="h5"> Welcome to WAHClub</h3>
                
                <p class="small"> Login & become a WAHClub member for professional recommendations, real-time engagement & other exclusive features.
                </p>
                
            </div>
            
            <div class="col-lg-12">
                @if(isset($_SESSION['userid']))
                    <a href="/users/" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Get me in WAHClub</a>
                @else
                    <a href="/login?rurl={{ request()->getRequestUri() }}" class="btn tj-btn-primary p-3"><i class="fa fa-user" style="transform: none;"></i> Login to Connect</a>
                
                @endif
            </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div> 
 

@include('footer')

@if(isset($_SESSION['userid']))
    <script>
        $(document).ready(function(){
             
            $('.connectprofile-btn').click(function(){
            var clubmemberid = $(this).data("memberid");
            
            var useremail = "{{ $_SESSION['email'] }}"; 
            
            var $button = $(this);
            
                $button.find('.fa-plus').remove();
                
                
            event.preventDefault();
            $button.off('click');
            $button.addClass('disabled');
            
             $button.append(" <i class='fa fa-spinner fa-spin'></i>");
            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
                $.ajax({
                    url: '/wahclub/connectwithclubmember', // Route to your method
                    type: 'POST',
                    data: JSON.stringify({
                        memberid: clubmemberid,
                        useremail: useremail
                    }), 
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Include CSRF token in the request header
                    },
                    success: function(response) {
                        
                        if(response.status == 'success') {
                            $button.next('.pending-connection').css("display", "block"); 
                            $button.css("display", "none"); 

                        }
                        
                        console.log(response.message);
                    },
                    error: function(xhr) {
                      alert('Error: ' + xhr.responseJSON.message);
                    }
              });
                  
            })
        });
    </script>
@endif



    
    <script>
        
        $(document).ready(function () {
            var currentPage = 1; // Keep track of the current page
            var loading = false; // To prevent multiple simultaneous AJAX requests
            var category = '{{ $categorytitle }}';
            
            // Listen for scroll event
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
                    // Trigger AJAX request when the user reaches the bottom of the page
                    loading = true; // Set loading to true to prevent multiple requests
                    $('#loading').show();
        
                    $.ajax({
                        url: '/wahclub/members/' + category, // The URL for fetching more users
                        type: 'GET',
                        data: {
                            page: currentPage + 1  // Fetch the next page
                        },
                        success: function (response) {
                            // Append the new users to the existing list
                            $('#user-list').append(response.view);
                            $('#loading').hide();
                            // Update the current page
                            currentPage = response.current_page;
        
                            // If there are more pages, allow more requests
                            if (currentPage >= response.last_page) {
                                // No more pages to load
                                $(window).off('scroll');
                                
                                $('#loading').text('Explore More Categories').show();
                                $('#exploremorecategory').show();
                            } 
        
                            loading = false; // Reset loading flag
                        },
                        error: function () {
                            loading = false; // Reset loading flag in case of an error
                            $('#loading').hide();
                        }
                    });
                }
            });
        });
    </script>

     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
    <script>
        // .js-example-basic-single declare this class into your select box
        $(document).ready(function() {
            $('.skillFilter').select2();
            
            
            // Add event listener for change event
            $('#skillFilter').on('change', function() {
                const selectedValue = $(this).val(); // Get the selected value
                // alert(selectedValue); // For debugging

                if (selectedValue) {
                    // Reload the page with the selected value as a query parameter
                    window.location.href = `${encodeURIComponent(selectedValue)}`;
                }
            });
            
        });
    </script>
         
        

@include('footer-bottom')