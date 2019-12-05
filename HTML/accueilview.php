<?php 

    if(isset($_SESSION['userID']))
    {
        echo "<a class='btn btn-success' href='createalbum.php'> Create Album</a>";
    }
?>
<div class='card-group'>
    <?php include "albumlistview.php"?>;
</div>