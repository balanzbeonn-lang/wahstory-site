<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["delId"])) {
    $response = $postObj->delYoutubeVid($_GET["delId"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Videos Deleted Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Deleting Video!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../home.php');
}
