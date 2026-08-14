<?php
session_start(); 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('update/inc/update_availability.php');
    $postObj = new CalendarBooking();
    
    if(isset($_SESSION['userid']) and $_SESSION['email']!=''){
        
    }else{ 
        header('location: /login.php');
    }
    
 
    // Check if data was sent via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $inputData = file_get_contents('php://input');
        
        $data = json_decode($inputData, true);
        
        if (isset($data['user_id']) && isset($data['availabilityData'])) {
            $userid = $data['user_id'];
            $availabilityData = $data['availabilityData']; 
    
            $postObj->updateAvailability($userid, $availabilityData);
    
            echo json_encode(['status' => 'success', 'message' => 'Availability updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data received']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }

?>