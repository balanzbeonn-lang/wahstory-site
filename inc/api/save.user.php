<?php
require_once(__DIR__ . '/../conn.php');

$obj = new connection();
$conn = $obj->openConnection();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');




    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $datetime = date('Y-m-d H:i');
    
    $sql = "INSERT INTO `users` (`name`, `email`, `phone`, `created_at`) VALUES (:name, :email, :phone, :datetime)";
    
    $stm = $conn->prepare($sql);
    
    $stm->bindParam(':name', $name);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':phone', $phone);
    $stm->bindParam(':datetime', $datetime);
    
    $stm->execute();
    
    if($stm->rowCount()) {
        
        echo json_encode(['success' => true, 'message' => 'Record Inserted Successfully!']);
        exit;
    }else{
        echo json_encode(['success' => false, 'message' => 'Something went wrong!']);
        exit;
    }
    
?>