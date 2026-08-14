<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/googlemeet/google_config.php');
 
class MeetingBookingUtility extends BaseClass
{ 
    const BOOKING_PENDING = 'Pending';
    const BOOKING_REQUESTED = 'Requested';
    const BOOKING_CONFIRMED = 'Confirmed';
    const BOOKING_COMPLETED = 'Completed';
    const BOOKING_CANCELLED = 'Cancelled';
    const BOOKING_REJECTED = 'Rejected';
    const BOOKING_WITHDRAWAL = 'Withdrawal';
    
    public static function CurrentDate(): string {
        $datetime = new DateTime();
        return $datetime->format('Y-m-d');
    }
        
    
    function formatDate($date){
        return date('M d, Y', strtotime($date));
    }
    function formatTime($time){
        return date('h:i A', strtotime($time));
    }
    
    function GetWAHClubUserById($userid)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = :userid";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function GetAllWAHClubUsers()
    {
        $sql = "SELECT * FROM `users`";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    
    function GetBookingDetailsById($bookingid)
    {
        $sql = "SELECT * FROM `bookings` WHERE `id` = :bookingid";
        $stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $bookingid);
    	$stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    
    function saveNotification($senderId, $receiverId, $message, $link)
    {
        $sql = "INSERT INTO `notifications` (`sender_id`, `receiver_id`, `notification`, `link`) VALUES(:senderid, :receiverid, :message, :link)";
        
        $stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":senderid", $senderId);
    	$stm->bindParam(":receiverid", $receiverId);
    	$stm->bindParam(":message", $message);
    	$stm->bindParam(":link", $link);
    	
        if ($stm->execute()) {
            return 'success';
        }else{
            return 'false'; 
        }
    }
    
    
    
    function CountOfRequestsByStatus($MemberId, $status){
        
        
        $Date = self::CurrentDate();
        
        if($status == self::BOOKING_PENDING) {
            $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND `status` = :status AND `slot_date` > :currentdate";
        } else if($status == self::BOOKING_COMPLETED){
            $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND `slot_date` < :currentdate AND `status` NOT IN ('Cancelled', 'Rejected', 'Withdrawal')";
        } else {
            $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND `status` = :status";
        }
        
        
         
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->bindParam(":status", $status, PDO::PARAM_STR);
        $stm->bindParam(":currentdate", $Date);
        $stm->execute();
        
        return $stm->rowCount();
        
    }  //Function Ends
    
//########  UPDATING , ACCEPTING THE REQUESTS & BOOKINGS ######
###############################################################
    
    // ################# REJECT BOOKING
    function RejectBookingRequest($requestId, $status, $remarks) {
    	
    	$sql = "SELECT * FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    	    
    $bookingRow = $stm->fetch();
    
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `status` = :status, `remarks` = :remarks WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":status", $status);
    		$stm2->bindParam(":remarks", $remarks);
    		
