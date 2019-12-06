<?php 

    if(isset($_SESSION['userID']))
    {
        echo "<a class='btn btn-success' href='createalbum.php'> Create Album</a>";
    }
?>
<div class='row'>
    <?php include "albumlistview.php"?>;
</div>