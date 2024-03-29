<?php
    include __DIR__ . "/../UTILS/sanitizer.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";
    include __DIR__ . "/../CLASSES/COMMENTAIRES/commentaire.php";
    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $type = $_GET["type"];
    $id = $_GET["id"];
    $contenu = sanitize_string($_POST["commentaireIMG"]);

    if(strlen(trim($contenu)) == 0){
        header("Location: ../error.php?ErrorMSG=Commentaire non valide");
        die();
    }
    $commentaire = new Commentaire();
    
    if(!$commentaire->ajouter_commentaire($type,$contenu,$id,$_SESSION['userID'])){
       header("Location: ../error.php?ErrorMSG=Echec%20creation%20commentaire!");
       die();
    }
    
    if($type == "IMG"){
        header("Location: ../image.php?id=$id");
        die();
    }
    if($type == "ALB"){
        header("Location: ../album.php?id=$id");
        die();
    }
    
?>