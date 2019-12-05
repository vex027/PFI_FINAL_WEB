<div class="container">
    <?php 
    
        if(validate_session())
        {
            $album = new Album();
            $album->load_album($_GET['id']);
            $albumID = $album->get_id();
            $authorID = $album->get_authorID();
            if($_SESSION['userID'] ==$authorID)
            {
                echo "<a class='btn btn-success' href='createimage.php?id=$albumID'>Create Image</a>";
            }
        } 
    ?>
    <div class='row'>
        <?php include "imagelistview.php" ?>
    </div>
</div>