<?php 

    if(isset($_SESSION['userID']))
    {
        echo "<a class='btn btn-success' href='createalbum.php'> Create Album</a>";
    }
    echo "<div class='row'>";
    include "albumlistview.php";
    echo "</div>";
?>