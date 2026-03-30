<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = $postObj->updateYoutubeVideos();
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Videos Updated Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Updating Video!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header("Location: ../home.php");
}
