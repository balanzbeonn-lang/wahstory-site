<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class BlogUtility extends BaseClass
{
    
    function updateBlog($Prefix, $userid) {
            
        if (empty($_POST[$Prefix . 'title'])) {
            return "ERROR:";
        }

        $blogtitle = $_POST[$Prefix . 'title']; 
        $bloglink = $_POST[$Prefix . 'link']; 
        
        if(!empty($_FILES[$Prefix . 'file'])) {
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    $blogid = $_POST[$Prefix . 'id'];
                    $row = $this->getblogbyId($blogid);
                    $BlogPhoto = $row['blog_image'];
                    $oldimage = "../../wahclub/public/img/blogs/" .  $BlogPhoto;
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

            $fileDest = "../../wahclub/public/img/blogs/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            
            $maxFileSize = 200 * 1024; // 200 KB

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $BlogPhoto = $finalImgName;
                }
            }
            
        } else{
            
            if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
                {
                    
                    $blogid = $_POST[$Prefix . 'id'];
                    
                    $row = $this->getblogbyId($blogid);
                    
                    $BlogPhoto = $row['blog_image'];
                    
                } else {
                    $BlogPhoto = NULL;
                }
            
        }
        
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') 
        {
            $sql = "UPDATE `blogs` SET `blog_title` = :blogtitle, `blog_link` = :bloglink, `blog_image` = :blogphoto WHERE `id` = :blogid AND `user_id` = :userid";
            
        } else {
            
            $sql = "INSERT INTO `blogs` (`blog_title`, `blog_link`, `blog_image`, `user_id`) VALUES (:blogtitle, :bloglink, :blogphoto, :userid)";
        }

        $stm = $this->SecndopenConn->prepare($sql);

        $stm->bindParam(":blogtitle", $blogtitle);
        $stm->bindParam(":bloglink", $bloglink);
        $stm->bindParam(":blogphoto", $BlogPhoto);
        
        $stm->bindParam(":userid", $userid);
        
        if(isset($_POST[$Prefix . 'id']) && $_POST[$Prefix . 'id'] != '') {
            $stm->bindParam(":blogid", $blogid);
        }
        
        if ($stm->execute()) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function UpdateUserBlog($userid){
        
        $result = '';
        
        if (!empty($_POST['blog1title']) && empty($_POST['blog2title'])) {
            $n = 1;
        } elseif (!empty($_POST['blog2title']) && empty($_POST['blog3title'])) {
            $n = 2;
        } elseif (!empty($_POST['blog3title'])) {
            $n = 3;
        } else {
            $n = 1;
        }
    
        for ($i = 1; $i <= $n; $i++) {
            $Prefix = "blog" . $i;
            $result = $this->updateBlog($Prefix, $userid);
        }
    
        if (!empty($result)) {
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    
            
        
    }  //Function Ends
    
    
    function getblogbyId ($blogID) {
        
        $sql = "SELECT * FROM `blogs` WHERE `id` = :blogID";
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":blogID", $blogID);
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

