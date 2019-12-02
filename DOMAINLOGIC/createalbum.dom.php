<?php
    include "../CLASSES/ALBUM/album.php";
    include "../CLASSES/ALBUM/album.php"
    include __DIR__ . "/../UTILS/sessionhandler.php";
    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(isset($_FILES['firstPic']) && isset($_POST['titleAlbum'])){

        $title = $_POST['titleAlbum'];
        $target_dir = "Images_Album/";

        $media_file_type = pathinfo($_FILES['firstPic']['name'] ,PATHINFO_EXTENSION);
    
        $img_extensions_arr = array("jpg","jpeg","png","gif");

        if(in_array($media_file_type, $img_extensions_arr)){
            $type = "image";
            echo "image";
        }else{
            header("Location: ../error.php?Invalid file type");
            die();
        }

        //creation d'un nom unique pour la "PATH" du fichier
        $path = tempnam("../Images_Album", '');
        unlink($path);
        $file_name = basename($path, ".tmp");
        
        //creation de l'url pour la DB
        $url = $target_dir . $file_name . "." . $media_file_type;
        
        //deplacement du fichier uploader vers le bon repertoire (Medias)
        move_uploaded_file($_FILES['firstPic']['tmp_name'], "../" . $url);



        //create entry in database
        $album = new Album();
        $album->add_album($title,$_SESSION['userID'],$_POST['description']);
        $album->load_album_title($title);

        $image = new Image();
        $image->add_image($url,$album->get_id(),$_POST['descriptionIMG']);
        //redirection
        $username = $_SESSION["userName"];
        header("Location: ../profile.php?username=$username");
        die();
    }
?>