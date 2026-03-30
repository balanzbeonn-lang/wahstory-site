<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(empty($_GET["id"])){
    header("Location: ../addQA.php");    
}
require_once("../../db/postClass.php");
$postObj = new Post();
$_SESSION["delQuestions"] =  $postObj->delQA($_GET["id"]);
header("Location: ../addQA.php");
