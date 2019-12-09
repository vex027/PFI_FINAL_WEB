<?php
include_once __DIR__ . "/albumTDG.PHP";
include_once __DIR__ . "/../IMAGE/image.PHP";
include_once __DIR__ . "/../USER/user.PHP";
include_once __DIR__ . "/../COMMENTAIRES/commentaire.PHP";
include_once __DIR__ . "/../../UTILS/sessionhandler.php";

class Album{

    private $albumID;
    private $title;
    private $authorID;
    private $description;
    private $date;

    public function __construct(){
    }

    public function get_id(){
        return $this->albumID;
    }

    public function get_title(){ 
        return $this->title;
    }

    public function get_authorID(){
        return $this->authorID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_date(){
        return $this->date;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_description($description){
        $this->description = $description;
    }

    public function load_album($id){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->get_by_id($id);
    
        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $this->albumID = $res['albumID'];
        $this->title = $res['titre'];
        $this->authorID = $res['authorID'];
        $this->description = $res['description'];
        $this->date = $res['dateCreation'];

        $TDG = null;
        return true;
    }

    public function load_album_title($title){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->get_by_title($title);
    
        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $this->albumID = $res['albumID'];
        $this->title = $res['titre'];
        $this->authorID = $res['authorID'];
        $this->description = $res['description'];
        $this->date = $res['dateCreation'];

        $TDG = null;
        return true;
    }

    public function add_album($title, $authorID, $description){

        if(empty($title) || empty($authorID))
        {
            return false;
        }

        if($this->load_album_title($title))
        {
            return false;
        }

        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->add_album($title, $authorID, $description);
        $TDG = null;
        return true;
    }

    public function update_description($description,$albumID){

        if(!$this->load_album($albumID))
        {
            return false;
        }
        $this->description = $description;
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->update_description($description,$albumID);

        $TDG = null;
        return $res;
    }

    public function display_album() //Modifier pour pouvoir l'utiliser en search
    {
        $titre = $this->title;
        $id = $this->albumID;
        $date =$this->date;
        $likes = $this->get_likes();

        $imageBackground = new Image();
        $imageBackground->get_firstImagePosted($this->albumID);
        $imageUrl = $imageBackground->get_imageUrl();

        $author = new User();
        $author->load_user_id($this->authorID);
        $authorName = $author->get_username();
        $authorProfilPic = $author->get_imagesProfile();
        
        $nombreCommentaire = Commentaire::get_comments_number($this->albumID,'ALB');

        echo "<div class='card bg-light'>";
        echo "<div class='card-header'>";
        echo "<div class='row'>";

        if(validate_session()){
            if($_SESSION['userID']==$this->authorID){
                echo "<form method = 'post' action = 'DOMAINLOGIC/deletealbum.dom.php'>";
                echo "<button class='btn btn-danger center-block' name='albumID' value='$this->albumID'><i class='material-icons'>delete_forever</i></button>";
                echo "</form>";
            }
        }
        echo "</div>";
        echo "<a class='text-decoration-none' href='album.php?id=$id'> <h2 class='card-title'>$titre</h2>";
        echo "</div>";
        echo "<img class='card-img-top' src='$imageUrl'></a>";
        echo "<div class='card-footer'>";
        echo "<p class='card-text'><small class='text-muted'> By : <a class='text-decoration-none' href='profile.php?username=$authorName'>$authorName</a> | Créé le $date </small></p>";
        echo "<a href='profile.php?username=$authorName'><img src='$authorProfilPic' class='img-thumbnail' style='width:20%;height:60%'></a>";
        echo "<div class='row'>";
        echo "<i class='fas fa-arrow-alt-circle-up p-2'></i>";
        echo "<h4 class='p2'> $likes</h4>";
        echo "<i class='fas fa-comment p-2'></i>";
        echo "<h4>$nombreCommentaire</h4>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
    }

    public static function list_all_albums()
    {
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_all_albums();
        $TDG = null;
        return $res;
    }

    public static function list_all_albums_like_title($title)
    {
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_like_title($title);
        $TDG = null;
        return $res;
    }

    public static function list_albums_by_authorID($authorID)
    {
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_by_authorID($authorID);
        $TDG = null;
        return $res;
    }

    public static function create_album_list()
    {
        $albumList = array();
        $albums = Album::list_all_albums();
        foreach($albums as $res)
        {
            $album = new Album();
            $album->load_album($res['albumID']);
            array_push($albumList,$album);
        }
        return $albumList;
    }

    public static function create_album_list_like_title($title)
    {
        $albumList = array();
        $albums = Album::list_all_albums_like_title($title);
        foreach($albums as $res)
        {
            $album = new Album();
            $album->load_album($res['albumID']);
            array_push($albumList,$album);
        }
        return $albumList;
    }

    public static function create_album_list_by_user($authorID)
    {
        $albumList = array();
        $albums = Album::list_albums_by_authorID($authorID);
        foreach($albums as $res)
        {
            $album = new Album();
            $album->load_album($res['albumID']);
            array_push($albumList,$album);
        }
        return $albumList;
    }

    public function get_likes()
    {
        if(!$this->load_album($this->albumID))
        {
          return false;
        }
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_likes_number($this->albumID); 
        $TDG = null;
        return $res['likes']; 
    }

    public function get_user_alreadyLiked($userID)
    {
        if(!$this->load_album($this->albumID))
        {
          return false;
        }
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_like_number_user($this->albumID,$userID); 
        $TDG = null;
        return $res['likes'] ==1; 
    }

    public function add_like($userID,$albumID)
    {
        if(empty($userID) || empty($albumID))
        {
            return false;
        }
        
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->add_like($albumID,$userID);
        $TDG = null;
        return $res;
    }

    public function remove_like($userID,$albumID)
    {
        if(empty($userID) || empty($albumID))
        {
            return false;
        }
        
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->remove_like($albumID,$userID);
        $TDG = null;
        return $res;
    }

    public function delete_album()
    {
        $tdg = AlbumTDG::get_Instance();
        $res = $tdg->delete_album($this->get_id());
        return $res;
    }

    public static function get_most_likedAlbum($userID)
    {
        if(empty($userID))
        {
            return false;
        }
        
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_mostLiked_album($userID);
        $TDG = null;
        $album = new Album();
        $album->load_album($res['albumID']);
        return $album;
    }

    public static function get_last_album($userID)
    {
        if(empty($userID))
        {
            return false;
        }
        
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_last_album($userID);
        $TDG = null;
        $album = new Album();
        $album->load_album($res['albumID']);
        return $album;
    }

    public static function get_first_album($userID)
    {
        if(empty($userID))
        {
            return false;
        }
        
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_first_album($userID);
        $TDG = null;
        $album = new Album();
        $album->load_album($res['albumID']);
        return $album;
    }
}