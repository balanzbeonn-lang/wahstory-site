@php
    // Check and set session variables if needed
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['email'])) { 
        $_SESSION['email'] = session('email'); 
        $_SESSION['userid'] = session('userid');        
        $_SESSION['club_userid'] = session('club_userid');
    }
@endphp

@if ($user->id != $_SESSION['club_userid'])
    <script>
        window.location.href = '/wahclub/';
    </script>
@else
    
@endif

    
    

<!DOCTYPE html>
<html class="no-js" lang="en">
   
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>Build My Presence - WAHClub</title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="https://www.wahstory.com/images/wah_fav.ico" />
    <link rel="shortcut icon" type="image/png" href="https://www.wahstory.com/images/wah_fav.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/flaticon_gerold.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
  
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
 
        
 
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <style>
    
    input:disabled{
        background: #202020 !important;
        cursor: not-allowed;
    }
    
    .input-read-only{
        background: #1c1a1a !important;
        cursor: not-allowed;
        border: 1px solid #1c1a1a !important;
        color: #ababab !important;
    }
    .theme-text-primary {
        color: #f12b59;
    }
    .theme-text-primary:hover {
        color: #ffffff;
    }
     
     .myaccount-btn{
         font-size: 15px; 
         color: #f12b59; 
         text-decoration: none;
     }
     
     @media (max-width:768px){ 
         .myaccount-btn span{
             display : none; 
         }
         .step{
             font-size: 8px !important;
         }
     }
     
     .otherField{
         font-size: 12px !important;
        padding: 8px 21px !important;
     }
     
    .tj-header-area {
      padding: 20px 0 0px;
    }

   .iti__country-list{
      background: #2d2a2a !important;

    }
    .form_group .iti {
      display: block;
    }
    .form_group textarea {
        height: 130px;
        resize: none;
    }
      .select2-container{
        width: 100% !important;
      }

      .select2-container--default .select2-selection--multiple {
        display: block;
        width: 100%;
        background: var(--tj-black-2);
        border: 1px solid var(--tj-grey-4);
        font-size: 16px;
        line-height: 1;
        color: var(--tj-white);
        padding: 14px 20px; 
        border-radius: 8px;
        transition: all 0.3s 0s ease-out;
        outline: none;
        height: auto;
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #000000;
        border: 1px solid #951c38;
        padding: 5px 5px 5px 22px;
        font-size: 12px;
      }
      .select2-search__field{
        font-size: 16px;
        line-height: 1; 
        color: var(--tj-white);
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        border-right: 1px solid #951c38;
        padding: 5px 4px;
      }

      #MultipleIndustrySelect + span + .nice-select.form-control,
      #MultipleSkillSelect + span + .nice-select.form-control,
      #MultipleToolSelect + span + .nice-select.form-control,
      #MultipleAttributesSelect + span + .nice-select.form-control
       {
        display: none;
      }

    .select2-results__options {
      color: var(--tj-theme-accent-1);
      cursor: pointer;
      font-weight: 400;
      line-height: 20px;
      font-size: 14px;
      list-style: none;
      min-height: 40px;
      outline: none; 
      text-align: left;
      -webkit-transition: all 0.2s;
      transition: all 0.2s;
      scrollbar-color: initial !important;

    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
      border: solid var(--tj-theme-primary) 1px; 
  }
  
  .section-header { 
    max-width: 100%;
    
  }
  
  .section-title img{
      width: 45px;
      margin-bottom: 20px;
  }
  
  @media only screen and (max-width: 767px){
      .section-title img{
          width: 25px; 
      }
      .section-header .section-title {
            font-size: 25px;
            margin: 0;
        }
  }
  
  .field-instruction{
      font-size: 12px;
    color: #fa8f69e8;
    font-weight: 300;
  }

    p.word-counter {
        font-size: 14px;
        color: #666;
    }

    p.word-counter.success {
        color: #15ab3a;
    }

    p.word-counter.error {
        color: red;
    }




 
/* Mark input boxes that gets an error on validation: */
input.invalid {
  /* background-color: #ffdddd !important; */ 
  border: 1px solid var(--tj-theme-primary) !important; 
    border-radius: 8px;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

  #prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  border-top: 4px solid #bbbbbb;
    width: 15%;
    padding: 10px 0;
    margin: 0 2px;
    display: inline-block;
    opacity: 0.5;
    font-size: 12px;
}

.step.active {
  opacity: 1;
  border-color: #f12b59;
  
}

/* Mark the steps that are finished and valid: */
.step.finish {
  border-color: #068338;
  opacity: 1;
}
 

input[type="tel"]:disabled {
  background: #272727 !important;
  color: #7b7b7b !important;
  cursor: not-allowed;
}
 

#autosaved{
  display: none;
}

.ck.ck-editor__main>.ck-editor__editable {
    background: #050709;
    
    border: 1px solid var(--tj-grey-4) !important;
}

:root {
  /* violet */
  --primary-color: 111, 76, 255;
  
  /* white */
  --text-color: 256, 256, 256;
}


.btn {
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  padding: 12px 32px;
  margin: 1rem;
  cursor: pointer;
  border-radius: 4px;
  transition: all 0.3s ease;
  border-radius: 50px;
}

.btn:hover {
  transition: all 0.3s ease;
}

/* https://sushi.com/ */
.btn-gradient-border {
  color: rgba(var(--text-color));
  border: 2px double transparent;
      background-image: linear-gradient(rgb(13, 14, 33), rgb(13, 14, 33)), radial-gradient(circle at left top, rgb(1, 110, 218), rgb(217, 0, 192));
  background-origin: border-box;
  background-clip: padding-box, border-box;
}


.btn-glow:hover {
  box-shadow: rgba(var(--primary-color), 0.5) 0px 0px 20px 0px;
}

#generatedStory, #generateStoryBtn, #newStoryContainer, #SkipToOriginalStory, #SkipToAIStory{
  display: none;
}



.datepicker table {
    color: #333;
}
.datepicker table tr td span.focused, .datepicker table tr td span:hover {
    background: #d1d1d1;
}


</style>


</head>

