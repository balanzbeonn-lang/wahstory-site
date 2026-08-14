<?php
require_once("userClass.php");
$userObj = new User();
$testimoial = $userObj->getUserTestimonial();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($testimoial){
        $responseUpdate =  $userObj->updateTestimonial();
    }else{
        $responseAdd =  $userObj->addTestimonial();
    }
    switch ($responseAdd) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Testimonial Added Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Adding Testimonial!','',
                    'error'
                  )</script>";
                break;
            }
    }

    switch ($responseUpdate) {
        case "Success": {
                $_SESSION["msg"] = "<script>Swal.fire(    
                    'Testimonial Updated Seccussfully!','',
                    'success'
                    )</script>";
                break;
            }

        case "Error": {
                $_SESSION["msg"] = "<script>Swal.fire(
                    'Error While Updating Testimonial!','',
                    'error'
                  )</script>";
                break;
            }
    }
    header("Location: ../user.php");
}
