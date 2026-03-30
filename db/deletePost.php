<?php
if (empty($_GET["id"])) {
    header("Location: ../user.php");
}
require_once("userClass.php");
$userObj = new User;

$_SESSION["deletePost"] = $userObj->deletePost($_GET["id"]);
header("Location: ../user.php");
