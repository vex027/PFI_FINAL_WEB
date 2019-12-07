<?php
  include_once "CLASSES/COMMENTAIRES/commentaire.php";

  if(!empty($_POST["newCommentCount"])){
    $lim = $_POST["newCommentCount"];
  }
  else{
    $lim = 2;
  }

  $comment = new Commentaire();
  if($type =='IMG'){
    $comments = $comment->create_commentaire_list_image($_GET['id'],$lim);
  }

  if($type=='ALB'){
    $comments = $comment->create_commentaire_list_album($_GET['id'],$lim);
  }
  
  foreach($comments as $comment){
    $comment->display();
  }
?>