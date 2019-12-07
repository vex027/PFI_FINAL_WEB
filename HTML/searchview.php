<div class="row">
   <div class="col-sm-8">
    <h1> </h1>
        <div class="row">
        <?php
        include "CLASSES/ALBUM/album.php";
        $albumList = Album::create_album_list_like_title($_POST["search"]);
    
        foreach($albumList as $album){
            echo "<div class=\"col-sm-6\">";
            $album->display_album();
            echo "</div>";
        }
        ?>
        </div>
  </div>   
  <div class="col-sm-6">
    <?php
        $userList = User::create_user_list_like_username($_POST["search"]);
        foreach($userList as $user){
            $user->display_user();
        }
    ?>
  </div>
</div>