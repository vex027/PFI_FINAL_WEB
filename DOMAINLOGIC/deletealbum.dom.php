<?php  
    include_once "../CLASSES/ALBUM/album.php";
    include_once "../CLASSES/COMMENTAIRES/commentaire.php";
    include_once "../CLASSES/IMAGE/image.php";
    session_start();
    if(!validate_session())
    {
        header("Location: ../error.php?ErrorMSG=not%20Logged!");
        die();
    }

    $album = new Album();
    if(!isset($_POST["albumID"]) || !$album->load_album($_POST["albumID"]))
    {
        header("Location: ../error.php?ErrorMSG=Album inexistant");
        die();
    } 

    if($_SESSION["userID"] != $album->get_authorID()){
        header("Location: ../error.php?ErrorMSG=Not%20the%20author!");
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
    header("Location: ../accueil.php");
    die();
?>