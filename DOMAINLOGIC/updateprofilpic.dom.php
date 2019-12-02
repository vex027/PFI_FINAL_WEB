<?php 
    include "../CLASSES/USER/user.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";
    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(isset($_FILES['newProfilPic'])){
    
        $target_dir = "Images_Profil/";

        $media_file_type = pathinfo($_FILES['newProfilPic']['name'] ,PATHINFO_EXTENSION);
    
        $img_extensions_arr = array("jpg","jpeg","png","gif");

        if(in_array($media_file_type, $img_extensions_arr)){
            $type = "image";
            echo "image";
        }else{
            header("Location: ../error.php?Invalid file type");
            die();
        }

        //creation d'un nom unique pour la "PATH" du fichier
        $path = tempnam("../Images_Profil", '');
        unlink($path);
        $file_name = basename($path, ".tmp");
        
        //creation de l'url pour la DB
        $url = $target_dir . $file_name . "." . $media_file_type;
        
        //deplacement du fichier uploader vers le bon repertoire (Medias)
        move_uploaded_file($_FILES['newProfilPic']['tmp_name'], "../" . $url);

        //create entry in database
        $user = new User();
        $user->update_user_image($_SESSION["userEmail"],$url);
        //redirection
        $username = $_SESSION["userName"];
        header("Location: ../profile.php?username=$username");
        die();
    }
    header("Location: ../error.php?ErrorMSG=Erreur d'upload!");
    die();

?>