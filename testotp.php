<?php
session_start();
if(!empty($_SESSION['wahclub'])) {
    
echo $_SESSION['wahclub']['Mailotp'];
}
?>