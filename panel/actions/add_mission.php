<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseAdd  = $postObj->setMission();
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Mission Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Adding Mission!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../mission");
