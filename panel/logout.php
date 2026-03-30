<?php
session_start();
unset($_SESSION["admin_id"]);
unset($_SESSION["admin_pass"]);
setcookie("admin_id", "", time() - 100, "/"); // 86400 = 1 day
setcookie("admin_pass", "", time() - 100, "/"); // 86400 = 1 day
if (isset($_SESSION["session_expire"])) {
    header("Location: index");
} else {
    $_SESSION["logout"] = "Success";
    header("Location: index");
}
