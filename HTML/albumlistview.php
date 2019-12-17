<?php
    include "CLASSES/ALBUM/album.php";
    $albumList = Album::create_album_list();

    foreach($albumList as $album){  //Modifier display_album
        echo "<div class='col-sm-4 text-left'>";
        $album->display_album();
        echo "</div>";
    }
?>