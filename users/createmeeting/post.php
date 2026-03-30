<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/users/update/inc/meeting_bookings.php');
    
    $Obj = new MeetingBookingUtility();
    
    if(isset($_POST['GetUserData']) && $_POST['userid'] != '') {
        
        $userrow = $Obj->GetWAHClubUserById($_POST['userid']);
                    
        header('Content-Type: application/json');
        echo json_encode($userrow);
    } 
    
    
    if(isset($_POST['CheckSlot']) && $_POST['userid'] != '' && $_POST['memberid'] != '') {
        
        $userrow = $Obj->GetWAHClubUserById($_POST['userid']);
        $memberrow = $Obj->GetWAHClubUserById($_POST['memberid']);
        
        $userTZRow = $Obj->getusertimezonebyclubuserid($_POST['userid']);
        $memberTZRow = $Obj->getusertimezonebyclubuserid($_POST['memberid']);
        
        /*$datetime = new DateTime();
        $DT = $datetime->format("Y-m-d H:i");
        if($DT > $_POST['starttime']) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'NOTAVAILABLE']);
            exit;
        }*/
        if(isset($userTZRow, $memberTZRow, $_POST['starttime'])){
        
            $meetingStartTime = new DateTime($_POST['starttime'], new DateTimeZone($memberTZRow['value']));
            $meetingStartTime->setTimezone(new DateTimeZone($userTZRow['value']));
            $meetingStartTime->format('Y-m-d\TH:i:sP'); 
            $meetingStart_Time = $meetingStartTime->format('Y-m-d H:i:s'); 
            
            
            $slotavail = $Obj->CheckUserBooking($_POST['userid'], $meetingStart_Time);
            
            //Member is not free
            $slotavail2 = $Obj->CheckUserBooking($_POST['memberid'], $_POST['starttime']);
            
            if($slotavail > 0 || $slotavail2 > 0) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'NOTAVAILABLE']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'AVAILABLE']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error']);
        }
    }
    
    if(isset($_POST['CheckSlotByDate']) && $_POST['memberid'] != '' && $_POST['starttime'] != '') {
        
        $member_booking = $Obj->CheckUserBooking($_POST['memberid'], $_POST['starttime']);
        
        $MemberGrou_meeting = $Obj->CheckMemberGroupMeeting($_POST['memberid'], $_POST['starttime']);
        
         if($member_booking > 0 || $MemberGrou_meeting > 0) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'NOTAVAILABLE']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'AVAILABLE']);
            }
    }
    
    if(isset($_POST['SearchByKeyword']) && $_POST['memberid'] != '' && $_POST['keyword'] != '') {
        
        $clubusers = $Obj->GetClubUsersByKeywordSearch($_POST['memberid'], $_POST['keyword']);
        
         if($clubusers > 0) {
                header('Content-Type: application/json');
                echo json_encode(['users' => $clubusers]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['users' => NULL]);
            }
    }
    
    if(isset($_POST['SearchByCategory']) && $_POST['memberid'] != '' && $_POST['catg'] != '') {
        
        $clubusers = $Obj->GetClubUsersByCategorySearch($_POST['memberid'], $_POST['catg']);
        
         if($clubusers > 0) {
                header('Content-Type: application/json');
                echo json_encode(['users' => $clubusers]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['users' => NULL]);
            }
    }
        
    /*else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'NULL']);
    }*/
    
    
?>