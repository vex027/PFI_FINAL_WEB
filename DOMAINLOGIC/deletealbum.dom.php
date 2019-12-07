<?php  
    include "../CLASSES/ALBUM/album.php";
    
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