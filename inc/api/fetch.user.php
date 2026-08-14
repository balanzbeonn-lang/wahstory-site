<?php
require_once(__DIR__ . '/../conn.php');

$obj = new Secondaryconnection();
$conn = $obj->SecondaryopenConnection();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

    $useremail = $_POST['email'];

// Start measuring time
    $start_time = microtime(true);


    $sql = "select firstname, lastname, photo, email from users limit 10";
    
    $stm = $conn->prepare($sql);
    $stm->execute();
    if ($stm->rowCount()) {
        $data = $stm->fetchAll();
        
         // End measuring time
    $end_time = microtime(true);

    // Calculate duration in seconds
    $execution_time = $end_time - $start_time;

    // Output execution time
    // echo "Query executed in: " .  . " seconds<br>";
    $time = number_format($execution_time, 6);


        echo json_encode(['success' => true, 'users' => $data, 'message' => 'Record Found!' . $time ]);
        exit;
    }else{
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Record Not Found!']);
        exit;
    }
     
    
?>