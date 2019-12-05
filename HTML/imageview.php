<div class="container center mb-3" style="margin-top:30px">
    <div div class="border border-dark mb-sm 5">
        <?php
        include "./CLASSES/IMAGE/image.php";
        include "./CLASSES/COMMENTAIRES/commentaire.php";
		$image = new image();
        $image->load_image($_GET["id"]);

        //<!-- Affiche limage Selectionner -->
        echo '<div><h1>'. $image->get_description() .'</h1></div>';
        echo '<img src="' . $image->get_imageUrl() .'" class="center mb-2" style="max-width:95%;height:auto;width:auto"></img>';

        //<!--Upvote arrow & nb de UpVotes  -->
        echo '<div class="d-flex flex-row bd-highlight border-top border-dark mb-sm 5">';
        echo '<div class="p-2 bd-highlight  border-right border-dark mb-sm 5"><i class="fas fa-arrow-alt-circle-up"></i></div>';
        echo '<div class="p-2 bd-highlight  border-right border-dark mb-sm 5">'. $image->get_likes() .'</div>';
        echo "</div>";

        //<!--Commentaire section  -->
        echo '<div div class="container border-top border-dark mb-sm 5">';
        //Affichage des commentaire
        $commentaires = commentaire::create_commentaire_list($image->get_imageID());
        echo "<h2>Commentaire</h2>";
            

        echo "</div>";

        
        echo '<div div class="container border-top border-dark mb-sm 5">';
        //Affichage des commentaire
        echo "<h1>Ajouter un commentaire</h1>";
        
        echo "</div>";
        ?>
        <form class method = "post" action = "./DOMAINLOGIC/ajoutercommentaire.dom.php?id=<?php echo $image->get_imageID()?>&type=IMG" enctype="multipart/form-data">
        <div class="form-group">
            <label for="commentaireIMG">Commentaire: </label>
            <textarea class="form-control" name="commentaireIMG" id="commentaireIMG" rows="3" id="commentaireIMG"></textarea>     
        </div>
            <button class="btn btn-success mb-2" type="submit">Ajouter un commentaire</button>
        </form>
    </div>
</div>

    