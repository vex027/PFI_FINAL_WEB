<?php
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/ALBUM/album.php";

    $title = "Profile";
    $module = "profileview.php";
    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";
?>
