<?php
require_once("conn.php");
@session_start();
class User
{
    private $conn;
    private $openConn;

    function __construct()
    {
        $this->conn = new connection();
        $this->openConn = $this->conn->openConnection();
        date_default_timezone_set("Asia/Calcutta");
    }

    function userCheck()
    {
        if (!empty($_COOKIE['email']) && !empty($_COOKIE['pass'])) {
            $email = $_COOKIE["email"];
            $pass = $_COOKIE["pass"];
        } elseif (!empty($_SESSION["email"]) && !empty($_SESSION["pass"])) {
            if ($_SESSION["expire"] > time()) {
                $email = $_SESSION["email"];
                $pass = $_SESSION["pass"];
            } else {
                unset($_SESSION["email"]);
                unset($_SESSION["pass"]);
                return false;
            }
        } else {
            return false;
        }

        if (isset($email) && isset($pass) && empty($_SESSION["login_id"])) {
            $sql = "select * from users where email = '$email' and pass = '$pass' ";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
        } elseif (isset($email) && isset($pass) && !empty($_SESSION["login_id"])){
            
            $sql = "select * from users where email = '$email' and oauth_uid = '".$_SESSION["login_id"]."' ";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
            
        }
    }

    function getUser()
    {
        if (!empty($_COOKIE['email']) && !empty($_COOKIE['pass'])) {
            $email = $_COOKIE["email"];
            $pass = $_COOKIE["pass"];
        } elseif (!empty($_SESSION["email"]) && !empty($_SESSION["pass"])) {
            if ($_SESSION["expire"] > time()) {
                $email = $_SESSION["email"];
                $pass = $_SESSION["pass"];
            } else {
                unset($_SESSION["email"]);
                unset($_SESSION["pass"]);
                return false;
            }
        } else {
            return false;
        }

        if (isset($email) && isset($pass)) {
            $sql = "select * from users where email = '$email' and pass = '$pass' ";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return $stm->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } else
            return false;
    }

    function registerUser()
    {
        $name = $_POST["firstname"]." ".$_POST["lastname"];
        $phone = $_POST["phone"];
        $pass = md5($_POST["pass"]);
        $email = $_POST["email"];
        $date = date("d M Y");
        $sql = "insert into users (name, password, email, phone, date, verified) values ('$name', '$pass', '$email', '$phone', '$date', 'false')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }

    function login()
    {
        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);
        $sql = "select * from users where email = '$email' and pass = '$pass'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    function updateUser()
    {
        if ($this->userCheck()) {
            $user = $this->getUser();
            $id = $user["id"];
            $name = $_POST["firstname"]." ".$_POST["lastname"];
            $phone = $_POST["phone"];
            $bio = $_POST["bio"];
            $date = $date = date("d M Y");
            $sql = "update `users` set `name` = :name, `phone` = :phone, `bio` = :bio, `date` = :date where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":name", $name); 
            $stm->bindParam(":phone", $phone);
            $stm->bindParam(":bio", $bio);
            $stm->bindParam(":date", $date);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function getUsers()
    {
        $sql = "select id, name, email, verified from users";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }

function updateUserPass()
    {
        if ($this->userCheck()) {
            $user = $this->getUser();
            $mailid = $user["email"];
            $pass = md5($_POST["pass"]);
            
            $sql = "update `users` set `pass` = '$pass' where email = '$mailid'";
            
            $stm = $this->openConn->prepare($sql);
            
            $stm->execute();
            if ($stm->rowCount()) {
                
                 $_SESSION["expire"] = time() + (60 * 30);
                $_SESSION["email"] = $user["email"];
                $_SESSION["pass"] = $pass;
                
                return "Success";
            } else {
                return "Error";
            }
        }
    }


/* ADD BLOGS Starts*/

    function addBlog()
    {
        if ($this->userCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/blogs/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $cat = $_POST["cat"];
                        $author = $_POST["author"];
                        $content = $_POST["content"];
                        $date = date("d M Y");
                        $user = $this->getUser();
                        $id = $user["id"];
                        
                        $sql = "insert into `blogs` (`title`,`category`,`author`,`content`,`img`,`date`,`userid`,`origin`) values (:title,:cat,:author,:content,:finalImgName,:date,:id,'user')";
                        
                        $stm = $this->openConn->prepare($sql);
                            
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":cat", $cat);
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":content", $content);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->bindParam(":date", $date);
                        $stm->bindParam(":id", $id);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                            // Error while inserting
                        }
                        return "Success";
                    } else {
                        // Error While Uploading
                        return "Error";
                    }
                } else {
                    // Error Code
                    return "Error";
                }
            }
        }
    }

