<?php  
    include "../CLASSES/IMAGE/image.php";
    $image = new Image();
    $image->load_image($_GET["id"]);
    $image->delete_image();
    var_dump($image);
    
    $file_pointer = "../".$image->get_imageUrl();  
    
    if (!unlink($file_pointer)) {  
    echo ("$file_pointer cannot be deleted due to an error");  
    }  
    else {  
    echo ("$file_pointer has been deleted");  
    } 
    

    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
    
?>