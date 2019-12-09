<?php
  include "../CLASSES/USER/user.php";
  include "../UTILS/formvalidator.php";
  include "../UTILS/sanitizer.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";
  
  session_start();

  if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
  }

  if(!isset($_POST["oldpw"]) || !isset($_POST["newpw"])){
    header("Location: ../error.php?ErrorMSG=invalid%20password");
    die();
  }

  $oldpw = sanitize_string($_POST["oldpw"]);
  $newpw = sanitize_string($_POST["newpw"]);
  $pwval = sanitize_string($_POST["pwValidation"]);


  if(!Validator::validate_password($newpw)){
    header("Location: ../error.php?ErrorMSG=invalid%20password");
    die();
  }

  $user = new User();
  if(!$user->update_user_pw($_SESSION["userEmail"], $oldpw, $newpw, $pwval)){
    header("Location: ../error.php?ErrorMSG=Bad%20request");
    die();
  }
  $username = $_SESSION["userName"];
  header("Location: ../profile.php?username=$username");
  die();

 ?>
