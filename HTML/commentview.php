<div div id='comments' class="container">
            <?php
                $type ='ALB';
                include "comment-loader.php"
              ?>
        </div>
        <button id="comment-load-btn" type="button" class="btn btn-primary" name="button">Plus de Commentaire</button>
        
        <div div class="container mb-sm 5">
            <h1>Ajouter un commentaire</h1>     
        </div>
        <form class method = "post" action = "./DOMAINLOGIC/ajoutercommentaire.dom.php?id=<?php echo $parentID?>&type=ALB" enctype="multipart/form-data">
        <div class="form-group">
            <label for="commentaireIMG">Commentaire: </label>
            <textarea class="form-control" name="commentaireIMG" id="commentaireIMG" rows="3" id="commentaireIMG"></textarea>     
        </div>
            <button class="btn btn-success mb-2" type="submit">Ajouter un commentaire</button>
        </form> 
</div>     