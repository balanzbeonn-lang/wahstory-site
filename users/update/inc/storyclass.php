<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class StoryUtility extends BaseClass
{
    
    function UpdateUserFullStory($userid, $storycontent) {
            
        if (empty($storycontent) || empty($_POST['currentTitle'])) {
            return "error";
        } 

        $storytitle = $_POST['currentTitle']; 
        
        if(isset($_POST['storyid']) && $_POST['storyid'] != '') 
        {
            $storyid = $_POST['storyid'];
            
            $sql = "UPDATE `stories` SET `title` = :storytitle, `storycontent` = :storycontent WHERE `id` = :storyid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `stories` (`title`, `storycontent`, `user_id`, `created_at`, `updated_at`) VALUES (:storytitle, :storycontent, :userid, :createdAt, :updatedAt)";
        }
        
        $datetime = date('Y-m-d H:i:s');

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":storytitle", $storytitle);
        $stm->bindParam(":storycontent", $storycontent);
        $stm->bindParam(":userid", $userid);
        
        if(isset($_POST['storyid']) && $_POST['storyid'] != '') {
            $stm->bindParam(":storyid", $storyid);
        } else {
            
            $stm->bindParam(":createdAt", $datetime);
            $stm->bindParam(":updatedAt", $datetime);
        }
        
        if ($stm->execute()) {
            return "success";
        } else {
            return "error";
        }
    }
    
    
}


?>

