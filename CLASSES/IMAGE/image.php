<?php
include_once __DIR__ . "/imageTDG.PHP";

class Image{

    private $imageID;
    private $imageUrl;
    private $albumID;
    private $description;
    private $dateCreation;

    public function __construct(){ }
    
    public function get_imageID(){
        return $this->imageID;
    }

    public function get_imageUrl(){
        return $this->imageUrl;
    }

    public function get_albumID(){
        return $this->albumID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_dateCreation(){
        return $this->dateCreation;
    }

    public function set_imageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }

    public function set_albumID($albumID){
        $this->albumID = $albumID;
    }

    public function set_description($description){
        $this->description = $description;
    }

    public function set_dateCreation($dateCreation){
        $this->dateCreation = $dateCreation;
    }
    public function load_image($imageID){
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_by_id($imageID);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->imageID = $res['imageID'];
        $this->imageUrl = $res['imageUrl'];
        $this->albumID = $res['albumID'];
        $this->description = $res['description'];
        $this->dateCreation = $res['dateCreation'];

        $TDG = null;
        return true;
    }

    public function update_image_description($imageID, $description){
        //load user infos
        if(!$this->load_image($imageID))
        {
          return false;
        }

        if(empty($this->imageID)){
          return false;
        }

        $this->description = $description;

        $TDG = ImageTDG::get_Instance(); // get instance -> voir albumTDG
        $res = $TDG->update_description($this->imageID, $this->description); 

        $TDG = null;
        return $res;
    }

    public static function add_image($imageUrl, $albumID, $description)
    {
        if(empty($imageUrl) || empty($albumID))
        {
            return false;
        }
        $TDG = ImageTDG::get_Instance();
        $TDG->add_image($imageUrl,$albumID,$description);
        $TDG=null;
        return true;
    }

    public function delete_image(){
        $tdg = ImageTDG::get_Instance();
        $res = $tdg->delete_image($this->get_imageID());
        return $res;
    }

    public function get_firstImagePosted($albumID)
    {
        $tdg = ImageTDG::get_Instance();
        $res = $tdg->get_firstImagePosted($albumID);
        $this->load_image($res['imageID']);
        return $res;
    }


    /*public function get_description_by_image($imageID){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT description FROM $tableName WHERE imageID=:imageID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageID', $imageID);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }*/
    
    public static function list_images_by_albums($albumID)
    {
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_by_albumId($albumID);
        $TDG = null;
        return $res;
    }

    public static function create_image_list($albumID)
    {
        $imageList = array();
        $images = Image::list_images_by_albums($albumID);
        foreach($images as $res)
        {
            $image = new Image();
            $image->load_image($res['imageID']);
            array_push($imageList,$image);
        }
        return $imageList;

    }

    public function display()
    {
        $likes = $this->get_likes();
        echo "<div class='col-md-4'>";
        echo "<div class='card mb-4'>";
        echo "<div class='card-body'>";
        echo "<a href='image.php?id=$this->imageID'>
        <img class='card-img-top img-fluid img-thumbnail' src='$this->imageUrl'></a>";
        echo "<div class='row'>";
        echo "<button id='like-album-btn' class='fas fa-arrow-alt-circle-up btn btn-lg' disabled='true'></button>";
        echo "<h4> $likes</h4>";
        echo "</div>";
        echo "<p class='card-text'> $this->dateCreation </p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }


    public function get_likes()
    {
        if(!$this->load_image($this->imageID))
        {
          return false;
        }
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_likes_number($this->imageID); 
        $TDG = null;
        return $res['likes']; 
    }

    public function add_like($userID,$imageID)
    {
        if(empty($userID) || empty($imageID))
        {
            return false;
        }
        
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->add_like($imageID,$userID);
        $TDG = null;
        return $res;
    }

    public static function get_number_image_album($albumID)
    {
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_number_image_album($albumID); 
        $TDG = null;
        return $res['number']; 
    }
}
