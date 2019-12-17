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

    if($_SESSION["userID"] != $album->get_authorID()){
        header("Location: ../error.php?ErrorMSG=Not%20the%20author!");
        die();
    }

    if(!isset($_POST['titleAlbum']) || strlen(trim($_POST['titleAlbum'])) == 0)
    {
        header("Location: ../error.php?ErrorMSG=Titre non valide");
        die();
    }

    $titre = $_POST['titleAlbum'];
    if($titre != $album->get_title())
    {
        if($album->load_album_title($titre))
        {
            header("Location: ../error.php?ErrorMSG=Titre déja existant");
            die();
        }
        $album->update_title($titre);
    }

    if(isset($_POST['description'])){
        $album->update_description($_POST['description']);
    }

    $albumID = $album->get_id();
    header("Location: ../album.php?id=$albumID");
    die();
?>