<?php
require_once("../postClass.php");
$postObj = new Post();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET": {
            echo json_encode($postObj->getReviews($_REQUEST["id"]));
            break;
        }

    case "POST": {
            return $postObj->setReview($_REQUEST["id"],$_REQUEST["review"],$_REQUEST["name"],$_REQUEST["email"],$_REQUEST["fbId"]);
            break;
        }
}
