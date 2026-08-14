<?php
   session_start();
   session_unset();
   
   $_SESSION['FBID'] = NULL;
   $_SESSION['FULLNAME'] = NULL;
   $_SESSION['EMAIL'] =  NULL;
   
unset($_SESSION["email"]);
unset($_SESSION["pass"]);
setcookie("email","", time() - 100, "/"); // 86400 = 1 day
setcookie("pass","", time() - 100, "/"); // 86400 = 1 day
$_SESSION["logout"] = "Success";
header("Location: ../index.php");
