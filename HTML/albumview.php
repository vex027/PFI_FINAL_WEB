<?php 

    if(!isset($_GET['id'])){
        header("Location: error.php?ErrorMSG=Album inexistant");
        die();
    }

    $album = new Album();
    if(!$album->load_album($_GET['id'])){
        header("Location: error.php?ErrorMSG=Album inexistant");
        die();
    }
    
    $parentID = $album->get_id();
    $author = new User();
    $author->load_user_id($album->get_authorID());
    $authorName = $author->get_username();
?>

<div class="container">
    <?php 
        if(validate_session())
        {
            if(isset($_SESSION['userID'])){
                if($_SESSION['userID'] ==$album->get_authorID())
                {
                    echo "<div class='row p-4'>";
                    echo "<div class='col'>";
                    echo "<a class='btn btn-success h-100' href='createimage.php?id=$parentID'>Add Image</a>";
                    echo "</div>";
                    echo "<div class='col text-center'>";
                    echo "<form method = 'post' action = 'DOMAINLOGIC/deletealbum.dom.php'>";
                    echo "<button class='btn btn-danger text-center' name='albumID' alt='Delete Image' value='$parentID'><i class='fa fa-trash'></i> Delete Album</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
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
    <script>
        $(document).ready( function() {
    <?php 
        if($album->get_user_alreadyLiked($_SESSION['userID']))
        {          
            echo "$('#album-like-btn').addClass('btn-success');";
        }else{
            echo "$('#album-like-btn').removeClass('btn-success');";
        } 
    ?>  
        });
    </script> 
    <div class="row border-bottom mb-4">
        <form method = "post" action = "DOMAINLOGIC/likeAlbum.dom.php" class='p-4'>
            <button id='album-like-btn' class="fas fa-arrow-alt-circle-up btn btn-secondary btn-lg" name='albumID' value='<?php echo $parentID?>'></button>
        </form>
        <h1 class='m-0 p-3'><?php echo $album->get_likes() ?> </h1>
        <h1 class='m-0 p-3'>
            <small class='text-muted'> Titre : </small><?php echo $album->get_title()?> 
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
        <!--Commentaire section  -->      
    <?php include "commentview.php"; ?>        
    
</div>