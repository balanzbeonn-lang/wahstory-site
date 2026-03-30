<?php
if(empty($_GET["id"])){
    header("Location: ../users.php");
}
require_once("../../db/postClass.php");
$obj = new Post;
$_SESSION["response_user"] = $obj->unverifyUser($_GET["id"]);
header("Location: ../users.php");
