<?php
// ini_set('display_errors', 1);///
// error_reporting(E_ALL);
@session_start();
require_once("conn.php");
class Post
{
    private $conn;
    private $openConn;
    
    private $Secndconn;
    private $SecndopenConn;
    
    function __construct()
    {
        $this->conn = new connection();
        $this->openConn = $this->conn->openConnection();
        
        //WAHCLUB DB Connections
        $this->Secndconn = new Secondaryconnection();
        $this->SecndopenConn = $this->Secndconn->SecondaryopenConnection();
        
        date_default_timezone_set("Asia/Calcutta");
    }

    function adminCheck()
    {
        if (!empty($_COOKIE['admin_id']) && !empty($_COOKIE['admin_pass'])) {
            $user = $_COOKIE["admin_id"];
            $pass = $_COOKIE["admin_pass"];
        } elseif (!empty($_SESSION["admin_id"]) && !empty($_SESSION["admin_pass"])) {
            if ($_SESSION["admin_expire"] > time()) {
                $user = $_SESSION["admin_id"];
                $pass = $_SESSION["admin_pass"];
            } else {
                unset($_SESSION["admin_id"]);
                unset($_SESSION["admin_pass"]);
                return false;
            }
        } else {
            return false;
        }

        if (isset($user) && isset($pass)) {
            $sql = "select * from admin where user = '$user' and pass = '$pass' ";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
        }
    }

    function createSlug($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }   
        return $text;
    }

    function addQA()
    {
        if ($this->adminCheck()) {
            $questions = json_encode($_POST["questions"]);
            $title = $_POST["title"];
            $date = date("d M Y");
            $sql = "insert into `Questions` (`data`,`date`,`title`) values (:questions,:date,:title)";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":questions", $questions);
            $stm->bindParam(":date", $date);
            $stm->bindParam(":title", $title);
            $stm->execute();
            if ($stm->rowCount())
                return "Success";
            else
                return "Error";
        }
    }

    function updateQA()
    {
        if ($this->adminCheck()) {
            $questions = json_encode($_POST["questions"]);
            $title = $_POST["title"];
            $date = date("d M Y");
            $id = $_POST["id"];
            $sql = "update `Questions` set `data` = :questions, `date` = :date, `title` = :title where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":questions", $questions);
            $stm->bindParam(":date", $date);
            $stm->bindParam(":title", $title);
            $stm->execute();
            if ($stm->rowCount())
                return "Success";
            else
                return "Error";
        }
    }

    function getQA()
    {
        $sql = "select * from Questions";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }

    function delQA($id)
    {
        if ($this->adminCheck()) {
            $sql = "delete from Questions where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return true;
            } else {
                return false;
            }
        }
    }


