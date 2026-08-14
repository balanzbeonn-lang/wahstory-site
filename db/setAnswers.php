<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("userClass.php");
$userObj = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["setAnswers"] =  $userObj->setAnswers();
    header("Location: ../user.php");
}