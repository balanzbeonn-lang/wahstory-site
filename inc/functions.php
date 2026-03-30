<?php

require_once(__DIR__ . '/baseclass.php');

class Story extends BaseClass
{
    
    public function getOpenConn() {
        return $this->openConn;
    }
    
     // Function to generate a slug
    public function createUniqueSlug($firstName, $lastName) {
        // Combine first and last names to form a base slug
        $slug = $this->slugify($firstName . '-' . $lastName);
        $originalSlug = $slug;
        $count = 1;

        // Check if the slug already exists in the database
        while ($this->slugExists($slug)) {
            // If exists, append a number to make it unique
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Helper function to check if a slug exists in the database
    private function slugExists($slug) {
        $query = "SELECT * FROM users WHERE slug_username = ?";
        $stm = $this->SecndopenConn->prepare($query);
        $stm->execute([$slug]);

        // If the row count is more than 0, the slug already exists
        return $stm->rowCount() > 0;
    }

    // Helper function to slugify a string (convert to lowercase and replace spaces with hyphens)
    private function slugify($text) {
        // Replace non-letter or non-digit characters with hyphen
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate to ASCII
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate hyphens
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        return strtolower($text);
    }

    
    
    
    
    //Generate OTP ____________________________
    // Function to generate a random OTP
    function generateOTP($length = 6) {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return str_pad(random_int($min, $max), $length, '0', STR_PAD_LEFT);
    }
    
    //Send OTP ____________________________
    //Send OTP ____________________________
    function SendVerificationOtpMail($email, $OTP){
    
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $email,
                "name" => " " 
                )
            );
            
            
            $maildata["subject"] = $OTP.' is your OTP to verify your account on WAHStory';
    
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    OTP | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 18px;"> Verify Your Account, </p>
            		<p style="font-size: 15px;"> Thank you for starting a journey with WAHStory.</p>
            		
            		<p style="font-size: 15px;"> Please use the following verification code to verify your account. </p>
            		
            		<div style="padding:15px;border:#e6e6e6 1px solid;border-radius:12px; text-align: center;">
                		<p style="text-align:center"> Verification code </p>
                		<p style="font-family:sans-serif;color:#1a1a1a;font-size:32px;line-height:40px;font-weight:700;letter-spacing:2.56px;text-align:center">
    															'.$OTP.'
    					</p>
            		</div>
            		
            		<p style="font-size: 14px; margin: 20px 0px 10px 0px;"> OTP is valid for next 15 mins.</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> WAHStory</p>
            		
                    
                    </body>
                    </html>';
	        
	         SendMailBySMTP($maildata);
    }
    
    
    //Send OTP ____________________________
    function SendWAHClubVerificationOtpMail($email, $OTP){
    
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $email,
                "name" => " " 
                )
            );
            
            
            $maildata["subject"] = $OTP.' is your OTP to verify your Email on WAHClub';
    
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    OTP | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 18px;"> Verify Your Email, </p>
            		<p style="font-size: 15px;"> Thank you for starting a journey with WAHClub.</p>
            		
            		<p style="font-size: 15px;"> Please use the following verification code to verify your email. </p>
            		
            		<div style="padding:15px;border:#e6e6e6 1px solid;border-radius:12px; text-align: center;">
                		<p style="text-align:center"> Verification code </p>
                		<p style="font-family:sans-serif;color:#1a1a1a;font-size:32px;line-height:40px;font-weight:700;letter-spacing:2.56px;text-align:center">
    															'.$OTP.'
    					</p>
            		</div>
            		
            		<p style="font-size: 14px; margin: 20px 0px 10px 0px;"> OTP is valid for next 15 mins.</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> WAHStory</p>
            		
                    
                    </body>
                    </html>';
	        
	         SendMailBySMTP($maildata);
    }
    
    
    
    function getTestimonials($limit = null)
    {
        if ($limit)
            $sql = "SELECT * from testimonials where status = 'verified' order by id desc limit $limit";
        else
            $sql = "SELECT * from testimonials where status = 'verified'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }
    
    
    function getTests()
    {
         
        $sql = "SELECT * from test";
        
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }
    
/* ############################### USERS DETAILS ######### */

    function getUserDetailsById($id)
    {
        
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
        
    }    
/* ############################### USERS DETAILS ######### */

    function getSocialHealthScoreByEmail($email)
    {
        $sql = "select * from socialfootprint where email = '$email'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
             $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }
    
/* ############################### USERS DETAILS Ends ######### */


/* ############################### Stories Data ######### */

    function getCats()
    {
        $sql = "select * from categories";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
            
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function getCatById($id)
    {
        $sql = "select * from categories where id = '$id'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }
    
    function getCatBySlug($slug)
    {
        
        try {
            
            $sql = "select * from categories where slug = :slug";
            $stm = $this->openConn->prepare($sql);
            
            $stm->bindParam(':slug', $slug, PDO::PARAM_STR);
            
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            
        } catch (PDOException $e) {
            
            error_log($e->getMessage());
            return false;
        }
        
    }
    
    
    function getStoryofMonth()
    {
        $sql = "SELECT * FROM storyofmonth ORDER BY id DESC LIMIT 1";
        
        $stm = $this->openConn->prepare($sql);
        
        $stm->execute();
        
        $storyrow =  $stm->fetch(PDO::FETCH_ASSOC);
        
        $storyID = $storyrow["postid"];
        
        $sql = "select * from stories where id = '$storyID'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

             $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function getLatestStories($count = 5, $section = null)
    {
        if ($section) {
            $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status = 'boosted' and id in (select postId from stories_boosted where section = '$section' order by id desc) order by id desc limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = '$section') order by id DESC limit $x";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                } else {
                    return $stm->fetchAll();
                }
            } else {
                return $stm->fetchAll();
            }
        } else {
            $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status = 'boosted' order by id DESC limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status <> 'boosted' order by id DESC limit $x";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                }
            } else {
                return $stm->fetchAll();
            }
        }
    }
    
    function getnewStories($count)

    {

        $sql = "select * from stories where adminAction = 'varified' and userAction = 'shown' order by id desc limit $count";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }


    function getStoryByID($id)
    {

        $sql = "select * from stories where id = :id";

        $stm = $this->openConn->prepare($sql);
        
        $stm->bindParam(":id", $id); 
        
        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function getStory($slug)
    {
        
        
        $slug = htmlspecialchars($slug);
        
        $sql = "select * from stories where slug = '$slug'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }else{
            return NULL;
        }
    }
    
    function getStoryDetailsByID($userid)
    {

        $sql = "select * from users where id = '$userid'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function getStoriesByCat($cat, $count = null)
    {
        if ($count) {
            $sql = "SELECT * from stories where category = $cat and adminAction = 'varified' and userAction = 'shown' and status = 'boosted' and id in (select postId from stories_boosted where section = $cat) limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where category = $cat and adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = $cat) order by id desc limit $x";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                } else {
                    return $stm->fetchAll();
                }
            }
        } else {
            $sql = "SELECT * from stories where category = $cat and adminAction = 'varified' and userAction = 'shown' and status = 'boosted' and id in (select postId from stories_boosted where section = $cat)";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $sql2 = "SELECT * from stories where category = $cat and adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = $cat) order by id desc";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                } else {
                    return $stm->fetchAll();
                }
            } else {
                $sql2 = "SELECT * from stories where category = $cat and adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = $cat) order by id desc";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                return $stm2->fetchAll();
            }
        }
    }
    
    function getAllStories($forsitemap = FALSE)
    {
        if($forsitemap === TRUE){
             $sql = "SELECT slug, date from stories where adminAction = 'varified' and userAction = 'shown'";
        }else{
             $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown'";
        }
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function getPostsByQuery($query)
    {
        
        $query = htmlspecialchars($query);
        
        $SearchedTitle = str_replace('-', ' ', $query);
        
        // $sql = "SELECT * from stories where author like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || title like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || content like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown'";
        $sql = "SELECT * FROM stories 
        WHERE (author LIKE '%$SearchedTitle%' OR title LIKE '%$SearchedTitle%' OR content LIKE '%$SearchedTitle%') 
        AND adminAction = 'varified' AND userAction = 'shown'";

        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    
    function setStoryViews($id)
    {
        $sql = "update stories set views = views + 1 where id = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
            return "Success";
        }
    }
    
    function getAllStoriesCount($param)
    {
        switch ($param) {
            case "Posts": {
                    $sql = "select count(*) as count from stories";
                    break;
                }
            case "Reactions": {
                    $sql = "select count(*) as count from reviews";
                    break;
                }
            case "Likes": {
                    $sql = "select sum(likes) as count from stories";
                    break;
                }
            case "Views": {
                    $sql = "select sum(views) as count from stories";
                    break;
                }
        }

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function getTrendingStories($count = 5, $section = null)
    {
        if ($section) {
            $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status = 'boosted' and id in (select postId from stories_boosted where section = '$section') order by views DESC limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = '$section') order by views DESC limit $x";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                } else {
                    return $stm->fetchAll();
                }
            } else {
                return $stm->fetchAll();
            }
        } else {
            $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status = 'boosted' limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status <> 'boosted' order by views DESC limit $x";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return array_merge($stm->fetchAll(), $stm2->fetchAll());
                } else {
                    return $stm->fetchAll();
                }
            } else {
                return $stm->fetchAll();
            }
        }
    }

