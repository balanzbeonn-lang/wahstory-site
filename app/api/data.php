<?php 
// app/api/data.php
header('Content-Type: application/json');
$data = array("message" => "Hello, this is data from PHP backend.");
echo json_encode($data);

?>