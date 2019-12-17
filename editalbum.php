<?php 
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/ALBUM/album.php";
    if(!validate_session()){
        header("Location: error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    $album = new Album();
    if(!isset($_GET['id']) || !$album->load_album($_GET['id']))
    {
        header("Location: error.php?ErrorMSG=Album inexistant");
        die();
    } 

    if($_SESSION["userID"] != $album->get_authorID()){
        header("Location: error.php?ErrorMSG=Not%20the%20author!");
        die();
    }
    //load view content
    $module = "editalbumview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Édition d'Albums";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>