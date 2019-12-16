<?php 
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/ALBUM/album.php";
    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
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