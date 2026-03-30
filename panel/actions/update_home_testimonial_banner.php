<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseAdd  = $postObj->updateExtras();
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Image Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Image!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");
