<?php 
session_start();
    include("functions.php");
    $postObj = new submitqueries();
    
    require(__dir__.'/../inc/smtpmailfun.php');
    
    
    if(isset($_GET['message']) && $_GET['message'] == 'Success'){
        
        $maildata = array();

        $maildata["sender"] = array(
                "email" => "contact@wahstory.com",
                "name" => "WAHStory"
                );
                
        $maildata["receiver"] = array(
                array(
                    "email" => $_SESSION['email'],
                    "name" => $_SESSION['name'] 
                    )
                );
                
    $maildata["subject"] = "Your Social Health Report and How to Elevate Your Score - WAHStory";
    $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social Health Report | WAHStory </title>
  <style type="text/css">
   
   

    /************************* END FONT STYLING ************************************/
@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap);
    body {
      width: 100%;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
	  font-family: Poppins, sans-serif;
    }

    table {
      border-collapse: collapse;
    }

    img {
      border: 0;
      outline: none !important;
    }

    .hideDesktop {
      display: none;
    }
	p{
    font-size: 15px;
    font-family: Poppins, sans-serif;
    }
    /********* CTA Style - fixed padding *********/

    .cta-shadow {
      padding: 14px 35px;
      -webkit-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      font-size: 16px;
      font-weight: normal;
      letter-spacing: 0px;
      text-decoration: none;
      display: block;
    }

    body[yahoo] .hideDeviceDesktop {
      display: none;
    }

    @media only screen and (max-width: 640px) {

      div[class=mobilecontent] {
        display: block !important;
        max-height: none !important;
      }

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .halfScreen {
        width: 50% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice640 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice640 {
        display: table !important;
      }


      body[yahoo] .googleCenter {
        margin: 0 auto;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .hideDesktop {
        display: block !important;
      }
    }

    @media only screen and (max-width: 520px) {
      .mobileHeader {
        font-size: 50px !important;
      }
      .mobileBody {
        font-size: 16px !important;
      }
      .mobileSubheader {
        font-size: 30px !important;
      }
    }

    @media only screen and (max-width: 479px) {

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice479 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice479 {
        display: table !important;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .mobileButton {
        width: 150px !important !
      }

    }

    @media only screen and (max-width: 385px) {
      .mobileHeaderSmall {
        font-size: 18px !important;
        padding-right: none;
      }
      .mobileBodySmall {
        font-size: 14px !important;
        padding-right: none;
      }
    }

    /* Stops automatic email inks in iOS */

    a[x-apple-data-detectors] {

      color: inherit !important;

      text-decoration: none !important;

      font-size: inherit !important;

      font-family: inherit !important;

      font-weight: inherit !important;

      line-height: inherit !important;

    }

    a[href^="x-apple-data-detectors:"] {
      color: inherit;
      text-decoration: inherit;
    }

    .footerLinks {
      text-decoration: none;
      color: #384049;
      font-size: 12px;
      line-height: 18px;
      font-weight: normal;
    }

    /*******Some Clients do not support rounded borders (example: older versions of Outlook)**********/

    .roundButton {
      border-radius: 5px;
    }

    /************************* Fixing Auto Styling for Gmail*********************/

    .contact a {
      color: #88888f !important !;
      text-decoration: none;
    }

    u+#body a {
      color: inherit;
      text-decoration: none;
      font-size: inherit;
      font-family: inherit;
      font-weight: inherit;
      line-height: inherit;
    }
	
	
  </style>
  <!-- Fall-back font for Outlook (Arial) -->
  <!--[if (gte mso 9)|(IE)]>

    <style type="text/css">

    a, body, div, li, p, strong, td, span {font-family: Arial, Helvetica, sans-serif !important;}
    
    </style>

  <![endif]-->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" align="center" id="body" style="background-color:#f3f3f5; padding-top: 50px;  padding-bottom: 50px;">
 
    <!-- FULL PAGE WIDTH WRAPPER WITH TINT -->
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" bgcolor="#f3f3f5" valign="top" width="100%">
          <!--========= WHITE PAGE BODY CONTAINER/WRAPPER========-->
          <table align="center" border="0" cellpadding="0" cellspacing="0" class="mobileView" width="600" style="margin-top: 20px; box-shadow: 0px 35px 60px 35px rgb(0 0 0 / 10%) ">
            <tr>
              <td align="center" bgcolor="#FFFFFF" style="padding:0px;" width="100%">

                <!--================================SECTION 0==========================-->
                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;background-color:#625a9c;" width="600">
                  <tr>
                    <td bgcolor="#FFD6E5" class="" style="width:100% !important; padding: 0;background-color:#ffffff;">
                      <!--========Paste your Content below=================-->
                      
                      
                      <!-- BEGIN LOGO -->
                      <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#ffffff" style="border-top: 10px solid #e9204f;">
                        <tr>
                          <td valign="top" width="100%" style="padding-left: 25px;">
                            <img style="max-width: 200px; height: auto;" src="https://www.wahstory.com/images/logos/logo-light.png" alt="WAHStory" />
                          </td>
                        </tr>
                      </table>
                      
                      <!-- END LOGO -->

                      <!-- nothing -->

                      <!--=======End your Content here=====================-->
                    </td>
                  </tr>
                </table>
                <!--=======END SECTION==========-->
				<table align="center" cellpadding="0" cellspacing="0" width="100%" style=" width:100% !important;">
                  <tr>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                    <td width="100%" align="center" valign="middle" style="border-top: 1px solid #d8d8d8;"></td>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                  </tr>
                </table>
                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;" width="600">
                  <tr>
                    <td bgcolor="" class="" style="width:100% !important; padding: 0;">
                        <!-- nothing -->


                        <!--BEGIN TEXT SECTION-->
                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px;">
						<tr>
                            <td style="font-size: 18px; line-height: 1.8;  padding: 10px 25px 10px 25px; font-weight: 500;" class="mso-line-solid mobile-headline">
                                <h1 style="font-size: 25px; margin-top: 20px; margin-bottom: 10px; font-weight: 600;">Dear , '.$_SESSION['name'].'!</h1>
							<p style="color: #000; font-size: 15px;
    font-family: Poppins, sans-serif; font-weight: 400;"> 
							We hope this message finds you well.
                            </p>
                            <p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;"> 
Firstly, we would like to extend our heartfelt thanks for taking the test. Your commitment to self-improvement is truly commendable, and we are here to support you on your journey.
							</p>
                           	<p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">

Now, the moment you have been waiting for: your test report is ready! To access your report, simply click on the button below:
 
							</p>
							
							<a href="https://www.wahstory.com/social-health-impact/?ScorEmail='.$_SESSION['email'].'" style="background: #e9204f; border-radius: 0.125rem; font-size: 15px; padding: 0.64rem 1.14rem!important; color: #fff !important; text-decoration: none;"> View Your Score </a>
                            
                            <p style="margin-top: 40px; color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">Your report not only provides valuable insights but also lays the foundation for further progress. If you are looking to elevate your score and unlock your full potential, we have just the thing for you. Click on the button below to explore our range of services designed to help you achieve your goals: 
							</p>
                            
                            <a href="https://www.wahstory.com/aboutus?form" style="background: #e9204f; border-radius: 0.125rem; font-size: 15px; padding: 0.64rem 1.14rem!important; color: #fff !important; text-decoration: none;"> Explore Services </a>
							
                            <p style="margin-top: 40px; color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">If you have any questions or need further assistance, please do not hesitate to reach out. We are here to support you every step of the way.
							</p>
                             <p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">Once again, thank you for choosing us on your journey toward self-improvement. We look forward to witnessing your growth and success.
							</p>
                            <p style="color: #000; font-size: 15px;
    font-family: Poppins, sans-serif; font-weight: 400;">If the above button does not works please clink the link below: 
							</p>
                            <p style="color: #000; font-size: 15px;
    font-family: Poppins, sans-serif; font-weight: 400; margin-bottom: 0px;
    margin-top: 0px;">View Your Score :</p>
    <a href="https://www.wahstory.com/social-health-impact/" targte="_blank"> https://www.wahstory.com/social-health-impact/ </a>                         
                            
                            </td>
                          </tr>
                          
                        </table>

                        <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                          <tr>
                             
                          </tr>
                        </table>
                        <!--END TEXT SECTION -->

                        <!--=======End your Content here=====================-->
                    </td>
                  </tr>
                </table>

                

                <!--=================FOOTER=====================-->
                <table align="center" cellpadding="0" cellspacing="0" width="100%" style=" width:100% !important;">
                  <tr>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                    <td width="100%" align="center" valign="middle" style="border-top: 1px solid #d8d8d8;"></td>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                  </tr>
                </table>
                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="mobileView" style="width:100% !important;" width="600">
                  <tr>
					<td>
						 <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#ffffff">
                          <tr>
                            <td valign="top" width="100%">
                              
                              <table width="100%" cellpadding="0" cellspacing="0" border="0"  style="max-width: 600px;">
                                <tr>
                                  <td style="padding: 0px;">
                                    <table  cellpadding="0" cellspacing="0" border="0" >
                                      <tr>
                                        
                                        <td align="left" style="  font-size: 15px; line-height: 1.4; color: #000000; padding: 15px 15px 5px 30px; ">
                                          Need Support? Connect with us: <a href="mailto:info@wahstory.com" style="color: #e9204f;">info@wahstory.com</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                              
                            </td>
                          </tr>
                        </table>
						
					</td>
					
                  </tr>
                  <tr>
                    <td>
                      <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="mobileView" style="" width="100%">
                       
                        <tr>
                          <td align="left" style="color: #000000;   font-size: 14px; line-height:28px; font-weight: normal; padding: 10px 0px 0px 30px; text-decoration: none;" valign="middle">Coastal Highway, Lewes, Delaware, USA <br/>&#169; '.date('Y').' Wahstory, LLC.</td>
                        </tr>
                        <!--===========CUSTOMER ACTIONS===========-->
                      </table>
                      <!--=============END CUSTOMER ACTIONS========-->
                    </td>
                  </tr>
                  <tr>
                    <td width="auto" style="display: block;" height="40">&nbsp;</td>
                  </tr>
                </table>
                <!--=================END FOOTER=====================-->

              </td>
            </tr>
          </table>
          <!-- END WHITE PAGE BODY CONTAINER/WRAPPER -->
         
        </td>
      </tr>
    </table>
    <!-- FULL PAGE WIDTH WRAPPER WITH TINT -->

</html>';
    
    SendMailBySMTP($maildata);
        
    }
    
    if(isset($_POST['sharesurvey']) && $_POST['EmailIds'] != ''){
        // $InvitationResponse = $postObj->InvitefrendsforAssessment($emails);
        
        $maildata = array();

        $maildata["sender"] = array(
                "email" => "contact@wahstory.com",
                "name" => "WAHStory"
                );
                
             $comma_separatedEmail = $_POST['EmailIds'];
            
            $mails = implode(', ', $comma_separatedEmail);
            
            $mailArray = explode(', ', $mails);
            
            $maildata["receiver"] = [];
            
            foreach ($mailArray as $email2) {
                $maildata["receiver"][] = ["email" => $email2];
            }

            
        $maildata["subject"] = "Evaluate Your Social Footprint - WAHStory";
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social Health Report | WAHStory </title>
  <style type="text/css">
   
   

    /************************* END FONT STYLING ************************************/
@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap);
    body {
      width: 100%;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
	  font-family: Poppins, sans-serif;
    }

    table {
      border-collapse: collapse;
    }

    img {
      border: 0;
      outline: none !important;
    }

    .hideDesktop {
      display: none;
    }
	p{
    font-size: 15px;
    font-family: Poppins, sans-serif;
    }
    /********* CTA Style - fixed padding *********/

    .cta-shadow {
      padding: 14px 35px;
      -webkit-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      font-size: 16px;
      font-weight: normal;
      letter-spacing: 0px;
      text-decoration: none;
      display: block;
    }

    body[yahoo] .hideDeviceDesktop {
      display: none;
    }

    @media only screen and (max-width: 640px) {

      div[class=mobilecontent] {
        display: block !important;
        max-height: none !important;
      }

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .halfScreen {
        width: 50% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice640 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice640 {
        display: table !important;
      }


      body[yahoo] .googleCenter {
        margin: 0 auto;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .hideDesktop {
        display: block !important;
      }
    }

    @media only screen and (max-width: 520px) {
      .mobileHeader {
        font-size: 50px !important;
      }
      .mobileBody {
        font-size: 16px !important;
      }
      .mobileSubheader {
        font-size: 30px !important;
      }
    }

    @media only screen and (max-width: 479px) {

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice479 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice479 {
        display: table !important;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .mobileButton {
        width: 150px !important !
      }

    }

    @media only screen and (max-width: 385px) {
      .mobileHeaderSmall {
        font-size: 18px !important;
        padding-right: none;
      }
      .mobileBodySmall {
        font-size: 14px !important;
        padding-right: none;
      }
    }

    /* Stops automatic email inks in iOS */

    a[x-apple-data-detectors] {

      color: inherit !important;

      text-decoration: none !important;

      font-size: inherit !important;

      font-family: inherit !important;

      font-weight: inherit !important;

      line-height: inherit !important;

    }

    a[href^="x-apple-data-detectors:"] {
      color: inherit;
      text-decoration: inherit;
    }

    .footerLinks {
      text-decoration: none;
      color: #384049;
      font-size: 12px;
      line-height: 18px;
      font-weight: normal;
    }

    /*******Some Clients do not support rounded borders (example: older versions of Outlook)**********/

    .roundButton {
      border-radius: 5px;
    }

    /************************* Fixing Auto Styling for Gmail*********************/

    .contact a {
      color: #88888f !important !;
      text-decoration: none;
    }

    u+#body a {
      color: inherit;
      text-decoration: none;
      font-size: inherit;
      font-family: inherit;
      font-weight: inherit;
      line-height: inherit;
    }
	
	
  </style>
  <!-- Fall-back font for Outlook (Arial) -->
  <!--[if (gte mso 9)|(IE)]>

    <style type="text/css">

    a, body, div, li, p, strong, td, span {font-family: Arial, Helvetica, sans-serif !important;}
    
    </style>

  <![endif]-->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" align="center" id="body" style="background-color:#f3f3f5; padding-top: 50px;  padding-bottom: 50px;">
 
    <!-- FULL PAGE WIDTH WRAPPER WITH TINT -->
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" bgcolor="#f3f3f5" valign="top" width="100%">
          <!--========= WHITE PAGE BODY CONTAINER/WRAPPER========-->
          <table align="center" border="0" cellpadding="0" cellspacing="0" class="mobileView" width="600" style="margin-top: 20px; box-shadow: 0px 35px 60px 35px rgb(0 0 0 / 10%) ">
            <tr>
              <td align="center" bgcolor="#FFFFFF" style="padding:0px;" width="100%">

                <!--================================SECTION 0==========================-->
                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;background-color:#625a9c;" width="600">
                  <tr>
                    <td bgcolor="#FFD6E5" class="" style="width:100% !important; padding: 0;background-color:#ffffff;">
                      <!--========Paste your Content below=================-->
                      
                      
                      <!-- BEGIN LOGO -->
                      <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#ffffff" style="border-top: 10px solid #e9204f;">
                        <tr>
                          <td valign="top" width="100%" style="padding-left: 25px;">
                            <img style="max-width: 200px; height: auto;" src="https://www.wahstory.com/images/logos/logo-light.png" alt="WAHStory" />
                          </td>
                        </tr>
                      </table>
                      
                      <!-- END LOGO -->

                      <!-- nothing -->

                      <!--=======End your Content here=====================-->
                    </td>
                  </tr>
                </table>
                <!--=======END SECTION==========-->
				<table align="center" cellpadding="0" cellspacing="0" width="100%" style=" width:100% !important;">
                  <tr>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                    <td width="100%" align="center" valign="middle" style="border-top: 1px solid #d8d8d8;"></td>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                  </tr>
                </table>
                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;" width="600">
                  <tr>
                    <td bgcolor="" class="" style="width:100% !important; padding: 0;">
                        <!-- nothing -->


                        <!--BEGIN TEXT SECTION-->
                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px;">
						<tr>
                            <td style="font-size: 18px; line-height: 1.8;  padding: 10px 25px 10px 25px; font-weight: 500;" class="mso-line-solid mobile-headline">
                                <h1 style="font-size: 25px; margin-top: 20px; margin-bottom: 10px; font-weight: 600;">Hi,</h1>
							<p style="color: #000; font-size: 15px;
    font-family: Poppins, sans-serif; font-weight: 400;"> 
							We have some exciting news for you! '.$_SESSION['name'].', has invited you to join our digital social health survey. They have already taken the survey and received their score, and now they would like you to find out what your score looks like.
                            </p>
                            <p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;"> Your digital social health is an important aspect of your overall well-being in the digital age. It\'s about understanding how you interact with and navigate the online world. By taking this survey, you\'ll gain valuable insights into your digital habits and discover areas where you excel and where you might want to make improvements.

							</p>
                           	<p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">It only takes a few minutes, and the results can be eye-opening. Plus, it\'s a great way to bond with friends by comparing your scores and discussing your digital social health journey together.
 
							</p>
							
							<p style="color: #000; font-size: 14px;
    font-family: Poppins, sans-serif; font-weight: 400;">
 So, what are you waiting for? Click the link below to get started:
							</p>
							
							<a href="https://www.wahstory.com/social-health-impact" style="background: #e9204f; border-radius: 0.125rem; font-size: 15px; padding: 0.64rem 1.14rem!important; color: #fff !important; text-decoration: none;"> Get Started </a>
                            
                            </td>
                          </tr>
                          
                        </table>

                        <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                          <tr>
                             
                          </tr>
                        </table>
                        <!--END TEXT SECTION -->

                        <!--=======End your Content here=====================-->
                    </td>
                  </tr>
                </table>

                

                <!--=================FOOTER=====================-->
                <table align="center" cellpadding="0" cellspacing="0" width="100%" style=" width:100% !important;">
                  <tr>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                    <td width="100%" align="center" valign="middle" style="border-top: 1px solid #d8d8d8;"></td>
                    <td align="center" valign="middle" style="padding: 0 25px 0 0;"></td>
                  </tr>
                </table>
                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="mobileView" style="width:100% !important;" width="600">
                  <tr>
					<td>
						 <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#ffffff">
                          <tr>
                            <td valign="top" width="100%">
                              
                              <table width="100%" cellpadding="0" cellspacing="0" border="0"  style="max-width: 600px;">
                                <tr>
                                  <td style="padding: 0px;">
                                    <table  cellpadding="0" cellspacing="0" border="0" >
                                      <tr>
                                        
                                        <td align="left" style="  font-size: 15px; line-height: 1.4; color: #000000; padding: 15px 15px 5px 30px; ">
                                          Need Support? Connect with us: <a href="mailto:info@wahstory.com" style="color: #e9204f;">info@wahstory.com</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                              
                            </td>
                          </tr>
                        </table>
						
					</td>
					
                  </tr>
                  <tr>
                    <td>
                      <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="mobileView" style="" width="100%">
                       
                        <tr>
                          <td align="left" style="color: #000000;   font-size: 14px; line-height:28px; font-weight: normal; padding: 10px 0px 0px 30px; text-decoration: none;" valign="middle">Coastal Highway, Lewes, Delaware, USA <br/>&#169; '.date('Y').' Wahstory, LLC.</td>
                        </tr>
                        <!--===========CUSTOMER ACTIONS===========-->
                      </table>
                      <!--=============END CUSTOMER ACTIONS========-->
                    </td>
                  </tr>
                  <tr>
                    <td width="auto" style="display: block;" height="40">&nbsp;</td>
                  </tr>
                </table>
                <!--=================END FOOTER=====================-->

              </td>
            </tr>
          </table>
          <!-- END WHITE PAGE BODY CONTAINER/WRAPPER -->
         
        </td>
      </tr>
    </table>
    <!-- FULL PAGE WIDTH WRAPPER WITH TINT -->

</html>';
    
    SendMailBySMTP($maildata);
    
    echo '<script>alert("Thank you, Your invitation has been shared successfully!");</script>';
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" ">
    <meta name="author" content="WAHStory">
    <title>Social Health Or Impact Assessment</title>

    <!-- Favicons-->
     <link rel="shortcut icon" href="/images/wah_fav.ico">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>
	
	<style>
	    
@media only screen and (max-width: 768px) {
    
    figure{
        display: none;
    }
    .content-left-wrapper{
        padding-top: 80px;
        padding-bottom: 0px;
    }
    #social {
        right: 20px;
    }
}
	</style>

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<div class="container-fluid">
	    <div class="row row-height">
	        <div class="col-xl-4 col-lg-4 content-left">
	            <div class="content-left-wrapper">
	                <a href="index.php" id="logo"><img src="/images/logos/logo-white.png" alt="" width="145" height=""></a>
	                <div id="social">
	                    <span>Follow Us</span>
	                    <ul>
	                        <li><a href="https://www.facebook.com/WAHStory-110196560391369/" target="_blank"><i class="icon-facebook"></i></a></li>
	                        <li><a href="https://www.instagram.com/wahstory/"  target="_blank"><i class="icon-instagram"></i></a></li>
	                        <li><a href="https://www.linkedin.com/company/wahstory/" target="_blank"><i class="icon-linkedin"></i></a></li>
	                    </ul>
	                </div>
	                <!-- /social -->
	                <div>
	                    <figure><img src="img/info_graphic_1.svg" alt="" class="img-fluid" width="270" height="270"></figure>
	                    <h2>Evaluate Your Social Footprint</h2>
	                    <p>Our Social Impact Assessment helps you understand your Digital Social Impact, offering insights into your strengths and opportunities for growth.</p>
	                    <br>
	                </div>
	                <div class="copy">© <?=date('Y');?> WAHStory</div>
	            </div>
	            <!-- /content-left-wrapper -->
	        </div>
	        <!-- /content-left -->
	        <div class="col-xl-8 col-lg-8 content-right" id="start">
	        
	        <div class="row">
	            <div class="col-xl-12 col-lg-12 text-center">
	                <h3>Thank You for Completing the Digital Social Health Survey!</h3> <br>
	                <p> Stay tuned for more updates and insights. Your valuable input is helping us create a better digital world for everyone. </p>
	                <br>
	            </div>
	            
	            
	            <div class="col-md-12 text-center">
	                
	                <a href="graphdash/" class="btn btn-primary" title="View Your Score">View Score <i class="icon-eye"></i> </a>
	                    &nbsp; &nbsp; &nbsp;
	                <a href="#" class="btn btn-primary" title="Share the Survey with friends." data-bs-toggle="modal" data-bs-target="#shareSurveyModal">Share <i class="icon-forward"></i> </a> 
	            </div>
	            
	        </div>
	        
	        </div>
	        <!-- /content-right-->
	    </div>
	    <!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	
	
	<!-- Modal terms -->
	<div class="modal fade" id="shareSurveyModal" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Share the Survey with friends</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email Addresses Saperated by comma ( , ) *</label>
                            <input type="text" name="EmailIds[]" id="email" class="form-control required" onchange="getVals(this, 'email_field');" required>
                        </div>
                        <button type="submit" name="sharesurvey" class="submit">Share Now</button>
				    </form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	
	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/common_functions.js"></script>
	<script src="js/file-validator.js"></script>

	<!-- Wizard script-->
	<script src="js/func_1.js"></script>

</body>
</html>