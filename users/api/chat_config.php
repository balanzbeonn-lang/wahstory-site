<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'appID' => "272359da4828a957",
    'appRegion' => "in",
    'authKey' => "002b7e3a6f02cc7ed8a8edafd44440267c7b9552",
    'widgetID' => "9d86a033-951d-42af-ae10-27b645aca8d2"
]);

?>