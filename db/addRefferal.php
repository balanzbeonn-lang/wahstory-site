<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("userClass.php");
$userObj = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response =  $userObj->setRefferal();
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Refferal Added Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Refferal Feedback!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header("Location: ../user.php");
}
