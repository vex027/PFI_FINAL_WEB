<?php

    include "CLASSES/ALBUM/album.php";
    $albumList = Album::create_album_list();

    foreach($albumList as $album){
        $album->display_album();
    }
?>