<body>

    <!-- Preloader Area Start -->
    <div class="preloader">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="preloader-heading">
            <div class="load-text">
                <span>L</span>
                <span>o</span>
                <span>a</span>
                <span>d</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
            </div>
        </div>
    </div>
    <!-- Preloader Area End -->


    <!-- start: Back To Top -->
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- end: Back To Top -->

    <!-- HEADER START -->
    <header class="tj-header-area header-absolute">
        <div class="container">
            <div class="row">
                <div class="col-2 text-center pt-3">
                    <a href="/users/" class="myaccount-btn" title="My Account"><i class="fa fa-user"></i> <span>My Account</span></a>
                </div>
                <div class="col-8 text-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>
 
                     
                </div>
                
                <div class="col-2 text-center pt-3">
                    <a href="/users/" class="myaccount-btn" title="Skip Form"> <span>Skip Form </span><i class="fa fa-forward-fast"></i></a>
                </div>
                
            </div>
        </div>
    </header>
    <header class="tj-header-area header-2 header-sticky sticky-out">
        <div class="container">
            <div class="row">
                <div class="col-2 text-center pt-3">
                    <a href="/users/" class="myaccount-btn"><i class="fa fa-user"></i> <span>My Account</span></a>
                </div>
                <div class="col-8 text-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>
 
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <main class="site-content" >
              <!-- CONTACT SECTION START -->
    <section class="contact-section" id="contact-section">
        <div class="container">
          <div class="row">
    @php  
        if(isset($_GET['status']) && $_GET['status'] == 'completeprofile'){
    @endphp
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  Please complete your profile first to view your personalized page.
                  <br>
                  <span style=" font-size: 13px; font-weight: 600; ">Please ensure you fill in the details such as Story, Experience, Education, Skills, Tools, and Attributes.</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
    @php  } @endphp
            
            <div class="col-lg-12 col-md-12 order-1 order-md-1">
              <div class="contact-form-box wow fadeInLeft pt-4 pb-2" data-wow-delay=".3s">
                <div class="section-header text-center mb-2">
                  <h2 class="section-title">WAHClub: Your <span style="background: #ffffff; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Journey</span> Starts Here! <img src="https://cdn-icons-png.flaticon.com/512/4710/4710068.png"></h2>
                  @if($errors->any())
                      <ul>
                  @foreach($errors->all() as $error) 
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endforeach
                      </ul>
                  @endif 
                </div>
  
                <div class="tj-contact-form wahclubform">
                   
                <form action="{{ url('savedatainsteps') }}"  id="regForm" method="POST"  enctype="multipart/form-data">
                  @csrf


                   <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center; " class="tab-titles mb-5">
                      <span class="step active">Personal Info.</span> 
                      <span class="step">Career Profile</span>
                      <span class="step">Work</span>
                      <span class="step">Testimonials</span>
                      <span class="step">Story</span>
                    </div>
                    
                    


                  <div class="tab">

                    <div class="row gx-3"> 
                    
                    
                    <div class="col-sm-2 col-xs-2">
                        <div class="form_group">
                          <label for="honorifics">Title: * </label>
                          <select name="honorifics" id="honorifics">
                    @php 
                    if($user->title != NULL) {
                        echo '<option value="'.$user->title.'" selected>'.$user->title.'.</option>';
                    }
                    @endphp
                          <option value="Mr">Mr.</option>
                          <option value="Mrs">Mrs.</option>
                          <option value="Ms">Ms.</option>
                          <option value="Dr">Dr.</option>
                          <option value="Prof">Prof.</option> 
                          </select>

                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form_group">
                          <label for="fname" class="d-flex justify-content-between">First Name: <a href="/users/update/update.profile.php" class="theme-text-primary text-decoration-none"><i class="fa fa-pencil"></i> change </a></label>
                          <input
                            type="text" 
                            oninput="this.className = ''"
                            id="fname"
                            placeholder="Enter Your First Name *" 
                            value="{{ $user->firstname }}"
                            class="input-read-only"
                            readonly
                          />
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form_group">
                          <label for="lname" class="d-flex justify-content-between">Last Name: <a href="/users/update/update.profile.php" class="theme-text-primary text-decoration-none"><i class="fa fa-pencil"></i> change </a></label>
                          <input
                            type="text" 
                            oninput="this.className = ''"
                            id="lname"
                            placeholder="Enter Your Last Name *" 
                            value="{{ $user->lastname }}"
                            class="input-read-only"
                            readonly
                          />
                          
                        </div>
                      </div> 

                      <div class="col-sm-6">
                        <div class="form_group" style=" text-align: right; ">                
                          <input
                            type="tel" 
                            oninput="this.className = ''"
                            id="phone"
                            placeholder="Enter Your Phone Number *"
                            value="+{{ $user->dialcode }} {{ $user->phone }}" 
                            class="input-read-only"
                            readonly
                          />                           
                        </div>
 

                      </div>                      
                      
                      <input type="hidden" id="dialCode" name="dialCode"> 

                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="email"  
                            placeholder="Enter Your Email Address *" 
                            value="{{ $user->email }}"
                            class="input-read-only"
                            readonly
                          />
                        </div>
                      </div> 
            @php
                if($user->photo != NULL){
            
                
                    $photoCol = '10';
                    $photorequired = '';
                    $PreviousPhoto = '<div class="col-sm-2"> <img src="' . asset('public/img/photos/' . $user->photo) . '" width="95px" style=" border-radius: 8px; " /> </div>';
                    $photoStar = '';
                
                }else{
                    $photoCol = '12';
                    $photorequired = 'required';
                    $PreviousPhoto = '';
                    $photoStar = '*';
                }
            
            @endphp
                      <div class="col-sm-{{ $photoCol }}"> 
                        <div class="form_group">
                          <label>Upload Your Profile Image {{ $photoStar }} <span class="small">(Max size: 1 MB, Dimensions: 1078 x 762 pixels)</span>  </label>
                          <input type="file" oninput="this.className = ''" name="profilephoto" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" {{ $photorequired }} />
                        </div>
                      </div>
                      
            @php  
                echo $PreviousPhoto; 
            @endphp
                      
                      
                      
        @php
            $FBLink = $INSTALink = $LINKDLink = $TWITTERLink = "";  
        @endphp
                      
         @foreach($socials as $social)
            @if($social->platform == "Facebook")
                @php $FBLink = $social->link; @endphp
            @elseif($social->platform == "Instagram")
                @php $INSTALink = $social->link; @endphp
            @elseif($social->platform == "Linkedin")
                @php $LINKDLink = $social->link; @endphp
            @elseif($social->platform == "Twitter")
                @php $TWITTERLink = $social->link; @endphp
            @endif
        @endforeach

                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="url"
                            name="facebookUrl"
                            oninput="this.className = ''"
                            id="facebookUrl"
                            placeholder="Facebook profile Url" 
                            value="{{ $FBLink }}"
                          />
                        </div>
                      </div>

                                            
                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="url"
                            name="instagramUrl"
                            oninput="this.className = ''"
                            id="instagramUrl"
                            placeholder="Instagram profile Url" 
                            value="{{ $INSTALink }}"
                          />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="url"
                            name="linkedinUrl"
                            oninput="this.className = ''"
                            id="linkedinUrl"
                            placeholder="LinkedIn profile Url" 
                            value="{{ $LINKDLink }}"
                          />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="url"
                            name="twitterUrl"
                            oninput="this.className = ''"
                            id="twitterUrl"
                            placeholder="Twitter Profile Url" 
                            value="{{ $TWITTERLink }}"
                          />
                        </div>
                      </div>

                    </div>

            @php  
                 $totalexperience = $user->totalexperience ? $user->totalexperience : null;
                 
                 $totalproject = $user->totalproject ? $user->totalproject : null;
                 
                 $totalawards = $user->totalawards ? $user->totalawards : null; 
                  
                 
            @endphp


                    <div class="row">
                        
                      <div class="col-sm-3">
                        <div class="form_group">
                          <label>Years of Experience  *</label>
                            
                          <input type="number" name="totalexperience" placeholder="Years of Experience" min="1" max="100" value="{{ $totalexperience }}" required/>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form_group">
                          <label>Total No. of Project Completed </label>
                          <input type="number" name="totalproject" placeholder="Number of Projects" min="1" max="100" value="{{ $totalproject }}" />
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form_group">
                          <label>Total No. of Happy Clients  </label>
                          <select id="totalclients" name="totalclients"> 
                          @if($user->totalclients)
                              <option value="{{ $user->totalclients }}" selected>{{ $user->totalclients }}</option>
                            @endif
                              <option value="0-50">0 - 50</option>
                              <option value="51-100">51 - 100</option>
                              <option value="101-200">101 - 200</option>
                              <option value="201-500">201 - 500</option>
                              <option value="500">500+</option>
                        </select>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form_group">
                          <label>Total No. of Awards & Recognition </label>
                          <input type="number" name="totalawards" placeholder="Total No. of Awards" min="1" max="100" value="{{ $totalawards }}" />
                          
<div>
    <div> 
        <div> 
            <input type="hidden" value="{{ $user->email }}" oninput="this.className = ''" name="email" required /> 
        </div>
    </div>
