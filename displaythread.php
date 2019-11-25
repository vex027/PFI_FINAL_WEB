<?php
  session_start();
  
  if(!isset($_GET["threadTitle"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }

  $title=$_GET["threadTitle"];

  $id = $_GET["threadID"];
  $cookieName = "nbVisiteThread-$id";
  if(!isset($_COOKIE[$cookieName])){
    $_COOKIE[$cookieName] = 0;
  
    $count = $_COOKIE[$cookieName] + 1;

    var_dump($_COOKIE);
    $temps = time() + 3600*24*365;
    setcookie($cookieName,$count,$temps); 
  }
  else{
    $count = $_COOKIE[$cookieName] + 1;
    $temps = time() + 3600*24*365;
    setcookie($cookieName,$count,$temps); 
  }


  $content = array();
  array_push($content, "postlistview.php");
  array_push($content, "postcreateview.php");

  require_once __DIR__ . "/HTML/masterpage.php";
?>
