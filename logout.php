<?php
session_start();

/*if(isset($_GET['LogoutStoryTeller'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['id']);
    unset($_SESSION['storyid']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['status']); 
    header('location: login.steller.php');
}*/
 if(isset($_GET['LogoutUser'])){
    unset($_SESSION['expire']);
    unset($_SESSION['userid']);
    unset($_SESSION['email']);
    unset($_SESSION['club_userid']);
    header('location: /login');
}
?>