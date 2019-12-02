<?php
    include "./CLASSES/IMAGE/imageTDG.php";
    //$albumId = $_POST["albumID"];
 
    echo '<div class="container center" style="margin-top:30px">';
        //<!-- Affiche limage Selectionner -->
        echo '<div div class="border border-dark mb-sm 5">';
        echo "<p>Noice</p>";



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

        echo '</div>';
   
        echo '</div>';
?>
<!-- upvote arrow -->
<i class="fas fa-arrow-alt-circle-up"></i>
    