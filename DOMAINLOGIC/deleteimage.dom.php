<?php  
    include "../CLASSES/IMAGE/image.php";
    $image = new Image();
    $image->load_image($_GET["id"]);
    $image->delete_image();
    $albumID = $image->get_albumID();
    header("Location: ../album.php?id=$albumID");
    die();
?>