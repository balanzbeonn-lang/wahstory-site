<?php
if(empty($_GET["id"] || empty($_GET["section"]))){
    header("Location: ../home.php");
}
require_once("../../db/postClass.php");
$obj = new Post;
$_SESSION["unboost"] = $obj->unboostPost($_GET["id"],$_GET["section"]);
header("Location: ../home.php");
