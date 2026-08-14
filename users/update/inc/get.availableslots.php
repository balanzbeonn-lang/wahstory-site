<?php
// include('meeting_bookings.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/users/update/inc/meeting_bookings.php');
    $UtilityObj = new MeetingBookingUtility();
    
    if(isset($_POST['GETAVAILABLEDATES']) && !empty($_POST['member_id'])) {
         
       $mData = $UtilityObj->GetScheduleOfMember(251);
       foreach($mData as $Data) {
           $availableDays[] = $Data['day'];
       }
       $startDate = new DateTime(); 
        
         $dateOptions = [];
         
        for($i = 1; $i < 15; $i++) {
           
           $dayname = $startDate->format('l');
           
               if(in_array($dayname, $availableDays))
               {
                   $dateOptions[] = [
                        'value' => $startDate->format('Y-m-d'),
                        'label' => $startDate->format('M d, Y')
                    ];
               }
               $startDate->modify('+1 day');
           }
        
         echo json_encode($dateOptions);
         
    } // Ends isset

?>