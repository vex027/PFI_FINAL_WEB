<?php
    
    include_once "../CLASSES/ALBUM/album.php";
    include_once "../CLASSES/COMMENTAIRES/commentaire.php";

    session_start();

    $image = new Image();
    $image->load_image($_POST["imageID"]);
    $album = new Album();
    $album->load_album($image->get_albumID());

    if($_SESSION["userID"] != $album->get_authorID()){
        header("Location: error.php?ErrorMSG=Not%20the%20author!");
        die();
    }

    
    
    $image->delete_image();
    
    $file_pointer = "../".$image->get_imageUrl();  
    unlink($file_pointer);

    $commentaireList = Commentaire::create_commentaire_list_image_noLimit($image->get_imageID());
    foreach($commentaireList as $com){
        $com->delete_commentaire();
    }

    $albumID = $image->get_albumID();

    if($image->get_number_image_album($album->get_id())==0){
        $commentaireList = Commentaire::create_commentaire_list_album_noLimit($albumID);
        foreach($commentaireList as $com){
            $com->delete_commentaire();
        }
        $album->delete_album();
    }

    header("Location: ../album.php?id=$albumID");
    die();
    
?>