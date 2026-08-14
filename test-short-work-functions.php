<?php 
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
  
    include('inc/functions.php');
    $postObj = new Story(); 
    
    
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Month Picker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
    <?php
    
    
    // $ClubUsers = $postObj->GetWAHClubAllUsers();
    
    // foreach($ClubUsers as $ClubUser){
    
    // $resp = $postObj->ChangePasswordBulk($ClubUser['email']);
    // echo $ClubUser['email'] . '<br>';
    // echo $resp . '<br><br>';
    
    // }
    ?>
    
    <table border="1" class="table">
    
    <?php 
    
    // $preUsers = $postObj->GetWAHClubAllUsers();
        // foreach($preUsers as $preUser){
        //     echo "<tr> <td>". $preUser['firstname'] ." " . $preUser['lastname'] ." </td></tr>";
            
        //     $resp = $postObj->PushClubPreUserInWAHClub($ClubUser['email']);
        //     echo "<tr> <td> ". $resp ." </td></tr> ";
            
        // }
        
    ?>
    
    </table>
    
</body>
</html>
