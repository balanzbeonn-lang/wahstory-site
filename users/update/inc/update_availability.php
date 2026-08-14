<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class CalendarBooking extends BaseClass
{
   
    function DeleteAllAvailability($userid) {
        
        $sql = "DELETE FROM `availability` WHERE `user_id` = :user_id";
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":user_id", $userid);  
         
        if ($stm->execute()) {
            return "success";
        } else {
            return "error";
        }
        
    }
    
    function updateAvailability($userid, $availabilityData) {
        
        $resp = $this->DeleteAllAvailability($userid);
        
        if($resp == 'success') {
            
            $sql = "INSERT INTO `availability` (`user_id`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) 
            VALUES (:user_id, :day, :start_time, :end_time, NOW(), NOW())";
    
            $stm = $this->SecndopenConn->prepare($sql);
            foreach ($availabilityData as $dayData) {
                $day = $dayData['day']; 
                foreach ($dayData['timeSlots'] as $slot) {
                    $start_time = $slot['startTime'];
                    $end_time = $slot['endTime'];
        
                    // Bind parameters for each insert
                    $stm->bindParam(":user_id", $userid);
                    $stm->bindParam(":day", $day);
                    $stm->bindParam(":start_time", $start_time);
                    $stm->bindParam(":end_time", $end_time);
                    $stm->execute(); // Insert the data into the table
                }
            }
        
            
        }
        
    } //Function Ends
    
    function GetCustomAvalibility($userid, $date) {
        
        $sql = "SELECT * FROM `custom_availability` WHERE `user_id` = :user_id && `date` = :date";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);  
        $stm->bindParam(":date", $date);  
        $stm->execute();
         
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
        
    }
    
    function DeleteCustomAvalibility($userid, $id) {
        
        $sql = "DELETE FROM `custom_availability` WHERE `user_id` = :user_id && `id` = :id";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);  
        $stm->bindParam(":id", $id);
        
        if ($stm->execute()) { 
            return 'success';
        } else {
            return 'error';
        }
        
    }
    
    function GetAvalibilitybyDay($userid, $day) {
        
        $sql = "SELECT * FROM `availability` WHERE `user_id` = :user_id && `day` = :day";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);  
        $stm->bindParam(":day", $day);   
        $stm->execute();
         
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
        
    }
    
    function AddCustomAvalibility($userid, $date, $start_time, $end_time) {
        
        $CustomAvailibility = $this->GetCustomAvalibility($userid, $date);
        
        if($CustomAvailibility == NULL){
            
            $alreadyException = $this->GetExceptionsByUsernDate($userid, $date);
            if($alreadyException !== NULL) {
                $delResp = $this->deleteExceptions($userid, $alreadyException['id']);
            }
            
            $day = date('l', strtotime($date));
            
            $sql = "INSERT INTO `custom_availability` (`user_id`, `date`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES (:user_id, :date, :day, :start_time, :end_time, NOW(), NOW())";
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(':user_id', $userid, PDO::PARAM_INT);
            $stm->bindParam(':date', $date, PDO::PARAM_STR);
            $stm->bindParam(':day', $day, PDO::PARAM_STR);
            $stm->bindParam(':start_time', $start_time, PDO::PARAM_STR);
            $stm->bindParam(':end_time', $end_time, PDO::PARAM_STR);
            
            if ($stm->execute()) {
                return "success";
            } else {
                return "error";
            }
            
        } else {
            $id = $CustomAvailibility['id'];
            $sql = "UPDATE `custom_availability` SET `start_time` = :start_time, `end_time` = :end_time WHERE `id` = :id";
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(':id', $id, PDO::PARAM_INT); 
            $stm->bindParam(':start_time', $start_time, PDO::PARAM_STR);
            $stm->bindParam(':end_time', $end_time, PDO::PARAM_STR);
            
            if ($stm->execute()) {
                return "success";
            } else {
                return "error";
            }
            
            
            
        }
    }
    
    
    
    // ############################ EXCEPTIONS - Leaves
    // ############################ EXCEPTIONS - Leaves
    
    function GetAllExceptionsByUser($userid) {
        
        $sql = "SELECT * FROM `availability_exceptions` WHERE `user_id` = :user_id";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);  
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function GetExceptionsByUsernDate($userid, $date) {
        
        $sql = "SELECT * FROM `availability_exceptions` WHERE `user_id` = :user_id && `exception_date` = :date";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);  
        $stm->bindParam(":date", $date);  
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
    }
    
    function updateExceptions($userid, $exceptionDate) {
            
            $alreadyException = $this->GetExceptionsByUsernDate($userid, $exceptionDate);
            
            if($alreadyException == NULL) {
                
                $CustomAvailibility = $this->GetCustomAvalibility($userid, $exceptionDate);
                
                if($CustomAvailibility !== NULL) {
                    // IF ALready in Availability 
                    $delresp = $this->DeleteCustomAvalibility($userid, $CustomAvailibility['id']);
                }
                
                $sql = "INSERT INTO `availability_exceptions` (`user_id`, `exception_date`, `created_at`, `updated_at`) VALUES (:user_id, :exception_date, NOW(), NOW())";
                $stm = $this->SecndopenConn->prepare($sql);
                $stm->bindParam(":user_id", $userid);
                $stm->bindParam(":exception_date", $exceptionDate);
                
                if ($stm->execute()) {
                    return "success";
                } else {
                    return "error";
                }
                
            } else {
                return "error";
            }
        
    } //Function Ends
    
    
    function deleteExceptions($userid, $id) {
        
        $sql = "DELETE FROM `availability_exceptions` WHERE `user_id` = :user_id && `id` = :id";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":user_id", $userid);
        $stm->bindParam(":id", $id);
        if ($stm->execute()) {
            return "success";
        } else {
            return "error";
        }
    }
    
    
    
    
    

}


?>

