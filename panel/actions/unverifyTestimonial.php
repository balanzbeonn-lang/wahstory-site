<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if (isset($_GET["id"])) {
    $response = $postObj->unverifyTestimonial($_GET["id"]);
    switch ($response) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Testimonial Un-Verified Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Un-Verifing Testimonial!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header('Location: ../home.php');
}
