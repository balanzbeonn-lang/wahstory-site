<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["id"])) {
    $response = $postObj->delTeam($_GET["id"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Team Member Deleted Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Deleting Team Member!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../home.php');
}
