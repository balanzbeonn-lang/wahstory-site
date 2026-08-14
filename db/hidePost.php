<?php
if (empty($_GET["id"])) {
    header("Location: ../user.php");
}
require_once("userClass.php");
$userObj = new User;

$_SESSION["hidePost"] = $userObj->hidePost($_GET["id"]);
header("Location: ../user.php");
