<?php 

    include "CLASSES/IMAGE/image.php";
    $imageList = Image::create_image_list($_GET['id']);

    foreach($imageList as $image){
        $image->display();
    }
?>
