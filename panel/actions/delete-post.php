<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["id"])) {
    $response = $postObj->delPostAction($_GET["id"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Post Deleted Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Deleting Post!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../verify-posts');
}
