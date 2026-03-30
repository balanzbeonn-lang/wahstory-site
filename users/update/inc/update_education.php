<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class EduUtility extends BaseClass
{
    
    function updateEducation($Prefix, $userid) {
            
        if (empty($_POST[$Prefix . 'course']) || empty($_POST[$Prefix . 'university']) || empty($_POST[$Prefix . 'start-month']) || empty($_POST[$Prefix . 'start-year'])) {
            return "ERROR: Missing required fields for $Prefix.";
        }

        $coursename = $_POST[$Prefix . 'course'];
        $university = $_POST[$Prefix . 'university'];
        
        $StartMonth = sprintf('%02d', $_POST[$Prefix . 'start-month']);
        $StartYear = $_POST[$Prefix . 'start-year'];
        $durationfrom = "{$StartYear}-{$StartMonth}";

        if ($_POST[$Prefix . 'currentworking'] == 1) {
            $present = "yes";
            $durationto = NULL;
        } else {
            $EndMonth = sprintf('%02d', $_POST[$Prefix . 'end-month']);
            $EndYear = $_POST[$Prefix . 'end-year'];
            $durationto = "{$EndYear}-{$EndMonth}";
            $present = NULL;
        }

        $eduid = $_POST[$Prefix . 'id'];
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
        {
            $sql = "UPDATE `education` SET `institution_name` = :university, `degree` = :coursename, `yearfrom` = :durationfrom, `yearto` = :durationto, `present` = :present WHERE `id` = :eduid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `education` (`institution_name`, `degree`, `yearfrom`, `yearto`, `present`, `user_id`) VALUES (:university, :coursename, :durationfrom, :durationto, :present, :userid)";
        }
        

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":coursename", $coursename);
        $stm->bindParam(":university", $university);
        $stm->bindParam(":durationfrom", $durationfrom);
        $stm->bindParam(":durationto", $durationto);
        $stm->bindParam(":present", $present); 
        $stm->bindParam(":userid", $userid);
        
    if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') {
        $stm->bindParam(":eduid", $eduid);
    }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserEducation($userid){
        
        $result = '';
        
        if (!empty($_POST['edu1university']) && empty($_POST['edu2university'])) {
            $n = 1;
        } elseif (!empty($_POST['edu2university']) && empty($_POST['edu3university'])) {
            $n = 2;
        } elseif (!empty($_POST['edu3university'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $Prefix = "edu" . $i;
            $result = $this->updateEducation($Prefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    

}


?>

