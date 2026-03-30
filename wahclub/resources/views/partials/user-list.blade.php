  @foreach ($users as $user)
          
					
					<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 py-4 user">
                    
					@php
		    $userID = $user->id;
            $myconnections = \App\Models\Connection::where(function ($query) use ($userID) {
                $query->where('user_id_1', $userID)
                      ->orWhere(function ($query) use ($userID) {
                          $query->where('user_id_2', $userID);
                      });
            })->get();
        @endphp 
                
					<div class="category-item">
					   <div>
					       <a href="/wahclub/{{ $user->slug_username }}">
						    <img class="test-img" decoding="async" src="{{ asset('public/img/photos/'.$user->photo) }}" alt="" />
						    </a>
					  </div>
					  <div class="content">
						<h4 class="name"> <a href="/wahclub/{{ $user->slug_username }}" title="{{ $user->firstname }} {{ $user->lastname }}">{{ $user->firstname }} {{ $user->lastname }} 
						@if($user->subscription_status === 'paid')
    						<img decoding="async" src="{{ asset('public/img/shapes/premium-tag.png') }}" style="margin-left: 3px; width: 20px; height: 20px; display: inline"/>
					    @endif
						</a></h4>
			    @if($user->experiences->isNotEmpty())
				    
			     @php
                    $sortedExp = $user->experiences->sortByDesc(function ($experience) {
                        return $experience->durationfrom ?? $experience->present;
                    });
                    $firstExps = $sortedExp->first();
                @endphp
						<p class="profile-current-experience" title="{{ $firstExps->role }}">• {{ $firstExps->role }}</p>
			     
			    @endif
			    
			    
			    
			    
			    
			    
						<hr class="top-line">
						
						<div class="category-short-stats">
    						<span title="Connections">
    						    <i class="fa-sharp fa-thin fa-user-plus"></i> 
    					 @php
                            // Check the number of connections
                            $connectionCount = $myconnections->count();
                        @endphp
    						 {{ $connectionCount }}
    						
    						</span>
    						<span title="Profile Views">
    						    <i class="fa-thin fa-eye"></i> {{ $user->views * 27 }} +
    						</span> 
    						<span title="Experience">
    						    <i class="fa-thin fa-sharp fa-suitcase"></i> {{ $user->totalexperience }} years+
    						</span>
						</div>
						
						<hr class="btm-line">
						<div class="quote">
							<p style="margin-bottom: 4px;">My Expertise:</p>
							<div class="skill-section">
			 @if($user->skills->isNotEmpty())
					@foreach($user->skills as $skill)
							<a href="/wahclub/skills/{{ $skill->slug }}" class="skill-more-btn" title="{{ $skill->skill }}">
							   {{ $skill->skill }}
							</a>
					@endforeach
			@endif
						</div>
						</div>
						 
						 <x-connect-button :loggedinUser="$loggedinUser" :user="$user" :connections="$connections" /> 
						 
						 
					</div>
					  
                    
					</div>
					
				  </div>
                    
                @endforeach