<?php 
require_once("userClass.php");
$userObj = new User;
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_SESSION["updateUserPost"] = $userObj->updatePost($_POST["updateid"]);
        header("Location: ../user.php");
}