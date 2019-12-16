<?php
    include "../CLASSES/COMMENTAIRES/commentaire.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";


    session_start();
    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    $commentaireID = $_POST['commentID'];
    $userID = $_SESSION['userID'];
    $type =$_POST['type'];
    $parentID = $_POST['parentID'];

    //Validation Posts
    $commentaire = new Commentaire();
    $commentaire->load_Commentaire($commentaireID);
    if($commentaire->get_user_alreadyLiked($userID))
    {
        $commentaire->remove_like($userID,$commentaireID);
    }else
    {
        $commentaire->add_like($userID,$commentaireID);
    }


    if($type == 'ALB')
    {
        header("Location: ../album.php?id=$parentID#like-comment-btn-$commentaireID");
    }else if($type =='IMG')
    {
        header("Location: ../image.php?id=$parentID#like-comment-btn-$commentaireID");
    }
    
?>