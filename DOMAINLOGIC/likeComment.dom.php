<?php
    include "../CLASSES/COMMENTAIRES/commentaire.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";


    session_start();
    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    $commentaireID = $_POST['commentID'];
    $userID = $_SESSION['userID'];
    $type = $_POST['type'];
    $parentID = $_POST['parentID'];
    //Validation Posts
    $commentaire = new Commentaire();

    $commentaire->add_like($userID,$commentaireID);
    if($type == 'ALB')
    {
        header("Location: ../album.php?id=$parentID");
    }else if($type =='IMG')
    {
        header("Location: ../image.php?id=$parentID");
    }
    
?>