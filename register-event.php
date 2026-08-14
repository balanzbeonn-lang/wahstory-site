<?php
session_start();
    include('inc/functions.php');
    $postObj = new Story(); 
    $sucmsg = $errmsg = NULL;
    
    include(__dir__.'/smtpmailfun-test.php');
    
    if(isset($_POST['SUBMIT'])) {
        $response = $postObj->registerWorkshopParticipant(
                $_POST['firstName'],
                $_POST['lastName'],
                $_POST['department'],
                $_POST['title'],
                $_POST['companyName'],
                $_POST['companyWebsite'],
                $_POST['companySize'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['expectedParticipation'],
                $_POST['slotSelection'],
                $_POST['companyCity'],
                $_POST['companyCountry']
            );
            // var_dump($response);
            if ($response == 'success') {
                    $sucmsg = "Registration successful!";
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
                            "email" => "amitkapoor@elementshrs.com",
                            "name" => "Pratham Kakkar" 
                            ),
                        array(
                            "email" => "web.wahstory@gmail.com",
                            "name" => "WAHStory" 
                            )
                        );
                        
            $maildata["subject"] = $_POST['companyName'].' has submitted data for the Exclusive Wellbeing & Mindfulness Workshops.';
            $maildata['bodymessage'] = "
                            <!DOCTYPE html>
                            <html>
                            <head>
                            <title>WAHStory</title>
                            </head>
                            <body>
                            Hi WAHStory,<br>
                            <br>
                            <b>{$_POST['companyName']}</b> has submitted data for the Exclusive Wellbeing & Mindfulness Workshops.<br><br>
                            <b>First Name:</b> {$_POST['firstName']}<br>
                            <b>Last Name:</b> {$_POST['lastName']}<br>
                            <b>Department:</b> {$_POST['department']}<br>
                            <b>Title:</b> {$_POST['title']}<br>
                            <b>Company Name:</b> {$_POST['companyName']}<br>
                            <b>Company Website:</b> {$_POST['companyWebsite']}<br>
                            <b>Company Size:</b> {$_POST['companySize']}<br>
                            <b>Email:</b> {$_POST['email']}<br>
                            <b>Phone:</b> {$_POST['phone']}<br>
                            <b>Expected Participation:</b> {$_POST['expectedParticipation']}<br>
                            <b>Slot Selection:</b> {$_POST['slotSelection']}<br>
                            <b>Company City:</b> {$_POST['companyCity']}<br>
                            <b>Company Country:</b> {$_POST['companyCountry']}<br>
                            </body>
                            </html>
                            ";
            // Check if the mail was sent successfully
            echo SendMailBySMTP($maildata); 
    }

    // Countries array
    $countries = array(
        "Afghanistan" => "AF",
        "Albania" => "AL",
        "Algeria" => "DZ",
        "Argentina" => "AR",
        "Armenia" => "AM",
        "Australia" => "AU",
        "Austria" => "AT",
        "Azerbaijan" => "AZ",
        "Bahrain" => "BH",
        "Bangladesh" => "BD",
        "Belarus" => "BY",
        "Belgium" => "BE",
        "Bhutan" => "BT",
        "Bolivia" => "BO",
        "Bosnia and Herzegovina" => "BA",
        "Brazil" => "BR",
        "Bulgaria" => "BG",
        "Cambodia" => "KH",
        "Canada" => "CA",
        "Chile" => "CL",
        "China" => "CN",
        "Colombia" => "CO",
        "Costa Rica" => "CR",
        "Croatia" => "HR",
        "Czech Republic" => "CZ",
        "Denmark" => "DK",
        "Ecuador" => "EC",
        "Egypt" => "EG",
        "Estonia" => "EE",
        "Ethiopia" => "ET",
        "Finland" => "FI",
        "France" => "FR",
        "Georgia" => "GE",
        "Germany" => "DE",
        "Ghana" => "GH",
        "Greece" => "GR",
        "Guatemala" => "GT",
        "Hungary" => "HU",
        "Iceland" => "IS",
        "India" => "IN",
        "Indonesia" => "ID",
        "Iran" => "IR",
        "Iraq" => "IQ",
        "Ireland" => "IE",
        "Israel" => "IL",
        "Italy" => "IT",
        "Japan" => "JP",
        "Jordan" => "JO",
        "Kazakhstan" => "KZ",
        "Kenya" => "KE",
        "Kuwait" => "KW",
        "Latvia" => "LV",
        "Lebanon" => "LB",
        "Libya" => "LY",
        "Lithuania" => "LT",
        "Luxembourg" => "LU",
        "Malaysia" => "MY",
        "Maldives" => "MV",
        "Mexico" => "MX",
        "Morocco" => "MA",
        "Nepal" => "NP",
        "Netherlands" => "NL",
        "New Zealand" => "NZ",
        "Nigeria" => "NG",
        "Norway" => "NO",
        "Oman" => "OM",
        "Pakistan" => "PK",
        "Peru" => "PE",
        "Philippines" => "PH",
        "Poland" => "PL",
        "Portugal" => "PT",
        "Qatar" => "QA",
        "Romania" => "RO",
        "Russia" => "RU",
        "Saudi Arabia" => "SA",
        "Singapore" => "SG",
        "Slovakia" => "SK",
        "Slovenia" => "SI",
        "South Africa" => "ZA",
        "South Korea" => "KR",
        "Spain" => "ES",
        "Sri Lanka" => "LK",
        "Sweden" => "SE",
        "Switzerland" => "CH",
        "Thailand" => "TH",
        "Turkey" => "TR",
        "Ukraine" => "UA",
        "United Arab Emirates" => "AE",
        "United Kingdom" => "GB",
        "United States" => "US",
        "Uruguay" => "UY",
        "Venezuela" => "VE",
        "Vietnam" => "VN",
        "Yemen" => "YE"
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusive Wellbeing & Mindfulness Workshops for Corporate Leaders</title>
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

/* Country dropdown specific styling */
.country-select {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
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

    </style>
</head>
<body style="background: url('images/register-event-bg.jpg');">
    <div class="invitation-header">
    <h1>Invitation to Participate in Exclusive Wellbeing & Mindfulness Workshops</h1>
    <p class="lead">for Corporate Leaders</p>
    <div class="underline-accent"></div>
    <div class="benefit-badge">
        Complimentary Workshop + Benefits Worth $250 Per Participant
    </div>
    <!-- Optional call-to-action button -->
    <button class="cta-button" type="button" onclick="document.getElementById('firstName').focus();">
        Register Now
    </button>
</div>


    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="workshop-section">
                    <h2 class="mb-3">About the Workshop</h2>
                    <p>
                        <strong>Wahstory</strong> is pleased to invite your organization to a series of thoughtfully curated workshops focused on <strong>Wellbeing and Mindfulness</strong>-specially designed for corporate leaders and working professionals.
                    </p>
                    <h5 class="mt-4">Objective</h5>
                    <p>
                        To empower professionals with tools and practices that promote holistic wellbeing, leading to enhanced productivity, emotional balance, and sustainable performance.
                    </p>

                    <h5 class="mt-4">Workshop Highlights</h5>
                    <ul>
                        <li>Themes: Physical Fitness, Nutrition, Mindfulness, Emotional Intelligence, Stress Management, Lifestyle</li>
                        <li>Duration: 60–90 minutes</li>
                        <li>Format: Highly interactive sessions led by expert practitioners</li>
                        <li>Target Audience: Participants across levels from various departments</li>
                    </ul>

                   

                    <h5 class="mt-4">Key Benefits</h5>
                    <ul class="key-benefits">
                        <li>Boosted leadership performance</li>
                        <li>Improved emotional and physical wellbeing</li>
                        <li>Tools for managing stress and enhancing team dynamics</li>
                    </ul>

                    <div class="exclusive-benefits mt-4">
                        <h6 class="mb-2">Exclusive Benefits Worth $250 USD to Each Participant</h6>
                        <ul class="mb-1">
                            <li>Complimentary personalised NFC cards</li>
                            <li>3 months complimentary Wah Club membership</li>
                        </ul>
                    </div>

                    <div class="alert alert-info mt-4">
                        <strong>Special Note:</strong> These workshops are fully sponsored by our wellness-focused channel partners, who are committed to promoting mindful living and professional growth within organizations.
                    </div>

                    <p class="mt-3">
                        We'd love to collaborate with your team and support your leaders on their journey toward better wellbeing.
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
                    <h4 class="mb-3">Register Your Interest</h4>
                    <form method="POST" action= "">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="mt-2">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mt-2">
                            <label for="companyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" required>
                        </div>
                        <div class="mt-2">
                            <label for="companyWebsite" class="form-label">Company Website</label>
                            <input type="text" class="form-control" id="companyWebsite" name="companyWebsite">
                        </div>
                        <div class="mt-2">
                            <label for="companySize" class="form-label">Company Size</label>
                            <select class="form-select" id="companySize" name="companySize" required>
                                <option value="">Select</option>
                                <option value="100-500">100-500</option>
                                <option value="500-1000">500-1000</option>
                                <option value="1000-3000">1000-3000</option>
                                <option value="3000+">3000+</option>

                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mt-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mt-2">
                            <label for="expectedParticipation" class="form-label">Expected Participation</label>
                            <input type="number" class="form-control" id="expectedParticipation" name="expectedParticipation" min="1">
                        </div>
                        <div class="mt-2">
                            <label for="companyCity" class="form-label">Company City</label>
                            <input type="text" class="form-control" id="companyCity" name="companyCity">
                        </div>
                        <div class="mt-2">
                            <label for="companyCountry" class="form-label">Company Country</label>
                            <select class="form-select country-select" id="companyCountry" name="companyCountry" required>
                                <option value="">Select Country</option>
                                <?php foreach($countries as $country => $code): ?>
                                    <option value="<?= $country ?>" data-code="<?= $code ?>"><?= $country ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="slotSelection" class="form-label">Select Slot</label>
                            <select class="form-select" id="slotSelection" name="slotSelection" required>
                                <option value="">Choose a slot</option>
                                <option value="3rd October (11:00 - 1:00pm)">3rd October (11:00 - 1:00pm)</option>
                                <option value="4th October (11:00 - 1:00pm)">4th October (11:00 - 1:00pm)</option>
                                <option value="6th October (11:00 - 1:00pm)">6th October (11:00 - 1:00pm)</option>
                                <option value="7th October (11:00 - 1:00pm)">7th October (11:00 - 1:00pm)</option>
                            </select>
                        </div>
                        <div class="mt-3 d-grid">
                            <button type="submit" name="SUBMIT" class="btn btn-primary btn-lg">Submit Registration</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
	<section class="footer">
        <p>© <?=date('Y');?> Wahstory. All Rights Reserved.</p>
    </section>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Optional: Auto-detect user's country based on timezone (requires additional API)
        // This is a basic implementation that you can enhance
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('companyCountry');
            
            // Optional: You can add auto-detection based on user's location
            // This would require additional APIs like IP geolocation
            
            // Add search functionality to the dropdown
            countrySelect.addEventListener('keyup', function(e) {
                if (e.key.length === 1) {
                    const options = countrySelect.options;
                    for (let i = 1; i < options.length; i++) {
                        if (options[i].text.toLowerCase().startsWith(e.key.toLowerCase())) {
                            countrySelect.selectedIndex = i;
                            break;
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>