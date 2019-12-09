<?php 
    session_start();
    include "UTILS/sessionhandler.php";


    if(!validate_session())
    {
        header("Location: error.php?ErrorMSG=Not logged in !");
        die();
    }
    //load view content
    $module = "createimageview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Ajout d'Images";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>