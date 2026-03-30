<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class UserUtility extends BaseClass
{
    
    function getUserDetailsById($id)
    {
        
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
        
    }  
    
    function createUniqueSlug($firstname, $lastname) {
        
        $slug = strtolower(trim($firstname . '-' . $lastname));
        
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug); 
        
        $slug = rtrim($slug, '-');
    
        $query = "SELECT COUNT(*) as count FROM users WHERE slug_username LIKE ?";
        $stm = $this->SecndopenConn->prepare($query);
        $stm->execute([$slug . '%']);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
    
        if ($result['count'] > 0) {
            $slug .= '-' . ($result['count'] + 1);
        }
    
        return $slug;
    }
    
    
    
    function GetClubMemberSocialsById($userid){
        
        $sql = "SELECT * FROM `sociallinks` WHERE `user_id` = :clubuserid" ;
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return NULL;
        }
    }
    
    
    function UpdateUserProfile($UserId){
        
        
        if(isset($_POST['fname']) && $_POST['fname'] != '') {
            $name = $_POST['fname'] .' '. $_POST['lname'];
        } else {
            $name = $_POST['name'];
        }
        
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        
        $linkedin = $_POST['linkedinurl'];
        $fbid = $_POST['fburl'];
        $instagram = $_POST['instaurl'];
        $twitterid = $_POST['twitterurl']; 
        $youtubechannel = $_POST['youtubechannel']; 
        $tiktokurl = $_POST['tiktokurl']; 
        
        if($_FILES['file'] != '') {
            $this->updateprofileimage($UserId);
        }
        
        
        $sql = "UPDATE `users` SET `name` = :name, `phone` = :phone, `gender` = :gender, `city` = :city, `country` = :country, `linkedin` = :linkedin, `inatagramid` = :instagram, `fbid` = :fbid, `twitterid` = :twitterid,  `youtubechannel` = :youtubechannel,  `tiktokurl` = :tiktokurl WHERE `id` = '$UserId'";
        
        $stm = $this->openConn->prepare($sql);
        $stm->bindParam(":name", $name); 
        $stm->bindParam(":phone", $phone);
        $stm->bindParam(":gender", $gender);
        $stm->bindParam(":city", $city);
        $stm->bindParam(":country", $country);
        $stm->bindParam(":linkedin", $linkedin);
        $stm->bindParam(":fbid", $fbid);
        $stm->bindParam(":instagram", $instagram);
        $stm->bindParam(":twitterid", $twitterid);
        $stm->bindParam(":youtubechannel", $youtubechannel);
        $stm->bindParam(":tiktokurl", $tiktokurl); 
        $stm->execute();
        if ($stm->rowCount()) {
            
            $userrow = $this->getUserDetailsById($UserId);
            
            if($userrow['ClubId'] != '') {
                
                    $clubid = $userrow['ClubId'];
                
                    $fname = $_POST['fname'];                
                    $lname = $_POST['lname'];                
                    $honorifics = $_POST['honorifics'];  
                    
                $slug = $this->createUniqueSlug($fname, $lname);
                
                $sql = "UPDATE `users` SET `firstname` = :fname, `lastname` = :lname, `slug_username` = :slug, `title` = :title, `phone` = :phone WHERE `id` = :clubuserid";
                
                $stm = $this->SecndopenConn->prepare($sql);
                $stm->bindParam(":clubuserid", $clubid);
                $stm->bindParam(":fname", $fname);
                $stm->bindParam(":lname", $lname);
                $stm->bindParam(":slug", $slug);
                $stm->bindParam(":title", $honorifics);
                $stm->bindParam(":phone", $phone);
                $stm->execute();
                
                $ClubSocialsRow = $this->GetClubMemberSocialsById($userrow['ClubId']);
                
                if($ClubSocialsRow != NULL) {
                    
                    if($fbid != ''){
                        $sql = "UPDATE `sociallinks` SET `link` = :fbid WHERE `platform` = 'Facebook' AND `user_id` = '$clubid'";
                        $stm = $this->SecndopenConn->prepare($sql);
                        $stm->bindParam(":fbid", $fbid);
                        $stm->execute();
                    }
                    
                    if($instagram != ''){
                        $sql = "UPDATE `sociallinks` SET `link` = :instagram WHERE `platform` = 'Instagram' AND `user_id` = '$clubid'";
                        $stm = $this->SecndopenConn->prepare($sql);
                        $stm->bindParam(":instagram", $instagram);
                        $stm->execute();
                    }
                    
                    if($linkedin != ''){
                        $sql = "UPDATE `sociallinks` SET `link` = :linkedin WHERE `platform` = 'Linkedin' AND `user_id` = '$clubid'";
                        $stm = $this->SecndopenConn->prepare($sql);
                        $stm->bindParam(":linkedin", $linkedin);
                        $stm->execute();
                    }
                    
                    if($twitterid != ''){
                        $sql = "UPDATE `sociallinks` SET `link` = :twitterid WHERE `platform` = 'Twitter' AND `user_id` = '$clubid'";
                        $stm = $this->SecndopenConn->prepare($sql);
                        $stm->bindParam(":twitterid", $twitterid);
                        $stm->execute();
                    } 
                    
                    
                }
                
            }
            
            
            
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    } // End
    
    
    
    
    function updateProfileImage($wahUserid) {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $userrow = $this->getUserDetailsById($wahUserid);
            $OldPhoto = $userrow['profile_image'];
            
            if ($OldPhoto != 'user-icon869560439.jpg') {
                $oldImagePath = "../../images/users/" . $OldPhoto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $file = $_FILES['file'];
            
            // Upload user profile image
            $userPhoto = $this->uploadImage($file, "../../wahclub/public/img/photos/");
            
             $file2 = $_FILES['file'];
            $userPhoto1 = $this->uploadImage($file2, "../../images/users/");
            if ($userPhoto) {
                $sql = "UPDATE `users` SET `profile_image` = :image WHERE `id` = :wahUserid";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":image", $userPhoto);
                $stm->bindParam(":wahUserid", $wahUserid);
                $stm->execute();
              
                // If the user belongs to a club, upload club photo
                if ($userrow['ClubId'] != '') { 
                
                     $sql1 = "UPDATE `users` SET `photo` = :image1 WHERE `id` = :clubUserId";
                            $stm2 = $this->SecndopenConn->prepare($sql1);
                            $stm2->bindParam(":image1", $userPhoto);
                            $stm2->bindParam(":clubUserId", $userrow['ClubId']);
                            $stm2->execute();
                            return "Club photo uploaded successfully 2";
                    
                    
                }
            }
    
            
        }
    }
    
    
    function uploadImage($file, $uploadDir) {
        $filename = $file['name'];
        $fileSize = $file['size'];
        $fileExp = explode('.', $filename);
        $fileActualName = $fileExp[0];
        $fileActualExt = strtolower(end($fileExp));
        
        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        
        if (in_array($fileActualExt, $allowed)) {
            $finalImgName = str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = $uploadDir . $finalImgName;
            
            if (move_uploaded_file($file['tmp_name'], $fileDest)) {
                return $finalImgName;  // Return the new file name
            }
        }
        return false; // Return false if the upload failed or file is not valid
    }


    
    
    
    
    function GetWAHClubUserById($userid)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = :userid";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function updateCareerHighlights($clubUserId){
        
        if($clubUserId != '') {
            
            $exp = $_POST['totalexp'];
            $clients = $_POST['totalclients'];
            $projects = $_POST['totalprojects'];
            $awards = $_POST['totalawards'];
            
            $sql = "UPDATE `users` SET `totalexperience` = :exp, `totalclients` = :clients, `totalproject` = :projects, `totalawards` = :awards WHERE `id` = :clubUserId";
            
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(":exp", $exp);
            $stm->bindParam(":clients", $clients);
            $stm->bindParam(":projects", $projects);
            $stm->bindParam(":awards", $awards);
            $stm->bindParam(":clubUserId", $clubUserId);
            
            if ($stm->execute()) {
                return "SUCCESS";
            }else{
                return "ERROR"; 
            }
        }
        
        
    }
    
    function UpdateQuickProfile($WAHUserid, $gender, $starsign, $city, $country) {
        
        if($WAHUserid != '' && $gender != '' && $starsign != '' && $city != '' && $country != '') {
            
            $sql = "UPDATE `users` SET `gender` = :gender, `starsign` = :starsign, `city` = :city, `country` = :country WHERE `id` = :userid";
            
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":userid", $WAHUserid);
            $stm->bindParam(":gender", $gender);
            $stm->bindParam(":starsign", $starsign);
            $stm->bindParam(":city", $city);
            $stm->bindParam(":country", $country);
            
            if ($stm->execute()) {
                return "SUCCESS";
            }else{
                return "ERROR"; 
            }
        }
        return "ERROR"; 
    }
    
    function UpdateHobbies($ClubUserid, $hobbies) {
        if (!empty($ClubUserid) && !empty($hobbies) && is_array($hobbies)) {
            // SQL to delete existing hobbies for the user
            $deleteSql = "DELETE FROM `hobby_user` WHERE `user_id` = :userid";
            // SQL to insert new hobbies
            $insertSql = "INSERT INTO `hobby_user` (`user_id`, `hobby_id`) VALUES (:userid, :hobbyid)";
        
            // Prepare statements
            $deleteStmt = $this->SecndopenConn->prepare($deleteSql);
            $insertStmt = $this->SecndopenConn->prepare($insertSql);
        
            // Start transaction for data integrity
            $this->SecndopenConn->beginTransaction();
        
            try {
                // First, delete existing hobbies for the user
                $deleteStmt->execute([
                    ':userid' => $ClubUserid
                ]);
        
                // Now insert the new hobbies
                foreach ($hobbies as $hobbyid) {
                    // Bind parameters and insert new hobbies
                    $insertStmt->bindParam(":userid", $ClubUserid);
                    $insertStmt->bindParam(":hobbyid", $hobbyid);
        
                    if (!$insertStmt->execute()) {
                        // If insert fails, throw an exception and rollback
                        throw new Exception("Insert failed for hobby ID: " . $hobbyid);
                    }
                }
        
                // Commit the transaction if everything is successful
                $this->SecndopenConn->commit();
                return "SUCCESS";
            } catch (Exception $e) {
                // Rollback the transaction in case of an error
                $this->SecndopenConn->rollBack();
                return "ERROR: " . $e->getMessage();
            }
        }
        
        return "ERROR: Invalid input.";
    }


    
    
    

}


?>

