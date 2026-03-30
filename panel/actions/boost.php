<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(empty($_GET["id"]) || empty($_GET["section"])){
    header("Location: ../home.php");
}
require_once("../../db/postClass.php");
$obj = new Post;
$_SESSION["boost"] = $obj->boostPost($_GET["id"],$_GET["section"]);
header("Location: ../home.php");
