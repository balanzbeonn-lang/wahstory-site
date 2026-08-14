<?php 
require_once("../inc/functions.php");
    $postObj = new Story();
    
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $rowId = $_POST['publicId'];
    
    $rows = $postObj->getContentSuggestionById($rowId);
    $response = array(
/*            'platform' => $rows['platform'],
            'title' => $rows['title'],
            'caption' => $rows['caption'],
            'scheduletime' => $rows['scheduletime'],
            'img' => $rows['img']*/
        );
    header('Content-Type: application/json');
        echo json_encode($response);
        
    }else{
        http_response_code(403); // Forbidden
    }


?>