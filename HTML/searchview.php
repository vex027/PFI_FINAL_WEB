<div class="row">
  <div class="col-sm-8">
    <div class="row">
    <?php
        $title = $_POST["search"];
        include "CLASSES/ALBUM/album.php";
        $albumList = Album::create_album_list_like_title($title);
    
        foreach($albumList as $album){
            echo "<div class=\"col-sm-6\">";
            $album->display_album();
            echo "</div>";
        }
    ?>
    <div class="row">
  </div>   
  <div class="col-sm-6">
  <?php

    ?>
  </div>
</div>