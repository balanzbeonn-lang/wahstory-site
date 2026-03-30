<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseAdd  = $postObj->addCompanyCampaign();
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Company Compaign Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Adding Company Compaign!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");
