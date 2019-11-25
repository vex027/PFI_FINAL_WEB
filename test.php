<?php
    include "classes/user/user.php";

    session_start();

    $testUser = new User();
    $testUserTDG = new UserTDG();

    $test = $testUserTDG->get_all_users();

    echo "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    var_dump($test);

    var_dump($_SESSION);


?>
