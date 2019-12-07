<?php 
    $profilUsername = $_GET['username'];
    if(User::validate_username_not_exists($profilUsername)){
        header("Location: error.php?ErrorMSG=This User doesn't exist!");
        die();
    }
    $user = new User();
    $user->load_user_username($profilUsername);
?>
<div class="container" style="margin-top:30px">
    <h1><?php echo $profilUsername?> 's Profile</h1>
      <?php 
        if(validate_session())
        {
          if($profilUsername == $_SESSION['userName']){
            echo "<a href='editProfil.php' class='float-right btn btn-success btn-lg'>Edit</a>";
          }
        }
      ?>
      <div class="col-sm-4 float-left mh-25 mw-25" style="margin:-20px 0 0 -300px">
        <img src=<?php echo $user->get_imagesProfile()?> class="rounded-circle img-thumbnail" style="width:250px;height:275px" alt="Image de Profil">
      </div>
      <div class="col-sm-11">
        <ul class="list-group" style="margin-top:50px">
          <li class="list-group-item"> Meilleur Album : <a href=""> meilleur album </a></li>
          <li class="list-group-item"> Dernier Album : <a href=""> dernier album </a></li>
          <li class="list-group-item"> Premier Album : <a href=""> premier album </a></li>
        </ul>
      </div>      
</div>
<div class="container" style="margin-top:100px">
  <?php 
    $albumList = Album::create_album_list_by_user($user->get_id());
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
