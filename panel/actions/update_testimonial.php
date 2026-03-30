<?php
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response  = $postObj->updateTestimonial();
}

if (isset($response)) {
    switch ($response) {
        case "Success": {
                $msg = "<script>Swal.fire(
                'Testimonial Updated Seccussfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": {
                $msg = "<script>Swal.fire(
                'Error While Updating Testimonial!','',
                'error'
              )</script>";
                break;
            }
    }
    $_SESSION["msg"] = $msg;
}
header("Location: ../home.php");
