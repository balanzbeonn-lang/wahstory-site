<?php
require_once("../../db/postClass.php");
$postObj = new Post();
$compaign = $postObj->getCompaign();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($compaign) {
        $responseUpdate  = $postObj->updateCompaign();
    } else {
        $responseAdd  = $postObj->addCompaign();
    }
}


if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Compaign Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Adding Compaign!','',
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
                'Compaign Updated Seccussfully!','',
                'success'
               )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Compaign!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");
?>