function getContentSuggestion()
    {
        $sql = "select * from content_suggestion";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
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

    function getPost($id)
    {

        $sql = "select * from stories where slug = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
function getPostByID($id)
    {

        $sql = "select * from stories where id = '$id'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

function getPostPrev($id, $catid)
    {

        $sql = "select * from stories where id < '$id' and category = '$catid' ORDER BY id desc";
        
        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        
        if($stm->rowCount()){
            
        }else{
           $sql = "select * from stories where id > '$id' and category = '$catid' ORDER BY id desc";   
        }
        
        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        
        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

function getPostNext($id, $catid)
    {

        $sql = "select * from stories where id > '$id' and category = '$catid'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        
        if($stm->rowCount()){
            
        }else{
           $sql = "select * from stories where id < '$id' and category = '$catid'";   
        }


        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }


    function getNextPost($id, $cat = null)
    {
        if ($cat) {
            $sql = "select * from stories where id = (select min(id) from stories where id > '$id' and adminAction = 'varified' and userAction = 'shown' and category = '$cat')";
        } else {
            $sql = "select * from stories where id = (select min(id) from stories where id > '$id' and adminAction = 'varified' and userAction = 'shown')";
        }

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

    function getPrevPost($id, $cat = null)
    {
        if ($cat) {
            $sql = "select * from stories where id = (select max(id) from stories where id < '$id' and adminAction = 'varified' and userAction = 'shown' and category = '$cat')";
        } else {
            $sql = "select * from stories where id = (select max(id) from stories where id < '$id' and adminAction = 'varified' and userAction = 'shown')";
        }


        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }


/* ##################*/
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

/* ##################*/


    function getCompaign()
    {

        $sql = "select * from campaign";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

    function getCompanyCampaigns($x = null)
    {
        if ($x)
            $sql = "SELECT * from Company_Campaign order by id desc limit $x";
        else
            $sql = "SELECT * from Company_Campaign order by id desc";


        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }

    function getCompanyCampaign($id)
    {
        $sql = "SELECT * from Company_Campaign where id =  $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }

    function like($id)
    {
        $sql = "select likes from stories where id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();

        if ($stm->rowCount()) {
            $sql = "update stories set likes = likes + 1 where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            $this->mail($id);
            return true;
        } else {
            $sql = "update stories set likes = 1 where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            return true;
        }
    }
    
    
    function setReview($id, $review, $name, $email, $fbId)
    {
        $date = date("M d, Y");
        $sql = "insert into reviews(postId, review, date, name, email, facebookID) values($id,'$review', '$date', '$name', '$email', '$fbId')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        $this->mail($id);
        return true;
    }

    function getReviews($id)
    {
        $sql = "SELECT * from reviews where postId = $id order by id desc limit 10";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function mail($id)
    {
        $points = array(5, 10, 15, 20, 50, 100, 500, 1000, 5000, 10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000);
        $data = $this->getLikes($id);
        if ($data) {
            if (in_array($data["likes"], $points)) {
                $likes = $data["likes"];
                $msg = "Your post reached $likes likes";
                mail("akshaybhatia@elementshrs.com", "Likes on your Post", $msg);
            }
        }
    }

    function getLikes($id)
    {
        $sql = "select likes from stories where id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    function getPostByAuthor($author)

    {

        $sql = "SELECT * from stories where author = '$author' and adminAction = 'varified' and userAction = 'shown'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }



    function getAllPosts($forsitemap = FALSE)
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
        $SearchedTitle = str_replace('-', ' ', $query);
        
        $sql = "SELECT * from stories where author like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || title like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown' || content like '%$SearchedTitle%' and adminAction = 'varified' and userAction = 'shown'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function getPostsByCat($cat, $count = null)
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

    function getRandomPosts($count = 5, $section = null)
    {
        if ($section) {
            $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status = 'boosted' and id in (select postId from stories_boosted where section = '$section') limit $count";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() < $count) {
                $x = $count - $stm->rowCount();
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and id not in (select postId from stories_boosted where section = '$section') order by rand() limit $x";
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
                $sql2 = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' and status <> 'boosted' order by rand() limit $x";
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

    function getTrendingPosts($count = 5, $section = null)
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



    function getLatestPosts($count = 5, $section = null)
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



    function getOldPosts($count = 5)

    {

        $sql = "select * from stories where adminAction = 'varified' and userAction = 'shown' order by id asc limit $count";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }
    
    function getnewPosts($count)

    {

        $sql = "select * from stories where adminAction = 'varified' and userAction = 'shown' order by id desc limit $count";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }



    function delPost($id)

    {
        if ($this->adminCheck()) {

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
            }
        }
    }

    function delPostAction($id)

    {
        if ($this->adminCheck()) {

            $sql = "select * from stories where id = $id";

            $stm = $this->openConn->prepare($sql);

            $stm->execute();

            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $path = "../../images/posts/" . $data["img"];
                unlink($path) or die("Couldn't delete file");

                $sql2 = "delete from stories where id = $id";
                $stm2 = $this->openConn->prepare($sql2);
                $stm2->execute();
                if ($stm2->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }

    function delPostImage($id)

    {
        if ($this->adminCheck()) {

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
            }
        }
    }

    function delSOMImage()
    {
        if ($this->adminCheck()) {
            $sql = "select img from stories where category = 'Story Of Month'";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $path = "../images/posts/" . $data["img"];
                unlink($path) or die("Couldn't delete file");
                return "Success";
            }
        }
    }

    function delSOMVideo()
    {
        if ($this->adminCheck()) {
            $sql = "select video from stories where category = 'Story Of Month'";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                if ($data["video"] != "") {
                    $path = "videos/" . $data["video"];
                    unlink($path);
                    return "Success";
                }
            }
        }
    }

    function delSOMAudio()
    {
        if ($this->adminCheck()) {
            $sql = "select audio from stories where category = 'Story Of Month'";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                if ($data["audio"] != "") {
                    $path = "audios/" . $data["audio"];
                    unlink($path);
                    return "Success";
                }
            }
        }
    }
    function addAudio()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['audio'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "audios/" . $finalImgName;

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
        if ($this->adminCheck()) {
            $file = $_FILES['video'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "videos/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('webm', 'mp4', 'ogg');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    return   $finalImgName;
                }
            }
        }
    }

    function addImage($folder = "posts")
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../../images/" . $folder . "/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            if (move_uploaded_file($fileTmpName, $fileDest)) {
                return   $finalImgName;
            }
        }
    }


    function addPost()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/posts/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        
                
                
                    //Register User Details Here!
                    
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $gender = $_POST["gender"];
                    $city = $_POST["city"];
                    $country = $_POST["country"];
                    $linkedin = $_POST["linkedin"];
                    $instagram = $_POST["instagram"];
                    $bio = $_POST["bio"]; 
                     $date = date("d M Y");
            
            $alreadyRegistered = $this->getUserByEmail($_POST["email"]);
            
            if($alreadyRegistered == NULL || $_POST["email"] != ''){ 
            
                    $sql2 = "insert into `users` (`name`, `phone`, `email`, `gender`, `city`, `country`, `linkedin`, `inatagramid`, `bio`, `created_at`, `verified`, `otp`, `isverified`) values (:name, :phone, :email, :gender, :city, :country, :linkedin, :instagram, :bio, :date, 'true', '111111', '1')";
                        $stm2 = $this->openConn->prepare($sql2);
                    $stm2->bindParam(":name", $name);
                    $stm2->bindParam(":phone", $phone);
                    $stm2->bindParam(":email", $email);
                    $stm2->bindParam(":gender", $gender);
                    $stm2->bindParam(":city", $city);
                    $stm2->bindParam(":country", $country);
                    $stm2->bindParam(":linkedin", $linkedin);
                    $stm2->bindParam(":instagram", $instagram);
                    $stm2->bindParam(":bio", $bio);
                    $stm2->bindParam(":date", $date);
                        
                    
                    $stm2->execute();
                    
                     $insertedId = $this->openConn->lastInsertId();
                    
                    if ($stm2->rowCount()) { 
                        
                        $title = $_POST["title"];
                        $slug = $this->createSlug($_POST["title"]);
                        $cat = $_POST["cat"];
                        $quote = $_POST["quote"];
                        $author = $_POST["author"];
                        $content = $_POST["content"];
                        $metadescription = $_POST["metadescription"];
                        $metakeywords = $_POST["metakeywords"];
                        $date = date("d M Y");
                        
                        $userID = $insertedId;
                        
                        if (!empty($_FILES['video']) &&  !empty($_FILES['audio'])) {
                            $sql = "insert into `stories` (`title`,`slug`,`metadescription`,`metakeywords`,`category`,`author`,`userid`,`content`,`img`,`date`,`video`,`audio`,`quote`,`origin`,`status`,`adminAction`) values (:title,:slug,:metadescription,:metakeywords,:cat,:author,:userid,:content,:finalImgName,:date, :video, :audio, :quote,'admin','live','varified')";
                            $stm = $this->openConn->prepare($sql);
                            $video = $this->addVideo();
                            $stm->bindParam(":video", $video);
                            $audio = $this->addAudio();
                            $stm->bindParam(":audio", $audio);
                        } elseif (!empty($_FILES['video']) && empty($_FILES['audio'])) {
                            $sql = "insert into `stories` (`title`,`slug`,`metadescription`,`metakeywords`,`category`,`author`,`userid`,`content`,`img`,`date`,`video`,`quote`,`origin`,`status`,`adminAction`) values (:title,:slug,:metadescription,:metakeywords,:cat,:author,:userid,:content,:finalImgName,:date,:video, :quote,'admin','live','varified')";
                            $stm = $this->openConn->prepare($sql);
                            $video = $this->addVideo();
                            $stm->bindParam(":video", $video);
                        } elseif (empty($_FILES['video']) && !empty($_FILES['audio'])) {
                            $sql = "insert into `stories` (`title`,`slug`,`metadescription`,`metakeywords`,`category`,`author`,`userid`,`content`,`img`,`date`,`audio`,`quote`,`origin`,`status`,`adminAction`) values (:title,:slug,:metadescription,:metakeywords,:cat,:author,:userid,:content,:finalImgName,:date,:audio, :quote,'admin','live','varified')";
                            $stm = $this->openConn->prepare($sql);
                            $audio = $this->addAudio();
                            $stm->bindParam(":audio", $audio);
                        } elseif (empty($_FILES['video']) && empty($_FILES['audio'])) {
                            $sql = "insert into `stories` (`title`,`slug`,`metadescription`,`metakeywords`,`category`,`author`,`userid`,`content`,`img`,`date`,`quote`,`origin`,`status`,`adminAction`) values (:title,:slug,:metadescription,:metakeywords,:cat,:author,:userid,:content,:finalImgName,:date, :quote,'admin','live','varified')";
                            $stm = $this->openConn->prepare($sql);
                        }
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":slug", $slug);
                        $stm->bindParam(":cat", $cat);
                        $stm->bindParam(":metadescription", $metadescription);
                        $stm->bindParam(":metakeywords", $metakeywords);
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":userid", $userID);
                        $stm->bindParam(":content", $content);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->bindParam(":quote", $quote);
                        $stm->bindParam(":date", $date);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            
                            return "Success";
                        
                        } else {
                            return "Error";
                            // Error while inserting
                        }
                        
                        return "Error"; //error as Story has not being submitted
                        
                      } //End User Registration
                        
                   return "Error";      
                } //User Already Registered
                        
                        
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

    
    function addContentSuggestionAttachment()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['attachment'];

            $filename = $file['name'];

            $fileExp = explode('.', $filename);

            $fileActualName = $fileExp[0];

            $fileActualExt = strtolower(end($fileExp));

            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;

            $fileDest = "../images/contentsuggestion/attachments/" . $finalImgName;

            $fileTmpName = $file['tmp_name'];

            $allowed = array('doc', 'docx', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if (move_uploaded_file($fileTmpName, $fileDest)) {
                    return   $finalImgName;
                }
            }
        }
    }
    
    
    
    function getAllNews()
    {
        $sql = "SELECT * FROM corporatenews WHERE status = 1 ORDER BY `id` DESC";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    
    
    function addCorporateNews(){
        if ($this->adminCheck()) {
        if($_FILES['image']['name']){
            
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/news/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $ImageName = $finalImgName;
                    } else {
                        
                        $ImageName = "";
                        
                        // Error While Uploading
                        return "Error";
                    }
                } else {
                    // Error Code
                    return "Error";
                }
            }//ExtentionsAllowed
            
            $ImageURL = "";
            
        }else{
            $ImageName = "";
            $ImageURL = $_POST["imageURL"];
        }
            
            $title = addslashes(htmlentities($_POST["title"]));
            $slug = $this->createSlug($_POST["title"]);
            $content = addslashes($_POST["content"]);
            $sourceURL = addslashes(htmlentities($_POST["sourceURL"]));
            
                if(empty($_POST["sourceauthor"])){
                    $author = "";
                }else{
                    $author = $_POST["sourceauthor"];    
                }
            
            $status = 1;
            $posttime = $_POST["PostTime"];
            
             $sql = "insert into `corporatenews` (`title`, `slug`, `image`, `imageURL`, `caption`, `sourceURL`, `author`, `status`, `PostTime`) values (:title,:slug,:ImageName,:ImageURL,:caption,:sourceURL,:author,:status,:posttime)";
            
            $stm = $this->openConn->prepare($sql);
            
            $stm->bindParam(":title", $title);
            $stm->bindParam(":slug", $slug);
            $stm->bindParam(":ImageName", $ImageName);
            $stm->bindParam(":ImageURL", $ImageURL);
            $stm->bindParam(":caption", $content);
            $stm->bindParam(":sourceURL", $sourceURL);
            $stm->bindParam(":author", $author);
            $stm->bindParam(":status", $status);
            $stm->bindParam(":posttime", $posttime);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
                // Error while inserting
            }
            
            
            
        
        } // AdminChecking
    }
    
    
    

    function addContentSuggestion()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/contentsuggestion/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        
                    } else {
                        // Error While Uploading
                        return "Error";
                    }
                } else {
                    // Error Code
                    return "Error";
                }
            }
            
        
        if(!empty($_POST["SelectedUserId"])){
        
            $platformname = $_POST["platformname"];
            $contentType = $_POST["contentType"];
            
            $userid = $_POST["SelectedUserId"];
            
            $title = addslashes(htmlentities($_POST["title"]));;
            $content = addslashes(htmlentities($_POST["content"]));
            
            $scheduleTime = $_POST["scheduleTime"];
            
            $datetime = date("Y-m-d H:i");
            
            $sql = "insert into `content_suggestion` (`userid`,`platform`,`contentType`,`title`,`caption`,`scheduletime`,`img`,`createdat`) values (:userid,:platform,:contentType,:title,:content,:scheduletime,:finalImgName,:createdat)";
                $stm = $this->openConn->prepare($sql);
                
               /* if(!empty($_POST['attachment'])){
                    $attachment = $this->addContentSuggestionAttachment();
                }else{
                    $attachment = "";
                }*/
            
            
            // $stm->bindParam(":attachment", $attachment);
            $stm->bindParam(":platform", $platformname);
            $stm->bindParam(":contentType", $contentType);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":content", $content);
            $stm->bindParam(":scheduletime", $scheduleTime);
            $stm->bindParam(":createdat", $datetime); 
            $stm->bindParam(":userid", $userid);
            
            $stm->bindParam(":finalImgName", $finalImgName);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
                // Error while inserting
            }
            
        } else {
            return "Error";
            // Error while inserting Select User and Steller is Empty...
        }
            
            
            
        }
    }

   
