<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("../../db/postClass.php");
$postObj = new Post();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["addQuestions"] =  $postObj->addQA();
    header("Location: ../addQA.php");
}