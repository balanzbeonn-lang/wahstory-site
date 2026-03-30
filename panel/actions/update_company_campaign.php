<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response  = $postObj->updateCompanyCampaign();
}

if (isset($response)) {
    switch ($response) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Company Compaign Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Company Compaign!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");
