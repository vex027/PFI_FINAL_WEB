<?php
    include_once "../CLASSES/COMMENTAIRES/commentaire.php";
    session_start();
    if(!validate_session())
    {
        header("Location: error.php?ErrorMSG=not%20Logged!");
        die();
    }

    $commentaire = new Commentaire();
    $commentaire->load_Commentaire($_POST['commentaireID']);
    $commentaire->delete_commentaire();

    $parentID = $commentaire->get_parentID();

    if($commentaire->get_typeCom() == 'IMG'){
        header("Location: ../image.php?id=$parentID");
        die();
    }
    else{
        $parentID;
        header("Location: ../album.php?id=$parentID");
        die();
    }
?>