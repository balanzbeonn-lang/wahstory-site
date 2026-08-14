<?php
require_once("postClass.php");
$postObj = new Post();

if($postObj->CheckUserBookmarkedAlready($_POST["postid"], $_POST["userid"])){
    //if user already Bookmarked Same Story
    
}else{
     $postObj->bookmarkpost($_POST["postid"], $_POST["userid"]);    
}
 
 //Getting Updated Data
  $cntUpdatedBookmarks =  $postObj->getPostBookmarkedByUSER($_POST['postid'])["count"];
  echo $cntUpdatedBookmarks;
 
 ?>
 