<?php
    session_start();

    include "./CLASSES/COMMENTAIRES/commentaire.php";

    $type = $_GET["type"];
    $id = $_GET["id"];
    $contenu = $_POST["commentaireIMG"];

    $commentaire = new Commentaire();
    $commentaire->ajouter_commentaire($type,$contenu,$id)

    if($type = "IMG"){
        header("Location: ../image.php?id=$id");
        die();
    }
    if($type = "ALB"){
        header("Location: ../album.php?id=$id");
        die();
    }
    
?>