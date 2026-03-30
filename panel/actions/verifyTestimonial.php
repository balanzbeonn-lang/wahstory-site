<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["id"])) {
    $response = $postObj->verifyTestimonial($_GET["id"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Testimonial Verified Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Verifing Testimonial!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../home.php');
}
