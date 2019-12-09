<?php 
    $profilUsername = $_GET['username'];
    if(User::validate_username_not_exists($profilUsername)){
        header("Location: error.php?ErrorMSG=This User doesn't exist!");
        die();
    }
    $user = new User();
    $user->load_user_username($profilUsername);
    $userID = $user->get_id();
    $mostLikedAlbum = Album::get_most_likedAlbum($userID);
    $lastAlbum = Album::get_last_album($userID);
    $firstAlbum = Album::get_first_album($userID);
?>
<div class="container" style="margin-top:30px">
    <h1><?php echo $profilUsername?> 's Profile</h1>
      <?php 
        if(validate_session())
        {
          if($profilUsername == $_SESSION['userName']){
            echo "<a href='editProfil.php' class='float-right pb-2 btn btn-success btn-lg ml-4 mb-4'>Edit <i class='fas fa-edit'></i></a>";
          }
        }
      ?>
      <div class="col-sm-4 float-left mh-25 mw-25" style="margin:-20px 0 0 -300px">
        <img src=<?php echo $user->get_imagesProfile()?> class="rounded-circle img-thumbnail" style="width:250px;height:275px" alt="Image de Profil">
      </div>
      <div class="col-sm-11">
        <ul class="list-group" style="margin-top:50px">
          <li class="list-group-item"> Most Liked Album : <a href="album.php?id=<?php echo $mostLikedAlbum->get_id()?>"> <?php echo $mostLikedAlbum->get_title()?> </a></li>
          <li class="list-group-item"> Last Album : <a href="album.php?id=<?php echo $lastAlbum->get_id()?>">  <?php echo $lastAlbum->get_title()?> </a></li>
          <li class="list-group-item"> First Album : <a href="album.php?id=<?php echo $firstAlbum->get_id()?>"> <?php echo $firstAlbum->get_title()?></a></li>
        </ul>
      </div>      
</div>
<div class="container" style="margin-top:100px">
  <?php 
    $albumList = Album::create_album_list_by_user($userID);
    if(!empty($albumList)){
        echo "<div class=\"row\">";
        foreach($albumList as $album){
            echo "<div class=\"col-sm-4\">";
            $album->display_album();
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<h3>Aucun Album</h3>";
    }
  ?>
</div>
