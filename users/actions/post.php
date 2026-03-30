<?php

    include('../update/inc/update_availability.php');
    $calendarObj = new CalendarBooking();
    
// Read the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);
 

    if(isset($data['getcustomavailabilitybydate'])) {
        
         // Extract userid and date from the request
        $userid = $data['userid'];
        $date = $data['date'];
        
        // Assuming $obj is an object with a method to check availability
        $availability = $calendarObj->GetCustomAvalibility($userid, $date);
        
        if($availability !== NULL) {
            // Return a JSON response
            echo json_encode([
                'success' => true, // Indicating if the request was successful
                'availability' => [
                    'starttime' => $availability['start_time'], // Example start time
                    'endtime' => $availability['end_time'] // Example end time
                ]
            ]); 
        } else {
            // Return a JSON response
            echo json_encode([
                'success' => false
            ]); 
        }
        
    }    


    if(isset($data['getavailabilitybydayname'])) {
        
         // Extract userid and date from the request
        $userid = $data['userid'];
        $weekdayname = $data['weekdayname'];
        
        // Assuming $obj is an object with a method to check availability
        $availability = $calendarObj->GetAvalibilitybyDay($userid, $weekdayname);
        
        if($availability !== NULL) {
            // Return a JSON response
            echo json_encode([
                'success' => true, // Indicating if the request was successful
                'availability' => [
                    'starttime' => $availability['start_time'], // Example start time
                    'endtime' => $availability['end_time'] // Example end time
                ]
            ]); 
        } else {
            // Return a JSON response
            echo json_encode([
                'success' => false
            ]); 
        }
        
    }    

    if(isset($data['getexceptionbydate'])) {
        
         // Extract userid and date from the request
        $userid = $data['userid'];
        $date = $data['date'];
        
        // Assuming $obj is an object with a method to check availability
        $exp = $calendarObj->GetExceptionsByUsernDate($userid, $date);
        
        if($exp !== NULL) {
            // Return a JSON response
            echo json_encode([
                'success' => true
            ]); 
        } else {
            // Return a JSON response
            echo json_encode([
                'success' => false
            ]); 
        }
        
    }    


   
    


?>
