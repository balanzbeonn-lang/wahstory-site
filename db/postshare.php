<?php
require_once("postClass.php");
$postObj = new Post();

 $postObj->sharedpost($_POST["postid"], $_POST["userid"]);
 
 //Getting Updated Data
  $cntUpdatedshares =  $postObj->getPostSharedByUSER($_POST['postid'])["count"];
  echo $cntUpdatedshares;
  
 ?>
 