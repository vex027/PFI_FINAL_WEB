<div class="container">
    <?php 
        $album = new Album();
        $album->load_album($_GET['id']);
        $parentID = $album->get_id();
        if(validate_session())
        {
            if(isset($_SESSION['userID'])){
                if($_SESSION['userID'] ==$album->get_authorID())
                {
                    echo "<a class='btn btn-success' href='createimage.php?id=$parentID'>Create Image</a>";
                }
            }
        } 
    ?>
    <!---- Script Load comments !-->
    
    <script>
        $(document).ready( function() {
            var CommentCount = 4;
            $("#comment-load-btn").click( function() {
                CommentCount = CommentCount + 4;
            $("#comments").load("comment-loader.php?id=<?php echo $parentID?>&type=ALB", {
                newCommentCount: CommentCount
                });
            });
        });
    </script>     
    <div class='container p-3 m-4'>
        <p class="text-center text-justify"><?php echo $album->get_description()?></p>
    </div>
    <div class='row'>
        <?php include "imagelistview.php" ?>
    </div>
    <div>
        <!-- UPvote Button -->
        <div class="d-flex flex-row bd-highlight border-top border-right border-dark mb-sm 5">
            <div class="p-2 bd-highlight border-left border-right border-dark mb-sm 5">
                <form method = "post" action = "DOMAINLOGIC/likeAlbum.dom.php">
                    <button id="like-album-btn" class="fas fa-arrow-alt-circle-up btn" name='albumID' value='<?php echo $parentID?>'></button>
                </form>
            </div>
            <div id="like-album-counter" class="p-2 bd-highlight border-right border-dark mb-sm 5"> <?php echo $album->get_likes() ?></div>
        </div>
        
        <!--Commentaire section  -->      
        <?php include "commentview.php"; ?>
    </div>          
    
</div>