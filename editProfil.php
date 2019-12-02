<?php
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/USER/user.php";

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    //load view content
    $module = "updateprofilview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Edit Profil";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>