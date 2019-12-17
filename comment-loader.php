<?php
    include_once "CLASSES/COMMENTAIRES/commentaire.php";
    include_once __DIR__ . "/UTILS/sessionhandler.php";
    if(!isset($_SESSION)){
      session_start();
    }

    if(isset($_GET['type'])){
      $type =$_GET['type'];
    }
    $parentID = $_GET['id'];
    if(!empty($_POST["newCommentCount"])){
      $lim = $_POST["newCommentCount"];
    }
    else{
      if(!isset($_COOKIE['commentCount-'.$type.$parentID])){
        $lim = 4;
      }else{
        $lim = $_COOKIE['commentCount-'.$type.$parentID];
      }
    }
    
    $comment = new Commentaire();
    if($type =='IMG'){
      $comments = $comment->create_commentaire_list_image($parentID,$lim);
    }

    if($type=='ALB'){
      $comments = $comment->create_commentaire_list_album($parentID,$lim);
    }
    
    foreach($comments as $comment){  
      $comment->display();
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