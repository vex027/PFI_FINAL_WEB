<div class="container">
    <?php 
        $album = new Album();
        $album->load_album($_GET['id']);
        $albumID = $album->get_id();
        if(validate_session())
        {
            if(isset($_SESSION['userID'])){
                if($_SESSION['userID'] ==$album->get_authorID())
                {
                    echo "<a class='btn btn-success' href='createimage.php?id=$albumID'>Create Image</a>";
                }
            }
        } 
    ?>
    <div class='container p-3 m-4'>
        <p class="text-center text-justify"><?php echo $album->get_description() ?></p>
    </div>
    <div class='row'>
        <?php include "imagelistview.php" ?>
    </div>
</div>