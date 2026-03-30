<?php
require_once("../db/postClass.php");
$postObj = new Post();

$storedSlugs = $postObj->GetAllNFCCardUrls();
        

/*for($i = 1; $i < 201; $i++) {
    $NFCurl = $postObj->createNFCSlug($storedSlugs);
    echo $NFCurl.'<br>';
}*/

?>