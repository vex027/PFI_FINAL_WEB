<?php
    session_start();
    include "UTILS/sessionhandler.php";

    //load view content
    $module = "searchview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Recherche";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";
    

?>