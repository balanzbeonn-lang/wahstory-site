<?php
    session_start(); 
    if(!isset($_SESSION['userid']) ||  $_SESSION['email'] ==''){
       echo '<script>window.location.href="/login.php";</script>';
    } 
    include('update/inc/update_availability.php');
    $calendarObj = new CalendarBooking();
    
    
    if(isset($_POST['ADDEXCEPTION'])) {
        $calendarObj->updateExceptions($UserId, $ExceptionsDate);
    }
    ?>