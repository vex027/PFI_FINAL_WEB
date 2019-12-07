<?php

    include "./CLASSES/ALBUM/album.php";
    include "./CLASSES/COMMENTAIRES/commentaire.php";
    $image = new image();
    $image->load_image($_GET["id"]); 
    $parentID=$image->get_imageID();
?>
<!---- Script Load comments !-->
<script>
      $(document).ready( function() {
        var CommentCount = 4;
        $("#comment-load-btn").click( function() {
            CommentCount = CommentCount + 4;
          $("#comments").load("comment-loader.php?id=<?php echo $image->get_imageID()?>&type=IMG", {
            newCommentCount: CommentCount
            });
        });
      });
</script>
<div class="container center mb-3" style="margin-top:30px">
    <?php
    if(validate_session()){
        $album = new Album();
        $imageID = $image->get_imageID();
        $album->load_album($imageID);
        if(isset($_SESSION['userID'])){
            $albumID = $album->get_authorID();
            if($_SESSION['userID'] == $albumID)
            {
                echo "<div><a class='btn btn-success mb-3' href='DOMAINLOGIC/deleteimage.dom.php?id=$imageID'>Delete Image</a></div>";
            }
        }
    }
    ?>
    <div div class="border border-dark mb-sm 5">
        
        <!-- Affiche limage Selectionner -->
        <div>
            <h1> <?php echo $image->get_description() ?></h1>
        </div>
        <img src="<?php echo $image->get_imageUrl()?>" class="center mb-2" style="max-width:95%;height:auto;width:auto"></img>

        <!--Upvote arrow & nb de UpVotes  -->
        <div class="d-flex flex-row bd-highlight border-top border-dark mb-sm 5">
            <div class="p-2 bd-highlight  border-right border-dark mb-sm 5">
                <form method = "post" action = "DOMAINLOGIC/likeImage.dom.php">
                    <button id="like-image-btn" class="fas fa-arrow-alt-circle-up btn" name='imageID' value='<?php echo $image->get_imageID()?>'></button>
                </form>
            </div>
            <div id="like-image-counter" class="p-2 bd-highlight  border-right border-dark mb-sm 5"> <?php echo $image->get_likes() ?></div>
        </div>

        <!--Commentaire section  -->
        <div div id='comments' class="container border-top border-dark mb-sm 5">
            <?php 
                $type ='IMG';
                include "comment-loader.php";
            ?>
        </div>
        <button id="comment-load-btn" type="button" class="btn btn-primary" name="button">Plus de Commentaire</button>
        
        <div div class="container border-top border-dark mb-sm 5">
            <h1>Ajouter un commentaire</h1>     
        </div>
        <form class method = "post" action = "./DOMAINLOGIC/ajoutercommentaire.dom.php?id=<?php echo $image->get_imageID()?>&type=IMG" enctype="multipart/form-data">
        <div class="form-group">
            <label for="commentaireIMG">Commentaire: </label>
            <textarea class="form-control" name="commentaireIMG" id="commentaireIMG" rows="3" id="commentaireIMG"></textarea>     
        </div>
            <button class="btn btn-success mb-2" type="submit">Ajouter un commentaire</button>
        </form>
    </div>
</div>

    