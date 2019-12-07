<div class="row">
   <div class="col-sm-8">
    <h1>Recherche d'Album</h1>       
    <?php
    include "CLASSES/ALBUM/album.php";
    $albumList = Album::create_album_list_like_title($_POST["search"]);
    if(!empty($albumList)){
        echo "<div class=\"row\">";
        foreach($albumList as $album){
            echo "<div class=\"col-sm-6\">";
            $album->display_album();
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<h3>Aucun résultat</h3>";
    }
    ?>   
  </div>   
  <div class="col-sm-4">
  <h1>Recherche de User</h1>
    <?php
        $userList = User::create_user_list_like_username($_POST["search"]);
        if(!empty($userList)){       
            foreach($userList as $user){
                $user->display_user();
            }
        }
        else{
            echo "<h3>Aucun résultat</h3>";
        }
    ?>
  </div>
</div>