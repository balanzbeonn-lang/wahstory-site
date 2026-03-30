<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseAdd  = $postObj->updateLivesession();
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Livesession Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Livesession!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../livesession");