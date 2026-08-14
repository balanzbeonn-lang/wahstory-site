<?php
require_once("postClass.php");
$postObj = new Post();

if($postObj->CheckUserReactedDuplicate($_POST["postid"], $_POST["userid"], $_POST["reaction"])){
    //if user already reacted by same Reaction 
    
    
}elseif($postObj->CheckUserReactedDifferent($_POST["postid"], $_POST["userid"], $_POST["reaction"])){
    
     $postObj->Updatelikepost($_POST["postid"], $_POST["userid"], $_POST["reaction"]);
     
}else{
     $postObj->likepost($_POST["postid"], $_POST["userid"], $_POST["reaction"]);
}

 //Getting Updated Data
  $cntUpdatedReactions =  $postObj->getPostReactionByUSER($_POST['postid'])["count"];
  echo $cntUpdatedReactions;
 ?>
 