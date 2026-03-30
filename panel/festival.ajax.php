<?php 
require_once("../db/postClass.php");
$postObj = new Post();
    
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $rowId = $_POST['RowId'];
    
    $rows = $postObj->getFestivalById($rowId);
    
    $day = date("l", strtotime($rows['date']));
    $date = date("d", strtotime($rows['date']));
    $month = date("M", strtotime($rows['date']));
    
    $response = array(
            'day' => $day,
            'date' => $date,
            'month' => $month,
            'title' => $rows['title'],
            'descp' => $rows['description'],
            'imagelink' => $rows['imagelink']
        );
    header('Content-Type: application/json');
        echo json_encode($response);
        
    }else{
        http_response_code(403); // Forbidden
    }


?>