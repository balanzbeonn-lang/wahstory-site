<?php

ini_set('display_errors', 1);
    error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');


class Calendar extends BaseClass
{
    
    function getAvailabilityDays($userid)
    {
        $sql = "SELECT * FROM `availability` WHERE `user_id` = :userid";

        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid);
        $stm->execute();

        if ($stm->rowCount()) {
            
            $data = $stm->fetchAll();
            return $data;
        }
        return NULL;
    }
    
    function getCustomAvailabilityDates($userid)
    {
        $sql = "SELECT * FROM `custom_availability` WHERE `user_id` = :userid";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
        return NULL;
    }
    
    
}

?>