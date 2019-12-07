<?php  
    include "../CLASSES/ALBUM/album.php";
    include "../CLASSES/COMMENTAIRES/commentaire.php";

    session_start();

    $album = new Album();
    $album->load_album($_POST["albumID"]);

    if($_SESSION["userID"] != $album->get_authorID()){
        header("Location: error.php?ErrorMSG=Not%20the%20author!");
        die();
    }

    $imageList = Image::create_image_list($album->get_id());

    foreach($imageList as $image){
        $image->delete_image();
        $file_pointer = "../".$image->get_imageUrl(); 
        unlink($file_pointer);
        $commentaireList = Commentaire::create_commentaire_list_image_noLimit($image->get_imageID());
        foreach($commentaireList as $com){
            $com->delete_commentaire();
        }
    }

    $commentaireList = Commentaire::create_commentaire_list_album_noLimit($album->get_id());
    foreach($commentaireList as $com){
        $com->delete_commentaire();
    }

    $album->delete_album();

    $albumID = $image->get_albumID();
    header("Location: ../accueil.php");
    die();
?>