<?php
  include_once "CLASSES/COMMENTAIRES/commentaire.php";
  include_once __DIR__ . "/UTILS/sessionhandler.php";
  if(!isset($_SESSION)){
    session_start();
  }
  if(!empty($_POST["newCommentCount"])){
    $lim = $_POST["newCommentCount"];
  }
  else{
    $lim = 2;
  }

  if(isset($_GET['type'])){
    $type =$_GET['type'];
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
    $parentID = $comment->get_parentID();
    $commentID = $comment->get_commentaireID();
    if(validate_session()){
      echo "<script>";
      echo " $(document).ready( function() {";
      $id = $comment->get_commentaireID();
      if($comment->get_user_alreadyLiked($_SESSION['userID']))
      {          
          echo "$('#like-comment-btn-$id').addClass('btn-success')});";
      }else{
          echo "$('#like-comment-btn-$id').removeClass('btn-success')});";
      } 
      echo "</script>";
    } 
  }
?>