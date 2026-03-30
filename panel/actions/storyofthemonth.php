<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(empty($_GET["id"])){
    header("Location: ../home.php");
}
require_once("../../db/postClass.php");
$obj = new Post;
$_SESSION["storyofthemonth"] = $obj->setstoryofthemonth($_GET["id"]);
header("Location: ../home.php");
