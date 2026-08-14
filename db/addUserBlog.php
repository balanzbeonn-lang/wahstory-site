<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("userClass.php");
$obj = new User;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["addBlog"] = $obj->addBlog();
    header("Location: ../user.php");
}