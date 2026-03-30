<?php
require_once("userClass.php");
$userObj = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response =  $userObj->setFeedback();
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Feedback Added Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Adding Feedback!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header("Location: ../user.php");
}
