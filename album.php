<?php 
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/ALBUM/album.php";

    //load view content
    $module = "albumview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Albums";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>