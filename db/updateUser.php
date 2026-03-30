<?php 
require_once("userClass.php");
$obj = new User;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["updateUser"] = $obj->updateUser();
    header("Location: ../user.php");
}