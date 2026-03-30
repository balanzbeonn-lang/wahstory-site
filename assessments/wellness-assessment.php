<?php
session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('functions.php');
    $Obj = new Assessment();
    
    if(isset($_SESSION['email']) && $_SESSION['email'] != '') {
        $checkScore = $Obj->GetScoreByEmail($_SESSION['email']);
        if($checkScore != NULL) {
            echo '<script>window.location.href="/assessments/report.php?fiticon='.$checkScore['slug'].'";</script>';
        }
    }
    if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
        $user = $Obj->GetUserById($_SESSION['userid']);
        
        $fullname = $user['name'];
        $email = $user['email'];
        $phone = $user['phone'];
    } else {
        $fullname = $email = $phone = '';
    } 
    
    
    $sucmsg = $errmsg = $errmsg1 = '';
    
if (isset($_POST['submit'])) {

        $data = [];
        $fields = ['addressed_as', 'full_name', 'gender', 'age_group', 'weight_status',
            'happy_level_yesterday', 'relaxed_level_yesterday', 'fitness_level_yesterday',
            'excitement_level_yesterday', 'sports_activity', 'diet_attempt', 'tried_reduce_alcohol',
            'taken_active_lifestyle', 'smoking_part_lifestyle', 'alcohol_part_lifestyle',
            'addicted_prescription_drugs', 'eating_excessively_part_lifestyle', 'eating_little_part_lifestyle',
            'avoiding_foods', 'diet_balanced', 'stress_work', 'stress_finance', 'stress_relationship',
            'stress_health', 'stress_bereavement', 'financial_future', 'ahead_finance', 'money_left',
            'money_relaxed', 'read_books', 'time_new_skills', 'prevent_problems', 'how_creative',
            'synthesize_knowledge', 'often_stressed', 'tried_manage_stress', 'goals_well_being',
            'activities_improving_job', 'support_increase_well_being', 'city', 'country', 'state',
            'organisation', 'email', 'phone'
        ];

        /*foreach ($fields as $field) {
            $data[$field] = $_POST[$field] ?? null;
        }*/
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                if (is_array($_POST[$field])) {
                    // Join checkbox values into a comma-separated string
                    $data[$field] = implode(',', $_POST[$field]);
                } else {
                    $data[$field] = $_POST[$field];
                }
            } else {
                $data[$field] = null;
            }
        }
        
        
        $resp = $Obj->SubmitWellnessAssessmentData($data, $_POST['email']);
        
        if($resp == 'success') {
            $sucmsg =  'success';
            
            if(isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
                echo '<script>window.location.href="/users/";</script>';
            } else {
                echo '<script>window.location.href="assessment-thankyou.php";</script>';
            }
            
        } elseif($resp == 'already') {
            $errmsg1 = 'error';
        } else {
            $errmsg = 'error';
        }
        
    }

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wellness Assessment - WAHStory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/images/wah_fav.ico">
  <link rel="canonical" href="https://www.wahstory.com/assessments/wellness-assessment.php" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta name="og:title" content="Wellness Assessment" />
    <meta name="og:description" content="Take the Wellness Assessment to gain insights into your current well-being and receive personalized recommendations for a healthier lifestyle." />
    <meta property="og:url" content="https://www.wahstory.com/assessments/wellness-assessment.php" />
    <meta property="og:site_name" content="WahStory.com" />
    <meta property="og:image" content="https://www.wahstory.com/images/og-wahstory.webp" />
    <meta property="og:image:width" content="355" />
    <meta property="og:image:height" content="133" />
    <meta property="og:image:type" content="image/png" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0f0715 60%, #f12b59 100%);
      min-height: 100vh;
      color: #fff;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .container {
      max-width: 50%;
      background: rgba(15, 7, 21, 0.97);
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px rgba(241, 43, 89, 0.15), 0 1.5px 6px rgba(0,0,0,0.17);
      padding: 2.5rem 2rem 2rem 2rem;
      margin-top: 3rem;
      margin-bottom: 3rem;
    }
    h2 {
      color: #f12b59;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .progress {
      background: #2a1835;
      border-radius: 6px;
      height: 10px;
      margin-bottom: 2rem;
      box-shadow: 0 1px 4px rgba(241,43,89,0.06);
    }
    .progress-bar {
      background: linear-gradient(90deg, #f12b59 60%, #ff5e8b 100%);
      transition: width 0.5s cubic-bezier(.4,2.2,.2,1);
      border-radius: 6px;
    }
    .slide {
      display: none;
      animation: fadeIn 0.6s;
    }
    .slide.active {
      display: block;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(16px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .question-title {
      font-weight: 600;
      font-size: 1.15rem;
      margin-bottom: 1.2rem;
      color: #fff;
      letter-spacing: 0.2px;
    }
    .section-intro {
      color: #f12b59;
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 1.2rem;
      text-align: center;
    }
    .section-note {
      color: #ffb6c9;
      font-size: 1rem;
      text-align: center;
      margin-bottom: 1.2rem;
    }
    .form-control, .form-select {
      background: #1b1027;
      color: #fff;
      border: 1.5px solid #34203e;
      border-radius: 0.6rem;
      font-size: 1rem;
      transition: border-color 0.2s;
      margin-bottom: 0.7rem;
    }
    .form-control:focus, .form-select:focus {
      border-color: #f12b59;
      box-shadow: 0 0 0 2px #f12b5977;
      background: #251235;
      color: #fff;
    }
    .form-check-input:checked {
      background-color: #f12b59;
      border-color: #f12b59;
      box-shadow: 0 0 0 2px #f12b5977;
    }
    .form-check-input:focus {
      border-color: #f12b59;
      box-shadow: 0 0 0 2px #f12b5977;
    }
    .form-check-label {
      font-weight: 400;
      font-size: 1rem;
      color: #fff;
      margin-left: 0.4rem;
    }
    .btn-primary, .btn-success {
      background: linear-gradient(90deg, #f12b59 60%, #ff5e8b 100%);
      border: none;
      font-weight: 600;
      letter-spacing: 0.5px;
      border-radius: 2rem;
      padding: 0.6rem 2.2rem;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px #f12b5933;
    }
    .btn-primary:hover, .btn-success:hover {
      background: linear-gradient(90deg, #ff5e8b 60%, #f12b59 100%);
      box-shadow: 0 4px 16px #f12b5955;
    }
    .btn-secondary {
      background: #2a1835;
      color: #fff;
      border: none;
      border-radius: 2rem;
      padding: 0.6rem 2.2rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: background 0.2s;
    }
    .btn-secondary:hover {
      background: #f12b59;
      color: #fff;
    }
    .is-invalid {
      border-color: #f12b59;
      background: #2a1835;
    }
    .form-text {
      color: #ffb6c9;
      font-size: 0.98rem;
      margin-top: 0.2rem;
    }
    ::-webkit-scrollbar {
      width: 8px;
      background: #1b1027;
    }
    ::-webkit-scrollbar-thumb {
      background: #f12b59;
      border-radius: 4px;
    }
    @media (max-width: 600px) {
      .container {
        padding: 1.2rem 0.6rem 1.2rem 0.6rem;
        margin-top: 0.7rem;
      }
      h2 { font-size: 1.45rem; }
    }
    
    /*label.form-check-label{
        background: #ffffff;
        display: block;
        padding: 5px;
        border-radius: 3px;
        color: #000000;
    }
    label.form-check-label input[type=radio]{
        margin-left: 0;
    }*/
    
    .radiobtn {
        color: #333;
        background: #4c2d5f;
        display: block;
        border-radius: 5px;
    }
    .radiobtn.selected {
        background: #e13a66;
    }
    .radiobtn .form-check-label {
        padding: 5px;
        padding-right: 10px;
        display: block;
    } 
    
  </style>
</head>
<body style="background-size: cover !important; filter: brightness(100%) !important; background-position: center !important; background-image: url(wellness-assessment-bg.jpg) !important; width: 100%; height: 100%; display: flex ; align-items: center; justify-content: center; flex-direction: column;">
    <div class="row">
        <div class="col-md-12">
            <a class="cs-site_branding" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" style="max-width: 200px">
             </a>
        </div>
    </div>
<div class="container my-5">
    
    
    <?php if(!empty($sucmsg)) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Assessment has been submitted successfully, your score will be sent to your mail.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if(!empty($errmsg)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Something went wrong, please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if(!empty($errmsg1)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> You have already submited the assessment.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    
  <h2 class="text-white">Wellness Assessment</h2>
  <div class="progress mb-4">
    <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
  </div>
  
    

  <form id="wizardForm"  method="post" action="">
    <!-- Slide 1 -->
    <div class="slide active">
      <div class="question-title">1. How do you wish to be addressed? <span style="color:#f12b59">*</span></div>
      <input type="text" class="form-control" name="addressed_as" id="addressed" required>
    </div>
    <!-- Slide 2 -->
    <div class="slide">
      <div class="question-title">2. What is your complete name? <span style="color:#f12b59">*</span></div>
      <input type="text" class="form-control" name="full_name"  value="<?= $fullname ?>" required>
    </div>
    <!-- Slide 3 -->
    <div class="slide custom-radio-group">
      <div class="question-title" id="q3addressed">3. Do you consider yourself to be:</div>
        <div class="form-check radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender" value="Male" required>
                Male
            </label>
        </div>
        <div class="form-check radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender" value="Female">
                Female
            </label>
        </div>
        <div class="form-check radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender" value="Third Gender">
                Third Gender
            </label>
        </div>
        <div class="form-check radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender" value="Prefer not to answer">
                Prefer not to answer
            </label>
        </div>

    </div>
    <!-- Slide 4 -->
    <div class="slide">
      <div class="question-title">4. You belong to an age group</div>
      <select class="form-select" name="age_group" required>
        <option value="" disabled selected>Select your age group</option>
        <option>Below 18</option>
        <option>18 to 29</option>
        <option>30 to 39</option>
        <option>40 to 49</option>
        <option>50 Plus</option>
      </select>
    </div>
    <!-- Slide 5 -->
    <div class="slide">
      <div class="question-title">5. Do you consider yourself as</div>
      <select class="form-select" name="weight_status" required>
        <option value="" disabled selected>Select</option>
        <option>Over Weight</option>
        <option>Slightly Over Weight</option>
        <option>Fit</option>
        <option>Slightly Under Weight</option>
        <option>Under Weight</option>
      </select>
    </div>
    <!-- Section: Wellbeing Scale -->
    <div class="slide">
      <div class="section-intro">Be your genuine self</div>
      <div class="section-note">Stay with us</div>
      <!--<div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 6 -->
    <div class="slide custom-radio-group">
      <div class="question-title">6. How happy did you feel yesterday? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="happy_level_yesterday" value="0" required>
              0 (Not at all)
            </label>
        </div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="happy_level_yesterday" value="1" />
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="happy_level_yesterday" value="2" />
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="happy_level_yesterday" value="3" />
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="happy_level_yesterday" value="4" />
                4 (Completely)
            </label>
        </div>

    </div>
    <!-- Slide 7 -->
    <div class="slide custom-radio-group">
      <div class="question-title">7. How relaxed did you feel yesterday? <span style="color:#f12b59">*</span></div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="relaxed_level_yesterday" value="0" required>
                0 (Not at all)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="relaxed_level_yesterday" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="relaxed_level_yesterday" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="relaxed_level_yesterday" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="relaxed_level_yesterday" value="4">
                4 (Completely)
            </label>
        </div>

      
    </div>
    <!-- Slide 8 -->
    <div class="slide custom-radio-group">
      <div class="question-title">8. How fit and healthy did you feel yesterday? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="fitness_level_yesterday" value="0" required>
                0 (Not at all)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="fitness_level_yesterday" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="fitness_level_yesterday" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="fitness_level_yesterday" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="fitness_level_yesterday" value="4">
                4 (Completely)
            </label>
        </div>

    </div>
    <!-- Slide 9 -->
    <div class="slide custom-radio-group">
      <div class="question-title">9. How excited did you feel yesterday? <span style="color:#f12b59">*</span></div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="excitement_level_yesterday" value="0" required>
                0 (Not at all)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="excitement_level_yesterday" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="excitement_level_yesterday" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="excitement_level_yesterday" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="excitement_level_yesterday" value="4">
                4 (Completely)
            </label>
        </div>

    </div>
    <!-- Section: Fitness Efforts -->
    <div class="slide custom-radio-group">
      <div class="section-intro">Over the past 12 months have you done any of the following in an attempt to keep fit and healthy?</div>
      <div class="section-note">I am sure <span id="effortsAddressed">you</span>, you must have thought about it, if not attempted 😜<br>Let's hear your efforts!</div>
      <!--<div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 10 -->
    <div class="slide">
      <div class="question-title">10. Followed any kind of sports & fitness programme? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="sports_activity" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="sports_activity" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="sports_activity" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="sports_activity" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="sports_activity" value="4">
                4 (Regularly)
            </label>
        </div>
    </div>
    <!-- Slide 11 -->
    <div class="slide custom-radio-group">
      <div class="question-title">11. Gone on a diet to lose or gain weight? <span style="color:#f12b59">*</span></div>
        
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_attempt" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_attempt" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_attempt" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_attempt" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_attempt" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Slide 12 -->
    <div class="slide custom-radio-group">
      <div class="question-title">12. Tried to reduce or give up drinking alcohol? <span style="color:#f12b59">*</span></div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tried_reduce_alcohol" value="0" required>
                0 (Regularly Consuming)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tried_reduce_alcohol" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tried_reduce_alcohol" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tried_reduce_alcohol" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tried_reduce_alcohol" value="4">
                4 (Stop/Not Consuming)
            </label>
        </div>

      
    </div>
    <!-- Slide 13 -->
    <div class="slide custom-radio-group">
      <div class="question-title">13. Recently taken up a more active lifestyle? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="taken_active_lifestyle" value="0" required>
                0 (Never Follow)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="taken_active_lifestyle" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="taken_active_lifestyle" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="taken_active_lifestyle" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="taken_active_lifestyle" value="4">
                4 (Consistently Follow)
            </label>
        </div>

    </div>
    <!-- Section: Lifestyle -->
    <div class="slide custom-radio-group">
      <div class="section-intro"><span id="lifestyleAddressed"></span>, We would like to know more about your current lifestyle.</div>
      <!--<div class="section-note">Press <b>Continue</b> to proceed.</div>
      <div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 14 -->
    <div class="slide custom-radio-group">
      <div class="question-title">14. Has smoking been a part of your lifestyle? <span style="color:#f12b59">*</span></div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="smoking_part_lifestyle" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="smoking_part_lifestyle" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="smoking_part_lifestyle" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="smoking_part_lifestyle" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="smoking_part_lifestyle" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Slide 15 -->
    <div class="slide custom-radio-group">
      <div class="question-title">15. Has drinking alcohol been a part of your lifestyle? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="alcohol_part_lifestyle" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="alcohol_part_lifestyle" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="alcohol_part_lifestyle" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="alcohol_part_lifestyle" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="alcohol_part_lifestyle" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Slide 16 -->
    <div class="slide custom-radio-group">
      <div class="question-title">16. Have you ever been dependent or addicted to prescription drugs? <span style="color:#f12b59">*</span></div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="addicted_prescription_drugs" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="addicted_prescription_drugs" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="addicted_prescription_drugs" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="addicted_prescription_drugs" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="addicted_prescription_drugs" value="4">
                4 (Regularly)
            </label>
        </div>


    </div>
    <!-- Slide 17 -->
    <div class="slide custom-radio-group">
      <div class="question-title">17. Has eating excessively ever been a part of your lifestyle? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_excessively_part_lifestyle" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_excessively_part_lifestyle" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_excessively_part_lifestyle" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_excessively_part_lifestyle" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_excessively_part_lifestyle" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Slide 18 -->
    <div class="slide custom-radio-group">
      <div class="question-title">18. Has eating too little ever been a part of your lifestyle? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_little_part_lifestyle" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_little_part_lifestyle" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_little_part_lifestyle" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_little_part_lifestyle" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="eating_little_part_lifestyle" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Section: Diet Choices -->
    <div class="slide">
      <div class="section-intro"><span id="dietAddressed">Have you ever chosen to do any of the following as a part of your lifestyle?</span></div>
      <div class="section-note">Stay with us</div>
      <!--<div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 19 -->
    <div class="slide custom-radio-group">
      <div class="question-title">19. Avoiding particular foods that are bad for your health</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="avoiding_foods" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="avoiding_foods" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="avoiding_foods" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="avoiding_foods" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="avoiding_foods" value="4">
                4 (Always)
            </label>
        </div>

    </div>
    <!-- Slide 20 -->
    <div class="slide custom-radio-group">
      <div class="question-title">20. Would you say, your diet is balanced?</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_balanced" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_balanced" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_balanced" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_balanced" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="diet_balanced" value="4">
                4 (Always)
            </label>
        </div>

    </div>
    <!-- Section: Stress Factors -->
    <div class="slide">
      <div class="section-intro">Over the past 12 months have any of the following areas brought you under high levels of stress?</div>
      <!--<div class="section-note">Continue<br>press Enter ↵</div>
      <div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 21 -->
    <div class="slide custom-radio-group">
      <div class="question-title">21. Work load or responsibilities <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_work" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_work" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_work" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_work" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_work" value="4">
                4 (Constantly)
            </label>
        </div>

    </div>
    <!-- Slide 22 -->
    <div class="slide custom-radio-group">
      <div class="question-title">22. Financial worries</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_finance" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_finance" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_finance" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_finance" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_finance" value="4">
                4 (Constantly)
            </label>
        </div>

    </div>
    <!-- Slide 23 -->
    <div class="slide custom-radio-group">
      <div class="question-title">23. Relationship problems</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_relationship" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_relationship" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_relationship" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_relationship" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_relationship" value="4">
                4 (Constantly)
            </label>
        </div>

    </div>
    <!-- Slide 24 -->
    <div class="slide custom-radio-group">
      <div class="question-title">24. Your own health</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_health" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_health" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_health" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_health" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_health" value="4">
                4 (Constantly)
            </label>
        </div>

    </div>
    <!-- Slide 25 -->
    <div class="slide custom-radio-group">
      <div class="question-title">25. Bereavement</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_bereavement" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_bereavement" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_bereavement" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_bereavement" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="stress_bereavement" value="4">
                4 (Constantly)
            </label>
        </div>

    </div>
    <!-- Section: Financial Wellness -->
    <div class="slide">
      <div class="section-intro"><span id="financeAddressed"></span> how well does this statement describe you or your situation or applies to you?</div>
      <!--<div class="section-note">Continue<br>press Enter ↵</div>
      <div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 26 -->
    <div class="slide custom-radio-group">
      <div class="question-title">26. I am securing my financial future. <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="financial_future" value="0" required>
                0 (Not at all)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="financial_future" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="financial_future" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="financial_future" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="financial_future" value="4">
                4 (Completely)
            </label>
        </div>

    </div>
    <!-- Slide 27 -->
    <div class="slide custom-radio-group">
      <div class="question-title">27. I am ahead with my finances</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="ahead_finance" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="ahead_finance" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="ahead_finance" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="ahead_finance" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="ahead_finance" value="4">
                4 (Always)
            </label>
        </div>

    </div>
    <!-- Slide 28 -->
    <div class="slide custom-radio-group">
      <div class="question-title">28. I have money left over at the end of the month</div>
      
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_left" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_left" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_left" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_left" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_left" value="4">
                4 (Always)
            </label>
        </div>

    </div>
    <!-- Slide 29 -->
    <div class="slide custom-radio-group">
      <div class="question-title">29. I am relaxed that the money I have or will save would last long</div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_relaxed" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_relaxed" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_relaxed" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_relaxed" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="money_relaxed" value="4">
                4 (Always)
            </label>
        </div>

    </div>
    <!-- Section: Learning and Growth -->
    <div class="slide">
      <div class="section-intro">How well does this statement describe you or your situation or applies to you?</div>
      <!--<div class="section-note">Continue<br>press Enter ↵</div>
      <div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 30 -->
    <div class="slide custom-radio-group">
      <div class="question-title">30. How often do you read books? <span style="color:#f12b59">*</span></div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="read_books" value="0" required>
                0 (Never)
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="read_books" value="1">
                1
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="read_books" value="2">
                2
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="read_books" value="3">
                3
            </label>
        </div>
        <div class="form-check form-check-inline radiobtn">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="read_books" value="4">
                4 (Regularly)
            </label>
        </div>

    </div>
    <!-- Slide 31 -->
    <div class="slide custom-radio-group">
      <div class="question-title">31. How much time do you invest in improving your existing skills or acquiring new skills? <span style="color:#f12b59">*</span></div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="time_new_skills" value="0" required>
          0 (Not at all)
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="time_new_skills" value="1">
          1
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="time_new_skills" value="2">
          2
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="time_new_skills" value="3">
          3
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="time_new_skills" value="4">
          4 (Sufficient)
        </label>
      </div>
    </div>
    
    <!-- Slide 32 -->
    <div class="slide custom-radio-group">
      <div class="question-title">32. How often can you prevent problems? <span style="color:#f12b59">*</span></div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="prevent_problems" value="0" required>
          0 (Never)
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="prevent_problems" value="1">
          1
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="prevent_problems" value="2">
          2
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="prevent_problems" value="3">
          3
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="prevent_problems" value="4">
          4 (Regularly)
        </label>
      </div>
    </div>
    
    <!-- Slide 33 -->
    <div class="slide custom-radio-group">
      <div class="question-title">33. How creative you are? <span style="color:#f12b59">*</span></div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="how_creative" value="0" required>
          0 (Not at all)
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="how_creative" value="1">
          1
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="how_creative" value="2">
          2
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="how_creative" value="3">
          3
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="how_creative" value="4">
          4 (Sufficient)
        </label>
      </div>
    </div>
    
    <!-- Slide 34 -->
    <div class="slide custom-radio-group">
      <div class="question-title">34. How comfortably you can synthesize knowledge? <span style="color:#f12b59">*</span></div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="synthesize_knowledge" value="0" required>
          0 (Not at all)
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="synthesize_knowledge" value="1">
          1
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="synthesize_knowledge" value="2">
          2
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="synthesize_knowledge" value="3">
          3
        </label>
      </div>
      <div class="form-check form-check-inline radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="synthesize_knowledge" value="4">
          4 (Sufficiently)
        </label>
      </div>
    </div>
    
    <!-- Slide 35 -->
    <div class="slide custom-radio-group">
      <div class="question-title">35. How often do you feel stressed? <span style="color:#f12b59">*</span></div>
      <div class="form-check radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="often_stressed" value="All the time" required>
          All the time
        </label>
      </div>
      <div class="form-check radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="often_stressed" value="Most of the time">
          Most of the time
        </label>
      </div>
      <div class="form-check radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="often_stressed" value="Sometimes">
          Sometimes
        </label>
      </div>
      <div class="form-check radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="often_stressed" value="Rarely">
          Rarely
        </label>
      </div>
      <div class="form-check radiobtn">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="often_stressed" value="Never">
          Never
        </label>
      </div>
    </div>

    <!-- Slide 36 -->
    <div class="slide">
      <div class="question-title">36. Have you tried to reduce or manage stress in your life over the last 12 months by doing any of the following? <br><span class="form-text">(Choose as many as you like)</span></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Taking a holiday" id="holiday"> <label class="form-check-label" for="holiday">Taking a holiday</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Reducing working hours" id="reduce_hours"> <label class="form-check-label" for="reduce_hours">Reducing working hours</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Taking sick leave" id="sick_leave"> <label class="form-check-label" for="sick_leave">Taking sick leave</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Taking medication" id="medication"> <label class="form-check-label" for="medication">Taking medication</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Meditation" id="meditation"> <label class="form-check-label" for="meditation">Meditation</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Overeating" id="overeat"> <label class="form-check-label" for="overeat">Overeating</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Under eating" id="undereat"> <label class="form-check-label" for="undereat">Under eating</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Drinking alcohol" id="drink_alcohol"> <label class="form-check-label" for="drink_alcohol">Drinking alcohol</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="tried_manage_stress[]" value="Smoking" id="smoke"> <label class="form-check-label" for="smoke">Smoking</label></div>
    </div>
    <!-- Section: Goal Setting -->
    <div class="slide">
      <div class="section-intro">Goal Setting & Development Planning</div>
      <!--<div class="section-note">Continue<br>press Enter ↵</div>
      <div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 37 -->
    <div class="slide">
      <div class="question-title">37. What goals would you like to set yourself for to improve your overall well-being? <br><span class="form-text">(Choose as many as you like)</span></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Mediate" id="goal_mediate"> <label class="form-check-label" for="goal_mediate">Mediate</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Fitness & Sports" id="goal_fitness"> <label class="form-check-label" for="goal_fitness">Fitness & Sports</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Travel" id="goal_travel"> <label class="form-check-label" for="goal_travel">Travel</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Spirituality" id="goal_spirituality"> <label class="form-check-label" for="goal_spirituality">Spirituality</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Healthy Diet" id="goal_diet"> <label class="form-check-label" for="goal_diet">Healthy Diet</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Enough Sleep" id="goal_sleep"> <label class="form-check-label" for="goal_sleep">Enough Sleep</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="goals_well_being[]" value="Devote Time for your interest" id="goal_interest"> <label class="form-check-label" for="goal_interest">Devote Time for your interest</label></div>
    </div>
    <!-- Slide 38 -->
    <div class="slide">
      <div class="question-title">38. Which professional development activities would you find helpful for improving your job performance and accomplishing your goals? <br><span class="form-text">(Choose as many as you like)</span></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="In-house training" id="prof_inhouse"> <label class="form-check-label" for="prof_inhouse">In-house training</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="External training and certification" id="prof_external"> <label class="form-check-label" for="prof_external">External training and certification</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="On-the-job coaching" id="prof_coaching"> <label class="form-check-label" for="prof_coaching">On-the-job coaching</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="Help from a consultant" id="prof_consultant"> <label class="form-check-label" for="prof_consultant">Help from a consultant</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="Mentoring by senior staff" id="prof_mentor"> <label class="form-check-label" for="prof_mentor">Mentoring by senior staff</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="Exposure to another role" id="prof_exposure"> <label class="form-check-label" for="prof_exposure">Exposure to another role</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="activities_improving_job[]" value="Other" id="prof_other"> <label class="form-check-label" for="prof_other">Other</label></div>
    </div>
    <!-- Slide 39 -->
    <div class="slide">
      <div class="question-title">39. How could your organization better support you and increase your well-being? <br><span class="form-text">(Choose as many as you like)</span></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Personal Development Training" id="org_training"> <label class="form-check-label" for="org_training">Personal Development Training</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Financial Advisory" id="org_financial"> <label class="form-check-label" for="org_financial">Financial Advisory</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Nutrition Advisory" id="org_nutrition"> <label class="form-check-label" for="org_nutrition">Nutrition Advisory</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Improved Work/Life Balance" id="org_balance"> <label class="form-check-label" for="org_balance">Improved Work/Life Balance</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Promote mental health awareness and counseling" id="org_mental"> <label class="form-check-label" for="org_mental">Promote mental health awareness and counseling</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Organize fitness/sports events" id="org_sports"> <label class="form-check-label" for="org_sports">Organize fitness/sports events</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Encourage healthy lifestyle" id="org_lifestyle"> <label class="form-check-label" for="org_lifestyle">Encourage healthy lifestyle</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Parenting / Relationship Advisory" id="org_parenting"> <label class="form-check-label" for="org_parenting">Parenting / Relationship Advisory</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Yoga / Meditation session" id="org_yoga"> <label class="form-check-label" for="org_yoga">Yoga / Meditation session</label></div>
      <div class="form-check"><input class="form-check-input" type="checkbox" name="support_increase_well_being[]" value="Physical environment" id="org_environment"> <label class="form-check-label" for="org_environment">Physical environment</label></div>
    </div>
    <!-- Section: Final Details -->
    <div class="slide">
      <div class="section-intro">Thanks for sharing the above details.</div>
      <div class="section-note">Kindly let us know the city, state and country you live in.</div>
      <!--<div class="text-center"><button type="button" class="btn btn-primary" onclick="nextPrev(1)">Continue</button></div>-->
    </div>
    <!-- Slide 40 -->
    <div class="slide">
      <div class="question-title">40. City you live in <span style="color:#f12b59">*</span></div>
      <input type="text" class="form-control" name="city" required>
      <div class="question-title">41. State you live in <span style="color:#f12b59">*</span></div>
      <input type="text" class="form-control" name="state" required>
      <div class="question-title">42. Country you live in <span style="color:#f12b59">*</span></div>
      <input type="text" class="form-control" name="country" required>
    </div>
    <!-- Slide 41 -->
    <div class="slide">
      <div class="question-title">43. If you are currently working, kindly mention the name of your organisation.</div>
      <input type="text" class="form-control" name="organisation">
    </div>
    <!-- Slide 42 -->
    <div class="slide">
      <div class="question-title">44. What is your email address? <span style="color:#f12b59">*</span></div>
      <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
      <div class="form-text">We will use this to send you your answers so you can review them later.</div>
    </div>
    <!-- Slide 43 -->
    <div class="slide">
      <div class="question-title">45. Number you can be reached at <span style="color:#f12b59">*</span></div>
      <input type="tel" class="form-control" name="phone" value="<?= $phone ?>" required>
    </div>
    <!-- Submit Slide -->
    <div class="slide">
      <h4 class="mb-3" style="color:#f12b59;">Review &amp; Submit</h4>
      <p>Click Submit to finish your assessment.</p>
    </div>
    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between mt-4">
      <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <button type="submit" name="submit" class="btn btn-success d-none" id="submitBtn">Submit</button>
    </div>
  </form>
</div>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const progressBar = document.getElementById('progressBar');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        const wizardForm = document.getElementById('wizardForm');
        showSlide(currentSlide);
        
        function showSlide(n) {
          slides.forEach((slide, i) => slide.classList.toggle('active', i === n));
          prevBtn.style.display = n === 0 ? 'none' : 'inline-block';
          nextBtn.style.display = n === slides.length - 1 ? 'none' : 'inline-block';
          submitBtn.classList.toggle('d-none', n !== slides.length - 1);
          progressBar.style.width = ((n+1) / slides.length * 100) + '%';
        
          // Personalize addressed name in intros
          let addressed = document.querySelector('input[name="addressed_as"]')?.value || "you";
          if (n === 2) document.getElementById('q3addressed').innerHTML = `${addressed}, do you consider yourself to be:`;
          if (document.getElementById('effortsAddressed')) document.getElementById('effortsAddressed').innerText = addressed;
          if (document.getElementById('lifestyleAddressed')) document.getElementById('lifestyleAddressed').innerText = addressed;
          if (document.getElementById('dietAddressed')) document.getElementById('dietAddressed').innerText = addressed;
          if (document.getElementById('financeAddressed')) document.getElementById('financeAddressed').innerText = addressed;
        }
         
        function nextPrev(n) {
          // Validate current slide
          const currInputs = slides[currentSlide].querySelectorAll('input, select');
          let valid = true;
          currInputs.forEach(input => {
            if (input.type === 'radio') {
              let radios = slides[currentSlide].querySelectorAll('input[type="radio"][name="' + input.name + '"]');
              let checked = Array.from(radios).some(radio => radio.checked);
              if (input.required && !checked) {
                radios.forEach(radio => radio.classList.add('is-invalid'));
                valid = false;
              } else {
                radios.forEach(radio => radio.classList.remove('is-invalid'));
              }
            } else if (input.type === 'checkbox') {
              // only validate if required (not used here)
            } else if (input.required && !input.value) {
              input.classList.add('is-invalid');
              valid = false;
            } else {
              input.classList.remove('is-invalid');
            }
          });
          if (!valid && n === 1) return;
        
          slides[currentSlide].classList.remove('active');
          currentSlide += n;
          showSlide(currentSlide);
        }
     
    </script>
    
    
    
    <script>
    document.querySelectorAll('.custom-radio-group').forEach(group => {
        const radios = group.querySelectorAll('input[type="radio"]');
          radios.forEach(radio => {
            radio.addEventListener('change', () => {
              group.querySelectorAll('.radiobtn').forEach(label => {
                label.classList.remove('selected');
              });
              radio.closest('.radiobtn').classList.add('selected');
            });
          });
    });
    </script>
</body>
</html>