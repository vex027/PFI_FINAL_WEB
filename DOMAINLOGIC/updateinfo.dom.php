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

  $email = sanitize_string($_POST["email"]);
  $username = sanitize_string($_POST["username"]);

  //verification des parametres
  if(empty($email) && empty($username)){
    header("Location: ../error.php?ErrorMSG=invalid email or username");
    die();
  }

  if(!empty($email) && Validator::validate_email($email)){
    $newmail = $email;
  }
  else{
    $newmail = $_SESSION["userEmail"];
  }

  if(!empty($username)){
    $newname = $username;
  }
  else{
    $newname = $_SESSION["userName"];
  }

  $user = new User();
  if(!$user->update_user_info($_SESSION["userEmail"], $newmail, $newname)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
  }
  header("Location: ../profile.php?username=$username");
  die();
?>
