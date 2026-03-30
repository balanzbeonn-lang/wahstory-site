<?php
//Admin Panel Password is: admin@!@#$% 

require_once('admin.php');
session_start();
$alert = "";
if (isset($_SESSION["admin_id"]) && isset($_SESSION["admin_pass"])) {
    if ($_SESSION["admin_expire"] > time()) {
        header('Location: home.php');
    } else {
        unset($_SESSION["admin_id"]);
        unset($_SESSION["admin_pass"]);
        header('Location: index.php');
    }
} elseif (isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_pass'])) {
    header('Location: home.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new admin();
    $data = $obj->login();
    if ($data == false) {
        $alert = "<script>
        Swal.fire(
            'Error!',
            'Invalid ID or Password!',
            'warning'
          ) </script>";
    } elseif ($data) {
        if ($_POST["remember"]) {
            setcookie("admin_id",  $data["user"], time() + (86400 * 7), "/"); // 86400 = 1 day
            setcookie("admin_pass", $data["pass"], time() + (86400 * 7), "/"); // 86400 = 1 day
        } else {
            $_SESSION["admin_expire"] = time() + (60 * 60 * 6);
            $_SESSION["admin_id"] = $data["user"];
            $_SESSION["admin_pass"] = $data["pass"];
        }

        $alert = "<script>
        Swal.fire({
            title: 'Log in success',
            text: 'Welcome back!',
            icon: 'success',
            confirmButtonText: 'Get in now'
          }).then((result) => {
            if (result.value) {
                window.location.assign('home');
            }
          })     
       </script>";
    }
}