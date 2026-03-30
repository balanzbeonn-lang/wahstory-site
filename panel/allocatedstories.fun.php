<?php
require_once("../db/postClass.php");
$postObj = new Post();

$selectedStoryIds = $_POST['selectedRowsData'];
$JurygroupId = $_POST['Jurygroup'];

$response = $postObj->UpdateJuryGroupById($JurygroupId, $selectedStoryIds);

if ($response == 'Success') {
        echo "Success";
    } else {
        echo "Error: ";
    }
 
?>