/* ADD BLOGS Starts*/
    function addBlog()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/blogs/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $slug = $this->createSlug($_POST["title"]);
                        $cat = $_POST["cat"];
                        $author = $_POST["author"];
                        
                        
                        $metadescription = $_POST["metadescription"];
                        $metakeywords = $_POST["metakeywords"];
                        $alttext = $_POST["alttext"];
                        
                        $content = $_POST["content"];
                        $date = date("d M Y");
                        
                        $sql = "insert into `blogs` (`title`,`slug`,`category`,`author`,`metadescription`,`metakeywords`,`alttext`,`content`,`img`,`date`,`origin`,`status`,`adminAction`) values (:title,:slug,:cat,:author,:metadescription,:metakeywords,:alttext,:content,:finalImgName,:date,'admin','live','varified')";
                        
                        $stm = $this->openConn->prepare($sql);
                            
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":slug", $slug);
                        $stm->bindParam(":cat", $cat);
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":metadescription", $metadescription);
                        $stm->bindParam(":metakeywords", $metakeywords);
                        $stm->bindParam(":alttext", $alttext);
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


function updateBlog($id)
    {
        if ($this->adminCheck()) {
            if ($_FILES['image']['name']) {
                 $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/blogs/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $slug = $this->createSlug($_POST["title"]);
                        
                        $metadescription = $_POST["metadescription"];
                        $metakeywords = $_POST["metakeywords"];
                        $alttext = $_POST["alttext"];
                        
                        $author = $_POST["author"];
                        $content = $_POST["content"];
                        $date = date("d M Y");
                        
                        $sql = "update `blogs` set `title` = :title, `slug` = :slug, `metadescription` = :metadescription, `metakeywords` = :metakeywords, `alttext` = :alttext, `author` = :author, `content` = :content, `img` = :finalImgName, `date` = :date where id = $id";
                        
                        $stm = $this->openConn->prepare($sql);
                            
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":slug", $slug);
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":metadescription", $metadescription);
                    $stm->bindParam(":metakeywords", $metakeywords);
                    $stm->bindParam(":alttext", $alttext);
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
            } else {
                $title = $_POST["title"];
                $slug = $this->createSlug($_POST["title"]);
                
                $metadescription = $_POST["metadescription"];
                $metakeywords = $_POST["metakeywords"];
                $alttext = $_POST["alttext"];
                    
                $author = $_POST["author"];
                $content = $_POST["content"];
                $date = date("d M Y");
                $sql = "update `blogs` set `title` = :title, `slug` = :slug, `metadescription` = :metadescription, `metakeywords` = :metakeywords, `alttext` = :alttext, `author` = :author, `content` = :content, `date` = :date where id = $id";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":title", $title);
                $stm->bindParam(":slug", $slug);
                $stm->bindParam(":metadescription", $metadescription);
                $stm->bindParam(":metakeywords", $metakeywords);
                $stm->bindParam(":alttext", $alttext);
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




function getBlogCats()

    {

        $sql = "select * from blogcats";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }
    
