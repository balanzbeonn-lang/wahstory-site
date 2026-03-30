<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["id"])) {
    $response = $postObj->delCompanyCampaign($_GET["id"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Company Campaign Deleted Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Deleting Company Campaign!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../home.php');
}
