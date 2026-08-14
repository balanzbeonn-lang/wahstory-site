@include('head')
  
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    #innersearchinput::placeholder{
        color: #727070;
    }
    #innersearchinput{
        box-shadow: none;
        background: none;
        color: #fff !important;
    }
</style>

@include('header')

    <main class="site-content" >
       
       <section class="resume-section category-sliders pt-5 pb-2" style="background: #0f0715">
            <div class="container">
				 
				<div class="row mt-5">
					<div class="col-md-12 col-lg-12 mt-lg-5">
						
					<h1 class="h3 mt-5 ms-4">All Members </h1>
		  	
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
      
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
      
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
        
            // Listen for scroll event
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading) {
                    // Trigger AJAX request when the user reaches the bottom of the page
                    loading = true; // Set loading to true to prevent multiple requests
                    $('#loading').show();
        
                    $.ajax({
                        url: '{{ route('showallusers') }}', // The URL for fetching more users
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
                                
                                $('#loading').text('No more users to load').show();
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

@include('footer-bottom')