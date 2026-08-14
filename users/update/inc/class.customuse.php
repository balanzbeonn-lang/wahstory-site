<?php
  
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/baseclass.php');

class CustomUtility extends BaseClass
{   
    function GetWAHClubUserById($userid)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = :userid";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":userid", $userid); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function ChkCodeValidity($code){
        
        $active = 'active';
        $date = date('Y-m-d');
        
        $sql = "SELECT * FROM `discount_codes` WHERE `code` = :code && `status` = :active && `exp_date` > :date";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":code", $code); 
        $stm->bindParam(":active", $active); 
        $stm->bindParam(":date", $date); 
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function generateTransactionId($userId)
    {
        // Get the current time in microseconds for uniqueness
        $timestamp = microtime(true);
    
        // Combine timestamp with a random number to ensure uniqueness
        $randomNumber = mt_rand(100000, 999999);
    
        // Optionally, you can include the user ID or other identifiers if necessary
        $userIdentifier = $userId;
    
        // Create a hash using SHA-256 to ensure the result is alphanumeric and fixed length
        $transactionId = 'TX' . strtoupper(uniqid($userIdentifier . '_', true)) . $randomNumber;
    
        return $transactionId;
    }

    
    
    function MakePaymentWithDiscCode($userid, $code, $amount)
    {
        
        $this->SecndopenConn->beginTransaction();
        
        try {
            
            $codeValidity = $this->ChkCodeValidity($code);
        
            if($codeValidity !== FALSE) {
            
                $discount = $codeValidity['discount'];
                
                $discAMT = ($amount * $discount) / 100;
                $amount = $amount - $discAMT;
                
                $currency = 'USD';
                $payment_status = 'completed';
                $transaction_id = $this->generateTransactionId($userid);
                $discountcode_id = $codeValidity['id'];
                $dateTime = date('Y-m-d H:i:s');
                
                $sql = "INSERT INTO `transactions` (`user_id`, `amount`, `currency`, `payment_status`, `transaction_id`, `discountcode_id`, `created_at`, `updated_at`) VALUES (:userid, :amount, :currency, :payment_status, :transaction_id, :discountcode_id, :dateTime, :dateTime)";
                
                $stm = $this->SecndopenConn->prepare($sql);
                
                $stm->bindParam(":userid", $userid); 
                $stm->bindParam(":amount", $amount); 
                $stm->bindParam(":currency", $currency); 
                $stm->bindParam(":payment_status", $payment_status); 
                $stm->bindParam(":transaction_id", $transaction_id); 
                $stm->bindParam(":discountcode_id", $discountcode_id); 
                $stm->bindParam(":dateTime", $dateTime);
                
                if (!$stm->execute()) {
                    throw new Exception("Failed to insert transaction.");
                }
                
                $inactive = 'inactive';
                
                $sql = "UPDATE `discount_codes` SET `status` = :inactive WHERE `id` = :id";
                
                $stm = $this->SecndopenConn->prepare($sql);
                $stm->bindParam(":id", $discountcode_id); 
                $stm->bindParam(":inactive", $inactive); 
                $stm->execute();
                
                if (!$stm->execute()) {
                    throw new Exception("Failed to update discount code status.");
                }
                
                $paid = 'paid';
                $sql = "UPDATE `users` SET `subscription_status` = :paid WHERE `id` = :userid";
                $stm = $this->SecndopenConn->prepare($sql);
                $stm->bindParam(":userid", $userid); 
                $stm->bindParam(":paid", $paid); 
                
                if (!$stm->execute()) {
                    throw new Exception("Failed to update user subscription status.");
                }
                
                // Commit the transaction if everything is successful
                $this->SecndopenConn->commit();
                return 'success';
                
            } else {
                throw new Exception("Invalid Or Expired discount code.");
            }
            
            
        } catch (Exception $e){
            $this->SecndopenConn->rollBack();
            return 'error: ' . $e->getMessage();
        }
    
    }
    //Function Ends
    

}


?>

