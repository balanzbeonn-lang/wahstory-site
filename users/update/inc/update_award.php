<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class AwdUtility extends BaseClass
{
    
    function updateAward($Prefix, $userid) {
            
        if (empty($_POST[$Prefix . 'title'])) {
            return "ERROR:";
        }

        $awardtitle = $_POST[$Prefix . 'title']; 
        $awardbody = $_POST[$Prefix . 'body']; 
        $awardyear = $_POST[$Prefix . 'year']; 
        $awardDesc1 = $_POST[$Prefix . 'desc1']; 
        $awardDesc2 = $_POST[$Prefix . 'desc2']; 
        
        if(!empty($_FILES[$Prefix . 'file'])) {
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    $awdid = $_POST[$Prefix . 'id'];
                    $row = $this->getawardbyId($awdid);
                    $AwardPhoto = $row['award_photo'];
                    $oldimage = "../../wahclub/public/img/awards/" .  $AwardPhoto;
                    if (file_exists($oldimage)) {
                        unlink($oldimage);
                    } 
                } 
            
            $file = $_FILES[$Prefix . 'file'];

            $filename = $file['name'];
            $fileSize = $file['size'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "../../wahclub/public/img/awards/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            
            $maxFileSize = 200 * 1024; // 200 KB

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $AwardPhoto = $finalImgName;
                }
            }
            
        } else{
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    
                    $awdid = $_POST[$Prefix . 'id'];
                    
                    $row = $this->getawardbyId($awdid);
                    
                    $AwardPhoto = $row['award_photo'];
                    
                } else {
                    $AwardPhoto = NULL;
                }
            
        }
        
          
        
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
        {
            $sql = "UPDATE `awards` SET `award_title` = :awardtitle, `awarding_body` = :awardbody, `year` = :awardyear, `award_photo` = :awardphoto, `whyreceiving` = :whyreceiving, `careerimpact` = :careerimpact WHERE `id` = :awdid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `awards` (`award_title`, `awarding_body`, `year`, `award_photo`, `whyreceiving`, `careerimpact`, `user_id`) VALUES (:awardtitle, :awardbody, :awardyear, :awardphoto, :whyreceiving, :careerimpact, :userid)";
        }

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":awardtitle", $awardtitle);
        $stm->bindParam(":awardbody", $awardbody);
        $stm->bindParam(":awardyear", $awardyear);
        $stm->bindParam(":awardphoto", $AwardPhoto);
        $stm->bindParam(":whyreceiving", $awardDesc1);
        $stm->bindParam(":careerimpact", $awardDesc2);
        
        $stm->bindParam(":userid", $userid);
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') {
            $stm->bindParam(":awdid", $awdid);
        }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserAward($userid){
        
        $result = '';
        
        if (!empty($_POST['awd1title']) && empty($_POST['awd2title'])) {
            $n = 1;
        } elseif (!empty($_POST['awd2title']) && empty($_POST['awd3title'])) {
            $n = 2;
        } elseif (!empty($_POST['awd3title'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $Prefix = "awd" . $i;
            $result = $this->updateAward($Prefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    
    
    function getawardbyId ($awardID) {
        
        $sql = "SELECT * FROM `awards` WHERE `id` = :awardID";
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":awardID", $awardID);
        $stm->execute();
        
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return "ERROR";
        }
        
    }
    
    

}


?>

