<?php  
    include "../CLASSES/IMAGE/image.php";
    $image = new Image();
    $image->load_image($_GET["id"]);
    $image->delete_image();
    
    $file_pointer = "../".$image->get_imageUrl();  
    unlink($file_pointer);

    $commentaireList = Commentaire::create_commentaire_list_image_noLimit($image->get_imageID());
    foreach($commentaireList as $com){
        //deletecommentaire
    }

    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
    
?>