/* ############################### Stories Data Ends ########## */
    
/*################################ Blogs Data        ########### */
    function getBlogs($limit)
    {
        if($limit != ''){ 
            $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc LIMIT $limit";
        }else{
            $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc";
        }
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
     function getCountBlogs()
    { 
        $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc"; 
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->rowCount();
            return $data;
        }
    }
    
    function getBlogsWithPagination($offset,$postsPerPage)
    {
       $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc LIMIT $offset, $postsPerPage";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function getBlogCatBySlug($slug)
    {
        $sql = "select * from blogcats where slug = '$slug'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }
    
    function getBlogsBySearch($search)
    {
        $SearchedTitle = str_replace('-', ' ', $search);
        
        $sql = "SELECT * from blogs where title like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || content like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
    
    
    function getBlogsCountBySearch($search)
    {
        $SearchedTitle = str_replace('-', ' ', $search);
        
        $sql = "SELECT * from blogs where title like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || content like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->rowCount();
            return $data;
        }else{
            return NULL;
        }
    }
    
    function getRecentBlogs($limit)
    {
         $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc LIMIT $limit";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    
    function getBlogByslug($slug)
    {

        $sql = "select * from blogs where slug = '$slug'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    
    
    function getBlogCatById($id)
    {
        $sql = "select * from blogcats where id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }
    
    function getBlogPrev($id, $catid)
    {

        $sql = "select * from blogs where id < '$id' and category = '$catid' ORDER BY id desc";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

    function getBlogNext($id, $catid)
    {

        $sql = "select * from blogs where id > '$id' and category = '$catid'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    
    
    function PostContactForm()
    { 
            $date = date("Y-m-d");
            $name = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $message = htmlspecialchars($_POST['message']); 
            $sql = "insert into getintouch(`name`, `email`, `phone`, `message`, `date`) values('$name', '$email', '$phone', '$message', '$date')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            } 
    } 
    
    function PostWahclubForm() 
    { 
        $date = date("Y-m-d");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $dialcode = $_POST['dialCode'];
        $phone = $_POST['phone'];
        $socialid = $_POST['socialid']; 
        $sql = "insert into wahclub(`firstname`, `lastname`, `email`, `phone`, `socialprofile`, `date`) values('$fname', '$lname', '$email', '$phone', '$socialid', '$date')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
                
            $name = $fname . ' ' . $lname;
                
        
            //Checking if already User Of WAHStory
                $UserRegistered = $this->GetUserByEmail($email);
                
                if($UserRegistered === FALSE){ 
                    $sql2 = "INSERT INTO `users`(`name`, `phone`, `email`, `linkedin`, `created_at`)VALUES(:name, :phone, :email, :linkedin, :date)";
                    
                    $stm2 = $this->openConn->prepare($sql2);
                    
                    $stm2->bindParam(":name", $name); 
                    $stm2->bindParam(":phone", $phone);
                    $stm2->bindParam(":email", $email); 
                    $stm2->bindParam(":linkedin", $socialid);  
                    $stm2->bindParam(":date", $date);
                    
                    $stm2->execute();
                    if ($stm2->rowCount()) {
                    
                        return "Success";
                    }   else {
                        return "Error";
                    } 
                    
                } //RegisterCheck false
                
                return "Success";
                 
        } else {
            return "Error";
        } 
    }
    
    
    function PostWahclubPreForm() 
    { 
        $date = date("Y-m-d");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $dialcode = $_POST['dialCode'];
        $phone = $_POST['phone'];
        $socialid = $_POST['socialid']; 
        
    //Pre Registration
        $sql = "insert into wahclub(`firstname`, `lastname`, `email`, `dialcode`, `phone`, `socialprofile`, `date`) values('$fname', '$lname', '$email', '$dialcode', '$phone', '$socialid', '$date')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
                 
                 
            $slugUsername = $this->createUniqueSlug($fname, $lname);
            
    //WAHClub User Registration            
        $sql1 = "insert into users(`firstname`, `lastname`, `slug_username`, `dialcode`, `phone`, `email`) values('$fname', '$lname', '$slugUsername', '$dialcode', '$phone', '$email')";
        
            $stm1 = $this->SecndopenConn->prepare($sql1);
            $stm1->execute();
            if ($stm1->rowCount()) {
                
                $ClubId = $this->SecndopenConn->lastInsertId();
                
                $_SESSION['club_userid'] = $ClubId;
                $_SESSION['email'] = $email;
               
                $name = $fname . ' ' . $lname;
                
            //Checking if already User Of WAHStory
                $UserRegistered = $this->GetUserByEmail($email);
                
                if($UserRegistered === FALSE){ 
                    
                    
                    $plainPassword = bin2hex(random_bytes(6)); // Generates a 12-character random 
                    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
                    
            //WAHStory User Registration        
                    $sql2 = "INSERT INTO `users`(`name`, `phone`, `email`, `password`, `linkedin`, `ClubId`, `created_at`)VALUES(:name, :phone, :email, :password, :linkedin, :ClubId, :date)";
                    
                    $stm2 = $this->openConn->prepare($sql2);
                    
                    $stm2->bindParam(":name", $name); 
                    $stm2->bindParam(":phone", $phone);
                    $stm2->bindParam(":email", $email); 
                    $stm2->bindParam(":password", $hashedPassword); 
                    $stm2->bindParam(":linkedin", $socialid);  
                    $stm2->bindParam(":ClubId", $ClubId);  
                    $stm2->bindParam(":date", $date);
                    
                    $stm2->execute();
                    if ($stm2->rowCount()) {
                        
                        $UserId = $this->openConn->lastInsertId();
                        $_SESSION['userid'] = $UserId;
                    
                    
            
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHClub"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => $email,
                "name" => $name 
                )
            );
            
            
        $maildata["subject"] = "Welcome to WAHClub! Let's Build Your Story Together";
    
        $maildata['bodymessage'] = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>
                    Welcome to WAHClub! | WAHStory
                    </title>
                    </head>
                    <body>
                    <p style="font-size: 15px;">  We are excited to have you join our community, and we are ready to help you elevate your brand.</p>
                    
                    <p style="font-size: 15px;"> Below are your login details to access your WAHClub dashboard: </p>
            		<p style="font-size: 15px;"> <strong>Login Email:</strong> '.$email.' </p>
            		<p style="font-size: 15px;"> <strong>Password:</strong> '.$plainPassword.' </p>
            		
            		<p style="font-size: 15px;"> To get started, you can log in here: </p>
            		<p style="font-size: 15px; margin-bottom: 10px;"> <a href="https://www.wahstory.com/users/" style="background: #df2853;display: inline;padding: 10px;font-weight: 700;border-radius: 5px; color: #fff !important; text-decoration: none;" target="_blank"> Go to Your Dashboard </a> </p> 
            		
            		<p style="font-size: 15px;"> If you have any questions or need assistance, feel free to reach out at <a href="mailto:info@wahstory.com">info@wahstory.com</a> </p> 
            		<p style="font-size: 15px;"> We are here to support you! </p> 
            		  
    				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
    				<p style="font-size: 14px; margin: 5px 0px;"> WAHClub Team</p>
            		
                    
                    </body>
                    </html>';
			
			SendMailBySMTP($maildata);
                    
                    
                        return "Success";
                    }   else {
                        return "Error";
                    } 
                    
                }else{  //RegisterCheck false
                    $_SESSION['userid'] = $UserRegistered['id'];
                    
                    $plainPassword = bin2hex(random_bytes(6)); // Generates a 12-character random 
                    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
                    
                    
                    $sql3 = "UPDATE `users` SET `password` = '$hashedPassword' AND `ClubId` = '$ClubId' WHERE id = '".$UserRegistered['id']."'";
                    
                    $stm3 = $this->openConn->prepare($sql3);
                    
                    
                     $stm3->execute();
                    if ($stm3->rowCount()) {
                    
                        
                        
                    $maildata = array();
                    $maildata["sender"] = array(
                        "email" => "info@wahstory.com",
                        "name" => "WAHClub"
                        );
                                      
                    $maildata["receiver"] = array(
                        array(
                            "email" => $UserRegistered['email'],
                            "name" => $UserRegistered['name'] 
                            )
                        );
                        
                        $emailnew = $UserRegistered['email'];
                        
                    $maildata["subject"] = "Welcome to WAHClub! Let's Build Your Story Together";
                
                    $maildata['bodymessage'] = '<!DOCTYPE html>
                                <html>
                                <head>
                                <title>
                                Welcome to WAHClub! | WAHStory
                                </title>
                                </head>
                                <body>
                                <p style="font-size: 15px;">  We are excited to have you join our community, and we are ready to help you elevate your brand.</p>
                                
                                <p style="font-size: 15px;"> Below are your login details to access your WAHClub dashboard: </p>
                        		<p style="font-size: 15px;"> <strong>Login Email:</strong> '.$emailnew.' </p>
                        		<p style="font-size: 15px;"> <strong>Password:</strong> '.$plainPassword.' </p>
                        		
                        		<p style="font-size: 15px;"> To get started, you can log in here: </p>
                        		<p style="font-size: 15px; margin-bottom: 10px;"> <a href="https://www.wahstory.com/users/" style="background: #df2853;display: inline;padding: 10px;font-weight: 700;border-radius: 5px; color: #fff !important; text-decoration: none;" target="_blank"> Go to Your Dashboard </a> </p> 
                        		
                        		<p style="font-size: 15px;"> If you have any questions or need assistance, feel free to reach out at <a href="mailto:info@wahstory.com">info@wahstory.com</a> </p> 
                        		<p style="font-size: 15px;"> We are here to support you! </p> 
                        		  
                				<p style="font-size: 14px; margin: 5px 0px;"> Best Regards,</p>
                				<p style="font-size: 14px; margin: 5px 0px;"> WAHClub Team</p>
                        		
                                
                                </body>
                                </html>';
            			
            			SendMailBySMTP($maildata);
                    
                    
                        return "Success";
                        
                    
                    }
                    
                    
                }
               
               
                return "Success";
            } else {
                return "Error";
            } 
                 
        } else {
            return "Error";
        } 
    }
    
     function GetWahclubPreUser($email) 
    {  
            
    $sql1 = "select email from wahclub where `email` = '$email'";
    $stm = $this->openConn->prepare($sql1);
    $stm->execute();
    
        if ($stm->rowCount()) {
            return true;
        } else {
            return false;
        } 
    }
    
    function GetWahclubPreUserByEmail($email) 
    {  
            
    $sql1 = "select * from wahclub where `email` = '$email'";
    $stm = $this->openConn->prepare($sql1);
    $stm->execute();
    
        if ($stm->rowCount()) {
             $data = $stm->fetch();
            return $data;
        } else {
            return false;
        } 
    }
    
    
    
    function GetWAHUserInWahclub($Userid) 
    {   
        $userrow = $this->getUserDetailsById($Userid);
        if($userrow !== false){
            
            $name = $userrow['name'];
            $phone = $userrow['phone'];
            $email = $userrow['email'];
            
            $finalImgName = $userrow['profile_image'];
            
            $fileDestOld = "../images/users/" . $finalImgName;
            
            $fileDestClub = "../wahclub/public/img/photos/". $finalImgName;
            
            copy($fileDestOld, $fileDestClub);
            
            
            $nameParts = explode(' ', $name);

            $fname = $nameParts[0];
            $lname = isset($nameParts[1]) ? $nameParts[count($nameParts) - 1] : '';
            
            $slugUsername = $this->createUniqueSlug($fname, $lname);
            
            $sql = "insert into users(`firstname`, `lastname`, `slug_username`, `phone`, `email`, `photo`) values('$fname', '$lname', '$slugUsername', '$phone', '$email', '$finalImgName')";
            
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                
                $ClubId = $this->SecndopenConn->lastInsertId();
                $_SESSION['club_userid'] = $ClubId;
                
                 
                
                $sql2 = "UPDATE `users` SET `ClubId` = '$ClubId' WHERE `id` = '$Userid'";
                    
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                
                if ($stm2->rowCount()) {
                    
                    return "success";
                }
            } else {
                return "error";
            } 
            
        }  
    }
    
    
    function SubscribeWahstory($email)
    { 
            $date = date("Y-m-d");
            
    $sql1 = "select email from subscription where `email` = '$email'";
    $stm = $this->openConn->prepare($sql1);
    $stm->execute();
    if ($stm->rowCount()) {
        
        return "Error";
        
        } else {
            $sql = "insert into subscription(`email`, `date`) values('$email', '$date')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            } 
            
        } 
    }
    
    function Updatestoryreaction($storyid, $userid, $reaction)
    { 
            $date = date("Y-m-d");
            
            $slectsql = "SELECT storyid, userid FROM `storyreactions` WHERE `storyid` = '$storyid' && `userid` = '$userid'";
            
            $stm2 = $this->openConn->prepare($slectsql);
            $stm2->execute();
            
            if($stm2->rowCount()){ 
                $sql = "UPDATE `storyreactions` set `reaction` = '$reaction' WHERE `storyid` = '$storyid' && `userid` = '$userid'";
            }else{
                $sql = "insert into `storyreactions` (`storyid`, `userid`, `reaction`, `date`) values('$storyid', '$userid', '$reaction', '$date')";
            }
            
            $stm = $this->openConn->prepare($sql);
            
            $stm->execute();
            
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            } 
    }
    
    
    
    function Updatestorysaves($storyid, $userid)
    { 
            $date = date("Y-m-d");
        $slectsql = "SELECT storyid, userid FROM `postbookmarks` WHERE `storyid` = '$storyid' && `userid` = '$userid'";
        $stm2 = $this->openConn->prepare($slectsql);
        $stm2->execute();
        if($stm2->rowCount()){
            return "Error";
        }else{   
            $sql = "insert into `postbookmarks` (`storyid`, `userid`, `date`) values('$storyid', '$userid', '$date')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            } 
        } 
        
    }
    
    
    
    function formatNumber($number) {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'm';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        } else {
            return $number;
        }
    }
    
    function ChkIfAlreadyRegistered($Getemail)
    {
        $ChkEmail = "select email from users where email = '$Getemail'";
        $stm = $this->openConn->prepare($ChkEmail);
        $stm->execute();
        if ($stm->rowCount()) {
            return TRUE;
        }else{
            return FALSE; 
        }
        
    }
    
    function GetUserByEmail($Getemail)
    {
        $ChkEmail = "select * from users where email = '$Getemail'";
        $stm = $this->openConn->prepare($ChkEmail);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
        
    }
    
    
    function GetWAHClubUserByEmail($Getemail)
    {
        $ChkEmail = "select * from users where email = '$Getemail'";
        $stm = $this->SecndopenConn->prepare($ChkEmail);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
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
    
     
    function RegisterUser()
    {
        $name = $_POST['name']; 
        $phoneCode = $_POST['phoneCode'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $Getpassword = $_POST['password'];
        $linkedin = $_POST['linkedin'];
         
        $hashedPassword = password_hash($Getpassword, PASSWORD_BCRYPT); 
        
        $date = date("Y-m-d");
        
        $OTP = $this->generateOTP();
        $_SESSION['UEmail'] = $_POST['email'];
		$_SESSION['UName'] = $_POST['name'];
		$_SESSION['Mailotp'] = $OTP;
		$_SESSION['Mailotp_time'] = time();
        
        
        $sql = "INSERT INTO `users`(`name`, `dialcode`, `phone`, `email`, `password`, `linkedin`, `created_at`, `otp`)VALUES(:name, :phoneCode, :phone, :email, :password, :linkedin, :date, :OTP)";
        
        $stm = $this->openConn->prepare($sql);
        
        $stm->bindParam(":name", $name); 
        $stm->bindParam(":phoneCode", $phoneCode);
        $stm->bindParam(":phone", $phone);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":password", $hashedPassword);
        $stm->bindParam(":linkedin", $linkedin);
        $stm->bindParam(":date", $date);  
        $stm->bindParam(":OTP", $OTP);  
        
        $stm->execute();
        if ($stm->rowCount()) {
            
            $mailResp = $this->SendVerificationOtpMail($email, $OTP);
            
            return "Success";
        } else {
            return "Error";
        }  
    }
    
    function VerifyAccountWithOTP($OTP, $Email){
        
        $sql = "SELECT * FROM `users` WHERE `email` = '$Email' && `otp` = '$OTP'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            if (isset($_SESSION['Mailotp_time'])) { 
                $currentTime = time();
                $otpTime = $_SESSION['Mailotp_time'];
                $validityPeriod = 15 * 60; // 15 minutes in seconds
    
                if (($currentTime - $otpTime) <= $validityPeriod) {
                    
                    $sql = "UPDATE `users` SET `isverified` = 1 WHERE `email` = '$Email'";
                    $stm = $this->openConn->prepare($sql);
                    $stm->execute();
                    
                    return "SUCCESS";
                }else{
                    return "ERROR"; //OTP Expired
                }
            }
        }
        
        return "ERROR1";
    }
    
    //FORGOT PASSWORD
    function SendOtpForgotPassword($Email){
        
        $sql = "SELECT email FROM `users` WHERE `email` = '$Email'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            $OTP = $this->generateOTP();
            $_SESSION['UEmail'] = $_POST['email'];
    		$_SESSION['Mailotp'] = $OTP;
    		$_SESSION['Mailotp_time'] = time();
    		$mailResp = $this->SendVerificationOtpMail($Email, $OTP);
            return "SUCCESS";
        }
        return "ERROR";
    }
    
    
    
    function Userlogin($Getemail, $Getpassword)
    {
        $emailID = $Getemail; 
        $get_res = executeQuery("SELECT * FROM `users` WHERE `email` = '$emailID'");
        $get_rowsRD = mysqli_fetch_array($get_res);
        $get_num = mysqli_num_rows($get_res);
        
        if ($get_num > 0) {
                
             if ($get_rowsRD['isverified'] == 1) {
                
                if (password_verify($Getpassword, $get_rowsRD['password'])) {
                    
                    $_SESSION['expire'] = time() + (60 * 30);
                    $_SESSION['userid'] = $get_rowsRD['id'];
                    $_SESSION['email'] = $get_rowsRD['email'];
                    
                if ($get_rowsRD['ClubId'] != '') {
                    $_SESSION['club_userid'] = $get_rowsRD['ClubId'];
                }
                    $resp['sucmsg'] = "Logged in successfully";
                    $resp['login_status'] = 'Success';
                } else {
                    $resp['login_status'] = 'Error';
                    $resp['errmsg'] = "Password error!";
                }
                
            } else {
                $resp['login_status'] = 'Error';
                $resp['errmsg'] = "Account Not Verified, Kindly Verify your Account! <a href='/verifyaccount.php' class='btn btn-primary'>Verify Now</a>";
            }
             
        } else {
            $resp['login_status'] = 'Error';
            $resp['errmsg'] = "Account Not Found";
        }
        return $resp;
    }
    
    
    
    function UserloginWithSocial($Getemail)
    {
        $emailID = $Getemail; 
        $get_res = executeQuery("SELECT * FROM `users` WHERE `email` = '$emailID'");
        $get_rowsRD = mysqli_fetch_array($get_res);
        $get_num = mysqli_num_rows($get_res);
        
            if ($get_num > 0) {
                 
                    $_SESSION['expire'] = time() + (60 * 30);
                    $_SESSION['userid'] = $get_rowsRD['id'];
                    $_SESSION['email'] = $get_rowsRD['email'];
            if ($get_rowsRD['ClubId'] != '') {
                $_SESSION['club_userid'] = $get_rowsRD['ClubId'];
            }
                    $resp['sucmsg'] = "Logged in successfully";
                    $resp['login_status'] = 'Success';
                 
             
        } else {
            $resp['login_status'] = 'Error';
            $resp['errmsg'] = "Account Not Found";
        }
        return $resp;
    }
    
    
    
    
    function UsersignupWithLinkedin($name, $email, $platform, $profileid, $token)
    {
        $one = 1;
        $date = $this->datetime;
        $OTP = 111111;
        $sql = "INSERT INTO `users`(`name`, `email`, `created_at`, `otp`, `isverified`)VALUES(:name, :email, :date, :OTP, :isverified)";
        
        $stm = $this->openConn->prepare($sql);
        
        $stm->bindParam(":name", $name);  
        $stm->bindParam(":email", $email);    
        $stm->bindParam(":date", $date);  
        $stm->bindParam(":OTP", $OTP); 
        $stm->bindParam(":isverified", $one); 
        
        $stm->execute();
        if ($stm->rowCount()) {
            
            $insertedId = $this->openConn->lastInsertId();
            
            $_SESSION['expire'] = time() + (60 * 30);
            $_SESSION['userid'] = $insertedId;
            $_SESSION['email'] = $email;
            
            $sql2 = "INSERT INTO `userTokens`(`userid`, `platform`, `profile_id`, `access_token`, `datetime`)VALUES(:userid, :platform, :profile_id, :access_token, :datetime)";
            
            $stm2 = $this->openConn->prepare($sql2);
            $stm2->bindParam(":userid", $insertedId);  
            $stm2->bindParam(":platform", $platform);    
            $stm2->bindParam(":profile_id", $profileid);    
            $stm2->bindParam(":access_token", $token);  
            $stm2->bindParam(":datetime", $date);   
            
            $stm2->execute(); 
            
            return "Success";
        } else {
            return "Error";
        }  
    }
    
    
    
    
    
    function ChangePassword($Getpassword, $UserId)
    {
        // $password = md5($Getpassword);
        // $sha1 = sha1($password);
        
        $hashedPassword = password_hash($Getpassword, PASSWORD_BCRYPT); 
        
        $sql = "UPDATE `users` SET `password` = '$hashedPassword' WHERE `id` = '$UserId'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            unset($_SESSION['expire']);
            unset($_SESSION['userid']);
            unset($_SESSION['email']);
            
            return "SUCCESS";
        } else {
            return "ERROR";
        }
    }
    
    
    function verifyUser($VRFToken, $UserMail){
        
        $get_res = executeQuery("SELECT * FROM `users` WHERE `email` = '$UserMail'");
        $get_num = mysqli_num_rows($get_res);
        
        if ($get_num > 0) {
            
        $get_rowsRD = mysqli_fetch_array($get_res);
        
        if($get_rowsRD['varified'] === "true"){
            return "AlreadyVerified";
        }else{ 
            $TRUE = "true";
            $SQL = executeQuery("UPDATE `users` SET `varified`='$TRUE' WHERE `email` = '$UserMail'");
            
            if($SQL){
                return "Success";
            }else{
                return "Error";
                //Error while Updation
            }
            
        }//AlreadyVerified
            
        }else{
            //Envalid Email
            return "Error";
        }
    }
    
    function ResendVerification($Getemail){
        
      $get_res = executeQuery("SELECT * FROM `users` WHERE `email` = '$Getemail'");
      $get_num = mysqli_num_rows($get_res);
      if ($get_num > 0) {
        // Generate a random verification token
        $token = bin2hex(random_bytes(32));
        
    // Store the token and email in the session for verification later
        $_SESSION['verification_token'] = $token;
        $_SESSION['verification_email'] = $Getemail;
    	$_SESSION['verification_timestamp'] = time();
        
    // Send verification email with link
        $to = $Getemail;
        $subject = 'Please verify your email address';
        $message = 'Just a quick verification! To activate your account, simply click the link to verify your email: https://www.wahstory.com/user.verify.php?token=' . $token;
        $headers = 'From: info@wahstory.com' . "\r\n" .
                   'Reply-To: info@wahstory.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
            if (mail($to, $subject, $message, $headers)) {
                return "Success";
            } else {
                return "Error";
            }
        
        //CheckEmailInUser 
        }else{
            return "Error";
        }
    }
    
    
    function resetPass()
    {
        
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        
        $token = bin2hex(random_bytes(32));// Implement this function
        
        $_SESSION['resetPass_token'] = $token;
        $_SESSION['resetPass_email'] = $email;
    	$_SESSION['resetPass_timestamp'] = time();
        
        
        $resetLink = "https://v2.wahstory.com/resetpass.php?token=$token";
        $sql = "SELECT email from users where email = '$email'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            $to = $email;
        $subject = 'Reset your password | WAHStory';
        $message = 'Click the following link to reset your password: '. "\r\n" . $resetLink;
        $headers = 'From: info@wahstory.com' . "\r\n" .
                   'Reply-To: info@wahstory.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
            if (mail($to, $subject, $message, $headers)) {
                return "Success";
            } else {
                return "Error";
            }
            
        } else{
            return "Error";
        }
    }
    
    
    
    function UpgradeUserAcc($id, $name)
    {

        $sql = "select id from users where id = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
        $one = 1;
            $get_res_POST = executeQuery("UPDATE `users` SET `upgradeRequest` = '$one' WHERE `id` = '$id'");
            
            
        $maildata = array();
        $maildata["sender"] = array(
            "email" => "info@wahstory.com",
            "name" => "WAHStory"
            );
                          
        $maildata["receiver"] = array(
            array(
                "email" => "akshaybhatia@elementshrs.com",
                "name" => "WAHStory" 
                )
            );
            
            
            $maildata["subject"] = "Request to Upgrade Account!";
			
			$maildata['bodymessage'] = $name. ' has requested to Upgrade their account to Premium.';
			
			SendMailBySMTP($maildata);
			return 'success';
            
            
        }
    }
    
    
    
    function CheckUpgradeUserAcc($id)
    {

        $sql = "select id,upgradeRequest from `users` where `id` = '$id' && upgradeRequest = 1";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
            
    }
    
    
    function GetstoryreactionCountByUID($userid)
    { 
            $sql = "SELECT * FROM `storyreactions` WHERE `userid` = '$userid'";
            
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            
            if ($stm->rowCount()) {
                return $stm->rowCount();
            } else {
                return NULL;
            } 
    }
    
    
    function GetreactedstoriesByUID($userid)
    { 
            $sql = "SELECT * FROM `storyreactions` WHERE `userid` = '$userid'";
            
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            
            if ($stm->rowCount()) {
                $data = $stm->fetchAll();
                return $data;
            } else {
                return NULL;
            } 
    }
    
    
    function GetstorySaveCountByUID($userid)
    { 
            $date = date("Y-m-d");
            
            $sql = "SELECT * FROM `postbookmarks` WHERE `userid` = '$userid'";
            
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            
            if ($stm->rowCount()) {
                return $stm->rowCount();
            } else {
                return NULL;
            } 
    }
    
    
    function GetsavededstoriesByUID($userid)
    { 
            $date = date("Y-m-d");
            
            $sql = "SELECT * FROM `postbookmarks` WHERE `userid` = '$userid'";
            
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            
            if ($stm->rowCount()) {
                $data = $stm->fetchAll();
                return $data;
            } else {
                return NULL;
            } 
    }
    
    
    function GetstoryreactionByUID($storyid, $userid)
    {
       $sql = executeQuery("SELECT * FROM `storyreactions` WHERE `storyid` = '$storyid' && `userid` = '$userid'");
       $get_num = mysqli_num_rows($sql);
       $data = mysqli_fetch_array($sql);
        
        if ($get_num > 0) {
            return $data;
        }else{
            return NULL;
        }
    }
    function GetstorySavedByUID($storyid, $userid)
    {
       $sql = executeQuery("SELECT * FROM `postbookmarks` WHERE `storyid` = '$storyid' && `userid` = '$userid'");
       $get_num = mysqli_num_rows($sql);
       $data = mysqli_fetch_array($sql);
        
        if ($get_num > 0) {
            return $data;
        }else{
            return NULL;
        }
    }
    
    
    
    function getAllContentSuggestion()
    {
        $sql = "select * from content_suggestion";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
    }
    function getContentSuggestionByUser($userId)
    {
        $sql = "select * from content_suggestion where userid = '$userId'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        } 
    }
    function getContentSuggestionByUsernStatus($userId, $status)
    {
        $sql = "select * from content_suggestion where userid = '$userId' && is_posted = '$status'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function getContentSuggestionById($id)
    {

        $sql = "select * from content_suggestion where id = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function UpdateContentSuggestionStatus($rowID){
        
        $sql = "UPDATE content_suggestion SET is_posted = 1 WHERE id = :rowid";
        
        $stm = $this->openConn->prepare($sql);
        
        $stm->bindParam(":rowid", $rowID); 
        $stm->execute();
        if ($stm->rowCount()) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
    }
    
    
    
    function getAllCountries()
    {
        $sql = "SELECT * FROM `countries`";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function UpdateProfile($UserId){
        
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $bio = $_POST['bio'];
        
        $linkedin = $_POST['linkedinurl'];
        $fbid = $_POST['fburl'];
        $instagram = $_POST['instaurl'];
        $twitterid = $_POST['twitterurl']; 
        $youtubechannel = $_POST['youtubechannel']; 
        $tiktokurl = $_POST['tiktokurl']; 
        
        $sql = "UPDATE `users` SET `name` = :name, `phone` = :phone, `gender` = :gender, `city` = :city, `country` = :country, `bio` = :bio, `linkedin` = :linkedin, `inatagramid` = :instagram, `fbid` = :fbid, `twitterid` = :twitterid,  `youtubechannel` = :youtubechannel,  `tiktokurl` = :tiktokurl WHERE `id` = '$UserId'";
        
        $stm = $this->openConn->prepare($sql);
        $stm->bindParam(":name", $name); 
        $stm->bindParam(":phone", $phone);
        $stm->bindParam(":gender", $gender);
        $stm->bindParam(":city", $city);
        $stm->bindParam(":country", $country);
        $stm->bindParam(":bio", $bio);
        $stm->bindParam(":linkedin", $linkedin);
        $stm->bindParam(":fbid", $fbid);
        $stm->bindParam(":instagram", $instagram);
        $stm->bindParam(":twitterid", $twitterid);
        $stm->bindParam(":youtubechannel", $youtubechannel);
        $stm->bindParam(":tiktokurl", $tiktokurl); 
        $stm->execute();
        if ($stm->rowCount()) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    
    
    function GetUserStoryById($UserId)
    {
       $sql = "SELECT * FROM `stories` WHERE `userid` = '$UserId'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return NULL;
        }
    }
    
    function getStoryCatById($catid)
    {
       $sql = "SELECT * FROM `categories` WHERE `id` = '$catid'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return NULL;
        }
         
    }
    
    function getStoryEngages($storyid)
    {
       $sql = "SELECT id,likes,views FROM `stories` WHERE `id` ='$storyid'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) { 

            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return NULL;
        }
    }
    
    /*function getStoryTotalVotes($storyid)
    {
       $sql = "SELECT * FROM `storyvotes` WHERE `storyid` ='$storyid'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) { 

            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }else{
            return NULL;
        }
       
    }*/
    
    function getStoryProducts($storyid)
    {
       $sql = "SELECT * FROM `storyproduct` WHERE `storyid` = '$storyid'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) { 
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
    
    function getStoryGallery($storyid)
    {
       $sql = "SELECT * FROM `storygallery` WHERE `storyid` = '$storyid'";
       $stm = $this->openConn->prepare($sql);
       $stm->execute();
        if ($stm->rowCount()) { 
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
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
    
    
    function CreateCommunity(){
        
        $CName = $_POST['CName'];
        $CDescription = $_POST['CDescription'];
        $UserID = $_SESSION['userid'];
        $datetime = date("Y-m-d H:i");
        
        $SQL = executeQuery("INSERT INTO `community`(`Name`, `Description`, `CreatorUserID`, `CreationDate`)values('$CName', '$CDescription', '$UserID', '$datetime')");
        
        if ($SQL) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    function JoinCommunity(){
        
        $CMId = $_POST['CMId'];
        $Role = $_POST['Role'];
        $UserID = $_SESSION['userid'];
        $datetime = date("Y-m-d H:i");
        
        $SQL = executeQuery("INSERT INTO `communityMembers`(`UserId`, `CommunityID`, `JoinDate`, `Role`)values('$UserID', '$CMId', '$datetime', '$Role')");
        
        if ($SQL) {
            return 'SUCCESS';
        }else{
            return 'ERROR';
        }
        
    }
    
    
    function UpdateProfilePic($Userid){
        
        if(!empty($_FILES['file'])){
        
            $file = $_FILES['file'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "../images/users/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $imageFile = $finalImgName;
                }
            }
            $sql = executeQuery("UPDATE `users` SET `profile_image` = '$imageFile' WHERE `id` = '$Userid'");
            if($sql){
    	        return "SUCCESS";
            }else{
                return "ERROR";
            }
        }
    }
    
    
    
    
    function getCorporateNews($Order, $limit, $offset)
    {
        if($limit){
            $sql = "SELECT id,title,image,imageURL,caption,sourceURL FROM corporatenews ORDER BY `id` ".$Order." LIMIT ".$limit." OFFSET ".$offset; 
        }else{
            $sql = "SELECT id,title,image,imageURL,caption,sourceURL FROM corporatenews ORDER BY `id` ".$Order; 
        }
        

        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
    
    
    function getCompleteURL() {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $port = $_SERVER['SERVER_PORT'];
        $requestUri = $_SERVER['REQUEST_URI'];
        
        // Check if the port should be included in the URL
        if (($scheme === "http" && $port != 80) || ($scheme === "https" && $port != 443)) {
            $host .= ":" . $port;
        }
    
        return $scheme . "://" . $host . $requestUri;
    }

    
    
    
    //Get All ClubUsers:
    
    function GetAllClubPreUser()
    {
        $ChkEmail = "select * from wahclub";
        $stm = $this->openConn->prepare($ChkEmail);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
        
    }
    
    
    
    function PushClubPreUserInWAHClub($preUserEmail)
    {
        
        $preuser =  $this->GetWahclubPreUserByEmail($preUserEmail);
        
        $slugUsername = $this->createUniqueSlug($preuser['firstname'], $preuser['lastname']);
                
		$fname = $preuser['firstname'];
		$lname = $preuser['lastname'];
		$dialcode = $preuser['dialcode'];
		$phone = $preuser['phone'];
		$email = $preuser['email'];
		
	$wahclubuser =  $this->GetWAHClubUserByEmail($preUserEmail);
		
	if($wahclubuser === FALSE && $email != '') {
	  	
		$sql1 = "insert into users(`firstname`, `lastname`, `slug_username`, `dialcode`, `phone`, `email`) values('$fname', '$lname', '$slugUsername', '$dialcode', '$phone', '$email')";
								
		$stm1 = $this->SecndopenConn->prepare($sql1);
		$stm1->execute();
		if ($stm1->rowCount()) {
		    
		    $ClubId = $this->SecndopenConn->lastInsertId();
		    
		    $UserRegistered = $this->GetUserByEmail($preUserEmail);
					  
    		$plainPassword = bin2hex(random_bytes(6)); 
            $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
    			  
    		if($UserRegistered === FALSE){ 
    			 
    			 $name = $preuser['firstname'] .' '. $preuser['lastname'];
    			 $phone = $preuser['dialcode'] .' '. $preuser['phone']; 
    			 $email = $preUserEmail;
    			 $socialid = $preuser['socialprofile'];
    			 $date = $preuser['date'];
    			 
    			  
    			$sql2 = "INSERT INTO `users`(`name`, `phone`, `email`, `password`, `linkedin`, `ClubId`, `created_at`)VALUES(:name, :phone, :email, :password, :linkedin, :ClubId, :date)";
                
                $stm2 = $this->openConn->prepare($sql2);
                
                $stm2->bindParam(":name", $name); 
                $stm2->bindParam(":phone", $phone);
                $stm2->bindParam(":email", $email); 
                $stm2->bindParam(":password", $hashedPassword); 
                $stm2->bindParam(":linkedin", $socialid);  
                $stm2->bindParam(":ClubId", $ClubId);  
                $stm2->bindParam(":date", $date);
                
                $stm2->execute();
    			if ($stm2->rowCount()) {
    			    echo "<p> Name: ". $name ."</p>";
    			    echo "<p> Email: ". $email ."</p>";
    			    echo "<p> Password: ". $plainPassword ."</p>";
    			    echo "<p> <br> </p>";
    			}
    			
    		}else{
    		                   
                $sql3 = "UPDATE `users` SET `password` = '$hashedPassword' AND `ClubId` = '$ClubId' WHERE id = '".$UserRegistered['id']."'";
                
                $stm3 = $this->openConn->prepare($sql3);
                
                $stm3->execute();
                if ($stm3->rowCount()) {
    			    echo "<p> Name: ". $UserRegistered['name'] ."</p>";
    			    echo "<p> Email: ". $UserRegistered['email'] ."</p>";
    			    echo "<p> Password: ". $plainPassword ."</p>";
    			    echo "<p> <br> </p>";
    			    
    			}
    		}
		    
		}else{
		    echo "<br> Club was unable to insert <br> ";
		}
		
	}else{
	    echo "some error <br>";
	} //Checking If User Already in WAHClub User
		
		
    }//End Function
    
    
    
    function GetWAHClubAllUsers()
    {
        $sql = "select * from users";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    
    
    function ChangePasswordBulk($EmailId){
        
        $Getpassword = 'WAH@Club12';	
	
    	$hashedPassword = password_hash($Getpassword, PASSWORD_BCRYPT); 
            
        $sql = "UPDATE `users` SET `password` = '$hashedPassword' WHERE `email` = '$EmailId'";
        
        $stm3 = $this->openConn->prepare($sql);
                
                $stm3->execute();
                if ($stm3->rowCount()) {
                    return "success";
                }
        
    }
    
    
    
    
    function PostWahstoryContestMoment() {
        $imageFile = null; // Initialize $imageFile
    
        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName = str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "assets/images/contest/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
    
            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    $imageFile = $finalImgName; // Set $imageFile only if upload is successful
                } else {
                    return 'upload_error'; // Return error if file upload fails
                }
            } else {
                return 'invalid_file_type'; // Return error for invalid file type
            }
    
            $name = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $datetime = date("Y-m-d H:i");
    
            $sql = "INSERT INTO `wahcontest`(`name`, `phone`, `email`, `img`, `date`) VALUES (:name, :phone, :email, :image, :date)";
            $stm = $this->openConn->prepare($sql);
            
            // Bind parameters
            $stm->bindParam(":name", $name); 
            $stm->bindParam(":phone", $phone);
            $stm->bindParam(":email", $email);         
            $stm->bindParam(":image", $imageFile);         
            $stm->bindParam(":date", $datetime);         
    
            // Execute statement
            $stm->execute();
    
            if ($stm->rowCount()) {
                return "success";
            } else {
                return 'error'; // Return error if insert fails
            }
    
        } else {
            return 'error'; // Return error if no file is uploaded
        }
    }
    
    
    
    
    
    function GetWAHClubUserSocialsById($user_id)
    {
        $sql = "SELECT * FROM `sociallinks` WHERE `user_id` = '$user_id'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    
    
// ####################################### INDUSTRY 
   // ####################################### INDUSTRY 
    
    function UpdateSelectedIndustry($industry_id, $user_id)
    {
        $sql = "INSERT INTO `industry_user` (user_id, industry_id) VALUES (:user_id, :industry_id)";
        
        $stm = $this->SecndopenConn->prepare($sql);
         
        $stm->bindParam(':user_id', $user_id);
        $stm->bindParam(':industry_id', $industry_id);
        
        $stm->execute();
        
        return "SUCCESS";
    }
   
   
    function DeleteAllIndustryByUser($user_id)
    {
        $sql1 = "DELETE FROM `industry_user` WHERE `user_id` = :user_id";
        
        $stm1 = $this->SecndopenConn->prepare($sql1);
        
        $stm1->bindParam(":user_id", $user_id);  
         
        if($stm1->execute()) {
            return "success";
        }
       return "error";
    }    
    
    function GetWAHClubAllIndustries()
    {
        $sql = "SELECT * FROM `industries`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    
    function GetWAHClubUserIndustryById($user_id)
    {
        $sql = " SELECT iu.*, i.industry FROM `industry_user` iu JOIN `industries` i ON iu.industry_id = i.id WHERE iu.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    
    
    

   // ####################################### HOBBIES 
   // ####################################### HOBBIES 
    
    function GetWAHClubAllHobbies()
    {
        $sql = "SELECT * FROM `hobbies`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    function GetHobbyByUserId($user_id)
    {
        $sql = " SELECT hu.*, h.hobby FROM `hobby_user` hu JOIN `hobbies` h ON hu.hobby_id = h.id WHERE hu.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    

   // ####################################### SKILLS 
   // ####################################### SKILLS 
   
   function UpdateSelectedSkills($skills, $user_id)
    {
    
        $sql = "INSERT INTO `skill_user` (user_id, skill_id) VALUES (:user_id, :skill_id)";
        
            $stm = $this->SecndopenConn->prepare($sql);
            
            foreach ($skills as $skill_id) {
                $stm->bindParam(':user_id', $user_id);
                $stm->bindParam(':skill_id', $skill_id);
                
                $stm->execute();
            }
                return "SUCCESS";
        
    
    }
   
    function DeleteAllSkillsByUser($user_id)
    {
        
        $sql1 = "DELETE FROM `skill_user` WHERE `user_id` = :user_id";
        
        $stm1 = $this->SecndopenConn->prepare($sql1);
        
        $stm1->bindParam(":user_id", $user_id);  
         
        if($stm1->execute()) {
            return "success";
        }
       
       return "error";
    }    
    
    function GetWAHClubAllSkills()
    {
        $sql = "SELECT * FROM `skills`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    function GetWAHClubUserSkillById($user_id)
    {
        $sql = " SELECT su.*, s.skill FROM `skill_user` su JOIN `skills` s ON su.skill_id = s.id WHERE su.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    
   // ####################################### TOOLS 
   // ####################################### TOOLS 
    
    function UpdateSelectedTools($tools, $user_id)
    {
        $sql = "INSERT INTO `tool_user` (user_id, tool_id) VALUES (:user_id, :tool_id)";
        
            $stm = $this->SecndopenConn->prepare($sql);
            
            foreach ($tools as $tool_id) {
                $stm->bindParam(':user_id', $user_id);
                $stm->bindParam(':tool_id', $tool_id);
                
                $stm->execute();
            }
                return "SUCCESS";
    }
   
   
    function DeleteAllToolsByUser($user_id)
    {
        
        $sql1 = "DELETE FROM `tool_user` WHERE `user_id` = :user_id";
        
        $stm1 = $this->SecndopenConn->prepare($sql1);
        
        $stm1->bindParam(":user_id", $user_id);  
         
        if($stm1->execute()) {
            return "success";
        }
       
       return "error";
    }    
    
    function GetWAHClubAllTools()
    {
        $sql = "SELECT * FROM `tools`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }
    
    function GetWAHClubUserToolSById($user_id)
    {
        $sql = "SELECT tu.*, t.tool FROM `tool_user` tu JOIN `tools` t ON tu.tool_id = t.id WHERE tu.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
    }
    


// ####################################### TOOLS 
   // ####################################### TOOLS 
    
    function UpdateSelectedAttributes($attributes, $user_id)
    {
        $sql = "INSERT INTO `attribute_user` (user_id, attribute_id) VALUES (:user_id, :attribute_id)";
        
            $stm = $this->SecndopenConn->prepare($sql);
            
            foreach ($attributes as $attribute_id) {
                $stm->bindParam(':user_id', $user_id);
                $stm->bindParam(':attribute_id', $attribute_id);
                
                $stm->execute();
            }
                return "SUCCESS";
    }
   
   
    function DeleteAllAttributesByUser($user_id)
    {
        
        $sql1 = "DELETE FROM `attribute_user` WHERE `user_id` = :user_id";
        
        $stm1 = $this->SecndopenConn->prepare($sql1);
        
        $stm1->bindParam(":user_id", $user_id);  
         
        if($stm1->execute()) {
            return "success";
        }
       
       return "error";
    }    
    
    function GetWAHClubAllAttributes()
    {
        $sql = "SELECT * FROM `attributes`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
        }
    }

    function GetUserAttributesById($user_id)
    {
        $sql = "
        SELECT au.*, a.attribute, a.description 
        FROM `attribute_user` au 
        JOIN `attributes` a ON au.attribute_id = a.id 
        WHERE au.user_id = :user_id
        ";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUserExperienceSById($user_id)
    {
        $sql = "SELECT * FROM `experiences` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUserEducationById($user_id)
    {
        $sql = "SELECT * FROM `education` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUserProjectsById($user_id)
    {
        $sql = "SELECT * FROM `projects` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUserAwardsById($user_id)
    {
        $sql = "SELECT * FROM `awards` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUsertestimonialsById($user_id)
    {
        $sql = "SELECT * FROM `testimonials` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    function GetUserblogsById($user_id)
    {
        $sql = "SELECT * FROM `blogs` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return FALSE; 
        }
    }
    
    
    function GetUserClubStoryById($user_id)
    {
        $sql = "SELECT * FROM `stories` WHERE user_id = :user_id";
    
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return FALSE; 
        }
    }
    
    
    
    
   
   
   // ##############################################################
   // ##############################################################
   // ##################### User Dashboard #########################
   // ##############################################################
   // ##############################################################
   
   
   function UpdateProfilePhoto($Userid){
        
        if(!empty($_FILES['file'])){
        
            $file = $_FILES['file'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDestOld = "../images/users/" . $finalImgName;
            
            $fileDestClub = "../wahclub/public/img/photos/". $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('jpg', 'jpeg', 'png', 'webp');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDestOld)) {  
                    
                    copy($fileDestOld, $fileDestClub);
                    
                    $imageFile = $finalImgName;
                } 
            }
             
            
            $sql = executeQuery("UPDATE `users` SET `profile_image` = '$imageFile' WHERE `id` = '$Userid'");
            
            if($sql){
                
                $urow = $this->getUserDetailsById($Userid);
                $email = $urow['email'];
                
                $sql2 = "UPDATE `users` SET `photo` = '$imageFile' WHERE `email` = '$email'";
                $stm = $this->SecndopenConn->prepare($sql2);
                $stm->execute();
                if ($stm->rowCount()) {
                    
                    return "SUCCESS";
                    
                }else{
                    return "ERROR";
                }
                
    	        
            }else{
                return "ERROR";
            }
        }
    }
   
   
   function getIndustrybyuserId($userid) {
       
        $sql = "SELECT i.id, i.industry FROM industries i JOIN industry_user iu ON i.id = iu.industry_id WHERE iu.user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            return $stm->fetch();
            
        }else{
            return FALSE;
        }
   }
   
   
  function getSkillsbyuserId($userid) {
       
        $sql = "SELECT s.id, s.skill FROM skills s JOIN skill_user su ON s.id = su.skill_id WHERE su.user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            return $stm->fetchAll();
            
        }else{
            return FALSE;
        }
  }
   
  function getToolsbyuserId($userid) {
       
        $sql = "SELECT t.id, t.tool FROM tools t JOIN tool_user tu ON t.id = tu.tool_id WHERE tu.user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            
            return $stm->fetchAll();
            
        }else{
            return FALSE;
        }
  }
   
   function getAttributesbyuserId($userid) {
       
        $sql = "SELECT a.id, a.attribute FROM attributes a JOIN attribute_user au ON a.id = au.attribute_id WHERE au.user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return FALSE;
        }
   }
   
   function getAllExperiencesbyuserId($userid) {
       
        $sql = "SELECT * FROM `experiences` WHERE user_id = '$userid' ORDER BY `durationfrom` DESC";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return FALSE;
        }
   }
   
   function getAlleducationbyuserId($userid) {
       
        $sql = "SELECT * FROM `education` WHERE user_id = '$userid' ORDER BY `yearfrom` DESC";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return FALSE;
        }
   }
   
   function getAllprojectsbyuserId($userid) {
       
        $sql = "SELECT * FROM `projects` WHERE user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return FALSE;
        }
   }
   
   function getAllawardsbyuserId($userid) {
       
        $sql = "SELECT * FROM `awards` WHERE user_id = '$userid'";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return FALSE;
        }
   }
   
   //Update Notification Status as Read and Unread
    function UpdateNotificationStatus($useremail, $status){
        
        $clubuser = $this->GetWAHClubUserByEmail($useremail);
        $userid = $clubuser['id'];
        
        $sql = "UPDATE `notifications` SET `isread` = :status WHERE `receiver_id` = :receiverid";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":receiverid", $userid); 
        $stm->bindParam(":status", $status); 
        $stm->execute();
        if ($stm->rowCount()) {
            return "success";
        }else{
            return "error";
        }
        
    }
    
    
    function GetAllNotificationsById($useremail, $status){
        
        $clubuser = $this->GetWAHClubUserByEmail($useremail);
        $userid = $clubuser['id'];
        
        $sql = "SELECT * FROM `notifications` WHERE `receiver_id` = :receiverid AND `isread` = :status" ;
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":receiverid", $userid); 
        $stm->bindParam(":status", $status); 
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return NULL;
        }
    }
    
    function GetNotificationById($notificationid){ 
       
        $sql = "SELECT * FROM `notifications` WHERE `id` = :id" ;
        
        $stm = $this->SecndopenConn->prepare($sql);
        
        $stm->bindParam(":id", $notificationid);  
        
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetch();
        }else{
            return NULL;
        }
    }
     
     
    function DeleteNotificationById(){
        
        $notificationID = $_POST['notificationID'];
        
       if($notificationID) {
           
            $sql = "DELETE FROM `notifications` WHERE `id` = :notificationID";
            
            $stm = $this->SecndopenConn->prepare($sql);
            
            $stm->bindParam(":notificationID", $notificationID);  
             
            if ($stm->execute()) {
                return "success";
            } else {
                return "error";
            }
       }
        
    }
    
     
     function Getfollowers($userid)
    {
        $sql = "SELECT id, followerid FROM communitypeoplefollow WHERE memberid = '$userid'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return NULL;
        }
        
    }  
     
     
    function GetAllConnectionsByUserId($clubuserId, $status){
        if(!empty($clubuserId)) {
            if($status == 0) {
                $sql = "SELECT * FROM `connections` WHERE `user_id_2` = :memberid AND `status` = :status" ;
            } else {
                $sql = "SELECT * FROM `connections` WHERE (`user_id_2` = :memberid OR `user_id_1` = :memberid) AND `status` = :status" ;
            }
            
        
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(":memberid", $clubuserId); 
            $stm->bindParam(":status", $status); 
            $stm->execute();
            if ($stm->rowCount()) {
                return $stm->fetchAll();
            }else{
                return NULL;
            }
        }
        return NULL;
    } 
    
     
    function GetConnectionInvitationById($invid){
         
        $sql = "SELECT * FROM `connections` WHERE `id` = :id" ;
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":id", $invid); 
        
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetch();
        }else{
            return NULL;
        }
    }
     
    
    function UpdateConnectionInvitation($status){
        
        $invitationid = $_POST['invitationid'];
        
       if($invitationid) {
           
            $sql = "UPDATE `connections` SET `status` = :status WHERE `id` = :id";
            
            $stm = $this->SecndopenConn->prepare($sql);
            
            $stm->bindParam(":id", $invitationid);
            $stm->bindParam(":status", $status); 
             
            if ($stm->execute()) {
              
            if($status == 1) {
                
                $invitationrow = $this->GetConnectionInvitationById($invitationid);
                
                $senderid = $invitationrow['user_id_2'];
                $receiverid = $invitationrow['user_id_1']; 
                
                $sender = $this->GetWAHClubUserById($senderid);
                
                $sendername = $sender['firstname'] . ' ' . $sender['lastname'];
            
                
            
                $notification = $sendername." accepted your invitation to connect";
                
                $status = 0;
                
                $datetime = date("Y-m-d H:i:s");
                
                $sql = "INSERT INTO `notifications`(`sender_id`, `receiver_id`, `notification`, `isread`, `created_at`, `updated_at`) VALUES (:sender_id, :receiver_id, :notification, :status, :date, :date)";
                
                $stm2 = $this->SecndopenConn->prepare($sql);
                
                // Bind parameters
                $stm2->bindParam(":sender_id", $senderid); 
                $stm2->bindParam(":receiver_id", $receiverid);
                $stm2->bindParam(":notification", $notification);
                $stm2->bindParam(":status", $status);
                $stm2->bindParam(":date", $datetime);
                
                if ($stm2->execute()) {
                    return "success";
                }
            } //status
                return "success";
            } else {
                return "error";
            }
       }
        
    }
   
   
   function ClubProfileProcess(){
		
		$WAHCLUBUSER = $this->GetWAHClubUserByEmail($_SESSION['email']);          
        $process = 0;  
		
        if($WAHCLUBUSER !== FALSE){  
        
            if ($WAHCLUBUSER['title'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['firstname'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['lastname'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['photo'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['phone'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['email'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalexperience'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalproject'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalproject'] != ''){
                $process += 4.34; 
            }
            if ($WAHCLUBUSER['totalawards'] != ''){
                $process += 4.34; 
            } 
        
        $usersocials = $this->GetWAHClubUserSocialsById($WAHCLUBUSER['id']);
        if($usersocials !== FALSE){  
            foreach ($usersocials as $usersocial) {
                $process += 2.17;
            }
        }        
        $Userindustry = $this->GetWAHClubUserIndustryById($WAHCLUBUSER['id']);
        if($Userindustry !== FALSE){  
            $process += 4.34;  
        }        
        $Userskill = $this->GetWAHClubUserSkillById($WAHCLUBUSER['id']);
        if($Userskill !== FALSE){  
            $process += 4.34; 
        }        
        $Usertools = $this->GetWAHClubUserToolSById($WAHCLUBUSER['id']);
        if($Usertools !== FALSE){ 
            foreach ($Usertools as $Usertool) {
                $process += 0.27; 
            }
        }        
        $UserAttributes = $this->GetUserAttributesById($WAHCLUBUSER['id']);
        if($UserAttributes !== FALSE){ 
            
            foreach ($UserAttributes as $UserAttribute) {
                $process += 2.17; 
            }
        }
        $UserExperiences = $this->GetUserExperienceSById($WAHCLUBUSER['id']);
        if($UserExperiences !== FALSE){
            foreach ($UserExperiences as $UserExperience) {
                $process += 1.44; 
            }
        }
        $Usereducations = $this->GetUserEducationById($WAHCLUBUSER['id']);
        if($Usereducations !== FALSE){
            foreach ($Usereducations as $Usereducation) {
                $process += 1.44; 
            }
        }
        $UserProjects = $this->GetUserProjectsById($WAHCLUBUSER['id']);
        if($UserProjects !== FALSE){
            foreach ($UserProjects as $UserProject) {
                $process += 2.17; 
            }
        }        
        $Userawards = $this->GetUserAwardsById($WAHCLUBUSER['id']);
        if($Userawards !== FALSE){
            foreach ($Userawards as $Useraward) {
                $process += 2.17; 
            }
        }        
        $testimonials = $this->GetUsertestimonialsById($WAHCLUBUSER['id']);
        if($testimonials !== FALSE){
            $process += 4.34;  
        }        
        $Userblogs = $this->GetUserblogsById($WAHCLUBUSER['id']);
        if($Userblogs !== FALSE){
            $process += 4.34;  
        }        
        $ClubStory = $this->GetUserClubStoryById($WAHCLUBUSER['id']);
        if($ClubStory !== FALSE){
            $process += 8.68;  
        }        
        $ClubProfileprocess = round($process);
        if($ClubProfileprocess > 100 ){
            $ClubProfileprocess = 100;
        }
		
		return $ClubProfileprocess;
		
	} else {
	    
	    return FALSE;
	}
	
   }
   
   
   function GetAllLetsWorkTOgetherByUser($userid){
        
        $sql = "SELECT * FROM `lets_work_queries` WHERE `user_id` = :clubuserid" ;
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return NULL;
        }
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
    
    
    function UpdateClubMemberProfileStats($userid) {
        
        $totalexperience = $_POST['totalexperience'];
        $totalproject = $_POST['totalproject'];
        $totalclients = $_POST['totalclients'];
        $totalawards = $_POST['totalawards'];
        
        
        $sql = "UPDATE `users` SET `totalexperience` = :totalexperience, `totalproject` = :totalproject, `totalclients` = :totalclients, `totalawards` = :totalawards WHERE `id` = :clubuserid";
        
        $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(":clubuserid", $userid);
            $stm->bindParam(":totalexperience", $totalexperience);
            $stm->bindParam(":totalproject", $totalproject);
            $stm->bindParam(":totalclients", $totalclients);
            $stm->bindParam(":totalawards", $totalawards);
            
            $stm->execute();
            
            if ($stm->rowCount()) {
                return "success";
            } else {
                return NULL;
            }
        
    }
    
    
    
   function UpdateClubMemberSocials($userid) {
        $links = [
            'Facebook' => $_POST['fburl'],
            'Instagram' => $_POST['instaurl'],
            'Linkedin' => $_POST['linkedinurl'],
            'Twitter' => $_POST['twitterurl'],
        ];
        
        foreach ($links as $platform => $url) {
            // Check if the record exists
            $checkSql = "SELECT COUNT(*) FROM `sociallinks` WHERE `user_id` = :clubuserid AND `platform` = :platform";
            $checkStm = $this->SecndopenConn->prepare($checkSql);
            $checkStm->bindParam(":clubuserid", $userid);
            $checkStm->bindParam(":platform", $platform);
            $checkStm->execute();
            $exists = $checkStm->fetchColumn() > 0;
    
            if ($exists) {
                // Update existing record
                $sql = "UPDATE `sociallinks` SET `link` = :url WHERE `user_id` = :clubuserid AND `platform` = :platform";
            } else {
                // Insert new record
                $sql = "INSERT INTO `sociallinks` (`user_id`, `platform`, `link`) VALUES (:clubuserid, :platform, :url)";
            }
    
            $stm = $this->SecndopenConn->prepare($sql);
            $stm->bindParam(":clubuserid", $userid);
            $stm->bindParam(":url", $url);
            $stm->bindParam(":platform", $platform);
            $stm->execute();
        }
        
        // Optionally check the final status
        if ($stm->rowCount()) {
            return "success";
        } else {
            return NULL;
        }
    }
    
    function GetAvailabilityByClubId($userid){
        
        $sql = "SELECT * FROM `availability` WHERE `user_id` = :clubuserid ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')" ;
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return NULL;
        }
    }
    
    function GetAllTimezones(){
        
        $sql = "SELECT * FROM `timezones`" ;
        $stm = $this->SecndopenConn->prepare($sql); 
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        }else{
            return NULL;
        }
    }
    
    function getusertimezonebyclubuserid($userid){
        
        $sql = "SELECT at.*, t.name, t.value, t.id FROM `avalability_timezone` at JOIN `timezones` t ON at.timezone_id = t.id WHERE at.user_id = :clubuserid";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return NULL;
        }
    }
    
    function updateAvalibilityTimezoneClubUser($userid, $timezone_id) {
        
        $update = $this->getusertimezonebyclubuserid($userid);
        
        if($update !== NULL) {
            $sql = "UPDATE `avalability_timezone` SET `timezone_id` = :timezone_id WHERE `user_id`=:clubuserid";
        } else {
            $sql = "INSERT INTO `avalability_timezone`(`user_id`, `timezone_id`) values (:clubuserid, :timezone_id)";
        }
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(":clubuserid", $userid);
        $stm->bindParam(":timezone_id", $timezone_id);
        
        if ($stm->execute()) {
            return "success";
        }else{
            return "error";
        }
    }
    
    
    function IsPaid($ClubUserId){
        
        $sql = "SELECT COUNT(*) FROM `users` WHERE `id` = :userid && `subscription_status` = :status";
        $stm = $this->SecndopenConn->prepare($sql);
         $status = 'paid';
        $stm->bindParam(":userid", $ClubUserId);
        $stm->bindParam(":status", $status);
        $stm->execute();
         $count = $stm->fetchColumn();
         return $count > 0;
        
    }
    
    public function registerWorkshopParticipant(
                $firstName,
                $lastName,
                $department,
                $title,
                $companyName,
                $companyWebsite,
                $companySize,
                $email,
                $phone,
                $expectedParticipation,
                $slotSelection,
                $companyCity,
                $companyCountry
            ) {
                try {
                    
                $status = 0;
                $datetime = date("Y-m-d H:i");
                    $sql = "INSERT INTO `event_workshop_registrations` 
                (`first_name`, `last_name`, `department`, `title`, `company_name`, `company_website`, `company_size`, `email`, `phone`, `expected_participation`, `slot_selection`, `company_city`, `company_country`, `subscription_status`, `datetime`)
                VALUES
                (:first_name, :last_name, :department, :title, :company_name, :company_website, :company_size, :email, :phone, :expected_participation, :slot_selection, :company_city, :company_country, :status, :datetime)";

                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":first_name", $firstName);
                    $stm->bindParam(":last_name", $lastName);
                    $stm->bindParam(":department", $department);
                    $stm->bindParam(":title", $title);
                    $stm->bindParam(":company_name", $companyName);
                    $stm->bindParam(":company_website", $companyWebsite);
                    $stm->bindParam(":company_size", $companySize);
                    $stm->bindParam(":email", $email);
                    $stm->bindParam(":phone", $phone);
                    $stm->bindParam(":expected_participation", $expectedParticipation);
                    $stm->bindParam(":slot_selection", $slotSelection);
                    $stm->bindParam(":company_city", $companyCity);
                    $stm->bindParam(":company_country", $companyCountry);
                    $stm->bindParam(":status", $status);
                    $stm->bindParam(":datetime", $datetime);
                    $stm->execute();
            
                    return 'success'; // Registration successful
                } catch (PDOException $e) {
                    // Optionally log $e->getMessage();
                    error_log("Error: " . $e->getMessage());
                    return 'error'; // Registration failed
                }
            }
            
    public function registerWellnessParticipantIHG(
                $firstName,
                $lastName,
                $department,
                $email,
                $phone,
                $slotSelection
            ) {
                try {
                    
                $status = 0;
                $datetime = date("Y-m-d H:i");
                    $sql = "INSERT INTO `event_workshop_registrations` 
                (`first_name`, `last_name`, `department`, `email`, `phone`, `slot_selection`, `datetime`)
                VALUES
                (:first_name, :last_name, :department, :email, :phone, :slot_selection, :datetime)";

                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":first_name", $firstName);
                    $stm->bindParam(":last_name", $lastName);
                    $stm->bindParam(":department", $department);
                    $stm->bindParam(":email", $email);
                    $stm->bindParam(":phone", $phone);
                    $stm->bindParam(":slot_selection", $slotSelection);
                    $stm->bindParam(":datetime", $datetime);
                    $stm->execute();
            
                    return 'success'; // Registration successful
                } catch (PDOException $e) {
                    // Optionally log $e->getMessage();
                    error_log("Error: " . $e->getMessage());
                    return 'error'; // Registration failed
                }
            }
            
        function hasUserCompletedWellnessAssessment($email) 
        {  
            if($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT email, slug  FROM `wellness_assessment` WHERE `email` = :email LIMIT 1";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(':email', $email);
                $stm->execute();
                if ($stm->rowCount()) {
                    $data = $stm->fetch(PDO::FETCH_ASSOC);
                    return $data;
                }
            }
            return false; 
        }
    
   // ##############################################################
   // ##############################################################
   // ##################### User Dashboard #########################
   // ##############################################################
   // ##############################################################
   
    
    
} //Class Ends Here


class submitqueries
{
    
   
	function letstalk()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        
        $message = $_POST['message'];
        
        $services = $_POST['services'];
        
        foreach($services as $service){
            $multipleservices .= $service.",";  
        }
        
        $servicesBusiness = $_POST['servicesBusiness'];
        
        foreach($servicesBusiness as $serviceBusiness){
            $multipleBusinessservices .= $serviceBusiness.",";  
        }
        
        
        $date = date('Y-m-d');
        
         $sql = executeQuery("INSERT INTO `getintouch`(`name`, `email`, `phone`, `subject`, `message`, `services`, `business_services`, `date`)VALUES('$name', '$email', '$phone', '$subject', '$message', '$multipleservices', '$multipleBusinessservices', '$date')");
        
        if($sql){
	        return "SUCCESS";
        }else{
            return "ERROR";
        }
        
    }
    
    
    
    
    
    
    
    
    
} //2nd Class Ends
?>