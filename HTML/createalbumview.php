<div class="container align-middle border mb-sm-5">
    <form class method = "post" action = "./DOMAINLOGIC/createalbum.dom.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titleAlbum">Titre de l'album: </label>
            <input type="Text" class="form-control" name="titleAlbum" id="titleAlbum" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="description">Description de l'album (facultatif): </label>
            <textarea class="form-control" id="description" rows="3" id="titledescriptionAlbum"></textarea>     
        <div class="form-group">
        </div>
            <label for="firstPic">Première image: </label>
            <input type="file" class="form-control" name="firstPic" id="firstPic" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="descriptionIMG">Description de l'image (facultatif): </label>
            <textarea class="form-control" id="descriptionIMG" rows="3" id="descriptionIMG"></textarea>     
        <div class="form-group">
        <button class="btn btn-success" type="submit">Ajouter un album</button>
    </form>
</div>