</div>
                          
                        </div>
                      </div>

                    </div>

                  </div><!-- tab ends -->

                  


                  <div class="tab">
                      <fieldset>
                        <legend>Add Your Top Skills & Tools</legend>
                      
                        <div class="row">
                          <div class="col-md-6">   
                            <div id="industries-container" class="mb-4">
                                <label>Add the industry that matches your professional experience.</label> <br>
                                <small class="field-instruction">Please select 1</small>
                                <select id="MultipleIndustrySelect" class="form-control" name="industries[]" multiple="multiple" onchange="checkOtherIndustrySelection()"> 
                                
                                @foreach($UserIndustry as $Selectedindustry)
                                    
                                    <option value="{{ $Selectedindustry->id }}" selected>{{ $Selectedindustry->industry }}</option>
                                @endforeach
                                
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->industry }}</option>
                                @endforeach

                                </select> 
                                
                                
                                
                                <div class="form_group mt-2">
                        @if ($user->otherIndustries)
                        
                            <input type="text" name="otherIndustries" placeholder="If Other, Enter Industry Title - Max: 1" class="otherField" id="otherSelectedindustry" value="{{ $user->otherIndustries }}" />
                        @else
                        
                            <input type="text" name="otherIndustries" placeholder="If Other, Enter Industry Title - Max: 1" class="otherField" id="otherSelectedindustry" />
                        
                        @endif
                                    
                                </div>
                                

                            </div>  
                          </div>
                          <div class="col-md-6">   
                            <div id="skills-container" class="mb-4">
                              <label>Add the skills that best reflect your areas of expertise.</label> <br>
                              <small class="field-instruction">Please select upto 3</small>
                                <select id="MultipleSkillSelect" class="form-control" name="skills[]" multiple="multiple"> 
                                
                                @foreach($UserSkills as $Selectedskill)
                                    
                                    <option value="{{ $Selectedskill->id }}" selected>{{ $Selectedskill->skill }}</option>
                                @endforeach

                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                                @endforeach

                                </select> 
                                
                                
                                <div class="form_group mt-2">
                                    <input type="text" name="otherSkills" placeholder="If Other, Enter Skills separated by comma (,) Max: 3" class="otherField" value="{{ $user->otherSkills }}" />
                                </div>

                            </div>  
                          </div>
                          <div class="col-md-6">

                            <div class="mb-4">
                              <label>Add the tools that reflect your abilities</label> <br>
                              <small class="field-instruction">Please select upto 6</small>
                                <select id="MultipleToolSelect" class="form-control" name="tools[]" multiple="multiple"> 
                                @foreach($UserTools as $Selectedtool)
                                    <option value="{{ $Selectedtool->id }}" selected>{{ $Selectedtool->tool }}</option>
                                @endforeach
                                
                                @foreach($tools as $tool)
                                    <option value="{{ $tool->id }}">{{ $tool->tool }}</option>
                                @endforeach

                                </select> 
                                
                                
                                <div class="form_group mt-2">
                                    <input type="text" name="otherTools" placeholder="If Other, Enter Tools separated by comma (,) Max: 6" class="otherField"  value="{{ $user->otherTools }}" />
                                </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="mb-4">
                              <label>Add the traits that highlight your unique qualities</label> <br>
                              <small class="field-instruction">Please select upto 4</small>
                                <select id="MultipleAttributesSelect" class="form-control" name="attributes[]" multiple="multiple" required> 
                                 @foreach($UserAttributes as $Selectedattribute)
                                    <option value="{{ $Selectedattribute->id }}" selected>{{ $Selectedattribute->attribute }}</option>
                                @endforeach
                                
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->attribute }}</option>
                                @endforeach


                                </select>  

                            </div>
                            
                          </div>

                        </div>
                          

                          
      
                      </fieldset>


                           

                    <!-- PROFESSIONAL EXPERIENCE -->
                  <fieldset>
                    <legend>Professional Experience</legend>
                
                
                <div id="experiencesContainer"> 
                        <!-- Initial Experience Input Fields -->
                        
                        <p class="description">(Share up to 3 experiences that highlight your journey and impact)</p>
                         
                        
            @if ($UserExperiences->isEmpty())
                        
                <div class="experience-group" id="experience1">
                    <br>
                    <h6> Experience 1 details: </h6>
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-6 col-12">
                          <div class="form_group d-flex align-items-center">
                            <input type="text" name="exp1company" placeholder="Enter Company Name *" autocomplete="off" required /> 
                          </div>
                        </div>
                        <div class="col-lg-6 col-12  ">
                          <div class="form_group">
                            <input type="text" name="exp1role" placeholder="Your Role In The Company *" autocomplete="off" required />
                          </div>
                        </div>
    
                    </div>
                          
                    <div class="row">
                        
                        <div class="col-lg-12 col-12"> 
                        
            <div class="form-check">
                <input class="form-check-input fs-5" type="checkbox" id="exp1currentworking" name="exp1currentworking" value="yes" onchange="toggleExpInput('1')">
                <label class="form-check-label fs-5" for="exp1currentworking"> I am currently working in this role
                </label>
            </div>
                        
                        </div>
                    </div>
                          
                    <div class="row">
                        
                        <div class="col-lg-6 col-12">                             
                          <div class="form_group">                              
                            <label for="start-month">From: *</label>
                            <input type="text" name="exp1start-month" class="form-control formatedCalendar" placeholder="Select Year and Month" required />                              
                          </div>
                        </div>
                        <div class="col-lg-6 col-12">
                          <div class="form_group">
                            <label for="end-month">To: *</label>
                            <input type="text" name="exp1end-month" class="form-control formatedCalendar" placeholder="Select Year and Month" />
                          </div>
                        </div> 
                        
                    </div> 
                      
                    <div class="row">
    
                        <div class="col-sm-12 mt-2">
                          <div class="form_group">
                            <label>Description of Responsibilities and
                              Achievements * </label>
                            <textarea name="exp1desc" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required></textarea>
                            <p class="word-counter">0/150 Words</p>
                          </div>
                        </div>
    
                    </div>
                    
                    <!-- exp ends --> 
                </div>
                        
            @else
            
            
                @php $Expcnt = 1; @endphp
                @foreach($UserExperiences as $UserExperience)
                
                    <div class="experience-group" id="experience{{ $Expcnt }}">
                        <br>
                        <h6> Experience {{ $Expcnt }} details: </h6>
                        <hr>
                        
                        <input type="hidden" name="exp{{ $Expcnt }}id" value="{{ $UserExperience->id }}">
                        
                        <div class="row">
                            <div class="col-lg-6 col-12">
                              <div class="form_group d-flex align-items-center">
                                <input type="text" name="exp{{ $Expcnt }}company" placeholder="Enter Company Name *" autocomplete="off" value="{{ $UserExperience->company_name }}" required /> 
                              </div>
                            </div>
                            <div class="col-lg-6 col-12  ">
                              <div class="form_group">
                                <input type="text" name="exp{{ $Expcnt }}role" placeholder="Your Role In The Company *" autocomplete="off" value="{{ $UserExperience->role }}" required />
                              </div>
                            </div>
        
                        </div>
                        
                        <div class="row">
                        
                        <div class="col-lg-12 col-12"> 
                        
                            <div class="form-check">
                                <input class="form-check-input fs-5" type="checkbox" id="exp{{ $Expcnt }}currentworking" name="exp{{ $Expcnt }}currentworking" value="yes" onchange="toggleExpInput('{{ $Expcnt }}')">
                                <label class="form-check-label fs-5" for="exp{{ $Expcnt }}currentworking"> I am currently working in this role
                                </label>
                            </div>
                        
                        </div>
                    </div>
                              
                        <div class="row">
                            
                            <div class="col-lg-6 col-12">                             
                              <div class="form_group">      
                    @php
                        
                        $ExpdurationTo = $UserExperience->durationto; 
                        $ExpdateTo = new DateTime($ExpdurationTo);
                        $ExpdateTo =  $ExpdateTo->format('Y-m');
                        
                        $ExpdurationFrom = $UserExperience->durationfrom; 
                        $ExpdateFrom = new DateTime($ExpdurationFrom);
                        $ExpdateFrom =  $ExpdateFrom->format('Y-m');
                    
                    @endphp
                              
                              
                                <label for="start-month">From: *</label>
                                <input type="text" name="exp{{ $Expcnt }}start-month" class="form-control formatedCalendar" placeholder="Select Year and Month" value="{{ $ExpdateFrom }}" required>                              
                              </div>
                            </div>
                            <div class="col-lg-6 col-12">
                              <div class="form_group">
                                <label for="end-month">To: *</label>
                                <input type="text" name="exp{{ $Expcnt }}end-month" value="{{ $ExpdateTo }}" placeholder="Select Year and Month" class="form-control formatedCalendar"/>
                              </div>
                            </div> 
                            
                        </div> 
                          
                        <div class="row">
        
                            <div class="col-sm-12 mt-2">
                              <div class="form_group">
                                <label>Description of Responsibilities and
                                  Achievements * </label>
                                <textarea name="exp{{ $Expcnt }}desc" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required>{{ $UserExperience->description }}</textarea>
                                <p class="word-counter">0/150 Words</p>
                              </div>
                            </div>
        
                        </div>
                        
                        <!-- exp ends --> 
                    </div>
                    
                    @php $Expcnt++; @endphp
                    
                @endforeach
                
                
            @endif
                
                </div>
        
                <div> <button type="button" id="addExperienceButton" class="btn tj-btn-primary-new" > + Add Experience </button> </div>
                
                  </fieldset>


                  <!-- Educational Details -->
                  <fieldset>
                    <legend>Educational Details</legend>
                    
                    <div id="educationsContainer"> 
                    
                        <p class="description">(Share up to 3 education that highlight your journey and impact)</p>
                    
            @if ($UserEducations->isEmpty())
                    
                 <!-- Initial Education Input Fields -->
                <div class="education-group" id="education1">
                    <br>
                    <h6> Education 1 details: </h6>
                    <hr>
                            
                    
                    <div class="row">
                         <div class="col-lg-6 col-12">
                          <div class="form_group">
                            <input type="text" name="edu1course" placeholder="Enter Course Name *" autocomplete="off" required/>
                          </div>
                        </div>
                        
                        <div class="col-lg-6 col-12">
                          <div class="form_group d-flex align-items-center">
                            <input type="text" name="edu1university" placeholder="Enter University Name *" autocomplete="off" required/> 
                          </div>
                        </div>
                       

                  </div>
                    
                    <div class="row">
                
                    	<div class="col-lg-12 col-12"> 
                    	
                    		<div class="form-check">
                    			<input class="form-check-input fs-5" type="checkbox" id="edu1currentpursuing" name="edu1currentpursuing" value="yes" onchange="toggleEduInput('1')">
                    			<label class="form-check-label fs-5" for="edu1currentpursuing"> I am currently pursuing
                    			</label>
                    		</div>
                    		
                    	</div>
                    
                    </div>
                    
                    
                  <div class="row">
                    
                    <div class="col-lg-6 col-12">                             
                      <div class="form_group">                              
                        <label>From: *</label>
                        <input type="text" name="edu1start-month" class="form-control formatedCalendar" placeholder="Select Year and Month" required/>                              
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form_group">
                        <label>To: *</label>
                        <input type="text" name="edu1end-month" class="form-control formatedCalendar" placeholder="Select Year and Month"/>
                      </div>
                    </div> 
                    
                  </div>                        
                  <!-- Edu ends -->
                  
                </div>
            @else
                
                @php $Educnt = 1; @endphp 
                
                @foreach($UserEducations as $UserEducation)
                    
                    <!-- Initial Education Input Fields -->
                    <div class="education-group" id="education{{ $Educnt }}">
                        <br>
                        <h6> Education {{ $Educnt }} details: </h6>
                        <hr>
                        
                        <input type="hidden" name="edu{{ $Educnt }}id" value="{{ $UserEducation->id }}">
                        
                        <div class="row">
                            
                            <div class="col-lg-6 col-12">
                              <div class="form_group">
                                <input type="text" name="edu{{ $Educnt }}course" placeholder="Enter Course Name *" autocomplete="off" value="{{ $UserEducation->degree }}" required/>
                              </div>
                            </div>
                            <div class="col-lg-6 col-12">
                              <div class="form_group d-flex align-items-center">
                                <input type="text" name="edu{{ $Educnt }}university" placeholder="Enter University Name *" autocomplete="off" value="{{ $UserEducation->institution_name }}" required/> 
                              </div>
                            </div>

                      </div>
                        
                        <div class="row">
                
                        	<div class="col-lg-12 col-12"> 
                        	
                        		<div class="form-check">
                        			<input class="form-check-input fs-5" type="checkbox" id="edu{{ $Educnt }}currentpursuing" name="edu{{ $Educnt }}currentpursuing" value="yes" onchange="toggleEduInput('{{ $Educnt }}')">
                        			<label class="form-check-label fs-5" for="edu{{ $Educnt }}currentpursuing"> I am currently pursuing
                        			</label>
                        		</div>
                        		
                        	</div>
                        
                        </div>
                        
                        
                      <div class="row">
                        
                        <div class="col-lg-6 col-12">                             
                          <div class="form_group">                              
                            <label>From: *</label>
                            <input type="text" name="edu{{ $Educnt }}start-month" class="form-control formatedCalendar" value="{{ $UserEducation->yearfrom }}"  placeholder="Select Year and Month" required/>                              
                          </div>
                        </div>
                        <div class="col-lg-6 col-12">
                          <div class="form_group">
                            <label>To: *</label>
                            <input type="text" name="edu{{ $Educnt }}end-month" class="form-control formatedCalendar" placeholder="Select Year and Month" value="{{ $UserEducation->yearto }}" />
                          </div>
                        </div> 
                        
                      </div>                        
                      <!-- Edu ends -->
                      
                    </div>
                @php $Educnt++; @endphp
                
                @endforeach 
                    
           @endif
                
                    </div>
            
                    <div> <button type="button" id="addEducationButton" class="btn tj-btn-primary-new" > + Add Education </button> </div>
                    
                  </fieldset>
                   
                  



                  </div>
                  <div class="tab">
                    
                        
                  
                  <fieldset>
                        <legend>Projects & Works Handled</legend>
                            
                        <div id="projectsContainer"> 
                        
                            <p class="description">(Share up to 2 projects that highlight your journey and impact)</p>
                            
            @if ($UserProjects->isEmpty())
                
                    <!-- Initial Project Input Fields -->
                <div class="project-group" id="project1">
                      <br>
                      <h6> Project 1 details: </h6>
                      <hr>
                                  
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form_group">
                              <label>Project Name: </label>
                            <input type="text" name="project1name" placeholder="Enter Project Name *" autocomplete="off" /> 
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form_group">
                          <label>Upload Project Image <span class="small">(Max-size: 1 MB)</span>: </label>
                          <input type="file" name="project1file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                        </div>
                    </div>
                  </div>
                    <div class="col-sm-12">
                      <div class="form_group">
                        <input type="url" name="project1link" placeholder="Enter Project Link (Optional)" autocomplete="off" />
                      </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form_group">
                        <label
                          >1. What was the objective of the project? </label
                        >
                        <textarea name="project1Objective" placeholder="Write Your Answer *" autocomplete="off"  oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required></textarea>
                        <p class="word-counter">0/150 Words</p>
                        
                      </div>
                      <div class="form_group">
                        <label>2. What was your role in the project? </label>
                        <textarea name="project1Role" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required></textarea>
                        <p class="word-counter">0/150 Words</p>
                        
                      </div>
                      <div class="form_group">
                        <label
                          >3. What were the outcomes and impact of the
                          project? </label
                        >
                        <textarea name="project1Outcome" placeholder="Write Your Answer *" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required></textarea>
                        <p class="word-counter">0/150 Words</p>
                        
                      </div>
                    </div>
                    
                </div> 
            
            @else
            
                @php $Prjcnt = 1; @endphp 
                @foreach($UserProjects as $UserProject)
                            <!-- Initial Project Input Fields -->
                        <div class="project-group" id="project{{ $Prjcnt }}">
                              <br>
                              <h6> Project {{ $Prjcnt }} details: </h6>
                              <hr>
                              
                        <input type="hidden" name="project{{ $Prjcnt }}id" value="{{ $UserProject->id }}">
                        
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form_group">
                                      <label>Project Name: </label>
                                    <input type="text" name="project{{ $Prjcnt }}name" placeholder="Enter Project Name *" autocomplete="off" value="{{ $UserProject->project_name }}" /> 
                                  </div>
                              </div>
                              
                            @if($UserProject->project_photo != NULL)
                                <div class="col-sm-2">
                                    <label>Project Image </label> <br>
                                    <img src="{{ asset('public/img/projects/'. $UserProject->project_photo) }}" width="95px" style=" border-radius: 8px; " /> 
                                </div>
                                <div class="col-sm-4">
                            @else
                                <div class="col-sm-6">
                            @endif
                                
                                <div class="form_group">
                                    
                            <label>
                                @if($UserProject->project_photo != NULL) 
                                    Change
                                @else
                                    Upload
                                @endif
                                
                                Project Image <span class="small">(Max-size: 1 MB)</span>: </label>
                            <input type="file" name="project{{ $Prjcnt }}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                            
                                </div>
                            </div>
                            
                             
                            
                            
                          </div>
                            <div class="col-sm-12">
                              <div class="form_group">
                                <input type="url" name="project{{ $Prjcnt }}link" placeholder="Enter Project Link (Optional)" autocomplete="off" value="{{ $UserProject->project_link }}" />
                              </div>
                            </div>
                            
                            <div class="col-sm-12">
                              <div class="form_group">
                                <label
                                  >1. What was the objective of the project? </label
                                >
                                <textarea name="project{{ $Prjcnt }}Objective" placeholder="Write Your Answer *" autocomplete="off"  oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required>{{ $UserProject->project_objective }}</textarea>
                                <p class="word-counter">0/150 Words</p>
                                
                              </div>
                              <div class="form_group">
                                <label>2. What was your role in the project? </label>
                                <textarea name="project{{ $Prjcnt }}Role" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required>{{ $UserProject->project_role }}</textarea>
                                <p class="word-counter">0/150 Words</p>
                                
                              </div>
                              <div class="form_group">
                                <label
                                  >3. What were the outcomes and impact of the
                                  project? </label
                                >
                                <textarea name="project{{ $Prjcnt }}Outcome" placeholder="Write Your Answer *" oninput="checkWordLen(this, 150)"  onblur="truncateExcess(this, 150)" required>{{ $UserProject->project_outcome }}</textarea>
                                <p class="word-counter">0/150 Words</p>
                                
                              </div>
                            </div>
                            
                          </div>  
                    
                @php $Prjcnt++; @endphp
                
                @endforeach
                
            @endif 
                          
                        </div>
                      
                      <div> <button type="button" id="addProjectButton" class="btn tj-btn-primary-new" > + Add Project </button> </div> 
                      
                    </fieldset>
                    
                    

                  <!-- Awards Details -->
                  <fieldset>
                    <legend>Awards Details</legend>
                    
                    
                      <div id="awardsContainer"> 
                        
                            <p class="description">(Share up to 2 awards that highlight your journey and impact)</p>
                      
                @if ($UserAwards->isEmpty())
                
                          <!-- Initial Award Input Fields -->
                    <div class="award-group" id="award1">
                          <br>
                          <h6> Award 1 details: </h6>
                          <hr>
                                  
                          <div class="row">
                          <div class="col-lg-5 col-12">
                            <div class="form_group">
                              <input type="text" name="awd1title" placeholder="Enter Award Title" autocomplete="off" /> 
                            </div>
                          </div>
                          <div class="col-lg-5 col-12">
                            <div class="form_group">
                              <input type="text" name="awd1body" placeholder="Enter Awarding Body" autocomplete="off" />
                            </div>
                          </div>

                          <div class="col-lg-2 col-12">                             
                            <div class="form_group">                           
                              <input type="number" name="awd1year" min="1900" max="2100" step="1" placeholder="YYYY" />                         
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form_group">
                              <label>Upload Award Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="awd1file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                            </div>
                          </div>


                        </div>
                            
                        <div class="row">
                          
                          
                          <div class="col-sm-12 mt-2">
                            <div class="form_group">
                              <label>Why did you receive this award/recognition?</label>
                              <textarea name="awd1desc1" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)"></textarea>
                                <p class="word-counter">0/150 Words</p>
                            </div>
                            <div class="form_group">
                              <label>How did it impact your career?</label>
                              <textarea name="awd1desc2" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)"></textarea>
                                <p class="word-counter">0/150 Words</p>
                            </div>
                          </div>
                          
                          
                        </div>                        
                        <!-- Award ends -->
                        
                      </div>
              
                @else
                    
                    @php $Awdcnt = 1; @endphp 
                    @foreach($UserAwards as $UserAward)
                
                    <div class="award-group" id="award{{ $Awdcnt }}">
                      <br>
                      <h6> Award {{ $Awdcnt }} details: </h6>
                      <hr>
                    
                    <input type="hidden" name="awd{{ $Awdcnt }}id" value="{{ $UserAward->id }}">
                    
                      <div class="row">
                      <div class="col-lg-5 col-12">
                        <div class="form_group">
                          <input type="text" name="awd{{ $Awdcnt }}title" placeholder="Enter Award Title" value="{{ $UserAward->award_title }}" autocomplete="off" /> 
                        </div>
                      </div>
                      <div class="col-lg-5 col-12">
                        <div class="form_group">
                          <input type="text" name="awd{{ $Awdcnt }}body" placeholder="Enter Awarding Body" value="{{ $UserAward->awarding_body }}" autocomplete="off" />
                        </div>
                      </div>

                      <div class="col-lg-2 col-12">                             
                        <div class="form_group">                           
                          <input type="number" name="awd{{ $Awdcnt }}year" min="1900" max="2100" step="1" value="{{ $UserAward->year }}" placeholder="YYYY" />                         
                        </div>
                      </div>
                    
                        @if($UserAward->award_photo != NULL)
                        <div class="col-sm-2">  
                            <img src="{{ asset('public/img/awards/'. $UserAward->award_photo) }}" width="95px" style=" border-radius: 8px; " /> 
                        </div>
                        <div class="col-sm-10">
                        @else
                            <div class="col-sm-12">
                        @endif
                      
                        <div class="form_group">
                            
                    
                        
                           <label>
                        @if($UserAward->award_photo != NULL)
                            Change
                         @else
                            Upload
                        @endif   
                               Award Image <span class="small">(Max-size: 1 MB)</span>:</label>
                          <input type="file" name="awd{{ $Awdcnt }}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                   
                            
                          
                        </div>
                      </div>


                    </div>
                        
                    <div class="row">
                      
                      
                      <div class="col-sm-12 mt-2">
                        <div class="form_group">
                          <label>Why did you receive this award/recognition?</label>
                          <textarea name="awd{{ $Awdcnt }}desc1" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)">{{ $UserAward->whyreceiving }}</textarea>
                            <p class="word-counter">0/150 Words</p>
                        </div>
                        <div class="form_group">
                          <label>How did it impact your career?</label>
                          <textarea name="awd{{ $Awdcnt }}desc2" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)">{{ $UserAward->careerimpact }}</textarea>
                            <p class="word-counter">0/150 Words</p>
                        </div>
                      </div>
                      
                      
                    </div>                        
                    <!-- Award ends -->
                    
                  </div> 
                
                    @php $Awdcnt++; @endphp
                
                    @endforeach
                
                @endif
              
                  </div>
          
                  <div> <button type="button" id="addAwardButton" class="btn tj-btn-primary-new" > + Add Award </button> </div>
                      
                      

                        
                    </fieldset>

                  </div>

                  <div class="tab">

                      
                   <fieldset>
                    <legend>Testimonials</legend>
                        
                    <div id="testimonialsContainer"> 
                    
                        <p class="description">(Share testimonials that highlight your journey and impact)</p>
                        
                @if ($UserTestimonials->isEmpty())
                
                    <!-- Initial Project Input Fields -->
                    <div class="testimonial-group" id="testimonial1">
                        <br>
                        <h6> Testimonial 1 details: </h6>
                        <hr>
                                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form_group">
                                <label>Name:</label>
                              <input type="text" name="tstm1name" placeholder="Enter Client's Name" autocomplete="off" /> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form_group">
                          <label>Upload Client's Image <span class="small">(Max-size: 1 MB)</span>:</label>
                          <input type="file" name="tstm1file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        
                      <div class="col-sm-6">
                        <div class="form_group">
                          <input type="text" name="tstm1designation" placeholder="Enter Designation" autocomplete="off" />
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form_group">
                          <input type="text" name="tstm1company" placeholder="Enter Company Name" autocomplete="off" />
                        </div>
                      </div>
                      
                    </div>
                      
                    <div class="row">
                         
                      <div class="col-sm-12">
                        <div class="form_group">
                          <label>Content</label>
                          <textarea name="tstm1content" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 70)" onblur="truncateExcess(this, 70)"></textarea>
                            <p class="word-counter">0/70 Words</p>
                        </div>
                      </div>
                      
                    </div>
                      
                    </div>
                
                @else
                
                    @php $Tstmcnt = 1; @endphp 
                    @foreach($UserTestimonials as $UserTestimonial)
                    
                        
                        <!-- Initial Project Input Fields -->
                        <div class="testimonial-group" id="testimonial{{ $Tstmcnt }}">
                            <br>
                            <h6> Testimonial {{ $Tstmcnt }} details: </h6>
                            <hr>
                        
                        <input type="hidden" name="tstm{{ $Tstmcnt }}id" value="{{ $UserTestimonial->id }}">
                                
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <label>Name:</label>
                                  <input type="text" name="tstm{{ $Tstmcnt }}name" placeholder="Enter Client's Name" autocomplete="off" value="{{ $UserTestimonial->client_name }}" /> 
                                </div>
                            </div>
                            
                            
                            @if($UserTestimonial->client_photo != NULL)
                             
                             <div class="col-sm-2">
                            <img src="{{ asset('public/img/testimonials/'. $UserTestimonial->client_photo) }}" width="95px" style=" border-radius: 8px; " /> 
                                </div>
                                <div class="col-sm-4">
                            @else
                                <div class="col-sm-6">
                            @endif
                             
                            <div class="form_group">
                                
                     
                        
                        
                               <label>
                                @if($UserTestimonial->client_photo != NULL)
                                   Change 
                                @else
                                   Upload
                                @endif
                                   Client's Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="tstm{{ $Tstmcnt }}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                        
                        
                             
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            
                          <div class="col-sm-6">
                            <div class="form_group">
                              <input type="text" name="tstm{{ $Tstmcnt }}designation" placeholder="Enter Designation" autocomplete="off" value="{{ $UserTestimonial->client_position }}" />
                            </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="form_group">
                              <input type="text" name="tstm{{ $Tstmcnt }}company" placeholder="Enter Company Name" autocomplete="off" value="{{ $UserTestimonial->client_company }}" />
                            </div>
                          </div>
                          
                        </div>
                          
                        <div class="row">
                             
                          <div class="col-sm-12">
                            <div class="form_group">
                              <label>Content</label>
                              <textarea name="tstm{{ $Tstmcnt }}content" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 70)" onblur="truncateExcess(this, 70)">{{ $UserTestimonial->client_review }}</textarea>
                                <p class="word-counter">0/70 Words</p>
                            </div>
                          </div>
                          
                        </div>
                          
                        </div>
                        
                    
                    @php $Tstmcnt++; @endphp
                    @endforeach
                
                @endif
                        
                        
                      </div>
                    
                    <div> <button type="button" id="addTestimonialButton" class="btn tj-btn-primary-new" > + Add Testimonial </button> </div> 
                      

                  </fieldset>

                    
                   <fieldset>
                    <legend>Blogs</legend>
                        
                    <div id="blogsContainer"> 
                    
                        <p class="description">(Share up to 3 blogs and social media posts highlight your journey and impact)</p>
                    
            @if ($UserBlogs->isEmpty())
                        <!-- Initial Blog Input Fields -->
                    <div class="blog-group" id="blog1">
                            <br>
                            <h6> Blog 1 details: </h6>
                            <hr>
                                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <label>Blog Title:</label>
                                  <input type="text" name="blog1title" placeholder="Enter Blog Title" autocomplete="off" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form_group">
                              <label>Upload Blog Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="blog1file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            
                          <div class="col-sm-12">
                            <div class="form_group">
                                <label>Blog Link (Complete URL):</label>
                              <input type="url" name="blog1link" placeholder="Enter blog link" autocomplete="off" />
                            </div>
                          </div>
                           
                          
                        </div>
                           
                    </div> 
            
            @else
                
                @php $Blgcnt = 1; @endphp 
                @foreach($UserBlogs as $UserBlog)
                     
                        <!-- Initial Blog Input Fields -->
                    <div class="blog-group" id="blog{{ $Blgcnt }}">
                            <br>
                            <h6> Blog {{ $Blgcnt }} details: </h6>
                            <hr>
                        
                        <input type="hidden" name="blog{{ $Blgcnt }}id" value="{{ $UserBlog->id }}">
                                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <label>Blog Title:</label>
                                  <input type="text" name="blog{{ $Blgcnt }}title" placeholder="Enter Blog Title" autocomplete="off" value="{{ $UserBlog->blog_title }}" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form_group">
                        
                        
                              <label>Upload Blog Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="blog{{ $Blgcnt }}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                              
                        @if($UserBlog->blog_image !== NULL)
                            
                            <label>Blog Image  </label> <br> 
                            <img src="{{ asset('public/img/blogs/'. $UserBlog->blog_image) }}" width="95px" style=" border-radius: 8px; " /> 
                        @endif
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            
                          <div class="col-sm-12">
                            <div class="form_group">
                                <label>Blog Link (Complete URL):</label>
                              <input type="url" name="blog{{ $Blgcnt }}link" placeholder="Enter blog link" autocomplete="off" value="{{ $UserBlog->blog_link }}" />
                            </div>
                          </div>
                           
                          
                        </div>
                           
                    </div> 
                
                @php $Blgcnt++; @endphp
                @endforeach
            
            @endif
            
                    
                  </div>
                    
                    <div> <button type="button" id="addBlogButton" class="btn tj-btn-primary-new" > + Add Blog </button> </div> 
                    
                    <input type="hidden" name="UserIDCurrent" value="{{ $user->id }}" required />
                    
             @php 
                    //If User has WAH Story
                if($WAHUserStory != null){
                    $StoryType = "OLDStory";
                }else{
                    $StoryType = "NEWStory";
                }
            @endphp
                
                    <input type="hidden" name="StoryType" id="StoryType" value="{{ $StoryType }}" required />
                      

                  </fieldset>

                   </div>

                   <div class="tab"> 

                    <fieldset class="pb-5">
                      <legend>Story content:</legend>
              <div id="storysection">
                      <!-- <div class="section-header-new mt-4">
                          <h5 class="section-title">Story content</h5>
                        </div> -->
                @php 
                    //If User has WAH Story
                    if($WAHUserStory != null){
                @endphp
                    
                    <div class="col-sm-12">
                        <div class="form_group">
                          <label>Story Title: </label>
                          <input type="text" name="WAH_storyTitle" id="WAH_storyTitle" value="{{ $WAHUserStory->title }}">
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form_group">
                        <label
                          >Content </label>
                        <textarea
                          type="text"
                          name="WAH_Story"
                          id="WAH_Story"                             
                          style="height: 100px" required>{{ $WAHUserStory->content }}</textarea> 
                            
                      </div>
                    </div>
                
                @php 
                    }elseif($UserStory != null){ //If User Doesn't has WAH Story
                @endphp
                    
                    <div class="col-sm-12">
                        <div class="form_group">
                          <label>Story Title-: </label>
                          <input type="text" name="WAH_storyTitle" id="WAH_storyTitle" value="{{ $UserStory->title }}">
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form_group">
                        <label
                          >Content </label>
                        <textarea
                          type="text"
                          name="WAH_Story"
                          id="WAH_Story"                             
                          style="height: 100px" required>{{ $UserStory->storycontent }}</textarea> 
                            
                      </div>
                    </div>
                    
                @php 
                    }else{ //If User Doesn't has WAH Story
                @endphp
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label>Enter a Title: (Max 10 Words) </label>
                                <input type="text" name="freshstoryTitle" id="freshstorytitle" placeholder="Give a title to your story*" oninput="checkWordLen(this, 10)" onblur="truncateExcess(this, 10)">
                                <p class="word-counter">0/10 Words</p>
                          </div>
                        </div>
                            
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label
                              >1.  What important skills do you think have helped you succeed, and how did you develop them during your journey? </label
                            >
                            <textarea
                              type="text"
                              name="ques1"
                              id="ques1" 
                              placeholder="Write Your Answer *"
                              autocomplete="off"                              
                              style="height: 100px"
                              oninput="checkWordLen(this, 250); this.className = ''"
                              onblur="truncateExcess(this, 250)" required></textarea>
                                <p class="word-counter">0/250 Words</p>
                                
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label
                              >2. How do you deal with tough times, and what have you learned from getting through difficult situations? </label
                            >
                            <textarea
                              type="text"
                              name="ques2"
                              id="ques2" 
                              placeholder="Write Your Answer *"
                              autocomplete="off" 
                              style="height: 100px"
                              oninput="checkWordLen(this, 250); this.className = ''"
                              onblur="truncateExcess(this, 250)" required></textarea>
                                <p class="word-counter">0/250 Words</p>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label
                              >3. How do you think you've made a difference in your work, community, or in other people's lives? </label
                            >
                            <textarea
                              type="text"
                              name="ques3"
                              id="ques3" 
                              placeholder="Write Your Answer *"
                              autocomplete="off"
                              style="height: 100px"
                              oninput="checkWordLen(this, 250); this.className = ''"
                              onblur="truncateExcess(this, 250)" required></textarea>
                                <p class="word-counter">0/250 Words</p>
                                
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label>4. Can you recall a pivotal point in your journey where you felt you had reached a significant milestone in success?
                            </label>
                            <textarea
                              type="text"
                              name="ques4"
                              id="ques4" 
                              placeholder="Write Your Answer *"
                              autocomplete="off"
                              style="height: 100px"
                              oninput="checkWordLen(this, 250); this.className = ''"
                              onblur="truncateExcess(this, 250)" required></textarea>
                                <p class="word-counter">0/250 Words</p>
                          </div>
                        </div>

                        
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label>5. How do you define success, and what goals have you set for yourself to achieve it? </label>
                            <textarea
                              type="text"
                              name="ques5"
                              id="ques5"
                              oninput="checkWordLen(this, 250); this.className = ''"
                              placeholder="Write Your Answer *"
                              autocomplete="off"
                              style="height: 100px"
                              onblur="truncateExcess(this, 250)" required></textarea>
                                <p class="word-counter">0/250 Words</p>
                          </div>
                        </div>
                @php 
                
                    } //If User Doesn't has WAH Story
                
                @endphp
                        
                        

            </div>  
      <a href="javascript:void(0);" class="btn btn-gradient-border btn-glow my-3" id="generateStoryBtn">
          Enhance your story with AI 
          <i class="fa-light fa-wand-magic-sparkles"></i>
      </a>
      

    <div id="newStoryContainer">

      <div class="col-sm-12">
        <div class="form_group">
          <label>Story Title: </label>
          <input type="text" name="storyTitle" id="newstorytitle" placeholder="Give a title to your story*">
        </div>
      </div>

      
      <div class="col-sm-12">
          
          <button type="button" id="SkipToAIStory" class="btn tj-btn-primary-new"><i class="fa fa-fast-backward"></i> Continue with AI Enhanced Story </button>
          
          
        <div class="form_group" id="AiGeneratedStory">

          <label>Story - Enhanced with Ai <span style=" padding: 3px 6px; margin: 0; " class="btn btn-gradient-border btn-glow ms-2"> <i class="fa-light fa-wand-magic-sparkles"></i> </span>  </label> 
          <textarea
            type="text"
            name="generatedStory" 
            id="generatedStory"
            placeholder="Write Your Answer *" 
            style="height: 100px"
          ></textarea>
          
        </div>
         
      </div>

    </div>
    
    <button type="button" id="SkipToOriginalStory" class="btn tj-btn-primary-new">Skip to Original <i class="fa fa-fast-forward"></i></button>
  


                    </fieldset>

                  </div>

  <div style="overflow:auto;">
  <span id="autosaved" style="color: #0e8121; font-size: 12px;">Auto Saved <i class="fa fa-check"></i></span>
  <div style="float:right;" id="previousnextbtns"> 
   
      <button type="button" id="prevBtn" class="btn tj-btn-primary-new me-3" onclick="nextPrev(-1)" style="display: inline;">
          <i class="fa fa-arrow-left"></i> Previous
      </button>
      <button type="button" id="nextBtn" class="btn tj-btn-primary-new" onclick="nextPrev(1)">
        Next <i class="fa fa-arrow-right"></i>
      </button> 
           

    </div>
  </div>


                </form>

              </div>
              
                <p class="text-success mt-4" style=" font-size: 12px; text-align: right;">
                      <strong>Note:</strong> 
                      Your progress is being saved automatically as you move to the next step. 
                </p>
              
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTACT SECTION END -->
  
 
   
    </main>

    <!-- FOOTER AREA START -->
    <footer class="tj-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-logo-box">
                        <a href="/"><img src="https://www.wahstory.com/images/logos/logo-white.png" alt=""></a>
                    </div>
                    
                    <div class="copy-text">
                        <p>&copy; @php echo date('Y'); @endphp All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

     

    <!-- CSS here -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('public/js/backToTop.js') }}"></script>
    <script src="{{ asset('public/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('public/js/appear.min.js') }}"></script>
    <script src="{{ asset('public/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/js/gsap.min.js') }}"></script>
    <script src="{{ asset('public/js/one-page-nav.js') }}"></script>
    <script src="{{ asset('public/js/lightcase.js') }}"></script>
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/js/odometer.min.js') }}"></script>
    <script src="{{ asset('public/js/magnific-popup.js') }}"></script>

    <script src="{{ asset('public/js/main.js') }}"></script>
   
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
 
 

      
 <script>
    @if ($UserProjects->isEmpty())
        
        @php
            $addPrjCnt = 1;
        @endphp
    
    @else
        @php
            $count = count($UserProjects);   
            $addPrjCnt = $count;
        @endphp
    
    @endif
  
    
        let ProjectsCount = {{ $addPrjCnt }};

        document.getElementById('addProjectButton').addEventListener('click', function() {
            
        if(ProjectsCount >= 2) {
            alert("Max 2 Allowed!");
        }else{
            ProjectsCount++;
            
            const projectsContainer = document.getElementById('projectsContainer');

            const projectGroup = document.createElement('div');
            projectGroup.className = 'project-group';
            projectGroup.id = `project${ProjectsCount}`;

            projectGroup.innerHTML = ` 
                <br>
            <div class="row">
                <div class="col-sm-6">
                    <h6> Project ${ProjectsCount} details: </h6>
                </div>
                
                <div class="col-sm-6" style="text-align: right;">
                    <button type="button" class="deleteProjectButton btn btn-danger m-0" onclick="deleteProject(${ProjectsCount})"> <i class="fa-solid fa-trash"></i> </button>
                </div>
            </div>
                
                <hr>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form_group">
                        <label>Project Name:</label>
                      <input type="text" name="project${ProjectsCount}name" placeholder="Enter Project Name" autocomplete="off" /> 
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form_group">
                      <label>Upload Project Image <span class="small">(Max-size: 1 MB)</span>:</label>
                      <input type="file" name="project${ProjectsCount}file"  accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                    </div>
                </div>
              
            </div>
                
              <div class="col-sm-12">
                <div class="form_group">
                  <input type="url" name="project${ProjectsCount}link" placeholder="Enter Project Link (Optional)" autocomplete="off" />
                </div>
              </div>
              
              <div class="col-sm-12">
                <div class="form_group">
                  <label
                    >1. What was the objective of the project?</label
                  >
                  <textarea name="project${ProjectsCount}Objective" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required></textarea>
                                <p class="word-counter">0/150 Words</p>
                </div>
                <div class="form_group">
                  <label>2. What was your role in the project?</label>
                  <textarea name="project${ProjectsCount}Role" placeholder="Write Your Answer *" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required></textarea>
                                <p class="word-counter">0/150 Words</p>
                </div>
                <div class="form_group">
                  <label
                    >3. What were the outcomes and impact of the
                    project? </label>
                  <textarea name="project${ProjectsCount}Outcome" placeholder="Write Your Answer * " oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required></textarea>
                                <p class="word-counter">0/150 Words</p>
                </div>
              </div>
              
              
            `;

            projectsContainer.appendChild(projectGroup);
            
            } //if less than 4
            
        });
         function deleteProject(projectNumber) {
            const projectGroup = document.getElementById(`project${projectNumber}`);
            projectGroup.remove();
            
            //  projectNumber--; // Subtract 1 from ProjectsCount
            // console.log(`Remaining Projects: ${projectNumber}`);
            ProjectsCount--;
             
        }
    </script>
      
    <script>
    @if ($UserExperiences->isEmpty())
        
        @php
            $addExpCnt = 1;
        @endphp
    
    @else
        @php
            $count = count($UserExperiences);   
            $addExpCnt = $count;
        @endphp
    
    @endif
     
        let ExperiencesCount = {{ $addExpCnt }};
        
        
        // Function to initialize datepicker
        function initializeDatepicker() {
            $('.formatedCalendar').datepicker({
                format: "yyyy-mm",
                startView: "months",
                minViewMode: "months",
                autoclose: true
            });
        }
        
        // Initialize datepicker for existing elements on page load
        $(document).ready(function() {
            initializeDatepicker();
        });
        

        document.getElementById('addExperienceButton').addEventListener('click', function() {
            
        if(ExperiencesCount >= 3) {
            alert("Max 3 Allowed!");
        }else{
            ExperiencesCount++;
            
            const experiencesContainer = document.getElementById('experiencesContainer');

            const experienceGroup = document.createElement('div');
            experienceGroup.className = 'experience-group';
            experienceGroup.id = `experience${ExperiencesCount}`;

            experienceGroup.innerHTML = ` 
                <br>
            <div class="row">
                <div class="col-sm-6">
                    <h6> Experience ${ExperiencesCount} details: </h6>
                </div>
                
                <div class="col-sm-6" style="text-align: right;">
                    <button type="button" class="deleteExperienceButton btn btn-danger m-0" onclick="deleteExperience(${ExperiencesCount})"> <i class="fa-solid fa-trash"></i> </button>
                </div>
            </div>
                
                <hr>
            
            <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form_group d-flex align-items-center">
                    <input type="text" name="exp${ExperiencesCount}company" placeholder="Enter Company Name" autocomplete="off" /> 
                  </div>
                </div>
                <div class="col-lg-6 col-12  ">
                  <div class="form_group">
                    <input type="text" name="exp${ExperiencesCount}role" placeholder="Your Role In The Company" autocomplete="off" />
                  </div>
                </div>

              </div>
                  
            <div class="row">
                
                <div class="col-lg-12 col-12"> 
                
                <div class="form-check">
                    <input class="form-check-input fs-5" type="checkbox" id="exp${ExperiencesCount}currentworking" name="exp${ExperiencesCount}currentworking" value="yes" onchange="toggleExpInput('${ExperiencesCount}')">
                    <label class="form-check-label fs-5" for="exp${ExperiencesCount}currentworking"> I am currently working in this role
                    </label>
                </div>
                
            </div>
            
            </div>
              <div class="row">
                
                <div class="col-lg-6 col-12">                             
                  <div class="form_group">                              
                    <label for="start-month">From:</label>
                    <input type="text" name="exp${ExperiencesCount}start-month" class="form-control formatedCalendar" placeholder="Select Year and Month" />                              
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form_group">
                    <label for="end-month">To:</label>
                    <input type="text" name="exp${ExperiencesCount}end-month" class="form-control formatedCalendar"  placeholder="Select Year and Month" />
                  </div>
                </div> 
                
              </div> 
              
              <div class="row">

                <div class="col-sm-12 mt-2">
                  <div class="form_group">
                    <label>Description of Responsibilities and
                      Achievements *</label>
                    <textarea name="exp${ExperiencesCount}desc" placeholder="Write Your Answer *" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)" required></textarea>
                                <p class="word-counter">0/150</p>
                  </div>
                </div>

              </div>
              <!-- exp ends -->
              
              
            `;

            experiencesContainer.appendChild(experienceGroup);
            
            initializeDatepicker();
            
            
            } //if less than 3
            
        });
         function deleteExperience(experienceNumber) {
            const experienceGroup = document.getElementById(`experience${experienceNumber}`);
            experienceGroup.remove();
             
            ExperiencesCount--;
             
        }
    </script>
      
    <script>
    
    @if ($UserEducations->isEmpty())
        
        @php
            $addEduCnt = 1;
        @endphp
    
    @else
        @php
            $count = count($UserEducations);   
            $addEduCnt = $count;
        @endphp
    
    @endif
     
    
        let EducationsCount = {{ $addEduCnt }};

        document.getElementById('addEducationButton').addEventListener('click', function() {
            
        if(EducationsCount >= 3) {
            alert("Max 3 Allowed!");
        }else{
            EducationsCount++;
            
            const educationsContainer = document.getElementById('educationsContainer');

            const educationGroup = document.createElement('div');
            educationGroup.className = 'education-group';
            educationGroup.id = `education${EducationsCount}`;

            educationGroup.innerHTML = ` 
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h6> Education ${EducationsCount} details: </h6>
                    </div>
                    
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="button" class="deleteEducationButton btn btn-danger m-0" onclick="deleteEducation(${EducationsCount})"> <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </div>
                    
                    <hr>
                
                <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form_group">
                        <input type="text" name="edu${EducationsCount}course" placeholder="Enter Course Name" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form_group d-flex align-items-center">
                        <input type="text" name="edu${EducationsCount}university" placeholder="Enter University Name" autocomplete="off" /> 
                      </div>
                    </div>
                    
    
              </div>
                
                <div class="row">
                
                	<div class="col-lg-12 col-12"> 
                	
                		<div class="form-check">
                			<input class="form-check-input fs-5" type="checkbox" id="edu${EducationsCount}currentpursuing" name="edu${EducationsCount}currentpursuing" value="yes" onchange="toggleEduInput('${EducationsCount}')">
                			<label class="form-check-label fs-5" for="edu${EducationsCount}currentpursuing"> I am currently pursuing
                			</label>
                		</div>
                		
                	</div>
                
                </div>
                  
                  
                  
              <div class="row">
                
                <div class="col-lg-6 col-12">                             
                  <div class="form_group">                              
                    <label>From:</label>
                    <input type="text" name="edu${EducationsCount}start-month" class="form-control formatedCalendar" placeholder="Select Year and Month" />                              
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form_group">
                    <label>To:</label>
                    <input type="text" name="edu${EducationsCount}end-month" class="form-control formatedCalendar"  placeholder="Select Year and Month" />
                  </div>
                </div> 
                
              </div>                        
              <!-- Edu ends -->
              
            `;

            educationsContainer.appendChild(educationGroup);
            
            initializeDatepicker();
            
            } //if less than 3
            
        });
         function deleteEducation(educationNumber) {
            const educationGroup = document.getElementById(`education${educationNumber}`);
            educationGroup.remove();
             
            EducationsCount--;
             
        }
    </script>
      
    <script>
    
        @if ($UserAwards->isEmpty())
            
            @php
                $addAwdCnt = 1;
            @endphp
        
        @else
            @php
                $count = count($UserAwards);   
                $addAwdCnt = $count;
            @endphp
        
        @endif
    
        let AwardsCount = {{ $addAwdCnt }};

        document.getElementById('addAwardButton').addEventListener('click', function() {
            
        if(AwardsCount >= 2) {
            alert("Max 2 Allowed!");
        }else{
            AwardsCount++;
            
            const awardsContainer = document.getElementById('awardsContainer');

            const awardGroup = document.createElement('div');
            awardGroup.className = 'award-group';
            awardGroup.id = `award${AwardsCount}`;

            awardGroup.innerHTML = ` 
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h6> Award ${AwardsCount} details: </h6>
                    </div>
                    
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="button" class="deleteAwardButton btn btn-danger m-0" onclick="deleteAward(${AwardsCount})"> <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </div>
                    
                    <hr>
                
                <div class="row">
                        <div class="col-lg-5 col-12">
                          <div class="form_group">
                            <input type="text" name="awd${AwardsCount}title" placeholder="Enter Award Title" autocomplete="off" /> 
                          </div>
                        </div>
                        <div class="col-lg-5 col-12">
                          <div class="form_group">
                            <input type="text" name="awd${AwardsCount}body" placeholder="Enter Awarding Body" autocomplete="off" />
                          </div>
                        </div>

                        <div class="col-lg-2 col-12">                             
                          <div class="form_group">      
                            <input type="number" name="awd${AwardsCount}year" min="1900" max="2100" step="1" placeholder="YYYY" />                         
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form_group">
                            <label>Upload Award Image <span class="small">(Max-size: 1 MB)</span>:</label>
                            <input type="file" name="awd${AwardsCount}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                          </div>
                        </div>

                      </div>
                          
                      <div class="row">
                        <div class="col-sm-12 mt-2">
                          <div class="form_group">
                            <label>Why did you receive this award/recognition?</label>
                            <textarea name="awd${AwardsCount}desc1" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)"></textarea>
                                <p class="word-counter">0/150 Words</p>
                          </div>
                          <div class="form_group">
                            <label>How did it impact your career?</label>
                            <textarea name="awd${AwardsCount}desc2" placeholder="Write Your Answer" autocomplete="off" oninput="checkWordLen(this, 150)" onblur="truncateExcess(this, 150)"></textarea>
                                <p class="word-counter">0/150 Words</p>
                          </div>
                        </div>
                         
                        
                      </div>       
                      <!-- Awd Ends -->
              
            `;

            awardsContainer.appendChild(awardGroup);
            
            } //if less than 3
            
        });
         function deleteAward(awardNumber) {
            const awardGroup = document.getElementById(`award${awardNumber}`);
            awardGroup.remove();
             
            AwardsCount--;
             
        }
    </script>
    
    <script>
    
        @if ($UserTestimonials->isEmpty())
            
            @php
                $addTsmCnt = 1;
            @endphp
        
        @else
            @php
                $count = count($UserTestimonials);   
                $addTsmCnt = $count;
            @endphp
        
        @endif
    
        let TestimonialsCount = {{ $addTsmCnt }};

        document.getElementById('addTestimonialButton').addEventListener('click', function() {
            
        if(TestimonialsCount >= 15) {
            alert("Max 15 Allowed!");
        }else{
            TestimonialsCount++;
            
            const testimonialsContainer = document.getElementById('testimonialsContainer');

            const testimonialGroup = document.createElement('div');
            testimonialGroup.className = 'testimonial-group';
            testimonialGroup.id = `testimonial${TestimonialsCount}`;

            testimonialGroup.innerHTML = ` 
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h6> Testimonial ${TestimonialsCount} details: </h6>
                    </div>
                    
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="button" class="deleteTestimonialButton btn btn-danger m-0" onclick="deleteTestimonial(${TestimonialsCount})"> <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </div>
                    
                    <hr>
                
                <div class="row">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <label>Name:</label>
                                  <input type="text" name="tstm${TestimonialsCount}name" placeholder="Enter Client's Name" autocomplete="off" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form_group">
                              <label>Upload Client's Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="tstm${TestimonialsCount}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            
                          <div class="col-sm-6">
                            <div class="form_group">
                              <input type="text" name="tstm${TestimonialsCount}designation" placeholder="Enter Designation" autocomplete="off" />
                            </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="form_group">
                              <input type="text" name="tstm${TestimonialsCount}company" placeholder="Enter Company Name" autocomplete="off" />
                            </div>
                          </div>
                          
                        </div>
                          
                        <div class="row">
                             
                          <div class="col-sm-12">
                            <div class="form_group">
                              <label>Content</label>
                              <textarea name="tstm${TestimonialsCount}content" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 70)" onblur="truncateExcess(this, 70)"></textarea>
                                <p class="word-counter">0/70 Words</p>
                            </div>
                          </div>
                          
                        </div>
              
            `;

            testimonialsContainer.appendChild(testimonialGroup);
            
            } //if less than 3
            
        });
         function deleteTestimonial(testimonialNumber) {
            const testimonialGroup = document.getElementById(`testimonial${testimonialNumber}`);
            testimonialGroup.remove();
             
            TestimonialsCount--;
        }
    </script>
    
    <script>
    
        @if ($UserBlogs->isEmpty())
            
            @php
                $addBlgCnt = 1;
            @endphp
        
        @else
            @php
                $count = count($UserBlogs);   
                $addBlgCnt = $count;
            @endphp
        
        @endif
    
        let BlogsCount = {{ $addBlgCnt }};

        document.getElementById('addBlogButton').addEventListener('click', function() {
            
        if(BlogsCount >= 3) {
            alert("Max 3 Allowed!");
        }else{
            BlogsCount++;
            
            const blogsContainer = document.getElementById('blogsContainer');

            const blogGroup = document.createElement('div');
            blogGroup.className = 'blog-group';
            blogGroup.id = `blog${BlogsCount}`;

            blogGroup.innerHTML = ` 
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h6> Blog ${BlogsCount} details: </h6>
                    </div>
                    
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="button" class="deleteBlogButton btn btn-danger m-0" onclick="deleteBlog(${BlogsCount})"> <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </div>
                    
                    <hr>
                
                <div class="row">
                            <div class="col-sm-6">
                                <div class="form_group">
                                    <label>Blog Title:</label>
                                  <input type="text" name="blog${BlogsCount}title" placeholder="Enter Blog Title" autocomplete="off" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form_group">
                              <label>Upload Blog Image <span class="small">(Max-size: 1 MB)</span>:</label>
                              <input type="file" name="blog${BlogsCount}file" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            
                          <div class="col-sm-12">
                            <div class="form_group">
                                <label>Blog Link (Complete URL):</label>
                              <input type="url" name="blog${BlogsCount}link" placeholder="Enter blog link" autocomplete="off" />
                            </div>
                          </div>
                           
                          
                        </div>
              
            `;

            blogsContainer.appendChild(blogGroup);
            
            } //if less than 4
            
        });
         function deleteBlog(blogNumber) {
            const blogGroup = document.getElementById(`blog${blogNumber}`);
            blogGroup.remove();
             
            BlogsCount--;
        }
    </script>
      
 
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
       $(document).ready(function() {
         $('#MultipleIndustrySelect').select2({
          tags: false,
            placeholder: "Search Industry *", // Set the placeholder text
          width: 'resolve', // Adjust width to fit container    
          maximumSelectionLength: 1,
          language: {
                maximumSelected: function () {
                    return "You can only select 1 Industry"; // Custom message
                }
            }       
         });

         $('#MultipleSkillSelect').select2({
          tags: false,
            placeholder: "Search skills *", // Set the placeholder text
          width: 'resolve', // Adjust width to fit container
          maximumSelectionLength: 3,
          language: {
                maximumSelected: function () {
                    return "You can only select 3 skills"; // Custom message
                }
            }
         });

         $('#MultipleToolSelect').select2({
          tags: false,
            placeholder: "Search tools *", // Set the placeholder text
          width: 'resolve', // Adjust width to fit container
          maximumSelectionLength: 6,
          language: {
                maximumSelected: function () {
                    return "You can only select 6 tools"; // Custom message
                }
            }
         });

         $('#MultipleAttributesSelect').select2({
          tags: false,
            placeholder: "Search attributes * ", // Set the placeholder text
          width: 'resolve', // Adjust width to fit container
          maximumSelectionLength: 4,
          language: {
                maximumSelected: function () {
                    return "You can only select 4 attributes"; // Custom message
                }
            }
         });

       });
    </script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next <i class='fa fa-arrow-right'></i>";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");

  if (n == 1) {
    var resp = validateForm(); // Check form validation
    // console.log(resp);

    if (resp == true) {
        
        document.getElementById("nextBtn").innerHTML = "Next <i class='fa fa-spinner fa-spin'></i>";
        // document.getElementById("nextBtn").classList.add("loading");
        
      var formData = new FormData($('#regForm')[0]); // Get all form fields
      formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token

      $.ajax({
        url: '/wahclub/savedatainsteps', // Route to your method
        type: 'POST',
        data: formData, // The FormData object 
        contentType: false, // Needed for FormData
        processData: false, // Don't process the files
        success: function(response) {
          if (response.status == "success") {
            console.log(response.status); 

            $('#autosaved').show();
            
            // If the response is successful, move to the next step
            moveToNextStep(n);
          } else {
            alert(response.status);
                console.log("Ajax Respone Error"); 
          }
        },
        error: function(xhr) {
          alert('Something went wrong! Please enter the correct details.');
          document.getElementById("nextBtn").innerHTML = "Next <i class='fa fa-arrow-right'></i>";
          // alert('Error22: ' + xhr.responseJSON.message);
        }
      });
    }
  } else {
    moveToNextStep(n); // Move to the next step without validation (for Previous button)
  }
}

