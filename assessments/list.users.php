<?php 
    require_once('functions.php');
    $obj = new Assessment();
    $users = $obj->GetAllUsers();
?>
<html>
    <head>
        <title>Users</title>
        <style>
            ul li{
                background: #e4eff7;
                padding: 6px 10px;
                border-radius: 6px;
                display: inline-block;
                margin-bottom: 5px;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <h3>All Users</h3>
    
        <ul>
    <?php foreach($users as $user){ ?>
            <li><a href="report.php?uid=<?=$user['id']?>" target="_blank"><?=$user['full_name']?></a></li>
    <?php } ?>
        </ul>
    </body>
</html>