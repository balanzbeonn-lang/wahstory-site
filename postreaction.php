<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('inc/functions.php');
    $postObj = new Story();
    
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $storyid = $_POST['storyid'];
    $userid = $_POST['userid'];
    
        if($_POST['action'] == 'react'){
    
            $reaction = $_POST['reaction'];
            
            $response = $postObj->Updatestoryreaction($storyid, $userid, $reaction);
            $response = array(
                    'storyid' => $storyid,
                    'userid' => $userid,
                    'reaction' => $reaction,
                );
            header('Content-Type: application/json');
                echo json_encode($response);
        
        
        }elseif($_POST['action'] == 'save'){
            
            $response = $postObj->Updatestorysaves($storyid, $userid);
            $response = array(
                    'storyid' => $storyid,
                    'userid' => $userid,
                );
            header('Content-Type: application/json');
                echo json_encode($response);
        }
        
    }else{
        http_response_code(403); // Forbidden
    }


?>