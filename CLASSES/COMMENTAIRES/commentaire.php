<?php
include_once __DIR__ . "/commentaireTDG.PHP";
include_once __DIR__ . "/../USER/user.PHP";
class Commentaire{

    private $commentaireID;   
    private $typeCom;
    private $dateCreation;
    private $contenu;
    private $parentID;
    private $authorID;
    
    public function __construct(){
    }

    //getters
    public function get_commentaireID(){
        return $this->commentaireID;
    }

    public function get_typeCom(){
        return $this->typeCom;
    }

    public function get_dateCreation(){
        return $this->dateCreation;
    }

    public function get_contenu(){
        return $this->contenu;
    }

    public function get_parentID(){
        return $this->parentID;
    }

    public function get_authorID(){
        return $this->authorID;
    }

    //setters
    public function set_contenu($contenu){
        $this->contenu = $contenu;
    }

    public function load_Commentaire($id){
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->commentaireID = $res['commentaireID'];
        $this->typeCom = $res['typeCom'];
        $this->dateCreation = $res['dateCreation'];
        $this->contenu = $res['contenu'];
        $this->parentID = $res['parentID'];
        $this->authorID = $res['authorID'];

        $TDG = null;
        return true;
    }

    public function update_commentaire_info($id, $contenu){

        if(!$this->load_Commentaire($id))
        {
          return false;
        }

        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->update_contenu($contenu,$id);
        $this->contenu = $contenu;    
        $TDG = null;
        return $res;
    }

    public function ajouter_commentaire($typeCom,$contenu,$parentID,$authorID){
        
        if(empty($typeCom) || empty($contenu) || empty($parentID) || empty($parentID))
        {
            return false;
        }
        
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->add_commentaire($typeCom, $contenu, $parentID,$authorID);
        $TDG = null;
        return $res;
    }

    public function delete_commentaire(){
        $tdg = ImageTDG::get_Instance();
        $res = $tdg->delete_image($this->get_commentaireID();
        return $res;
    }

    public static function list_commentaire_by_imageID($imageID,$limite)
    {
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_all_commentaire_imageId($imageID,$limite);
        $TDG = null;
        return $res;
    }

    public static function list_commentaire_by_imageID_noLimit($imageID)
    {
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_all_commentaire_imageId_noLimit($imageID);
        $TDG = null;
        return $res;
    }

    public static function list_commentaire_by_albumID($albumID,$limite)
    {
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_all_commentaire_albumId($albumID,$limite);
        $TDG = null;
        return $res;
    }

    public static function list_commentaire_by_albumID_noLimit($albumID)
    {
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_all_commentaire_albumId_noLimit($albumID);
        $TDG = null;
        return $res;
    }

    public static function create_commentaire_list_album($albumID,$limite)
    {
        $commentaireList = array();
        $commentaires = Commentaire::list_commentaire_by_albumID($albumID,$limite);
        foreach($commentaires as $res)
        {
            $commentaire = new Commentaire();
            $commentaire->load_Commentaire($res['commentaireID']);
            array_push($commentaireList,$commentaire);
        }
        return $commentaireList;
    }

    public static function create_commentaire_list_album_noLimit($albumID)
    {
        $commentaireList = array();
        $commentaires = Commentaire::list_commentaire_by_albumID_noLimit($albumID);
        foreach($commentaires as $res)
        {
            $commentaire = new Commentaire();
            $commentaire->load_Commentaire($res['commentaireID']);
            array_push($commentaireList,$commentaire);
        }
        return $commentaireList;
    }

    public static function create_commentaire_list_image_noLimit($imageID)
    {
        $commentaireList = array();
        $commentaires = Commentaire::list_commentaire_by_imageID_noLimit($imageID);
        foreach($commentaires as $res)
        {
            $commentaire = new Commentaire();
            $commentaire->load_Commentaire($res['commentaireID']);
            array_push($commentaireList,$commentaire);
        }
        return $commentaireList;
    }

    public static function create_commentaire_list_image($imageID,$limite)
    {
        $commentaireList = array();
        $commentaires = Commentaire::list_commentaire_by_imageID($imageID,$limite);
        foreach($commentaires as $res)
        {
            $commentaire = new Commentaire();
            $commentaire->load_Commentaire($res['commentaireID']);
            array_push($commentaireList,$commentaire);
        }
        return $commentaireList;
    }

    public function display()
    {
        $user = new User();
        $user->load_user_id($this->authorID);
        $profilPic = $user->get_imagesProfile();
        $username = $user->get_username();
        $likes = $this->get_likes();

        echo "<div class='card card-default text-left p-3'>";
        echo "<div class='row'>";
        echo "<form method = 'post' action = 'DOMAINLOGIC/likeComment.dom.php'>";
        echo "<button id='like-album-btn' class='fas fa-arrow-alt-circle-up btn btn-lg' name='type' value='$this->typeCom'></button>";
        echo "<input type='hidden' name='commentID' value='$this->commentaireID'>";
        echo "<input type='hidden' name='parentID' value='$this->parentID'>";
        echo "</form>";
        echo "<h4> $likes</h4>";
        echo "</div>";
        echo "<a href='profile.php?username=$username'><img src='$profilPic' class='mr-3 mt-3 rounded-circle' style='width:60px'></a>";
        echo "<div class='card-heading'><a href='profile.php?username=$username'><h4> $username </a><small><i>Posted on $this->dateCreation</i></small></h4></div>";
        echo "<div class='card-body'>". $this->contenu . "</div>";
        echo "</div>";
  
    }

    public function get_likes()
    {
        if(!$this->load_Commentaire($this->get_commentaireID()))
        {
          return false;
        }
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->get_likes_number($this->get_commentaireID()); 
        $TDG = null;
        return $res['likes']; 
    }

    public function add_like($userID,$commentaireID)
    {
        if(empty($userID) || empty($commentaireID))
        {
            return false;
        }
        
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->add_like($commentaireID,$userID);
        $TDG = null;
        return $res;
    }
}
