<?php 
/*##################################################### */
    //Class 2nd Story Teller Class
/*##################################################### */

class StoryTeller
{
    
    private $conn;
    private $openConn;
    function __construct()
    {
        $this->conn = new connection();
        $this->openConn = $this->conn->openConnection();
        date_default_timezone_set("Asia/Calcutta");
    }
    
  
	function LoginStoryTeller($Getemail, $Getpassword)
    {
        $emailID = $Getemail;
        $password = md5($Getpassword);
        $sha1 = sha1($password);
        $get_res = executeQuery("SELECT * FROM `RowStoriesData` WHERE `email` = '$emailID'");
        $get_rowsRD = mysqli_fetch_array($get_res);
        $get_num = mysqli_num_rows($get_res);
        
            if ($get_num > 0) {
                
            $get_res_POST = executeQuery("SELECT * FROM `stories` WHERE `id` = '".$get_rowsRD['postid']."'");
            $get_rows = mysqli_fetch_array($get_res_POST);
             
                if ($get_rowsRD['password'] == $sha1) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['id'] = $get_rowsRD['id'];
                    $_SESSION['storyid'] = $get_rowsRD['postid'];
                    $_SESSION['username'] = $get_rows['author'];
                    $_SESSION['email'] = $get_rowsRD['email'];
                    $_SESSION['status'] = true;
                    $resp['login_status'] = 'success';
                    $resp['sucmsg'] = "Logged in successfully";
                } else {
                    $resp['login_status'] = 'error';
                    $resp['errmsg'] = "Password error!";
                }
             
        } else {
            $resp['login_status'] = 'error';
            $resp['errmsg'] = "Account Not Found";
        }
        return $resp['login_status'];
    }
    
    function ForGotPasswordStoryTeller($email)
    {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        
        $token = bin2hex(random_bytes(32));// Implement this function
        
        $_SESSION['STELLERresetPass_token'] = $token;
        $_SESSION['STELLERresetPass_email'] = $email;
    	$_SESSION['STELLERresetPass_timestamp'] = time();
        
        $resetLink = "https://www.wahstory.com/v2/resetpass.steller.php?token=$token";
        $sql = "SELECT email from RowStoriesData where email = '$email'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
        $to = $email;
        $subject = 'Reset your password';
        $message = 'Click the following link to reset your password: '. "\r\n" . $resetLink;
        $headers = 'From: info@wahstory.com' . "\r\n" .
                   'Reply-To: info@wahstory.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
            if (mail($to, $subject, $message, $headers)) {
                return "success";
            } else {
                return "error";
            }
            
        } else{
            return "error";
        }
    }
    
    
    function ChangePassword($Getemail, $Getpassword)
    {
        $emailID = $Getemail;
        $password = md5($Getpassword);
        $sha1 = sha1($password);
        $get_res = executeQuery("SELECT * FROM `RowStoriesData` WHERE `email` = '$emailID'");
        
        $get_num = mysqli_num_rows($get_res);
        
            if ($get_num > 0) {
            $get_res_POST = executeQuery("UPDATE `RowStoriesData` SET `password` = '$sha1' WHERE `email` = '$emailID'");
            
        $to = $emailID;
        $subject = 'Password Changed Successfully!';
        $message = 'Your password has been changed successfully. If you did not request this change, please contact us immediately.';
        $headers = 'From: info@wahstory.com' . "\r\n" .
                   'Reply-To: info@wahstory.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
            if (mail($to, $subject, $message, $headers)) {
                return "success";
            } else {
                return "error";
            }
            
        } else {
            return "error";
        }
        
    }
    
    
    function GetStoryDetails($storyid)
    {
       $get_res = executeQuery("SELECT * FROM `stories` WHERE `id` = '$storyid'");
       $get_num = mysqli_num_rows($get_res);
       $get_result = mysqli_fetch_array($get_res);
        
        if ($get_num > 0) {
            return $get_result;
        }else{
            return NULL;
        }
    }
    
    function getStoryCats()
    {
       $get_res = executeQuery("SELECT * FROM `categories`");
       $get_num = mysqli_num_rows($get_res);
       
        if ($get_num > 0) {
            return $get_res;
        }else{
            return NULL;
        }
    }
    
    function getStoryCat($catid)
    {
       $get_res = executeQuery("SELECT * FROM `categories` WHERE `id` = '$catid'");
       $get_num = mysqli_num_rows($get_res);
       $catrow = mysqli_fetch_array($get_res);
        if ($get_num > 0) {
            return $catrow;
        }else{
            return NULL;
        }
    }
    
    function getStoryEngages($storyid)
    {
       $get_res = executeQuery("SELECT id,likes,views FROM `stories` WHERE `id` ='$storyid'");
       
       $get_num = mysqli_num_rows($get_res);
       $getRow = mysqli_fetch_array($get_res);
       
        if ($get_num > 0) {
            return $getRow;
        }else{
            return NULL;
        }
       
    }
    
    
    function getStoryTotalVotes($storyid)
    {
       $get_res = executeQuery("SELECT * FROM `storyvotes` WHERE `storyid` ='$storyid'");
       
        if ($get_res) {
            return $get_res;
        }else{
            return NULL;
        }
       
    }
    
    function getStoryProducts($storyid)
    {
       $get_res = executeQuery("SELECT * FROM `storyproduct` WHERE `storyid` = '$storyid'");
       
       $get_num = mysqli_num_rows($get_res);
       
        if ($get_num > 0) {
            return $get_res;
        }else{
            return NULL;
        }
    }
    
    
    function getStoryGallery($storyid)
    {
       $get_res = executeQuery("SELECT * FROM `storygallery` WHERE `storyid` = '$storyid'");
       
       $get_num = mysqli_num_rows($get_res);
       
        if ($get_num > 0) {
            return $get_res;
        }else{
            return NULL;
        }
    }
    
    function GetProfile($storyid){
        
        $sql = executeQuery("SELECT * FROM `RowStoriesData` WHERE `postid` = '$storyid'");
        $Row = mysqli_fetch_array($sql);
        if ($Row > 0) {
            return $Row;
        }else{
            return NULL;
        }
    }
    function UpdateProfile($storyid){
        
        $name = $_POST['name'];
        $linkedin = $_POST['linkedinurl'];
        $instagram = $_POST['instaurl'];
        $fbid = $_POST['fburl'];
        $twitterid = $_POST['twitterurl'];
        $city = $_POST['city'];
        
        $SQL = executeQuery("UPDATE `RowStoriesData` SET `name` = '$name', `linkedin` = '$linkedin', `inatagramid` = '$instagram', `fbid` = '$fbid', `twitterid` = '$twitterid', `city` = '$city' WHERE `postid` = '$storyid'");
        
        if ($SQL) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    
    function AddProduct($storyid){
        
        $productname = $_POST['productname'];
        $productlink = $_POST['productlink'];
        
        
        $file = $_FILES['file'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // File extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed file extensions
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp');

    // Maximum file size (in bytes)
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Destination directory to save the file
    $uploadDir = 'assets/images/products/';

    // Generate a unique filename to avoid conflicts
    $newFileName = uniqid('product_', true) . '.' . $fileExt;

    // Check if the file has an allowed extension
    if (in_array($fileExt, $allowedExtensions)) {
        // Check if the file size is within the allowed limit
        if ($fileSize <= $maxFileSize) {
            // Check if there were no upload errors
            if ($fileError === 0) {
                // Move the uploaded file to the desired directory
                $destination = $uploadDir . $newFileName;
                move_uploaded_file($fileTmpName, $destination);
                
                
                
            }
        }
    }
        
        $SQL = executeQuery("INSERT INTO `storyproduct`(`storyid`, `producttitle`, `link`, `img`)values('$storyid', '$productname', '$productlink', '$newFileName')");
        
        if ($SQL) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    
    
    function AddGallery($storyid){
        
        $imagetitle = $_POST['imagetitle'];
        
        $file = $_FILES['file'];

        // File details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
    
        // File extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        // Allowed file extensions
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp');
    
        // Maximum file size (in bytes)
        $maxFileSize = 2 * 1024 * 1024; // 2MB
    
        // Destination directory to save the file
        $uploadDir = 'assets/images/gallery/';
    
        // Generate a unique filename to avoid conflicts
        $newFileName = uniqid('img_', true) . '.' . $fileExt;
    
        // Check if the file has an allowed extension
        if (in_array($fileExt, $allowedExtensions)) {
            // Check if the file size is within the allowed limit
            if ($fileSize <= $maxFileSize) {
                // Check if there were no upload errors
                if ($fileError === 0) {
                    // Move the uploaded file to the desired directory
                    $destination = $uploadDir . $newFileName;
                    move_uploaded_file($fileTmpName, $destination);
                }
            }
        }
        $SQL = executeQuery("INSERT INTO `storygallery`(`storyid`, `title`, `img`)values('$storyid', '$imagetitle', '$newFileName')");
        
        if ($SQL) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    
    
    
    function UpgradeStoryAcc($id, $name)
    {

        $sql = "select postid from RowStoriesData where postid = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
        $one = 1;
            $get_res_POST = executeQuery("UPDATE `RowStoriesData` SET `upgradeRequest` = '$one' WHERE `postid` = '$id'");
            
            
        $to = 'info@wahstory.com';
        $subject = 'Request to Upgrade Account!';
        $message = 'Hi there,' . "\n\n";
        $message .= $name. ' has requested to Upgrade his/her account to Premium.' . "\n\n";
        $message .= 'thanks...';
        $headers = 'From: info@wahstory.com' . "\r\n" .
                   'Reply-To: info@wahstory.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
            if (mail($to, $subject, $message, $headers)) {
                return "success";
            } else {
                return "error";
            }
            
            
        }
    }
    
    
    
    function CheckUpgradeStoryAcc($id)
    {

        $sql = "select postid,upgradeRequest from RowStoriesData where postid = '$id' && upgradeRequest = 1";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
            
            
    }
    
    
    
    
    
    
    // function VoteforStory($storyid)
    // {
    //     $fullname = $_POST['name'];
    //     $email = $_POST['email'];
    //     $phone = $_POST['phone'];
    //     $country = $_POST['country'];
    //     $company = $_POST['company'];
    //     $jobtitle = $_POST['jobtitle'];
        
    //     $dateTime = date('Y-m-d H:i');
        
    //     $sql = executeQuery("INSERT INTO `storyvotes`(`storyid`, `voterFname`, `voterEmail`, `VoterPhone`, `voterCountry`, `voterCompany`, `voterJobtitle`, `datetime`)VALUES('$storyid', '$fullname', '$email', '$phone', '$country', '$company', '$jobtitle', '$dateTime')");
        
    //     if($sql){
	   //     return "SUCCESS";
    //     }else{
    //         return "ERROR";
    //     }
        
    // }
    
} 


?>