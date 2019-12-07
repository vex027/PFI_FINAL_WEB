<?php  
    include "../CLASSES/IMAGE/image.php";
    $image = new Image();
    $image->load_image($_GET["id"]);
    $image->delete_image();
    
    $file_pointer = "../".$image->get_imageUrl();  
    unlink($file_pointer);

    foreach($commentaireList as $image){
        $image->delete_image();
        $file_pointer = "../".$image->get_imageUrl(); 
        unlink($file_pointer);
         
    }

    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
    
?>