function moveToNextStep(n) {
  var x = document.getElementsByClassName("tab");
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // If you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    
    const FinalStepInput = $('<input>', {
            type: 'hidden',
            name: 'final_step',
            value: 'final'
        });

        // Append the new input to the form container
        $('#regForm').append(FinalStepInput);
    
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");

  for (i = 0; i < y.length; i++) {
    // Check if the input field is required
    if (y[i].hasAttribute("required")) {
      // If the required field is empty...
      if (y[i].value == "") {
        // Add an "invalid" class to the field:
        y[i].className += " invalid";
        // Set the valid status to false:
        valid = false;
      }
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish"; 
  }

  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

</script>


<script> 

 

// $("#saveDetails").click(function(){
//   var resp = validateForm();
//   console.log(resp);

//   if(resp == true) {
 
//   var formData = new FormData($('#regForm')[0]); // Get all form fields
  
//   formData.append('_token', '{{ csrf_token() }}');

//   $.ajax({
//           url: 'savedatainsteps', // Route to the generateOtp method
//           type: 'POST',
//           data: formData, // The FormData object
//           contentType: false, // Needed for FormData
//           processData: false, // Don't process the files       
//           success: function(response) {
              
//             if(response.status == "success") {
//               console.log(response.status );
                          
//             }else{
//                 alert(response.message);
//             }
//           },
//           error: function(xhr) {
//               alert('Error: ' + xhr.responseJSON.message);
//           }
//       });

//   } //if Ends

// });
</script>



<script>

    const maxSizeInMB = 1; // Maximum file size in MB
    const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

    // Get all input fields of type file
    const imageInputs = document.querySelectorAll('input[type="file"]');

    // Add change event listener to each image input
    imageInputs.forEach(input => {
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file && file.size > maxSizeInBytes) {
                // document.getElementById('fileSizeError').style.display = 'block';
                alert("Image size exceed 1 MB. Please select image size less than 1 MB.");
                event.target.value = ''; // Clear the file input
            }
        });
    });

