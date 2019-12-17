<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sanitizer.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $imageID = sanitize_string($_POST['imageID']);
    $userID = sanitize_string($_SESSION['userID']);

    //Validation Posts
    $image = new Image();
    $image->load_image($imageID);
    if($image->get_user_alreadyLiked($userID))
    {
        $image->remove_like($userID,$imageID);
    }else
    {
        $image->add_like($userID,$imageID);
    }
    header("Location: ../image.php?id=$imageID");
?>