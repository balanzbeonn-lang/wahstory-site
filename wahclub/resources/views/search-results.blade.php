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
				    
				    
				    <div class="col-md-12 col-lg-12 mt-lg-5 breadcrump">
                        <a href="/wahclub/mainpage" class="btn tj-btn-primarye py-1 " style="color: #f12b59;">
                            Home
                        </a> / 
                        <span class="px-2" style="color: #fff;">
                            Search
                        </span> / 
                        <span class="px-2" style="color: #fff;">
                            {{ Request::input('search') }}
                        </span> 
                    </div>
				     
					<div class="col-md-12 col-lg-12">
						
					<h1 class="h3 mt-4 ms-4">Search results for "@if(Request::has('search')){{ Request::input('search') }}@endif" </h1>
						
    <form action="{{ route('search-results') }}" method="get" class="mt-4 ms-4">
	    <div class="form_group ms-2"> 
								
		<div class="input-group mb-3">
          <input type="text" class="form-control w-auto" placeholder="Search here..." aria-label="Search here..." aria-describedby="innersearchbtn" name="search" id="innersearchinput" autocomplete="off" value="@if(Request::has('search')){{ Request::input('search') }}@endif" required>
          <button type="submit" class="input-group-text btn tj-btn-primary" id="innersearchbtn"><i class="fa fa-search" style="transform: none;"></i> Search</button>
        </div>
								
		</div> 
	</form>
						 
			
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
 
@include('footer-bottom')