<?php
    include "../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();
    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    $albumID = $_POST['albumID'];
    $userID = $_SESSION['userID'];

    //Validation Posts
    $album = new Album();
    $album->load_album($albumID);
    if($album->get_user_alreadyLiked($userID))
    {
        $album->remove_like($userID,$albumID);
    }else
    {
        $album->add_like($userID,$albumID);
    }
    header("Location: ../album.php?id=$albumID");
?>