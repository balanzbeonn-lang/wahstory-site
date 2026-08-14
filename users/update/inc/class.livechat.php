<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class ChatUtility extends BaseClass
{   
    function GetWAHClubUserById($userid)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = :userid";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function getMember_Followers($memberid)
    {
        
         $sql = "SELECT u.id, u.title, u.firstname, u.lastname, u.slug_username, u.photo FROM users u JOIN connections c ON c.user_id_1 = u.id WHERE c.user_id_2 = :memberid AND c.status = 1";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":memberid", $memberid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }
    
    function getMember_Following($memberid)
    {
        
         $sql = "SELECT u.id, u.title, u.firstname, u.lastname, u.slug_username, u.photo FROM users u JOIN connections c ON c.user_id_2 = u.id WHERE c.user_id_1 = :memberid AND c.status = 1";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":memberid", $memberid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }
       
    

}


?>

