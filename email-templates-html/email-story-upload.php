<?php

$MemberName = 'Pratham Kakkar';
$UserName = 'Amit Kapoor';
$MeetingDate = '2 April, 2025';
$MeetingStart = '10:00am';
$MeetingEnd = '10:30am';
$MeetingLink = 'https://meet.google.com/qdj-xwdp-yxa';
$CompanyName = 'Tech Solutions Inc';
$EmailID = 'pratham@example.com';
$StoryLink = 'https://www.wahstory.com/story/pratham-kakkar';


$maildata = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your WAHStory is Now Live! | WAHClub </title>
  <style type="text/css">
   
   

    /************************* END FONT STYLING ************************************/
@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap);
    body {
      width: 100%;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
	  font-family: Open Sans;
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
                      <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#ffffff" style="border-top: 10px solid #ec398b;">
                        <tr>
                          <td valign="top" width="100%" style="padding-left: 25px;">
                            <img style="max-width: 200px; height: auto" src="https://www.wahstory.com/images/logos/logo-light.png" alt="WAHStory" />
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
                            <td style="font-size: 18px; line-height: 1.8;  padding: 10px 25px 10px 25px; font-weight: 400;" class="mso-line-solid mobile-headline">
                                
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$MemberName.',
							</p>
							
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We\'re thrilled to let you know that your <strong>WAHStory</strong> is now live! ✨
							</p>
							
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">It\'s not just a feature — it\'s a celebration of your journey, your grit, and your vision with <strong>'.$CompanyName.'</strong>. Thank you for sharing it with us.
							</p>

                            <p style="text-align: center; margin: 25px 0;">
                                <a href="'.$StoryLink.'" style="background-color: #ec398b; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; font-family: sans-serif;">🔗 Read Your Published Story</a>
                            </p>

                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">This is a key milestone, and we believe your story has the power to inspire thousands. We\'ve also tagged you in an Instagram collaboration post — once you accept the tag, it\'ll be co-published on your feed as well.
							</p>

                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Here are your <strong>WAHClub access details</strong> — your personal gateway to edit your page, explore benefits, and grow with a like-minded community:
							</p>

                            <ul style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px; margin-left: 20px;">
                                <li><strong>Email:</strong> '.$EmailID.'</li>
                                <li><strong>Password:</strong> WAH@Club12</li>
                            </ul>

                            <p style="text-align: center; margin: 25px 0;">
                                <a href="https://www.wahstory.com/wahclub/" style="background-color: #ec398b; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; font-family: sans-serif;">🔗 Login to WAHClub Dashboard</a>
                            </p>

                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We\'d be incredibly grateful if you could share your WAHStory on your social media platforms and tag us — it helps amplify your message and creates more impact.
							</p>

                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">This is an important moment — not just for you, but for all the changemakers who will be inspired by your story. Let\'s give it the visibility it deserves. 💥
							</p>

                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We\'re so glad to have you in the <strong>WAHStory & WAHClub</strong> community, and we look forward to building more with you.
							</p>
							 
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							Best regards,<br>
							<strong>Team WAHStory</strong>
							</p>
							
							
                            <p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Stay in the loop with us here:</p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 10px 0;">
                              <tr>
                                <td width="50%" style="padding: 5px 10px 5px 0; vertical-align: top;">
                                  🔗 <a href="https://www.linkedin.com/company/wahstory/" style="color: #ec398b; text-decoration: none; font-family: sans-serif; font-size: 16px;">WAHStory on LinkedIn</a>
                                </td>
                                <td width="50%" style="padding: 5px 0 5px 10px; vertical-align: top;">
                                  🔗 <a href="https://www.instagram.com/wahstory.official/" style="color: #ec398b; text-decoration: none; font-family: sans-serif; font-size: 16px;">WAHClub on LinkedIn
                                  </a>
                                </td>
                              </tr>
                              <tr>
                                <td width="50%" style="padding: 5px 10px 5px 0; vertical-align: top;">
                                  🔗 <a href="https://www.linkedin.com/company/wahclub/" style="color: #ec398b; text-decoration: none; font-family: sans-serif; font-size: 16px;">WAHStory on Instagram</a>
                                </td>
                                <td width="50%" style="padding: 5px 0 5px 10px; vertical-align: top;">
                                  🔗 <a href="https://www.instagram.com/wahclub.official/" style="color: #ec398b; text-decoration: none; font-family: sans-serif; font-size: 16px;">WAHClub on Instagram</a>
                                </td>
                              </tr>
                            </table>
							 
                            </td>
                          </tr>
                          
                        </table>

                        <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                          <tr>
                            <td align="center" height="5px" style="background-color: #FFFFFF;">
                            </td>
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
                                          Need Support? Connect with us: <a href="mailto:info@wahstory.com" style="color: #ec398b;">info@wahstory.com</a>
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
                          <td align="left" style="color: #000000;   font-size: 14px; line-height:28px; font-weight: normal; padding: 10px 0px 0px 30px; text-decoration: none;" valign="middle">
                          &#169; 2025 WAHStory.com</td>
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

echo $maildata;

?>