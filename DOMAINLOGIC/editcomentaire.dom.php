<?php
    include_once "../CLASSES/COMMENTAIRES/commentaire.php";
    include_once "../UTILS/sanitizer.php";
    session_start();
    if(!validate_session())
    {
        header("Location: error.php?ErrorMSG=not%20Logged!");
        die();
    }

    if(isset($_POST['comentaireID']) && isset($_POST['contenu'])){

        $id = $_POST['comentaireID'];
        $contenu = sanitize_string($_POST['contenu']);
        
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
    }
?>