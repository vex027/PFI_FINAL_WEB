<?php
    
    include "../CLASSES/ALBUM/album.php";
    include "../CLASSES/COMMENTAIRES/commentaire.php";

    session_start();

    $image = new Image();
    $image->load_image($_GET["id"]);
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

    header("Location: ../album.php?id=$albumID");
    die();
    
?>