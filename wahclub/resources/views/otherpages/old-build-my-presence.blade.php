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
 
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <style>
 
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
  border-color: #f12b59;
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

#generatedStory, #generateStoryBtn, #newStoryContainer{
  display: none;
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
                <div class="col-12 text-center">

                    <div class="logo-box">
                        <a href="/">
                            <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo">
                        </a>
                    </div>
 
                     
                </div>
            </div>
        </div>
    </header>
    <header class="tj-header-area header-2 header-sticky sticky-out">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">

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
            <div class="col-lg-12 col-md-12 order-1 order-md-1">
              <div class="contact-form-box wow fadeInLeft pt-4" data-wow-delay=".3s">
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
                          <label for="honorifics">Title: *</label>
                          <select name="honorifics" id="honorifics">
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
                          <label for="fname">First Name: </label>
                          <input
                            type="text"
                            name="firstname"
                            oninput="this.className = ''"
                            id="fname"
                            placeholder="Enter Your First Name *" 
                            value="{{ $user->firstname }}"
                            required
                          />
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form_group">
                          <label for="lname">Last Name: </label>
                          <input
                            type="text"
                            name="lastname"
                            oninput="this.className = ''"
                            id="lname"
                            placeholder="Enter Your Last Name *" 
                            value="{{ $user->lastname }}"
                            required
                          />
                        </div>
                      </div> 

                      <div class="col-sm-6">
                        <div class="form_group" style=" text-align: right; ">                
                          <input
                            type="tel"
                            name="phone"
                            oninput="this.className = ''"
                            id="phone"
                            placeholder="Enter Your Phone Number *"
                            value="{{ $user->phone }}"
                             style="padding-left: 50px;" 
                            required
                          />                           
                        </div>
 

                      </div>                      
                      
                      <input type="hidden" id="dialCode" name="dialCode"> 

                      <div class="col-sm-6">
                        <div class="form_group">
                          <input
                            type="email"
                            name="email"
                            oninput="this.className = ''"
                            id="email"
                            placeholder="Enter Your Email Address *" 
                            
                            value="{{ $user->email }}"
                            required
                          />
                        </div>
                      </div>                      
                      <div class="col-sm-12">
                        <div class="form_group">
                          <label>Upload Your Profile Image * <span class="small">(Max size: 1 MB, Dimensions: 1078 x 762 pixels)</span>  </label>
                          <input type="file" oninput="this.className = ''" name="profilephoto" accept="image/png, image/webp, image/jpeg, image/jpg, image/svg" required />
                        </div>
                      </div>
                      
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
                 
                  
                 $totalclients = $user->totalclients ? '<option value="'. $user->totalclients .'" selected>' . $user->totalclients . '</option>' : null;
 
                 
                 $totalawards = $user->totalawards ? $user->totalawards : null; 
                 
            @endphp


                    <div class="row">
                        
                      <div class="col-sm-3">
                        <div class="form_group">
                          <label>Years of Experience *</label>
                          <input type="number" name="totalexperience" placeholder="Years of Projects" min="1" max="100" value="{{ $totalexperience }}" required/>
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
                          <label>Total No. of Happy Clients </label>
                          <select id="totalclients" name="totalclients"> 
                          {{ $totalclients }}
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
                          <input type="number" name="totalawards" placeholder="Ex: 5" min="1" max="100" value="{{ $totalawards }}" />
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
                                <label>Choose the industry that matches your professional experience.</label>
                                <select id="MultipleIndustrySelect" class="form-control" name="industries[]" multiple="multiple" required> 

                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->industry }}</option>
                                @endforeach

                                </select> 
                                
                                <small class="field-instruction">Please select 1</small>

                            </div>  
                          </div>
                          <div class="col-md-6">   
                            <div id="skills-container" class="mb-4">
                              <label>Choose the skills that best reflect your areas of expertise.</label>
                                <select id="MultipleSkillSelect" class="form-control" name="skills[]" multiple="multiple" required> 

                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                                @endforeach

                                </select> 
                                <small class="field-instruction">Please select upto 3</small>

                            </div>  
                          </div>
                          <div class="col-md-6">

                            <div class="mb-4">
                              <label>Choose the tools that reflect your abilities</label>
                                <select id="MultipleToolSelect" class="form-control" name="tools[]" multiple="multiple" required> 
                                @foreach($tools as $tool)
                                    <option value="{{ $tool->id }}">{{ $tool->tool }}</option>
                                @endforeach

                                </select> 
                                <small class="field-instruction">Please select upto 6</small>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="mb-4">
                              <label>Choose the traits that highlight your unique qualities</label>
                                <select id="MultipleAttributesSelect" class="form-control" name="attributes[]" multiple="multiple" required> 
                                  
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->attribute }}</option>
                                @endforeach


                                </select> 
                                <small class="field-instruction">Please select upto 4</small>

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
                            
                            <div class="col-lg-6 col-12">                             
                              <div class="form_group">                              
                                <label for="start-month">From: *</label>
                                <input type="month" name="exp1start-month" id="exptodatepicker" class="form-control"/ required>                              
                              </div>
                            </div>
                            <div class="col-lg-6 col-12">
                              <div class="form_group">
                                <label for="end-month">To: *</label>
                                <input type="month" name="exp1end-month" id="expformdatepicker"  class="form-control" required/>
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
            
            
                </div>
        
                <div> <button type="button" id="addExperienceButton" class="btn tj-btn-primary-new" > + Add Experience </button> </div>
                
                  </fieldset>


                  <!-- Educational Details -->
                  <fieldset>
                    <legend>Educational Details</legend>
                    
                    
                    
                    <div id="educationsContainer"> 
                    
                        <p class="description">(Share up to 3 education that highlight your journey and impact)</p>
                        
                        <!-- Initial Education Input Fields -->
                        <div class="education-group" id="education1">
                            <br>
                            <h6> Education 1 details: </h6>
                            <hr>
                                    
                            
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                  <div class="form_group d-flex align-items-center">
                                    <input type="text" name="edu1university" placeholder="Enter University Name *" autocomplete="off" required/> 
                                  </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                  <div class="form_group">
                                    <input type="text" name="edu1course" placeholder="Enter Course Name *" autocomplete="off" required/>
                                  </div>
                                </div>

                          </div>
                              
                          <div class="row">
                            
                            <div class="col-lg-6 col-12">                             
                              <div class="form_group">                              
                                <label>From: *</label>
                                <input type="month" name="edu1start-month" class="form-control" required/>                              
                              </div>
                            </div>
                            <div class="col-lg-6 col-12">
                              <div class="form_group">
                                <label>To: *</label>
                                <input type="month" name="edu1end-month" class="form-control" required/>
                              </div>
                            </div> 
                            
                          </div>                        
                          <!-- Edu ends -->
                          
                        </div>
                
                    </div>
            
                    <div> <button type="button" id="addEducationButton" class="btn tj-btn-primary-new" > + Add Education </button> </div>
                    
                  </fieldset>
                   
                  



                  </div>
                  <div class="tab">
                    
                        
                  
                  <fieldset>
                        <legend>Projects & Works Handled</legend>
                            
                        <div id="projectsContainer"> 
                        
                            <p class="description">(Share up to 4 projects that highlight your journey and impact)</p>
                            
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
                          
                        </div>
                      
                      <div> <button type="button" id="addProjectButton" class="btn tj-btn-primary-new" > + Add Project </button> </div> 
                      
                    </fieldset>

                  <!-- Awards Details -->
                  <fieldset>
                    <legend>Awards Details</legend>
                    
                    
                      <div id="awardsContainer"> 
                        
                            <p class="description">(Share up to 3 awards that highlight your journey and impact)</p>
                      
                          <!-- Initial Education Input Fields -->
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
              
                  </div>
          
                  <div> <button type="button" id="addAwardButton" class="btn tj-btn-primary-new" > + Add Award </button> </div>
                      
                      

                        
                    </fieldset>

                  </div>

                  <div class="tab">

                      
                   <fieldset>
                    <legend>Testimonials</legend>
                        
                    <div id="testimonialsContainer"> 
                    
                        <p class="description">(Share up to 3 testimonials that highlight your journey and impact)</p>
                        
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
                              <textarea name="tstm1content" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)"></textarea>
                                <p class="word-counter">0/250 Words</p>
                            </div>
                          </div>
                          
                        </div>
                          
                        </div>
                        
                        
                      </div>
                    
                    <div> <button type="button" id="addTestimonialButton" class="btn tj-btn-primary-new" > + Add Testimonial </button> </div> 
                      

                  </fieldset>

                    
                   <fieldset>
                    <legend>Blogs</legend>
                        
                    <div id="blogsContainer"> 
                    
                        <p class="description">(Share up to 3 blogs and social media posts highlight your journey and impact)</p>
                    
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
                        
                      </div>
                    
                    <div> <button type="button" id="addBlogButton" class="btn tj-btn-primary-new" > + Add Blog </button> </div> 
                    
                    <input type="hidden" name="UserIDCurrent" value="{{ $user->id }}" required />
                      

                  </fieldset>

                   </div>

                   <div class="tab"> 

                    <fieldset class="pb-5">
                      <legend>Story content:</legend>
              <div id="storysection">
                      <!-- <div class="section-header-new mt-4">
                          <h5 class="section-title">Story content</h5>
                        </div> -->
                        
                        <div class="col-sm-12">
                          <div class="form_group">
                            <label
                              >1.  Can you highlight specific skills that you believe have been crucial to your success and that you developed through your journey? </label
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
                              >2. How do you approach adversity, and what lessons have you learned from overcoming challenges? </label
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
                              >3. Describe the impact you believe you've had in your community, field, or the lives of others. </label
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
                            <label>4. How do you measure success, and what benchmarks have you set for yourself along the way?
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
                            <label>5. In your view, how does your journey align with the values and goals of this recognition? </label>
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
        <div class="form_group">

          <label>Story - Enhanced with Ai <span style=" padding: 3px 6px; margin: 0; " class="btn btn-gradient-border btn-glow ms-2"> <i class="fa-light fa-wand-magic-sparkles"></i> </span> </label>

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
   
        
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
 <script>
        var input = document.querySelector("#phone22");
        var iti = window.intlTelInput(input, {            
            separateDialCode: true,
            geoIpLookup: function(success, failure) {
                fetch('https://ipinfo.io/json', { headers: { 'Accept': 'application/json' }})
                    .then(function(response) {
                        if (response.ok) return response.json();
                        throw new Error('Failed to fetch IP info');
                    })
                    .then(function(ipinfo) {
                        var countryCode = (ipinfo && ipinfo.country) ? ipinfo.country : 'us';
                        success(countryCode);
                    })
                    .catch(function() {
                        success('us');
                    });
            },
            initialCountry: "auto",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js" // for formatting/validation etc.
        });

        input.addEventListener("countrychange", function() {
            var dialCode = iti.getSelectedCountryData().dialCode; 
            document.getElementById("dialCode").value = dialCode;  
        });
    </script>
 

 
      
      
 <script>
        let ProjectsCount = 1;

        document.getElementById('addProjectButton').addEventListener('click', function() {
            
        if(ProjectsCount >= 4) {
            alert("Max 4 Allowed!");
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
                    <button type="button" class="deleteProjectButton btn btn-danger ms-2" onclick="deleteProject(${ProjectsCount})"> &#128465; </button>
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
        let ExperiencesCount = 1;

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
                    <button type="button" class="deleteExperienceButton btn btn-danger ms-2" onclick="deleteExperience(${ExperiencesCount})"> &#128465; </button>
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
                
                <div class="col-lg-6 col-12">                             
                  <div class="form_group">                              
                    <label for="start-month">From:</label>
                    <input type="month" name="exp${ExperiencesCount}start-month" class="form-control"/>                              
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form_group">
                    <label for="end-month">To:</label>
                    <input type="month" name="exp${ExperiencesCount}end-month" class="form-control"/>
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
            
            } //if less than 3
            
        });
         function deleteExperience(experienceNumber) {
            const experienceGroup = document.getElementById(`experience${experienceNumber}`);
            experienceGroup.remove();
             
            ExperiencesCount--;
             
        }
    </script>
      
    <script>
        let EducationsCount = 1;

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
                        <button type="button" class="deleteEducationButton btn btn-danger ms-2" onclick="deleteEducation(${EducationsCount})"> &#128465; </button>
                    </div>
                </div>
                    
                    <hr>
                
                <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form_group d-flex align-items-center">
                        <input type="text" name="edu${EducationsCount}university" placeholder="Enter University Name" autocomplete="off" /> 
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form_group">
                        <input type="text" name="edu${EducationsCount}course" placeholder="Enter Course Name" autocomplete="off" />
                      </div>
                    </div>
    
              </div>
                  
              <div class="row">
                
                <div class="col-lg-6 col-12">                             
                  <div class="form_group">                              
                    <label>From:</label>
                    <input type="month" name="edu${EducationsCount}start-month" class="form-control"/>                              
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form_group">
                    <label>To:</label>
                    <input type="month" name="edu${EducationsCount}end-month" class="form-control"/>
                  </div>
                </div> 
                
              </div>                        
              <!-- Edu ends -->
              
            `;

            educationsContainer.appendChild(educationGroup);
            
            } //if less than 3
            
        });
         function deleteEducation(educationNumber) {
            const educationGroup = document.getElementById(`education${educationNumber}`);
            educationGroup.remove();
             
            EducationsCount--;
             
        }
    </script>
      
    <script>
        let AwardsCount = 1;

        document.getElementById('addAwardButton').addEventListener('click', function() {
            
        if(AwardsCount >= 3) {
            alert("Max 3 Allowed!");
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
                        <button type="button" class="deleteAwardButton btn btn-danger ms-2" onclick="deleteAward(${AwardsCount})"> &#128465; </button>
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
        let TestimonialsCount = 1;

        document.getElementById('addTestimonialButton').addEventListener('click', function() {
            
        if(TestimonialsCount >= 3) {
            alert("Max 3 Allowed!");
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
                        <button type="button" class="deleteTestimonialButton btn btn-danger ms-2" onclick="deleteTestimonial(${TestimonialsCount})"> &#128465; </button>
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
                              <textarea name="tstm${TestimonialsCount}content" placeholder="Testimonial Content" autocomplete="off" oninput="checkWordLen(this, 250)" onblur="truncateExcess(this, 250)"></textarea>
                                <p class="word-counter">0/250 Words</p>
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
        let BlogsCount = 1;

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
                        <button type="button" class="deleteBlogButton btn btn-danger ms-2" onclick="deleteBlog(${BlogsCount})"> &#128465; </button>
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
                    return "You can only select 3 attributes"; // Custom message
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
    console.log(resp);

    if (resp == true) {
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
            console.log("Hello");

            $('#autosaved').show();
            
            // If the response is successful, move to the next step
            moveToNextStep(n);
          } else {
            alert(response.status);
          }
        },
        error: function(xhr) {
          alert('Error: ' + xhr.responseJSON.message);
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
            $('#generateStoryBtn').click(function() { 
    
            $('#generateStoryBtn').html("Enhancing Your Story <i class='fa-solid fa-loader fa-spin'></i> ");
            
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
                    
                  $('#newstorytitle').val(response.StoryTitle);

    ClassicEditor
    .create(document.querySelector('#generatedStory'), {
        toolbar: false // Hide the toolbar
    })
    .then(editor => {
        const generatedContent = response.newStory + '<br><br>' + response.newStory2 + '<br><br>' + response.newStory3 + '<br><br>' + response.newStory4 + '<br><br>' + response.newStory5;
        
        editor.setData(generatedContent);
    })
    .catch(error => {
        console.error(error);
    });



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



    

</body>

</html>