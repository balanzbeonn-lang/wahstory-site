<?php
if(empty($_GET["id"])){
    header("Location: ../users.php");
}
require_once("../../db/postClass.php");
$obj = new Post;
$_SESSION["varify_post_res"] = $obj->acceptPost($_GET["id"]);
header("Location: ../verify-posts.php"); 
