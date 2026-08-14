<?php
session_start();
include __DIR__ . '/inc/update_profile.php';
$UtilityObj = new UserUtility();

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

    if (array_key_exists('savequickprofile', $data)) {
        
         $resp = $UtilityObj->UpdateQuickProfile($_SESSION['userid'], $data['gender'], $data['starsign'], $data['city'], $data['country']);
         if($resp == 'SUCCESS') {
             echo json_encode(['status' => 'success', 'message' => 'Profile Updated', 'rurl' => '/users/update/update.quicks.php?UpdateInterest']);
         } else {
             echo json_encode(['status' => 'error', 'message' => 'Error while updating profile, try again.']);
         }
        
    }
    if (array_key_exists('saveYourInterest', $data)) {
        $Userrow = $UtilityObj->getUserDetailsById($_SESSION['userid']); 
        $resp = $UtilityObj->UpdateHobbies($Userrow['ClubId'], $data['Hobbies[]']);
        if($resp == 'SUCCESS') {
             echo json_encode(['status' => 'success', 'message' => 'Interest Updated', 'rurl' => '/users/update/update.quicks.php?UpdateQuickProfile']);
         } else {
             echo json_encode(['status' => 'error', 'message' => 'Error while updating interest, try again.'.$data['Hobbies'].'yes'.$Userrow['ClubId']]);
         }
        
    }

?>