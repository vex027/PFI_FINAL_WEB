<?php  
    include "../CLASSES/ALBUM/album.php";
    $album = new Album();
    $album->load_album($_POST["albumID"]);

    $imageList = Image::create_image_list($album->get_id());

    foreach($imageList as $image){
        $image->delete_image();
        $file_pointer = "../".$image->get_imageUrl(); 
        unlink($file_pointer);
        $commentaireList = Commentaire::create_commentaire_list_image_noLimit($image->get_imageID());
        foreach($commentaireList as $com){
            //deletecommentaire
        }
    }

    $commentaireList = Commentaire::create_commentaire_list_album_noLimit($album->get_id());
    foreach($commentaireList as $com){
        //deletecommentaire
    }

    $album->

    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
?>