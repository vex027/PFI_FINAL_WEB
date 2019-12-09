<?php
    include "../CLASSES/USER/user.php";
    include __DIR__ . "/../UTILS/sanitizer.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(validate_session()){
        header("Location: ../error.php?ErrorMSG=already%20logged%20in!");
        die();
    }

    //prendre les variables du Post
    $email = sanitize_string($_POST["email"]);
    $pw = $_POST["pw"];

    //Validation Posts
    $aUser = new User();

    //validateLogin
    if($aUser->Login($email, $pw))
    {
        login($aUser->get_id(), $aUser->get_email(), $aUser->get_username());
        header("Location: ../accueil.php");
        die();
    }

    header("Location: ../error.php?ErrorMSG=invalid email or password");
    die();
?>