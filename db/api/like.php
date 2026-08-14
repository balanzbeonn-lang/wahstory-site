<?php

require_once("../postClass.php");
$postObj = new Post();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET": {
            echo json_encode($postObj->getLikes($_REQUEST["id"]));
            break;
        }

    case "POST": {
            return $postObj->like($_REQUEST["id"]);
            break;
        }
}
