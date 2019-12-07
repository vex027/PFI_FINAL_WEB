<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";


    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $imageID = $_POST['imageID'];
    $userID = $_SESSION['userID'];

    //Validation Posts
    $image = new Image();

    $image->add_like($userID,$imageID);
    header("Location: ../image.php?id=$imageID");
?>