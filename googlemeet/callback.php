<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
require_once 'google_config.php';


include('../users/update/inc/meeting_bookings.php');
    $UtilityObj = new MeetingBookingUtility();

$client = getClient();

if (isset($_GET['code'])) {
    // Get the access token from the authorization code
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (isset($token['error'])) {
        echo "Error during authentication.";
        exit;
    }
    
    // Save the token to the session
    $_SESSION['access_token'] = $token;
    
    //CREATE ONE - ONE MEETING ##################################
    //CREATE ONE - ONE MEETING ##################################
    if(isset($_SESSION['CREATE_ONEONONE_MEETING'])) {
        
        $userRow = $UtilityObj->GetWAHClubUserById($_SESSION['CREATE_ONEONONE_MEETING']['user_id']);
        $memberRow = $UtilityObj->GetWAHClubUserById($_SESSION['CREATE_ONEONONE_MEETING']['member_id']);
        
        $usertimezone = $UtilityObj->getusertimezonebyclubuserid($userRow['id']);
        $membertimezone = $UtilityObj->getusertimezonebyclubuserid($memberRow['id']);
        
        
        $meetingTitle = $_SESSION['CREATE_ONEONONE_MEETING']['meeting_title'];
        $meetingDescription = $_SESSION['CREATE_ONEONONE_MEETING']['meeting_note'];
        $meetingDate = $_SESSION['CREATE_ONEONONE_MEETING']['meeting_date'];
        
        $meetingStartTime = $_SESSION['CREATE_ONEONONE_MEETING']['start_time'];
        $meetingEndTime = $_SESSION['CREATE_ONEONONE_MEETING']['end_time'];
        
        $meetingStartTime_RAW = $meetingDate .' '. $meetingStartTime;
        $meetingEndTime_RAW = $meetingDate .' '. $meetingEndTime;
        
        $meetingStartTime = $meetingDate .' '. $meetingStartTime;
        $meetingEndTime = $meetingDate .' '. $meetingEndTime;
        
        $meetingTimeZone = $membertimezone['value'];
        
        $attendeesEmails = $memberRow['email'] .', '. $userRow['email'];
        $attendeesEmailsArray = explode(', ', $attendeesEmails);
        
        
        // Create DateTime object in the source timezone (+05:30)
        $meetingStartTime = new DateTime($meetingStartTime, new DateTimeZone($membertimezone['value']));
        
        // Convert the DateTime object to the target timezone (-09:00)
        $meetingStartTime->setTimezone(new DateTimeZone($usertimezone['value']));
        
        $meetingEndTime = new DateTime($meetingEndTime, new DateTimeZone($membertimezone['value']));
        $meetingEndTime->setTimezone(new DateTimeZone($usertimezone['value']));
        
        $NewMeetingDate = $meetingStartTime->format('Y-m-d'); 
        $meetingStartTime = $meetingStartTime->format('Y-m-d\TH:i:sP');
        
        // Format: YYYY-MM-DDTHH:MM:SS+HH:MM
        $meetingEndTime = $meetingEndTime->format('Y-m-d\TH:i:sP'); 
        
        $meetinglink = $UtilityObj->CreateGoogleMeeting($meetingTitle, $meetingDescription, $meetingStartTime, $meetingEndTime, $meetingTimeZone, $attendeesEmailsArray);
        
        if($meetinglink) {
             
            $UtilityObj->CreateOneOnOneMeeting($userRow['id'], $memberRow['id'], $NewMeetingDate, $meetingStartTime, $meetingEndTime, $usertimezone['value'], $_SESSION['CREATE_ONEONONE_MEETING']['status'], $meetinglink, $_SESSION['CREATE_ONEONONE_MEETING']['meeting_note']);
        
            $MemberName = $memberRow['firstname'] .' '.$memberRow['lastname'];
            $MemberEmail = $memberRow['email'];
            $UserName = $userRow['firstname'] .' '.$userRow['lastname'];
            $UserEmail = $userRow['email'];
            
            $UtilityObj->SendConfirmMeetingEmailMember($MemberName, $MemberEmail, $UserName, $meetingStartTime_RAW, $meetinglink);
            
            $UtilityObj->SendConfirmMeetingEmailUser($UserName, $UserEmail, $MemberName, $meetingStartTime, $meetinglink);
            
             
        } // end if
            if (isset($_SESSION['CREATE_ONEONONE_MEETING'])) { 
                   unset($_SESSION['CREATE_ONEONONE_MEETING']);
               }
         echo '<script>window.location.href="/users/member.bookingrequests.php";</script>';
         
        
    //CREATE ONE - ONE MEETING ##################################
    //CREATE ONE - ONE MEETING ##################################
    
    } elseif(isset($_SESSION['CREATEGROUP_MEETING'])) {
        
    //CREATE GROUP MEETING ##################################
    //CREATE GROUP MEETING ##################################
        
        $memberRow = $UtilityObj->GetWAHClubUserById($_SESSION['CREATEGROUP_MEETING']['member_id']);
        
        $membertimezone = $UtilityObj->getusertimezonebyclubuserid($memberRow['id']);
        
        $meetingTitle = $_SESSION['CREATEGROUP_MEETING']['meeting_title'];
        $meetingDescription = $_SESSION['CREATEGROUP_MEETING']['meeting_note'];
        $meetingDate = $_SESSION['CREATEGROUP_MEETING']['meeting_date'];
        $meetingStartTime = $_SESSION['CREATEGROUP_MEETING']['start_time'];
        $meetingEndTime = $_SESSION['CREATEGROUP_MEETING']['end_time'];
        
        $meetingStartTime_raw = $meetingStartTime;
        
        $meetingStartTime = $meetingDate .' '. $meetingStartTime;
        $meetingStartTime_raw2 = $meetingStartTime;
        $meetingEndTime_raw = $meetingEndTime;
        
        $meetingEndTime = $meetingDate .' '. $meetingEndTime;
        
        $meetingStartTime = new DateTime($meetingStartTime, new DateTimeZone($membertimezone['value']));
        $meetingEndTime = new DateTime($meetingEndTime, new DateTimeZone($membertimezone['value']));
    
            // Convert to ISO 8601 format with time zone offset
        $meetingStartTime = $meetingStartTime->format('Y-m-d\TH:i:sP');  
            // Format: YYYY-MM-DDTHH:MM:SS+HH:MM
        $meetingEndTime = $meetingEndTime->format('Y-m-d\TH:i:sP');      
            // Format: YYYY-MM-DDTHH:MM:SS+HH:MM
        
        
        $UserIdsArray = explode(',', $_SESSION['CREATEGROUP_MEETING']['user_ids']);
        
        $attendeesEmails = [];
        $attendeesEmails[] = $memberRow['email'];
        foreach ($UserIdsArray as $UserId) {
            $User_Row = $UtilityObj->GetWAHClubUserById($UserId);
            if (isset($User_Row['email'])) {
                $attendeesEmails[] = $User_Row['email']; 
            }
        }
        
        $meetingTimeZone = $membertimezone['value'];
        $meetinglink = $UtilityObj->CreateGoogleMeeting($meetingTitle, $meetingDescription, $meetingStartTime, $meetingEndTime, $meetingTimeZone, $attendeesEmails);
        
        if($meetinglink) {
            
            $UtilityObj->CreateGroupMeeting($_SESSION['CREATEGROUP_MEETING']['user_ids'], $memberRow['id'], $meetingDate, $meetingStartTime_raw, $meetingEndTime_raw, $meetingTimeZone, $meetinglink, $meetingTitle, $meetingDescription);
            
        
            $MemberName = $memberRow['firstname'] .' '.$memberRow['lastname'];
            $MemberEmail = $memberRow['email'];
             
            
            $UtilityObj->SendGroupMeetingEmailMember($MemberName, $MemberEmail, $meetingStartTime_raw2, $meetingTimeZone, $meetinglink);
            
            foreach ($UserIdsArray as $participantId) {
                $participant_Row = $UtilityObj->GetWAHClubUserById($participantId);
                if (isset($participant_Row['email'])) {
                    
                    $Participant_name = $participant_Row['firstname'] .' '.$participant_Row['lastname'];
                    $Participant_email = $participant_Row['email'];
                    
                    $participanttimezone = $UtilityObj->getusertimezonebyclubuserid($participant_Row['id']);
                    $userTimeZone = $participanttimezone['value'];
                    
                    $UtilityObj->SendGroupMeetingEmailParticipants ($Participant_name, $Participant_email, $MemberName, $meetingStartTime, $meetingTimeZone, $userTimeZone, $meetinglink);
                    
                    
                }
            }
            
            // $UserName = $userRow['firstname'] .' '.$userRow['lastname'];
            // $UserEmail = $userRow['email'];
            // $UtilityObj->SendConfirmMeetingEmailUser($UserName, $UserEmail, $MemberName, $meetingStartTime, $meetinglink);
            
             
        } // end if
        if (isset($_SESSION['CREATEGROUP_MEETING'])) { 
               unset($_SESSION['CREATEGROUP_MEETING']);
           }
         echo '<script>window.location.href="/users/member.bookingrequests.php";</script>';
         
        
    //CREATE ONE - ONE MEETING ##################################
    //CREATE ONE - ONE MEETING ##################################
    } else {
    
        $bookingRow = $UtilityObj->GetBookingDetailsById($_SESSION['CONFIRM_MEETING']['requestId']);
        $userRow = $UtilityObj->GetWAHClubUserById($bookingRow['user_id']);
        $memberRow = $UtilityObj->GetWAHClubUserById($bookingRow['member_id']);
        
        $meetingTitle = 'WAHClub Meeting NEW';
        $meetingDescription = 'This is a Google Meet video conference.';
        $meetingStartTime = $bookingRow['start_time'];
        $meetingEndTime = $bookingRow['end_time'];
        $meetingTimeZone = $bookingRow['slot_timezone'];
        $attendeesEmails = $userRow['email'].', '.$memberRow['email'];
        $attendeesEmailsArray = explode(', ', $attendeesEmails);
        
        
        $meetingStartTime = new DateTime($meetingStartTime, new DateTimeZone($meetingTimeZone));
        $meetingEndTime = new DateTime($meetingEndTime, new DateTimeZone($meetingTimeZone));
    
            // Convert to ISO 8601 format with time zone offset
        $meetingStartTime = $meetingStartTime->format('Y-m-d\TH:i:sP');  
            // Format: YYYY-MM-DDTHH:MM:SS+HH:MM
        $meetingEndTime = $meetingEndTime->format('Y-m-d\TH:i:sP');      
            // Format: YYYY-MM-DDTHH:MM:SS+HH:MM
        
        
        $meetinglink = $UtilityObj->CreateGoogleMeeting($meetingTitle, $meetingDescription, $meetingStartTime, $meetingEndTime, $meetingTimeZone, $attendeesEmailsArray);
        // echo $meetinglink;
        
        $response = $UtilityObj->UpdateMeetingLink($_SESSION['CONFIRM_MEETING']['requestId'], $meetinglink);
        if($response === 'success') {
            
            $UtilityObj->ConfirmNCreateMeeting($_SESSION['CONFIRM_MEETING']['requestId'], $_SESSION['CONFIRM_MEETING']['status'], $_SESSION['CONFIRM_MEETING']['remark']);
            
            $MemberName = $memberRow['firstname'] .' '.$memberRow['lastname'];
            $MemberEmail = $memberRow['email'];
            $UserName = $userRow['firstname'] .' '.$userRow['lastname'];
            $UserEmail = $userRow['email'];
            
            $UtilityObj->SendConfirmMeetingEmailMember($MemberName, $MemberEmail, $UserName, $bookingRow['start_time'], $meetinglink);
            
            $UtilityObj->SendConfirmMeetingEmailUser($UserName, $UserEmail, $MemberName, $bookingRow['start_time'], $meetinglink);
            
            if (isset($_SESSION['CONFIRM_MEETING'])) { 
                   unset($_SESSION['CONFIRM_MEETING']);
               }
             echo '<script>window.location.href="/users/member.bookingrequests.php";</script>';
        }
        echo $response;
        echo ' <a href="/users/member.bookingrequests.php">Go to Dahsboard</a>';
        
    
    
        
    } 
    
    exit;
    
} // FINAL if ENDs
