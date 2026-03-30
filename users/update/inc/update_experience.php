<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class ExpUtility extends BaseClass
{
    
    function updateExperience($expPrefix, $userid) {
            
        if (empty($_POST[$expPrefix . 'company']) || empty($_POST[$expPrefix . 'role']) || empty($_POST[$expPrefix . 'start-month']) || empty($_POST[$expPrefix . 'start-year'])) {
            return "ERROR: Missing required fields for $expPrefix.";
        }

        $companyname = $_POST[$expPrefix . 'company'];
        $role = $_POST[$expPrefix . 'role'];
        $description = $_POST[$expPrefix . 'desc'];
        
        $StartMonth = sprintf('%02d', $_POST[$expPrefix . 'start-month']);
        $StartYear = $_POST[$expPrefix . 'start-year'];
        $durationfrom = "{$StartYear}-{$StartMonth}-01";

        if ($_POST[$expPrefix . 'currentworking'] == 1) {
            $present = "yes";
            $durationto = NULL;
        } else {
            $present = NULL;
            $EndMonth = sprintf('%02d', $_POST[$expPrefix . 'end-month']);
            $EndYear = $_POST[$expPrefix . 'end-year'];
            $durationto = "{$EndYear}-{$EndMonth}-01";
            
        }

        $expid = $_POST[$expPrefix . 'id'];
        
        if(isset($_POST[$expPrefix . 'id']) && $_POST[$expPrefix . 'id'] != '') 
        {
            $sql = "UPDATE `experiences` SET `company_name` = :companyname, `role` = :role, `durationfrom` = :durationfrom, `durationto` = :durationto, `present` = :present, `description` = :description WHERE `id` = :expid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `experiences` (`company_name`, `role`, `durationfrom`, `durationto`, `present`, `description`, `user_id`) VALUES (:companyname, :role, :durationfrom, :durationto, :present, :description, :userid)";
        }
        

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":companyname", $companyname);
        $stm->bindParam(":role", $role);
        $stm->bindParam(":durationfrom", $durationfrom);
        $stm->bindParam(":durationto", $durationto);
        $stm->bindParam(":present", $present);
        $stm->bindParam(":description", $description);
        $stm->bindParam(":userid", $userid);
        
    if(isset($_POST[$expPrefix . 'id']) && $_POST[$expPrefix . 'id'] != '') {
        $stm->bindParam(":expid", $expid);
    }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserExperience($userid){
        
        $result = '';
        
        if (!empty($_POST['exp1company']) && empty($_POST['exp2company'])) {
            $n = 1;
        } elseif (!empty($_POST['exp2company']) && empty($_POST['exp3company'])) {
            $n = 2;
        } elseif (!empty($_POST['exp3company'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $expPrefix = "exp" . $i;
            $result = $this->updateExperience($expPrefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    

}


?>

