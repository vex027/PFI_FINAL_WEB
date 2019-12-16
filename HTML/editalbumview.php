<?php 
    $album = new Album();
    if(!isset($_GET['id']) || !$album->load_album($_GET['id'])){
        header("Location: error.php?ErrorMSG=Album inexistant");
        die();
    }
?>

<div class="container align-middle border mb-sm-5">
    <form class method = "post" action = "./DOMAINLOGIC/editalbum.dom.php?id=<?php echo $album->get_id()?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titleAlbum">Titre de l'album: </label>
            <input type="Text" class="form-control" name="titleAlbum" id="titleAlbum" required value="<?php echo $album->get_title()?>">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="description">Description de l'album (facultatif): </label>
            <textarea class="form-control" name="description" id="description" rows="3" id="titledescriptionAlbum"><?php echo $album->get_description()?></textarea>     
        </div>
        <button class="btn btn-success" type="submit">Modifier un album</button>
    </form>
</div>
