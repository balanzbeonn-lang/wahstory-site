<div class="category-item">
    <div>
        <a href="/wahclub/{{ $user->slug_username }}">
            <img class="test-img" decoding="async" src="{{ asset('public/img/photos/'.$user->photo) }}" alt="" />
        </a>
    </div>
    <div class="content">
        <h4 class="name">
            <a href="/wahclub/{{ $user->slug_username }}" title="{{ $user->firstname }} {{ $user->lastname }}">
                {{ $user->firstname }} {{ $user->lastname }} 
                @if($user->subscription_status === 'paid')
					<img decoding="async" src="{{ asset('public/img/shapes/premium-tag.png') }}" style="margin-left: 3px; width: 20px; height: 20px; display: inline"/>
			    @endif
            </a>
        </h4>
        
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
                {{ $myconnections->count() + 8 }}
            </span>
            <span title="Profile Views">
                <i class="fa-thin fa-eye"></i> {{ $user->views + 12 }} +
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
                        <a href="/wahclub/skill/{{ $skill->slug }}" class="skill-more-btn" title="{{ $skill->skill }}">
                            {{ $skill->skill }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        
        <span class="designation connect-btns">
            <a href="/wahclub/{{ $user->slug_username }}" class="btn tj-btn-primary">Visit Profile</a>
            
            @if(isset($loggedinUser) && $loggedinUser != null)
                @if ($_SESSION['email'] !== $user->email)
                    @php 
                        $memberID = $user->id;
                    @endphp 
                    
                    @if(isset($connections[$memberID]))
                        @if($connections[$memberID] === 1)
                            {{-- Do nothing, already connected --}}
                        @else 
                            <a href="javascript:void(0);" class="btn tj-btn-primary pending-connection">
                                <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                            </a> 
                        @endif
                    @else
                        <a href="javascript:void(0);" class="btn tj-btn-primary connectprofile-btn" data-memberid="{{ $user->id }}">
                            <i class="fa fa-plus small" style="transform: none;"></i> Connect 
                        </a>
                        
                        <a href="javascript:void(0);" class="btn tj-btn-primary pending-connection" style="display: none;">
                            <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                        </a>
                    @endif
                @endif
            @else
                <a href="#loginModal" class="btn tj-btn-primary" data-bs-toggle="modal">
                    <i class="fa fa-plus small" style="transform: none;"></i> Connect
                </a>
            @endif
        </span>
    </div>
</div>
