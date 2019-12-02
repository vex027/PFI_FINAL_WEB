<div class="container center" style="margin-top:30px">
    <div div class="border border-dark mb-sm 5">
        <?php
        include "./CLASSES/IMAGE/imageTDG.php";
        $albumId = $_POST["albumID"];
 
        //<!-- Affiche limage Selectionner -->
        
        echo '<img src="ImageUrl" class="center">Noice</img>';

        //<!--Upvote arrow & nb de UpVotes  -->
        echo '<div class="d-flex flex-row bd-highlight border-top border-dark mb-sm 5">';
        echo '<div class="p-2 bd-highlight  border-right border-dark mb-sm 5">Upvote button</div>';
        echo '<div class="p-2 bd-highlight  border-right border-dark mb-sm 5">Likes</div>';
        echo "</div>";

        //<!--Commentaire section  -->
        echo '<div div class="container border-top border-dark mb-sm 5">';
        //Affichage des commentaire
        echo "<p>Commentaire</p>";

        echo "</div>";

        
   
        
        ?>
    </div>
</div>
<!-- upvote arrow -->
<i class="fas fa-arrow-alt-circle-up"></i>
    