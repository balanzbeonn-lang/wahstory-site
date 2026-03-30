<?php
require_once("../../db/postClass.php");
$postObj = new Post();
$post = $postObj->getStoryofMonth();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($post) {
        $responseUpdate = $postObj->updateStoryOfMonth();
    } else {
        $responseAdd  = $postObj->addStoryOfMonth();
    }
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Story of the Month Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Adding Story of the Month!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
if (isset($responseUpdate)) {
    switch ($responseUpdate) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Story of the Month Updated Seccussfully!','',
                'success'
               )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Story of the Month!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");