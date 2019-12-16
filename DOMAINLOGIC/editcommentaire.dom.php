<?php
    include_once "../CLASSES/COMMENTAIRES/commentaire.php";
    include_once "../UTILS/sanitizer.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";
    session_start();
    if(!validate_session())
    {
        header("Location: ../error.php?ErrorMSG=not%20Logged!");
        die();
    }

    if(!isset($_POST['commentaireID']) && !isset($_POST['contenu']))
    {
        header("Location: ../error.php?ErrorMSG=Error in edit Comment");
        die();
    }
 
    $id = $_POST['commentaireID'];
    $contenu = sanitize_string($_POST['contenu']);

    if(strlen(trim($contenu)) == 0){
        header("Location: ../error.php?ErrorMSG=Commentaire non valide");
        die();
    }
    
    $commentaire = new Commentaire();
    $commentaire->load_Commentaire($id);
    $commentaire->update_commentaire_info($contenu);

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