    		if($stm2->execute()) {
    		    
    $userRow = $this->GetWAHClubUserById($bookingRow['user_id']);
    $memberRow = $this->GetWAHClubUserById($bookingRow['member_id']);
    
    if($status == self::BOOKING_REJECTED) {
        $this->saveNotification($bookingRow['member_id'], $bookingRow['user_id'], 'Host has rejected your booking request.', 'member.bookingrequests.php');
    } else {
        $this->saveNotification($bookingRow['user_id'], $bookingRow['member_id'], 'Your request successfully withdrawal!', 'member.bookingrequests.php');
    }
    
    
        $response = [
        'MemberName' => $memberRow['firstname'] .' '.$memberRow['lastname'],
        'MemberEmail' => $memberRow['email'],
        'UserName' => $userRow['firstname'] .' '.$userRow['lastname'],
        'UserEmail' => $userRow['email'],
        'status' => 'success',
        'message' => 'Rejected Successfully!'
    		        ];
    		    
    		    return $response;
    		} else {
    		    return [
                        'status' => 'error',
                        'message' => 'Something went wrong!'
                    ];
    		}
    	} // Count Ends
    	
    	return  [
                    'status' => 'error',
                    'message' => 'Something went wrong!'
                ];
    
    }	// function Ends
    
    
    // ################# RESCHEDULE REQUEST SEND BOOKING
    function RescheduleRequestSend($requestId, $status) {
    	
    	$sql = "SELECT * FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    	    
    $bookingRow = $stm->fetch();
    	    
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `status` = '".self::BOOKING_PENDING."', `reschedule_status` = :status WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":status", $status);
    		
    		if($stm2->execute()) {
    		    
    	    $this->saveNotification($bookingRow['member_id'], $bookingRow['user_id'], 'Host requested to reschedule, kindly reschedule it.', 'member.bookingrequests.php');
    	     
    		    
            $userRow = $this->GetWAHClubUserById($bookingRow['user_id']);
            $memberRow = $this->GetWAHClubUserById($bookingRow['member_id']);
    
        $response = [
        'MemberName' => $memberRow['firstname'] .' '.$memberRow['lastname'],
        'MemberEmail' => $memberRow['email'],
        'UserName' => $userRow['firstname'] .' '.$userRow['lastname'],
        'UserEmail' => $userRow['email'],
        'status' => 'success',
        'message' => 'Request Sent Successfully!'
    		        ];
    		    return $response;
    		    
    		} else {
    		    return [
                        'status' => 'error',
                        'message' => 'Something went wrong!'
                    ];
    		}
    		
    	} // Count Ends
    	
    	return  [
                    'status' => 'error',
                    'message' => 'Something went wrong!'
                ];
    
    }	// function Ends
    
    
    // ################# RESCHEDULE BOOKING BY USER
    function RescheduleMeetingUser($requestId, $slotdatetime) {
    	
    	$sql = "SELECT * FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    	    
    $bookingRow = $stm->fetch();
    	    
    	    $status = self::BOOKING_PENDING;
    	    
    	    $slotdatetime = new DateTime($slotdatetime);
    	    $slot_date = $slotdatetime->format('Y-m-d');
    	    $start_time = $slotdatetime->format('Y-m-d H:i:s');
    	     
    	     $slotdatetime->modify('+30 minutes'); 
    	    $end_time = $slotdatetime->format('Y-m-d H:i:s');
    	    
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `status` = :status, `reschedule_status` = 'Acknowledged', `slot_date` = :slot_date, `start_time` = :start_time, `end_time` = :end_time WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":slot_date", $slot_date);
    		$stm2->bindParam(":start_time", $start_time); 
    		$stm2->bindParam(":end_time", $end_time); 
    		$stm2->bindParam(":status", $status); 
    		
    		if($stm2->execute()) {
    		    
            $userRow = $this->GetWAHClubUserById($bookingRow['user_id']);
            $memberRow = $this->GetWAHClubUserById($bookingRow['member_id']);
    
        $response = [
        'MemberName' => $memberRow['firstname'] .' '.$memberRow['lastname'],
        'MemberEmail' => $memberRow['email'],
        'UserName' => $userRow['firstname'] .' '.$userRow['lastname'],
        'UserEmail' => $userRow['email'],
        'status' => 'success',
        'message' => 'Request Sent Successfully!'
    		        ];
    		    return $response;
    		    
    		} else {
    		    return [
                        'status' => 'error',
                        'message' => 'Something went wrong!'
                    ];
    		}
    		
    	} // Count Ends
    	
    	return  [
                    'status' => 'error',
                    'message' => 'Something went wrong!'
                ];
    
    }	// function Ends
    
    
    // ############### CONFIRM & CREATE MEETING FOR BOOKING
    function ConfirmNCreateMeeting($requestId, $status, $remark) {
        
    	$sql = "SELECT COUNT(*) FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `status` = :status, `remarks` = :remarks WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":status", $status);
    		$stm2->bindParam(":remarks", $remark);
    		
    		if($stm2->execute()) {
    		    return 'success';
    		} else {
    		    return 'error';
    		}
    	} // Count Ends
    	
    	return 'error';
    
    }	// function Ends
    
    function UpdateMeetingLink($requestId, $meetinglink) {
        
    	$sql = "SELECT COUNT(*) FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `google_meet_link` = :meetinglink WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":meetinglink", $meetinglink);
    		
    		if($stm2->execute()) {
    		    return 'success';
    		} else {
    		    return 'error';
    		}
    	} // Count Ends
    	
    	return 'error';
    
    }	// function Ends
    
    
    // ############### CANCEL MEETING
    function CancelMeeting($requestId, $status, $remark, $userid) {
        
        $cancellation_time = date('Y-m-d H:i:s');
         
    	$sql = "SELECT * FROM `bookings` WHERE `id` = :bookingid";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":bookingid", $requestId);
    	$stm->execute();
    	if($stm->rowCount()){
    	    
    	    $bookingRow = $stm->fetch();
    	    if($bookingRow['user_id'] == $userid) {
    	        $role = 'User';
    	    } else {
    	        $role = 'Member';
    	    }
    	    
    	    
    		// Update Condition		
    		$sql = "UPDATE `bookings` SET `status` = :status, `remarks` = :remarks, `cancelled_by` = :cancelled_by, `cancellation_time` = :cancellation_time WHERE `id` = :bookingid";
    		$stm2 = $this->SecndopenConn->prepare($sql);
    		$stm2->bindParam(":bookingid", $requestId);
    		$stm2->bindParam(":status", $status);
    		$stm2->bindParam(":remarks", $remark);
    		$stm2->bindParam(":cancelled_by", $role);
    		$stm2->bindParam(":cancellation_time", $cancellation_time);
    		
    		
    		if($stm2->execute()) {
    		    
            $userRow = $this->GetWAHClubUserById($bookingRow['user_id']);
            $memberRow = $this->GetWAHClubUserById($bookingRow['member_id']);
    
            $response = [
            'MemberName' => $memberRow['firstname'] .' '.$memberRow['lastname'],
            'MemberEmail' => $memberRow['email'],
            'UserName' => $userRow['firstname'] .' '.$userRow['lastname'],
            'UserEmail' => $userRow['email'],
            'start_time' => $bookingRow['start_time'],
            'status' => 'success',
            'message' => 'Request Sent Successfully!'
        		        ];
    		    return $response;
    		    
    		} else {
    		    return [
                        'status' => 'error',
                        'message' => 'Something went wrong!'
                    ];
    		}
    		
    	} // Count Ends
    	
    	return  [
                    'status' => 'error',
                    'message' => 'Something went wrong!'
                ];
    
    }	// function Ends
    
    
    
