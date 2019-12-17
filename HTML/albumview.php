<?php 
    $album = new Album();
    if(!isset($_GET['id']) || !$album->load_album($_GET['id']))
    {
        header("Location: error.php?ErrorMSG=Album inexistant");
        die();
    } 
    $parentID = $album->get_id();
    $author = new User();
    $author->load_user_id($album->get_authorID());
    $authorName = $author->get_username();
    $type = 'ALB';
?>

<div class="container">
        <?php if(validate_session() && isset($_SESSION['userID']) && $_SESSION['userID'] ==$album->get_authorID()) : ?>
            <div class='row p-4'>
                <div class='col'>
                    <a class='btn btn-success h-100' href='createimage.php?id=<?php echo $parentID?>'>Add Image</a>
                </div>
                <div class='col text-center'>
                    <form method = 'post' action = 'editalbum.php?id=<?php echo $album->get_id()?>'>
                        <button id='editBtn' class='btn btn-info text-center' name='albumID' alt='Edit Album' value='<?php echo $parentID?>'>
                            <i class='fa fa-edit'></i> Edit Album
                        </button>
                    </form>
                </div>
                <div class='col text-center'>
                    <form method = 'post' action = 'DOMAINLOGIC/deletealbum.dom.php'>
                        <button class='btn btn-danger text-center' name='albumID' alt='Delete Album' value='<?php echo $parentID?>'>
                            <i class='fa fa-trash' alt='Delete Album'></i> Delete Album
                        </button>
                    </form>
                </div>
             </div>    
        <?php endif;?>  
    <script>
        $(document).ready( function() {
        <?php if(validate_session() && isset($_SESSION['userID']) && $album->get_user_alreadyLiked($_SESSION['userID'])) : ?>      
                $('#album-like-btn').addClass('btn-success');
        <?php else : ?>
                $('#album-like-btn').removeClass('btn-success');
        <?php endif;?>
        });
    </script> 
    <div class="row border-bottom mb-4">
        <form method = "post" action = "DOMAINLOGIC/likeAlbum.dom.php" class='p-4'>
            <button id='album-like-btn' class="fas fa-arrow-alt-circle-up btn btn-secondary btn-lg" name='albumID' value='<?php echo $parentID?>'></button>
        </form>
        <h1 class='m-0 p-3'><?php echo $album->get_likes() ?> </h1>
        <h1 class='m-0 p-3'>
            <small class='text-muted'> Titre : </small><span id='albumTitle'><?php echo $album->get_title()?></span>
            <small class='text-muted'>| By : 
                <?php echo "<a class='text-decoration-none' href='profile.php?username=$authorName'>$authorName</a>"?>
            </small>
        </h1>
    </div>
    <h2>Description</h2> 
    <div class='container p-3 mb-4 border-bottom rounded col'>
        <blockquote class="blockquote text-center">
            <h5><?php echo $album->get_description()?></h5>
        </blockquote>
    </div>
    <div class='row'>
        <?php include "imagelistview.php" ?>
    </div>          
    <?php include "commentview.php" ?>          
</div>