<?php
include_once __DIR__ . "/albumTDG.PHP";
include_once __DIR__ . "/../IMAGE/image.PHP";
include_once __DIR__ . "/../USER/user.PHP";

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

    public function display_album()
    {
        $imageBackground = new Image();
        $imageBackground->get_firstImagePosted($this->albumID);
        $imageUrl = $imageBackground->get_imageUrl();

        $author = new User();
        $author->load_user_id($this->authorID);
        $authorName = $author->get_username();
        $authorProfilPic = $author->get_imagesProfile();

        $titre = $this->title;
        $id = $this->albumID;
        $date =$this->date;

        echo "<div class='col-sm-4 text-left'>";
        echo "<div class='card bg-light'>";
        echo "<div class='card-header'>";
        echo "<a class='text-decoration-none' href='album.php?id=$id'> <h2 class='card-title'>$titre</h2> </a>";
        echo "</div>";
        echo "<img class='card-img-top' src='$imageUrl'>";
        echo "<div class='card-footer'>";
        echo "<p class='card-text'><small class='text-muted'> By : <a class='text-decoration-none' href='profile.php?username=$authorName'>$authorName</a> | Créé le $date </small></p>";
        echo "<a href='profile.php?username=$authorName'><img src='$authorProfilPic' class='img-thumbnail' style='width:20%;height:60%'></a>";
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
    
    public static function list_albums_by_authorID($authorID)
    {
        $TDG = AlbumTDG::get_Instance();
        $res = $TDG->get_all_albums();
        $TDG = null;
        return $res;

    }
    
}