<?php

    include_once "./CLASSES/ALBUM/album.php";
    include_once "./CLASSES/COMMENTAIRES/commentaire.php";

    $image = new image();
    if(!isset($_GET['id']) || !$image->load_image($_GET["id"])){
        header("Location: error.php?ErrorMSG=Image inexistant");
        die();
    }
    $image->add_view(); 
    $parentID=$image->get_imageID();
    $type = 'IMG';
?>

<?php include 'commentScript.php'?>
<script>
        $(document).ready( function() {
        <?php if(validate_session() && isset($_SESSION['userID']) && $image->get_user_alreadyLiked($_SESSION['userID'])) : ?>      
                $('#image-like-btn').addClass('btn-success');
        <?php else : ?>
                $('#image-like-btn').removeClass('btn-success');
        <?php endif;?>
        });
</script>
<div class="container center mb-3" style="margin-top:30px">
    <div>
        <a class="btn btn-success" href='album.php?id=<?php echo $image->get_albumID()?>'>Retour a l'album</a>
    </div>
    <div class="row border-bottom mb-4">
        <form method = "post" action = "DOMAINLOGIC/likeImage.dom.php" class='p-4'>
            <button id='image-like-btn' class="fas fa-arrow-alt-circle-up btn btn-secondary btn-lg" name='imageID' value='<?php echo $parentID?>'></button>
        </form>
        <h1 class='m-0 p-3'><?php echo $image->get_likes() ?> </h1>      
        <button class='fas fa-eye p-2 lg btn btn-lg'></button>
        <h1 class='m-0 p-3'><?php echo $image->get_views() ?> </h1> 
    </div>
    <?php
        $album = new Album();
        $imageID = $image->get_imageID();
        $album->load_album($image->get_albumID());
        if(isset($_SESSION['userID'])){
            $albumID = $album->get_authorID();
            if($_SESSION['userID'] == $albumID)
            {
                echo "<form method = 'post' action = 'DOMAINLOGIC/deleteimage.dom.php'>";
                echo "<button class='btn btn-danger btn-lg text-center m-3' name='imageID' value='$imageID'><i class='fa fa-trash'></i> Delete Image</a></div>";
                echo "</form>";
            }
        }
    
    ?>
    <div div class="border border-dark mb-sm 5">
        <img src="<?php echo $image->get_imageUrl()?>" class="center mb-2" style="max-width:95%;height:auto;width:auto"></img>
        <h2 class="text-muted border-top border-dark">Description : </h2>
        <div class='d-flex flex-row bd-highlight border-dark mb-sm 5 mb-5 text-center'>
            <div class='container p-3 mb-4 border-bottom rounded col'>
                <blockquote class="blockquote text-center">
                    <h5><?php echo $image->get_description()?></h5>
                </blockquote>
            </div>
        </div>
        <div class="d-flex flex-row bd-highlight border-top border-dark mb-sm 5 mb-5">
            <h1 >Espace Commentaire</h1>
        </div>
        <?php include "commentview.php" ?>  
    </div>
</div>

    