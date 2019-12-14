<?php
    include __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/sanitizer.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";
    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $album = new Album();
    $album->load_album($_GET['id']);

    if(isset($_POST['titleAlbum'])){
        $album->update_title($_POST['titleAlbum']);   
    }

    if(isset($_POST['description'])){
        $album->update_description($_POST['description']);
    }

    $albumID = $album->get_id();
    header("Location: ../album.php?id=$albumID");
    die();
?>