</script>

<script>

$('input').on('focus', function() {
    $('#autosaved').hide(); // or you can use .css('display', 'none');
});



$('#ques5').on('input', function() {
    $('#generateStoryBtn').show(); // or you can use .css('display', 'none');
});

</script>


<script>
        $(document).ready(function() {
            $('#SkipToOriginalStory').click(function() { 
                
                $('#SkipToAIStory').show();
                
                if ($('#ques5').length) {
                    if ($('#ques5').val().trim() === '') { 
                        $('#StoryType').val("OLDStory");
                    } else {
                        $('#StoryType').val("NEWStory");  
                    }
                } else {
                    $('#StoryType').val("OLDStory");  
                }
                
                $('#AiGeneratedStory').hide();
                $(this).hide();
            });
            
            $('#SkipToAIStory').click(function() { 
                
                $('#StoryType').val("AIStory");
                
                
                $('#AiGeneratedStory').show();
                $('#SkipToOriginalStory').show();
                
                $(this).hide();
                
            });
            
    $('#generateStoryBtn').click(function() { 
     
                $('#StoryType').val("AIStory");
    
            $(this).html("Enhancing Your Story <i class='fa-solid fa-loader fa-spin'></i> ");
            
            $(this).removeAttr('id').attr('id', 'generateStoryBtnNew');
            
        var formElement = document.getElementById('regForm');
        var formData = new FormData(formElement);
 
        $.ajax({ 
            url: '/wahclub/regenerate-story',
            type: 'POST',
            data: formData,
            contentType: false, // Do not set Content-Type header
            processData: false, // Do not process data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {

                //   $('#storysection').hide();

                  $('#generateStoryBtnNew').hide();

                  $('#newStoryContainer').show();
                  $('#SkipToOriginalStory').show();
                    
                    if (document.querySelector('#ques5')) {
                        // Story Is Responced In / By Questions
                        
                              $('#newstorytitle').val(response.StoryTitle);
            
                                ClassicEditor
                                .create(document.querySelector('#generatedStory'), {
                                    toolbar: false // Hide the toolbar
                                })
                                .then(editor => {
                                    const generatedContent = response.newStory;
                                    
                                    editor.setData(generatedContent);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                    }else{
                        //Story is Enhanced By OLD Story
                        ClassicEditor
                        .create(document.querySelector('#generatedStory'), {
                            toolbar: false // Hide the toolbar
                        })
                        .then(editor => {
                            const generatedContent = response.newStory;
                            
                            editor.setData(generatedContent);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                        
                    } //Story is Enhanced By OLD Story END


                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });

            });
        });
    </script>
    
    <script>
// Function to check word count and show real-time feedback
function checkWordLen(obj, wordLen) {
    var text = obj.value.trim();
    var words = text.split(/\s+/);
    var wordCount = words.length > 0 && words[0] !== "" ? words.length : 0;  // Handle empty input case
    var paragraph = obj.closest('.form_group').querySelector('.word-counter'); // Select the element by class within the same container
    
    // Always display the current word count, even if it exceeds the limit
    if (wordCount > wordLen) {
        paragraph.classList.remove('success');
        paragraph.classList.add('error');
        paragraph.innerHTML = wordCount + '/' + wordLen + ' (Word limit exceeded!)';  // Show current word count
    } else {
        paragraph.classList.remove('error');
        paragraph.classList.add('success');
        paragraph.innerHTML = wordCount + '/' + wordLen + " Words";  // Show word count within limit
    }
}

// Function to remove extra words when input loses focus
function truncateExcess(obj, wordLen) {
    var text = obj.value.trim();
    var words = text.split(/\s+/);
    
    if (words.length > wordLen) {
        obj.value = words.slice(0, wordLen).join(" ");  // Truncate to the first `wordLen` words
    }

    // Recalculate the word count and update the counter after truncation
    checkWordLen(obj, wordLen);
}
</script>

<script>
    // Check if the element with ID 'WAH_Story' exists
    if (document.querySelector('#WAH_Story')) {
        ClassicEditor
            .create(document.querySelector('#WAH_Story'), {
                toolbar: false // Hide the toolbar
            })
            .catch(error => {
                console.error(error);
            });
            $('#generateStoryBtn').show();
    }
</script>


    <script> 
        function toggleExpInput(expNumber) {
            const checkbox = document.getElementById(`exp${expNumber}currentworking`);
            const inputs = document.getElementsByName(`exp${expNumber}end-month`);
            if (inputs.length > 0) { // Check if any input elements were found
                const input = inputs[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
        }
        

    </script> 
    <script> 
        function toggleEduInput(eduNumber) {
            const checkbox = document.getElementById(`edu${eduNumber}currentpursuing`);
            const inputs = document.getElementsByName(`edu${eduNumber}end-month`);
            if (inputs.length > 0) { // Check if any input elements were found
                const input = inputs[0]; // Get the first input with that name
                input.disabled = checkbox.checked;
            }
        }
        

    </script>
     
<!--
<script>
function checkOtherIndustrySelection() {
  const select1 = document.getElementById("MultipleIndustrySelect");
const otherField = document.getElementById("otherSelectedindustry");
  
  // Check if "Other" is selected
  const isOtherSelected = Array.from(select1.options).some(option => option.selected && option.value === "Other");
  
  // Show or hide the input based on "Other" selection
  otherField.style.display = isOtherSelected ? "block" : "none";
}
</script>-->
    


   

    

</body>

</html>