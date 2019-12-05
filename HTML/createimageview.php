<div class="container align-middle border mb-sm-5">
    <h2> Ajouter un image à l'album : 
        <?php 
            include __DIR__ . "/../CLASSES/ALBUM/album.php";
            $album = new Album();
            $album->load_album($_GET["id"]);  
            echo $album->get_title();
        ?>
    </h2>
    <form class method = "post" action = "./DOMAINLOGIC/createimage.dom.php?id=<?php echo $album->get_id()?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstPic">Image: </label>
            <input type="file" class="form-control" name="firstPic" id="firstPic" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="descriptionIMG">Description de l'image (facultatif): </label>
            <textarea class="form-control" name="descriptionIMG" id="descriptionIMG" rows="3" id="descriptionIMG"></textarea>     
        </div>
        <?php  
            if(!validate_session()){
                header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
                die();
            }
            if($_SESSION["userID"] == $album->get_authorID()){
                echo "<button class=\"btn btn-success\" type=\"submit\">Ajouter un image</button>";
            } 
        ?>      
    </form>
</div>