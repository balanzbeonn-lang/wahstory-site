<?php
session_start();
    include('inc/functions.php');
    $postObj = new Story(); 
    $sucmsg = $errmsg = NULL;
    
    include(__dir__.'/smtpmailfun-test.php');
    
    if(isset($_POST['SUBMIT'])) {
        $response = $postObj->registerWellnessParticipantIHG(
                $_POST['firstName'],
                $_POST['lastName'],
                $_POST['department'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['slotSelection']
            );
            // var_dump($response);
            if ($response == 'success') {
                    $sucmsg = "Registration successful!";
                    echo "<script>window.location.href = 'https://nfc.wahstory.com/getnfccard.php?eventreg=success';</script>";
                } else {
                    $errmsg = "There was an error. Please try again.";
                }
                
        $maildata = array();

        $maildata["sender"] = array(
                        "email" => "info@wahstory.com",
                        "name" => "WAHStory"
                        );
                        
        $maildata["receiver"] = array(
                        array(
                            "email" => "shubhangini.wadhera@wahstory.com",
                            "name" => "Pratham Kakkar" 
                            ),
                        array(
                            "email" => "web.wahstory@gmail.com",
                            "name" => "WAHStory" 
                            )
                        );
                        
            $maildata["subject"] = $_POST['firstName'].' has submitted data for the IHG Wellness & Nutrition Event.';
            $maildata['bodymessage'] = "
                            <!DOCTYPE html>
                            <html>
                            <head>
                            <title>WAHStory</title>
                            </head>
                            <body>
                            Hi WAHStory,<br>
                            <br>
                            <b>{$_POST['firstName']}</b> has submitted data for IHG Wellness & Nutrition Event.<br><br>
                            <b>First Name:</b> {$_POST['firstName']}<br>
                            <b>Last Name:</b> {$_POST['lastName']}<br>
                            <b>Department:</b> {$_POST['department']}<br>
                            <b>Email:</b> {$_POST['email']}<br>
                            <b>Phone:</b> {$_POST['phone']}<br>
                            <b>Slot Selection:</b> {$_POST['slotSelection']}<br>
                           
                            </body>
                            </html>
                            ";
            // Check if the mail was sent successfully
            echo SendMailBySMTP($maildata); 
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IHG Wellness & Nutrition Event</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.invitation-header {
    position: relative;
    /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

    box-shadow: 0 8px 30px rgba(118, 75, 162, 0.4);	*/
    color: #fff;
    padding: 60px 20px 50px 20px;
    border-radius: 0 0 60px 60px;
    margin-bottom: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    overflow: hidden;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    transition: background 0.5s ease;
}
 

.invitation-header h1 {
    font-size: 2.8rem;
    line-height: 1.2;
    margin-bottom: 0.3rem;
    letter-spacing: 0.03em;
    text-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

.invitation-header p.lead {
    font-size: 1.3rem;
    margin-bottom: 1.2rem;
    font-weight: 400;
    letter-spacing: 0.02em;
    color: #e0d7f5;
    text-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

.invitation-header .underline-accent {
    width: 90px;
    height: 4px;
    background: #fc3282;
    border-radius: 3px;
    margin: 0 auto 25px auto;
    box-shadow: 0 2px 10px #ff006554;
    transition: width 0.4s ease;
}

.invitation-header:hover .underline-accent {
    width: 120px;
}

.benefit-badge {
    background: #fc3282;
    color: #ffffff;
    font-weight: 700;
    border-radius: 30px;
    padding: 12px 28px;
    font-size: 1.3rem;
    display: inline-block;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px #ff006554;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
}

.benefit-badge:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px #ff006554;
}

.invitation-header .cta-button {
    background: #fff;
    color: #764ba2;
    font-weight: 700;
    border-radius: 30px;
    padding: 14px 36px;
    font-size: 1.2rem;
    border: none;
    box-shadow: 0 6px 20px rgba(255, 255, 255, 0.7);
    cursor: pointer;
    transition: background 0.3s ease, color 0.3s ease;
    margin-top: 15px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.invitation-header .cta-button:hover {
    background: #fc3282;
    color: #ffffff;
    box-shadow: 0 8px 30px #ff006554;
}



.workshop-section {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 40px;
    margin-bottom: 40px;
    transition: box-shadow 0.3s ease;
}
.workshop-section:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
.form-section {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 40px;
    transition: box-shadow 0.3s ease;
}
.form-section:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
.workshop-dates {
    font-size: 1.2rem;
    margin-bottom: 20px;
    font-weight: 600;
    color: #444;
}
.key-benefits li {
    margin-bottom: 12px;
    font-size: 1.1rem;
    color: #555;
}
.exclusive-benefits {
    background: #e6ffed;
    border-left: 8px solid #28a745;
    padding: 20px 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 2px 12px rgba(40, 167, 69, 0.3);
    font-weight: 600;
    color: #2c662d;
}
.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
    font-weight: 600;
    border-radius: 12px;
    padding: 20px 25px;
    box-shadow: 0 2px 12px rgba(12, 84, 96, 0.3);
}
.form-label {
    font-weight: 600;
    color: #333;
}
.btn-primary {
    background: linear-gradient(90deg, #6a82fb 0%, #fc5c7d 100%);
    border: none;
    font-weight: 700;
    font-size: 1.2rem;
    padding: 12px;
    border-radius: 30px;
    transition: background 0.4s ease;
}
.btn-primary:hover {
    background: linear-gradient(90deg, #fc5c7d 0%, #6a82fb 100%);
}
@media (max-width: 768px) {
    .invitation-header {
        padding: 30px 0 20px 0;
    }
    .workshop-section, .form-section {
        padding: 25px;
    }
}

.footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 30px 0;
    margin-top: 50px;
}


.sessions {
      background: #e0f7fa;
      border-left: 4px solid #00796b;
      padding: 12px 20px;
      margin: 18px 0;
      border-radius: 6px;
    }
    .register-btn {
      display: inline-block;
        background: #f05f87;
        color: #fff;
        padding: 8px 22px;
        font-size: 1.2em;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        margin-top: 10px;
        transition: background 0.2s;
        font-weight: 500;
    }
    .register-btn:hover {
      background: #e63767;
        color: #fff;
    }
    
    
    </style>
</head>
<body style="background: url('images/register-event-bg.jpg');">
    <div class="invitation-header" style=" padding-bottom: 10px; margin-bottom: 10px; padding-top: 30px;">
        <div class=" d-flex">
            <img src="https://seekvectorlogo.com/wp-content/uploads/2021/12/ihg-intercontinental-hotels-group-vector-logo.png" style="max-width: 160px;"> 
            &nbsp; &nbsp; &nbsp; &nbsp;
        <img src="https://www.wahstory.com/images/logos/logo-white.png" style="max-width: 190px;">
        </div>
    <h1 class="mt-3">IHG Wellness & Nutrition Event</h1>
    <p class="lead">for Corporate Leaders</p>
    <!--<div class="benefit-badge">
        Complimentary Workshop + Benefits Worth $250 Per Participant
    </div>-->
</div>


    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="workshop-section">
                    <h2 class="mb-3">About the Event</h2>
                    <hr>
                    <p>
                        WAHstory is proud to partner with IHG to host the exclusive Wellness & Nutrition Event in India, taking place on 19<sup>th</sup> November 2025. This specially designed 1-day series offers the IHG team a unique opportunity to engage in expert-led, interactive sessions focused on mental wellness and sustainable nutrition. Each session is thoughtfully crafted to provide practical strategies and personalized experiences that support holistic well-being and resilience in today’s fast-paced work environments.
                    </p>
                    <p>
                        We encourage every team member to register individually and secure their spot, as each session is limited to 100 participants to ensure meaningful engagement. Choose the session timing that best fits your schedule—morning, afternoon, or evening—and join us for this powerful wellness experience. Don’t miss out on the chance to receive exclusive benefits, including a 3-month premium WAHClub membership and a personalized NFC smart card. Register now to take the first step toward a healthier, more connected workplace!
                    </p>
                     
                   

                    <h5 class="mt-4">Flexible Scheduling for Maximum Participation</h5>
                    
                    <div class="exclusive-benefits mt-4">
                         
                        <ul class="mb-1">
                            <li><b>19<sup>th</sup> November:</b> 12pm - 1pm session 1 </li>
                            <li><b>19<sup>th</sup> November:</b> 3:30pm - 4:30pm session 2 </li>
                        </ul>
                        <p>
                            Choose the timing that best suits your team, or divide your teams across sessions for broader participation without disrupting daily operations.
                        </p>
                    </div>

                    <h5 class="mt-4">Program Focus</h5>
    <ul>
      <li><b>Mental Wellness:</b> Strategies for resilience in complex and high-stress environments</li>
      <li><b>Nutrition & Lifestyle Health:</b> Practical tools to maintain healthy habits sustainably</li>
    </ul>

    <h5 class="mt-4">Participation Benefits</h5>
    <ul>
      <li>3-Month Premium WAHClub Membership (valued at $300)</li>
      <li>Personalized NFC Smart Card, co-branded with the IHG logo</li>
      <li>Full access to our Digital Wellness Dashboard, curated resources, and exclusive member-only experiences</li>
    </ul>
    
    <h5 class="mt-4">Need Assistance?</h5>
        <p>
          Our coordination team is available to assist with registrations, session allocations, or any support needed for internal planning.<br>
          We look forward to hosting the IHG team for this powerful, tailor-made wellness experience that uplifts individuals and contributes to a more connected and mindful workplace.<br><br>
          📧 For assistance, please contact us at <a href="mailto:info@wahstory.com">info@wahstory.com</a>.
        </p>
    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-section">
        <?php
        if($sucmsg !== NULL) { ?>
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> <?=$sucmsg?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> 
            
            
            
        <? }
        ?>
        <?php 
        if($errmsg !== NULL) { ?>
           <div class="alert alert-error alert-dismissible fade show" role="alert">
                <strong>Error</strong> <?=$errmsg?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <? }
        ?>
                    <h4 class="mb-3">Confirm Your Participant</h4>
                     <p>
                          To confirm participation and activate your benefits, please register individually by filling the information required.
                        </p>
                    <hr>
                    <form method="POST" action= "">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="department" class="form-label">Department </label>
                            <input type="text" class="form-control" id="department" name="department">
                        </div>
                       
                         
                        <div class="mt-2">
                            <label for="email" class="form-label">Email ID <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mt-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                         
                        <div class="mt-2">
                            <label for="slotSelection" class="form-label">Select Slot <span class="text-danger">*</span></label>
                            <select class="form-select" id="slotSelection" name="slotSelection" required>
                                <option value="">Choose a slot</option>
                                <option value="19th November - Session 1">19th November, 12pm - 1pm session 1</option>
                                <option value="19th November - Session 2">19th November, 3:30pm - 4:30pm session 2</option>
                            </select>
                        </div>
                        <div class="mt-3 d-grid">
                            <button type="submit" name="SUBMIT" class="btn btn-primary btn-lg">Submit Participant</button>
                        </div>
                    </form>

                 
                   
    <h5 class="mt-4">Enroll for NFC Card</h5>
    <hr>
   
    <a class="register-btn btn btn-info " href="https://nfc.wahstory.com/getnfccard.php" target="_blank">Apply NFC card</a>
    <br>
    <br>
    <p class="note">
     Please ensure all registrations are completed at least 7 days prior to your session date to enable seamless coordination and delivery of NFC cards during the event.
    </p>
    
                </div>
                
            </div>
        </div>
    </div>
    
	<section class="footer">
        <p>© <?=date('Y');?> Wahstory. All Rights Reserved.</p>
    </section>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
