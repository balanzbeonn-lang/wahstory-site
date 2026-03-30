<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseAdd  = $postObj->setGenesis();
}

if (isset($responseAdd)) {
    switch ($responseAdd) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Genesis Added Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Adding Genesis!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../genesis.php");