/* ADD BLOGS Ends*/

    function addPost()
    {
        if ($this->userCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/posts/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $cat = $_POST["cat"];
                        $author = $_POST["author"];
                        $content = $_POST["content"];
                        $date = date("d M Y");
                        $quote = $_POST["quote"];
                        $user = $this->getUser();
                        $id = $user["id"];
                        if (!empty($_FILES['video'])) {
                            $sql = "insert into `stories` (`title`,`category`,`author`,`content`,`img`,`date`,`video`,`userid`,`origin`,`quote`) values (:title,:cat,:author,:content,:finalImgName,:date,:video,:id,'user', :quote)";
                            $stm = $this->openConn->prepare($sql);
                            $video = $this->addVideo();
                            $stm->bindParam(":video", $video);
                        }elseif (empty($_FILES['video'])) {
                            $sql = "insert into `stories` (`title`,`category`,`author`,`content`,`img`,`date`,`userid`,`origin`,`quote`) values (:title,:cat,:author,:content,:finalImgName,:date,:id,'user', :quote)";
                            $stm = $this->openConn->prepare($sql);
                        }
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":cat", $cat);
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":content", $content);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->bindParam(":date", $date);
                        $stm->bindParam(":quote", $quote);
                        $stm->bindParam(":id", $id);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                            // Error while inserting
                        }
                        return "Success";
                    } else {
                        // Error While Uploading
                        return "Error";
                    }
                } else {
                    // Error Code
                    return "Error";
                }
            }
        }
    }

    function updatePost($id)
    {
        if ($this->userHasPost($id)) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            if ($filename) {
                $fileExp = explode('.', $filename);
                $fileActualName = $fileExp[0];
                $fileActualExt = strtolower(end($fileExp));
                $finalImgName = $fileActualName . rand() . "." . $fileActualExt;
                $fileDest = "../images/posts/" . $finalImgName;
                $fileTmpName = $file['tmp_name'];
                $fileError = $file['error'];
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if (move_uploaded_file($fileTmpName, $fileDest)) {
                            $title = $_POST["title"];
                            $cat = $_POST["cat"];
                            $author = $_POST["author"];
                            $content = $_POST["content"];
                            $quote = $_POST["quote"];
                            $date = date("d M Y");
                            $sql = "update `stories` set `title` = :title, `quote` = :quote, `category` = :cat, `author` = :author, `content` = :content, `img` = :finalImgName,`date` = :date where id = $id";
                            $stm = $this->openConn->prepare($sql);
                            $stm->bindParam(":title", $title);
                            $stm->bindParam(":cat", $cat);
                            $stm->bindParam(":quote", $quote);
                            $stm->bindParam(":author", $author);
                            $stm->bindParam(":content", $content);
                            $stm->bindParam(":finalImgName", $finalImgName);
                            $stm->bindParam(":date", $date);
                            $stm->execute();
                            if ($stm->rowCount()) {
                                return "Success";
                            } else {
                                return "Error";
                                // Error while inserting
                            }
                        } else {
                            // Error While Uploading
                            return "Error";
                        }
                    } else {
                        // Error Code
                    }
                }
            } else {
                $title = $_POST["title"];
                $cat = $_POST["cat"];
                $author = $_POST["author"];
                $content = $_POST["content"];
                $quote = $_POST["quote"];
                $date = date("d M Y");
                $sql = "update `stories` set `title` = :title, `quote` = :quote, `category` = :cat, `author` = :author, `content` = :content,`date` = :date where id = $id";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":title", $title);
                $stm->bindParam(":quote", $quote);
                $stm->bindParam(":cat", $cat);
                $stm->bindParam(":author", $author);
                $stm->bindParam(":content", $content);
                $stm->bindParam(":date", $date);
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }

    function addAudio()
    {
        if ($this->userCheck()) {
            $file = $_FILES['audio'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "../audios/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('mp3', 'wav', 'ogg');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    return   $finalImgName;
                }
            }
        }
    }

    function addVideo()
    {
        if ($this->userCheck()) {
            $file = $_FILES['video'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "../videos/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('webm', 'mp4', 'ogg');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    return   $finalImgName;
                }
            }
        }
    }

    function getUserVarifiedPosts()
    {
        $user = $this->getUser();
        $id = $user["id"];
        $sql = "select * from stories where origin = 'user' and adminAction = 'varified' and userid = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function getUserUnvarifiedPosts()
    {
        $user = $this->getUser();
        $id = $user["id"];
        $sql = "select * from stories where origin = 'user' and status = 'rejected' or status = 'processing' and userid = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function getUserPosts()
    {
        $sql = "select * from stories where origin = 'user'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function userHasPost($postId)
    {
        $user = $this->getUser();
        $userID = $user["id"];
        $sql = "select * from stories where origin = 'user' and userid = $userID and id = $postId";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    function deletePost($id)
    {
        if ($this->userHasPost($id)) {
            $sql = "select * from stories where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $path = "../images/posts/" . $data["img"];
                unlink($path) or die("Couldn't delete file");

                $sql2 = "delete from stories where id = $id";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                }

                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function getUserCount($param, $id)
    {
        switch ($param) {
            case "Posts": {
                    $sql = "SELECT count(*) as count from stories where userId = $id";
                    break;
                }
            case "Comments": {
                    $sql = "SELECT count(*) as count from comments where userId = $id";
                    break;
                }
            case "Likes": {
                    $sql = "SELECT sum(likes) as count from stories where userId = $id";
                    break;
                }
            case "Views": {
                    $sql = "SELECT sum(views) as count from stories where userId = $id";
                    break;
                }
            case "PostsLive": {
                    $sql = "SELECT count(*) as count from stories where userId = $id and status = 'live'";
                    break;
                }
            case "Processing": {
                    $sql = "SELECT count(*) as count from stories where userId = $id and status = 'processing'";
                    break;
                }
            case "Rejected": {
                    $sql = "SELECT count(*) as count from stories where userId = $id and status = 'rejected'";
                    break;
                }
            case "Refferal": {
                    $sql = "SELECT count(*) as count from Refferals where userId = $id";
                    break;
                }
            case "Reactions": {
                    $sql = "SELECT count(*) as count from postreactions where userid = $id";
                    break;
                }
            case "Blogs": {
                    $sql = "SELECT count(*) as count from blogs where userid = $id";
                    break;
                }/*
            case "Reactions": {
                    $sql = "SELECT count(*) as count from reviews where postId in (SELECT id from stories where userid = $id)";
                    break;
                }*/
        }

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

    function setAnswers()
    {
        $user = $this->getUser();
        $answers = json_encode($_POST["answers"]);
        $title = $_POST["title"];
        $date = date("d M Y");
        $questionID = $_POST["id"];
        $userID = $user["id"];
        $sql = "insert into `Answers` (`data`,`date`,`title`,`questionID`,userID) values (:answers,:date,:title,:questionID,:userID)";
        $stm = $this->openConn->prepare($sql);
        $stm->bindParam(":answers", $answers);
        $stm->bindParam(":date", $date);
        $stm->bindParam(":title", $title);
        $stm->bindParam(":questionID", $questionID);
        $stm->bindParam(":userID", $userID);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }

    function checkIfAnswerd($Q_ID)
    {
        $user = $this->getUser();
        $userID = $user["id"];
        $sql = "select * from Answers where userID = $userID and questionID = $Q_ID";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    function getUsersQA($id)
    {
        //work ******
        $sql = "SELECT * FROM users WHERE id IN (SELECT userID FROM Answers WHERE questionID = $id)";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }

    function getUserAnswers()
    {
        $user = $this->getUser();
        $id = $user["id"];
        $sql = "SELECT * FROM Answers WHERE userID = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }

    function getQuesById($id)
    {
        $sql = "SELECT * FROM Questions WHERE id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    function setFeedback()
    {
        $user = $this->getUser();
        $comment = $_POST["comment"];
        $rating = $_POST["rate"];
        $date = date("d M Y");
        $userID = $user["id"];
        $sql = "insert into `Feedback` (`comment`,rating,`date`,userID) values (:comment,:rating,:date,:userID)";
        $stm = $this->openConn->prepare($sql);
        $stm->bindParam(":comment", $comment);
        $stm->bindParam(":rating", $rating);
        $stm->bindParam(":date", $date);
        $stm->bindParam(":userID", $userID);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }

    function setRefferal()
    {
        $user = $this->getUser();
        $date = date("d M Y");
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $profile = $_POST["profile"];
        $userID = $user["id"];
        $sql = "insert into `Refferals` (`name`,`email`,phone,`profile`,`date`,userID) values (:name,:email,:phone,:profile,:date,:userID)";
        $stm = $this->openConn->prepare($sql);
        $stm->bindParam(":name", $name);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":phone", $phone);
        $stm->bindParam(":profile", $profile);
        $stm->bindParam(":date", $date);
        $stm->bindParam(":userID", $userID);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }

    function getUserFeedback()
    {
        //work
        $user = $this->getUser();
        $id = $user["id"];
        $sql = "SELECT * FROM Feedback WHERE userID = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }

    function unhidePost($id)
    {
        if ($this->userHasPost($id)) {
            $sql = "update stories set userAction = 'shown' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function hidePost($id)
    {
        if ($this->userHasPost($id)) {
            $sql = "update stories set userAction = 'hidden' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function repostPost($id)
    {
        if ($this->userHasPost($id)) {
            $sql = "update stories set adminAction = 'unvarified', status = 'processing' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function resetPass()
    {
        $email = $_POST["email"];
        $sql = "SELECT email from users where email = '$email'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $this->setToken($stm->fetch()["email"]);
            $this->sendEmail($stm->fetch()["email"]);
        } else
            return false;
    }

    function setToken()
    {
    }

    function sendEmail()
    {
    }

    function getUserTestimonial()
    {
        $user = $this->getUser();
        $userID = $user["id"];
        $sql = "select * from testimonials where userID = $userID";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return false;
        }
    }

    function addTestimonial()
    {
        if ($this->userCheck()) {
            if ($_FILES['image']['name']) {
                $file = $_FILES['image'];
                $filename = $file['name'];
                $fileExp = explode('.', $filename);
                $fileActualName = $fileExp[0];
                $fileActualExt = strtolower(end($fileExp));
                $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
                $fileDest = "../images/testimonials/" . $finalImgName;
                $fileTmpName = $file['tmp_name'];
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $allowed)) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $user = $this->getUser();
                        $userID = $user["id"];
                        $msg = $_POST["msg"];
                        $title = $_POST["title"];
                        $img = $finalImgName;
                        $date = date("d M Y");
                        $sql = "insert into `testimonials` (`title`,`msg`,`img`,`date`,`status`,userID) values (:title,:msg,:img,:date,'un-verified',:userID)";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":msg", $msg);
                        $stm->bindParam(":img", $img);
                        $stm->bindParam(":date", $date);
                        $stm->bindParam(":userID", $userID);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else
                            return "Error";
                    } else
                        return "Error";
                }
            }
        }
    }

    function updateTestimonial()
    {
        if ($this->userCheck()) {
            $user = $this->getUser();
            $userID = $user["id"];
            $flag = false;
            if ($_FILES['image']['name']) {
                $this->delTestimonialImg();
                $file = $_FILES['image'];
                $filename = $file['name'];
                $fileExp = explode('.', $filename);
                $fileActualName = $fileExp[0];
                $fileActualExt = strtolower(end($fileExp));
                $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
                $fileDest = "../images/testimonials/" . $finalImgName;
                $fileTmpName = $file['tmp_name'];
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $allowed)) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $img = $finalImgName;
                        $sql = "UPDATE `testimonials` set `img` = :img where userId = $userID";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":img", $img);
                        $stm->execute();
                        $flag = true;
                    } else
                        return "Error";
                }
            }
            $msg = $_POST["msg"];
            $title = $_POST["title"];
            $sql = "UPDATE `testimonials` set `msg` = :msg , `title` = :title, `status` = 'un-verified' where userId = $userID";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":msg", $msg);
            $stm->bindParam(":title", $title);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                if ($flag)
                    return true;
                else
                    return "Error";
            }
        }
    }

    function delTestimonialImg()
    {
        $user = $this->getUser();
        $userID = $user["id"];
        $sql = "select img from testimonials where userId = $userID";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            $path = "../images/testimonials/" . $data["img"];
            unlink($path) or die("Couldn't delete file");
            return true;
        }
    }
    
    
    function getUserByGoogleId($gid)
    {
        $sql = "select * from users where google_id = $gid";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }
    
    
    function addUserByGoogle()
    {
        $date = date("d M Y");
        $sql = "insert into users (google_id, name, email, profile_image, date, verified) values ('$id','$full_name', '$email', '$profile_pic', '$date', 'true')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }
    
    
    
    function inviteFriend()
    {
 /*############ Mail Send*/
    
    // Sending Mail To User
    $useremail = $_POST['email'];
    $username = $_POST['name'];
    $sendername = $_POST['sendername'];
    $sendermail = $_POST['senderemail']; 
    $to = $useremail; 
    $subject = "WahStory.";
    $subject2 = "WahStory.";
    $user_message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Verify your email address</title>
  <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    *:not(br):not(tr):not(html) {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      line-height: 1.4;
      background-color: #FFFFFF
      color: #839197;
      -webkit-text-size-adjust: none;
      font-family: "Nunito", "Segoe UI", arial;
    }
    a {
      color: #414EF9;
    }

    /* Layout ------------------------------ */
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      background-color: #FFFFFF;
    }
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    /* Masthead ----------------------- */
    .email-masthead {
        
        padding: 5px 0 15px 0;
        text-align: center;
        border-bottom: 10px solid #ff1662;
      
    }
    .email-masthead_logo {
      max-width: 400px;
      border: 0;
    }
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #839197;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }

    /* Body ------------------------------ */
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      border-bottom: 1px solid #E7EAEC;
      background-color: #FFFFFF;
    }
    .email-body_inner {
      width: 570px;
      margin: 0 auto;
      padding: 0;
    }
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      text-align: center;
    }
    .email-footer p {
      color: #839197;
    }
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      text-align: center;
    }
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #E7EAEC;
    }
    .content-cell {
      padding: 35px;
    }
    .align-right {
      text-align: right;
    }

    /* Type ------------------------------ */
    h1 {
      margin-top: 0;
      color: #292E31;
      font-size: 19px;
      font-weight: bold;
      text-align: left;
    }
    h2 {
      margin-top: 0;
      color: #292E31;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    h3 {
      margin-top: 0;
      color: #292E31;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    p {
      margin-top: 0;
      color: #212529;
      font-size: 16px;
      line-height: 1.5em;
      text-align: left;
    }
    p.subnote {
      font-size: 14px;
    }
    
    /* Buttons ------------------------------ */
    .button {
      display: inline-block;
      width: 200px;
      background-color: #414EF9;
      border-radius: 3px;
      color: #ffffff;
      font-size: 15px;
      line-height: 45px;
      text-align: center;
      text-decoration: none;
      -webkit-text-size-adjust: none;
      mso-hide: all;
    }
    .button--green {
      background-color: #28DB67;
    }
    .button--red {
      background-color: #FF3665;
    }
    .button--blue {
      background-color: #414EF9;
    }
    
    .btn {
        font-weight: 600;
        font-size: 12px;
        line-height: 24px;
        padding: 0.3rem 0.8rem;
        letter-spacing: 0.5px;
    }
    .btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    text-decoration: none;
}
     .btn-primary {
        background-color: #ff1662;
        border-color: transparent !important;
        color: #fff !important;
    }

     .bg-white {
        background-color: #fff;

    }

    /*Media Queries ------------------------------ */
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>
  <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table class="email-content bg-white" width="100%" cellpadding="0" cellspacing="0">
          <!-- Logo -->
          <tr>
            <td class="email-masthead" style="text-align: center;">
              <a class="email-masthead_name" style="color: #b30505; text-align: center;"> <img class="headerlogo" src="https://www.wahstory.com/images/logos/logo-light.png" title="logo" alt="Wah Story Logo" height="80px"></a>
            </td>
          </tr>
          <!-- Email Body -->
          <tr>
            <td class="email-body" width="100%">
              <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                  <td style="padding-top: 20px; padding-bottom: 10px;">
                    
                <p>Hi '.$username.'!</p>
                <p>It&#x27;s time to inspire the world with the art of Storytelling!</p>
                <p>I invite you to join the community of global leaders at WAHStory. Let the world see YOU. Let&#x27;s make a difference together! Join Wahstory and they would love to be a part of your journey!</p>
                    
                  </td>
                  </tr>
                  <tr>
                  <td style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
                    
                <a href="https://www.wahstory.com/?LOGIN" target="_blank" class="btn btn-primary" style-"color: #fff; text-decoration: none;>Join WAHStory</a>
                    
                  </td>
                  
                </tr>
            
                <tr>
                    <td style="padding-top: 10px; padding-bottom: 10px;">
                    
                <p>Thank you for your consideration. Let&#x27;s begin the journey together!</p>
                <p>Best Always! <br>
                '.$sendername.'</p>
                    
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="padding-top: 20px;">
                    <p class="subnote">
                    Note : This email was generated on WAHStory by Akshay Bhatia . WAHStory does not hold any liability for the content written in the email. To report any issue, please reach out to us at <a href="mailto:info@wahstory.com">info@wahstory.com</a>
                    </p>
                  </td>
                </tr>
              </table>	
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';

$admin_message = "<h1>".$sendername." has invited his/her friend . </h1> <br> <strong>Email: </strong>".$useremail." for Wah Story";
    $from = "info@wahstory.com";
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'From: WahStory. <info@wahstory.com>'. "\r\n";

    if (mail($to,$subject,$user_message,$headers) && mail($from,$subject2,$admin_message,$headers)) {
        
        return "Success";
        
    }else {
        return "Error";
    }
    // Sending Mail To User Ends
    /*############ Mail Send Ensd*/
    }
    
    
    
}
