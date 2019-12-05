<?php 
    session_start();
    include "UTILS/sessionhandler.php";

    //load view content
    $module = "createimageview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Ajout d'Images";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>