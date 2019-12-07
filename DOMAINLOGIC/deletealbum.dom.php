<?php  
    include "../CLASSES/ALBUM/album.php";
    $album = new Album();
    $album->load_album($_POST["albumID"]);

    $imageList = Image::create_image_list($album->get_id());

    foreach($imageList as $image){
        $image->delete_image();
        $file_pointer = "../".$image->get_imageUrl(); 
        unlink($file_pointer);
         
    }

    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
?>