<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class TestimonialUtility extends BaseClass
{
    
    function updateTestimonial($Prefix, $userid) {
            
        if (empty($_POST[$Prefix . 'name'])) {
            return "ERROR:";
        }

        $testimonialName = $_POST[$Prefix . 'name']; 
        $testimonialdesignation = $_POST[$Prefix . 'designation']; 
        $testimonialcompany = $_POST[$Prefix . 'company']; 
        $testimonialcontent = $_POST[$Prefix . 'content']; 
        
        if(!empty($_FILES[$Prefix . 'file'])) {
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    $testimonialid = $_POST[$Prefix . 'id'];
                    $row = $this->gettestimonialbyId($testimonialid);
                    $testimonialPhoto = $row['client_photo'];
                    $oldimage = "../../wahclub/public/img/testimonials/" .  $testimonialPhoto;
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

            $fileDest = "../../wahclub/public/img/testimonials/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            
            $maxFileSize = 200 * 1024; // 200 KB

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $testimonialPhoto = $finalImgName;
                }
            }
            
        } else{
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    
                    $testimonialid = $_POST[$Prefix . 'id'];
                    
                    $row = $this->gettestimonialbyId($testimonialid);
                    
                    $testimonialPhoto = $row['client_photo'];
                    
                } else {
                    $testimonialPhoto = NULL;
                }
            
        }
        
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
        {
            $sql = "UPDATE `testimonials` SET `client_name` = :clientname, `client_position` = :clientdesignation, `client_company` = :clientcompany, `client_review` = :clientreview, `client_photo` = :clientphoto WHERE `id` = :testimonialid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `testimonials` (`client_name`, `client_position`, `client_company`, `client_review`, `client_photo`, `user_id`) VALUES (:clientname, :clientdesignation, :clientcompany, :clientreview, :clientphoto, :userid)";
        }

        $stm = $this->SecndopenConn->prepare($sql);
 
        $stm->bindParam(":clientname", $testimonialName);
        $stm->bindParam(":clientdesignation", $testimonialdesignation);
        $stm->bindParam(":clientcompany", $testimonialcompany);
        $stm->bindParam(":clientreview", $testimonialcontent);
        $stm->bindParam(":clientphoto", $testimonialPhoto);
        $stm->bindParam(":userid", $userid);
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') {
            $stm->bindParam(":testimonialid", $testimonialid);
        }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserTestimonial($userid){
        
        $result = '';
        
        if (!empty($_POST['tstm1name']) && empty($_POST['tstm2name'])) {
            $n = 1;
        } elseif (!empty($_POST['tstm2name']) && empty($_POST['tstm3name'])) {
            $n = 2;
        } elseif (!empty($_POST['tstm3name'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $Prefix = "tstm" . $i;
            $result = $this->updateTestimonial($Prefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    
    
    function gettestimonialbyId ($testimonialID) {
        
        $sql = "SELECT * FROM `testimonials` WHERE `id` = :testimonialID";
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":testimonialID", $testimonialID);
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

