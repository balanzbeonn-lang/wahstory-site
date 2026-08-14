<?php
    include('update/inc/meeting_bookings.php');
    $UtilityObj = new MeetingBookingUtility();
    
    if(isset($_POST['GETAVAILABLEDATES']) && !empty($_POST['member_id'])) {
         
       $mData = $UtilityObj->GetScheduleOfMember($_POST['member_id']);
       if($mData !== NULL) {
            
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
        
         header('Content-Type: application/json');
         echo json_encode($dateOptions);
         
       } else {
           echo json_encode([]);
       }
         
    } // Ends isset
    
    


    if(isset($_POST['GETAVAILABLESLOTS']) && !empty($_POST['reqid']) && !empty($_POST['dayname'])) {
         
         $dayName = date('l', strtotime($_POST['dayname']));
         
         $bkRow = $UtilityObj->GetBookingDetailsById($_POST['reqid']);
         
        if($bkRow != FALSE) {
             
            $availableRow = $UtilityObj->GetScheduleOfMemberByDay($bkRow['member_id'], $dayName);  
             
            $busyRow = $UtilityObj->GetBusynBookedScheduleOfMemberByDate($bkRow['member_id'], $_POST['dayname']);  
            
            $response = [
                'available' => ($availableRow != NULL) ? $availableRow : [],
                'busy' => ($busyRow != NULL) ? $busyRow : []
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
             
        } else {
            echo json_encode(['available' => [], 'busy' => []]);
        }
         
      
      
    } // Ends isset
    
    if(isset($_POST['GETUNAVAILABLETIMESLOTS']) && !empty($_POST['membid']) && !empty($_POST['dayname'])) {
         
        $row = $UtilityObj->GetBusynBookedScheduleOfMemberByDate($_POST['membid'], $_POST['dayname']);  
        if($row != NULL) {
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
           echo json_encode([]);
        }
      
    } // Ends isset

?>