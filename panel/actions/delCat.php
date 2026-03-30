<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET['id'])) {
    $responseAdd  = $postObj->delCat($_GET['id']);
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Category Deleted Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Deleting Category!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../add_category");
