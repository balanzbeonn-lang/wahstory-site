<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class ProjUtility extends BaseClass
{
    
    function updateProject($Prefix, $userid) {
            
        if (empty($_POST[$Prefix . 'name'])) {
            return "ERROR:";
        }

        $projectname = $_POST[$Prefix . 'name']; 
        $projectlink = $_POST[$Prefix . 'link'];
        $projectObjective = $_POST[$Prefix . 'Objective'];
        $projectRole = $_POST[$Prefix . 'Role'];
        $projectOutcome = $_POST[$Prefix . 'Outcome'];
        
        
        if(!empty($_FILES[$Prefix . 'file'])) {
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    $projid = $_POST[$Prefix . 'id'];
                    $row = $this->getprojectbyId($projid);
                    $ProjectPhoto = $row['project_photo'];
                    $oldimage = "../../wahclub/public/img/projects/" .  $ProjectPhoto;
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

            $fileDest = "../../wahclub/public/img/projects/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            
            $maxFileSize = 200 * 1024; // 200 KB

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $ProjectPhoto = $finalImgName;
                }
            }
            
        } else{
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    
                    $projid = $_POST[$Prefix . 'id'];
                    
                    $row = $this->getprojectbyId($projid);
                    
                    $ProjectPhoto = $row['project_photo'];
                    
                     
                    
                    
                    
                } else {
                    $ProjectPhoto = NULL;
                }
            
        }
        
          
        
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
        {
            $sql = "UPDATE `projects` SET `project_name` = :projectname, `project_photo` = :ProjectPhoto, `project_link` = :projectlink, `project_objective` = :projectObjective, `project_role` = :projectRole, `project_outcome` = :projectOutcome WHERE `id` = :projid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `projects` (`project_name`, `project_photo`, `project_link`, `project_objective`, `project_role`, `project_outcome`, `user_id`) VALUES (:projectname, :ProjectPhoto, :projectlink, :projectObjective, :projectRole, :projectOutcome, :userid)";
        }

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":projectname", $projectname);
        $stm->bindParam(":ProjectPhoto", $ProjectPhoto);
        $stm->bindParam(":projectlink", $projectlink);
        $stm->bindParam(":projectObjective", $projectObjective);
        $stm->bindParam(":projectRole", $projectRole);
        $stm->bindParam(":projectOutcome", $projectOutcome); 
        $stm->bindParam(":userid", $userid);
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') {
            $stm->bindParam(":projid", $projid);
        }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserProject($userid){
        
        $result = '';
        
        if (!empty($_POST['proj1name']) && empty($_POST['proj2name'])) {
            $n = 1;
        } elseif (!empty($_POST['proj2name']) && empty($_POST['proj3name'])) {
            $n = 2;
        } elseif (!empty($_POST['proj3name'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $Prefix = "project" . $i;
            $result = $this->updateProject($Prefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    
    
    function getprojectbyId ($projectID) {
        
        $sql = "SELECT * FROM `projects` WHERE `id` = :projectID";
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":projectID", $projectID);
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