function getBlogs()
    {
        $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    
function getBlogsWithLimit($count)
    {
        $sql = "SELECT * from blogs where adminAction = 'varified' and userAction = 'shown' order by `id` desc limit $count";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
function getBlogById($slug)
    {

        $sql = "select * from blogs where id = '$slug'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

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


function setstoryofthemonth($id)
    {
        if ($this->adminCheck()) {
            $date = date("Y-m-d");
            $sql = "insert into storyofmonth (postid, status, date) values ($id, '1', '$date')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }


    
    function addCompaign()
    {

        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/posts/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $content1 = $_POST["content1"];
                        $content2 = $_POST["content2"];

                        $sql = "insert into `campaign` (`title`,`img`,`content1`,`content2`) values (:title,:finalImgName,:content1,:content2)";
                        $stm = $this->openConn->prepare($sql);

                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->bindParam(":content1", $content1);
                        $stm->bindParam(":content2", $content2);
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
        if ($this->adminCheck()) {
            if ($_FILES['image']['name']) {
                $file = $_FILES['image'];
                $filename = $file['name'];
                $fileExp = explode('.', $filename);

                $fileActualName = $fileExp[0];

                $fileActualExt = strtolower(end($fileExp));

                $finalImgName = $fileActualName . rand() . "." . $fileActualExt;

                $fileDest = "../images/posts/" . $finalImgName;

                $fileTmpName = $file['tmp_name'];

                $fileError = $file['error'];

                $allowed = array('jpg', 'jpeg', 'png', 'webp');

                if (in_array($fileActualExt, $allowed)) {

                    if ($fileError === 0) {

                        if (move_uploaded_file($fileTmpName, $fileDest)) {

                            $title = $_POST["title"];
                            $slug = $this->createSlug($_POST["title"]);
                            $cat = $_POST["cat"];
                            $author = $_POST["author"];
                            $content = $_POST["content"];
                            $metadescription = $_POST["metadescription"];
                            $metakeywords = $_POST["metakeywords"];
                
                            $quote = $_POST["quote"];
                            $date = date("d M Y");
                            $sql = "update `stories` set `title` = :title, `slug` = :slug, `quote` = :quote, `category` = :cat, `author` = :author, `content` = :content, `metadescription` = :metadescription, `metakeywords` = :metakeywords, `img` = :finalImgName,`date` = :date where id = $id";
                            $stm = $this->openConn->prepare($sql);
                            $stm->bindParam(":title", $title);
                            $stm->bindParam(":slug", $slug);
                            $stm->bindParam(":cat", $cat);
                            $stm->bindParam(":quote", $quote);
                            $stm->bindParam(":author", $author);
                            $stm->bindParam(":content", $content);
                        $stm->bindParam(":metadescription", $metadescription);
                    $stm->bindParam(":metakeywords", $metakeywords);
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
                $slug = $this->createSlug($_POST["title"]);
                $cat = $_POST["cat"];
                $author = $_POST["author"];
                $content = $_POST["content"];
                
                $metadescription = $_POST["metadescription"];
                $metakeywords = $_POST["metakeywords"];
                
                $quote = $_POST["quote"];
                $date = date("d M Y");
                $sql = "update `stories` set `title` = :title, `slug` = :slug, `quote` = :quote, `category` = :cat, `metadescription` = :metadescription, `metakeywords` = :metakeywords, `author` = :author, `content` = :content, `date` = :date where id = $id";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":title", $title);
                $stm->bindParam(":slug", $slug);
                $stm->bindParam(":quote", $quote);
                $stm->bindParam(":cat", $cat);
                $stm->bindParam(":author", $author);
                $stm->bindParam(":content", $content);
                $stm->bindParam(":metadescription", $metadescription);
                $stm->bindParam(":metakeywords", $metakeywords);
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


    function updateCompaign()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            if ($filename) {

                $fileExp = explode('.', $filename);

                $fileActualName = $fileExp[0];

                $fileActualExt = strtolower(end($fileExp));

                $finalImgName = $fileActualName . rand() . "." . $fileActualExt;

                $fileDest = "../../images/posts/" . $finalImgName;

                $fileTmpName = $file['tmp_name'];

                $fileError = $file['error'];

                $allowed = array('jpg', 'jpeg', 'png', 'webp');

                if (in_array($fileActualExt, $allowed)) {

                    if ($fileError === 0) {

                        if (move_uploaded_file($fileTmpName, $fileDest)) {

                            $title = $_POST["title"];
                            $content1 = $_POST["content1"];
                            $content2 = $_POST["content2"];

                            $sql = "update `campaign` set `title` = :title, `img` = :img, `content1` = :content1, `content2` = :content2";
                            $stm = $this->openConn->prepare($sql);
                            $stm->bindParam(":title", $title);
                            $stm->bindParam(":img", $finalImgName);
                            $stm->bindParam(":content1", $content1);
                            $stm->bindParam(":content2", $content2);

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
                $content1 = $_POST["content1"];
                $content2 = $_POST["content2"];

                $sql = "update `campaign` set `title` = :title, `content1` =:content1, `content2` =:content2";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":title", $title);
                $stm->bindParam(":content1", $content1);
                $stm->bindParam(":content2", $content2);

                $stm->execute();

                if ($stm->rowCount()) {

                    return "Success";
                } else {

                    return "Error";

                    // Error while inserting

                }
            }
        }
    }

    function addCat()
    {
        if ($this->adminCheck()) {
            $name = $_POST["name"];
            $slug = $this->createSlug($name);
            $sql = "insert into categories (name,slug) values ('$name','$slug')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();

            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function updateCat()
    {
        if ($this->adminCheck()) {
            extract($_POST);
            $slug = $this->createSlug($name);
            $sql = "UPDATE categories set name = :name,slug = :slug where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":name", $name);
            $stm->bindParam(":slug", $slug);
            $stm->execute();
            return "Success";
        }
    }

    function delCat($id)
    {
        $sql = "DELETE from categories where id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return 'Success';
        } else {
            return 'Error';
        }
    }


    function UsergetCats($id1,$id2)

    {

        $sql = "select * from categories where id!=$id1 and id!=$id2";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetchAll();

            return $data;
        }
    }
    
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


    function getPostCountByCat($cat)
    {
        $sql = "select count(*) as count from stories where category = $cat and adminAction = 'varified' and userAction = 'shown'";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }

    function getAllPostsCount($param)
    {
        switch ($param) {
            case "Posts": {
                    $sql = "select count(*) as count from stories";
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

    function getViews($id)
    {
        $sql = "select views from stories where id = $id ";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    
    function setViews($id)
    {
        $sql = "update stories set views = views + 1 where id = $id";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
        }
    }
    
    function setBlogViews($id)
    {
        $sql = "update blogs set views = views + 1 where id = $id";

        $stm = $this->openConn->prepare($sql);

        $stm->execute();

        if ($stm->rowCount()) {
        }
    }

    function acceptPost($id)
    {
        if ($this->adminCheck()) {
            $sql = "update stories set adminAction = 'varified', status = 'live' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                // ------> work <------

                // $sql2 = "select * from users where id = $id";
                // $stm = $this->openConn->prepare($sql2);
                // $stm->execute();
                // $data = $stm->fetch(PDO::FETCH_ASSOC);
                // $email = $data["email"];
                // mail($email, "Wah Story", "Hello there, your Post is varified by us and live now");
                return "varified";
            } else {
                return "Error_varify";
            }
        }
    }

    function rejectPost($id)
    {
        if ($this->adminCheck()) {
            $sql = "update stories set adminAction = 'rejected' , status = 'rejected' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                // ------> work <------

                // $sql2 = "select * from users where id = $id";
                // $stm = $this->openConn->prepare($sql2);
                // $stm->execute();
                // $data = $stm->fetch(PDO::FETCH_ASSOC);
                // $email = $data["email"];
                // mail($email, "Wah Story", "Hello there, your Post is varified by us and live now");
                return "Rejected";
            } else {
                return "Error_reject";
            }
        }
    }


 

    function boostPost($id, $section)
    {
        if ($this->adminCheck()) {
            $sql = "update stories set status = 'boosted' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            $sql = "insert into stories_boosted (postId, section) values ($id, '$section')";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

   
    function unboostPost($id, $section)
    {
        if ($this->adminCheck()) {
            $sql = "delete from stories_boosted where postId = $id and section = '$section'";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $sql = "select * from stories_boosted where PostId = $id";
                $stm = $this->openConn->prepare($sql);
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    $sql = "update stories set status = 'live' where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->execute();
                    if ($stm->rowCount()) {
                        return "Success";
                    } else {
                        return "Error";
                    }
                }
            } else {
                return "Error";
            }
        }
    }

    function isBoosted($id, $section)
    {
        $sql = "select * from stories_boosted where PostId = $id and section = '$section'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    function isSetStoryAsMonth($id)
    {
        $sql = "select * from storyofmonth where postid = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

   /* function getYoutubeVids()
    {
        $sql = "select * from Videos where cat = 'youtube'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }*/

    function delYoutubeVid($id)
    {
        if ($this->adminCheck()) {
            $sql = "delete from Videos where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function addYoutubeVideos()
    {
        if ($this->adminCheck()) {
            $title = $_POST["title"];
            $src = $_POST["src"];
            $sql = "insert into `Videos` (`title`,`src`,`cat`) values (:title,:src,'youtube')";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":src", $src);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function updateYoutubeVideos()
    {
        if ($this->adminCheck()) {
            $title = $_POST["title"];
            $src = $_POST["src"];
            $id = $_POST["id"];
            $sql = "update `Videos` set `title` = :title, `src` = :src where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":src", $src);
            $stm->execute();
            if ($stm->rowCount())
                return "Success";
            else
                return "Error";
        }
    }

    function getPostReactionCount($id)
    {
        $sql = "SELECT count(*) as count from reviews where postId = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    function verifyUser($id)
    {
        if ($this->adminCheck()) {
            $sql = "update users set verified = 'true' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $sql2 = "select * from users where id = $id";
                $stm = $this->openConn->prepare($sql2);
                $stm->execute();
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $email = $data["email"];
                mail($email, "Wah Story", "Hello there, your ID is varified by us and you can login now");
                return "varified";
            } else {
                return "Error_varify";
            }
        }
    }

    function unverifyUser($id)
    {
        if ($this->adminCheck()) {
            $sql = "update users set verified = 'false' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "unvarified";
            } else {
                return "Error_unvarify";
            }
        }
    }

    function getAnswers($id)
    {
        if ($this->adminCheck()) {
            $sql = "SELECT * FROM Answers WHERE questionID = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetchAll();
                return $data;
            } else {
                return false;
            }
        }
    }

    function getUserDetailsById($id)
    {
        if ($this->adminCheck()) {
            $sql = "SELECT name,email FROM users WHERE id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return false;
            }
        }
    }
    
    function getUserByEmail($email)
    {
        if ($this->adminCheck()) {
            $sql = "SELECT name,email FROM users WHERE email = '". $email ."'";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return NULL;
            }
        }
    }
    
    function getAnswerById($id)
    {
        if ($this->adminCheck()) {
            $sql = "SELECT * FROM Answers WHERE id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return false;
            }
        }
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

    function getAllTestimonials($limit = null)
    {
        if ($limit)
            $sql = "SELECT * from testimonials where order by id desc limit $limit";
        else
            $sql = "SELECT * from testimonials";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return false;
        }
    }

    function updateCompanyCampaign()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $image = $this->addImage("company_campaigns");
                $this->delImg("Company_Campaign", $id, "company_campaigns");
                if ($image) {
                    $sql = "update `Company_Campaign` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                    if (!$stm->rowCount()) {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }

            $title = $_POST["title"];
            $quote = $_POST["quote"];
            $content1 = $_POST["content1"];
            $content2 = $_POST["content2"];
            $sql = "update `Company_Campaign` set `title` = :title, `quote` = :quote, `content1` = :content1, `content2` = :content2 where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":quote", $quote);
            $stm->bindParam(":content1", $content1);
            $stm->bindParam(":content2", $content2);
            $stm->bindParam(":title", $title);
            $stm->execute();
            return "Success";
        }
    }

    function delImg($table, $id, $folder)
    {
        if ($this->adminCheck()) {
            $sql = "select img from $table where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $path = "../../images/" . $folder . "/" . $data["img"];
                unlink($path); // or die("Couldn't delete file");
                // return true;
            } else
                return false;
        }
    }

    function addCompanyCampaign()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../../images/company_campaigns/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $content1 = $_POST["content1"];
                        $content2 = $_POST["content2"];
                        $quote = $_POST["quote"];
                        $sql = "insert into `Company_Campaign` (`title`,`img`,`quote`,`content1`,`content2`) values (:title,:finalImgName,:quote,:content1,:content2)";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":quote", $quote);
                        $stm->bindParam(":content1", $content1);
                        $stm->bindParam(":content2", $content2);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                        }
                        return "Success";
                    } else {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }
        }
    }

    function delCompanyCampaign($id)
    {
        if ($this->adminCheck()) {
            $this->delImg("Company_Campaign", $id, "company_campaigns");
            $sql = "delete from Company_Campaign where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }
    function verifyTestimonial($id)
    {
        if ($this->adminCheck()) {
            $sql = "UPDATE testimonials set status = 'verified' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function unverifyTestimonial($id)
    {
        if ($this->adminCheck()) {
            $sql = "UPDATE testimonials set status = 'un-verified' where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function updateTestimonial()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $image = $this->addImage("testimonials");
                $this->delImg("testimonials", $id, "testimonials");
                if ($image) {
                    $sql = "UPDATE `testimonials` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                    if (!$stm->rowCount()) {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }

            $title = $_POST["title"];
            $msg = $_POST["msg"];
            $sql = "UPDATE `testimonials` set `title` = :title, `msg` = :msg where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":msg", $msg);
            $stm->execute();
            return "Success";
        }
    }

    function updateTeam()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $image = $this->addImage("team");
                $this->delImg("team", $id, "team");
                if ($image) {
                    $sql = "UPDATE `team` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                    if (!$stm->rowCount()) {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $position = $_POST["position"];
            $sql = "UPDATE `team` set `firstname` = :firstname, `lastname` = :lastname, `position` = :position where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":firstname", $firstname);
            $stm->bindParam(":lastname", $lastname);
            $stm->bindParam(":position", $position);
            $stm->execute();
            return "Success";
        }
    }

    function addTeam()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../../images/team/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $firstname = $_POST["firstname"];
                        $lastname = $_POST["lastname"];
                        $position = $_POST["position"];
                        $sql = "insert into `team` (`firstname`,`lastname`,`position`,`img`) values (:firstname,:lastname,:position,:finalImgName)";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":firstname", $firstname);
                        $stm->bindParam(":position", $position);
                        $stm->bindParam(":lastname", $lastname);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                        }
                        return "Success";
                    } else {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }
        }
    }

    function getTeam()
    {
        $sql = "select * from team";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }

    function delTeam($id)
    {
        if ($this->adminCheck()) {
            $this->delImg("team", $id, "team");
            $sql = "delete from team where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function delReaction($id)
    {
        if ($this->adminCheck()) {
            $this->delImg("reactions", $id, "reactions");
            $sql = "delete from reactions where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function getSingleReactions()
    {
        $sql = "select * from reactions";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }

    function addSingleReaction()
    {
        if ($this->adminCheck()) {
            $image = $this->addImage("reactions");
            if ($image) {
                $reaction = $_POST["reaction"];
                $sql = "insert into `reactions` (`reaction`,`img`) values (:reaction,:img)";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":reaction", $reaction);
                $stm->bindParam(":img", $image);
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }

    function updateSingleReaction()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $image = $this->addImage("reactions");
                $this->delImg("reactions", $id, "reactions");
                if ($image) {
                    $sql = "UPDATE `reactions` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                    if (!$stm->rowCount()) {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }

            $reaction = $_POST["reaction"];
            $msg = $_POST["msg"];
            $sql = "UPDATE `reactions` set `reaction` = :reaction where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":reaction", $reaction);
            $stm->execute();
            return "Success";
        }
    }

    /*function getExtras($name)
    {
        $sql = "SELECT * from extras where name = '$name' limit 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }*/

    function setExtras($name)
    {
        if ($this->adminCheck()) {
            $image = $this->addImage("extras");
            if ($image) {
                $sql = "insert into `extras` (`name`,`img`) values (:name,:img)";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":name", $name);
                $stm->bindParam(":img", $image);
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }

    function updateExtras()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            $this->delImg("extras", $id, "extras");
            $image = $this->addImage("extras");
            if ($image) {
                $sql = "UPDATE `extras` set `img` = :img where id = $id";
                $stm = $this->openConn->prepare($sql);
                $stm->bindParam(":img", $image);
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }

    function setGenesis()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../../images/extras/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $content1 = $_POST["content1"];
                        $content2 = $_POST["content2"];
                        $quote = $_POST["quote"];
                        $sql = "insert into `extras` (`val1`,`img`,`val2`,`val3`,`val4`,`name`) values (:title,:finalImgName,:quote,:content1,:content2,'genesis')";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":quote", $quote);
                        $stm->bindParam(":content1", $content1);
                        $stm->bindParam(":content2", $content2);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                        }
                        return "Success";
                    } else {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }
        }
    }

    function getGenesis()
    {
        $sql = "SELECT * from extras where name = 'genesis' limit 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }

    function updateGenesis()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $this->delImg("extras", $id, "extras");
                $image = $this->addImage("extras");
                if ($image) {
                    $sql = "UPDATE `extras` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                }
            }
            extract($_POST);
            $sql = "UPDATE `extras` set `val1` = :title,`val2` = :quote,`val3` = :content1,`val4` = :content2 where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":quote", $quote);
            $stm->bindParam(":content1", $content1);
            $stm->bindParam(":content2", $content2);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }

    function setMission()
    {
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../../images/extras/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $content1 = $_POST["content1"];
                        $content2 = $_POST["content2"];
                        $quote = $_POST["quote"];
                        $sql = "insert into `extras` (`val1`,`img`,`val2`,`val3`,`val4`,`name`) values (:title,:finalImgName,:quote,:content1,:content2,'mission')";
                        $stm = $this->openConn->prepare($sql);
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":quote", $quote);
                        $stm->bindParam(":content1", $content1);
                        $stm->bindParam(":content2", $content2);
                        $stm->bindParam(":finalImgName", $finalImgName);
                        $stm->execute();
                        if ($stm->rowCount()) {
                            return "Success";
                        } else {
                            return "Error";
                        }
                        return "Success";
                    } else {
                        return "Error";
                    }
                } else {
                    return "Error";
                }
            }
        }
    }

    function getMission()
    {
        $sql = "SELECT * from extras where name = 'mission' limit 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }

    function updateMission()
    {
        if ($this->adminCheck()) {
            $id = $_POST["id"];
            if ($_FILES['image']['name']) {
                $this->delImg("extras", $id, "extras");
                $image = $this->addImage("extras");
                if ($image) {
                    $sql = "UPDATE `extras` set `img` = :img where id = $id";
                    $stm = $this->openConn->prepare($sql);
                    $stm->bindParam(":img", $image);
                    $stm->execute();
                }
            }
            extract($_POST);
            $sql = "UPDATE `extras` set `val1` = :title,`val2` = :quote,`val3` = :content1,`val4` = :content2 where id = $id";
            $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":title", $title);
            $stm->bindParam(":quote", $quote);
            $stm->bindParam(":content1", $content1);
            $stm->bindParam(":content2", $content2);
            $stm->execute();
            if ($stm->rowCount()) {
                return "Success";
            } else {
                return "Error";
            }
        }
    }
    function getCatById($id)
    {
        $sql = "select * from categories where id = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }

    function getCatBySlug($slug)
    {
        $sql = "select * from categories where slug = '$slug'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }

    function getPostsOrderBy($o, $limit = 5)
    {
        $sql = "SELECT * from stories where adminAction = 'varified' and userAction = 'shown' order by $o desc limit $limit";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
function addSubscriptions()
    {
        $email = $_POST["email"];
        $sql = "select * from subscription where email = '$email'";
        $sql1 = "insert into subscription (email) values ('$email')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        $to      = $email;
        $subject = 'Subscription';
        $message = 'You have successfully subscribed WahStory.';
        $headers = 'From: info@wahstory.com' . "\r\n" .
            'Reply-To: info@wahstory.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
         if (mail($to, $subject, $message, $headers)) {
            if (!$stm->rowCount()) {
                $stm1 = $this->openConn->prepare($sql1);
                $stm1->execute();
                if ($stm1->rowCount()) {
                    
                    return "Success";
                    
                } else {
                    return "Error";
                }
            } else {
                return "Error1";
            }
         } else {
             return "Error";
         }
    }
    
function addGetNotifiedV2()
    {
        $email = $_POST["email"];
        $date = date("Y-m-d");
        $sql = "select * from getnotifiedv2 where email = '$email'";
        $sql1 = "insert into getnotifiedv2 (email,date) values ('$email', '$date')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        
            if (!$stm->rowCount()) {
                $stm1 = $this->openConn->prepare($sql1);
                $stm1->execute();
                if ($stm1->rowCount()) {
                    
                    return "Success";
                    
                } else {
                    return "Error";
                }
            } else {
                return "Error1";
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
        $sql = "insert into users (google_id, name, email, profile_image, date, varified) values ('$id','$firstname', '$email', '$profile_pic', '$date', 'true')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount())
            return "Success";
        else
            return "Error";
    }
    
    
    function getAdvertisizer()
    {
        $sql = "SELECT * from advertisewithus order by id desc";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    
    function getintouch()
    {
        $sql = "SELECT * from getintouch order by id desc";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function nominateastory()
    {
        $sql = "SELECT * from nominateastory order by id desc";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }

    function shareastory()
    {
        $sql = "SELECT * from shareyourstory order by id desc";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }


//Share Post with Different Table 
    function sharedpost($id, $userid)
    {
        $date = date("Y-m-d");
        $sql = "insert into storieshared(postid, userid, date) values('$id','$userid', '$date')";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        $this->mail($id);
        return true;
    }

  
  
    function getPostSharedByUSER($id)
    {
        $sql = "select count(*) as count from storieshared where postid = $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    }
    
    
    function getAllSocialHealthUsers()
    {
        $sql = "SELECT * from socialfootprint";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function getAllPreRegistrationsWahClub()
    {
        $sql = "SELECT * from wahclub ORDER BY `id` DESC";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function getUsers()
    {
        $sql = "select * from users where `isverified` = 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }
    
    
    function getAllNominees()
    {
        $sql = "SELECT * FROM namination ORDER BY id DESC";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    function CountNomineeVotes($nomineeid)
    {
        $sql = "select count(*) as count from storyvotes where `nomineeid` = '$nomineeid' && `isVerified` = 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function getNomineeById($id)
    {
        $sql = "SELECT * from namination where id =  $id";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetNomineeRequestedCats($NomineeId)
    {  
        $sql = "SELECT * FROM `nomineeCatRequest` WHERE `nomineeid` = '$NomineeId'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetNomineeStoryDetails($NomineeId)
    {  
        $sql = "SELECT * FROM `nominatedstories` WHERE `nominationid` = '$NomineeId'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetNomineeStoryDetailsByStoryId($StoryId)
    {  
        $sql = "SELECT * FROM `nominatedstories` WHERE `id` = '$StoryId'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetNomineestoryvotes($NomineeId)
    {  
        $sql = "SELECT * FROM `storyvotes` WHERE `nomineeid` = '$NomineeId' && `isVerified` = 1";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }
    
    function getAllNominattionInvitations()
    {
        $sql = "SELECT * from nominationInvitation ORDER BY id DESC";
       
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function GetAllJuryGroups()
    {
        $sql = "SELECT * from jurygroup order by id ASC";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function GetAllJuryMembers()
    {
        $sql = "SELECT * from jurymembers order by id ASC";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    function GetJuryById($JuryID)
    {
        $sql = "SELECT * FROM `jurymembers` WHERE `id`= '$JuryID'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetJuryByGroupId($GroupID)
    {
        $sql = "SELECT * FROM `jurymembers` WHERE `groupid`= '$GroupID'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetGroupById($GroupID)
    {
        $sql = "SELECT * FROM `jurygroup` WHERE `id`= '$GroupID'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        } else {
            return false;
        }
    }
    
    function GetAllUnallocatedStories()
    {
        $sql = "SELECT * from nominatedstories WHERE jurygroupid = 0 order by id ASC";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
     
    function GetEvaluatedStoriesByGroupId($GroupId, $juryid)
    {
        $sql = "SELECT nominatedstories.* FROM nominatedstories LEFT JOIN storyscoring ON nominatedstories.id = storyscoring.storyid AND storyscoring.juryid = '$juryid' WHERE nominatedstories.jurygroupid = '$GroupId' AND storyscoring.storyid IS NOT NULL";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
    
    
    
    function GetCountallocatedStoriesByGroup($groupid)
    {
        $sql = "SELECT COUNT(jurygroupid) AS allocatedcount from nominatedstories WHERE jurygroupid = '$groupid'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return NULL;
        }
    }
    
    function GetAllAllocatedStories()
    {
        // $sql = "SELECT * from nominatedstories WHERE jurygroupid != 0 order by id ASC";
        
        $sql = "SELECT ns.* FROM nominatedstories ns LEFT JOIN storyscoring sc ON ns.id = sc.storyid WHERE ns.jurygroupid != 0 AND sc.storyid IS NULL ORDER BY ns.id ASC;";
        
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL;
        }
    }
    
    function GetEvaluatedStories($JuryId)
    {
        if($JuryId != NULL){
            $sql = "SELECT * FROM `storyscoring` WHERE `juryid` = '$JuryId' ORDER BY `id` ASC";
        }else{
            $sql = "SELECT * FROM `storyscoring` ORDER BY `id` ASC";
        }
        
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    }
    
    function UpdateJuryGroupById($groupId, $ids)
    { 
        foreach($ids as $id){
             $sql = "update `nominatedstories` set `jurygroupid` = :groupId where id = $id";
             $stm = $this->openConn->prepare($sql);
            $stm->bindParam(":groupId", $groupId); 
            $stm->execute();
        }
        if ($stm->rowCount()) {
            return "Success";
        } else {
            return "Error";
            // Error while inserting
        }
    }
    
    
    
     
     
function PublishNomineeStory($id, $Nominationid)
    {
        if ($this->adminCheck()) {
            if ($_FILES['image']['name']) {
                 $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../images/posts/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                        $title = $_POST["title"];
                        $slug = $this->createSlug($_POST["title"]);
                        
                         
                        $author = $_POST["author"];
                        
                        $Category = $_POST["Category"];
                        $SubCategory = $_POST["SubCategory"];
                
                        $q1 = $_POST['q1'];
                        $q2 = $_POST['q2'];
                        $q3 = $_POST['q3'];
                        $q4 = $_POST['q4'];
                        $q5 = $_POST['q5'];
                         
                        $Verified = 1;
                        
                        $sql = "update `nominatedstories` set `title` = :title, `slug` = :slug, `author` = :author, `q1` = :ques1, `q2` = :ques2, `q3` = :ques3, `q4` = :ques4, `q5` = :ques5, `isVerified` = :Verified, `image` = :finalImgName where id = $id";
                        
                        $stm = $this->openConn->prepare($sql);
                        
                        $stm->bindParam(":title", $title);
                        $stm->bindParam(":slug", $slug); 
                        $stm->bindParam(":author", $author);
                        $stm->bindParam(":ques1", $q1);
                        $stm->bindParam(":ques2", $q2);
                        $stm->bindParam(":ques3", $q3);
                        $stm->bindParam(":ques4", $q4);
                        $stm->bindParam(":ques5", $q5);
                        $stm->bindParam(":Verified", $Verified);
                        $stm->bindParam(":finalImgName", $finalImgName); 
                        $stm->execute();
                        if ($stm->rowCount()) {
                            
                $sql1 = "update `namination` set `category` = :category, `subcategory` = :subcategory where id = $Nominationid";
                
                $stm1 = $this->openConn->prepare($sql1);
                $stm1->bindParam(":category", $Category);
                $stm1->bindParam(":subcategory", $SubCategory);
                $stm1->execute();
                            
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
            } else {
                $title = $_POST["title"];
                $slug = $this->createSlug($_POST["title"]);
                 
                $Category = $_POST["Category"];
                $SubCategory = $_POST["SubCategory"];
                
                //Update Category & Sub Category in Nomination Table
                 
                $author = $_POST["author"];
                        
                $q1 = $_POST['q1'];
                $q2 = $_POST['q2'];
                $q3 = $_POST['q3'];
                $q4 = $_POST['q4'];
                $q5 = $_POST['q5'];
                
                $Verified = 1;
                
                $sql = "update `nominatedstories` set `title` = :title, `slug` = :slug, `author` = :author, `q1` = :ques1, `q2` = :ques2, `q3` = :ques3, `q4` = :ques4, `q5` = :ques5, `isVerified` = :Verified where id = $id";
                
                $stm = $this->openConn->prepare($sql); 
                    
                $stm->bindParam(":title", $title);
                $stm->bindParam(":slug", $slug); 
                $stm->bindParam(":author", $author); 
                $stm->bindParam(":ques1", $q1);
                $stm->bindParam(":ques2", $q2);
                $stm->bindParam(":ques3", $q3);
                $stm->bindParam(":ques4", $q4);
                $stm->bindParam(":ques5", $q5);
                $stm->bindParam(":Verified", $Verified);  
                $stm->execute();
                if ($stm->rowCount()) {
                    
            $sql1 = "update `namination` set `category` = :category, `subcategory` = :subcategory where id = $Nominationid";
                
            $stm1 = $this->openConn->prepare($sql1);
            $stm1->bindParam(":category", $Category);
            $stm1->bindParam(":subcategory", $SubCategory);
            $stm1->execute();
                    
                    return "Success";
                } else {
                    return "Error";
                }
            }
        }
    }


function CreateJuryGroup()
    {
        if ($this->adminCheck()) {
            
            $groupname = $_POST["groupname"]; 
            $sql = "insert into `jurygroup` (`groupname`) values (:groupname)";
            
            $stm = $this->openConn->prepare($sql);
            
            $stm->bindParam(":groupname", $groupname); 
            
            $stm->execute();
            if ($stm->rowCount())
                return "Success";
            else
                return "Error";
        }
    }

      
function AddJuryMember()
    {
        if ($this->adminCheck()) {
            if ($_FILES['image']['name']) {
                 $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "../wahspotlight/assets/juryimg/" . $finalImgName;
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                       
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                        
                        $JurygroupId = $_POST["Jurygroup"];
                        $linkedin = $_POST["linkedin"];  
                        $date = date("Y-m-d");
                        
                        $sql = "INSERT INTO `jurymembers` (`name`, `email`, `password`, `groupid`, `linkedin`, `img`, `date`) VALUES(:name, :email, :password, :JurygroupId, :linkedin, :finalImgName, :date)";
                        
                        $stm = $this->openConn->prepare($sql);
                        
                        $stm->bindParam(":name", $name);  
                        $stm->bindParam(":email", $email);  
                        $stm->bindParam(":password", $hashedPassword);  
                        $stm->bindParam(":JurygroupId", $JurygroupId);  
                        $stm->bindParam(":linkedin", $linkedin);  
                        $stm->bindParam(":finalImgName", $finalImgName); 
                        $stm->bindParam(":date", $date); 
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
            }  else{
                    return "Error";
                
            }
        }
    } //Function Ends
    
    
    
     function addCalendarFestivals()
    { 
        $title = addslashes(htmlentities($_POST["title"]));
        
        $festivaldate = $_POST["festivaldate"];
        $description = $_POST["description"];  
        $imagelink = $_POST["imagelink"];  
        
        $sql = "insert into `festivalcalendar` (`date`,`title`,`description`,`imagelink`) values (:festivaldate,:title,:description,:imagelink)";
        $stm = $this->openConn->prepare($sql);
         
        $stm->bindParam(":title", $title); 
        $stm->bindParam(":festivaldate", $festivaldate);
        $stm->bindParam(":description", $description);   
        $stm->bindParam(":imagelink", $imagelink);   
        
        $stm->execute();
        if ($stm->rowCount()) {
            return "Success";
        } else {
            return "Error";
            // Error while inserting
        }
    } //Function Ends
    
     
          
    function GetListOfFestivals($YEAR)
    {
        if($YEAR != NULL){
            $sql = "SELECT * FROM `festivalcalendar` WHERE YEAR(`date`) = '$YEAR' ORDER BY `date` ASC";
        }else{
            $sql = "SELECT * FROM `festivalcalendar` ORDER BY `date` ASC";
        }
        
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    } 
    
    function GetListOfFestivalsByMonths($monthnumber)
    { 
            $sql = "SELECT * FROM `festivalcalendar` WHERE MONTH(`date`) = '$monthnumber' ORDER BY `date` ASC";

        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }
    } //Function Ends
    
     
    function getFestivalById($id)
    { 
            $sql = "SELECT * FROM `festivalcalendar` WHERE `id` = '$id'";

        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }
    } //Function Ends
    
    
    
    
    //################################### WAHCLUB ###########################
    //################################### WAHCLUB ###########################
    
    
    function EarlyRegisteredWahclubUsers()
    {
        
        // Step 1: Get users from wahstory_wahclub
        $sql1 = "SELECT * FROM users ORDER BY `id` DESC";
        $stm1 = $this->SecndopenConn->prepare($sql1);
        $stm1->execute();
        $clubUsers = $stm1->fetchAll(PDO::FETCH_ASSOC);
        
        // Step 2: Get ClubId + created_at from wahstory_wahstory
        $sql2 = "SELECT ClubId, created_at FROM users";
        $stm2 = $this->openConn->prepare($sql2);
        $stm2->execute();
        $mainUsers = $stm2->fetchAll(PDO::FETCH_ASSOC);
        
        // Step 3: Create a map of ClubId => created_at
        $registeredMap = [];
        foreach ($mainUsers as $user) {
            $registeredMap[$user['ClubId']] = $user['created_at'];
        }
        
        // Step 4: Merge into club users
        $combinedUsers = [];
        foreach ($clubUsers as $user) {
            $clubId = $user['id'];
            $user['registered_date'] = $registeredMap[$clubId] ?? null;
            $combinedUsers[] = $user;
        }
        
        // $combinedUsers now contains all club user info + their registered date

        return $combinedUsers;
        
        
    }
    
    function GetAllWAHClubUsers()
    {
        $sql = "SELECT * FROM `users`";
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return NULL; 
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
    function GetWAHClubUserByid($id)
    {
        $ChkEmail = "select * from users where id = '$id'";
        $stm = $this->SecndopenConn->prepare($ChkEmail);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return NULL; 
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
    
    function GetWAHClubUserSkillById($user_id)
    {
        $sql = " SELECT su.*, s.skill FROM `skill_user` su JOIN `skills` s ON su.skill_id = s.id WHERE su.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function GetWAHClubUserToolById($user_id)
    {
        $sql = " SELECT tu.*, t.tool FROM `tool_user` tu JOIN `tools` t ON tu.tool_id = t.id WHERE tu.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
        }
    }
    
    function GetWAHClubUserToolSById($user_id)
    {
        $sql = " SELECT tu.*, t.tool FROM `tool_user` tu JOIN `tools` t ON tu.tool_id = t.id WHERE tu.user_id = '$user_id' ";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetchAll();
            return $data;
        }else{
            return FALSE; 
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
    
    function GetAllNFCCardUrls()
    {
        $sql = "SELECT `unique_slug` FROM `nfccards`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return NULL; 
        }
    }
    
    function GetAllNFCCards()
    {
        $sql = "SELECT * FROM `nfccards`";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetchAll();
        } else {
            return NULL; 
        }
    }
    
    
    
    function createNFCSlug($storedSlugs)
    {
        
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        $randomString = substr_replace($randomString, '-', rand(5, 15), 0);
    
        if($storedSlugs != NULL) {
            while (in_array($randomString, $storedSlugs)) {
                
                $randomString = '';
                for ($i = 0; $i < 20; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
                $randomString = substr_replace($randomString, '-', rand(5, 15), 0);
            }
        }
    
        return $randomString;
    }

    
    
    /* ADD NFC DETAILS BY ID*/
    function GetNFCcardDetilsId($ID)
    {
         $sql = "SELECT * FROM `nfccards` WHERE id = :id";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':id', $ID, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return NULL; 
        }
        
    }
    /* ADD NFC DETAILS BY USERID*/
    function GetNFCcardDetilsUserId($userID)
    {
         $sql = "SELECT * FROM `nfccards` WHERE user_id = :user_id";
        
        $stm = $this->SecndopenConn->prepare($sql);
        $stm->bindParam(':user_id', $userID, PDO::PARAM_INT); // Bind the user_id parameter
        $stm->execute();
        
        if ($stm->rowCount()) {
            return $stm->fetch();
        } else {
            return NULL; 
        }
        
    }
    
    /* ADD BLOGS Starts*/
    function AddNFCcard()
    {
        $NFCRow = $this->GetNFCcardDetilsUserId($_POST["userID"]);
        if($NFCRow === NULL) {
             
        if ($this->adminCheck()) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "/home/wahstory/nfc.wahstory.com/cards/" . $finalImgName;
            $fileTmpName = $file['tmp_name']; 
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                       
                    $fields = ['phone', 'email', 'linkedin', 'instagram'];
                    $Options = [];
                    
                    foreach ($fields as $field) {
                        if(isset($_POST[$field])) {
                          $Options[] =   $_POST[$field];
                        }
                    }
                     
                    $displayOptions = implode(", ", $Options); 
                    $userID = $_POST["userID"];
                    $designation = $_POST["designation"];
                    $otherlink = $_POST["website"];
                              $status = $_POST["status"];
          
                     
                    $storedSlugs = $this->GetAllNFCCardUrls();
                    
                    $NFCurl = $this->createNFCSlug($storedSlugs);
                    
                        $sql = "INSERT INTO `nfccards` (`user_id`, `unique_slug`, `designation`, `otherlink`, `displayoptions`, `status`, `cardfrontimage`, `created_at`, `updated_at`) VALUES (:userID, :NFCurl, :designation, :otherlink, :displayoptions, :status, :cardfrontimage, NOW(), NOW())";
                        
                        $stm = $this->SecndopenConn->prepare($sql);
                            
                        $stm->bindParam(":userID", $userID);
                        $stm->bindParam(":NFCurl", $NFCurl); 
                        $stm->bindParam(":designation", $designation);
                        $stm->bindParam(":otherlink", $otherlink);
                        $stm->bindParam(":displayoptions", $displayOptions);
                        $stm->bindParam(":status", $status);
                        $stm->bindParam(":cardfrontimage", $finalImgName);
                        
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
        } //Img Ends
        
     } else { // nfc Ends
        return "Error1";
        
     }
        
    }
    
    
    /* ADD BLOGS Starts*/
    function UpdateNFCcard($ID)
    {
        if ($this->adminCheck()) {
            
         if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          
                $nfcRow = $this->GetNFCcardDetilsId($ID);
            if($nfcRow != NULL) {
                $path = "/home/wahstory/nfc.wahstory.com/cards/" . $nfcRow["cardfrontimage"];
                unlink($path) or die("Couldn't delete file");
            }
                
          
          
            $file = $_FILES['image'];
            $filename = $file['name'];
            $fileExp = explode('.', $filename);
            $fileActualName = $fileExp[0];
            $fileActualExt = strtolower(end($fileExp));
            $finalImgName =  str_replace(' ', '', $fileActualName) . rand() . "." . $fileActualExt;
            $fileDest = "/home/wahstory/nfc.wahstory.com/cards/" . $finalImgName;
            $fileTmpName = $file['tmp_name']; 
            $fileError = $file['error'];
            $allowed = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if (move_uploaded_file($fileTmpName, $fileDest)) {
                       
                    $fields = ['phone', 'email', 'linkedin', 'instagram'];
                    $Options = [];
                    
                    foreach ($fields as $field) {
                        if(isset($_POST[$field])) {
                          $Options[] =   $_POST[$field];
                        }
                    } 
                     
                    $displayOptions = implode(", ", $Options); 
                    $userID = $_POST["userID"];
                    $designation = $_POST["designation"];
                    $otherlink = $_POST["website"];
                    $status = $_POST["status"];
                     
                     
                        $sql = "UPDATE `nfccards` SET `designation` = :designation, `otherlink` = :otherlink, `displayoptions` = :displayoptions, `cardfrontimage` = :cardfrontimage,`status` = :status, `created_at` = NOW(), `updated_at` = NOW() WHERE `id` = :id && `user_id` = :userID";
                        
                        $stm = $this->SecndopenConn->prepare($sql);
                            
                        $stm->bindParam(":id", $ID);
                        $stm->bindParam(":userID", $userID);
                        
                        $stm->bindParam(":designation", $designation);
                        $stm->bindParam(":otherlink", $otherlink);
                        $stm->bindParam(":displayoptions", $displayOptions);
                        $stm->bindParam(":cardfrontimage", $finalImgName);
                        $stm->bindParam(":status", $status);
                        
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
            
          } else {
              // Update Without Image
              
              
              
               $fields = ['phone', 'email', 'linkedin', 'instagram'];
                $Options = [];
                
                foreach ($fields as $field) {
                    if(isset($_POST[$field])) {
                      $Options[] =   $_POST[$field];
                    }
                }
                 
                $displayOptions = implode(", ", $Options); 
                $userID = $_POST["userID"];
                $designation = $_POST["designation"];
                $otherlink = $_POST["website"];
                $status = $_POST["status"];
                 
                 
                $sql = "UPDATE `nfccards` SET `designation` = :designation, `otherlink` = :otherlink, `displayoptions` = :displayoptions, `status` = :status, `created_at` = NOW(), `updated_at` = NOW() WHERE `id` = :id && `user_id` = :userID";
                
                $stm = $this->SecndopenConn->prepare($sql);
                    
                $stm->bindParam(":id", $ID);
                $stm->bindParam(":userID", $userID);
                
                $stm->bindParam(":designation", $designation);
                $stm->bindParam(":otherlink", $otherlink);
                $stm->bindParam(":displayoptions", $displayOptions);
                $stm->bindParam(":status", $status);
                
                $stm->execute();
                if ($stm->rowCount()) {
                    return "Success";
                } else {
                    return "Error";
                    // Error while inserting
                }
              
              
              
            
          }
            
        } //admin-check
    }
    
    

/* ADD BLOGS Ends*/
    
    
    
    //################################### WAHCLUB Ends ######################
    //################################### WAHCLUB Ends ###################### 
    
    
    
    
    
    
    
}
