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
    <!---- Script Load comments !-->
    
    <script>
        $(document).ready( function() {
            var CommentCount = 4;
            $("#comment-load-btn").click( function() {
                CommentCount = CommentCount + 4;
            $("#comments").load("comment-loader.php?id=<?php echo $albumID?>", {
                newCommentCount: CommentCount
                });
            });
        });
    </script>
    
    <script>
        $(document).ready( ()=> {
            $("#like-image-btn").click( function() {
                    
                });
            });
        
    </script>
    
    
    <div class='container p-3 m-4'>
        <p class="text-center text-justify"><?php echo $album->get_description() ?></p>
    </div>
    <div class='row'>
        <?php include "imagelistview.php" ?>
    </div>
    <div>
        <div class="d-flex flex-row bd-highlight border-top border-right border-dark mb-sm 5">
            <div class="p-2 bd-highlight border-left border-right border-dark mb-sm 5">
                <form method = "post" action = "DOMAINLOGIC/like.dom.php">
                    <button id="like-image-btn" class="fas fa-arrow-alt-circle-up btn" name='imageID' value='<?php echo $albumID?>'></button>
                </form>
            </div>
            <div id="like-image-counter" class="p-2 bd-highlight border-right border-dark mb-sm 5"> <?php echo $albumID ?></div>
        </div>
        
        <!--Commentaire section  -->      
        <div div id='comments' class="container border border-dark">
            <?php
                $type ='ALB';
                include "comment-loader.php"
              ?>
        </div>
        <button id="comment-load-btn" type="button" class="btn btn-primary" name="button">Plus de Commentaire</button>
        
        <div div class="container border-dark mb-sm 5">
            <h1>Ajouter un commentaire</h1>     
        </div>
        <form class method = "post" action = "./DOMAINLOGIC/ajoutercommentaire.dom.php?id=<?php echo $albumID?>&type=ALB" enctype="multipart/form-data">
        <div class="form-group">
            <label for="commentaireIMG">Commentaire: </label>
            <textarea class="form-control" name="commentaireIMG" id="commentaireIMG" rows="3" id="commentaireIMG"></textarea>     
        </div>
            <button class="btn btn-success mb-2" type="submit">Ajouter un commentaire</button>
        </form>           
    </div>
</div>