// ############### FETCHING & GETTING THE BOOOKING DATA FROM THE BACKENDS
#########################################################################
    
    function GetAllPendingNewBookingRequests_Member($MemberId){
        
        $status = self::BOOKING_PENDING;
        $reschedule_status = self::BOOKING_COMPLETED;
        
        $Date = self::CurrentDate();
        
        $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND `status` = :status AND (`reschedule_status` != :reschedule_status OR `reschedule_status` IS NULL) AND `slot_date` >= :currentdate";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->bindParam(":status", $status);
        $stm->bindParam(":reschedule_status", $reschedule_status);
        $stm->bindParam(":currentdate", $Date);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    function GetAllConfirmedBookingRequests_Member($MemberId){
        
        $status = self::BOOKING_CONFIRMED;
        $Date = self::CurrentDate();
        
        $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND `status` = :status AND `slot_date` >= :currentdate ORDER BY `slot_date` ASC";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId);
        $stm->bindParam(":status", $status);
        $stm->bindParam(":currentdate", $Date);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    function GetAllGroupMeetings_Member($MemberId){
        
        $status = self::BOOKING_CONFIRMED;
        
        
        $sql = "SELECT * FROM (
    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           NULL AS participant_id, NULL AS gmp_user_id, NULL AS meeting_attended, NULL AS remarks, NULL AS participant_created_at, NULL AS participant_updated_at, 
           'host' AS role
    FROM group_meetings gm
    WHERE gm.member_id = :member_id AND gm.status = :status

    UNION ALL

    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           gmp.id AS participant_id, gmp.user_id AS gmp_user_id, gmp.meeting_attended, gmp.remarks, gmp.created_at AS participant_created_at, gmp.updated_at AS participant_updated_at, 
           'participant' AS role
    FROM group_meetings gm
    LEFT JOIN group_meeting_participants gmp ON gm.id = gmp.meeting_id
    WHERE gmp.user_id = :member_id
) AS combined ORDER BY meeting_date";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId); 
        $stm->bindParam(":status", $status);  
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    function GetUpcomingGroupMeetings_Member($MemberId){
        
        $status = self::BOOKING_CONFIRMED;
        $Date = self::CurrentDate();
        
        $sql = "SELECT * FROM (
    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           NULL AS participant_id, NULL AS gmp_user_id, NULL AS meeting_attended, NULL AS remarks, NULL AS participant_created_at, NULL AS participant_updated_at, 
           'host' AS role
    FROM group_meetings gm
    WHERE gm.member_id = :member_id AND gm.status = :status

    UNION ALL

    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           gmp.id AS participant_id, gmp.user_id AS gmp_user_id, gmp.meeting_attended, gmp.remarks, gmp.created_at AS participant_created_at, gmp.updated_at AS participant_updated_at, 
           'participant' AS role
    FROM group_meetings gm
    LEFT JOIN group_meeting_participants gmp ON gm.id = gmp.meeting_id
    WHERE gmp.user_id = :member_id
) AS combined WHERE meeting_date >= :currentdate";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId); 
        $stm->bindParam(":status", $status); 
        $stm->bindParam(":currentdate", $Date); 
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    function GetPastGroupMeetings_Member($MemberId){
        
        $status = self::BOOKING_CONFIRMED;
        $Date = self::CurrentDate();
        
        $sql = "SELECT * FROM (
    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           NULL AS participant_id, NULL AS gmp_user_id, NULL AS meeting_attended, NULL AS remarks, NULL AS participant_created_at, NULL AS participant_updated_at, 
           'host' AS role
    FROM group_meetings gm
    WHERE gm.member_id = :member_id AND gm.status = :status

    UNION ALL

    SELECT gm.id, gm.member_id, gm.meeting_date, gm.start_time, gm.end_time, gm.member_timezone, gm.status, gm.google_meet_link, gm.meeting_title, gm.meeting_notes, gm.reschedule_status, gm.created_at, gm.updated_at, 
           gmp.id AS participant_id, gmp.user_id AS gmp_user_id, gmp.meeting_attended, gmp.remarks, gmp.created_at AS participant_created_at, gmp.updated_at AS participant_updated_at, 
           'participant' AS role
    FROM group_meetings gm
    LEFT JOIN group_meeting_participants gmp ON gm.id = gmp.meeting_id
    WHERE gmp.user_id = :member_id
) AS combined WHERE meeting_date < :currentdate";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId); 
        $stm->bindParam(":status", $status); 
        $stm->bindParam(":currentdate", $Date); 
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    function GetAllCompletedBookingRequests_Member($MemberId){
        
        $status = 'Completed';
        $Date = self::CurrentDate();
                
        $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND (`status` = :status OR `slot_date` < :currentdate AND `status` NOT IN ('Cancelled', 'Rejected', 'Withdrawal'))";
        
        // Get all from bookings by status and other by slotdate
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId);
        $stm->bindParam(":status", $status);
        $stm->bindParam(":currentdate", $Date);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    function GetMyFeedback_Meeting($booking_Id, $user_id){
        
        $sql = "SELECT * FROM `booking_attendees` WHERE `booking_id` = :booking_id AND `user_id` = :user_id";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":booking_id", $booking_Id);
        $stm->bindParam(":user_id", $user_id);
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    function GetParticipantFeedback_Meeting($booking_Id, $user_id){
        
        $sql = "SELECT * FROM `booking_attendees` WHERE `booking_id` = :booking_id AND `user_id` != :user_id";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":booking_id", $booking_Id);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    function GetAllCancelledRejectedBookingRequests_Member($MemberId){
        
        $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) AND (`status` = '".self::BOOKING_CANCELLED."' OR `status` = '".self::BOOKING_REJECTED."' OR `status` = '".self::BOOKING_WITHDRAWAL."')";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
        
        
    }  //Function Ends
    
    
    //Get Schedule Of Selected Member
    function GetScheduleOfMember($MemberId){
        
        $sql = "SELECT * FROM `availability` WHERE `user_id` = :member_id";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    //Get Schedule Of Selected Member By DAY NAME
    function GetScheduleOfMemberByDay($MemberId, $dayname){
        
        $sql = "SELECT * FROM `availability` WHERE `user_id` = :member_id && `day` = :dayname";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->bindParam(":dayname", $dayname, PDO::PARAM_STR);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    
    //Get Booked N Busy Schedule Of Selected Member By DATE
    function GetBusynBookedScheduleOfMemberByDate($MemberId, $sldate){
        
        $sql = "SELECT * FROM `bookings` WHERE (`member_id` = :member_id OR `user_id` = :member_id) && `slot_date` = :date";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":member_id", $MemberId, PDO::PARAM_INT);
        $stm->bindParam(":date", $sldate);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  //Function Ends
    
    
    
    function CreateGoogleMeeting($meetingTitle, $meetingDescription, $meetingStartTime, $meetingEndTime, $meetingTimeZone, $attendeesEmails) {
            // Ensure access token is set in session
            if (!isset($_SESSION['access_token'])) {
                return 'Access token missing.';
            }
        
            // Get the Google Client
            $client = getClient();
            $client->setAccessToken($_SESSION['access_token']);
        
            // Check if the access token is valid
            if ($client->isAccessTokenExpired()) {
                return 'Access token expired.';
            }
            
            $service = new Google_Service_Calendar($client);
        
            // Prepare the attendees list dynamically
            $attendees = [];
            foreach ($attendeesEmails as $email) {
                $attendees[] = ['email' => $email];
            }
        
            // Create the event
            $event = new Google_Service_Calendar_Event([
                'summary' => $meetingTitle,
                'location' => 'Online',
                'description' => $meetingDescription,
                'start' => [
                    'dateTime' => $meetingStartTime, // Make sure $meetingStartTime is in ISO 8601 format
                    'timeZone' => $meetingTimeZone,
                ],
                'end' => [
                    'dateTime' => $meetingEndTime, // Make sure $meetingEndTime is in ISO 8601 format
                    'timeZone' => $meetingTimeZone,
                ],
                'attendees' => $attendees,
                'conferenceData' => [
                    'createRequest' => [
                        'requestId' => uniqid('wclubmt_'),
                        'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
                    ]
                ],
            ]);
        
            // Insert the event into the user's calendar
            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event, [
                'conferenceDataVersion' => 1,
                'sendUpdates' => 'all',
            ]);
        
            // Get the Google Meet link
            $hangoutLink = $event->getHangoutLink();
        
            return $hangoutLink;
            
        } // Function Ends
    
    
    
    
    
    
    function SendRejectBookingEmailMember ($receiverName, $receiverEmail, $thirdpersonName){
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $receiverEmail,
                "name" => $receiverName 
                )
            );
            
            
        $maildata["subject"] = 'You have Declined a Meeting Request from '.$thirdpersonName;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> You have Declined a Meeting Request from '.$thirdpersonName.' | WAHClub </title>
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
                                
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Hi '.$receiverName.',
							</p>
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;"> You have declined the meeting request from '.$thirdpersonName.' for Mar 20, 2025 at 10:00 PM - 10:30 PM. '.$thirdpersonName.' has been notified.
							</p>
							 
							 
							 
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							    Thanks for keeping your calendar up to date!
							</p> 
							 
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px; margin-bottom: 0px;"> 
							Best Regards,
							<br>
							The WAHClub Team
							</p>
							 
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
                          &#169; '.date('Y').' WAHStory.com</td>
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
	  } //Function Ends
	  
	  
	  function SendRejectBookingEmailUser ($User_name, $User_email, $Member_name){
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $User_email,
                "name" => $User_name 
                )
            );
            
            
        $maildata["subject"] = 'Your Meeting Request with '.$Member_name.' has Declined';
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Meeting Request with '.$Member_name.' Was Declined | WAHClub </title>
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
                                
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Hi '.$User_name.',
							</p>
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;"> Unfortunately, '.$Member_name.' is unavailable at the requested time and has declined your meeting request.
							</p>
							 
							 
							 
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							    You can try to reschedule the meeting by choosing a different slot based on their availability or connect with another professional in <a href="">WAHClub</a>.
							</p>
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							    Go to dashboard: <a href="https://www.wahstory.com/users/member.bookingrequests.php">Reschedule Meeting Now</a>
							</p>
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							    Let us know if you need any help!

							</p>
							 
							 
							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
							Best Regards,
							<br>
							The WAHClub Team
							</p>
							 
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
                          &#169; '.date('Y').' WAHStory.com</td>
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
	  
	  
	  
	  function SendRescheduleRequestToUserEmail ($User_name, $User_email, $Member_name, $MeetingDate, $MeetingStart){
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $User_email,
                "name" => $User_name 
                )
            );
        
        $maildata["subject"] = 'Reschedule Meeting Request from '.$Member_name;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Reschedule Meeting Request from '.$Member_name.' | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$User_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">'.$Member_name.' has requested to <strong>reschedule your meeting</strong> originally set for <strong>'.date('M d, Y ', strtotime($MeetingDate)).' at '.date('h:i A', strtotime($MeetingStart)).'</strong>.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We understand schedules change! You can check their updated availability and pick a new time using the link below:
        							</p>
        							
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: center; font-size: 16px; margin: 20px 0;">
        							    <a href="https://www.wahstory.com/users/" style="background-color: #ec398b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">ðŸ”— Reschedule Meeting</a>
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Thank you for being a part of WAHClub. We hope youre able to connect soon!
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Warm regards,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
    
    
    
	  
	  function SendMeetingRescheduledToMemberEmail ($Member_name, $Member_email, $User_name, $MeetingDateTime){
        
        $slotdatetime = new DateTime($MeetingDateTime);
    	$slotdatetime->modify('+30 minutes'); 
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $Member_email,
                "name" => $Member_name 
                )
            );
        
        $maildata["subject"] = $User_name.' has proposed a new time - Please confirm the rescheduled meeting';
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>'.$User_name.' has proposed a new time — Please confirm the rescheduled meeting | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$Member_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">'.$User_name.' has proposed a new time for your meeting after your reschedule request
        							<br>
        							<strong>Proposed New Meeting Time: </strong> '.date('M d, Y ', strtotime($MeetingDateTime)).' at '.date('h:i A', strtotime($MeetingDateTime)).' to '.$slotdatetime->format('h:i A').'.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Please <strong>confirm</strong> if this new time works for you by clicking the link below:
        							</p>
        							
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: center; font-size: 16px; margin: 20px 0;">
        							    <a href="https://www.wahstory.com/users/member.bookingrequests.php" style="background-color: #ec398b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Confirm Meeting</a>
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">The meeting will only be confirmed once you approve this new time
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Thank you for staying connected through WAHClub!
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Warm regards,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
    
    
    
    
	  function SendCancelMeetingEmail ($Member_name, $Member_email, $User_name, $MeetingDateTime){
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $Member_email,
                "name" => $Member_name 
                )
            );
        
        $maildata["subject"] = 'Meeting has been cancelled by '.$User_name;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Meeting has been cancelled by '.$User_name.' | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$Member_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We regret to inform you that '.$User_name.' has cancelled meeting scheduled for 
        							<br>
        							<strong>'.date('M d, Y ', strtotime($MeetingDateTime)).' at '.date('h:i A', strtotime($MeetingDateTime)).' </strong>.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We understand this can be disappointing. If you would like, you can check their availability and book a new slot anytime:
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Thank you for using WAHClub Calendar.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Warm regards,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }


    
    function SendConfirmMeetingEmailMember ($Member_name, $Member_email, $User_name, $MeetingDateTime, $MeetingLink){ 
        
        $slotdatetime = new DateTime($MeetingDateTime); 
    	$slotdatetime->modify('+30 minutes');
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $Member_email,
                "name" => $Member_name 
                )
            );
        
        $maildata["subject"] = 'Your meeting has been confirmed with '.$User_name;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Your meeting has been confirmed with '.$User_name.' | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$Member_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">You have successfully confirmed your meeting with '.$User_name.'. Here are the details:
        							<br>
        							<strong>Date:</strong> '.date('M d, Y ', strtotime($MeetingDateTime)).'
        							<br>
        							<strong>Time:</strong> '.date('h:i A', strtotime($MeetingDateTime)).' - '.$slotdatetime->format('h:i A').'
        							<br>
        							<strong>Meeting Link:</strong> <a href="'.$MeetingLink.'" target="_blank"> '.$MeetingLink.' </a>
        							
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">'.$User_name.' has been notified, and your meeting is now set. You can view and manage your schedule in your <a href="https://www.wahstory.com/users/member.bookingrequests.php" target="_blank">WAHClub dashboard</a>.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Happy networking!<br>
        							Warm regards,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
	  
	  
	   function SendConfirmMeetingEmailUser ($User_name, $User_email, $Member_name, $MeetingDateTime, $MeetingLink){ 
        
        $slotdatetime = new DateTime($MeetingDateTime); 
    	$slotdatetime->modify('+30 minutes');
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $User_email,
                "name" => $User_name 
                )
            );
        
        $maildata["subject"] = 'Your meeting has been confirmed with '.$Member_name;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Your meeting has been confirmed with '.$Member_name.' | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Hi '.$User_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Good news!
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">'.$Member_name.'. has confirmed your meeting request. Here are the details:
        							<br>
        							<strong>Date:</strong> '.date('M d, Y ', strtotime($MeetingDateTime)).'
        							<br>
        							<strong>Time:</strong> '.date('h:i A', strtotime($MeetingDateTime)).' - '.$slotdatetime->format('h:i A').'
        							<br>
        							<strong>Meeting Link:</strong> <a href="'.$MeetingLink.'" target="_blank"> '.$MeetingLink.' </a>
        							
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">You can also view and manage your bookings in your <a href="https://www.wahstory.com/users/member.bookingrequests.php" target="_blank">WAHClub dashboard</a>.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Looking forward to your productive session!
        							<br>
        							Warm regards,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
	  
	 
	 
    
    function SendGroupMeetingEmailMember ($Member_name, $Member_email, $MeetingDateTime, $meetingTimeZone, $MeetingLink){ 
        
        /*$slotdatetime = new DateTime($MeetingDateTime); 
    	$slotdatetime->modify('+30 minutes');*/
    	
    	$slotdatetime = new DateTime($MeetingDateTime, new DateTimeZone($meetingTimeZone));
        $slotdatetime->modify('+30 minutes');
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $Member_email,
                "name" => $Member_name 
                )
            );
        
        $maildata["subject"] = 'Your group meeting on WAHClub has been successfully set up!';
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Your group meeting on WAHClub has been successfully set up | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Dear '.$Member_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Your group meeting on WAHClub has been successfully set up! Here are the details:
        							<br>
        							<strong>Date:</strong> '.date('M d, Y ', strtotime($MeetingDateTime)).'
        							<br>
        							<strong>Time:</strong> '.date('h:i A', strtotime($MeetingDateTime)).' - '.$slotdatetime->format('h:i A').'
        							<br>
        							<strong>Meeting Link:</strong> <a href="'.$MeetingLink.'" target="_blank"> '.$MeetingLink.' </a>
        							
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">We have notified all meeting participants, and they will receive an invite to join your discussion. <br> <br> <a href="'.$MeetingLink.'" style="background-color: #ec398b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; text-align: center;" target="_blank">Join Meeting</a>.
        							</p>
        							
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Thanks for taking the initiative to host this — we are excited to see what conversations spark from here!
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							Cheers,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
    
    
    function SendGroupMeetingEmailParticipants ($Participant_name, $Participant_email, $Member_name, $MeetingDateTime, $meetingTimeZone, $ParticipantTimeZone, $MeetingLink){ 
        
        /*$slotdatetime = new DateTime($MeetingDateTime); 
    	$slotdatetime->modify('+30 minutes');*/
    	
    	$slotdatetime = new DateTime($MeetingDateTime, new DateTimeZone($meetingTimeZone));
        $slotdatetime->modify('+30 minutes');
    	
    // 	ChangeTimezone
        
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $Participant_email,
                "name" => $Participant_name 
                )
            );
        
        $maildata["subject"] = 'You are Invited to a Group Meet with '.$Member_name;
    
        $maildata['bodymessage'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
         
        <head>
          <meta name="x-apple-disable-message-reformatting" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>You are Invited to a Group Meet with '.$Member_name .' | WAHClub </title>
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
                                        
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Hey '.$Participant_name.',
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;"> You are invited to join a group meeting on <strong>WAHClub</strong>, hosted by <strong>'.$Member_name.'</strong> — someone from your professional circle who is sparked a conversation worth having!
        							</p>
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">Here are the details:
        							<br>
        							<strong>Date:</strong> '.date('M d, Y ', strtotime($MeetingDateTime)).'
        							<br>
        							<strong>Time:</strong> '.date('h:i A', strtotime($MeetingDateTime)).' - '.$slotdatetime->format('h:i A').' (GMT'.$meetingTimeZone.')
        							<br>
        							<strong>Meeting Link:</strong> <a href="'.$MeetingLink.'" target="_blank"> '.$MeetingLink.' </a>
        							
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">This is a space to connect, share insights, and learn from others in your field. Feel free to bring your thoughts, ideas, or just come by to listen in.
        							<br>
        							<a href="'.$MeetingLink.'" style="text-align: center" target="_blank">Join Meeting</a>.
        							</p>
        							 
        							<p style="color: #000; font-family: sans-serif; font-weight: 500; text-align: left; font-size: 16px;">
        							See you there!<br>
        							Warmly,<br>
        							Team WAHClub
        							</p>
        							 
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
    
	         SendMailBySMTP($maildata);
	  }
    
	 
	 
	 function GetWAHClubUsersWithFilter($keyword)
    {
        
        $keyword = "%$keyword%";
        
        $sql = "SELECT DISTINCT users.* FROM users
                WHERE users.subscription_status = 'paid' AND users.id IN (
                    SELECT user_id FROM experiences WHERE role LIKE :keyword
                    UNION
                    SELECT user_id FROM education WHERE degree LIKE :keyword
                )";
                
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":keyword", $keyword);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
	 
	
	function getusertimezonebyclubuserid($userid){
        
        $sql = "SELECT at.*, t.name, t.value, t.id FROM `avalability_timezone` at JOIN `timezones` t ON at.timezone_id = t.id WHERE at.user_id = :clubuserid";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return NULL;
        }
    }
	 
	function CreateOneOnOneMeeting($user_id, $member_id, $slot_date, $start_time, $end_time, $slot_timezone, $status, $google_meet_link, $meeting_notes){
	    
	        $dateobj = new DateTime();
	        $datetime = $dateobj->format('Y-m-d H:i:s');
        		
    		$sql = "INSERT INTO `bookings` (`user_id`, `member_id`, `slot_date`, `start_time`, `end_time`, `slot_timezone`, `status`, `google_meet_link`, `meeting_notes`, `created_at`, `updated_at`) VALUES (:user_id, :member_id, :slot_date, :start_time, :end_time, :slot_timezone, :status, :google_meet_link, :meeting_notes, :created_at, :updated_at)";
    		
    		
    		$stm = $this->SecndopenConn->prepare($sql);
    		$stm->bindParam(":user_id", $user_id);
    		$stm->bindParam(":member_id", $member_id);
    		$stm->bindParam(":slot_date", $slot_date);
    		$stm->bindParam(":start_time", $start_time); 
    		$stm->bindParam(":end_time", $end_time); 
    		$stm->bindParam(":slot_timezone", $slot_timezone); 
    		$stm->bindParam(":status", $status); 
    		$stm->bindParam(":google_meet_link", $google_meet_link); 
    		$stm->bindParam(":meeting_notes", $meeting_notes); 
    		$stm->bindParam(":created_at", $datetime); 
    		$stm->bindParam(":updated_at", $datetime); 
        
        if ($stm->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    
    
    function CheckUserBooking ($userid, $start_time){
        $sql = "SELECT COUNT(*) as count FROM `bookings` WHERE `user_id` = :userid && `start_time` = :start_time";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":userid", $userid);
    	$stm->bindParam(":start_time", $start_time);
    	$stm->execute();
    	$result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
    
    
    function CheckMemberGroupMeeting ($memberid, $start_time){
        $sql = "SELECT COUNT(*) as count FROM `group_meetings` WHERE `member_id` = :memberid && `start_time` = :start_time";
    	$stm = $this->SecndopenConn->prepare($sql);
    	$stm->bindParam(":memberid", $memberid);
    	$stm->bindParam(":start_time", $start_time);
    	$stm->execute();
    	$result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
	 
	 
	function ChangeTimezone($dateTime, $FromTimezone, $ToTimezone){
	    $meetingStartTime = new DateTime($dateTime, new DateTimeZone($FromTimezone));
        $meetingStartTime->setTimezone(new DateTimeZone($ToTimezone));
        $meetingStartTime->format('Y-m-d\TH:i:sP');
        
        $meetingStart_Time = $meetingStartTime->format('Y-m-d H:i:s');
        return $meetingStart_Time;
	}
	
	
	function GetClubUsersByKeywordSearch($memberId, $keyword) {
	    
	   // $keyword = "%$keyword%";
	    
	    $keywords = array_map('trim', explode(',', $keyword));
	    
	    $placeholders = [];
        $params = ['memberId' => $memberId, 'paid' => 'paid'];
        
        foreach ($keywords as $index => $word) {
            $placeholder = ":keyword$index";
            $placeholders[] = $placeholder;
            $params["keyword$index"] = '%' . $word . '%';
        }
	    
	    $expConditions = [];
        $eduConditions = [];
        $titleConditions = [];
        
        foreach ($placeholders as $ph) {
            $expConditions[] = "role LIKE $ph";
            $eduConditions[] = "degree LIKE $ph";
            $titleConditions[] = "title LIKE $ph";
        }
        
        $expWhere = implode(' OR ', $expConditions);
        $eduWhere = implode(' OR ', $eduConditions);
        $titleWhere = implode(' OR ', $titleConditions);
	    
        $sql = "SELECT DISTINCT users.* FROM users
                WHERE users.id != :memberId AND users.subscription_status = 'paid' AND users.id IN (
                    SELECT user_id FROM experiences WHERE $expWhere
                    UNION
                    SELECT user_id FROM education WHERE $eduWhere
                    UNION
                    SELECT user_id FROM stories WHERE $titleWhere
                )";
                
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute($params);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
	    
	}
	
	function GetClubUsersByCategorySearch($memberId, $keywords) {
	    
	   // $keywords = ['Founder', 'Head'];
	    $keywords = explode(', ', $keywords);
	    $placeholders = [];
	    $params = ['memberId' => $memberId];
	    
	    foreach ($keywords as $index => $word) {
            $placeholder = ":keyword$index";
            $placeholders[] = $placeholder;
            $params["keyword$index"] = '%' . $word . '%';
        }
        
        $expConditions = [];
        $eduConditions = [];
        $titleConditions = [];
        
        foreach ($placeholders as $ph) {
            $expConditions[] = "role LIKE $ph";
            $eduConditions[] = "degree LIKE $ph";
            $titleConditions[] = "title LIKE $ph";
        }
        
        $expWhere = implode(' OR ', $expConditions);
        $eduWhere = implode(' OR ', $eduConditions);
        $titleWhere = implode(' OR ', $titleConditions);
                
        $sql = "SELECT DISTINCT users.* FROM users
                WHERE users.id != :memberId AND users.subscription_status = 'paid' AND users.id IN (
                    SELECT user_id FROM experiences WHERE $expWhere
                    UNION
                    SELECT user_id FROM education WHERE $eduWhere
                    UNION
                    SELECT user_id FROM stories WHERE $titleWhere
                )";
                
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute($params);
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
	    
	}
	
	
	
	function CreateGroupMeeting($user_ids, $member_id, $meeting_date, $start_time, $end_time, $member_timezone, $google_meet_link, $meeting_title, $meeting_notes){
	    
	        $dateobj = new DateTime();
	        $datetime = $dateobj->format('Y-m-d H:i:s');
	        
        		$start_time = $meeting_date .' '.$start_time;
        		$end_time = $meeting_date .' '.$end_time;
        		
    		$sql = "INSERT INTO `group_meetings` (`member_id`, `meeting_date`, `start_time`, `end_time`, `member_timezone`, `status`, `google_meet_link`, `meeting_title`, `meeting_notes`, `created_at`, `updated_at`) VALUES (:member_id, :meeting_date, :start_time, :end_time, :member_timezone, :status, :google_meet_link, :meeting_title, :meeting_notes, :created_at, :updated_at)";
    		
    		$status = 'Confirmed';
    		$stm = $this->SecndopenConn->prepare($sql);
    		$stm->bindParam(":member_id", $member_id);
    		$stm->bindParam(":meeting_date", $meeting_date);
    		$stm->bindParam(":start_time", $start_time); 
    		$stm->bindParam(":end_time", $end_time); 
    		$stm->bindParam(":member_timezone", $member_timezone); 
    		$stm->bindParam(":status", $status); 
    		$stm->bindParam(":google_meet_link", $google_meet_link); 
    		$stm->bindParam(":meeting_title", $meeting_title); 
    		$stm->bindParam(":meeting_notes", $meeting_notes); 
    		$stm->bindParam(":created_at", $datetime); 
    		$stm->bindParam(":updated_at", $datetime); 
        
        if ($stm->execute()) {
            $meeting_id = $this->SecndopenConn->lastInsertId();;
            $user_ids  = explode(',', $user_ids);
            foreach($user_ids as $user_id) {
                
                $sql2 = "INSERT INTO `group_meeting_participants` (`meeting_id`, `user_id`, `created_at`, `updated_at`) VALUES (:meeting_id, :user_id, :created_at, :updated_at)";
    		
    		    $stm2 = $this->SecndopenConn->prepare($sql2);
    		    $stm2->bindParam(":meeting_id", $meeting_id);
    		    $stm2->bindParam(":user_id", $user_id);
    		    $stm2->bindParam(":created_at", $datetime); 
    		    $stm2->bindParam(":updated_at", $datetime);
    		    $stm2->execute();
            }
            
            return 'success';
            
            
        }else{
            return 'error';
        }
    }
	
	
	  
	
	  



}


?>

