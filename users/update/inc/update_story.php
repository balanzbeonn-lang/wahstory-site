<?php
    session_start(); 

    include('../../../inc/functions.php');
    $postObj = new Story();
    
    include('storyclass.php');
    $UtilityObj = new StoryUtility();
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    
    
    if(isset($_POST['currentTitle']) && $_POST['currentTitle'] != ''){
        
        
        if(isset($_POST['storycontent']) && $_POST['storycontent'] != ''){
        
            $storycontent = $_POST['storycontent']; 
            
        } elseif(isset($_POST['ques1']) && $_POST['ques1'] != '' && $_POST['ques2'] != '' && $_POST['ques3'] != '' && $_POST['ques4'] != '' && $_POST['ques5'] != ''){
            
            $storycontent = '<p>' . $_POST['ques1'] . '</p> <p> ' . $_POST['ques2'] . '</p> <p> ' . $_POST['ques3'] . '</p> <p> ' . $_POST['ques4'] . '</p> <p> ' . $_POST['ques5'] . '</p>'; 
            
        }
        
        
        $response = $UtilityObj->UpdateUserFullStory($Userrow['ClubId'], $storycontent);
        
        
        header('Content-Type: application/json');

        $response = ['status' => $response, 'message' => 'Successfully Updated!'];
        echo json_encode($response);

    }

?>

