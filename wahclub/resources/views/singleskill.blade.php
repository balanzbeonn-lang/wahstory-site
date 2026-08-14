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

    <main class="site-content" >
       
       <section class="resume-section category-sliders pt-5 pb-2" style="background: #0f0715">
            <div class="container">
				 
				<div class="row mt-5">
				
				    <div class="col-md-12 col-lg-12 mt-lg-5 breadcrump">
                        <a href="/wahclub/mainpage" class="btn tj-btn-primarye py-1 " style="color: #f12b59;">
                            Home
                        </a> / 
                        <span class="px-2" style="color: #fff;">
                            Skills
                        </span> / 
                        <span class="px-2" style="color: #fff;">
                            {{ $currentskill->skill }}
                        </span> 
                    </div>
				    
					<div class="col-md-12 col-lg-7">
						
						<div class="section-header mb-0 mt-4">
                            <div>
                                <h2 data-wow-delay="0.3s" class="section-title wow fadeInLeft">
                     
                                    {{ $currentskill->skill }}   
                                      
                                </h2>
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
                                
                                <label for="skillFilter" class="m-0">Sort by Skills: </label>

                                <select name="skillFilter" id="skillFilter" class="skillFilter py-3 normal" style="height: auto;"> 
                                    
                        @if ($currentskill)
                            <option value="{{ $currentskill->slug }}" selected>{{ $currentskill->skill }}</option>
                        @endif
                                    
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->slug }}">{{ $skill->skill }}</option>
                        @endforeach
                                     
                                     
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
                
                <div class="text-center py-4">
            
                    <a href="javascript:void(0);" class="view-more-btn" id="loading" style="display:none;">
                        Loading More <i class="fa-solid fa-loader fa-spin"></i>
                    </a>

               
                </div>

                 
                 
				<div class="row skill-tabs" id="exploremoreskills" style="display: none;">
					 
				
				@if ($ExploreSkills)
				    @foreach ($ExploreSkills as $ExploreSkill)
					<div class="col-lg-4">						
						<div class="resume-widget">
                            <a href="/wahclub/skills/{{ $ExploreSkill->slug }}" class="resume-item wow fadeInRight" data-wow-delay=".5s">
							
								<div class="icon">
									<i class="fa-thin fa-head-side-brain"></i>
								</div>
								
                                <div class="time">
                                    {{ $ExploreSkill->skill }}
                                </div>
								
								<div class="lasticon">
									<i class="fa fa-arrow-right"></i>
								</div>
                                 
                            </a>
                        </div>				
					</div>
				
				    @endforeach
				@endif
					
					 
					
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
            var currentskill = '{{ $currentskill->slug }}';
            
            // Listen for scroll event
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
                    // Trigger AJAX request when the user reaches the bottom of the page
                    loading = true; // Set loading to true to prevent multiple requests
                    $('#loading').show();
        
                    $.ajax({
                        url: '/wahclub/skills/' + currentskill, // The URL for fetching more users
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
                                
                                $('#loading').text('Explore More Skills').show();
                                $('#exploremoreskills').show();
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
